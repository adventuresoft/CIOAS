@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryWorkOrderCreate'])

@section('title', 'Add New Work Order')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Work Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.work-order.index') }}">Work Order</a></li>
                    <li class="breadcrumb-item active">Add New</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Work Order (Aggregated)</h3>
            </div>
            <form action="{{ route('inventory.work-order.store') }}" method="POST" id="workOrderForm">
                @csrf
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold">Work Order No</label>
                            <input type="text" class="form-control" value="Auto Generated" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold">Work Order Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="application_date" value="{{ old('application_date', now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold">WO Validity Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="validity_date" value="{{ old('validity_date') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold">WO Estimate Delivery Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="delivery_date" value="{{ old('delivery_date') }}" required>
                        </div>
                    </div>

                    @if($approvedRequisitions->isEmpty())
                        <div class="alert alert-warning mt-3">
                            There are no Approved Requisitions available to create a Work Order.
                        </div>
                    @else
                        @php
                            $uniqueMonths = $approvedRequisitions->map(function($req) {
                                return \Carbon\Carbon::parse($req->application_date)->format('F Y');
                            })->unique()->implode(', ');
                        @endphp
                        
                        <div class="d-none">
                            <h5 class="mt-4 mb-3 font-weight-bold text-secondary">Approved Requisitions Source Details</h5>
                            <div class="row">
                                @foreach($approvedRequisitions as $req)
                                    <div class="col-md-12 mb-4">
                                        <div class="card bg-light">
                                            <div class="card-header py-2">
                                                <strong>Requisition No:</strong> 
                                                <a href="{{ route('inventory.show', $req->id) }}" target="_blank">{{ $req->requisition_no }}</a> 
                                                <span class="text-muted ml-2">({{ $req->department_name }})</span>
                                                <span class="badge badge-secondary ml-2">{{ \Carbon\Carbon::parse($req->application_date)->format('F Y') }}</span>
                                            </div>
                                            <div class="card-body p-0">
                                                <table class="table table-sm table-bordered mb-0 bg-white">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Type</th>
                                                            <th>Category</th>
                                                            <th>Item Name</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($req->items as $item)
                                                            <tr>
                                                                <td>{{ $item->product_type }}</td>
                                                                <td>{{ $item->category }}</td>
                                                                <td>{{ $item->item_name }}</td>
                                                                <td>{{ $item->unit }}</td>
                                                                <td>{{ (float) ($item->approved_quantity ?: $item->required_quantity) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3 font-weight-bold text-primary">Consolidated Inventory Item Details <span class="text-dark" style="font-size: 16px;">({{ $uniqueMonths }})</span></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="itemsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 40px;" class="text-center">
                                            <input type="checkbox" id="selectAllItems">
                                        </th>
                                        <th style="width: 40px;">SL</th>
                                        <th style="width: 15%;">Product Type</th>
                                        <th style="width: 15%;">Category</th>
                                        <th>Item Name</th>
                                        <th style="width: 8%;">Unit</th>
                                        <th style="width: 10%;">Req Qty</th>
                                        <th style="width: 12%;">Purchase Qty</th>
                                        <th style="width: 10%;">Additional</th>
                                        <th style="width: 8%;">Stock</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsTbody">
                                    <!-- Populated by JS -->
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right mt-2">
                            <button type="button" class="btn btn-sm btn-success" id="addManualItemBtn">
                                <i class="fas fa-plus"></i> Add more
                            </button>
                        </div>
                    @endif

                    <!-- Hidden Inputs for Form Submission -->
                    <input type="hidden" name="requisition_ids" id="requisition_ids" value="{{ json_encode($approvedRequisitions->pluck('id')) }}">
                    <input type="hidden" name="items_payload" id="items_payload">

                </div>
                <div class="card-footer text-right">
                    @if($approvedRequisitions->isNotEmpty())
                        <button type="submit" class="btn btn-primary" id="btnSubmit">
                            <i class="fas fa-save mr-1"></i> Draft
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal for Item Requisition Sources -->
<div class="modal fade" id="itemSourcesModal" tabindex="-1" role="dialog" aria-labelledby="itemSourcesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="itemSourcesModalLabel">Item Sources</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Requisition No</th>
                    <th>Qty</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody id="itemSourcesTbody">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        const rawRequisitions = @json($approvedRequisitions);
        const stockData = @json($stockQuantities ?? []);
        let consolidatedItems = [];

        function consolidateItems() {
            let map = new Map();

            rawRequisitions.forEach(req => {
                req.items.forEach(item => {
                    // Create a unique key for grouping (using item_name, category, and unit)
                    let key = `${item.item_name}_${item.product_type || ''}_${item.category || ''}_${item.unit || ''}`.toLowerCase();
                    let qty = parseFloat(item.approved_quantity || item.required_quantity) || 0;

                    if (map.has(key)) {
                        let existing = map.get(key);
                        existing.required_quantity += qty;
                        existing.purchase_quantity += qty;
                        existing.sources.push({
                            requisition_no: req.requisition_no,
                            qty: qty
                        });
                    } else {
                        map.set(key, {
                            item_name: item.item_name,
                            product_type: item.product_type,
                            category: item.category,
                            unit: item.unit,
                            required_quantity: qty,
                            purchase_quantity: qty,
                            sources: [{
                                requisition_no: req.requisition_no,
                                qty: qty
                            }],
                            is_selected: false
                        });
                    }
                });
            });

            consolidatedItems = Array.from(map.values());
            renderTable();
        }

        function renderTable() {
            let tbody = $('#itemsTbody');
            tbody.empty();

            if (consolidatedItems.length === 0) {
                tbody.html('<tr><td colspan="8" class="text-center text-muted">No items available.</td></tr>');
                $('#btnSubmit').prop('disabled', true);
                return;
            } else {
                $('#btnSubmit').prop('disabled', false);
            }

            consolidatedItems.forEach(function(item, index) {
                let additional = (parseFloat(item.purchase_quantity) || 0) - (parseFloat(item.required_quantity) || 0);
                let additionalText = parseFloat(additional.toFixed(2));
                let currentStock = parseFloat(stockData[item.item_name] || 0);
                
                let additionalClass = '';
                if (additionalText > 0) additionalClass = 'text-success';
                else if (additionalText < 0) additionalClass = 'text-danger';
                
                let tr = `
                    <tr>
                        <td class="text-center align-middle">
                            <input type="checkbox" class="item-select-checkbox" data-index="${index}" ${item.is_selected ? 'checked' : ''}>
                        </td>
                        <td class="align-middle">${index + 1}</td>
                        <td class="align-middle">
                            ${item.is_manual ? `<select class="form-control form-control-sm manual-input" data-field="product_type" data-index="${index}">
                                <option value="">Select Type</option>
                                <option value="One time use" ${item.product_type === 'One time use' ? 'selected' : ''}>One time use</option>
                                <option value="All time use" ${item.product_type === 'All time use' ? 'selected' : ''}>All time use</option>
                            </select>` : (item.product_type || '-')}
                        </td>
                        <td class="align-middle">
                            ${item.is_manual ? `<select class="form-control form-control-sm manual-input" data-field="category" data-index="${index}">
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" ${item.category === '{{ $cat }}' ? 'selected' : ''}>{{ $cat }}</option>
                                @endforeach
                            </select>` : (item.category || '-')}
                        </td>
                        <td class="align-middle">
                            ${item.is_manual ? `<input type="text" class="form-control form-control-sm manual-input" data-field="item_name" data-index="${index}" value="${item.item_name || ''}" placeholder="Item Name">` : 
                                `<a href="javascript:void(0)" class="text-primary view-sources-btn" data-index="${index}">
                                    ${item.item_name} <i class="fas fa-info-circle ml-1"></i>
                                </a>`
                            }
                        </td>
                        <td class="align-middle">
                            ${item.is_manual ? `<select class="form-control form-control-sm manual-input" data-field="unit" data-index="${index}">
                                <option value="">Select Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit }}" ${item.unit === '{{ $unit }}' ? 'selected' : ''}>{{ $unit }}</option>
                                @endforeach
                            </select>` : (item.unit || '-')}
                        </td>
                        <td class="align-middle">
                            ${item.is_manual ? `<input type="number" class="form-control form-control-sm manual-input" data-field="required_quantity" data-index="${index}" value="${parseFloat(item.required_quantity)}" min="0" step="0.01">` : parseFloat(item.required_quantity)}
                        </td>
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm purchase-qty-input" data-index="${index}" value="${parseFloat(item.purchase_quantity)}" min="0" step="0.01">
                        </td>
                        <td class="additional-calc text-center align-middle font-weight-bold ${additionalClass}">${additionalText}</td>
                        <td class="align-middle font-weight-bold text-info stock-calc">${currentStock}</td>
                    </tr>
                `;
                tbody.append(tr);
            });
            
            // Check if all are selected to maintain state of selectAllItems
            let allSelected = consolidatedItems.length > 0 && consolidatedItems.every(item => item.is_selected);
            $('#selectAllItems').prop('checked', allSelected);

            updatePayload();
        }

        $('#addManualItemBtn').click(function() {
            consolidatedItems.push({
                item_name: '',
                product_type: '',
                category: '',
                unit: '',
                required_quantity: 0,
                purchase_quantity: 0,
                sources: [],
                is_manual: true,
                is_selected: false
            });
            renderTable();
        });

        $(document).on('change', '.item-select-checkbox', function() {
            let index = $(this).data('index');
            consolidatedItems[index].is_selected = $(this).is(':checked');
            updatePayload();
            
            // Update Select All checkbox state
            let allSelected = consolidatedItems.length > 0 && consolidatedItems.every(item => item.is_selected);
            $('#selectAllItems').prop('checked', allSelected);
        });

        $(document).on('change', '#selectAllItems', function() {
            let isChecked = $(this).is(':checked');
            $('.item-select-checkbox').prop('checked', isChecked);
            consolidatedItems.forEach(item => {
                item.is_selected = isChecked;
            });
            updatePayload();
        });

        $(document).on('click', '.remove-manual-btn', function() {
            let index = $(this).data('index');
            consolidatedItems.splice(index, 1);
            renderTable();
        });

        $(document).on('input', '.manual-input', function() {
            let index = $(this).data('index');
            let field = $(this).data('field');
            let val = $(this).val();
            
            if (field === 'required_quantity') val = parseFloat(val) || 0;
            
            consolidatedItems[index][field] = val;

            if (field === 'item_name') {
                let currentStock = parseFloat(stockData[val] || 0);
                $(this).closest('tr').find('.stock-calc').text(currentStock);
            }
            
            if (field === 'required_quantity') {
                let purQty = consolidatedItems[index].purchase_quantity;
                let additional = purQty - val;
                let additionalText = parseFloat(additional.toFixed(2));
                
                let td = $(this).closest('tr').find('.additional-calc');
                td.text(additionalText);
                td.removeClass('text-success text-danger');
                if (additionalText > 0) td.addClass('text-success');
                else if (additionalText < 0) td.addClass('text-danger');
            }
            updatePayload();
        });

        $(document).on('input', '.purchase-qty-input', function() {
            let index = $(this).data('index');
            let val = parseFloat($(this).val()) || 0;
            
            consolidatedItems[index].purchase_quantity = val;
            
            let reqQty = consolidatedItems[index].required_quantity;
            let additional = val - reqQty;
            
            let additionalText = Number(additional.toFixed(2));
            let td = $(this).closest('tr').find('.additional-calc');
            td.text(additionalText);
            td.removeClass('text-success text-danger');
            if (additionalText > 0) td.addClass('text-success');
            else if (additionalText < 0) td.addClass('text-danger');
            
            updatePayload();
        });

        $(document).on('click', '.view-sources-btn', function() {
            let index = $(this).data('index');
            let item = consolidatedItems[index];
            
            $('#itemSourcesModalLabel').text('Sources for: ' + item.item_name);
            let tbody = $('#itemSourcesTbody');
            tbody.empty();

            item.sources.forEach(src => {
                tbody.append(`
                    <tr>
                        <td>${src.requisition_no}</td>
                        <td>${src.qty}</td>
                        <td>${item.unit}</td>
                    </tr>
                `);
            });

            $('#itemSourcesModal').modal('show');
        });

        function updatePayload() {
            let selectedItems = consolidatedItems.filter(item => item.is_selected);
            $('#items_payload').val(JSON.stringify(selectedItems));
            
            if (selectedItems.length === 0) {
                $('#btnSubmit').prop('disabled', true);
            } else {
                $('#btnSubmit').prop('disabled', false);
            }
        }

        // Initialize consolidation
        if (rawRequisitions.length > 0) {
            consolidateItems();
        }
    });
</script>
@endpush