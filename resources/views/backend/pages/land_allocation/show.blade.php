@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandAllocationList'])

@section('title', 'বরাদ্দ / লীজ / বন্দোবস্ত বিবরণী')

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

    .persons-detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .persons-detail-table th {
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #fff;
        font-weight: 700;
        padding: 11px;
        text-align: center;
        font-size: 13.5px;
        border: 1px solid #0d6460;
    }
    .persons-detail-table td {
        padding: 10px;
        border: 1px solid #e2e8f0;
        font-size: 13.5px;
        color: #334155;
    }
    .persons-detail-table tbody tr:hover {
        background-color: #f8fafc;
    }
</style>
@endpush

@section('content')
<section class="content pt-3 pb-5">
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Action Buttons -->
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('land-allocations.index') }}" class="btn btn-secondary" style="font-weight:600;">
                <i class="fas fa-arrow-left"></i> ফিরে যান
            </a>
            <button onclick="window.print();" class="btn btn-primary" style="font-weight:600;">
                <i class="fas fa-print"></i> প্রিন্ট করুন
            </button>
        </div>

        <div class="show-panel">
            <div class="show-panel-header">
                <span><i class="fas fa-map-marked-alt"></i> বরাদ্দ সংক্রান্ত মৌলিক তথ্য</span>
                <span class="badge badge-light" style="color: #0f766e; font-size: 13.5px; font-weight:700;">ID: {{ str_pad($allocation->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="show-panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="info-table">
                            <tbody>
                                <tr>
                                    <td class="label-cell">জমির নাম্বার</td>
                                    <td class="value-cell"><strong>{{ $allocation->land_no }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="label-cell">জেলা / উপজেলা / মৌজা</td>
                                    <td class="value-cell">
                                        {{ $allocation->land->district->name ?? '—' }} / 
                                        {{ $allocation->land->upazila->name ?? '—' }} / 
                                        {{ $allocation->land->mouza->name ?? '—' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-cell">জমির ধরণ / রেকর্ড টাইপ</td>
                                    <td class="value-cell">
                                        {{ $allocation->land->type->bn_name ?? '—' }} / 
                                        {{ $allocation->land->record->name ?? '—' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="info-table">
                            <tbody>
                                <tr>
                                    <td class="label-cell">মোট জমির পরিমাণ</td>
                                    <td class="value-cell" style="font-weight:700; color: #475569;">{{ number_format($totalLandAcres, 4) }} একর</td>
                                </tr>
                                <tr>
                                    <td class="label-cell">ইতিমধ্যে বরাদ্দকৃত জমি</td>
                                    <td class="value-cell" style="font-weight:700; color: #be123c;">{{ number_format($existingAllocationsSum, 4) }} একর</td>
                                </tr>
                                <tr>
                                    <td class="label-cell">অবশিষ্ট জমির পরিমাণ</td>
                                    <td class="value-cell" style="font-weight:700; color: #166534;">{{ number_format($totalLandAcres - $existingAllocationsSum, 4) }} একর</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="show-panel">
            <div class="show-panel-header">
                <span><i class="fas fa-users"></i> বরাদ্দকৃত ব্যক্তিদের বিস্তারিত তথ্য</span>
                <span class="badge badge-light" style="color: #0f766e; font-size: 13.5px; font-weight:700;">{{ $allocation->total_persons }} জন</span>
            </div>
            <div class="show-panel-body" style="padding: 0; overflow-x: auto;">
                <table class="persons-detail-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>NID নম্বর</th>
                            <th>ফোন</th>
                            <th>পিতার নাম</th>
                            <th>বর্তমান ঠিকানা</th>
                            <th>স্থায়ী ঠিকানা</th>
                            <th>বরাদ্দকৃত একর</th>
                            <th>প্রতি একর মূল্য</th>
                            <th>মোট মূল্য</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotalPrice = 0;
                            $grandTotalAcres = 0;
                        @endphp
                        @foreach(is_array($allocation->persons) ? $allocation->persons : [] as $i => $p)
                            @php
                                $rowPrice = (float)($p['acres'] ?? 0) * (float)($p['price_per_acre'] ?? 0);
                                $grandTotalPrice += $rowPrice;
                                $grandTotalAcres += (float)($p['acres'] ?? 0);
                            @endphp
                            <tr>
                                <td style="text-align:center; font-weight:700; color:#0f766e;">{{ $i + 1 }}</td>
                                <td><strong>{{ $p['name'] ?? '' }}</strong></td>
                                <td>{{ $p['nid'] ?? '—' }}</td>
                                <td>{{ $p['phone'] ?? '—' }}</td>
                                <td>{{ $p['father_name'] ?? '—' }}</td>
                                <td>{{ $p['present_address'] ?? '—' }}</td>
                                <td>{{ $p['permanent_address'] ?? '—' }}</td>
                                <td style="text-align:right; font-weight:600; color:#0f766e;">{{ number_format((float)($p['acres'] ?? 0), 4) }} একর</td>
                                <td style="text-align:right;">৳ {{ number_format((float)($p['price_per_acre'] ?? 0), 2) }}</td>
                                <td style="text-align:right; font-weight:700; color:#0f766e;">৳ {{ number_format($rowPrice, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #f1f5f9; font-weight: 700;">
                            <td colspan="7" style="text-align: right; font-size:14px; color:#1e293b;">সর্বমোট:</td>
                            <td style="text-align: right; color:#0f766e; font-size:14px;">{{ number_format($grandTotalAcres, 4) }} একর</td>
                            <td></td>
                            <td style="text-align: right; color:#0f766e; font-size:14px;">৳ {{ number_format($grandTotalPrice, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
