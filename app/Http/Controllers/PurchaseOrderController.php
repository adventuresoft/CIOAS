<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\InventoryWorkOrder;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Inventory\InventoryWorkOrderItem;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $workOrders = InventoryWorkOrder::with('vendor', 'items', 'purchaseOrder')
                        ->whereNotNull('inventory_vendor_id')
                        ->latest('updated_at')
                        ->get();
        return view('backend.pages.inventory.purchase_order.index', compact('workOrders'));
    }

    public function create($id)
    {
        $workOrder = InventoryWorkOrder::with(['vendor', 'items', 'purchaseOrder'])->findOrFail($id);
        
        // If a PO doesn't exist yet, we'll auto-generate a provisional PO number
        $provisionalPoNumber = 'PO-' . date('Ymd') . '-' . str_pad($workOrder->id, 4, '0', STR_PAD_LEFT);

        return view('backend.pages.inventory.purchase_order.create', compact('workOrder', 'provisionalPoNumber'));
    }

    public function store(Request $request, $id)
    {
        $workOrder = InventoryWorkOrder::findOrFail($id);

        $request->validate([
            'validity_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'items' => 'array',
            'items.*.receive_quantity' => 'nullable|numeric|min:0',
            'items.*.po_remarks' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Update or Create the Purchase Order
            $poNumber = $request->po_number ?? ('PO-' . date('Ymd') . '-' . str_pad($workOrder->id, 4, '0', STR_PAD_LEFT));
            
            InventoryPurchaseOrder::updateOrCreate(
                ['inventory_work_order_id' => $workOrder->id],
                [
                    'po_number' => $poNumber,
                    'validity_date' => $request->validity_date,
                    'delivery_date' => $request->delivery_date
                ]
            );

            // Update receive_quantity and remarks for each item
            $shouldDistributeStock = $workOrder->workflow_status !== 'received';

            if ($request->has('items')) {
                foreach ($request->items as $itemId => $itemData) {
                    $item = InventoryWorkOrderItem::where('id', $itemId)
                        ->where('inventory_work_order_id', $workOrder->id)
                        ->first();
                        
                    if ($item) {
                        $item->receive_quantity = $itemData['receive_quantity'] ?? 0;
                        $item->po_remarks = $itemData['po_remarks'] ?? null;
                        $item->save();
                        
                        // Distribute stock if not already distributed
                        if ($shouldDistributeStock && $item->receive_quantity > 0) {
                            $sources = json_decode($item->remarks, true) ?: [];
                            $remainingReceiveQty = $item->receive_quantity;
                            
                            foreach ($sources as $source) {
                                if ($remainingReceiveQty <= 0) break;
                                
                                $reqNo = $source['requisition_no'] ?? null;
                                $sourceQty = $source['qty'] ?? 0;
                                
                                if ($reqNo) {
                                    $requisition = \App\Models\Inventory\InventoryRequisition::where('requisition_no', $reqNo)->first();
                                    if ($requisition) {
                                        $reqItem = \App\Models\Inventory\InventoryRequisitionItem::where('inventory_requisition_id', $requisition->id)
                                            ->where('item_name', $item->item_name)
                                            ->first();
                                            
                                        if ($reqItem) {
                                            $allocatedQty = min($sourceQty, $remainingReceiveQty);
                                            $reqItem->available_quantity = ($reqItem->available_quantity ?? 0) + $allocatedQty;
                                            $reqItem->stock_status = ($reqItem->available_quantity >= $reqItem->required_quantity) ? 'In Stock' : 'Partial';
                                            $reqItem->save();
                                            
                                            $remainingReceiveQty -= $allocatedQty;
                                        }
                                        
                                        // Update the requisition status as received if not already
                                        if ($requisition->workflow_status !== 'received') {
                                            $requisition->workflow_status = 'received';
                                            $requisition->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if ($shouldDistributeStock) {
                $workOrder->workflow_status = 'received';
                $workOrder->save();
                $message = 'Items successfully received and added to Stock.';
            } else {
                $message = 'Details updated successfully.';
            }

            DB::commit();

            return redirect()->route('inventory.purchase_orders.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error saving Purchase Order: ' . $e->getMessage());
        }
    }
}
