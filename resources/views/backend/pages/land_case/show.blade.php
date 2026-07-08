@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCaseList'])

@section('title', 'জমির মামলার বিবরণী')

@push('style')
<style>
    .show-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .show-panel-header {
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #fff;
        padding: 14px 22px;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .show-panel-body { padding: 22px; }
    
    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .info-table td {
        padding: 10px 14px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14.5px;
    }
    .info-table td.label-cell {
        font-weight: 700;
        color: #475569;
        width: 30%;
        background-color: #f8fafc;
    }
    .info-table td.value-cell {
        color: #1e293b;
    }

    .plots-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .plots-table th {
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #fff;
        font-weight: 700;
        padding: 11px;
        text-align: center;
        font-size: 13.5px;
        border: 1px solid #0d6460;
    }
    .plots-table td {
        padding: 10px;
        border: 1px solid #e2e8f0;
        font-size: 13.5px;
        color: #334155;
        text-align: center;
    }
    .plots-table tbody tr:hover {
        background-color: #f8fafc;
    }
</style>
@endpush

@section('content')
<section class="content pt-3 pb-5">
    <div class="container-fluid" style="max-width: 1100px; margin: 0 auto;">
        
        <!-- Actions row -->
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('land-cases.index') }}" class="btn btn-secondary" style="font-weight:600;">
                <i class="fas fa-arrow-left"></i> ফিরে যান
            </a>
            <button onclick="window.print();" class="btn btn-primary" style="font-weight:600;">
                <i class="fas fa-print"></i> প্রিন্ট করুন
            </button>
        </div>

        <!-- Case Info Panel -->
        <div class="show-panel" style="border-top: 4px solid #b91c1c;">
            <div class="show-panel-header" style="background: linear-gradient(135deg, #b91c1c, #991b1b);">
                <span><i class="fas fa-gavel"></i> মামলার তথ্য</span>
                <span class="badge badge-light" style="color: #b91c1c; font-size: 13.5px; font-weight:700;">ID: {{ str_pad($landCase->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="show-panel-body">
                <table class="info-table">
                    <tbody>
                        <tr>
                            <td class="label-cell">মামলা আছে কিনা?</td>
                            <td class="value-cell">
                                @if($landCase->has_case == 1)
                                    <span class="badge badge-danger" style="font-size: 13px;">হ্যাঁ</span>
                                @else
                                    <span class="badge badge-success" style="font-size: 13px;">না</span>
                                @endif
                            </td>
                        </tr>
                        @if($landCase->has_case == 1)
                        <tr>
                            <td class="label-cell">মামলা নম্বর</td>
                            <td class="value-cell"><strong>{{ $landCase->case_no }}</strong></td>
                        </tr>
                        <tr>
                            <td class="label-cell">আদালতের নাম</td>
                            <td class="value-cell">{{ $landCase->court_name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">মামলার সর্বশেষ অবস্থা</td>
                            <td class="value-cell"><span class="badge badge-warning" style="font-size: 13px;">{{ $landCase->case_status ?? '—' }}</span></td>
                        </tr>
                        @endif
                        <tr>
                            <td class="label-cell">মন্তব্য / বিবরণ</td>
                            <td class="value-cell">{{ $landCase->comment ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="label-cell">তৈরির তারিখ</td>
                            <td class="value-cell">{{ $landCase->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Related Land Info Panel -->
        @if($land)
        <div class="show-panel">
            <div class="show-panel-header">
                <span><i class="fas fa-map-marked-alt"></i> সংশ্লিষ্ট জমির বিবরণ</span>
                <span class="badge badge-light" style="color: #0f766e; font-size: 13.5px; font-weight:700;">জমির আইডি: {{ $land->land_no }}</span>
            </div>
            <div class="show-panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="info-table">
                            <tbody>
                                <tr>
                                    <td class="label-cell">জমির নাম্বার</td>
                                    <td class="value-cell"><strong>{{ $land->land_no }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">জেলা / উপজেলা / মৌজা</td>
                                    <td class="value-cell">
                                        {{ $land->district->name ?? '—' }} / 
                                        {{ $land->upazila->name ?? '—' }} / 
                                        {{ $land->mouza->name ?? '—' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="info-table">
                            <tbody>
                                <tr>
                                    <td class="label-cell">জমির ধরণ / রেকর্ড টাইপ</td>
                                    <td class="value-cell">
                                        {{ $land->type->bn_name ?? '—' }} / 
                                        {{ $land->record->name ?? '—' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 style="color: #0f766e; font-size: 15px; font-weight: 700; margin: 20px 0 10px 0;">দাগ ও খতিয়ান সংক্রান্ত বিবরণী</h5>
                <div style="overflow-x: auto;">
                    <table class="plots-table">
                        <thead>
                            <tr>
                                <th>দাগ নং</th>
                                <th>খতিয়ান নং</th>
                                <th>দাগে মোট জমি (একর)</th>
                                <th>জমির পরিমাণ (একর)</th>
                                <th>দখল সংক্রান্ত অবস্থা</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($land->dag_no)
                            <tr>
                                <td style="font-weight: 600;">{{ $land->dag_no ?? '—' }}</td>
                                <td style="font-weight: 600;">{{ $land->khatian_no ?? '—' }}</td>
                                <td>{{ number_format((float)($land->total_land ?? 0), 4) }} একর</td>
                                <td style="font-weight: 600; color: #0f766e;">{{ number_format((float)($land->land_amount ?? 0), 4) }} একর</td>
                                <td>{{ $land->possession_status ?? '—' }}</td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="5" style="color: #64748b; padding: 20px;">কোনো বিবরণ পাওয়া যায়নি।</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning" style="border-radius: 8px;">
            <i class="fas fa-exclamation-triangle"></i> সংশ্লিষ্ট জমি রেকর্ডটি ডাটাবেজে খুঁজে পাওয়া যায়নি।
        </div>
        @endif

    </div>
</section>
@endsection
