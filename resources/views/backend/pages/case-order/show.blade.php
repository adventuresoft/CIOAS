@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderList'])

@push('style')
    <style>
        .co-page {
            --co-primary: #1e40af;
            --co-primary-dark: #1e3a8a;
            --co-line: #e2e8f0;
            --co-ink: #1e293b;
            --co-muted: #64748b;
            background: linear-gradient(135deg, rgba(30, 64, 175, .07), rgba(245, 158, 11, .05)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 40px;
        }

        .co-hero {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            color: #fff; border-radius: 10px; padding: 22px 28px;
            box-shadow: 0 12px 30px rgba(30, 64, 175, .25); margin-bottom: 20px;
        }
        .co-hero h1 { font-size: 22px; font-weight: 700; margin: 0; }
        .co-hero p { color: rgba(255,255,255,.75); margin: 4px 0 0; font-size: 13px; }
        .co-hero-icon {
            width: 52px; height: 52px; display: grid; place-items: center;
            border-radius: 10px; background: rgba(255,255,255,.15); font-size: 22px;
        }

        .co-card {
            background: #fff; border: 1px solid var(--co-line);
            border-radius: 10px; box-shadow: 0 8px 24px rgba(15,23,42,.07);
            overflow: hidden; margin-bottom: 24px;
        }

        .co-card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 1px solid var(--co-line);
            background: linear-gradient(180deg, #fff, #f8fbff);
        }
        .co-card-title {
            font-size: 16px; font-weight: 700; color: var(--co-ink);
            display: flex; align-items: center; gap: 8px; margin: 0;
        }
        .co-card-title i { color: var(--co-primary); }
        .co-card-body { padding: 20px; }

        .md-label { font-size: 13px; font-weight: 700; color: var(--co-muted); margin-bottom: 6px; display: block; }
        .md-input {
            border: 1px solid var(--co-line); border-radius: 8px; padding: 9px 12px;
            width: 100%; font-size: 14px; transition: border-color .2s;
        }
        .md-input:focus { border-color: var(--co-primary); outline: none; box-shadow: 0 0 0 3px rgba(30,64,175,.1); }
        .md-select { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 10px center; background-size: 16px; padding-right: 32px; }

        /* Timeline */
        .timeline {
            position: relative; padding-left: 30px;
        }
        .timeline::before {
            content: ''; position: absolute; left: 11px; top: 0; bottom: 0;
            width: 2px; background: linear-gradient(to bottom, #1e40af, #e2e8f0);
            border-radius: 2px;
        }
        .timeline-item { position: relative; margin-bottom: 24px; }
        .timeline-dot {
            position: absolute; left: -30px; top: 10px;
            width: 22px; height: 22px; border-radius: 50%;
            background: #1e40af; color: #fff; font-size: 10px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 4px rgba(30,64,175,.15);
        }
        .timeline-card {
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 10px; padding: 16px 18px;
            transition: box-shadow .2s;
        }
        .timeline-card:hover { box-shadow: 0 4px 16px rgba(30,64,175,.1); }
        .timeline-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 10px; flex-wrap: wrap; gap: 8px;
        }
        .timeline-title {
            font-size: 14px; font-weight: 700; color: var(--co-ink);
            display: flex; align-items: center; gap: 8px;
        }
        .timeline-meta { font-size: 12px; color: var(--co-muted); }
        .timeline-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px; margin-top: 10px;
        }
        .tg-item label { font-size: 11px; font-weight: 700; color: var(--co-muted); text-transform: uppercase; display: block; }
        .tg-item span { font-size: 13px; color: var(--co-ink); }

        .status-pill {
            display: inline-block; padding: 3px 10px; border-radius: 999px;
            font-size: 12px; font-weight: 700;
        }
        .status-pill.হয়নি, .status-pill.pending  { background: #fef9c3; color: #854d0e; text-transform: capitalize; }
        .status-pill.হмеется, .status-pill.হবে, .status-pill.হিয়েছে, .status-pill.হয়েছে, .status-pill.approved { background: #dcfce7; color: #166534; text-transform: capitalize; }
        .status-pill.মুলতবি, .status-pill.postponed { background: #fee2e2; color: #991b1b; text-transform: capitalize; }
        .status-pill.draft { background: #e2e8f0; color: #334155; text-transform: capitalize; }
        .status-pill.running { background: #dbeafe; color: #1e40af; text-transform: capitalize; }
        .status-pill.closed { background: #f3f4f6; color: #374151; text-transform: capitalize; }
        .status-pill.rejected { background: #fee2e2; color: #991b1b; text-transform: capitalize; }

        .action-row { display: flex; gap: 8px; align-items: center; }
        .action-btn {
            display: inline-flex; align-items: center; justify-content: center;
            padding: 5px 12px; border-radius: 7px; border: none; cursor: pointer;
            font-size: 12px; font-weight: 600; text-decoration: none; transition: all .2s; gap: 4px;
        }
        .action-btn:hover { transform: translateY(-1px); }
        .btn-clock { background: #f59e0b; color: #fff; }
    </style>
@endpush

@section('title', 'Case Order — ' . ($misCase->case_no ?? 'Details'))
@section('content')
    <section class="content co-page">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="mb-4">
                <h3>কেস নং: {{ $misCase->case_no ?? 'N/A' }}</h3>
                <p class="text-muted">
                    ধরণ: {{ $misCase->case_type_label ?? '—' }} &nbsp;|&nbsp;
                    বাদী: {{ !empty($misCase->plaintiffs) ? ($misCase->plaintiffs[0]['name'] ?? '—') : '—' }} &nbsp;|&nbsp;
                    বিবাদী: {{ !empty($misCase->defendants) ? ($misCase->defendants[0]['name'] ?? '—') : '—' }}
                </p>
            </div>

            {{-- Order History --}}
            @if ($caseOrders->count() > 0)
                <div class="co-card">
                    <div class="co-card-header">
                        <h3 class="co-card-title"><i class="fas fa-history"></i> শুনানির ইতিহাস</h3>
                        <div>
                            <a href="{{ route('miscase.show', $misCase->id) }}" class="btn btn-info btn-sm mr-2 text-white" style="font-weight:700;">
                                <i class="fas fa-eye"></i> মিসকেস বিবরণ
                            </a>
                            <span class="badge badge-secondary px-3 py-2">মোট: {{ $caseOrders->count() }}</span>
                        </div>
                    </div>
                    <div class="co-card-body">
                        <div class="timeline">
                            @foreach ($caseOrders as $order)
                                <div class="timeline-item">
                                    <div class="timeline-dot">{{ sprintf('H%05d', $order->id) }}</div>
                                    <div class="timeline-card">
                                        <div class="timeline-header">
                                            <div class="timeline-title">
                                                <i class="fas fa-gavel" style="color:#1e40af;"></i>
                                                <span class="status-pill {{ $order->status_class }}">{{ $order->status_label }}</span>
                                            </div>
                                            <div class="action-row">
                                                <span class="timeline-meta">
                                                    {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '' }}
                                                </span>
                                                @if($order->command_type == 'yes')
                                                    <a href="{{ route('caseorder.printOrder', $order->id) }}" target="_blank" class="action-btn btn-clock ml-2" style="background:#3b82f6; color:#fff;">
                                                        <i class="fas fa-print"></i> আদেশপত্র প্রিন্ট
                                                    </a>
                                                @endif
                                                <a href="{{ route('caseorder.printNotice', $order->id) }}" target="_blank" class="action-btn btn-clock ml-2" style="background:#10b981; color:#fff;">
                                                    <i class="fas fa-print"></i> কেস অর্ডার বিবরণ (নোটিশ প্রিন্ট)
                                                </a>
                                            </div>
                                        </div>
                                        <div class="timeline-grid">
                                            <div class="tg-item">
                                                <label>পরবর্তী শুনানি</label>
                                                <span>{{ $order->next_hearing_date ? $order->next_hearing_date->format('d/m/Y') : '—' }}</span>
                                            </div>
                                            <div class="tg-item">
                                                <label>সময়</label>
                                                <span>{{ $order->next_hearing_time ?? '—' }}</span>
                                            </div>
                                            <div class="tg-item">
                                                <label>Command</label>
                                                <span>{{ $order->command_type_label ?? '—' }}</span>
                                            </div>
                                            @if ($order->memorial_no)
                                                <div class="tg-item">
                                                    <label>স্মারক নম্বর</label>
                                                    <span>{{ $order->memorial_no }}</span>
                                                </div>
                                            @endif
                                            @if ($order->command_start_date)
                                                <div class="tg-item">
                                                    <label>আদেশের শুরুর তারিখ</label>
                                                    <span>{{ $order->command_start_date->format('d/m/Y') }}</span>
                                                </div>
                                            @endif
                                            @if ($order->command_till_date)
                                                <div class="tg-item">
                                                    <label>আদেশের মেয়াদকালীন তারিখ</label>
                                                    <span>{{ $order->command_till_date->format('d/m/Y') }}</span>
                                                </div>
                                            @endif
                                            @if ($order->command_end_date)
                                                <div class="tg-item">
                                                    <label>আদেশের সমাপ্তির তারিখ</label>
                                                    <span>{{ $order->command_end_date->format('d/m/Y') }}</span>
                                                </div>
                                            @endif
                                            @if ($order->command_text)
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>Command Text</label>
                                                    <span>{{ $order->command_text }}</span>
                                                </div>
                                            @endif
                                            @if ($order->order_law)
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>Order Law</label>
                                                    <span>{{ $order->order_law }}</span>
                                                </div>
                                            @endif
                                            @if ($order->form_number)
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>Form Number</label>
                                                    <span>{{ $order->form_number }}</span>
                                                </div>
                                            @endif
                                            @if ($order->side_note)
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>Side Note</label>
                                                    <span>{{ $order->side_note }}</span>
                                                </div>
                                            @endif
                                            @if (!empty($order->files))
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>সংযুক্ত নথিপত্র</label>
                                                    <div class="attachment-list" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px;">
                                                        @foreach ($order->files as $file)
                                                            @php
                                                                $filePath = is_array($file) ? $file['path'] ?? '' : $file;
                                                                $fileName = is_array($file) ? $file['name'] ?? basename($filePath) : basename($filePath);
                                                            @endphp
                                                            @if ($filePath)
                                                                <div class="attachment-chip" style="display: inline-flex; align-items: center; gap: 6px; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 999px; padding: 4px 10px; font-size: 12px;">
                                                                    <i class="fas fa-file-alt" style="color: #1e40af;"></i>
                                                                    <a href="{{ asset($filePath) }}" target="_blank" style="color: #1e293b; text-decoration: none; font-weight: 600;">
                                                                        {{ $fileName }}
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($order->creator)
                                                <div class="tg-item" style="grid-column: span 2;">
                                                    <label>সাবমিট করেছেন</label>
                                                    <span>
                                                        {{ $order->creator->name }}
                                                        @if ($order->creator->department || $order->creator->section)
                                                            ({{ $order->creator->department->name ?? '' }}
                                                            @if ($order->creator->section)
                                                                - {{ $order->creator->section->name ?? '' }}
                                                            @endif)
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

@push('script')
@endpush
