<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\InventoryRepairApplication;
use App\Models\Inventory\InventoryWorkOrderItem;
use Illuminate\Support\Facades\DB;

class InventoryRepairController extends Controller
{
    public function create()
    {
        // Fetch items from stock (WorkOrderItems where receive_quantity > 0)
        $stockItemsQuery = InventoryWorkOrderItem::whereHas('workOrder', function ($q) {
                $q->where('workflow_status', 'received');
            })->where('receive_quantity', '>', 0)->get();
            
        // Group by category, item_name, unit and sum receive_quantity
        $stockItems = $stockItemsQuery->groupBy(function($item) {
            return ($item->category ?? '') . '|' . ($item->item_name ?? '') . '|' . ($item->unit ?? '') . '|' . ($item->product_type ?? '');
        })->map(function($group) {
            return (object) [
                'category' => $group->first()->category,
                'item_name' => $group->first()->item_name,
                'unit' => $group->first()->unit,
                'product_type' => $group->first()->product_type,
                'quantity' => $group->sum('receive_quantity'),
            ];
        })->values();

        return view('backend.pages.inventory.repair.create', compact('stockItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_date' => 'required|date',
            'applicant_name' => 'required|string',
            'department_name' => 'required|string',
            'item_name' => 'required|string',
            'product_type' => 'nullable|string',
            'category' => 'nullable|string',
            'unit' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'problem_description' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $year = date('Y');
            $lastApp = InventoryRepairApplication::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $nextId = $lastApp ? ($lastApp->id + 1) : 1;
            $repairNo = 'IN-REP-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            InventoryRepairApplication::create([
                'repair_no' => $repairNo,
                'application_date' => $request->application_date,
                'applicant_name' => $request->applicant_name,
                'department_name' => $request->department_name,
                'item_name' => $request->item_name,
                'product_type' => $request->product_type,
                'category' => $request->category,
                'unit' => $request->unit,
                'quantity' => $request->quantity,
                'problem_description' => $request->problem_description,
                'status' => 'pending',
            ]);
        });

        return redirect()->route('inventory.maintenance.repair.create')->with('success', 'Repair application submitted successfully.');
    }

    public function approvals()
    {
        $repairs = InventoryRepairApplication::orderBy('id', 'desc')->get();
        return view('backend.pages.inventory.repair.approvals', compact('repairs'));
    }

    public function show($id)
    {
        $repair = InventoryRepairApplication::findOrFail($id);
        return view('backend.pages.inventory.repair.show', compact('repair'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,repaired',
            'admin_remarks' => 'nullable|string',
        ]);

        $repair = InventoryRepairApplication::findOrFail($id);
        $repair->status = $request->status;
        if ($request->filled('admin_remarks')) {
            $repair->admin_remarks = $request->admin_remarks;
        }
        $repair->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
