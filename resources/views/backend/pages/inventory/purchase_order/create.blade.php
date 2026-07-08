@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryPurchaseOrderList'])

@section('title', 'Receive Order Details')

@section('content')
<section class="content">
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('inventory.purchase_orders.store', $workOrder->id) }}" method="POST">
            @csrf
            
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Receive Order Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Work Order Number</div>
                            <div class="info-value text-primary">
                                <strong>{{ $workOrder->work_order_no }}</strong>
                                <input type="hidden" name="po_number" value="{{ $workOrder->purchaseOrder->po_number ?? $provisionalPoNumber }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Chalan Number</div>
                            <div class="info-value">{{ $workOrder->chalan_no ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Invoice Number</div>
                            <div class="info-value">{{ $workOrder->invoice_no ?? 'N/A' }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Vendor Details</div>
                            <div class="info-value">
                                @if($workOrder->vendor)
                                    <strong>{{ $workOrder->vendor->name }}</strong><br>
                                    <small><i class="fas fa-phone mr-1"></i> {{ $workOrder->vendor->contact_number }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
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
                    </div>
                </div>
            </div>

            <div class="card card-default mt-3">
                <div class="card-header">
                    <h3 class="card-title">Inventory Receive Order Items</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="po-items-table">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 1%">SL</th>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <th class="text-center" style="width: 10%">Order Qty</th>
                                    <th class="text-center" style="width: 12%">Receive Qty</th>
                                    <th class="text-center" style="width: 10%">Balance</th>
                                    <th style="width: 20%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workOrder->items as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td class="text-center align-middle">
                                            <span class="order-qty">{{ (float) $item->purchase_quantity }}</span>
                                        </td>
                                        <td>
                                            <input type="number" 
                                                   name="items[{{ $item->id }}][receive_quantity]" 
                                                   class="form-control text-center receive-qty" 
                                                   step="0.01" min="0" 
                                                   value="{{ old('items.'.$item->id.'.receive_quantity', (float) $item->receive_quantity) }}">
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="balance-qty font-weight-bold">
                                                {{ (float) $item->purchase_quantity - (float) $item->receive_quantity }}
                                            </span>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="items[{{ $item->id }}][po_remarks]" 
                                                   class="form-control" 
                                                   placeholder="Enter remarks..."
                                                   value="{{ old('items.'.$item->id.'.po_remarks', $item->po_remarks) }}">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No items found for this work order.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('inventory.purchase_orders.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                    @if($workOrder->workflow_status === 'received')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Details
                        </button>
                    @else
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-box-open mr-1"></i> Send To Stock
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

<style>
    .info-label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .info-value {
        font-size: 15px;
        color: #343a40;
    }
</style>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Auto calculate balance when receive quantity changes
        $('.receive-qty').on('input', function() {
            var row = $(this).closest('tr');
            var orderQty = parseFloat(row.find('.order-qty').text()) || 0;
            var receiveQty = parseFloat($(this).val()) || 0;
            var balance = orderQty - receiveQty;
            
            // Format balance to max 2 decimal places and update text
            row.find('.balance-qty').text(parseFloat(balance.toFixed(2)));
            
            // Optional: color code balance
            if(balance < 0) {
                row.find('.balance-qty').css('color', 'red');
            } else if (balance == 0) {
                row.find('.balance-qty').css('color', 'green');
            } else {
                row.find('.balance-qty').css('color', 'inherit');
            }
        });
    });
</script>
@endpush
