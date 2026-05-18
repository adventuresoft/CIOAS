@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'InstituteType'])
@push('style')
@endpush
@section('title', 'Institute Type')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Institute Type</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('institute-type.index') }}">Institute
                                Type</a></li>
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
                            <h3 class="card-title">Create Institute Type</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                            data-url="{{ route('institute-type.update', $institute->id) }}"
                            data-redirect-url="{{ route('institute-type.index') }}">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Name <span class="text-danger"
                                            data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Institute Type"
                                            class="form-control" id="name" value="{{ $institute->name }}">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description<span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="description" placeholder="Description"
                                            class="form-control" id="description" value="{{ $institute->description }}">
                                        <small class="text-danger error description_error"></small>

                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('institute-type.index') }}"
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
