@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Section List')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> Section List
                        </h3>
                        <div>
                            <a href="{{ route('basic-settings.department.index') }}" class="btn btn-dark btn-material mr-2">
                                <i class="fas fa-arrow-left"></i> Back to Departments
                            </a>
                            <a href="{{ route('basic-settings.department-section.create', $department_id) }}"
                                class="btn btn-material btn-material-primary">
                                <i class="fas fa-plus-circle"></i> Create Section
                            </a>
                        </div>
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-custom table-hover']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{ $dataTable->scripts() }}

@endpush