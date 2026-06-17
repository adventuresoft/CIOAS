@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseDateEdit'])

@push('style')
    <style>
        .co-page {
            --co-primary: #1e40af;
            --co-line: #e2e8f0;
            --co-ink: #1e293b;
            --co-muted: #64748b;
            background: linear-gradient(135deg, rgba(30,64,175,.07), rgba(245,158,11,.05)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 40px;
        }

        .co-hero {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff; border-radius: 10px; padding: 22px 28px;
            box-shadow: 0 12px 30px rgba(245,158,11,.3); margin-bottom: 24px;
        }
        .co-hero h1 { font-size: 22px; font-weight: 700; margin: 0; }
        .co-hero p { color: rgba(255,255,255,.8); margin: 4px 0 0; font-size: 13px; }
        .co-hero-icon {
            width: 52px; height: 52px; display: grid; place-items: center;
            border-radius: 10px; background: rgba(255,255,255,.2); font-size: 22px;
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
        .co-card-title i { color: #f59e0b; }
        .co-card-body { padding: 28px; }

        .info-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px; margin-bottom: 24px; padding: 16px;
            background: #fefce8; border: 1px solid #fde68a; border-radius: 8px;
        }
        .info-item label { font-size: 11px; font-weight: 700; color: var(--co-muted); text-transform: uppercase; display: block; margin-bottom: 3px; }
        .info-item span { font-size: 14px; color: var(--co-ink); font-weight: 600; }

        .form-section { margin-bottom: 24px; }
        .form-section-title {
            font-size: 14px; font-weight: 700; color: #f59e0b;
            margin-bottom: 14px; padding-bottom: 8px;
            border-bottom: 2px solid #fde68a;
            display: flex; align-items: center; gap: 8px;
        }

        .md-label { font-size: 13px; font-weight: 700; color: var(--co-muted); margin-bottom: 6px; display: block; }
        .md-input {
            border: 1px solid var(--co-line); border-radius: 8px; padding: 10px 14px;
            width: 100%; font-size: 14px; transition: all .2s;
        }
        .md-input:focus {
            border-color: #f59e0b; outline: none;
            box-shadow: 0 0 0 3px rgba(245,158,11,.12);
        }

        .action-bar {
            display: flex; justify-content: flex-end; gap: 10px; padding-top: 16px;
            border-top: 1px solid var(--co-line); margin-top: 8px;
        }

        .warning-note {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fff7ed; border: 1px solid #fed7aa; border-radius: 8px;
            padding: 14px 16px; margin-bottom: 20px; font-size: 13px; color: #9a3412;
        }
        .warning-note i { margin-top: 2px; flex-shrink: 0; }
    </style>
@endpush

@section('title', 'তারিখ ও সময় পরিবর্তন')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>তারিখ ও সময় পরিবর্তন</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('caseorder.index') }}">Case Order</a></li>
                        <li class="breadcrumb-item active">তারিখ পরিবর্তন</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content co-page">
        <div class="container-fluid" style="max-width: 720px;">

            <div class="mb-4">
                <h3><i class="fas fa-clock mr-2"></i> তারিখ ও সময় পরিবর্তন</h3>
                <p class="text-muted">
                    কেস নং: <strong>{{ $caseOrder->misCase->case_no ?? 'N/A' }}</strong>
                    &nbsp;|&nbsp; শুনানি নং: {{ sprintf('H%05d', $caseOrder->id) }}
                </p>
            </div>

            <div class="co-card">
                <div class="co-card-header">
                    <h3 class="co-card-title"><i class="fas fa-edit"></i> শুনানির তারিখ সংশোধন</h3>
                    <div>
                        <a href="{{ route('miscase.show', $caseOrder->mis_case_id) }}" class="btn btn-info btn-sm mr-2 text-white" style="font-weight:700;">
                            <i class="fas fa-eye"></i> মিসকেস বিবরণ
                        </a>
                        <a href="{{ route('caseorder.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> ফিরে যান
                        </a>
                    </div>
                </div>
                <div class="co-card-body">

                    {{-- Current info --}}
                    <div class="info-grid">
                        <div class="info-item">
                            <label>কেস নং</label>
                            <span>{{ $caseOrder->misCase->case_no ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <label>বর্তমান তারিখ</label>
                            <span>
                                {{ $caseOrder->next_hearing_date
                                    ? $caseOrder->next_hearing_date->format('d/m/Y')
                                    : '—' }}
                            </span>
                        </div>
                        <div class="info-item">
                            <label>বর্তমান সময়</label>
                            <span>{{ $caseOrder->next_hearing_time ?? '—' }}</span>
                        </div>
                        <div class="info-item">
                            <label>শুনানি নং</label>
                            <span>{{ sprintf('H%05d', $caseOrder->id) }}</span>
                        </div>
                    </div>

                    <div class="warning-note">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            তারিখ পরিবর্তন করলে সংশ্লিষ্ট <strong>মিসকেস</strong>-এর তারিখও স্বয়ংক্রিয়ভাবে আপডেট হয়ে যাবে।
                        </div>
                    </div>

                    <form action="{{ route('caseorder.update', $caseOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="fas fa-calendar-alt"></i> নতুন তারিখ ও সময়
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">স্মারক নম্বর (Memorial Number)</label>
                                    <input type="text" name="memorial_no" class="md-input @error('memorial_no') is-invalid @enderror"
                                        value="{{ old('memorial_no', $caseOrder->memorial_no) }}" placeholder="স্মারক নম্বর লিখুন">
                                    @error('memorial_no')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">পরবর্তী শুনানির তারিখ <span class="text-danger">*</span></label>
                                    <input type="date" name="next_hearing_date" class="md-input @error('next_hearing_date') is-invalid @enderror" required
                                        value="{{ old('next_hearing_date', $caseOrder->next_hearing_date ? $caseOrder->next_hearing_date->format('Y-m-d') : '') }}">
                                    @error('next_hearing_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">সময় (HH:MM)</label>
                                    <input type="time" name="next_hearing_time" class="md-input @error('next_hearing_time') is-invalid @enderror"
                                        value="{{ old('next_hearing_time', $caseOrder->next_hearing_time ?? '') }}">
                                    @error('next_hearing_time')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">Command Start-date (আদেশের শুরুর তারিখ)</label>
                                    <input type="date" name="command_start_date" class="md-input @error('command_start_date') is-invalid @enderror"
                                        value="{{ old('command_start_date', $caseOrder->command_start_date ? $caseOrder->command_start_date->format('Y-m-d') : '') }}">
                                    @error('command_start_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">Command Till-date (আদেশের মেয়াদকালীন তারিখ)</label>
                                    <input type="date" name="command_till_date" class="md-input @error('command_till_date') is-invalid @enderror"
                                        value="{{ old('command_till_date', $caseOrder->command_till_date ? $caseOrder->command_till_date->format('Y-m-d') : '') }}">
                                    @error('command_till_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="md-label">Command End-date (আদেশের সমাপ্তির তারিখ)</label>
                                    <input type="date" name="command_end_date" class="md-input @error('command_end_date') is-invalid @enderror"
                                        value="{{ old('command_end_date', $caseOrder->command_end_date ? $caseOrder->command_end_date->format('Y-m-d') : '') }}">
                                    @error('command_end_date')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="action-bar">
                            <a href="{{ route('caseorder.index') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> বাতিল
                            </a>
                            <button type="submit" class="btn btn-warning text-white" style="font-weight:700;">
                                <i class="fas fa-save"></i> তারিখ আপডেট করুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('script')
@endpush
