@extends('backend.master', ['mainMenu' => 'MisCase', 'subMenu' => 'MisCaseList'])

@section('title', 'Mis Case Details')

@push('style')
    <style>
        .mc-page {
            --mc-primary: #0f766e;
            --mc-primary-dark: #115e59;
            --mc-line: #e2e8f0;
            --mc-ink: #1e293b;
            --mc-muted: #64748b;
            background: linear-gradient(135deg, rgba(15, 118, 110, .07), rgba(245, 158, 11, .05)), #f8fafc;
            min-height: calc(100vh - 120px);
            padding-bottom: 40px;
        }

        .mc-card {
            background: #fff;
            border: 1px solid var(--mc-line);
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .07);
            overflow: hidden;
            margin-bottom: 24px;
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

        .mc-card-body {
            padding: 20px;
        }

        /* Detail grids */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
        }

        .info-item label {
            font-size: 11px;
            font-weight: 700;
            color: var(--mc-muted);
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        .info-item span {
            font-size: 14px;
            color: var(--mc-ink);
            font-weight: 600;
        }

        /* Table */
        .mc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .mc-table th {
            background: #f1f5f9;
            color: var(--mc-muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 12px 14px;
            border-bottom: 2px solid var(--mc-line);
            white-space: nowrap;
        }

        .mc-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--mc-line);
            color: var(--mc-ink);
            vertical-align: middle;
        }

        .mc-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Parties */
        .party-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .party-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .party-card strong {
            color: var(--mc-primary);
            font-size: 15px;
            display: block;
            margin-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
        }

        .party-card div {
            margin-bottom: 4px;
            font-size: 13px;
            color: var(--mc-ink);
        }

        .party-card span {
            color: var(--mc-muted);
            font-weight: 600;
        }

        /* Attachment chips */
        .attachment-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 12px;
        }

        .attachment-card {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 14px;
            transition: all 0.2s;
            text-decoration: none !important;
            color: inherit !important;
            min-width: 200px;
        }

        .attachment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: var(--mc-primary);
            background: #ecfdf5;
        }

        .attachment-icon {
            font-size: 24px;
            color: var(--mc-primary);
        }

        .attachment-details {
            display: flex;
            flex-direction: column;
        }

        .attachment-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--mc-ink);
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .attachment-action {
            font-size: 11px;
            color: var(--mc-primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .form-control.md-control {
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 14px;
        }

        .form-control.md-control:focus {
            border-color: var(--mc-primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .12);
        }
    </style>
@endpush

@section('content')
    @php
        $notesText = is_array($miscase->notes) ? $miscase->notes['notes'] ?? '' : $miscase->notes;
        $locationRows = is_array($miscase->land_info) ? $miscase->land_info : [];
        $plaintiffs = is_array($miscase->plaintiffs) ? $miscase->plaintiffs : [];
        $defendants = is_array($miscase->defendants) ? $miscase->defendants : [];
    @endphp

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Case Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('miscase.index') }}">Mis Case</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mc-page">
        <div class="container-fluid">

            {{-- Date Update Card --}}
            <div class="mc-card">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-calendar-alt"></i> শুনানির তারিখ সংযোজন</h3>
                </div>
                <div class="mc-card-body">
                    <form method="POST" class="form" id="FormSubmit"
                        data-url="{{ route('miscase.updateNextHearingDate', $miscase->id) }}"
                        data-redirect-url="{{ route('miscase.index') }}">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                @if (!empty($miscase->next_hearing_date))
                                    <input type="date" name="next_hearing_date" id="next_hearing_date"
                                        class="form-control md-control"
                                        value="{{ old('next_hearing_date', optional($miscase->next_hearing_date ?? null)->format('Y-m-d')) }}">
                                    <small class="text-danger error next_hearing_date_error"></small>
                                @else
                                    <p class="text-muted mb-0">শুনানির তারিখ সংযোজন করুন</p>
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <button type="submit" class="btn btn-primary" style="font-weight:700;">
                                    শুনানির তারিখ সংযোজন
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Case Info Card --}}
            <div class="mc-card">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-folder-open"></i> Case Information</h3>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('miscase.print', $miscase->id) }}" target="_blank" class="btn btn-info btn-sm text-white font-weight-bold">
                            <i class="fas fa-print"></i> কেস হিস্ট্রি প্রিন্ট (প্যাড)
                        </a>
                        @if ($miscase->status !== 'closed')
                            <a href="{{ route('miscase.edit', $miscase->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit Case
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mc-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>মিসকেস নম্বর</label>
                            <span>{{ $miscase->case_no }}</span>
                        </div>
                        <div class="info-item">
                            <label>মিসকেস রুজুর তারিখ</label>
                            <span>{{ optional($miscase->case_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>মিসকেস ধরণ</label>
                            <span>{{ $miscase->case_type_label ?: '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>ক্যাটাগরি</label>
                            <span>{{ $miscase->case_category_label ?: '-' }}</span>
                        </div>
                        <div class="info-item">
                            <label>মিসকেস ফিস</label>
                            <span>{{ number_format($miscase->case_fee, 2) }} ৳</span>
                        </div>
                        <div class="info-item">
                            <label>পরবর্তী শুনানির তারিখ</label>
                            <span>{{ optional($miscase->next_hearing_date)->format('d/m/Y') ?: '-' }}</span>
                        </div>
                    </div>

                    @if ($miscase->case_details)
                        <div class="mt-4">
                            <label class="text-muted font-weight-bold" style="font-size:12px;text-transform:uppercase;">বিস্তারিত</label>
                            <div class="p-3 bg-light rounded text-dark" style="font-size:14px;white-space:pre-line;">
                                {{ $miscase->case_details }}
                            </div>
                        </div>
                    @endif

                    @if ($miscase->rejection_reason)
                        <div class="mt-3">
                            <label class="text-danger font-weight-bold" style="font-size:12px;text-transform:uppercase;">নিস্পত্তি না হওয়ার কারণ</label>
                            <div class="p-3 bg-light rounded text-danger" style="font-size:14px;white-space:pre-line;">
                                {{ $miscase->rejection_reason }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Parties Info Card --}}
            <div class="mc-card">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-users"></i> বাদীর তথ্য ও বিবাদীর তথ্য</h3>
                </div>
                <div class="mc-card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h5 class="mb-3 font-weight-bold text-dark"><i class="fas fa-chevron-circle-right text-success mr-1"></i> Plaintiffs (বাদী)</h5>
                            @forelse ($plaintiffs as $party)
                                <div class="party-card">
                                    <strong>{{ $party['name'] ?? '-' }}</strong>
                                    <div><span>NID:</span> {{ $party['nid'] ?? '-' }}</div>
                                    <div><span>Father:</span> {{ $party['father_name'] ?? '-' }}</div>
                                    <div><span>Mobile:</span> {{ $party['mobile'] ?? '-' }}</div>
                                    <div><span>Address:</span> {{ $party['address'] ?? '-' }}</div>
                                </div>
                            @empty
                                <p class="text-muted pl-2">No plaintiff added.</p>
                            @endforelse
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3 font-weight-bold text-dark"><i class="fas fa-chevron-circle-right text-danger mr-1"></i> Defendants (বিবাদী)</h5>
                            @forelse ($defendants as $party)
                                <div class="party-card">
                                    <strong>{{ $party['name'] ?? '-' }}</strong>
                                    <div><span>NID:</span> {{ $party['nid'] ?? '-' }}</div>
                                    <div><span>Father:</span> {{ $party['father_name'] ?? '-' }}</div>
                                    <div><span>Mobile:</span> {{ $party['mobile'] ?? '-' }}</div>
                                    <div><span>Address:</span> {{ $party['address'] ?? '-' }}</div>
                                </div>
                            @empty
                                <p class="text-muted pl-2">No defendant added.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Location & Land Records Card --}}
            <div class="mc-card">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-map-marked-alt"></i> Location And Land Records</h3>
                </div>
                <div class="mc-card-body">
                    <div class="table-responsive">
                        <table class="mc-table">
                            <thead>
                                <tr>
                                    <th>Record</th>
                                    <th>District</th>
                                    <th>Upazila</th>
                                    <th>Mouza</th>
                                    <th>Dag no</th>
                                    <th>Khatian</th>
                                    <th>Record Group</th>
                                    <th>Total Land In Dag</th>
                                    <th>Total Land</th>
                                    <th>Owner</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locationRows as $row)
                                    <tr>
                                        <td><span class="badge badge-light border">{{ $row['record'] ?? '-' }}</span></td>
                                        <td>{{ $locationNames['districts'][$row['district_id'] ?? null] ?? '-' }}</td>
                                        <td>{{ $locationNames['thanas'][$row['thana_id'] ?? null] ?? '-' }}</td>
                                        <td>{{ $locationNames['mouzas'][$row['mouza_id'] ?? null] ?? '-' }}</td>
                                        <td><strong>{{ $row['dag_no'] ?? '-' }}</strong></td>
                                        <td>{{ $row['khatian'] ?? '-' }}</td>
                                        <td>{{ $row['record_group'] ?? '-' }}</td>
                                        <td>{{ $row['total_dag_no'] ?? '-' }}</td>
                                        <td>{{ $row['total_land'] ?? '-' }}</td>
                                        <td>{{ $row['record_owner_name'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">No land record added.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Notes & Documents Card --}}
            <div class="mc-card mb-4">
                <div class="mc-card-header">
                    <h3 class="mc-card-title"><i class="fas fa-paperclip"></i> Notes And Documents</h3>
                </div>
                <div class="mc-card-body">
                    <div class="mb-4">
                        <label class="text-muted font-weight-bold" style="font-size:12px;text-transform:uppercase;">Notes</label>
                        <p class="p-3 bg-light rounded text-dark" style="font-size:14px;">{{ $notesText ?: 'No notes added.' }}</p>
                    </div>

                    <div>
                        <label class="text-muted font-weight-bold" style="font-size:12px;text-transform:uppercase;">Attached Documents</label>
                        <div class="attachment-container">
                            @if (!empty($miscase->files))
                                @foreach ($miscase->files as $file)
                                    @php
                                        $filePath = is_array($file) ? $file['path'] ?? '' : $file;
                                        $fileName = is_array($file)
                                            ? $file['name'] ?? basename($filePath)
                                            : basename($filePath);
                                    @endphp
                                    @if ($filePath)
                                        <a href="{{ asset($filePath) }}" target="_blank" class="attachment-card">
                                            <i class="fas fa-file-alt attachment-icon"></i>
                                            <div class="attachment-details">
                                                <span class="attachment-name" title="{{ $fileName }}">{{ $fileName }}</span>
                                                <span class="attachment-action"><i class="fas fa-external-link-alt"></i> View File</span>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            @else
                                <span class="text-muted d-block pl-2">No documents uploaded.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
