@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseSubcategory'])
@section('title', 'License Subcategory')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>License Subcategory Create</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('basic-settings.license-subcategory.index') }}">License Subcategory</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header"><h3 class="card-title">License Subcategory Info</h3></div>
            <form id="licenseSubcategoryForm" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="license_category_id" class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select required name="license_category_id" id="license_category_id" class="form-control select2">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->en_name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger error license_category_id_error"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="en_name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" required name="en_name" placeholder="License Subcategory" class="form-control" id="en_name">
                            <small class="text-danger error en_name_error"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bn_name" class="col-sm-2 col-form-label">Name Bangla <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" required name="bn_name" placeholder="License Subcategory Bangla" class="form-control" id="bn_name">
                            <small class="text-danger error bn_name_error"></small>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('basic-settings.license-subcategory.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
$(document).ready(function() {
    $('.select2').select2();
    $('#licenseSubcategoryForm').on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $('.error').text('');
        $.ajax({
            type: 'POST',
            url: "{{ route('basic-settings.license-subcategory.store') }}",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                toastr.success(response.message);
                setTimeout(function() {
                    location.href = "{{ route('basic-settings.license-subcategory.index') }}";
                }, 1000);
            },
            error: function(xhr) {
                let responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
                $.each(responseText.errors, function(key, val) {
                    thisForm.find('.' + key + '_error').text(val[0]);
                });
            }
        });
    });
});
</script>
@endpush
