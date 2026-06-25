@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'Edit License Subcategory')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>License Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}">License
                                Subcategory</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="cioas-panel">
                        <div class="panel-header">
                            <h3 class="panel-title">Edit License Subcategory</h3>
                        </div>
                        <div class="panel-body">
                            <form id="licenseSubcategoryForm" action="{{ route('basic-settings.license-subcategory.update', $subcategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="license_category_id" value="{{ $subcategory->license_category_id }}">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group md-field">
                                            <input type="text" name="en_name" id="en_name" class="md-input" placeholder=" " value="{{ $subcategory->en_name }}" required>
                                            <label for="en_name" class="md-label">English Name <span class="text-danger">*</span></label>
                                            <small class="text-danger error en_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group md-field">
                                            <input type="text" name="bn_name" id="bn_name" class="md-input" placeholder=" " value="{{ $subcategory->bn_name }}" required>
                                            <label for="bn_name" class="md-label">Bengali Name <span class="text-danger">*</span></label>
                                            <small class="text-danger error bn_name_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group md-field">
                                            <select name="status" id="status" class="md-input select2" required>
                                                <option value="1" {{ $subcategory->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $subcategory->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <label for="status" class="md-label">Status <span class="text-danger">*</span></label>
                                            <small class="text-danger error status_error"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-end gap-2">
                                        <a href="{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}" class="btn btn-secondary">
                                            <i class="ti ti-arrow-left"></i> Back
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-device-floppy"></i> Update Subcategory
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('#licenseSubcategoryForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                
                $.ajax({
                    type: 'POST',
                    url: "{{ route('basic-settings.license-subcategory.update', $subcategory->id) }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        if (response.status) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                location.href = "{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}";
                            }, 1500);
                        } else {
                            toastr.error(response.message || 'Something went wrong!');
                        }
                    },
                    error: function (xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "An error occurred");
                        if (responseText.errors) {
                            $.each(responseText.errors, function (key, val) {
                                thisForm.find('.' + key + '_error').text(val[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush