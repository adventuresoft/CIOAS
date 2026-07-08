@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Pourashava'])
@section('title', 'Pourashava List')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> Pourashava List
                        </h3>
                        <a href="{{ route('basic-settings.pourashava.create') }}"
                            class="btn btn-material btn-material-primary">
                            <i class="fas fa-plus-circle"></i> Create Pourashava
                        </a>
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-bordered table-striped table-custom table-hover']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}

@endpush