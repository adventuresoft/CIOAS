@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryVendorAssigned'])

@section('title', 'Assigned Work Order Details')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assigned Work Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.vendors.assigned') }}">Assigned Vendors</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Chalan and Invoice Information -->
            <div class="row">
                <div class="col-12">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-info"><i class="fas fa-file-invoice"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Chalan & Invoice Details</span>
                            <div class="d-flex mt-2">
                                <div class="mr-5">
                                    <h5 class="mb-0 text-secondary">Chalan Number</h5>
                                    <strong>{{ $workOrder->chalan_no ?? 'N/A' }}</strong>
                                </div>
                                <div>
                                    <h5 class="mb-0 text-secondary">Invoice Number</h5>
                                    <strong>{{ $workOrder->invoice_no ?? 'N/A' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card work_order-show-card mt-2">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0" style="font-size:24px; font-weight:600;">Inventory Work Order</h3>
                        <div class="no-print">
                            <button type="button" class="btn btn-light btn-sm" onclick="window.print()">
                                <i class="fas fa-print mr-1"></i> Print
                            </button>
                            <a href="{{ route('inventory.vendors.assigned') }}" class="btn btn-light btn-sm">
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

                    </div>

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
                                @forelse ($items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->category ?? '-' }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit ?? '-' }}</td>
                                        <td>{{ (float) $item->required_quantity }}</td>
                                        <td>{{ (float) $item->purchase_quantity }}</td>
                                        <td class="text-right">
                                            {{ number_format((float) $item->price, 2) }}
                                        </td>
                                        <td class="text-right" style="font-weight: bold;">
                                            {{ number_format((float)$item->purchase_quantity * (float)$item->price, 2) }}
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
                </div>
            </div>
        </div>
    </section>

    <style>
        .work_order-show-card {
            border-top: 3px solid #007bff;
        }
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
            font-weight: 500;
        }
        @media print {
            .no-print { display: none !important; }
            .content-header { display: none !important; }
            .main-footer { display: none !important; }
            .work_order-show-card { border-top: none !important; box-shadow: none !important; }
            body { background-color: #fff !important; }
        }
    </style>
@endsection
