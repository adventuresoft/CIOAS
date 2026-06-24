@extends('frontend.master')
@section('title', 'জমি অনুসন্ধান')

@push('style')
<style>
    .gov-form-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-top: 5px solid #006a4e;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .gov-header {
        background: linear-gradient(135deg, #006a4e 0%, #00523b 100%);
        color: #ffffff;
        padding: 24px 30px;
        border-bottom: 3px solid #f42a41;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .gov-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .gov-body {
        padding: 35px;
    }

    .gov-body label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: block;
    }

    .gov-body .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 44px !important;
        font-size: 0.95rem !important;
        color: #1e293b !important;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }

    .gov-body .form-control:focus {
        border-color: #006a4e !important;
        box-shadow: 0 0 0 3px rgba(0, 106, 78, 0.15) !important;
    }

    /* Select2 Custom Theme */
    .gov-body .select2-container--default .select2-selection--single {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 44px !important;
        transition: all 0.2s ease-in-out;
    }

    .gov-body .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px !important;
        padding-left: 12px !important;
        color: #1e293b !important;
    }

    .gov-body .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
        right: 8px !important;
    }

    .gov-body .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #006a4e !important;
    }

    .btn-gov-submit {
        background-color: #006a4e;
        color: #ffffff;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .btn-gov-submit:hover {
        background-color: #00523b;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 82, 59, 0.2);
    }

    .btn-gov-cancel {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease-in-out;
    }

    .btn-gov-cancel:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }

    /* Results Table styling */
    .results-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .results-table th, .results-table td {
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        text-align: left;
        font-size: 0.9rem;
    }

    .results-table th {
        background-color: #f8fafc;
        color: #0f766e;
        font-weight: 700;
    }

    .results-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #print-section, #print-section * {
            visibility: visible;
        }
        #print-section {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .no-print {
            display: none !important;
        }
        .gov-form-container {
            box-shadow: none;
            border-top: none;
        }
        .gov-header {
            color: #000;
            background: none !important;
            border-bottom: 2px solid #000;
        }
        .gov-header h2 {
            color: #000;
        }
        .results-table th {
            background-color: #eee !important;
            color: #000 !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-8">
    <div class="gov-form-container no-print">
        <!-- Header -->
        <div class="gov-header">
            <div class="d-flex align-items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-[#006a4e]">
                    <i class="fas fa-search text-2xl"></i>
                </div>
                <div>
                    <h2>জমি অনুসন্ধান</h2>
                    <p class="text-xs text-green-100 mt-1">অনুমোদিত জমির তালিকা এবং বিস্তারিত তথ্য অনুসন্ধান</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <div class="gov-body">
            <form action="{{ route('frontend.land.search') }}" method="GET">
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <label for="record">রেকর্ড</label>
                        <select class="form-control select2" name="record" id="record">
                            <option value="">সকল রেকর্ড</option>
                            @foreach ($records as $record)
                                <option value="{{ $record->id }}" {{ request('record') == $record->id ? 'selected' : '' }}>{{ $record->bn_name ?? $record->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="district_id">জেলা</label>
                        <select name="district_id" class="form-control select2" id="district_id">
                            <option value="">সকল জেলা</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>{{ $district->bn_name ?? $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="upazila_id">উপজেলা</label>
                        <select name="upazila_id" class="form-control select2" id="upazila_id">
                            <option value="">সকল উপজেলা</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="mouza_id">মৌজা</label>
                        <select name="mouza_id" class="form-control select2" id="mouza_id">
                            <option value="">সকল মৌজা</option>
                        </select>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <label for="dag_no">দাগ নং</label>
                        <input type="text" name="dag_no" value="{{ request('dag_no') }}" class="form-control" id="dag_no" placeholder="দাগ নং">
                    </div>
                    <div class="col-md-3">
                        <label for="name">মালিকের নাম</label>
                        <input type="text" name="name" value="{{ request('name') }}" class="form-control" id="name" placeholder="মালিকের নাম">
                    </div>
                    <div class="col-md-3">
                        <label for="nid">জাতীয় পরিচয়পত্র নং</label>
                        <input type="text" name="nid" value="{{ request('nid') }}" class="form-control" id="nid" placeholder="NID">
                    </div>
                    <div class="col-md-3">
                        <label for="mobile">মোবাইল নং</label>
                        <input type="text" name="mobile" value="{{ request('mobile') }}" class="form-control" id="mobile" placeholder="মোবাইল">
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4 border-t pt-4">
                    <a href="{{ route('frontend.land.search') }}" class="btn btn-gov-cancel">রিসেট</a>
                    <button type="submit" class="btn btn-gov-submit"><i class="fas fa-search mr-1"></i> অনুসন্ধান করুন</button>
                </div>
            </form>
        </div>
    </div>

    @if($lands !== null)
    <div class="gov-form-container" id="print-section">
        <div class="gov-header flex justify-between items-center no-print">
            <div>
                <h2>অনুসন্ধান ফলাফল</h2>
                <p class="text-xs text-green-100 mt-1">মোট {{ count($lands) }} টি তথ্য পাওয়া গেছে</p>
            </div>
            <button onclick="window.print()" class="btn btn-light"><i class="fas fa-print"></i> প্রিন্ট করুন</button>
        </div>
        
        <div class="gov-body">
            <div class="text-center mb-4 d-none d-print-block">
                <h3 style="font-weight: bold; font-size: 20px;">জমি অনুসন্ধান ফলাফল</h3>
                <p style="margin: 0; font-size: 14px;">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
                <hr style="border-top: 1px solid #000; margin-top: 10px; margin-bottom: 20px;">
            </div>

            @if(count($lands) > 0)
                <div class="table-responsive">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>রেকর্ড</th>
                                <th>জেলা</th>
                                <th>উপজেলা</th>
                                <th>মৌজা</th>
                                <th>দাগ নং</th>
                                <th>খতিয়ান নং</th>
                                <th>জমির পরিমাণ (একর)</th>
                                <th>মালিকের নাম (রেকর্ডীয়)</th>
                                <th>অবস্থা</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lands as $land)
                            <tr>
                                <td>{{ $land->record->bn_name ?? $land->record->name ?? $land->record_type ?? '—' }}</td>
                                <td>{{ $land->district->bn_name ?? $land->district->name ?? '—' }}</td>
                                <td>{{ $land->upazila->bn_name ?? $land->upazila->name ?? '—' }}</td>
                                <td>{{ $land->mouza->bn_name ?? $land->mouza->name ?? '—' }}</td>
                                <td style="font-weight: 600;">{{ $land->dag_no ?? '—' }}</td>
                                <td style="font-weight: 600;">{{ $land->khatian_no ?? '—' }}</td>
                                <td>{{ number_format((float)($land->land_amount ?? 0), 4) }}</td>
                                <td>{{ $land->recorded_owner_name ?? '—' }}</td>
                                <td><span style="color: #0f766e; font-weight: 600;">অনুমোদিত</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <h5 class="text-muted"><i class="fas fa-exclamation-circle text-warning mb-3" style="font-size: 2rem;"></i><br>কোনো তথ্য পাওয়া যায়নি!</h5>
                </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%'
    });

    let oldDistrict = "{{ request('district_id') }}";
    let oldUpazila = "{{ request('upazila_id') }}";
    let oldMouza = "{{ request('mouza_id') }}";

    // Load Upazilas based on District
    $('#district_id').on('change', function() {
        let dist_id = $(this).val();
        let upazila_id = $('#upazila_id');
        let mouza_id = $('#mouza_id');

        upazila_id.html('<option value="">সকল উপজেলা</option>');
        mouza_id.html('<option value="">সকল মৌজা</option>');

        if (dist_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-thana-by-district') }}/" + dist_id,
                beforeSend: function () {
                    upazila_id.prop("disabled", true);
                },
                success: function (response) {
                    upazila_id.html(response).prop("disabled", false);
                    upazila_id.prepend('<option value="" selected>সকল উপজেলা</option>');
                    if(oldUpazila) {
                        upazila_id.val(oldUpazila).trigger('change');
                        oldUpazila = null;
                    }
                }
            });
        }
    });

    // Load Mouzas based on Upazila
    $('#upazila_id').on('change', function() {
        let thana_id = $(this).val();
        let mouza_id = $('#mouza_id');

        mouza_id.html('<option value="">সকল মৌজা</option>');

        if (thana_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-mouza-by-thana') }}/" + thana_id,
                beforeSend: function () {
                    mouza_id.prop("disabled", true);
                },
                success: function (response) {
                    mouza_id.html(response).prop("disabled", false);
                    mouza_id.prepend('<option value="" selected>সকল মৌজা</option>');
                    if(oldMouza) {
                        mouza_id.val(oldMouza).trigger('change');
                        oldMouza = null;
                    }
                }
            });
        }
    });

    if (oldDistrict) {
        $('#district_id').trigger('change');
    }
});
</script>
@endpush
