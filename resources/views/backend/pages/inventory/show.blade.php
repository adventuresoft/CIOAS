@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryRequisitionList'])

@section('title', 'Requisition Details')

@push('style')
    <style>
        .requisition-show-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 10px 24px rgba(23, 50, 77, 0.08);
        }

        .requisition-show-card .card-header {
            background: #17a2b8;
            color: #fff;
        }

        .info-label {
            color: #526579;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .info-value {
            color: #17324d;
            font-size: 15px;
            font-weight: 600;
        }

        .print-title {
            display: none;
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .no-print,
            .breadcrumb,
            .btn {
                display: none !important;
            }

            body {
                background: #fff !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .requisition-show-card,
            .card {
                border: 1px solid #d7dfea !important;
                box-shadow: none !important;
            }

            .requisition-show-card .card-header {
                background: #fff !important;
                color: #000 !important;
                border-bottom: 1px solid #d7dfea !important;
            }

            .print-title {
                display: block;
                text-align: center;
                margin-bottom: 16px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-7">
                    <h1 class="mb-1">Requisition Details</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.requisition.index') }}">Requisition List</a></li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="print-title">
                <h3 class="mb-1">Inventory Requisition</h3>
                <div>{{ $inventory->requisition_no }}</div>
            </div>

            <div class="card requisition-show-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0" style="font-size:24px; font-weight:600;">Inventory Requisition</h3>
                        <div class="no-print">
                            <button type="button" class="btn btn-light btn-sm" onclick="window.print()">
                                <i class="fas fa-print mr-1"></i> Print
                            </button>
                            <a href="{{ route('inventory.requisition.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Requisition No</div>
                            <div class="info-value">{{ $inventory->requisition_no }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Requisition Date</div>
                            <div class="info-value">{{ optional($inventory->application_date)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Department</div>
                            <div class="info-value">{{ $inventory->department_name }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Priority</div>
                            <div class="info-value">{{ $inventory->priority_level }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Applicant</div>
                            <div class="info-value">{{ $inventory->applicant_name }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Designation</div>
                            <div class="info-value">{{ $inventory->designation ?: '-' }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Mobile</div>
                            <div class="info-value">{{ $inventory->mobile_number ?: '-' }}</div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $inventory->email_address ?: '-' }}</div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="info-label">Purpose</div>
                            <div class="info-value">{{ $inventory->purpose }}</div>
                        </div>
                    </div>

                    @if($isDeptHead && in_array($inventory->workflow_status, ['draft', 'pending_dept_head']))
                        <form action="{{ route('inventory.requisition.approve') }}" method="POST">
                            @csrf
                            <input type="hidden" name="requisition_id" value="{{ $inventory->id }}">
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Required Qty</th>
                                    @if($isDeptHead && in_array($inventory->workflow_status, ['draft', 'pending_dept_head']))
                                        <th class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventory->items as $key => $item)
                                    <tr id="item-row-{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->category ?? '-' }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit ?? '-' }}</td>
                                        <td>
                                            @if($isDeptHead && in_array($inventory->workflow_status, ['draft', 'pending_dept_head']))
                                                <input type="number" name="required_quantities[{{ $item->id }}]" class="form-control form-control-sm text-right" value="{{ (int) $item->required_quantity }}" min="0" step="1">
                                            @else
                                                {{ (int) $item->required_quantity }}
                                            @endif
                                        </td>
                                        @if($isDeptHead && in_array($inventory->workflow_status, ['draft', 'pending_dept_head']))
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-id="{{ $item->id }}" title="Remove Item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No item found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($isDeptHead && in_array($inventory->workflow_status, ['draft', 'pending_dept_head']))
                        <div class="mt-4 text-right">
                            <button type="submit" name="action_type" value="reject" class="btn btn-danger mr-2" onclick="return confirm('Are you sure you want to reject this requisition?');">
                                <i class="fas fa-times-circle mr-1"></i> Reject Requisition
                            </button>
                            <button type="submit" name="action_type" value="approve" class="btn btn-success">
                                <i class="fas fa-check-circle mr-1"></i> Approve Requisition
                            </button>
                        </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.remove-item-btn').click(function() {
            let itemId = $(this).data('id');
            if (confirm('Are you sure you want to remove this item from the requisition?')) {
                // Add hidden input to form so the backend knows to delete it
                $('<input>').attr({
                    type: 'hidden',
                    name: 'deleted_items[]',
                    value: itemId
                }).appendTo('form');
                
                // Remove the row from the table
                $('#item-row-' + itemId).remove();
            }
        });
    });
</script>
@endpush
