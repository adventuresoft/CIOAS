@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'HotelOwnership'])
@push('style')
@endpush
@section('title', 'Hotel Ownership')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Hotel Ownership</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.hotel-ownership.index') }}">Hotel
                                Ownership</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Hotel Ownership Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="hotelOwnershipForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Ownership Name <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" value="{{ $ownership->en_name }}"
                                            placeholder="Hotel Ownership" class="form-control" id="en_name" disabled>
                                        <small class="text-danger error en_name_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Ownership Bangla <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" value="{{ $ownership->bn_name }}"
                                            placeholder="Family Category Bangla" class="form-control" id="bn_name"
                                            disabled>
                                        <small class="text-danger error bn_name_error"></small>

                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

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
            $(".select2").select2();
        })
    </script>
@endpush
