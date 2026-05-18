@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])
@push('style')
@endpush
@section('title', 'Family Category')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deputy commissioner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.department.index') }}">Departments
                            </a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                                    <h3 class="card-title">Department Info</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('basic-settings.department.index') }}" class="btn btn-dark">Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                            data-url="{{ route('basic-settings.department.store') }}"
                            data-redirect-url="{{ route('basic-settings.department.index') }}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger"
                                            data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Department Name"
                                            class="form-control" id="name">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Bangla Name <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" placeholder="Department Name In Bangla"
                                            class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>

                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('basic-settings.department.index') }}"
                                        class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
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
        $(document).ready(function() {

        })
    </script>
@endpush
