<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryQuotation;
use App\Models\Inventory\InventoryQuotationItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = InventoryQuotation::with('items')->orderBy('id', 'desc')->get();
        return view('backend.pages.inventory.quotation.index', compact('quotations'));
    }

    public function create()
    {
        // Generate Quotation No
        $year = date('Y');
        $lastQuotation = InventoryQuotation::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $nextId = $lastQuotation ? ($lastQuotation->id + 1) : 1;
        $quotationNo = 'IN-QUO-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $categories = ['Stationery', 'Furniture', 'IT Equipment', 'Office Supplies', 'Maintenance'];
        $units = ['Pcs', 'Box', 'Pack', 'Set', 'Dozen'];

        return view('backend.pages.inventory.quotation.create', compact('quotationNo', 'categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quotation_date' => 'required|date',
            'department_name' => 'nullable|string',
            'applicant_name' => 'nullable|string',
            'designation' => 'nullable|string',
            'mobile_number' => 'nullable|string',
            'email_address' => 'nullable|email',
            'purpose' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string',
            'items.*.category' => 'nullable|string',
            'items.*.unit' => 'nullable|string',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $year = date('Y');
            $lastQuotation = InventoryQuotation::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $nextId = $lastQuotation ? ($lastQuotation->id + 1) : 1;
            $quotationNo = 'IN-QUO-' . $year . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            $quotation = InventoryQuotation::create([
                'quotation_no' => $quotationNo,
                'quotation_date' => $request->quotation_date,
                'department_name' => $request->department_name,
                'applicant_name' => $request->applicant_name,
                'designation' => $request->designation,
                'mobile_number' => $request->mobile_number,
                'email_address' => $request->email_address,
                'purpose' => $request->purpose,
                'workflow_status' => 'draft',
                'current_step' => 1,
            ]);

            foreach ($request->items as $item) {
                InventoryQuotationItem::create([
                    'inventory_quotation_id' => $quotation->id,
                    'item_name' => $item['item_name'],
                    'category' => $item['category'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'price' => $item['price'] ?? 0,
                ]);
            }
        });

        return redirect()->route('inventory.quotation.index')->with('success', 'Quotation created successfully.');
    }

    public function show($id)
    {
        $quotation = InventoryQuotation::with('items')->findOrFail($id);
        return view('backend.pages.inventory.quotation.show', compact('quotation'));
    }
}
