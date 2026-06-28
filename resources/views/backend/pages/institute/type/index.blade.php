@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteType'])
@push('style')
@endpush
@section('title', 'Institute Type List')
@section('content')

    <!-- Main content -->
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <!-- Alert Notifications -->
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-list-ul"></i> Institute Type List
                    </h3>
                    <a href="{{ route('institute-type.create') }}" class="btn btn-material btn-material-primary" style="background-color: #0f766e; border-color: #0f766e; color: white;">
                        <i class="fas fa-plus-circle"></i> Create Institute Type
                    </a>
                </div>
                <div class="cioas-panel-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-custom table-hover w-100']) !!}
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('script')
    {!! $dataTable->scripts() !!}
@endpush
