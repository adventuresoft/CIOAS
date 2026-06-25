@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'Edit License Category')
@section('content')
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <form id="licenseCategoryForm" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-id-card"></i> License Category Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="form-group row mb-4">
                                <label for="en_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" required name="en_name" value="{{ $category->en_name }}" class="form-control" id="en_name">
                                    <small class="text-danger error en_name_error"></small>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Name Bangla <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" required name="bn_name" value="{{ $category->bn_name }}" class="form-control" id="bn_name">
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.license-category.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
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