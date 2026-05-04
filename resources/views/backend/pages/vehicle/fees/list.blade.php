@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleAddFeesList'])
@push('style')
<style>
    .table-action {
        display: flex;
        gap: 6px;
    }

    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    .row.mb-3 select {
        height: 32px;
        font-size: 13px;
    }

    .dataTables_filter {
        display: none;
    }
</style>
@endpush
@section('title', 'Vehicle Fees Setup List')
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(empty($feesTableReady))
            <div class="alert alert-warning mt-3">
                <strong>Setup required:</strong> `vehicle_fees` table not found. Run <code>php artisan migrate</code> and refresh this page.
            </div>
        @endif

        <div class="card card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                        <h3 class="card-title">Vehicle Fees Setup List</h3>
                    </div>
                    <div class="col-md-5 text-right">
                        <a href="{{ route('vehicle.fees.vehicle') }}" class="btn btn-primary">New Setup Fees</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-3 align-items-center g-2">
                    <div class="col-md-1">
                        <select id="tableLength" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input type="text" id="search_finance_year" class="form-control form-control-sm" placeholder="Finance Year">
                    </div>

                    <div class="col-md-2">
                        <input type="text" id="search_vehicle_type" class="form-control form-control-sm" placeholder="Vehicle Type">
                    </div>

                    <div class="col-md-2">
                        <input type="text" id="search_vehicle_category" class="form-control form-control-sm" placeholder="Vehicle Category">
                    </div>

                    <div class="col-md-2">
                        <select id="search_fee_for" class="form-control form-control-sm">
                            <option value="">All Setup Type</option>
                            <option value="New">New</option>
                            <option value="Renew">Renew</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                    </div>
                </div>

                <div class="table-responsive">
                <table id="vehicleFeesSetupTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Finance Year</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Category</th>
                            <th>New/Renew</th>
                            <th>Registration</th>
                            <th>Road</th>
                            <th>Fitness</th>
                            <th>VAT</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicleFees as $key => $fee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $fee->finance_year }}</td>
                                <td>{{ $fee->vehicle_type }}</td>
                                <td>{{ $fee->vehicle_category }}</td>
                                <td>{{ ucfirst($fee->fee_for) }}</td>
                                <td>{{ number_format((float) $fee->registration_fee, 2) }}</td>
                                <td>{{ number_format((float) $fee->road_fee, 2) }}</td>
                                <td>{{ number_format((float) $fee->fitness_fee, 2) }}</td>
                                <td>{{ number_format((float) $fee->vat_fee, 2) }}</td>
                                <td>{{ number_format((float) $fee->tax_fee, 2) }}</td>
                                <td>{{ number_format((float) $fee->total_fee, 2) }}</td>
                                <td>
                                    <div class="table-action">
                                        <a class="btn btn-sm btn-primary" href="{{ route('vehicle.fees.edit', $fee->id) }}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-info" href="{{ route('vehicle.fees.show', $fee->id) }}" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No setup found.</td>
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

@push('script')
<script>
$(function() {
    let table = $('#vehicleFeesSetupTable').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthChange: false,
        order: [[0, 'asc']],
        columnDefs: [
            { targets: 11, orderable: false }
        ]
    });

    $('#search_finance_year').keyup(function() {
        table.column(1).search(this.value).draw();
    });

    $('#search_vehicle_type').keyup(function() {
        table.column(2).search(this.value).draw();
    });

    $('#search_vehicle_category').keyup(function() {
        table.column(3).search(this.value).draw();
    });

    $('#search_fee_for').change(function() {
        table.column(4).search(this.value).draw();
    });

    $('#search_global').keyup(function() {
        table.search(this.value).draw();
    });

    $('#tableLength').change(function() {
        table.page.len($(this).val()).draw();
    });
});
</script>
@endpush
