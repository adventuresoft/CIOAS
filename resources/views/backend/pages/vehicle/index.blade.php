@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleList'])
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
@section('title', 'Vehicle List')
@section('content')


    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="cioas-panel-title"><i class="fas fa-car"></i> Vehicle Information</h3>
                        <div>
                            <a href="{{route('vehicle.create')}}" class="btn btn-material btn-material-primary"><i class="fas fa-plus"></i> Create</a>
                        </div>
                    </div>

                    <div class="cioas-panel-body">
                        <!-- FILTER BAR -->
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
                                <input type="text" id="search_vehicle_name" class="form-control form-control-sm" placeholder="Vehicle Name">
                            </div>

                            <div class="col-md-2">
                                <input type="text" id="search_type" class="form-control form-control-sm" placeholder="Vehicle Type">
                            </div>

                            <div class="col-md-3">
                                <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Registration No</th>
                                        <th>Vehicle Name</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Model</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($vehicles) && count($vehicles))
                                        @foreach ($vehicles as $key => $vehicle)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $vehicle->registration_no ?? '--' }}</td>
                                                <td>{{ $vehicle->vehicle_model ?? '--' }}</td>
                                                <td>{{ $vehicle->vehicle_type ?? '--' }}</td>
                                                <td>{{ $vehicle->vehicle_category ?? '--' }}</td>
                                                <td>{{ $vehicle->make_company ?? '--' }}{{ $vehicle->make_year ? ' (' . $vehicle->make_year . ')' : '' }}</td>
                                                <td>
                                                    <div class="table-action">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('vehicle.edit', $vehicle->id) }}" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-info" href="{{ route('vehicle.show', $vehicle->id) }}" title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
<script>
    $(function() {
        let table = $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthChange: false,
            order: [[0, 'asc']],
            columnDefs: [
                { targets: 6, orderable: false }
            ]
        });

        $('#search_vehicle_name').keyup(function() {
            table.column(1).search(this.value).draw();
        });

        $('#search_type').keyup(function() {
            table.column(2).search(this.value).draw();
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
