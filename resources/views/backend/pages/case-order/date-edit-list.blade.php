@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseDateEdit'])

@push('style')
    <style>
        .co-page {
            --co-primary: #d97706;
            --co-line: #e2e8f0;
            --co-ink: #1e293b;
            --co-muted: #64748b;
            background: linear-gradient(135deg, rgba(217,119,6,.07), rgba(30,64,175,.05)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 40px;
        }

        .co-hero {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #d97706, #b45309);
            color: #fff; border-radius: 10px; padding: 22px 28px;
            box-shadow: 0 12px 30px rgba(217,119,6,.3); margin-bottom: 20px;
        }
        .co-hero h1 { font-size: 24px; font-weight: 700; margin: 0; }
        .co-hero p { color: rgba(255,255,255,.75); margin: 5px 0 0; font-size: 14px; }
        .co-hero-icon {
            width: 56px; height: 56px; display: grid; place-items: center;
            border-radius: 10px; background: rgba(255,255,255,.15); font-size: 24px;
        }

        .co-card {
            background: #fff; border: 1px solid var(--co-line);
            border-radius: 10px; box-shadow: 0 8px 24px rgba(15,23,42,.07); overflow: hidden;
        }
        .co-card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 1px solid var(--co-line);
            background: linear-gradient(180deg,#fff,#fffbeb);
        }
        .co-card-title {
            font-size: 16px; font-weight: 700; color: var(--co-ink);
            display: flex; align-items: center; gap: 8px; margin: 0;
        }
        .co-card-title i { color: var(--co-primary); }

        .co-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .co-table thead th {
            background: #fffbeb; color: var(--co-muted); font-size: 12px;
            font-weight: 700; text-transform: uppercase; letter-spacing: .04em;
            padding: 12px 14px; border-bottom: 2px solid #fde68a; white-space: nowrap;
        }
        .co-table tbody td {
            padding: 12px 14px; border-bottom: 1px solid var(--co-line);
            color: var(--co-ink); vertical-align: middle;
        }
        .co-table tbody tr:hover { background: #fffbeb; }
        .co-table tbody tr:last-child td { border-bottom: none; }

        .changed-badge {
            display: inline-flex; align-items: center; gap: 5px;
            background: #fef3c7; color: #92400e; border: 1px solid #fbbf24;
            border-radius: 999px; font-size: 11px; font-weight: 700; padding: 3px 10px;
        }

        .action-btn {
            display: inline-flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: 8px; border: none;
            cursor: pointer; font-size: 15px; text-decoration: none; transition: all .2s;
        }
        .action-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.15); }
        .btn-clock { background: #f59e0b; color: #fff; }
        .btn-eye { background: #0ea5e9; color: #fff; }
    </style>
@endpush

@section('title', 'Case Date Edit List')
@section('content')
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
                    <h3 class="co-card-title"><i class="fas fa-clock"></i> তারিখ পরিবর্তিত কেসের তালিকা</h3>
                    <span class="badge badge-warning text-dark px-3 py-2">মোট: {{ $caseOrders->total() }}</span>
                </div>
                <div class="table-responsive">
                    <table class="co-table">
                        <thead>
                            <tr>
                                <th>শুনানি নং</th>
                                <th>কেস নং</th>
                                <th>পরবর্তী শুনানি</th>
                                <th>সময়</th>
                                <th>মামলার ধরণ</th>
                                <th>বাদী</th>
                                <th>বিবাদী</th>
                                <th>পদক্ষেপ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($caseOrders as $key => $order)
                                @php
                                    $misCase = $order->misCase;
                                    $plaintiff = $misCase && !empty($misCase->plaintiffs) ? ($misCase->plaintiffs[0]['name'] ?? '—') : '—';
                                    $defendant = $misCase && !empty($misCase->defendants) ? ($misCase->defendants[0]['name'] ?? '—') : '—';
                                @endphp
                                <tr>
                                    <td>
                                        <span class="badge badge-warning text-dark">{{ sprintf('H%05d', $order->id) }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $misCase->case_no ?? '—' }}</strong>
                                        <div><span class="changed-badge"><i class="fas fa-clock"></i> পরিবর্তিত</span></div>
                                    </td>
                                    <td>
                                        <strong>{{ $order->next_hearing_date ? $order->next_hearing_date->format('d/m/Y') : '—' }}</strong>
                                    </td>
                                    <td>{{ $order->next_hearing_time ?? '—' }}</td>
                                    <td>{{ $misCase->case_type_label ?? '—' }}</td>
                                    <td>{{ $plaintiff }}</td>
                                    <td>{{ $defendant }}</td>
                                    <td>
                                        <div style="display:flex;gap:6px;align-items:center;">
                                            {{-- Clock: date/time edit --}}
                                            <a href="{{ route('caseorder.edit', $order->id) }}"
                                               class="action-btn btn-clock" title="তারিখ পরিবর্তন">
                                                <i class="fas fa-clock"></i>
                                            </a>
                                            {{-- Eye: view history --}}
                                            <a href="{{ route('caseorder.show', $misCase->id ?? $order->mis_case_id) }}"
                                               class="action-btn btn-eye" title="ইতিহাস দেখুন">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-calendar-check fa-2x mb-2 d-block text-success"></i>
                                        এখনো কোনো তারিখ পরিবর্তন হয়নি।
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($caseOrders->hasPages())
                    <div class="p-3">{{ $caseOrders->links() }}</div>
                @endif
            </div>

        </div>
    </section>
@endsection

@push('script')
@endpush
