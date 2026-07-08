@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => $subMenuName ?? 'InventoryRequisitionCreate'])

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

        .inventory-step.completed {
            border-color: rgba(25, 135, 84, 0.25);
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
        }

        .inventory-step.active .step-circle {
            background: var(--inventory-blue);
            color: #fff;
        }

        .inventory-step.completed .step-circle {
            background: #198754;
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

        .badge-step {
            background: #edf4ff;
            color: var(--inventory-blue-dark);
            border: 1px solid #d8e6ff;
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

        .item-action-group {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .item-action-btn {
            width: 28px;
            height: 26px;
            padding: 0;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            line-height: 1;
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

        .form-control:focus,
        .custom-select:focus,
        .custom-file-input:focus {
            border-color: rgba(13, 110, 253, 0.5);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
        }

        @media print {
            .main-sidebar,
            .main-header,
            .content-header,
            .inventory-stepper,
            .no-print,
            .btn,
            .breadcrumb,
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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($showStepper ?? true)
                <div class="mb-4">
                    <div class="inventory-stepper">
                        @foreach ($workflowSteps as $step)
                            <div class="inventory-step {{ $step['id'] === $currentStep ? 'active' : ($step['id'] < $currentStep ? 'completed' : '') }}">
                                <div class="step-circle">
                                    <i class="fas {{ $step['icon'] }}"></i>
                                </div>
                                <div class="step-label">{{ $step['id'] }}. {{ $step['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @include('backend.pages.inventory.steps.step' . $currentStep)
        </div>
    </section>
@endsection
