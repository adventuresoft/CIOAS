@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandAllocationList'])

@section('title', 'বরাদ্দ / লীজ / বন্দোবস্ত তালিকা')

@push('style')
<style>
    .cioas-panel {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    .cioas-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
    }
    .cioas-panel-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .cioas-panel-title i {
        color: #3b82f6;
        margin-right: 8px;
    }
    .cioas-panel-body {
        padding: 25px;
    }
</style>
@endpush

@section('content')
<section class="content pt-3 pb-5">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="cioas-panel">
            <div class="cioas-panel-header">
                <h3 class="cioas-panel-title">
                    <i class="fas fa-list"></i> বরাদ্দ / লীজ / বন্দোবস্ত তালিকা
                </h3>
                <a href="{{ route('land-allocations.create') }}" class="btn btn-primary" style="font-weight: 600;">
                    <i class="fas fa-plus-circle"></i> নতুন বরাদ্দ তৈরী করুন
                </a>
            </div>

            <div class="cioas-panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="allocationTable">
                        <thead style="background: linear-gradient(135deg,#0f766e,#115e59); color:#fff;">
                            <tr>
                                <th style="padding:10px 12px; white-space:nowrap;">#</th>
                                <th style="padding:10px 12px; white-space:nowrap;">জমির নাম্বার</th>
                                <th style="padding:10px 12px; white-space:nowrap;">মোট ব্যক্তি</th>
                                <th style="padding:10px 12px; white-space:nowrap;">মোট বরাদ্দ (একর)</th>
                                <th style="padding:10px 12px; white-space:nowrap;">অবশিষ্ট জমির পরিমাণ (একর)</th>
                                <th style="padding:10px 12px; white-space:nowrap;">মোট মূল্য (টাকা)</th>
                                <th style="padding:10px 12px; white-space:nowrap;">তারিখ</th>
                                <th style="padding:10px 12px; white-space:nowrap; text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allocations as $index => $alloc)
                            @php
                                $totalPrice = collect($alloc->persons)->sum(function($p) {
                                    return (float)($p['acres'] ?? 0) * (float)($p['price_per_acre'] ?? 0);
                                });
                                $totalAllocatedAcres = collect($alloc->persons)->sum(function($p) {
                                    return (float)($p['acres'] ?? 0);
                                });

                                $land = $alloc->land;
                                $totalLandAcres = (float)($land->land_amount ?? 0);

                                $existingAllocationsSum = \App\Models\LandAllocation::where('land_no', $alloc->land_no)->get()->sum(function($la) {
                                    return collect($la->persons)->sum(function($p) {
                                        return (float)($p['acres'] ?? 0);
                                    });
                                });
                                $remainingLandAcres = $totalLandAcres - $existingAllocationsSum;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $alloc->land_no }}</strong></td>
                                <td><span class="badge badge-info">{{ $alloc->total_persons }} জন</span></td>
                                <td><span class="badge badge-warning" style="background-color: #f59e0b; color: #fff;">{{ number_format($totalAllocatedAcres, 4) }} একর</span></td>
                                <td><span class="badge badge-success" style="background-color: #10b981; color: #fff;">{{ number_format($remainingLandAcres, 4) }} একর</span></td>
                                <td>৳ {{ number_format($totalPrice, 2) }}</td>
                                <td>{{ $alloc->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('land-allocations.show', $alloc->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> বিস্তারিত
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">কোনো বরাদ্দ পাওয়া যায়নি</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#allocationTable').DataTable({
            language: {
                "sProcessing":   "প্রসেসিং হচ্ছে...",
                "sLengthMenu":   "_MENU_ টি রেকর্ড প্রদর্শন করো",
                "sZeroRecords":  "কোনো রেকর্ড পাওয়া যায়নি",
                "sInfo":         "মোট _TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ নম্বর রেকর্ড দেখানো হচ্ছে",
                "sInfoEmpty":    "কোনো রেকর্ড নেই",
                "sInfoFiltered": "(মোট _MAX_ টি রেকর্ড থেকে ফিল্টার করা হয়েছে)",
                "sInfoPostFix":  "",
                "sSearch":       "অনুসন্ধান:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "প্রথম",
                    "sPrevious": "পূর্ববর্তী",
                    "sNext":     "পরবর্তী",
                    "sLast":     "শেষ"
                }
            }
        });
    });
</script>
@endpush
