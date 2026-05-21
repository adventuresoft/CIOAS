@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'LicenseType'])
@push('style')
@endpush
@section('title', 'License Type Details')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>License Type Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.license-type.index')}}">License Type</a></li>
            <li class="breadcrumb-item active">Details</li>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">License Type Info</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">License Type</th>
                                    <td>{{ $type->en_name }}</td>
                                </tr>
                                <tr>
                                    <th>License Type Bangla</th>
                                    <td>{{ $type->bn_name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $type->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($type->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('basic-settings.license-type.index')}}" class="btn btn-default">Back</a>
                            <a href="{{route('basic-settings.license-type.edit', $type->id)}}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
