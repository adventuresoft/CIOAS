@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'VehicleSubcategory'])
@push('style')
@endpush
@section('title', 'Vehicle Subcategory')
@section('content')
   

    <!-- Main content -->
    <section class="content cioas-page pt-5">
    <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="cioas-panel-title">Vehicle Subcategory List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    {{-- {{route('death.create')}} --}}
                                    <a href="{{route('basic-settings.vehicle-subcategory.create')}}" class="btn btn-primary">Create</a>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="cioas-panel-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Vehicle Sub Category</th>
                                    <th>Vehicle Category</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                              </tbody>

                            </table>
                          </div>
                          <!-- /.card-body -->

                    </div>
                    </div>
                    <!-- /.cioas-shell -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@push('script')
@endpush

