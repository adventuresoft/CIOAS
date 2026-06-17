@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryVendorList'])

@section('title', 'Vendor Details')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vendor Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.vendors.index') }}">Vendor List</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Vendor Information</h3>
                <div class="card-tools">
                    <a href="{{ route('inventory.vendors.index') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 25%">Name</th>
                            <td>{{ $vendor->name }}</td>
                        </tr>
                        <tr>
                            <th>Name (Bangla)</th>
                            <td>{{ $vendor->name_bn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Trade License Number</th>
                            <td>{{ $vendor->trade_license }}</td>
                        </tr>
                        <tr>
                            <th>TIN Number</th>
                            <td>{{ $vendor->tin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>BIN Number</th>
                            <td>{{ $vendor->bin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $vendor->contact_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $vendor->email }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $vendor->address }}</td>
                        </tr>
                        <tr>
                            <th>Bank A/C Number</th>
                            <td>{{ $vendor->bank_ac_number }}</td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{ $vendor->bank_name }}</td>
                        </tr>
                        <tr>
                            <th>Branch</th>
                            <td>{{ $vendor->branch }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
