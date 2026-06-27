@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryWorkOrderList'])

@section('title', 'Work Order List')

@push('style')
    <style>
        .workOrder-action-btn {
            width: 36px;
            height: 30px;
            border-radius: 5px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 0;
            box-shadow: none !important;
            color: #fff !important;
        }

        .workOrder-action-btn i {
            font-size: 12px;
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .workOrder-filter,
            .workOrder-action-group,
            .no-print,
            .dataTables_paginate,
            .dataTables_info,
            .dataTables_length,
            .dataTables_filter {
                display: none !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .cioas-shell {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-file-invoice"></i> Work Order List
                        </h3>
                        <div class="no-print d-flex gap-2">
                            <a href="{{ route('inventory.work-order.create') }}" class="btn btn-material btn-material-primary">
                                <i class="fas fa-plus-circle"></i> Add New Work Order
                            </a>
                            <button type="button" class="btn btn-material btn-material-primary" style="background-color: #0ea5e9; border-color: #0ea5e9;" onclick="window.print()">
                                <i class="fas fa-print"></i> Print View
                            </button>
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
