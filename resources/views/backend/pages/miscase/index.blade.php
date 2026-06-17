@extends('backend.master', ['mainMenu' => 'MisCase', 'subMenu' => 'MisCaseList'])

@push('style')
    <style>
        .mc-page {
            --mc-primary: #0f766e;
            --mc-primary-dark: #115e59;
            --mc-accent: #f59e0b;
            --mc-ink: #1e293b;
            --mc-muted: #64748b;
            --mc-line: #e2e8f0;
            --mc-surface: #ffffff;
            --mc-soft: #eff6ff;
            background: linear-gradient(135deg, rgba(15, 118, 110, .08), rgba(245, 158, 11, .06)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 32px;
        }

        .mc-card {
            background: var(--mc-surface);
            border: 1px solid var(--mc-line);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .07);
            overflow: hidden;
        }

        .mc-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--mc-line);
            background: linear-gradient(180deg, #fff, #f8fbfb);
        }

        .mc-card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--mc-ink);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .mc-card-title i {
            color: var(--mc-primary);
        }

        .mc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .mc-table thead th {
            background: #f1f5f9;
            color: var(--mc-muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 12px 14px;
            border-bottom: 2px solid var(--mc-line);
            white-space: nowrap;
        }

        .mc-table tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--mc-line);
            color: var(--mc-ink);
            vertical-align: middle;
        }

        .mc-table tbody tr:hover {
            background: #f8fbfb;
        }

        .mc-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-badge.draft {
            background: #f1f5f9;
            color: #475569;
        }

        .status-badge.running {
            background: #ecfeff;
            color: #0e7490;
        }

        .status-badge.closed {
            background: #ecfdf5;
            color: #047857;
        }

        .status-badge.rejected {
            background: #fef2f2;
            color: #b91c1c;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            transition: all .2s;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .btn-eye {
            background: #0ea5e9;
            color: #fff;
        }

        .btn-edit {
            background: #10b981;
            color: #fff;
        }

        .btn-delete {
            background: #ef4444;
            color: #fff;
        }

        /* DataTables Custom Styling to match premium theme */
        .dt-container .dt-search input {
            border: 1px solid var(--mc-line);
            border-radius: 6px;
            padding: 5px 10px;
            outline: none;
            font-size: 14px;
            color: var(--mc-ink);
            background-color: var(--mc-surface);
            transition: border-color 0.2s;
        }
        .dt-container .dt-search input:focus {
            border-color: var(--mc-primary);
        }
        .dt-container .dt-length select {
            border: 1px solid var(--mc-line);
            border-radius: 6px;
            padding: 4px 8px;
            outline: none;
            font-size: 14px;
            color: var(--mc-ink);
        }
        .dt-container .dt-paging .dt-paging-button {
            border: 1px solid var(--mc-line) !important;
            border-radius: 6px !important;
            background: var(--mc-surface) !important;
            color: var(--mc-ink) !important;
            padding: 4px 10px !important;
            margin: 0 2px !important;
            font-weight: 600 !important;
            font-size: 13px !important;
        }
        .dt-container .dt-paging .dt-paging-button.current {
            background: var(--mc-primary) !important;
            color: #ffffff !important;
            border-color: var(--mc-primary) !important;
        }
        .dt-container .dt-paging .dt-paging-button:hover:not(.current) {
            background: #f1f5f9 !important;
            color: var(--mc-ink) !important;
        }
    </style>
@endpush

@section('title', 'Missed Case')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Missed Case List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Missed Case</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mc-page">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="mc-card">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-list-alt"></i> মিসকেস তালিকা</h3>
                    <a href="{{ route('miscase.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Create
                    </a>
                </div>
                <div class="table-responsive p-3">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{ $dataTable->scripts() }}
@endpush