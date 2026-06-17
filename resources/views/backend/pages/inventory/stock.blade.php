@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryStock'])

@section('title', 'Stock Details')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-7">
                    <h1 class="mb-1">Stock Details</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.requisition.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Stock</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title" style="font-size:24px; font-weight:600;">Stock Details</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Work Order No</th>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Stock Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($stockItems as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->work_order_nos ?: '-' }}</td>
                                        <td>{{ $item->category ?: '-' }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit ?: '-' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->stock_status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No stock item found.</td>
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
