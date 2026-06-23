@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'Edit License Category')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit License Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.license-category.index') }}">License
                                Category</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">License Category Info</h3>
                </div>
                <form id="licenseCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="en_name" class="col-sm-2 col-form-label">Name <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" required name="en_name" value="{{ $category->en_name }}"
                                    class="form-control" id="en_name">
                                <small class="text-danger error en_name_error"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bn_name" class="col-sm-2 col-form-label">Name Bangla <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" required name="bn_name" value="{{ $category->bn_name }}"
                                    class="form-control" id="bn_name">
                                <small class="text-danger error bn_name_error"></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('basic-settings.license-category.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#licenseCategoryForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $('.error').text('');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('basic-settings.license-category.update', $category->id) }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = "{{ route('basic-settings.license-category.index') }}";
                        }, 1000);
                    },
                    error: function (xhr) {
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function (key, val) {
                            thisForm.find('.' + key + '_error').text(val[0]);
                        });
                    }
                });
            });
        });
    </script>
@endpush