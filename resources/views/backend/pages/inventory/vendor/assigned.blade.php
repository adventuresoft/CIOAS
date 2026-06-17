@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryVendorAssigned'])

@section('title', 'Assigned Vendors')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Assigned Vendors</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Assigned Vendors</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Work Orders with Assigned Vendors</h3>
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
                                <th>Total Items</th>
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
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $workOrder->items->count() }}</span>
                                </td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('inventory.vendors.assigned_show', $workOrder->id) }}" class="btn btn-primary btn-sm" title="View Work Order">
                                        <i class="fas fa-eye mr-1"></i> View Order
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No assigned vendors found.</td>
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
