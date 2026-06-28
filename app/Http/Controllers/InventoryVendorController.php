<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\InventoryVendor;
use App\DataTables\InventoryVendorDataTable;
use App\DataTables\InventoryVendorAssignedDataTable;

class InventoryVendorController extends Controller
{
    public function index(InventoryVendorDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.inventory.vendor.index');
    }

    public function create()
    {
        return view('backend.pages.inventory.vendor.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'name_bn' => 'nullable|string|max:255',
            'trade_license' => 'required|string|max:255',
            'tin' => 'nullable|string|max:255',
            'bin' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'bank_ac_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
        ]);

        InventoryVendor::create($validatedData);

        return redirect()->route('inventory.vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function show($id)
    {
        $vendor = InventoryVendor::findOrFail($id);
        return view('backend.pages.inventory.vendor.show', compact('vendor'));
    }

    public function assigned(InventoryVendorAssignedDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.inventory.vendor.assigned');
    }

    public function assignedShow($id)
    {
        $workOrder = \App\Models\Inventory\InventoryWorkOrder::with(['vendor', 'items'])->findOrFail($id);
        $items = $workOrder->items;

        return view('backend.pages.inventory.vendor.assigned_show', compact('workOrder', 'items'));
    }
}
