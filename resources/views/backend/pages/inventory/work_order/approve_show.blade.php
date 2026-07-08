@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryWorkOrderApproveList'])

@section('title', 'Approved Work Order Details')

@push('style')
    <style>
        .work_order-show-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 10px 24px rgba(23, 50, 77, 0.08);
        }

        .work_order-show-card .card-header {
            background: #17a2b8;
            color: #fff;
        }

        .info-label {
            color: #526579;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .info-value {
            color: #17324d;
            font-size: 15px;
            font-weight: 600;
        }

        .print-title {
            display: none;
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .no-print,
            .breadcrumb,
            .btn {
                display: none !important;
            }

            body {
                background: #fff !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .work_order-show-card,
            .card {
                border: 1px solid #d7dfea !important;
                box-shadow: none !important;
            }

            .work_order-show-card .card-header {
                background: #fff !important;
                color: #000 !important;
                border-bottom: 1px solid #d7dfea !important;
            }

            .print-title {
                display: block;
                text-align: center;
                margin-bottom: 16px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="print-title">
                <h3 class="mb-1">Inventory Work Order</h3>
                <div>{{ $workOrder->work_order_no }}</div>
            </div>


            <div class="card work_order-show-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0" style="font-size:24px; font-weight:600;">Inventory Work Order</h3>
                        <div class="no-print">
                            <button type="button" class="btn btn-light btn-sm" onclick="window.print()">
                                <i class="fas fa-print mr-1"></i> Print
                            </button>
                            <a href="{{ route('inventory.work-order.approve_list') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Work Order No</div>
                            <div class="info-value">{{ $workOrder->work_order_no }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Work Order Date</div>
                            <div class="info-value">{{ optional($workOrder->application_date)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Assigned Vendor</div>
                            <div class="info-value">
                                @if($workOrder->vendor)
                                    <strong>{{ $workOrder->vendor->name }}</strong><br>
                                    <small>{{ $workOrder->vendor->contact_number }}</small>
                                @else
                                    <span class="text-muted">Not Assigned</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">WO Validity Date</div>
                            <div class="info-value">{{ optional($workOrder->validity_date)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">WO Estimate Delivery Date</div>
                            <div class="info-value">{{ optional($workOrder->delivery_date)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="info-label">Included Requisitions</div>
                            <div class="info-value">
                                @forelse($workOrder->requisitions as $req)
                                    <a href="{{ route('inventory.show', $req->id) }}" class="badge badge-info p-2 mr-1">{{ $req->requisition_no }}</a>
                                @empty
                                    -
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="info-label">Included Quotations</div>
                            <div class="info-value">
                                @if(isset($quotations) && $quotations->count() > 0)
                                    @foreach($quotations as $quotation)
                                        <a href="{{ route('inventory.quotation.show', $quotation->id) }}" target="_blank" class="badge badge-primary p-2 mr-1">{{ $quotation->quotation_no }}</a>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('inventory.work-order.update_approved') }}" method="POST">
                        @csrf
                        <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="white-space: nowrap; width: 1%;">Sl.</th>
                                    <th style="white-space: nowrap; width: 1%;">Category</th>
                                    <th style="white-space: nowrap; width: 1%;">Item Name</th>
                                    <th style="white-space: nowrap; width: 1%;">Unit</th>
                                    <th style="white-space: nowrap; width: 1%;">Req Qty</th>
                                    <th style="white-space: nowrap; width: 1%;">Purchase Qty</th>
                                    <th style="white-space: nowrap; width: 1%;">Price</th>
                                    <th style="white-space: nowrap; width: 1%;">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workOrder->items as $key => $item)
                                    <tr id="item-row-{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->category ?? '-' }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="text-primary view-sources-btn" data-sources="{{ $item->remarks ?? '[]' }}" data-name="{{ $item->item_name }}">
                                                {{ $item->item_name }} <i class="fas fa-info-circle ml-1"></i>
                                            </a>
                                        </td>
                                        <td>{{ $item->unit ?? '-' }}</td>
                                        <td>{{ (float) $item->required_quantity }}</td>
                                        <td>
                                            <input type="number" name="purchase_quantities[{{ $item->id }}]" class="form-control form-control-sm text-right purchase-qty-input" data-required="{{ $item->required_quantity }}" value="{{ (float) $item->purchase_quantity }}" min="0" step="0.01">
                                        </td>
                                        @php
                                            $itemName = strtolower(trim($item->item_name));
                                            $lowestPrice = $lowestPrices[$itemName] ?? 0;
                                            $currentPrice = $item->price > 0 ? $item->price : $lowestPrice;
                                        @endphp
                                        <td class="text-right align-middle" style="white-space: nowrap; width: 1%;">
                                            <input type="number" name="prices[{{ $item->id }}]" class="form-control form-control-sm text-right price-input" value="{{ (float) $currentPrice }}" min="0" step="0.01" style="width: 100px;">
                                        </td>
                                        <td class="text-right align-middle total-amount-calc" style="white-space: nowrap; width: 1%; font-weight: bold;">
                                            {{ number_format((float)$item->purchase_quantity * (float)$currentPrice, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No item found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#assignVendorModal">
                            <i class="fas fa-truck mr-1"></i> Assign to Vendor
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Work Order
                        </button>
                    </div>
                    </form>
                </div>
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

<!-- Modal for Assigning Vendor -->
<div class="modal fade" id="assignVendorModal" tabindex="-1" role="dialog" aria-labelledby="assignVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignVendorModalLabel">Assign Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('inventory.work-order.assign_vendor', $workOrder->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
                <label>Select Vendor <span class="text-danger">*</span></label>
                <select name="inventory_vendor_id" class="form-control" required>
                    <option value="">-- Select Vendor --</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ $workOrder->inventory_vendor_id == $vendor->id ? 'selected' : '' }}>
                            {{ $vendor->name }} ({{ $vendor->contact_number }})
                        </option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info">Assign</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.remove-item-btn').click(function() {
            let itemId = $(this).data('id');
            if (confirm('Are you sure you want to remove this item from the work order?')) {
                // Add hidden input to form so the backend knows to delete it
                $('<input>').attr({
                    type: 'hidden',
                    name: 'deleted_items[]',
                    value: itemId
                }).appendTo('form');
                
                // Remove the row from the table
                $('#item-row-' + itemId).remove();
            }
        });

        // Calculate additional quantity on input change
        $(document).on('input', '.purchase-qty-input', function() {
            let reqQty = parseFloat($(this).data('required')) || 0;
            let purQty = parseFloat($(this).val()) || 0;
            let additional = reqQty - purQty;
            
            let additionalText = Number.isInteger(additional) ? additional : additional.toFixed(2);
            $(this).closest('tr').find('.additional-calc').text(additionalText);
        });

        // Handle viewing item sources
        $(document).on('click', '.view-sources-btn', function() {
            let name = $(this).data('name');
            let sourcesStr = $(this).attr('data-sources');
            let sources = [];
            
            try {
                sources = JSON.parse(sourcesStr);
            } catch (e) {
                console.error("Could not parse sources JSON", e);
            }

            $('#itemSourcesModalLabel').text('Sources for: ' + name);
            let tbody = $('#itemSourcesTbody');
            tbody.empty();

            if (sources && sources.length > 0) {
                sources.forEach(src => {
                    tbody.append(`
                        <tr>
                            <td>${src.requisition_no}</td>
                            <td>${src.qty}</td>
                        </tr>
                    `);
                });
            } else {
                tbody.append('<tr><td colspan="2" class="text-center text-muted">No sources recorded</td></tr>');
            }

            $('#itemSourcesModal').modal('show');
        });

        // Dynamic calculation of Total Amount
        $('.purchase-qty-input, .price-input').on('input', function() {
            var $row = $(this).closest('tr');
            var qty = parseFloat($row.find('.purchase-qty-input').val()) || 0;
            var price = parseFloat($row.find('.price-input').val()) || 0;
            var total = qty * price;
            $row.find('.total-amount-calc').text(total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        });
    });
</script>
@endpush
