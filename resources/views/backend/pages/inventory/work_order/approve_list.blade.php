@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryWorkOrderApproveList'])

@section('title', 'Approve List')

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
                                        Approve List
                                    </h3>
                                </div>
                                <div class="col-md-6 text-right no-print">
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
                                <div class="col-md-1">
                                    <select id="tableLength" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_work_order_no" class="form-control form-control-sm"
                                        placeholder="Work Order No">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_department" class="form-control form-control-sm"
                                        placeholder="Department Name">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_applicant" class="form-control form-control-sm"
                                        placeholder="Applicant Name">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="search_priority" class="form-control form-control-sm"
                                        placeholder="Priority">
                                </div>
                                <div class="col-md-2">
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
                                            <th>Department Name</th>
                                            <th>Applicant Name</th>
                                            <th>Priority</th>
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
                                                <td>{{ $workOrder->department_name }}</td>
                                                <td>{{ $workOrder->applicant_name }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $workOrder->priority_level === 'Emergency' ? 'danger' : ($workOrder->priority_level === 'Urgent' ? 'warning' : 'success') }}">
                                                        {{ $workOrder->priority_level }}
                                                    </span>
                                                </td>
                                                <td>{{ optional($workOrder->application_date)->format('d M Y') }}</td>
                                                <td>{{ optional($workOrder->validity_date)->format('d M Y') ?: '-' }}</td>
                                                <td>{{ optional($workOrder->delivery_date)->format('d M Y') ?: '-' }}</td>
                                                <td>
                                                    <div class="workOrder-action-group" role="group" aria-label="Inventory actions">
                                                        <a href="{{ route('inventory.work-order.approve_show', $workOrder->id) }}" class="btn btn-info workOrder-action-btn" title="Show">
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

            $('#search_department').keyup(function() {
                table.column(2).search(this.value).draw();
            });

            $('#search_applicant').keyup(function() {
                table.column(3).search(this.value).draw();
            });

            $('#search_priority').keyup(function() {
                table.column(4).search(this.value).draw();
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
