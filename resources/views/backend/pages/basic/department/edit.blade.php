@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Edit Department')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                    action="{{ route('basic-settings.department.update', $department->id) }}"
                    data-url="{{ route('basic-settings.department.update', $department->id) }}"
                    data-redirect-url="{{ route('basic-settings.department.index') }}">
                    @csrf
                    @method('PUT')

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-edit"></i> Edit Department</h3>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Department Name" class="form-control"
                                            id="name" value="{{ $department->name }}" required>
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="bn_name">Bangla Name <span class="text-danger">*</span></label>
                                        <input type="text" name="bn_name" placeholder="Department Name In Bangla"
                                            class="form-control" id="bn_name" value="{{ $department->bn_name }}" required>
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="url">URL</label>
                                        <input type="text" name="url" placeholder="Department URL" class="form-control"
                                            id="url" value="{{ $department->url }}">
                                        <small class="text-danger error url_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="info">Info</label>
                                        <textarea name="info" placeholder="Department Info" class="form-control"
                                            id="info" rows="3">{{ $department->info }}</textarea>
                                        <small class="text-danger error info_error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-actions mt-4">
                        <a href="{{ route('basic-settings.department.index') }}" class="btn btn-light btn-material">
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