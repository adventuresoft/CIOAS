@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleList'])
@push('style')
<style>
    .table-action {
        display: flex;
        gap: 6px;
    }
</style>
@endpush
@section('title', 'Vehicle List')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Vehicle List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('vehicle.index')}}">Vehicle List</a></li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Vehicle List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('vehicle.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
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
@endpush
