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


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Vehicle Information</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('vehicle.create')}}" class="btn btn-primary">Create</a>
                                    <a href="{{route('vehicle.index')}}" class="btn btn-primary">List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
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

                                <div class="col-md-2">
                                    <input type="text" id="search_owner" class="form-control form-control-sm" placeholder="Owner ID/Name">
                                </div>

                                <div class="col-md-2">
                                    <select id="search_ownership" class="form-control form-control-sm">
                                        <option value="">All Ownership</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Institutional">Institutional</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search">
                                </div>
                            </div>

                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Vehicle Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Model</th>
                                    <th>Owner Id & Name</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if (isset($vehicles) && count($vehicles))
                                    @foreach ($vehicles as $key => $vehicle)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $vehicle->vehicle_model ?? '--' }}</td>
                                            <td>{{ $vehicle->vehicle_type ?? '--' }}</td>
                                            <td>{{ $vehicle->vehicle_category ?? '--' }}</td>
                                            <td>{{ $vehicle->make_company ?? '--' }}{{ $vehicle->make_year ? ' (' . $vehicle->make_year . ')' : '' }}</td>
                                            <td>
                                                {{ $vehicle->owner_id ?? '--' }}
                                                @php
                                                    $ownerDisplayName = $vehicle->ownership_type === 'institutional'
                                                        ? ($vehicle->institutional_name ?? $vehicle->owner_name)
                                                        : $vehicle->owner_name;
                                                @endphp
                                                {{ $ownerDisplayName ? ' - ' . $ownerDisplayName : '' }}
                                                <span class="d-none ownership-token">{{ ucfirst($vehicle->ownership_type ?? '') }}</span>
                                            </td>
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
                          <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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

        $('#search_owner').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        $('#search_ownership').change(function() {
            table.column(5).search(this.value).draw();
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
