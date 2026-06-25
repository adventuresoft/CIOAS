@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Category List')
@section('content')

    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> License Category List
                        </h3>
                        <a href="{{ route('basic-settings.license-category.create') }}"
                            class="btn btn-material btn-material-primary">
                            <i class="fas fa-plus-circle"></i> Create Category
                        </a>
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-custom table-hover w-100']) }}
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