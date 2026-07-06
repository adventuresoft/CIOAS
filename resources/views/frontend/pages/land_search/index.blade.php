@extends('frontend.master')
@section('title', 'জমি অনুসন্ধান')

@push('style')
    <style>
        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .results-table th {
            background-color: #006a4e;
            color: white;
            padding: 12px 15px;
            font-weight: 600;
            text-align: center;
            border-right: 1px solid #00563f;
        }

        .results-table th:last-child {
            border-right: none;
        }

        .results-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            border-right: 1px solid #e0e0e0;
            vertical-align: middle;
        }

        .results-table td:last-child {
            border-right: none;
        }

        .results-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .results-table tbody tr:hover {
            background-color: #f1f5f9;
        }
    </style>
@endpush

@section('content')
    <div class="container py-8">
        <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3 no-print">
            <!-- Header -->
            <div class="d-flex align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3">
                <div class="d-flex align-items-center gap-3">
                    <div
                        class="d-flex h-12 w-12 align-items-center justify-content-center rounded-full bg-white text-gov-green">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="fs-5">জমি অনুসন্ধান</h2>
                        <p class="fs-content text-green-100 mt-1">অনুমোদিত জমির তালিকা এবং বিস্তারিত তথ্য অনুসন্ধান</p>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <div class="gov-body">
                <form action="{{ route('frontend.land.search') }}" method="GET">
                    <div class="row g-4 mb-3">
                        <div class="col-md-3">
                            <label for="record">রেকর্ড</label>
                            <select class="form-control select2" name="record" id="record">
                                <option value="">সকল রেকর্ড</option>
                                @foreach ($records as $record)
                                    <option value="{{ $record->id }}" {{ request('record') == $record->id ? 'selected' : '' }}>
                                        {{ $record->name ?? $record->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="district_id">জেলা</label>
                            <select name="district_id" class="form-control select2" id="district_id">
                                <option value="">সকল জেলা</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name ?? $district->name }}</option>
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

                    <div class="row g-4 mb-3">
                        <div class="col-md-3">
                            <label for="dag_no">দাগ নং</label>
                            <input type="text" name="dag_no" value="{{ request('dag_no') }}" class="form-control"
                                id="dag_no" placeholder="দাগ নং">
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="d-d-flex justify-content-end gap-3 mt-3 border-t pt-4">
                        <a href="{{ route('frontend.land.search') }}" class="btn btn-gov-cancel">রিসেট</a>
                        <button type="submit" class="btn btn-gov-submit"><i class="fas fa-search mr-1"></i> অনুসন্ধান
                            করুন</button>
                    </div>
                </form>
            </div>
        </div>

        @if($lands !== null)
            <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3 mt-3" id="print-section">
                <div
                    class="d-d-flex align-align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3 d-d-flex justify-content-between align-align-items-center no-print">
                    <div>
                        <h2 class="fs-5">অনুসন্ধান ফলাফল</h2>
                        <p class="fs-content text-green-100 mt-1">মোট {{ count($lands) }} টি তথ্য পাওয়া গেছে</p>
                    </div>
                    <button onclick="window.print()" class="btn btn-light"><i class="fas fa-print"></i> প্রিন্ট করুন</button>
                </div>

                <div class="gov-body">
                    <div class="text-center mb-3 d-none d-print-d-d-block">
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
                                            <td>{{ number_format((float) ($land->land_amount ?? 0), 4) }}</td>
                                            <td><span class="badge bg-success"
                                                    style="font-size: 13px; font-weight: 500; padding: 6px 10px; border-radius: 6px;">অনুমোদিত</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted"><i class="fas fa-exclamation-circle text-warning mb-3"
                                    style="font-size: 2rem;"></i><br>কোনো তথ্য পাওয়া যায়নি!</h5>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                width: '100%'
            });

            let oldDistrict = "{{ request('district_id') }}";
            let oldUpazila = "{{ request('upazila_id') }}";
            let oldMouza = "{{ request('mouza_id') }}";

            // Reload on record change
            $('#record').on('change', function () {
                if ($('#district_id').val()) {
                    $('#district_id').trigger('change');
                }
            });

            // Load Upazilas based on District
            $('#district_id').on('change', function () {
                let dist_id = $(this).val();
                let record_id = $('#record').val();
                let upazila_id = $('#upazila_id');
                let mouza_id = $('#mouza_id');

                upazila_id.html('<option value="">সকল উপজেলা</option>');
                mouza_id.html('<option value="">সকল মৌজা</option>');

                if (dist_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-upazilas-by-district') }}/" + dist_id + (record_id ? "?record=" + record_id : ""),
                        beforeSend: function () {
                            upazila_id.prop("disabled", true);
                        },
                        success: function (response) {
                            upazila_id.html(response).prop("disabled", false);
                            upazila_id.prepend('<option value="" selected>সকল উপজেলা</option>');
                            if (oldUpazila) {
                                upazila_id.val(oldUpazila).trigger('change');
                                oldUpazila = null;
                            }
                        }
                    });
                }
            });

            // Load Mouzas based on Upazila
            $('#upazila_id').on('change', function () {
                let thana_id = $(this).val();
                let record_id = $('#record').val();
                let mouza_id = $('#mouza_id');

                mouza_id.html('<option value="">সকল মৌজা</option>');

                if (thana_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-mouzas-by-thana') }}/" + thana_id + (record_id ? "?record=" + record_id : ""),
                        beforeSend: function () {
                            mouza_id.prop("disabled", true);
                        },
                        success: function (response) {
                            mouza_id.html(response).prop("disabled", false);
                            mouza_id.prepend('<option value="" selected>সকল মৌজা</option>');
                            if (oldMouza) {
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