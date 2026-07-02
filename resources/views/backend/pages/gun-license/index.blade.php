@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'GunLicenseList'])

@section('title', 'আগ্নেয়াস্ত্র লাইসেন্স আবেদন তালিকা')

@push('style')
<style>
    /* Premium Table Design - matching design_tem/table.png */
    .cioas-panel {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    .cioas-panel-header {
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cioas-panel-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f766e;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .cioas-panel-body {
        padding: 24px;
    }

    .cioas-datatable {
        width: 100% !important;
        border-collapse: collapse;
        border: 1px solid #e2e8f0;
    }

    .cioas-datatable th {
        background-color: #f8fafc !important;
        color: #475569;
        font-weight: 700;
        text-transform: capitalize;
        font-size: 13px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 12px 16px;
    }

    .cioas-datatable td {
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 14px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .cioas-datatable tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-submitted { background-color: #f59e0b; color: white; }
    .badge-verified { background-color: #3b82f6; color: white; }
    .badge-interviewed { background-color: #8b5cf6; color: white; }
    .badge-approved { background-color: #10b981; color: white; }
    .badge-rejected { background-color: #ef4444; color: white; }

    /* Action Buttons Matching Template */
    .btn-group.btn-group-sm {
        display: flex;
        gap: 2px;
    }
    .btn-group.btn-group-sm .btn {
        border-radius: 4px !important;
        padding: 4px 10px;
        box-shadow: none;
    }
    .btn-group.btn-group-sm .btn-dark {
        background-color: #1e293b;
        border-color: #1e293b;
    }
    .btn-group.btn-group-sm .btn-info {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
    }
    .btn-group.btn-group-sm .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    .btn-group.btn-group-sm .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    /* DataTables Controls styling */
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 16px;
        color: #475569;
    }
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px;
        color: #475569;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 4px 10px;
        margin: 0 2px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #3b82f6 !important;
        color: white !important;
        border: 1px solid #3b82f6;
    }
</style>
@endpush

@section('content')
<section class="content cioas-page pt-3">
    <div class="container-fluid">
        <div class="cioas-shell">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-list-ul"></i> আগ্নেয়াস্ত্র লাইসেন্স আবেদন তালিকা
                    </h3>
                    <a href="{{ route('gun-license.create') }}" class="btn" style="background-color: #0f766e; color: white; font-weight: 600; border-radius: 6px; padding: 8px 16px;">
                        <i class="fas fa-plus-circle"></i> New Application
                    </a>
                </div>
                <div class="cioas-panel-body">
                    <div class="table-responsive" style="overflow-x: auto;">
                        {!! $dataTable->table(['class' => 'table cioas-datatable'], true) !!}
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
