@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryVendorList'])

@section('title', 'Vendor List')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vendor List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Vendor List</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Vendors</h3>
                <div class="card-tools">
                    <a href="{{ route('inventory.vendors.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Create New Vendor
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%">Sl.</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Trade License</th>
                                <th>Address</th>
                                <th style="width: 1%; white-space: nowrap;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendors as $key => $vendor)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->contact_number }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->trade_license }}</td>
                                <td>{{ Str::limit($vendor->address, 50) }}</td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('inventory.vendors.show', $vendor->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No vendors found.</td>
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
