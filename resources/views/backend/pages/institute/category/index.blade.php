@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteCategory'])
@push('style')
@endpush
@section('title', 'Institute Category List')
@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">
            <!-- Alert Notifications -->
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #10b981;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            <div class="card cioas-shell">
                <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-dark font-weight-bold mb-0">
                        <i class="fas fa-list-ul text-teal mr-2" style="color: #0f766e;"></i> Institute Category List
                    </h3>
                    <div>
                        <a href="{{ route('institute-category.create') }}" class="btn btn-sm" style="background-color: #0f766e; color: white;">
                            <i class="fas fa-plus-circle mr-1"></i> Create Institute Category
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="p-4">
                        {!! $dataTable->table(['class' => 'table table-bordered table-hover cioas-datatable w-100']) !!}
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
