@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderList'])

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

        .co-hero-icon {
            width: 56px;
            height: 56px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: rgba(255, 255, 255, .15);
            font-size: 24px;
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
            padding: 12px 14px;
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
        .status-badge.হয়েছে,
        .status-badge.হмеется,
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
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .btn-clock {
            background: #f59e0b;
            color: #fff;
        }

        .btn-eye {
            background: #0ea5e9;
            color: #fff;
        }

        .btn-order {
            background: #10b981;
            color: #fff;
        }
    </style>
@endpush

@section('title', 'All Case Order')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>শুনানির তথ্য — সকল</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('caseorder.create') }}">Case Order</a></li>
                        <li class="breadcrumb-item active">All Case Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

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
                    <h3 class="co-card-title"><i class="fas fa-list-alt"></i> কেস অর্ডার তালিকা</h3>
                    <a href="{{ route('caseorder.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> নতুন কেস অর্ডার
                    </a>
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
                                <th>স্ট্যাটাস</th>
                                <th>পদক্ষেপ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($caseOrders as $key => $order)
                                @php
                                    $misCase = $order->misCase;
                                    $plaintiff = $misCase && !empty($misCase->plaintiffs) ? ($misCase->plaintiffs[0]['name'] ?? '—') : '—';
                                    $defendant = $misCase && !empty($misCase->defendants) ? ($misCase->defendants[0]['name'] ?? '—') : '—';
                                    $statusClass = $order->status_class;
                                @endphp
                                <tr>
                                    <td><span class="hearing-badge">{{ sprintf('H%05d', $order->id) }}</span></td>
                                    <td>
                                        <strong>{{ $misCase->case_no ?? '—' }}</strong>
                                    </td>
                                    <td>
                                        {{ $order->next_hearing_date ? $order->next_hearing_date->format('d/m/Y') : '—' }}
                                        @if ($order->next_hearing_time)
                                            <br><small class="text-muted">{{ $order->next_hearing_time }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $misCase->case_type_label ?? '—' }}</td>
                                    <td>{{ $plaintiff }}</td>
                                    <td>{{ $defendant }}</td>
                                    <td><span class="status-badge {{ $statusClass }}">{{ $order->status_label }}</span></td>
                                    <td>
                                        <div style="display:flex;gap:6px;align-items:center;">
                                            {{-- Clock icon: date/time edit --}}
                                            <a href="{{ route('caseorder.edit', $order->id) }}"
                                               class="action-btn btn-clock" title="তারিখ পরিবর্তন">
                                                <i class="fas fa-clock"></i>
                                            </a>
                                            {{-- Eye icon: view history --}}
                                            <a href="{{ route('caseorder.show', $misCase->id ?? $order->mis_case_id) }}"
                                               class="action-btn btn-eye" title="ইতিহাস দেখুন">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            {{-- Order button: add new order --}}
                                            <a href="{{ route('caseorder.register', $misCase->id ?? $order->mis_case_id) }}"
                                               class="action-btn btn-order" title="অর্ডার যোগ করুন">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                        কোনো কেস অর্ডার পাওয়া যায়নি।
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
