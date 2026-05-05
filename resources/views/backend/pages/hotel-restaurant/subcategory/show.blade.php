@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'HotelSubcategory'])
@push('style')
@endpush
@section('title', 'Edit Family Subcategory')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hotel Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- {{route('death.index')}} --}}
                        <li class="breadcrumb-item"><a href="">Hotel Subcategory</a></li>
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
                            <h3 class="card-title">Edit Hotel Subcategory Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="familySubcateogryEditForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="family_category_id" class="col-sm-2 col-form-label">Hotel Category <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="hotel_category_id"
                                            id="family_category_id" disabled>
                                            <option value="">Hotel Category</option>
                                            @if ($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $subcategory->hotel_category_id) selected @endif>
                                                        {{ $category->en_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error family_category_id_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Subcategory <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" value="{{ $subcategory->en_name }}"
                                            placeholder="Hotel Sub-Category" class="form-control" id="en_name" disabled>
                                        <small class="text-danger error en_name_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Subcategory Bangla <span
                                            class="text-danger" data-toggle="tooltip" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" disabled value="{{ $subcategory->bn_name }}"
                                            placeholder="Hotel Sub-Category Bangla" disabled class="form-control"
                                            id="bn_name">
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

    {{-- {{ route('death.store') }} --}}
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        })
    </script>
@endpush
