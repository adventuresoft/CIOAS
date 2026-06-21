@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])

@section('title', 'জমির বিবরণী')

@push('style')
    <style>
        .miscase-page {
            --mc-primary: #0f766e;
            --mc-primary-dark: #115e59;
            --mc-accent: #f59e0b;
            --mc-ink: #17202a;
            --mc-muted: #64748b;
            --mc-line: #dbe5ea;
            --mc-surface: #ffffff;
            --mc-soft: #eef7f5;
            background:
                linear-gradient(135deg, rgba(15, 118, 110, .12), rgba(245, 158, 11, .09)),
                #f5f7fa;
            min-height: calc(100vh - 120px);
            padding-bottom: 32px;
        }

        .miscase-shell {
            max-width: 1320px;
            margin: 0 auto;
        }

        .miscase-panel {
            background: var(--mc-surface);
            border: 1px solid rgba(219, 229, 234, .85);
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .miscase-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--mc-line);
            background: linear-gradient(180deg, #fff, #f8fbfb);
        }

        .miscase-panel-title {
            display: flex;
            gap: 10px;
            align-items: center;
            color: var(--mc-ink);
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .miscase-panel-title i {
            color: var(--mc-primary);
        }

        .miscase-panel-body {
            padding: 18px;
        }

        .info-card {
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            padding: 16px;
            height: 100%;
            background: #fbfdfd;
        }

        .info-label {
            font-size: 12px;
            color: var(--mc-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            font-weight: 700;
        }

        .info-value {
            font-size: 15px;
            color: var(--mc-ink);
            font-weight: 600;
        }

        .table-custom {
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 0;
        }

        .table-custom th {
            background: rgba(15, 118, 110, .05);
            color: var(--mc-ink);
            font-weight: 700;
            border-bottom: 2px solid var(--mc-line) !important;
            border-top: none;
            padding: 12px 15px;
            font-size: 14px;
        }

        .table-custom td {
            vertical-align: middle;
            color: #475569;
            border-color: var(--mc-line);
            padding: 12px 15px;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        .miscase-actions {
            align-items: center;
            background: rgba(255, 255, 255, .9);
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            bottom: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .1);
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            padding: 12px;
            position: sticky;
            z-index: 9;
        }

        .btn-material {
            border-radius: 8px;
            font-weight: 700;
            padding: 10px 18px;
        }

        .btn-material-primary {
            background: var(--mc-primary);
            border-color: var(--mc-primary);
            color: #fff;
        }

        .btn-material-primary:hover {
            background: var(--mc-primary-dark);
            border-color: var(--mc-primary-dark);
            color: #fff;
        }
        
        .btn-material-success {
            background: #10b981;
            border-color: #10b981;
            color: #fff;
        }

        .btn-material-success:hover {
            background: #059669;
            border-color: #059669;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>জমির বিবরণী</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('land.index') }}">জমির রেকর্ড</a></li>
                        <li class="breadcrumb-item active">বিবরণী</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content miscase-page pt-5">
        <div class="container-fluid">
            <div class="miscase-shell">

                <div class="miscase-panel">
                    <div class="miscase-panel-header">
                        <h3 class="miscase-panel-title"><i class="fas fa-info-circle"></i> জমির রেকর্ড বিবরণী</h3>
                        <div>
                            @if ($land->status == 1)
                                <span class="badge badge-success px-3 py-2" style="font-size: 14px; border-radius: 6px;"><i class="fas fa-check-circle mr-1"></i> অনুমোদিত</span>
                            @else
                                <span class="badge badge-warning px-3 py-2" style="font-size: 14px; border-radius: 6px;"><i class="fas fa-clock mr-1"></i> অপেক্ষমান</span>
                            @endif
                        </div>
                    </div>
                    <div class="miscase-panel-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="info-card">
                                    <div class="info-label">জমির ধরণ</div>
                                    <div class="info-value">{{ $land->land_type }}</div>
                                </div>
                            </div>
                            @if($land->status == 1)
                                <div class="col-md-4 mb-3">
                                    <div class="info-card" style="background: rgba(16, 185, 129, 0.05); border-color: rgba(16, 185, 129, 0.2);">
                                        <div class="info-label text-success">অনুমোদনকারী</div>
                                        <div class="info-value">
                                            {{ $land->approvedBy->name ?? 'System' }} 
                                            @if($land->approvedBy && $land->approvedBy->mobile)
                                                <br><small class="text-muted"><i class="fas fa-phone-alt"></i> {{ $land->approvedBy->mobile }}</small>
                                            @endif
                                            <br><small class="text-muted"><i class="far fa-clock"></i> {{ $land->approved_at ? \Carbon\Carbon::parse($land->approved_at)->format('d/m/Y h:i A') : '—' }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="miscase-panel">
                    <div class="miscase-panel-header">
                        <h3 class="miscase-panel-title"><i class="fas fa-map-marker-alt"></i> Location Information</h3>
                    </div>
                    <div class="miscase-panel-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>রেকর্ড</th>
                                        <th>জেলা</th>
                                        <th>উপজেলা</th>
                                        <th>মৌজা</th>
                                        <th>রেকর্ড গ্রুপ</th>
                                        <th>দাগ নং</th>
                                        <th>খতিয়ান নং</th>
                                        <th>মোট দাগ নং</th>
                                        <th>মোট জমি</th>
                                        <th>মালিকের নাম</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($land->locations as $loc)
                                        <tr>
                                            <td><span class="badge badge-info">{{ $loc->record_type }}</span></td>
                                            <td>{{ $loc->district->name ?? '—' }}</td>
                                            <td>{{ $loc->upazila->name ?? '—' }}</td>
                                            <td>{{ $loc->mouza->name ?? '—' }}</td>
                                            <td>{{ $loc->record_group ?? '—' }}</td>
                                            <td><span class="font-weight-bold text-dark">{{ $loc->dag_no ?? '—' }}</span></td>
                                            <td><span class="font-weight-bold text-dark">{{ $loc->khatian_no ?? '—' }}</span></td>
                                            <td>{{ $loc->total_dag_no ?? '—' }}</td>
                                            <td><span class="font-weight-bold text-success">{{ $loc->total_land ? number_format($loc->total_land, 4) : '—' }}</span></td>
                                            <td>{{ $loc->owner_name ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x mb-2 d-block"></i> কোনো লোকেশন যুক্ত নেই।</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="miscase-panel">
                    <div class="miscase-panel-header">
                        <h3 class="miscase-panel-title"><i class="fas fa-list-ol"></i> যুক্তকৃত জমির বিবরণী তালিকা</h3>
                    </div>
                    <div class="miscase-panel-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>দাগ নং</th>
                                        <th>খতিয়ান নং</th>
                                        <th>রেকর্ডীয় শ্রেণি</th>
                                        <th>বাস্তব শ্রেণি</th>
                                        <th>দাগে মোট জমি (একর)</th>
                                        <th>জমির পরিমাণ (একর)</th>
                                        <th>দখল সংক্রান্ত অবস্থা</th>
                                        <th>মামলা নং</th>
                                        <th>গেজেট/প্রমাণক নাম্বার</th>
                                        <th>রেকর্ডীয় মালিকের নাম</th>
                                        <th>মন্তব্য</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($land->details as $row)
                                        <tr>
                                            <td><span class="font-weight-bold text-dark">{{ $row->dag_no }}</span></td>
                                            <td><span class="font-weight-bold text-dark">{{ $row->khatian_no }}</span></td>
                                            <td><span class="badge badge-info">{{ $row->recorded_class }}</span></td>
                                            <td><span class="badge badge-secondary">{{ $row->actual_class }}</span></td>
                                            <td>{{ number_format($row->total_land, 4) }}</td>
                                            <td><span class="font-weight-bold text-success">{{ number_format($row->land_amount, 4) }}</span></td>
                                            <td>{{ $row->possession_status }}</td>
                                            <td>{{ $row->case_no ?? '—' }}</td>
                                            <td>{{ $row->gazette_no ?? '—' }}</td>
                                            <td>{{ $row->recorded_owner_name ?? '—' }}</td>
                                            <td>{{ $row->remarks ?? '—' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x mb-2 d-block"></i> কোনো বিবরণ যুক্ত নেই।</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="miscase-panel">
                    <div class="miscase-panel-header">
                        <h3 class="miscase-panel-title"><i class="fas fa-paperclip"></i> সংযুক্ত ফাইলসমূহ</h3>
                    </div>
                    <div class="miscase-panel-body">
                        @if(count($land->documents))
                            <div class="row">
                                @foreach($land->documents as $doc)
                                    <div class="col-md-4 mb-3">
                                        <div class="info-card d-flex flex-row justify-content-between align-items-center" style="padding: 12px 16px;">
                                            <div class="text-truncate">
                                                <i class="far fa-file-alt text-primary fa-lg mr-2"></i>
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="font-weight-bold text-dark" title="{{ $doc->document_name }}">
                                                    {{ \Illuminate\Support\Str::limit($doc->document_name, 25) }}
                                                </a>
                                            </div>
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" download class="btn btn-sm btn-outline-info" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0"><i class="fas fa-exclamation-circle"></i> কোনো ফাইল যুক্ত করা হয়নি।</p>
                        @endif
                    </div>
                </div>

                <div class="miscase-actions">
                    <a href="{{ route('land.index') }}" class="btn btn-light btn-material">
                        <i class="fas fa-arrow-left"></i> ব্যাক করুন
                    </a>
                    @if($land->status == 0)
                        <a href="{{ route('land.edit', $land->id) }}" class="btn btn-material btn-material-primary">
                            <i class="fas fa-edit"></i> সংশোধন করুন
                        </a>
                        <button type="button" class="btn btn-material btn-material-success" id="btnApproveShow">
                            <i class="fas fa-check-circle"></i> অনুমোদন করুন
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#btnApproveShow').on('click', function(e) {
                e.preventDefault();
                if (confirm('আপনি কি এই জমির রেকর্ডটি অনুমোদন করতে চান?')) {
                    $.ajax({
                        url: "{{ route('land.approve') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: "{{ $land->id }}"
                        },
                        success: function(response) {
                            if (response.status) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function() {
                            toastr.error('অনুমোদন করতে ব্যর্থ হয়েছে।');
                        }
                    });
                }
            });
        });
    </script>
@endpush
