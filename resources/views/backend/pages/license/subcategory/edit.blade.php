@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@push('style')
@endpush
@section('title', 'Edit License Subcategory')
@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <form id="licenseSubcategoryEditForm" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-certificate"></i> Edit License Subcategory Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            <input type="hidden" name="license_category_id" value="{{ $subcategory->license_category_id }}">

                            <div class="form-group row mb-4">
                                <label for="en_name" class="col-sm-3 col-form-label text-dark font-weight-bold">English Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="en_name" id="en_name" value="{{ $subcategory->en_name }}" class="form-control" placeholder="License Sub-Category" required>
                                    <small class="text-danger error en_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Bengali Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" value="{{ $subcategory->bn_name }}" class="form-control" placeholder="License Sub-Category Bangla" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" {{ $subcategory->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $subcategory->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $("#licenseSubcategoryEditForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.license-subcategory.update', $subcategory->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        if(response.status) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.href = "{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}";
                            }, 1500)
                        } else {
                            toastr.error(response.message || 'Something went wrong!');
                        }
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "An error occurred");
                        if(responseText.errors) {
                            $.each(responseText.errors, function(key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            })
        })
    </script>
@endpush