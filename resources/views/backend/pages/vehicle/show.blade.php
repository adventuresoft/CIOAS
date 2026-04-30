@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleList'])
@push('style')
<style>
    .vehicle-id {
        font-weight: 700;
        font-size: 15px;
    }
</style>
@endpush
@section('title', 'Vehicle Details')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vehicle Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle List</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Vehicle Information</h3>
                            </div>
                            <div class="col-md-5 text-right">
                                <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit mr-1"></i> Edit
                                </a>
                                <a href="{{ route('vehicle.index') }}" class="btn btn-info">
                                    <i class="fa fa-list mr-1"></i> List
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <span class="vehicle-id">Vehicle ID: #{{ $vehicle->id }}</span>
                        </div>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="25%">Vehicle Type</th>
                                    <td width="25%">{{ $vehicle->vehicle_type ?? '--' }}</td>
                                    <th width="25%">Vehicle Category</th>
                                    <td width="25%">{{ $vehicle->vehicle_category ?? '--' }}</td>
                                </tr>
                                <tr>
                                    <th>Vehicle Model</th>
                                    <td>{{ $vehicle->vehicle_model ?? '--' }}</td>
                                    <th>Make Year</th>
                                    <td>{{ $vehicle->make_year ?? '--' }}</td>
                                </tr>
                                <tr>
                                    <th>Make Company</th>
                                    <td>{{ $vehicle->make_company ?? '--' }}</td>
                                    <th>Ownership Type</th>
                                    <td>{{ $vehicle->ownership_type ? ucfirst($vehicle->ownership_type) : '--' }}</td>
                                </tr>
                                <tr>
                                    <th>Owner ID</th>
                                    <td>{{ $vehicle->owner_id ?? '--' }}</td>
                                    <th>Owner Name</th>
                                    <td>{{ $vehicle->owner_name ?? '--' }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ isset($vehicle->price) ? number_format((float) $vehicle->price, 2) : '--' }}</td>
                                    <th>Created At</th>
                                    <td>{{ $vehicle->created_at ? $vehicle->created_at->format('d-m-Y h:i A') : '--' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $vehicle->updated_at ? $vehicle->updated_at->format('d-m-Y h:i A') : '--' }}</td>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
@endpush
