@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanList'])
@push('style')
@endpush
@section('title', 'Chairman & Mayor List')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chairman List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('chairman.index')}}">Chairman List</a></li>
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
                                    <h3 class="card-title">Chairman List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('chairman.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Thana</th>
                                    <th>Word/Union</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($councils as $council)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$council->union->Thana->District->Division->name??''}}</td>
                                    <td>{{$council->union->Thana->District->name??''}}</td>
                                    <td>{{$council->union->Thana->name??''}}</td>
                                    <td>{{$council->union->name??''}}</td>
                                    <td>{{date('d-m-Y',strtotime($council->start_date))}}</td>
                                    <td>{{date('d-m-Y',strtotime($council->end_date))}}</td>
                                    <td>{{$council->status==1?'Active':'Inactive'}}</td>
                                    <td>
                                        <a href="#" class="badge badge-info" title="Edit"> <i class="fa fa-pencil"></i> Edit </a>
                                    </td>
                                </tr>
                                @endforeach

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

