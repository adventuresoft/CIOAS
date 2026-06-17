<?php

namespace App\Http\Controllers;

use App\Models\Inventory\InventoryRequisition;
use App\Models\Inventory\InventoryRequisitionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    private array $workflowSteps = [
        ['id' => 1, 'label' => 'Requisition Form', 'icon' => 'fa-clipboard-list'],
        ['id' => 2, 'label' => 'Department Head Approval', 'icon' => 'fa-user-tie'],
        ['id' => 3, 'label' => 'NDC Review', 'icon' => 'fa-search-dollar'],
        ['id' => 4, 'label' => 'ADC Approval', 'icon' => 'fa-pen-fancy'],
        ['id' => 5, 'label' => 'DC Approval', 'icon' => 'fa-gavel'],
        ['id' => 6, 'label' => 'Store Verification', 'icon' => 'fa-warehouse'],
        ['id' => 7, 'label' => 'Issue Slip Generation', 'icon' => 'fa-receipt'],
    ];

    private array $departments = ['Administration', 'Finance', 'Engineering', 'Procurement', 'IT', 'Store'];
    private array $categories = ['Stationery', 'Furniture', 'IT Equipment', 'Office Supplies', 'Maintenance'];
    private array $units = ['Pcs', 'Box', 'Pack', 'Set', 'Dozen'];
    private array $sampleItems = [
        [
            'item_name' => 'A4 Copy Paper',
            'category' => 'Stationery',
            'unit' => 'Box',
            'required_quantity' => 10,
            'estimated_unit_cost' => 450,
            'remarks' => 'Monthly office use',
        ],
        [
            'item_name' => 'Ball Point Pen',
            'category' => 'Office Supplies',
            'unit' => 'Pack',
            'required_quantity' => 25,
            'estimated_unit_cost' => 120,
            'remarks' => 'Blue ink preferred',
        ],
    ];

    public function index()
    {
        $inventories = InventoryRequisition::withCount('items')
            ->withSum('items', 'required_quantity')
            ->withSum('items', 'estimated_total_cost')

            ->latest()
            ->get();

        $summaryCards = [
            [
                'label' => 'Draft Requests',
                'value' => InventoryRequisition::where('workflow_status', 'draft')->count(),
                'icon' => 'fa-file-alt',
                'color' => 'primary',
            ],
            [
                'label' => 'Pending Approvals',
                'value' => InventoryRequisition::whereIn('workflow_status', ['department_head', 'ndc', 'adc', 'dc'])->count(),
                'icon' => 'fa-hourglass-half',
                'color' => 'warning',
            ],
            [
                'label' => 'Issued Slips',
                'value' => InventoryRequisition::whereNotNull('issue_slip_number')->count(),
                'icon' => 'fa-clipboard-check',
                'color' => 'success',
            ],
            [
                'label' => 'Rejected',
                'value' => InventoryRequisition::where('workflow_status', 'rejected')->count(),
                'icon' => 'fa-times-circle',
                'color' => 'danger',
            ],
        ];

        return view('backend.pages.inventory.index', compact('inventories', 'summaryCards'));
    }

    public function create()
    {
        session()->forget('inventory_requisition_id');

        return $this->renderSection(1, false, false, 'InventoryRequisitionCreate');
    }

    public function edit(int $id)
    {
        session()->put('inventory_requisition_id', $id);

        return $this->renderSection(1, false, false, 'InventoryRequisitionCreate');
    }

    public function show(int $id)
    {
        $inventory = InventoryRequisition::with('items')->findOrFail($id);

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

        return view('backend.pages.inventory.show', compact('inventory', 'isDeptHead'));
    }

    public function destroy(int $id)
    {
        $requisition = InventoryRequisition::findOrFail($id);
        $requisition->delete();

        if ((int) session('inventory_requisition_id') === (int) $id) {
            session()->forget('inventory_requisition_id');
        }

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Inventory requisition deleted successfully.');
    }

    public function approveList()
    {
        $inventories = InventoryRequisition::withCount('items')
            ->withSum('items', 'required_quantity')
            ->withSum('items', 'estimated_total_cost')
            ->where('workflow_status', 'approved')
            ->latest()
            ->get();

        return view('backend.pages.inventory.approve_list', compact('inventories'));
    }

    public function receive()
    {
        $requisitions = InventoryRequisition::with('items')
            ->where('workflow_status', 'approved')
            ->latest()
            ->get();

        return view('backend.pages.inventory.receive', compact('requisitions'));
    }

    public function receiveStore(Request $request)
    {
        $request->validate([
            'requisition_id' => ['required', 'exists:inventory_requisitions,id'],
            'received_quantities' => ['required', 'array'],
            'received_quantities.*' => ['nullable', 'numeric', 'min:0'],
        ]);

        $requisition = InventoryRequisition::findOrFail($request->requisition_id);

        DB::transaction(function () use ($request, $requisition) {
            foreach ($request->received_quantities as $itemId => $receivedQty) {
                if ($receivedQty === null || $receivedQty === '') continue;

                $item = InventoryRequisitionItem::where('id', $itemId)
                    ->where('inventory_requisition_id', $requisition->id)
                    ->first();

                if ($item) {
                    $item->available_quantity = ($item->available_quantity ?? 0) + (int) $receivedQty;
                    $item->stock_status = ($item->available_quantity > 0) ? 'In Stock' : 'Out of Stock';
                    $item->save();
                }
            }

            $requisition->workflow_status = 'received';
            $requisition->save();
        });

        return redirect()->route('inventory.receive')
            ->with('success', "Received items for Requisition {$requisition->requisition_no} successfully and added to Stock.");
    }

    public function stock()
    {
        $receivedItems = \App\Models\Inventory\InventoryWorkOrderItem::whereHas('workOrder', function ($q) {
                $q->where('workflow_status', 'received');
            })
            ->where('receive_quantity', '>', 0)
            ->with('workOrder')
            ->get();

        // Group by category, item_name, unit
        $stockItems = $receivedItems->groupBy(function($item) {
            return ($item->category ?? '') . '|' . ($item->item_name ?? '') . '|' . ($item->unit ?? '');
        })->map(function($group) {
            return (object) [
                'work_order_nos' => $group->pluck('workOrder.work_order_no')->filter()->unique()->implode(', '),
                'category' => $group->first()->category,
                'item_name' => $group->first()->item_name,
                'unit' => $group->first()->unit,
                'quantity' => $group->sum('receive_quantity'),
                'stock_status' => 'In Stock',
            ];
        })->values();

        return view('backend.pages.inventory.stock', compact('stockItems'));
    }

    public function distribution(\Illuminate\Http\Request $request)
    {
        $requisitions = InventoryRequisition::latest()->get();
        
        $requisition = null;
        $distributionItems = collect();
        
        if ($request->has('requisition_id')) {
            $requisition = InventoryRequisition::with('items')->find($request->requisition_id);
            if ($requisition) {
                $distributionItems = $requisition->items->map(function ($item) {
                    $totalStock = \App\Models\Inventory\InventoryWorkOrderItem::where('category', $item->category)
                        ->where('item_name', $item->item_name)
                        ->whereHas('workOrder', function ($q) {
                            $q->where('workflow_status', 'received');
                        })->sum('receive_quantity');
                    
                    $item->total_stock = $totalStock;
                    return $item;
                });
            }
        }

        return view('backend.pages.inventory.distribution', compact('requisitions', 'requisition', 'distributionItems'));
    }

    public function distributionStore(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'requisition_id' => 'required|exists:inventory_requisitions,id',
            'items' => 'required|array',
            'items.*.get_qty' => 'required|numeric|min:0',
            'items.*.category' => 'nullable|string',
            'items.*.item_name' => 'required|string',
            'items.*.unit' => 'nullable|string',
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            foreach ($request->items as $itemId => $data) {
                $getQty = (float) $data['get_qty'];
                if ($getQty <= 0) continue;

                $category = $data['category'] ?? '';
                $itemName = $data['item_name'];
                $unit = $data['unit'] ?? '';

                // Minus from Stock List (InventoryWorkOrderItem) where receive_quantity > 0
                $stockItems = \App\Models\Inventory\InventoryWorkOrderItem::whereHas('workOrder', function ($q) {
                        $q->where('workflow_status', 'received');
                    })
                    ->where('receive_quantity', '>', 0)
                    ->where('category', $category)
                    ->where('item_name', $itemName)
                    ->where('unit', $unit)
                    ->orderBy('id', 'asc')
                    ->get();

                $remainingToDeduct = $getQty;

                foreach ($stockItems as $stockItem) {
                    if ($remainingToDeduct <= 0) break;

                    if ($stockItem->receive_quantity >= $remainingToDeduct) {
                        $stockItem->receive_quantity -= $remainingToDeduct;
                        $stockItem->save();
                        $remainingToDeduct = 0;
                    } else {
                        $remainingToDeduct -= $stockItem->receive_quantity;
                        $stockItem->receive_quantity = 0;
                        $stockItem->save();
                    }
                }

                if ($remainingToDeduct > 0) {
                    throw new \Exception("Not enough stock available for item: {$itemName}");
                }

                // Update available_quantity on the RequisitionItem to reflect reduction in local requisition cache if needed
                $reqItem = \App\Models\Inventory\InventoryRequisitionItem::find($itemId);
                if ($reqItem) {
                    $reqItem->available_quantity = max(0, $reqItem->available_quantity - $getQty);
                    $reqItem->save();
                }
            }

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->back()->with('distribution_success', true);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $profileDefaults = $this->profileDefaults();
        $requisitionId = session('inventory_requisition_id');

        $request->validate([
            'application_date' => ['required', 'date'],
            'department_name' => ['nullable', 'string', 'max:255'],
            'applicant_name' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'mobile_number' => ['nullable', 'string', 'max:30'],
            'email_address' => ['nullable', 'email', 'max:255'],
            'purpose' => ['nullable', 'string'],
            'priority_level' => ['required', 'in:Normal,Urgent,Emergency'],
            'items_payload' => ['required', 'json'],
        ]);

        $items = json_decode($request->items_payload, true) ?: [];
        abort_if(empty($items), 422, 'At least one inventory item is required.');

        $requisition = DB::transaction(function () use ($request, $items, $profileDefaults, $requisitionId) {
            $nextNumber = str_pad(((InventoryRequisition::withTrashed()->max('id') ?? 0) + 1), 4, '0', STR_PAD_LEFT);
            $requisitionNo = $requisitionId
                ? InventoryRequisition::find($requisitionId)?->requisition_no
                : null;

            $requisition = $requisitionId
                ? InventoryRequisition::findOrFail($requisitionId)
                : new InventoryRequisition();

            if (! $requisition->exists) {
                $requisition->requisition_no = $requisitionNo ?: 'IN-REQ-' . now()->format('Y') . '-' . $nextNumber;
            }

            $requisition->application_date = $request->application_date;
            $requisition->department_name = $profileDefaults['department_name'] ?: ($request->department_name ?: 'N/A');
            $requisition->applicant_name = $profileDefaults['applicant_name'] ?: ($request->applicant_name ?: auth()->user()->name);
            $requisition->designation = $profileDefaults['designation'] ?: $request->designation;
            $requisition->mobile_number = $profileDefaults['mobile_number'] ?: $request->mobile_number;
            $requisition->email_address = $profileDefaults['email_address'] ?: $request->email_address;
            $requisition->purpose = $request->purpose;
            $requisition->priority_level = $request->priority_level;
            $requisition->workflow_status = $requisition->workflow_status ?: 'draft';
            $requisition->current_step = 1;
            $requisition->save();

            $requisition->items()->delete();

            foreach ($items as $item) {
                $requiredQuantity = (float) ($item['required_quantity'] ?? 0);
                $estimatedUnitCost = (float) ($item['estimated_unit_cost'] ?? 0);

                InventoryRequisitionItem::create([
                    'inventory_requisition_id' => $requisition->id,
                    'item_name' => $item['item_name'] ?? '',
                    'category' => $item['category'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'required_quantity' => $requiredQuantity,
                    'estimated_unit_cost' => $estimatedUnitCost,
                    'estimated_total_cost' => $requiredQuantity * $estimatedUnitCost,
                    'remarks' => null,
                ]);
            }

            return $requisition;
        });

        session()->put('inventory_requisition_id', $requisition->id);

        return redirect()
            ->route('inventory.requisition.index')
            ->with('success', "Inventory requisition {$requisition->requisition_no} created successfully.");
    }

    public function approveRequisition(Request $request)
    {
        $request->validate([
            'requisition_id' => ['required', 'exists:inventory_requisitions,id'],
            'required_quantities' => ['nullable', 'array'],
            'required_quantities.*' => ['nullable', 'numeric', 'min:0'],
            'action_type' => ['required', 'in:approve,reject'],
            'deleted_items' => ['nullable', 'array'],
            'deleted_items.*' => ['exists:inventory_requisition_items,id']
        ]);

        $requisition = InventoryRequisition::findOrFail($request->requisition_id);

        if ($request->action_type === 'reject') {
            $requisition->workflow_status = 'rejected';
            $requisition->save();
            return redirect()->route('inventory.requisition.index')
                ->with('success', "Requisition {$requisition->requisition_no} has been rejected successfully.");
        }

        DB::transaction(function () use ($request, $requisition) {
            if ($request->has('deleted_items')) {
                InventoryRequisitionItem::whereIn('id', $request->deleted_items)
                    ->where('inventory_requisition_id', $requisition->id)
                    ->delete();
            }

            if ($request->has('required_quantities')) {
                foreach ($request->required_quantities as $itemId => $qty) {
                    if ($qty === null || $qty === '') continue;

                    $item = InventoryRequisitionItem::where('id', $itemId)
                        ->where('inventory_requisition_id', $requisition->id)
                        ->first();

                    if ($item) {
                        $item->required_quantity = (float) $qty;
                        $item->estimated_total_cost = $item->required_quantity * $item->estimated_unit_cost;
                        $item->approved_quantity = $item->required_quantity;
                        $item->save();
                    }
                }
            }

            $requisition->workflow_status = 'approved';
            $requisition->save();
        });

        return redirect()->route('inventory.requisition.index')
            ->with('success', "Requisition {$requisition->requisition_no} has been approved successfully.");
    }

    private function renderSection(
        int $currentStep,
        bool $showStepper = true,
        bool $fallbackToLatest = true,
        string $subMenuName = 'InventoryRequisitionCreate'
    ) {
        $viewData = $this->baseViewData($currentStep, $fallbackToLatest);
        $viewData['showStepper'] = $showStepper;
        $viewData['subMenuName'] = $subMenuName;

        return view('backend.pages.inventory.wizard', $viewData);
    }

    private function baseViewData(int $currentStep, bool $fallbackToLatest = true): array
    {
        $requisitionId = session('inventory_requisition_id');
        $requisition = $requisitionId ? InventoryRequisition::with('items')->find($requisitionId) : null;

        if (! $requisition && $fallbackToLatest) {
            $requisition = InventoryRequisition::with('items')->latest('id')->first();
        }

        return [
            'currentStep' => $currentStep,
            'workflowSteps' => $this->workflowSteps,
            'departments' => $this->departments,
            'categories' => $this->categories,
            'units' => $this->units,
            'sampleItems' => $this->sampleItems,
            'profileDefaults' => $this->profileDefaults(),
            'requisition' => $requisition,
            'requisitionItems' => $requisition?->items ?? collect(),
        ];
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
