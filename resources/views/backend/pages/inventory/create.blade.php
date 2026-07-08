@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryCreate'])

@section('title', 'Inventory Requisition & Approval Management System')

@push('style')
    <style>
        :root {
            --inventory-blue: #0d6efd;
            --inventory-blue-dark: #0b4db8;
            --inventory-border: #d8e6ff;
            --inventory-text: #17324d;
        }

        .inventory-shell {
            color: var(--inventory-text);
        }

        .inventory-stepper {
            display: flex;
            gap: 6px;
            align-items: stretch;
            flex-wrap: nowrap;
            overflow-x: visible;
            padding-bottom: 4px;
        }

        .inventory-step {
            min-width: 0;
            flex: 1 1 0;
            background: #fff;
            border: 1px solid var(--inventory-border);
            border-radius: 8px;
            padding: 8px 5px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 14px rgba(23, 50, 77, 0.05);
            transition: all 0.25s ease;
        }

        .inventory-step:not(:last-child)::after {
            content: none;
            position: absolute;
            top: 50%;
            right: -13px;
            width: 12px;
            height: 2px;
            background: #c7d9f8;
            transform: translateY(-50%);
        }

        .inventory-step.active {
            border-color: rgba(13, 110, 253, 0.38);
            background: linear-gradient(180deg, #f5f9ff 0%, #ffffff 100%);
            box-shadow: 0 6px 16px rgba(13, 110, 253, 0.12);
        }

        .step-circle {
            width: 28px;
            height: 28px;
            margin: 0 auto 6px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf4ff;
            color: var(--inventory-blue);
            font-size: 12px;
            transition: all 0.25s ease;
        }

        .inventory-step.active .step-circle {
            background: var(--inventory-blue);
            color: #fff;
        }

        .step-label {
            font-size: 10px;
            line-height: 1.2;
            font-weight: 700;
            color: #33506e;
            overflow-wrap: anywhere;
        }

        .workflow-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 14px 34px rgba(23, 50, 77, 0.08);
            overflow: hidden;
        }

        .workflow-card .card-header {
            background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
            border-bottom: 1px solid #e4eefc;
        }

        .workflow-card .card-title {
            color: var(--inventory-blue-dark);
        }

        .section-toggle {
            min-width: 42px;
            height: 42px;
            border-radius: 10px;
        }

        .field-caption {
            font-size: 12px;
            color: #6c7f95;
        }

        .summary-card {
            border: 1px solid #dce9ff;
            border-radius: 16px;
            background: #fafdff;
        }

        .item-table thead th,
        .workflow-table thead th {
            background: #eef5ff;
            color: #0d2b5d;
            font-weight: 700;
            border-bottom: 0;
        }

        .workflow-timeline {
            position: relative;
            padding-left: 24px;
        }

        .workflow-timeline::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #cfe0ff;
        }

        .timeline-item {
            position: relative;
            padding: 0 0 24px 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 6px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 3px solid #fff;
            background: var(--inventory-blue);
            box-shadow: 0 0 0 2px #cfe0ff;
        }

        .signature-box {
            min-height: 92px;
            border: 1px dashed #90b4ef;
            border-radius: 14px;
            background: #f9fbff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7f99;
            text-align: center;
            padding: 16px;
        }

        .badge-step {
            background: #edf4ff;
            color: var(--inventory-blue-dark);
            border: 1px solid #d8e6ff;
        }

        .form-control:focus,
        .custom-select:focus,
        .custom-file-input:focus {
            border-color: rgba(13, 110, 253, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
        }

        .workflow-body {
            transition: all 0.25s ease;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .inventory-stepper,
            .no-print,
            .btn,
            .breadcrumb,
            .section-toggle,
            .card-header .badge,
            .custom-file,
            .workflow-card .card-header .text-muted {
                display: none !important;
            }

            body {
                background: #fff !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .workflow-card,
            .summary-card {
                box-shadow: none !important;
            }

            .workflow-card,
            .summary-card,
            .card {
                border: 1px solid #d7dfea !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content inventory-shell">
        <div class="container-fluid">
            <div class="mb-4">
                <div class="inventory-stepper">
                    @foreach ($workflowSteps as $step)
                        <div class="inventory-step {{ $loop->first ? 'active' : '' }}" data-step-indicator="{{ $step['id'] }}">
                            <div class="step-circle">
                                <i class="fas {{ $step['icon'] }}"></i>
                            </div>
                            <div class="step-label">{{ $step['id'] }}. {{ $step['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <form id="inventoryWorkflowForm" novalidate>
                {{-- SECTION 1 --}}
                <div class="card workflow-card mb-4" id="step-1" data-step-card="1">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 1</span>
                                <h4 class="card-title mb-0">Applicant Requisition Form</h4>
                            </div>
                            <div class="text-muted">Create a requisition, add item rows, and continue to the next workflow stage.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="1">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-1">
                        <div id="section1Alert" class="alert alert-danger d-none"></div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Requisition No</label>
                                <input type="text" class="form-control requisition-no" value="IN-REQ-2026-0001" readonly>
                                <small class="field-caption">Auto-generated reference number.</small>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Requisition Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="application_date" value="2026-06-10" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Priority Level <span class="text-danger">*</span></label>
                                <select class="form-control" id="priority_level" required>
                                    <option value="">Select Priority</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Urgent" selected>Urgent</option>
                                    <option value="Emergency">Emergency</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Purpose of Requisition</label>
                                <select class="form-control" id="purpose">
                                    <option value="">Select Purpose</option>
                                    <option value="Month Requisition">Month Requisition</option>
                                    <option value="Extra Requisition">Extra Requisition</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Department Name <span class="text-danger">*</span></label>
                                <select class="form-control" id="department_name" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department }}" {{ $department === 'Administration' ? 'selected' : '' }}>
                                            {{ $department }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Applicant Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="applicant_name" value="Md. Rahim Uddin" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Designation</label>
                                <input type="text" class="form-control" id="designation" value="Senior Assistant">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" value="01711-223344">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Email Address</label>
                                <input type="email" class="form-control" id="email_address" value="rahim.uddin@gov.bd">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-1 text-primary">Item Details</h5>
                                <small class="text-muted">Use the action buttons to add or remove requisition items.</small>
                            </div>
                        </div>

                        <div class="table-responsive mb-3">
                            <table class="table table-bordered item-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 180px;">Item Name</th>
                                        <th style="min-width: 150px;">Product Type</th>
                                        <th style="min-width: 170px;">Category</th>
                                        <th style="min-width: 120px;">Unit</th>
                                        <th style="min-width: 130px;">Required Qty</th>
                                        <th style="min-width: 150px;">Estimated Unit Cost</th>
                                        <th style="min-width: 150px;">Estimated Total Cost</th>
                                        <th style="min-width: 180px;">Remarks</th>
                                        <th style="width: 95px;" class="no-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="requisitionItemRows">
                                    @foreach ($sampleItems as $itemIndex => $item)
                                        <tr data-item-row>
                                            <td>
                                                <input type="text" class="form-control form-control-sm item-name" value="{{ $item['item_name'] }}" required>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-product-type" name="items[{{ $itemIndex }}][product_type]" required>
                                                    <option value="">Select</option>
                                                    <option value="One time use" {{ isset($item['product_type']) && $item['product_type'] === 'One time use' ? 'selected' : '' }}>One time use</option>
                                                    <option value="All time use" {{ isset($item['product_type']) && $item['product_type'] === 'All time use' ? 'selected' : '' }}>All time use</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-category" name="items[{{ $itemIndex }}][category]" required>
                                                    <option value="">Select</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category }}" {{ $category === $item['category'] ? 'selected' : '' }}>
                                                            {{ $category }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-unit" required>
                                                    <option value="">Select</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit }}" {{ $unit === $item['unit'] ? 'selected' : '' }}>
                                                            {{ $unit }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" min="0" step="1" class="form-control form-control-sm text-right item-qty" value="{{ (int) $item['required_quantity'] }}" required>
                                            </td>
                                            <td>
                                                <input type="number" min="0" step="0.01" class="form-control form-control-sm text-right item-unit-cost" value="{{ $item['estimated_unit_cost'] }}" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm text-right item-total" value="0.00" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm item-remarks" value="{{ $item['remarks'] }}">
                                            </td>
                                            <td class="text-center no-print">
                                                <button type="button" class="btn btn-sm btn-outline-primary add-item-row-inline mr-1" title="Add Item Row" aria-label="Add Item Row">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="summary-card p-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="text-muted small">Total Quantity</div>
                                            <h4 class="mb-0" id="totalQuantity">0</h4>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-muted small">Grand Total Cost</div>
                                            <h4 class="mb-0" id="grandTotalCost">৳ 0.00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 text-lg-right align-self-end no-print">
                                <button type="button" class="btn btn-primary btn-lg px-4" id="saveNextSection1">
                                    Save &amp; Next <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SECTION 2 --}}
                <div class="card workflow-card mb-4" id="step-2" data-step-card="2">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 2</span>
                                <h4 class="card-title mb-0">Department Head Approval Form</h4>
                            </div>
                            <div class="text-muted">Review the requisition details and route it to the next authority.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="2">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-2">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="summary-card p-3 h-100">
                                    <h5 class="text-primary">Requisition Information</h5>
                                    <dl class="row mb-0">
                                        <dt class="col-sm-5">Requisition No</dt>
                                        <dd class="col-sm-7">IN-REQ-2026-0001</dd>
                                        <dt class="col-sm-5">Department</dt>
                                        <dd class="col-sm-7">Administration</dd>
                                        <dt class="col-sm-5">Applicant</dt>
                                        <dd class="col-sm-7">Md. Rahim Uddin</dd>
                                        <dt class="col-sm-5">Priority</dt>
                                        <dd class="col-sm-7">Urgent</dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">Recommendation</label>
                                        <div class="d-flex flex-wrap">
                                            <div class="custom-control custom-radio mr-4">
                                                <input type="radio" id="deptApprove" name="dept_recommendation" class="custom-control-input" checked>
                                                <label class="custom-control-label" for="deptApprove">Approve</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="deptReject" name="dept_recommendation" class="custom-control-input">
                                                <label class="custom-control-label" for="deptReject">Reject</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">Recommended Quantity</label>
                                        <input type="number" class="form-control" value="35" min="0" step="1">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="font-weight-bold">Department Head Remarks</label>
                                        <textarea class="form-control" rows="3">The requisition is justified for office operations and may be forwarded.</textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="font-weight-bold">Digital Signature Placeholder</label>
                                        <div class="signature-box">
                                            Department Head Digital Signature
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(1)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-success mr-2" onclick="goToSection(3)">
                                Approve &amp; Forward to NDC
                            </button>
                            <button type="button" class="btn btn-danger" onclick="goToSection(8)">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3 --}}
                <div class="card workflow-card mb-4" id="step-3" data-step-card="3">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 3</span>
                                <h4 class="card-title mb-0">NDC Review Form</h4>
                            </div>
                            <div class="text-muted">Assess budget availability, stock verification, and NDC recommendation.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="3">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-3">
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <div class="summary-card p-3 h-100">
                                    <h5 class="text-primary">Requisition Snapshot</h5>
                                    <p class="mb-1"><strong>No:</strong> IN-REQ-2026-0001</p>
                                    <p class="mb-1"><strong>Dept:</strong> Administration</p>
                                    <p class="mb-1"><strong>Applicant:</strong> Md. Rahim Uddin</p>
                                    <p class="mb-0"><strong>Status:</strong> Department Head Approved</p>
                                </div>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">Budget Availability</label>
                                        <select class="form-control">
                                            <option>Available</option>
                                            <option>Partially Available</option>
                                            <option>Not Available</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">Stock Verification Required</label>
                                        <select class="form-control">
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">Budget Remarks</label>
                                        <textarea class="form-control" rows="3">Budget head has sufficient allocation for the requested items.</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="font-weight-bold">NDC Recommendation</label>
                                        <select class="form-control">
                                            <option>Recommend</option>
                                            <option>Hold</option>
                                            <option>Reject</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="font-weight-bold">NDC Comments</label>
                                        <textarea class="form-control" rows="3">The requisition is budget compliant and may proceed to ADC.</textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="font-weight-bold">Attachment Upload</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="attachmentUpload">
                                            <label class="custom-file-label" for="attachmentUpload">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(2)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-primary mr-2" onclick="goToSection(4)">
                                Forward to ADC
                            </button>
                            <button type="button" class="btn btn-danger" onclick="goToSection(8)">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SECTION 4 --}}
                <div class="card workflow-card mb-4" id="step-4" data-step-card="4">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 4</span>
                                <h4 class="card-title mb-0">ADC Approval Form</h4>
                            </div>
                            <div class="text-muted">Confirm administrative and financial approvals.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="4">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-4">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Administrative Approval Status</label>
                                <select class="form-control">
                                    <option>Approved</option>
                                    <option>Pending</option>
                                    <option>Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Financial Approval Status</label>
                                <select class="form-control">
                                    <option>Approved</option>
                                    <option>Pending</option>
                                    <option>Rejected</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">ADC Remarks</label>
                                <textarea class="form-control" rows="3">Approved subject to store verification.</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="font-weight-bold">Digital Signature Placeholder</label>
                                <div class="signature-box">
                                    ADC Digital Signature
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(3)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-success mr-2" onclick="goToSection(5)">
                                Approve
                            </button>
                            <button type="button" class="btn btn-danger" onclick="goToSection(8)">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SECTION 5 --}}
                <div class="card workflow-card mb-4" id="step-5" data-step-card="5">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 5</span>
                                <h4 class="card-title mb-0">DC Approval Form</h4>
                            </div>
                            <div class="text-muted">Optional final approval for high-value or sensitive requisitions.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="5">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-5">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Final Decision</label>
                                <select class="form-control">
                                    <option>Final Approve</option>
                                    <option>Return for Review</option>
                                    <option>Reject</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">DC Remarks</label>
                                <textarea class="form-control" rows="3">Approved for store verification and issue processing.</textarea>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Signature Placeholder</label>
                                <div class="signature-box">
                                    DC Signature
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(4)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-success mr-2" onclick="goToSection(6)">
                                Final Approve
                            </button>
                            <button type="button" class="btn btn-danger" onclick="goToSection(8)">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SECTION 6 --}}
                <div class="card workflow-card mb-4" id="step-6" data-step-card="6">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 6</span>
                                <h4 class="card-title mb-0">Store Verification Form</h4>
                            </div>
                            <div class="text-muted">Verify stock availability and calculate issue quantities.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="6">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-6">
                        <div class="table-responsive">
                            <table class="table table-bordered workflow-table mb-3">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Requested Qty</th>
                                        <th>Available Qty</th>
                                        <th>Issue Qty</th>
                                        <th>Stock Status</th>
                                        <th>Store Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="storeVerificationRows">
                                    @foreach ($sampleItems as $itemIndex => $item)
                                        @php
                                            $requested = (int) $item['required_quantity'];
                                            $available = (int) max($requested - 2, 0);
                                            $issue = (int) min($requested, $available);
                                            $status = $available >= $requested ? 'In Stock' : ($available > 0 ? 'Partial' : 'Out of Stock');
                                        @endphp
                                        <tr>
                                            <td>{{ $item['item_name'] }}</td>
                                            <td><input type="number" class="form-control form-control-sm text-right store-requested" value="{{ $requested }}" readonly></td>
                                            <td><input type="number" class="form-control form-control-sm text-right store-available" value="{{ $available }}" min="0" step="1"></td>
                                            <td><input type="number" class="form-control form-control-sm text-right store-issue" value="{{ $issue }}" min="0" step="1"></td>
                                            <td><input type="text" class="form-control form-control-sm store-status" value="{{ $status }}" readonly></td>
                                            <td><input type="text" class="form-control form-control-sm store-remarks" value="Checked by store officer"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(5)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-primary mr-2" id="verifyStockBtn">
                                Verify Stock
                            </button>
                            <button type="button" class="btn btn-success" onclick="goToSection(7)">
                                Generate Issue Slip
                            </button>
                        </div>
                    </div>
                </div>

                {{-- SECTION 7 --}}
                <div class="card workflow-card mb-4" id="step-7" data-step-card="7">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <div class="d-flex align-items-center mb-1">
                                <span class="badge badge-step mr-2">Section 7</span>
                                <h4 class="card-title mb-0">Issue Slip</h4>
                            </div>
                            <div class="text-muted">Generate the final issue slip and use browser print for a PDF-style copy.</div>
                        </div>
                        <button type="button" class="btn btn-outline-primary section-toggle" data-toggle-step="7">
                            <i class="fas fa-angle-up"></i>
                        </button>
                    </div>
                    <div class="card-body workflow-body" id="body-7">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Issue Slip Number</label>
                                <input type="text" class="form-control" value="ISL-2026-0001" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Issue Date</label>
                                <input type="date" class="form-control" value="2026-06-10">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Requisition Number</label>
                                <input type="text" class="form-control" value="IN-REQ-2026-0001" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Department Name</label>
                                <input type="text" class="form-control" value="Administration" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Receiver Name</label>
                                <input type="text" class="form-control" value="Md. Rahim Uddin">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold">Receiver Designation</label>
                                <input type="text" class="form-control" value="Senior Assistant">
                            </div>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered workflow-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Approved Quantity</th>
                                        <th>Issued Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="issueSlipRows">
                                    @foreach ($sampleItems as $itemIndex => $item)
                                        @php
                                            $approved = (int) $item['required_quantity'];
                                            $issued = (int) max($approved - 2, 0);
                                        @endphp
                                        <tr>
                                            <td>{{ $item['item_name'] }}</td>
                                            <td><input type="number" class="form-control form-control-sm text-right issue-approved" value="{{ $approved }}" readonly></td>
                                            <td><input type="number" class="form-control form-control-sm text-right issue-issued" value="{{ $issued }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="signature-box">Prepared By</div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="signature-box">Store Officer</div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="signature-box">Received By</div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="signature-box">Approved By</div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-end no-print">
                            <button type="button" class="btn btn-outline-secondary mr-2" onclick="goToSection(6)">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
                            <button type="button" class="btn btn-primary mr-2" onclick="window.print()">
                                <i class="fas fa-print mr-2"></i>Print Slip
                            </button>
                            <button type="button" class="btn btn-success" onclick="window.print()">
                                <i class="fas fa-file-pdf mr-2"></i>Download PDF
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categories = @json($categories);
            const units = @json($units);

            const itemRows = document.getElementById('requisitionItemRows');
            const totalQuantityEl = document.getElementById('totalQuantity');
            const grandTotalCostEl = document.getElementById('grandTotalCost');
            const section1Alert = document.getElementById('section1Alert');
            const stepIndicators = document.querySelectorAll('[data-step-indicator]');
            const sectionCards = document.querySelectorAll('[data-step-card]');
            const form = document.getElementById('inventoryWorkflowForm');

            const numberValue = (value) => {
                const parsed = parseFloat(value);
                return Number.isFinite(parsed) ? parsed : 0;
            };

            const formatMoney = (value) => {
                return '৳ ' + new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }).format(value);
            };

            const showAlert = (messages) => {
                section1Alert.innerHTML = '<strong>Please complete the following:</strong><ul class="mb-0 pl-3 mt-2">' +
                    messages.map(message => `<li>${message}</li>`).join('') +
                    '</ul>';
                section1Alert.classList.remove('d-none');
            };

            const hideAlert = () => {
                section1Alert.classList.add('d-none');
                section1Alert.innerHTML = '';
            };

            const setInvalid = (element, state) => {
                if (!element) {
                    return;
                }
                element.classList.toggle('is-invalid', state);
            };

            const updateStepper = (stepNumber) => {
                stepIndicators.forEach((indicator) => {
                    indicator.classList.toggle('active', Number(indicator.dataset.stepIndicator) <= stepNumber);
                });
            };

            const expandSection = (stepNumber) => {
                const body = document.getElementById(`body-${stepNumber}`);
                const toggle = document.querySelector(`[data-toggle-step="${stepNumber}"]`);

                if (body) {
                    body.classList.remove('d-none');
                }

                if (toggle) {
                    toggle.innerHTML = '<i class="fas fa-angle-up"></i>';
                }
            };

            const collapseSection = (stepNumber) => {
                const body = document.getElementById(`body-${stepNumber}`);
                const toggle = document.querySelector(`[data-toggle-step="${stepNumber}"]`);

                if (body) {
                    body.classList.add('d-none');
                }

                if (toggle) {
                    toggle.innerHTML = '<i class="fas fa-angle-down"></i>';
                }
            };

            window.goToSection = function(stepNumber) {
                expandSection(stepNumber);
                updateStepper(stepNumber);

                const target = document.getElementById(`step-${stepNumber}`);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                }
            };

            const renderDerivedTables = () => {
                const requisitionRows = [...document.querySelectorAll('#requisitionItemRows tr')];
                const storeRows = [];
                const issueRows = [];

                requisitionRows.forEach((row, index) => {
                    const itemName = row.querySelector('.item-name')?.value?.trim() || `Item ${index + 1}`;
                    const requestedQty = numberValue(row.querySelector('.item-qty')?.value);
                    const availableQty = Math.max(requestedQty - 2, 0);
                    const issueQty = Math.min(requestedQty, availableQty);
                    const status = availableQty >= requestedQty ? 'In Stock' : (availableQty > 0 ? 'Partial' : 'Out of Stock');

                    storeRows.push(`
                        <tr>
                            <td>${itemName}</td>
                            <td><input type="number" class="form-control form-control-sm text-right store-requested" value="${requestedQty}" readonly></td>
                            <td><input type="number" class="form-control form-control-sm text-right store-available" value="${availableQty}" min="0" step="1"></td>
                            <td><input type="number" class="form-control form-control-sm text-right store-issue" value="${issueQty}" min="0" step="1"></td>
                            <td><input type="text" class="form-control form-control-sm store-status" value="${status}" readonly></td>
                            <td><input type="text" class="form-control form-control-sm store-remarks" value="Checked by store officer"></td>
                        </tr>
                    `);

                    issueRows.push(`
                        <tr>
                            <td>${itemName}</td>
                            <td><input type="number" class="form-control form-control-sm text-right issue-approved" value="${requestedQty}" readonly></td>
                            <td><input type="number" class="form-control form-control-sm text-right issue-issued" value="${issueQty}"></td>
                        </tr>
                    `);
                });

                document.getElementById('storeVerificationRows').innerHTML = storeRows.join('');
                document.getElementById('issueSlipRows').innerHTML = issueRows.join('');
            };

            const calculateSummary = () => {
                let totalQuantity = 0;
                let grandTotal = 0;

                document.querySelectorAll('#requisitionItemRows tr').forEach((row) => {
                    const quantityInput = row.querySelector('.item-qty');
                    const unitCostInput = row.querySelector('.item-unit-cost');
                    const totalInput = row.querySelector('.item-total');

                    const quantity = numberValue(quantityInput?.value);
                    const unitCost = numberValue(unitCostInput?.value);
                    const total = quantity * unitCost;

                    if (totalInput) {
                        totalInput.value = total.toFixed(2);
                    }

                    totalQuantity += quantity;
                    grandTotal += total;
                });

                totalQuantityEl.textContent = totalQuantity;
                grandTotalCostEl.textContent = formatMoney(grandTotal);
                renderDerivedTables();
            };

            const buildItemRow = (afterRow = null) => {
                const rowIndex = itemRows.querySelectorAll('tr').length;
                const categoryOptions = ['<option value="">Select</option>']
                    .concat(categories.map(category => `<option value="${category}">${category}</option>`))
                    .join('');
                const unitOptions = ['<option value="">Select</option>']
                    .concat(units.map(unit => `<option value="${unit}">${unit}</option>`))
                    .join('');

                const row = document.createElement('tr');
                row.setAttribute('data-item-row', '');
                row.innerHTML = `
                    <td><input type="text" class="form-control form-control-sm item-name" required></td>
                    <td>
                                                <select class="form-control form-control-sm item-product-type" name="items[{{ $itemIndex }}][product_type]" required>
                                                    <option value="">Select</option>
                                                    <option value="One time use" {{ isset($item['product_type']) && $item['product_type'] === 'One time use' ? 'selected' : '' }}>One time use</option>
                                                    <option value="All time use" {{ isset($item['product_type']) && $item['product_type'] === 'All time use' ? 'selected' : '' }}>All time use</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-category" name="items[{{ $itemIndex }}][category]" required>
                            ${categoryOptions}
                        </select>
                    </td>
                    <td>
                        <select class="form-control form-control-sm item-unit" required>
                            ${unitOptions}
                        </select>
                    </td>
                    <td><input type="number" min="0" step="1" class="form-control form-control-sm text-right item-qty" value="0" required></td>
                    <td><input type="number" min="0" step="0.01" class="form-control form-control-sm text-right item-unit-cost" value="0" required></td>
                    <td><input type="text" class="form-control form-control-sm text-right item-total" value="0.00" readonly></td>
                    <td><input type="text" class="form-control form-control-sm item-remarks"></td>
                    <td class="text-center no-print">
                        <button type="button" class="btn btn-sm btn-outline-primary add-item-row-inline mr-1" title="Add Item Row" aria-label="Add Item Row">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
                if (afterRow) {
                    afterRow.insertAdjacentElement('afterend', row);
                } else {
                    itemRows.appendChild(row);
                }
                calculateSummary();
            };

            const validateSectionOne = () => {
                hideAlert();
                const errors = [];

                const requiredFields = [
                    { element: document.getElementById('application_date'), label: 'Requisition Date' },
                    { element: document.getElementById('department_name'), label: 'Department Name' },
                    { element: document.getElementById('applicant_name'), label: 'Applicant Name' },
                    { element: document.getElementById('priority_level'), label: 'Priority Level' },
                ];

                requiredFields.forEach(({ element, label }) => {
                    const hasValue = element && String(element.value || '').trim().length > 0;
                    setInvalid(element, !hasValue);
                    if (!hasValue) {
                        errors.push(`${label} is required`);
                    }
                });

                document.querySelectorAll('#requisitionItemRows tr').forEach((row, index) => {
                    const itemName = row.querySelector('.item-name');
                    const itemCategory = row.querySelector('.item-category');
                    const itemUnit = row.querySelector('.item-unit');
                    const itemQty = row.querySelector('.item-qty');
                    const itemCost = row.querySelector('.item-unit-cost');

                    const rowChecks = [
                        { element: itemName, label: `Item ${index + 1}: Item Name` },
                        { element: itemCategory, label: `Item ${index + 1}: Category` },
                        { element: itemUnit, label: `Item ${index + 1}: Unit` },
                        { element: itemQty, label: `Item ${index + 1}: Required Quantity` },
                        { element: itemCost, label: `Item ${index + 1}: Estimated Unit Cost` },
                    ];

                    rowChecks.forEach(({ element, label }) => {
                        const hasValue = element && String(element.value || '').trim().length > 0 && numberValue(element.value) >= 0;
                        setInvalid(element, !hasValue);
                        if (!hasValue) {
                            errors.push(`${label} is required`);
                        }
                    });
                });

                if (errors.length) {
                    showAlert(errors);
                    return false;
                }

                calculateSummary();
                return true;
            };

            document.querySelectorAll('[data-toggle-step]').forEach((button) => {
                button.addEventListener('click', function() {
                    const stepNumber = this.dataset.toggleStep;
                    const body = document.getElementById(`body-${stepNumber}`);
                    const collapsed = body.classList.contains('d-none');

                    if (collapsed) {
                        expandSection(stepNumber);
                    } else {
                        collapseSection(stepNumber);
                    }
                });
            });

            itemRows.addEventListener('click', function(event) {
                const addButton = event.target.closest('.add-item-row-inline');
                if (addButton) {
                    buildItemRow(addButton.closest('tr'));
                    return;
                }

                const removeButton = event.target.closest('.remove-item-row');
                if (!removeButton) {
                    return;
                }

                const rows = itemRows.querySelectorAll('tr');
                const currentRow = removeButton.closest('tr');

                if (rows.length > 1) {
                    currentRow.remove();
                } else {
                    currentRow.querySelectorAll('input, select').forEach((field) => {
                        if (!field.readOnly) {
                            field.value = '';
                        }
                    });
                    currentRow.querySelector('.item-total').value = '0.00';
                }

                calculateSummary();
            });

            itemRows.addEventListener('input', function() {
                calculateSummary();
            });

            itemRows.addEventListener('change', function() {
                calculateSummary();
            });

            document.getElementById('saveNextSection1').addEventListener('click', function() {
                if (validateSectionOne()) {
                    goToSection(2);
                }
            });

            document.getElementById('verifyStockBtn').addEventListener('click', function() {
                document.querySelectorAll('#storeVerificationRows tr').forEach((row) => {
                    const requested = numberValue(row.querySelector('.store-requested')?.value);
                    const available = numberValue(row.querySelector('.store-available')?.value);
                    const issueInput = row.querySelector('.store-issue');
                    const statusInput = row.querySelector('.store-status');

                    const issueQuantity = Math.min(requested, available);
                    if (issueInput) {
                        issueInput.value = issueQuantity;
                    }

                    if (statusInput) {
                        statusInput.value = available >= requested ? 'In Stock' : (available > 0 ? 'Partial' : 'Out of Stock');
                    }
                });
            });

            document.getElementById('attachmentUpload')?.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (label) {
                    label.textContent = this.files && this.files.length ? this.files[0].name : 'Choose file';
                }
            });

            document.getElementById('storeVerificationRows').addEventListener('input', function() {
                document.querySelectorAll('#storeVerificationRows tr').forEach((row) => {
                    const requested = numberValue(row.querySelector('.store-requested')?.value);
                    const available = numberValue(row.querySelector('.store-available')?.value);
                    const issueInput = row.querySelector('.store-issue');
                    const statusInput = row.querySelector('.store-status');
                    if (issueInput) {
                        issueInput.value = Math.min(requested, available);
                    }
                    if (statusInput) {
                        statusInput.value = available >= requested ? 'In Stock' : (available > 0 ? 'Partial' : 'Out of Stock');
                    }
                });
            });

            calculateSummary();
            goToSection(1);
        });
    </script>
@endpush
