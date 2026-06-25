@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Create Section')

@section('content')
    @php
        $department = App\Models\Department\Department::find($department_id);
    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.department.index') }}">Basic Settings</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.department-section.index', $department_id) }}">Section List</a></li>
                        <li class="breadcrumb-item active">Create Section</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                    action="{{ route('basic-settings.department-section.store') }}"
                    data-url="{{ route('basic-settings.department-section.store') }}"
                    data-redirect-url="{{ route('basic-settings.department-section.index', $department_id) }}">
                    @csrf
                    <input type="hidden" name="department_id" value="{{ $department_id }}">
                    
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-plus-circle"></i> Create Section ({{ $department->name ?? 'Department' }})
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Section Name"
                                            class="form-control" id="name" required>
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="bn_name">Bangla Name <span class="text-danger">*</span></label>
                                        <input type="text" name="bn_name" placeholder="Section Name In Bangla"
                                            class="form-control" id="bn_name" required>
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-actions mt-4">
                        <a href="{{ route('basic-settings.department-section.index', $department_id) }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-material btn-material-primary" id="btnSave">
                            <i class="fas fa-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let isSubmitting = false;
            $('#FormSubmit').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) return;
                isSubmitting = true;

                let form = $(this);
                let formData = new FormData(this);
                let url = form.data('url');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnSave').prop('disabled', true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = form.data('redirect-url');
                        }, 1500);
                    },
                    error: function(xhr) {
                        isSubmitting = false;
                        $('#btnSave').prop('disabled', false);
                        let err = xhr.responseJSON;
                        if (err && err.errors) {
                            $.each(err.errors, function(key, value) {
                                toastr.error(value[0]);
                                form.find("." + key + "_error").text(value[0]);
                            });
                        } else if (err && err.message) {
                            toastr.error(err.message);
                        } else {
                            toastr.error('Failed to save data.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
