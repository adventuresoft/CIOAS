@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderList'])

@push('style')
    <style>
        .hearing-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #1e40af;
            border: 1px solid rgba(30, 64, 175, .2);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 10px;
            min-width: 36px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-badge.হয়নি, .status-badge.pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .status-badge.হিয়েছে,
        .status-badge.হмеется,
        .status-badge.হয়েছে,
        .status-badge.approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.মুলতবি, .status-badge.postponed {
            background: #fee2e2;
            color: #991b1b;
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
            color: #fff !important;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .btn-clock {
            background: #f59e0b;
        }

        .btn-eye {
            background: #0ea5e9;
        }

        .btn-order {
            background: #10b981;
        }
    </style>
@endpush

@section('title', 'All Case Order')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list-alt"></i> কেস অর্ডার তালিকা
                        </h3>
                        <a href="{{ route('caseorder.create') }}" class="btn btn-material btn-material-primary">
                            <i class="fas fa-plus-circle"></i> নতুন কেস অর্ডার
                        </a>
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
