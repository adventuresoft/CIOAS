@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderCreate'])

@push('style')
    <style>
        .co-page {
            --co-primary: #1e40af;
            --co-primary-dark: #1e3a8a;
            --co-accent: #f59e0b;
            --co-ink: #1e293b;
            --co-muted: #64748b;
            --co-line: #e2e8f0;
            --co-surface: #ffffff;
            --co-soft: #eff6ff;
            background: linear-gradient(135deg, rgba(30, 64, 175, .08), rgba(245, 158, 11, .06)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 32px;
        }

        .co-hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            color: #fff;
            border-radius: 10px;
            padding: 22px 28px;
            box-shadow: 0 12px 30px rgba(30, 64, 175, .25);
            margin-bottom: 20px;
        }

        .co-hero h1 { font-size: 24px; font-weight: 700; margin: 0; }
        .co-hero p { color: rgba(255,255,255,.75); margin: 5px 0 0; font-size: 14px; }
        .co-hero-icon {
            width: 56px; height: 56px; display: grid; place-items: center;
            border-radius: 10px; background: rgba(255,255,255,.15); font-size: 24px;
        }

        .co-card {
            background: #fff;
            border: 1px solid var(--co-line);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15,23,42,.07);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .co-card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 1px solid var(--co-line);
            background: linear-gradient(180deg,#fff,#f8fbff);
        }

        .co-card-title {
            font-size: 16px; font-weight: 700; color: var(--co-ink);
            display: flex; align-items: center; gap: 8px; margin: 0;
        }
        .co-card-title i { color: var(--co-primary); }

        .co-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .co-table thead th {
            background: #f1f5f9; color: var(--co-muted); font-size: 12px;
            font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
            padding: 12px 14px; border-bottom: 2px solid var(--co-line); white-space: nowrap;
        }
        .co-table tbody td {
            padding: 12px 14px; border-bottom: 1px solid var(--co-line);
            color: var(--co-ink); vertical-align: middle;
        }
        .co-table tbody tr:hover { background: #f8faff; }
        .co-table tbody tr:last-child td { border-bottom: none; }

        .action-btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 6px 14px; border-radius: 8px; border: none; cursor: pointer;
            font-size: 13px; font-weight: 600; text-decoration: none; transition: all .2s; gap: 5px;
        }
        .action-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.15); }
        .btn-order { background: #10b981; color: #fff; }
        .btn-clock { background: #f59e0b; color: #fff; }

        /* Modal Styles */
        .co-modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45);
            z-index: 9999; align-items: center; justify-content: center;
        }
        .co-modal-overlay.active { display: flex; }
        .co-modal {
            background: #fff; border-radius: 12px; width: 100%; max-width: 560px;
            box-shadow: 0 24px 60px rgba(0,0,0,.2); overflow: hidden;
            animation: coSlideIn .25s ease;
        }
        @keyframes coSlideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .co-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 22px; background: linear-gradient(135deg,#1e40af,#1e3a8a); color: #fff;
        }
        .co-modal-header h5 { margin: 0; font-size: 16px; font-weight: 700; }
        .co-modal-close {
            background: rgba(255,255,255,.15); border: none; color: #fff; border-radius: 50%;
            width: 30px; height: 30px; cursor: pointer; font-size: 16px; display: grid; place-items: center;
        }
        .co-modal-body { padding: 22px; }
        .co-modal-footer { padding: 14px 22px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px; }

        .md-label { font-size: 13px; font-weight: 700; color: var(--co-muted); margin-bottom: 6px; display: block; }
        .md-input {
            border: 1px solid var(--co-line); border-radius: 8px; padding: 9px 12px;
            width: 100%; font-size: 14px; transition: border-color .2s;
        }
        .md-input:focus { border-color: var(--co-primary); outline: none; box-shadow: 0 0 0 3px rgba(30,64,175,.1); }
    </style>
@endpush

@section('title', 'New Case Order')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>নতুন কেস অর্ডার</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('caseorder.index') }}">Case Order</a></li>
                        <li class="breadcrumb-item active">নতুন</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content co-page">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="co-card">
                <div class="co-card-header">
                    <h3 class="co-card-title"><i class="fas fa-clipboard-list"></i> নথিভুক্তির অপেক্ষায় কেসগুলো</h3>
                    <span class="badge badge-warning px-3 py-2">
                        মোট: {{ $pendingCases->total() }}
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="co-table">
                        <thead>
                            <tr>
                                <th>শুনানি নং</th>
                                <th>কেস নং</th>
                                <th>পরবর্তী শুনানি</th>
                                <th>মামলার ধরণ</th>
                                <th>বাদী</th>
                                <th>বিবাদী</th>
                                <th>পদক্ষেপ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingCases as $key => $case)
                                @php
                                    $plaintiff = !empty($case->plaintiffs) ? ($case->plaintiffs[0]['name'] ?? '—') : '—';
                                    $defendant = !empty($case->defendants) ? ($case->defendants[0]['name'] ?? '—') : '—';
                                @endphp
                                <tr>
                                    <td><span class="badge badge-light border">—</span></td>
                                    <td><strong>{{ $case->case_no ?? 'N/A' }}</strong></td>
                                    <td>
                                        {{ $case->next_hearing_date ? $case->next_hearing_date->format('d/m/Y') : '—' }}
                                    </td>
                                    <td>{{ $case->case_type_label ?? '—' }}</td>
                                    <td>{{ $plaintiff }}</td>
                                    <td>{{ $defendant }}</td>
                                    <td>
                                        <div style="display:flex;gap:6px;">
                                            {{-- Order button --}}
                                            <a href="{{ route('caseorder.register', $case->id) }}"
                                                class="action-btn btn-order"
                                                title="অর্ডার নথিভুক্ত করুন">
                                                <i class="fas fa-edit"></i> অর্ডার
                                            </a>
                                            {{-- Time Change button --}}
                                            <a href="{{ route('caseorder.register', $case->id) }}"
                                                class="action-btn btn-clock"
                                                title="সময় ও তারিখ পরিবর্তন">
                                                <i class="fas fa-clock"></i> সময়
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-check-circle fa-2x mb-2 d-block text-success"></i>
                                        সব মিসকেস নথিভুক্ত হয়ে গেছে!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($pendingCases->hasPages())
                    <div class="p-3">{{ $pendingCases->links() }}</div>
                @endif
            </div>
        </div>
    </section>

@endsection


