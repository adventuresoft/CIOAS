@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryWorkOrderList'])

@section('title', 'Work Order List')

@push('style')
    <style>
        .workOrder-filter input,
        .workOrder-filter select {
            height: 42px;
        }

        .workOrder-action-group {
            display: inline-flex;
            gap: 8px;
            align-items: center;
        }

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
        }

        .workOrder-action-btn i {
            font-size: 12px;
        }

        .workOrder-empty {
            padding: 36px 16px;
            text-align: center;
            color: #7a8699;
        }

        .workOrder-empty i {
            font-size: 42px;
            margin-bottom: 10px;
            color: #8fb3ff;
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .workOrder-filter,
            .workOrder-action-group,
            .no-print,
            .dataTables_paginate,
            .dataTables_info {
                display: none !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .card {
                border: 1px solid #d7dfea !important;
                box-shadow: none !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="card-title" style="font-size:24px; font-weight: 600;">
                                        Work Order List
                                    </h3>
                                </div>
                                <div class="col-md-6 text-right no-print">
                                    <a href="{{ route('inventory.work-order.create') }}" class="btn btn-primary">Add New Work Order</a>
                                    <a href="{{ route('inventory.work-order.index') }}" class="btn btn-primary">Work Order List</a>
                                    <button type="button" class="btn btn-info" onclick="window.print()">
                                        <i class="fas fa-print mr-1"></i> Print View
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="row mb-3 align-items-center g-2 workOrder-filter">
                                <div class="col-md-2">
                                    <select id="tableLength" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="search_work_order_no" class="form-control form-control-sm"
                                        placeholder="Work Order No">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="search_status" class="form-control form-control-sm"
                                        placeholder="Status">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="search_global" class="form-control form-control-sm"
                                        placeholder="Search">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="workOrderTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Work Order No</th>
                                            <th>Workflow Status</th>
                                            <th>Included Requisitions</th>
                                            <th>Items Count</th>
                                            <th>Applied Date</th>
                                            <th>Validity Date</th>
                                            <th>Delivery Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($workOrders as $key => $workOrder)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $workOrder->work_order_no }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $workOrder->workflow_status === 'approved' ? 'success' : ($workOrder->workflow_status === 'draft' ? 'secondary' : 'warning') }}">
                                                        {{ ucfirst(str_replace('_', ' ', $workOrder->workflow_status)) }}
                                                    </span>
                                                </td>
                                                <td>{{ $workOrder->requisitions ? $workOrder->requisitions->count() : 0 }}</td>
                                                <td>{{ $workOrder->items_count }}</td>
                                                <td>{{ optional($workOrder->application_date)->format('d M Y') }}</td>
                                                <td>{{ optional($workOrder->validity_date)->format('d M Y') ?: '-' }}</td>
                                                <td>{{ optional($workOrder->delivery_date)->format('d M Y') ?: '-' }}</td>
                                                <td class="no-print">
                                                    <div class="workOrder-action-group" role="group" aria-label="Work Order actions">
                                                        <a href="{{ route('inventory.work-order.show', $workOrder->id) }}" class="btn btn-info workOrder-action-btn" title="Show">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let table = $('#workOrderTable').DataTable({
                dom: 'rtip',
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                order: [
                    [0, 'asc']
                ],
                language: {
                    emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                    zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
                }
            });

            $('#search_work_order_no').keyup(function() {
                table.column(1).search(this.value).draw();
            });

            $('#search_status').keyup(function() {
                table.column(2).search(this.value).draw();
            });

            $('#search_global').keyup(function() {
                table.search(this.value).draw();
            });

            $('#tableLength').change(function() {
                table.page.len($(this).val()).draw();
            });
        });
    </script>
@endpush
