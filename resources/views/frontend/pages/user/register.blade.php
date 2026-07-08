@extends('frontend.master')

@section('title', 'নাগরিক নিবন্ধন (Citizen Registration)')

@push('style')

@endpush

@section('content')
    <div class="register-card p-3 md:p-8 w-100">

            <!-- Header -->


            <form id="citizenRegisterForm" class="space-y-6">
                @csrf

                <!-- Step 1: Personal Credentials -->
                <div>
                    <h3 class="form-section-title">
                        <i class="fas fa-user"></i> ব্যক্তিগত তথ্য (Personal Information)
                    </h3>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পূর্ণ নাম
                                (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="w-100 form-control"
                                placeholder="Full Name in English">
                            <span class="fs-content text-danger error-name"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পূর্ণ নাম (বাংলা)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="bn_name" required class="w-100 form-control"
                                placeholder="বাংলায় পূর্ণ নাম">
                            <span class="fs-content text-danger error-bn_name"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পিতার নাম
                                (Father's Name)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="father_name" required class="w-100 form-control"
                                placeholder="Father's Name">
                            <span class="fs-content text-danger error-father_name"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">জন্ম তারিখ (Date
                                of Birth)
                                <span class="text-danger">*</span></label>
                            <div class="row row-cols-3 g-2">
                                <div>
                                    <input type="number" name="dob_day" min="1" max="31" required class="w-100 form-control"
                                        placeholder="দিন (Day)">
                                </div>
                                <div>
                                    <select name="dob_month" required class="w-100 form-control">
                                        <option value="">মাস (Month)</option>
                                        <option value="1">জানুয়ারি (Jan)</option>
                                        <option value="2">ফেব্রুয়ারি (Feb)</option>
                                        <option value="3">মার্চ (Mar)</option>
                                        <option value="4">এপ্রিল (Apr)</option>
                                        <option value="5">মে (May)</option>
                                        <option value="6">জুন (Jun)</option>
                                        <option value="7">জুলাই (Jul)</option>
                                        <option value="8">আগস্ট (Aug)</option>
                                        <option value="9">সেপ্টেম্বর (Sep)</option>
                                        <option value="10">অক্টোবর (Oct)</option>
                                        <option value="11">নভেম্বর (Nov)</option>
                                        <option value="12">ডিসেম্বর (Dec)</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="number" name="dob_year" min="1900" max="{{ date('Y') }}" required
                                        class="w-100 form-control" placeholder="বছর (Yr)">
                                </div>
                            </div>
                            <span class="fs-content text-danger error-dob"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">জাতীয় পরিচয়পত্র
                                নম্বর (NID
                                Number) <span class="text-danger">*</span></label>
                            <input type="text" name="nid_no" required class="w-100 form-control"
                                placeholder="National ID Card Number">
                            <span class="fs-content text-danger error-nid_no"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">মোবাইল নম্বর
                                (Mobile Number)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" required class="w-100 form-control" placeholder="01XXXXXXXXX">
                            <span class="fs-content text-danger error-mobile"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">ইমেইল ঠিকানা
                                (Email Address)
                                <span class="text-danger">*</span></label>
                            <input type="email" name="email" required class="w-100 form-control"
                                placeholder="example@domain.com">
                            <span class="fs-content text-danger error-email"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">লিঙ্গ (Gender)
                                <span class="text-danger">*</span></label>
                            <select name="gender" required class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                                <option value="1">পুরুষ (Male)</option>
                                <option value="2">মহিলা (Female)</option>
                                <option value="3">অন্যান্য (Other)</option>
                            </select>
                            <span class="fs-content text-danger error-gender"></span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Address Details -->
                <div class="mt-3">
                    <h3 class="form-section-title fs-6">
                        <i class="fas fa-map-marker-alt"></i> বর্তমান ঠিকানা (Registered Address)
                    </h3>

                    <!-- Location Type Radio Card Selection -->
                    <div class="mb-3">
                        <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-3">স্থানের ধরণ (Location
                            Type)
                            <span class="text-danger">*</span></label>
                        <div class="d-d-flex flex-wrap gap-3">
                            <label class="location-card active">
                                <input type="radio" name="location_type" value="union_type" checked class="d-none">
                                <i class="fas fa-warehouse fs-content"></i>
                                <span>ইউনিয়ন (Union)</span>
                            </label>
                            <label class="location-card">
                                <input type="radio" name="location_type" value="pos_type" class="d-none">
                                <i class="fas fa-building fs-content"></i>
                                <span>পৌরসভা (Pourashava)</span>
                            </label>
                            <label class="location-card">
                                <input type="radio" name="location_type" value="city_type" class="d-none">
                                <i class="fas fa-city fs-content"></i>
                                <span>সিটি কর্পোরেশন (City Corporation)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Dropdowns Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">বিভাগ
                                (Division)</label>
                            <select name="division_id" id="division_id" class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            <span class="fs-content text-danger error-division_id"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">জেলা
                                (District)</label>
                            <select name="district_id" id="district_id" disabled
                                class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-district_id"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">উপজেলা/থানা
                                (Thana)</label>
                            <select name="thana_id" id="thana_id" disabled class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-thana_id"></span>
                        </div>



                        <!-- Pourashava Selection Box -->
                        <div class="pos-box d-none">
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পৌরসভা
                                (Pourashava)</label>
                            <select name="pos_id" id="pos_id" disabled class="form-control select2 select2bs4 w-100"
                                data-type="pourashova">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-pos_id"></span>
                        </div>

                        <!-- City Corporation Selection Box -->
                        <div class="city-box d-none">
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">সিটি কর্পোরেশন
                                (City
                                Corp)</label>
                            <select name="city_id" id="city_id" disabled class="form-control select2 select2bs4 w-100"
                                data-type="City">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-city_id"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পোস্ট অফিস (Post
                                Office)</label>
                            <select name="post_office_id" id="post_office_id" disabled
                                class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-post_office_id"></span>
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">বিস্তারিত ঠিকানা
                                (Detailed Address) <span class="text-danger">*</span></label>
                            <textarea name="address" rows="3" required class="w-100 form-control"
                                placeholder="আপনার বিস্তারিত ঠিকানা লিখুন..."></textarea>
                            <span class="fs-content text-danger error-address"></span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Password Credentials -->
                <div class="pt-4">
                    <h3 class="form-section-title fs-6">
                        <i class="fas fa-lock"></i> নিরাপত্তা পাসওয়ার্ড (Account Security)
                    </h3>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পাসওয়ার্ড
                                (Password) <span class="text-danger">*</span></label>
                            <input type="password" name="password" required class="w-100 form-control"
                                placeholder="কমপক্ষে ৬ অক্ষরের পাসওয়ার্ড">
                            <span class="fs-content text-danger error-password"></span>
                        </div>

                        <div>
                            <label class="d-d-block fs-content fw-bold text-dark text-text-uppercase mb-2">পাসওয়ার্ড
                                নিশ্চিত করুন
                                (Confirm Password) <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" required class="w-100 form-control"
                                placeholder="আবারো পাসওয়ার্ডটি লিখুন">
                            <span class="fs-content text-danger error-password_confirmation"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit buttons -->
                <div class="pt-6 border-t border-gray-100 d-flex align-items-center justify-content-between gap-3 mt-4">
                    <a href="{{ url('/') }}" class="fs-content fw-bold text-secondary hover:text-gray-900 transition">
                        ফিরে যান
                    </a>
                    <button type="submit"
                        class="inline-flex align-items-center mx-2 gap-2 rounded-3 bg-gov-green px-2 py-2 fs-content fw-bold text-white shadow hover:bg-[#00523b] transition">
                        নিবন্ধন সম্পন্ন করুন
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    @endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Initialize Select2 components
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            // Toggle location selection card classes and inputs
            $(document).on('click', '.location-card', function () {
                $('.location-card').removeClass('active');
                $(this).addClass('active');
                $(this).find('input[type="radio"]').prop('checked', true).trigger('change');
            });

            // Toggle visibility and attributes based on location type selection
            $(document).on('change', 'input[name="location_type"]', function () {
                let val = $(this).val();
                // Clear drop values
                $('#union_id, #pos_id, #city_id, #village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

                if (val === 'union_type') {
                    $('.union-box').removeClass('d-none');
                    $('.pos-box, .city-box').addClass('d-none');
                } else if (val === 'pos_type') {
                    $('.pos-box').removeClass('d-none');
                    $('.union-box, .city-box').addClass('d-none');
                } else if (val === 'city_type') {
                    $('.city-box').removeClass('d-none');
                    $('.union-box, .pos-box').addClass('d-none');
                }

                // Trigger district re-load to populate unions/pourashavas
                let distVal = $('#district_id').val();
                if (distVal) {
                    $('#district_id').trigger('change');
                }
            });

            // ── AJAX Dropdown cascade loaders ──

            // Load districts when division changes
            $(document).on('change', '#division_id', function () {
                let divId = $(this).val();
                let dist = $('#district_id');
                dist.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                $('#thana_id, #union_id, #pos_id, #city_id, #post_office_id, #village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

                if (divId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/" + divId,
                        success: function (response) {
                            dist.html(response).prop('disabled', false).trigger('change');
                        }
                    });
                }
            });

            // Load thana, city corporation, pourashava when district changes
            $(document).on('change', '#district_id', function () {
                let distId = $(this).val();
                let thana = $('#thana_id');
                let city = $('#city_id');
                let pos = $('#pos_id');

                thana.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                city.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                pos.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                $('#post_office_id, #village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

                if (distId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-thanas-by-district') }}/" + distId,
                        success: function (response) {
                            thana.html(response).prop('disabled', false).trigger('change');
                        }
                    });

                    let locType = $('input[name="location_type"]:checked').val();
                    if (locType === 'city_type') {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/get-city-corporation-by-district') }}/" + distId,
                            success: function (response) {
                                city.html(response).prop('disabled', false).trigger('change');
                            }
                        });
                    } else if (locType === 'pos_type') {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/get-pourashava-by-district') }}/" + distId,
                            success: function (response) {
                                pos.html(response).prop('disabled', false).trigger('change');
                            }
                        });
                    }
                }
            });

            // Load post offices & unions when thana changes
            $(document).on('change', '#thana_id', function () {
                let thanaId = $(this).val();
                let po = $('#post_office_id');
                let union = $('#union_id');

                po.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                union.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
                $('#village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

                if (thanaId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-postOffice-by-thana') }}/" + thanaId,
                        success: function (response) {
                            po.html(response).prop('disabled', false).trigger('change');
                        }
                    });

                    let locType = $('input[name="location_type"]:checked').val();
                    if (locType === 'union_type') {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/get-unions-by-thana') }}/" + thanaId,
                            success: function (response) {
                                union.html(response).prop('disabled', false).trigger('change');
                            }
                        });
                    }
                }
            });

            // Load villages based on union/pourashava/city-corp
            $('#union_id, #pos_id, #city_id').change(function () {
                let value = $(this).val();
                let type = $(this).data('type');
                let village = $('#village_id');
                village.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

                if (value) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-villages-by-type') }}/" + value + '/' + type,
                        success: function (response) {
                            village.html(response).prop('disabled', false).trigger('change');
                        }
                    });
                }
            });

            // Form Submit Handler via AJAX
            $('#citizenRegisterForm').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                let btn = form.find('button[type="submit"]');

                // Clear errors
                form.find('.text-danger[class*="error-"]').text('');

                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.user.register.store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        btn.prop('disabled', true).html('নিবন্ধন হচ্ছে... <i class="fa fa-spinner fa-spin"></i>');
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 1500);
                    },
                    error: function (xhr) {
                        btn.prop('disabled', false).html('নিবন্ধন সম্পন্ন করুন <i class="fas fa-arrow-right"></i>');
                        let responseText = JSON.parse(xhr.responseText);
                        toastr.error(responseText.message);

                        if (responseText.errors) {
                            $.each(responseText.errors, function (key, val) {
                                let errorElement = form.find(".error-" + key);
                                if (errorElement.length > 0) {
                                    errorElement.text(val[0]);
                                } else if (key === 'dob_day' || key === 'dob_month' || key === 'dob_year') {
                                    form.find(".error-dob").text(val[0]);
                                } else {
                                    toastr.error(val[0]);
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush