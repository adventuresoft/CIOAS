@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'HearingNotice'])

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

        .co-hero h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }

        .co-hero p {
            color: rgba(255, 255, 255, .75);
            margin: 5px 0 0;
            font-size: 14px;
        }

        .co-card {
            background: var(--co-surface);
            border: 1px solid var(--co-line);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .07);
            overflow: hidden;
        }

        .co-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--co-line);
            background: linear-gradient(180deg, #fff, #f8fbff);
        }

        .co-card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--co-ink);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .co-card-title i {
            color: var(--co-primary);
        }

        .co-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .co-table thead th {
            background: #f1f5f9;
            color: var(--co-muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 12px 14px;
            border-bottom: 2px solid var(--co-line);
            white-space: nowrap;
        }

        .co-table tbody td {
            padding: 14px 14px;
            border-bottom: 1px solid var(--co-line);
            color: var(--co-ink);
            vertical-align: middle;
        }

        .co-table tbody tr:hover {
            background: #f8faff;
        }

        .co-table tbody tr:last-child td {
            border-bottom: none;
        }

        .hearing-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--co-soft);
            color: var(--co-primary);
            border: 1px solid rgba(30, 64, 175, .2);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 10px;
            min-width: 36px;
        }

        /* Border indicator colors on first column */
        .td-today {
            border-left: 4px solid #ef4444 !important;
        }
        .td-tomorrow {
            border-left: 4px solid #f97316 !important;
        }
        .td-day-after {
            border-left: 4px solid #eab308 !important;
        }
        .td-future {
            border-left: 4px solid #10b981 !important;
        }

        /* Status badges */
        .badge-today {
            background: #fee2e2;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 4px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .badge-today .pulse-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .badge-tomorrow {
            background: #ffedd5;
            color: #ea580c;
            border: 1px solid rgba(234, 88, 12, 0.3);
            padding: 4px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .badge-tomorrow .dot {
            width: 8px;
            height: 8px;
            background: #ea580c;
            border-radius: 50%;
        }

        .badge-day-after {
            background: #fef9c3;
            color: #ca8a04;
            border: 1px solid rgba(202, 138, 4, 0.3);
            padding: 4px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .badge-day-after .dot {
            width: 8px;
            height: 8px;
            background: #ca8a04;
            border-radius: 50%;
        }

        .badge-future {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid rgba(21, 128, 61, 0.3);
            padding: 4px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .badge-future .dot {
            width: 8px;
            height: 8px;
            background: #15803d;
            border-radius: 50%;
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

        .btn-order {
            background: #10b981;
            color: #fff;
        }

        .case-link {
            color: var(--co-primary);
            text-decoration: none;
            transition: color 0.2s;
        }
        .case-link:hover {
            color: var(--co-primary-dark);
            text-decoration: underline;
        }
    </style>
@endpush

@section('title', 'Hearing Notice')
@section('content')
    <section class="content co-page">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="co-card">
                <div class="co-card-header">
                    <h3 class="co-card-title"><i class="fas fa-bullhorn text-danger"></i> আজকের ও পরবর্তী শুনানির তালিকা</h3>
                    <span class="text-muted font-weight-bold" style="font-size: 13px;">
                        আজ: {{ \Carbon\Carbon::today()->format('d/m/Y') }}
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="co-table">
                        <thead>
                            <tr>
                                <th>শুনানি নং</th>
                                <th>অবস্থা</th>
                                <th>কেস নং</th>
                                <th>শুনানির তারিখ</th>
                                <th>মামলার ধরণ</th>
                                <th>বাদী</th>
                                <th>বিবাদী</th>
                                <th>পদক্ষেপ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cases as $key => $case)
                                @php
                                    $plaintiff = !empty($case->plaintiffs) ? ($case->plaintiffs[0]['name'] ?? '—') : '—';
                                    $defendant = !empty($case->defendants) ? ($case->defendants[0]['name'] ?? '—') : '—';
                                    
                                    // Get hearing ID from latest CaseOrder
                                    $latestOrder = $case->caseOrders->first();
                                    $hearingId = $latestOrder ? sprintf('H%05d', $latestOrder->id) : '—';

                                    // Calculate difference in days to determine colors
                                    $todayDate = \Carbon\Carbon::today();
                                    $hearingDate = \Carbon\Carbon::parse($case->next_hearing_date);
                                    $diffInDays = $todayDate->diffInDays($hearingDate, false);
                                    
                                    if ($diffInDays <= 0) {
                                        $tdClass = 'td-today';
                                        $badgeClass = 'badge-today';
                                        $badgeText = 'আজ';
                                        $dotHtml = '<span class="pulse-dot"></span>';
                                    } elseif ($diffInDays == 1) {
                                        $tdClass = 'td-tomorrow';
                                        $badgeClass = 'badge-tomorrow';
                                        $badgeText = 'আগামীকাল';
                                        $dotHtml = '<span class="dot"></span>';
                                    } elseif ($diffInDays == 2) {
                                        $tdClass = 'td-day-after';
                                        $badgeClass = 'badge-day-after';
                                        $badgeText = 'পরশু';
                                        $dotHtml = '<span class="dot"></span>';
                                    } else {
                                        $tdClass = 'td-future';
                                        $badgeClass = 'badge-future';
                                        $badgeText = 'আসন্ন';
                                        $dotHtml = '<span class="dot"></span>';
                                    }
                                @endphp
                                <tr>
                                    <td class="{{ $tdClass }}">
                                        <span class="hearing-badge">{{ $hearingId }}</span>
                                    </td>
                                    <td>
                                        <span class="{{ $badgeClass }}">
                                            {!! $dotHtml !!} {{ $badgeText }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('caseorder.register', $case->id) }}" class="case-link" title="অর্ডার রেজিস্টার করুন">
                                            <strong>{{ $case->case_no ?? '—' }}</strong>
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $case->next_hearing_date ? $case->next_hearing_date->format('d/m/Y') : '—' }}</strong>
                                        @if ($case->case_time)
                                            <br><small class="text-muted"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($case->case_time)->format('h:i A') }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $case->case_type_label ?? '—' }}</td>
                                    <td>{{ $plaintiff }}</td>
                                    <td>{{ $defendant }}</td>
                                    <td>
                                        <div style="display:flex;gap:6px;align-items:center;">
                                            {{-- Eye icon: view history --}}
                                            <a href="{{ route('caseorder.show', $case->id) }}"
                                               class="action-btn btn-eye" title="ইতিহাস দেখুন">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            {{-- Order button: register/add new order --}}
                                            <a href="{{ route('caseorder.register', $case->id) }}"
                                               class="action-btn btn-order" title="অর্ডার রেজিস্টার করুন">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                        আজ বা পরবর্তী সময়ে কোনো শুনানি পাওয়া যায়নি।
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($cases->hasPages())
                    <div class="p-3">{{ $cases->links() }}</div>
                @endif
            </div>

        </div>
    </section>
@endsection
