<?php

namespace App\Http\Controllers;

use App\Models\Inventory\InventoryWorkOrder;
use App\Models\Inventory\InventoryWorkOrderItem;
use App\Models\Inventory\InventoryQuotation;
use App\Models\Inventory\InventoryVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkOrderController extends Controller
{
    private array $departments = ['Administration', 'Finance', 'Engineering', 'Procurement', 'IT', 'Store'];
    private array $categories = ['Stationery', 'Furniture', 'IT Equipment', 'Office Supplies', 'Maintenance'];
    private array $units = ['Pcs', 'Box', 'Pack', 'Set', 'Dozen'];

    public function index()
    {
        $workOrders = InventoryWorkOrder::withCount('items')
            ->withSum('items', 'purchase_quantity')
            ->with('requisitions')

            ->latest()
            ->get();

        $summaryCards = [
            [
                'label' => 'Draft Orders',
                'value' => InventoryWorkOrder::where('workflow_status', 'draft')->count(),
                'icon' => 'fa-file-alt',
                'color' => 'primary',
            ],
            [
                'label' => 'Pending Approvals',
                'value' => InventoryWorkOrder::whereIn('workflow_status', ['department_head', 'ndc', 'adc', 'dc'])->count(),
                'icon' => 'fa-hourglass-half',
                'color' => 'warning',
            ],
            [
                'label' => 'Rejected',
                'value' => InventoryWorkOrder::where('workflow_status', 'rejected')->count(),
                'icon' => 'fa-times-circle',
                'color' => 'danger',
            ],
        ];

        return view('backend.pages.inventory.work_order.index', compact('workOrders', 'summaryCards'));
    }

    public function create()
    {
        // Load all approved requisitions with their items
        $approvedRequisitions = \App\Models\Inventory\InventoryRequisition::with('items')
            ->where('workflow_status', 'approved')
            ->latest()
            ->get();

        $categories = ['Stationery', 'Furniture', 'IT Equipment', 'Office Supplies', 'Maintenance'];
        $units = ['Pcs', 'Box', 'Pack', 'Set', 'Dozen'];

        // Get current stock mapping by item name
        $stockQuantities = \App\Models\Inventory\InventoryRequisitionItem::select('item_name', \DB::raw('SUM(available_quantity) as total_stock'))
            ->groupBy('item_name')
            ->pluck('total_stock', 'item_name');

        return view('backend.pages.inventory.work_order.create', [
            'approvedRequisitions' => $approvedRequisitions,
            'categories' => $categories,
            'units' => $units,
            'stockQuantities' => $stockQuantities,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_date' => ['required', 'date'],
            'validity_date' => ['required', 'date'],
            'delivery_date' => ['required', 'date'],
            'requisition_ids' => ['required', 'json'],
            'items_payload' => ['required', 'json'],
        ]);

        $items = json_decode($request->items_payload, true) ?: [];
        $requisitionIds = json_decode($request->requisition_ids, true) ?: [];

        abort_if(empty($items), 422, 'At least one item is required.');
        abort_if(empty($requisitionIds), 422, 'At least one requisition must be included.');

        $workOrder = DB::transaction(function () use ($request, $items, $requisitionIds) {
            $nextNumber = str_pad(((InventoryWorkOrder::withTrashed()->max('id') ?? 0) + 1), 4, '0', STR_PAD_LEFT);

            $workOrder = new InventoryWorkOrder();
            $workOrder->work_order_no = 'WO-' . now()->format('Y') . '-' . $nextNumber;
            $workOrder->application_date = $request->application_date;
            $workOrder->validity_date = $request->validity_date;
            $workOrder->delivery_date = $request->delivery_date;
            $workOrder->workflow_status = 'draft';
            $workOrder->current_step = 1;
            $workOrder->save();

            // Link the requisitions
            $workOrder->requisitions()->sync($requisitionIds);

            // Update requisition status so they don't show up again
            \App\Models\Inventory\InventoryRequisition::whereIn('id', $requisitionIds)
                ->update(['workflow_status' => 'work_order_created']);

            foreach ($items as $item) {
                $requiredQuantity = (float) ($item['required_quantity'] ?? 0);
                $purchaseQuantity = (float) ($item['purchase_quantity'] ?? 0);
                $additionalQuantity = $requiredQuantity - $purchaseQuantity;
                
                // Decode the requisition sources for this item (for reference, though not directly stored in items table)
                // If we want to store it, we could add a json column to InventoryWorkOrderItem. 
                // But the view can reconstruct it, or we add a `requisition_sources` column. 
                // For now, we'll store it in `remarks` as JSON.
                $sources = isset($item['sources']) ? json_encode($item['sources']) : null;

                $woItem = new InventoryWorkOrderItem([
                    'inventory_work_order_id' => $workOrder->id,
                    'item_name' => $item['item_name'] ?? '',
                    'product_type' => $item['product_type'] ?? null,
                    'category' => $item['category'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'required_quantity' => $requiredQuantity,
                    'purchase_quantity' => $purchaseQuantity,
                    'additional_quantity' => $purchaseQuantity - $requiredQuantity,
                ]);
                // Using remarks to store sources mapping for popup
                $woItem->remarks = $sources; 
                $woItem->save();
            }

            return $workOrder;
        });

        return redirect()
            ->route('inventory.work-order.index')
            ->with('success', "Work Order {$workOrder->work_order_no} created successfully.");
    }

    public function show(int $id)
    {
        $workOrder = InventoryWorkOrder::with(['items', 'requisitions.items'])->findOrFail($id);

        $user = auth()->user();
        $designation = strtolower($this->profileDefaults()['designation'] ?? '');
        
        $isDeptHead = false;
        if ($user) {
            $isDeptHead = $user->role_id == 1 || $user->hasRole('Admin') || $user->hasRole('Developer') ||
                       $user->hasRole('Department Head') || 
                       str_contains($designation, 'department head') || 
                       str_contains($designation, 'dept head') ||
                       str_contains($designation, 'head');
        }

        $quotations = \App\Models\Inventory\InventoryQuotation::with('items')->orderBy('id', 'desc')->get();

        $lowestPrices = [];
        foreach ($quotations as $quotation) {
            foreach ($quotation->items as $item) {
                $name = strtolower(trim($item->item_name));
                if (!isset($lowestPrices[$name]) || $item->price < $lowestPrices[$name]) {
                    $lowestPrices[$name] = $item->price;
                }
            }
        }

        return view('backend.pages.inventory.work_order.show', compact('workOrder', 'isDeptHead', 'quotations', 'lowestPrices'));
    }

    public function approveShow(int $id)
    {
        $workOrder = InventoryWorkOrder::with(['items', 'requisitions'])->findOrFail($id);

        $quotations = \App\Models\Inventory\InventoryQuotation::with('items')->orderBy('id', 'desc')->get();

        $lowestPrices = [];
        foreach ($quotations as $quotation) {
            foreach ($quotation->items as $item) {
                $name = strtolower(trim($item->item_name));
                if (!isset($lowestPrices[$name]) || $item->price < $lowestPrices[$name]) {
                    $lowestPrices[$name] = $item->price;
                }
            }
        }

        $vendors = InventoryVendor::latest()->get();

        return view('backend.pages.inventory.work_order.approve_show', compact('workOrder', 'quotations', 'lowestPrices', 'vendors'));
    }

    public function assignVendor(Request $request, int $id)
    {
        $request->validate([
            'inventory_vendor_id' => 'required|exists:inventory_vendors,id',
        ]);

        $workOrder = InventoryWorkOrder::findOrFail($id);
        
        if ($workOrder->workflow_status !== 'approved') {
            return redirect()->back()->with('error', 'You can only assign vendors to approved work orders.');
        }

        $workOrder->inventory_vendor_id = $request->inventory_vendor_id;
        $workOrder->chalan_no = 'CHL-' . date('Ymd') . '-' . str_pad($workOrder->id, 4, '0', STR_PAD_LEFT);
        $workOrder->invoice_no = 'INV-' . date('Ymd') . '-' . str_pad($workOrder->id, 4, '0', STR_PAD_LEFT);
        $workOrder->save();

        return redirect()->back()->with('success', 'Vendor successfully assigned to this work order.');
    }

    public function updateApproved(Request $request)
    {
        $request->validate([
            'work_order_id' => ['required', 'exists:inventory_work_orders,id'],
            'purchase_quantities' => ['nullable', 'array'],
            'purchase_quantities.*' => ['nullable', 'numeric', 'min:0'],
            'prices' => ['nullable', 'array'],
            'prices.*' => ['nullable', 'numeric', 'min:0'],
        ]);

        $workOrder = InventoryWorkOrder::findOrFail($request->work_order_id);

        DB::transaction(function () use ($request, $workOrder) {
            if ($request->has('purchase_quantities')) {
                foreach ($request->purchase_quantities as $itemId => $qty) {
                    if ($qty === null || $qty === '') continue;

                    $item = InventoryWorkOrderItem::where('id', $itemId)
                        ->where('inventory_work_order_id', $workOrder->id)
                        ->first();

                    if ($item) {
                        $item->purchase_quantity = (float) $qty;
                        $item->additional_quantity = $item->purchase_quantity - $item->required_quantity;
                        if ($request->has("prices.{$itemId}")) {
                            $item->price = (float) $request->input("prices.{$itemId}");
                        }
                        $item->save();
                    }
                }
            }
        });

        return redirect()->route('inventory.work-order.approve_show', $workOrder->id)
            ->with('success', "Work Order {$workOrder->work_order_no} has been updated successfully.");
    }

    public function approveList()
    {
        $workOrders = InventoryWorkOrder::withCount('items')
            ->withSum('items', 'purchase_quantity')
            ->where('workflow_status', 'approved')
            ->whereNull('inventory_vendor_id')
            ->latest()
            ->get();

        return view('backend.pages.inventory.work_order.approve_list', compact('workOrders'));
    }

    public function approveWorkOrder(Request $request)
    {
        $request->validate([
            'work_order_id' => ['required', 'exists:inventory_work_orders,id'],
            'purchase_quantities' => ['nullable', 'array'],
            'purchase_quantities.*' => ['nullable', 'numeric', 'min:0'],
            'action_type' => ['required', 'in:approve,reject'],
            'deleted_items' => ['nullable', 'array'],
            'deleted_items.*' => ['exists:inventory_work_order_items,id']
        ]);

        $workOrder = InventoryWorkOrder::findOrFail($request->work_order_id);

        if ($request->action_type === 'reject') {
            $workOrder->workflow_status = 'rejected';
            $workOrder->save();
            return redirect()->route('inventory.work-order.index')
                ->with('success', "Work Order {$workOrder->work_order_no} has been rejected successfully.");
        }

        DB::transaction(function () use ($request, $workOrder) {
            if ($request->has('deleted_items')) {
                InventoryWorkOrderItem::whereIn('id', $request->deleted_items)
                    ->where('inventory_work_order_id', $workOrder->id)
                    ->delete();
            }

            if ($request->has('purchase_quantities')) {
                foreach ($request->purchase_quantities as $itemId => $qty) {
                    if ($qty === null || $qty === '') continue;

                    $item = InventoryWorkOrderItem::where('id', $itemId)
                        ->where('inventory_work_order_id', $workOrder->id)
                        ->first();

                    if ($item) {
                        $item->purchase_quantity = (float) $qty;
                        $item->additional_quantity = $item->purchase_quantity - $item->required_quantity;
                        if ($request->has("prices.{$itemId}")) {
                            $item->price = (float) $request->input("prices.{$itemId}");
                        }
                        $item->save();
                    }
                }
            }

            $workOrder->workflow_status = 'approved';
            $workOrder->save();
        });

        return redirect()->route('inventory.work-order.approve_list')
            ->with('success', "Work Order {$workOrder->work_order_no} has been approved successfully.");
    }

    public function destroy(int $id)
    {
        $workOrder = InventoryWorkOrder::findOrFail($id);
        $workOrder->delete();

        return redirect()
            ->route('inventory.work-order.index')
            ->with('success', 'Work Order deleted successfully.');
    }

    private function profileDefaults(): array
    {
        $user = auth()->user();

        if (! $user) {
            return [
                'department_name' => '',
                'applicant_name' => '',
                'designation' => '',
                'mobile_number' => '',
                'email_address' => '',
            ];
        }

        $user->loadMissing(['department', 'staff', 'professionalInfos']);

        $latestProfessionalInfo = $user->professionalInfos->sortByDesc('id')->first();

        return [
            'department_name' => trim((string) (
                optional($user->department)->name
                ?: optional($latestProfessionalInfo)->department
                ?: ''
            )),
            'applicant_name' => trim((string) (
                $user->name
                ?: optional($user->staff)->bn_name
                ?: ''
            )),
            'designation' => trim((string) (
                optional($latestProfessionalInfo)->current_designation
                ?: optional($latestProfessionalInfo)->designation
                ?: $user->getRoleNames()->first()
                ?: ''
            )),
            'mobile_number' => trim((string) ($user->mobile ?? '')),
            'email_address' => trim((string) ($user->email ?? '')),
        ];
    }
}
