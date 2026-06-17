@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryPurchaseOrderList'])

@section('title', 'Receive Points')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Receive Points</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Receive Points</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Assigned Work Orders for Receiving</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%">Sl.</th>
                                <th>Work Order Info</th>
                                <th>Assigned Vendor</th>
                                <th>Vendor Contact</th>
                                <th>Chalan Number</th>
                                <th>Invoice Number</th>
                                <th>Status</th>
                                <th style="width: 1%; white-space: nowrap;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workOrders as $key => $workOrder)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $workOrder->work_order_no }}<br>
                                    <small class="text-muted"><i class="far fa-calendar-alt"></i> {{ optional($workOrder->application_date)->format('d-m-Y') }}</small>
                                </td>
                                <td>
                                    <strong>{{ optional($workOrder->vendor)->name }}</strong>
                                </td>
                                <td>{{ optional($workOrder->vendor)->contact_number }}</td>
                                <td>{{ $workOrder->chalan_no ?? '-' }}</td>
                                <td>{{ $workOrder->invoice_no ?? '-' }}</td>
                                <td>
                                    @if($workOrder->purchaseOrder)
                                        <span class="badge badge-success">Received</span>
                                    @else
                                        <span class="badge badge-warning">Pending Receive</span>
                                    @endif
                                </td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('inventory.purchase_orders.create', $workOrder->id) }}" class="btn btn-info btn-sm" title="Show Receive Order Details">
                                        <i class="fas fa-eye mr-1"></i> Show
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No assigned work orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
