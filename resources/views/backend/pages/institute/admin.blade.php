@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteList'])
@push('style')
@endpush
@section('title', 'Institute Edit')
@section('content')

    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="institute_id" value="{{ $institute->id }}">
                <input type="hidden" name="user_id" value="{{ $institute->superUser->id ?? 0 }}">
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-user-shield"></i>
                                <a class="linked" href="{{ route('institute.edit', $institute->id) }}"> <span>Institute
                                        Create Info |</span></a>
                                <span>Institutional Admin |</span>
                                <a class="linked" href="{{ route('instituteA.imagesCreate', $institute->id) }}">
                                    <span>Institutional Images</span> </a>
                            </h3>
                        </div>

                        <div class="cioas-panel-body">
                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-2 col-form-label text-dark font-weight-bold">Admin Name
                                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="name" value="{{ $institute->superUser->name ?? '' }}"
                                        placeholder="Institinal Super Admin Name" name="name" class="form-control" required>
                                    <small class="error name-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="email" class="col-sm-2 col-form-label text-dark font-weight-bold">Email <span
                                        class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" value="{{ $institute->superUser->email ?? '' }}"
                                        placeholder="Institinal Super Admin Email" name="email" class="form-control"
                                        required>
                                    <small class="error email-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="mobile" class="col-sm-2 col-form-label text-dark font-weight-bold">Mobile <span
                                        class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" id="mobile" value="{{ $institute->superUser->mobile ?? '' }}"
                                        placeholder="Institinal Super Admin Mobile" name="mobile" class="form-control"
                                        required>
                                    <small class="error mobile-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="department_id"
                                    class="col-sm-2 col-form-label text-dark font-weight-bold">Department</label>
                                <div class="col-sm-9">
                                    <select name="department_id" id="department_id" class="form-control select2">
                                        <option value="">-- Select Department --</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ ($institute->superUser->department_id ?? 0) == $department->id ? 'selected' : '' }}>{{ $department->name }}
                                                ({{ $department->bn_name }})</option>
                                        @endforeach
                                    </select>
                                    <small class="error department_id-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="section_id"
                                    class="col-sm-2 col-form-label text-dark font-weight-bold">Section</label>
                                <div class="col-sm-9">
                                    <select name="section_id" id="section_id" class="form-control select2">
                                        <option value="">-- Select Section --</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ ($institute->superUser->section_id ?? 0) == $section->id ? 'selected' : '' }}>{{ $section->name }}
                                                ({{ $section->bn_name }})</option>
                                        @endforeach
                                    </select>
                                    <small class="error section_id-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="role_id" class="col-sm-2 col-form-label text-dark font-weight-bold">Role <span
                                        class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                <div class="col-sm-9">
                                    <select name="role_id" id="role_id" class="form-control select2" required>
                                        <option value="">-- Select Role --</option>
                                        @foreach($roles as $role)
                                            @if($role->id != 1 && $role->id != 2)
                                                <option value="{{ $role->id }}" {{ ($institute->superUser->role_id ?? 0) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <small class="error role_id-error text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="password" class="col-sm-2 col-form-label text-dark font-weight-bold">Password
                                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" id="password" placeholder="Keep empty to unchange"
                                        name="password" class="form-control">
                                    <small class="error password-error text-danger"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('institute.index') }}" class="btn btn-link text-muted font-weight-bold mr-3"
                                style="text-decoration: none;">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#department_id').on('change', function () {
                var departmentId = $(this).val();
                var sectionSelect = $('#section_id');

                sectionSelect.html('<option value="">-- Select Section --</option>');

                if (departmentId) {
                    $.ajax({
                        url: "{{ route('basic-settings.get-sections-by-department', '') }}/" + departmentId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $.each(data, function (key, section) {
                                sectionSelect.append('<option value="' + section.id + '">' + section.name + ' (' + (section.bn_name ? section.bn_name : '') + ')</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error("Failed to load sections: " + error);
                        }
                    });
                }
            });

            $("#instituteForm").on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('instituteA.adminStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function (xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function (key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })
    </script>

    <script>
        function readURL(input, preview = '') {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#left_image").change(function () {
            readURL(this, '#left_image_preview');

        });

        $("#top_image").change(function () {
            readURL(this, '#top_image_preview');

        });

        $("#right_image").change(function () {
            readURL(this, '#right_image_preview');

        });
    </script>
@endpush