@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Create Section')

@section('content')
    @php
        $department = App\Models\Department\Department::find($department_id);
    @endphp

    <!-- Main content -->
    <section class="content cioas-page pt-3">
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
                                        <input type="text" name="name" placeholder="Section Name" class="form-control"
                                            id="name" required>
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
                        <a href="{{ route('basic-settings.department-section.index', $department_id) }}"
                            class="btn btn-light btn-material">
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