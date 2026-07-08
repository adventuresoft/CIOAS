@extends('frontend.master')

@section('title', 'নাগরিক নিবন্ধন (Citizen Registration)')

@push('style')

@endpush

@section('content')
    <div class="register-card theme-form-card">
        <div class="theme-form-card-header">
            <i class="fas fa-user text-2xl"></i>
            <h2>নাগরিক নিবন্ধন (Citizen Registration)</h2>
        </div>

        <div class="theme-form-card-body p-4">
            <form id="citizenRegisterForm">
                @csrf

                <!-- Step 1: Personal Credentials -->
                <div class="mb-4">
                    <h4 class="text-success border-bottom pb-2 mb-4"><i class="fas fa-user-circle me-2"></i>ব্যক্তিগত তথ্য
                        (Personal Information)</h4>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পূর্ণ নাম
                                (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="w-100 form-control"
                                placeholder="Full Name in English">
                            <span class="fs-content text-danger error-name"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পূর্ণ নাম (বাংলা)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="bn_name" required class="w-100 form-control"
                                placeholder="বাংলায় পূর্ণ নাম">
                            <span class="fs-content text-danger error-bn_name"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পিতার নাম
                                (Father's Name)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="father_name" required class="w-100 form-control"
                                placeholder="Father's Name">
                            <span class="fs-content text-danger error-father_name"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">জন্ম তারিখ (Date
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
                            <label class="form-label fw-bold text-dark mb-2">জাতীয় পরিচয়পত্র
                                নম্বর (NID Number) <span class="text-danger">*</span></label>
                            <input type="text" name="nid_no" required class="w-100 form-control"
                                placeholder="National ID Card Number">
                            <span class="fs-content text-danger error-nid_no"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">মোবাইল নম্বর
                                (Mobile Number)
                                <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" required class="w-100 form-control" placeholder="01XXXXXXXXX">
                            <span class="fs-content text-danger error-mobile"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">ইমেইল ঠিকানা
                                (Email Address)
                                <span class="text-danger">*</span></label>
                            <input type="email" name="email" required class="w-100 form-control"
                                placeholder="example@domain.com">
                            <span class="fs-content text-danger error-email"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">লিঙ্গ (Gender)
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
                <div class="mb-4">
                    <h4 class="text-success border-bottom pb-2 mb-4 mt-5"><i class="fas fa-map-marker-alt me-2"></i>বর্তমান
                        ঠিকানা (Registered Address)</h4>

                    <!-- Dropdowns Grid -->
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <div>
                            <label class="form-label fw-bold text-dark mb-2">বিভাগ (Division)</label>
                            <select name="division_id" id="division_id" class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            <span class="fs-content text-danger error-division_id"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">জেলা (District)</label>
                            <select name="district_id" id="district_id" disabled
                                class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-district_id"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">উপজেলা/থানা (Thana)</label>
                            <select name="thana_id" id="thana_id" disabled class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-thana_id"></span>
                        </div>


                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পোস্ট অফিস (Post Office)</label>
                            <select name="post_office_id" id="post_office_id" disabled
                                class="form-control select2 select2bs4 w-100">
                                <option value="">নির্বাচন করুন</option>
                            </select>
                            <span class="fs-content text-danger error-post_office_id"></span>
                        </div>


                    </div>
                    <div class="row g-4 pt-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark mb-2">বিস্তারিত ঠিকানা
                                (Detailed Address) <span class="text-danger">*</span></label>
                            <textarea name="address" rows="3" required class="w-100 form-control"
                                placeholder="আপনার বিস্তারিত ঠিকানা লিখুন..."></textarea>
                            <span class="fs-content text-danger error-address"></span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Password Credentials -->
                <div class="mb-4">
                    <h4 class="text-success border-bottom pb-2 mb-4 mt-5"><i class="fas fa-lock me-2"></i>নিরাপত্তা
                        পাসওয়ার্ড (Account Security)</h4>

                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পাসওয়ার্ড
                                (Password) <span class="text-danger">*</span></label>
                            <input type="password" name="password" required class="w-100 form-control"
                                placeholder="কমপক্ষে ৬ অক্ষরের পাসওয়ার্ড">
                            <span class="fs-content text-danger error-password"></span>
                        </div>

                        <div>
                            <label class="form-label fw-bold text-dark mb-2">পাসওয়ার্ড নিশ্চিত করুন
                                (Confirm Password) <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" required class="w-100 form-control"
                                placeholder="আবারো পাসওয়ার্ডটি লিখুন">
                            <span class="fs-content text-danger error-password_confirmation"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit buttons -->
                <div class="d-flex align-items-center justify-content-between gap-3 mt-5 pt-4 border-top">
                    <a href="{{ url('/') }}" class="btn btn-gov-cancel px-4">
                        <i class="fas fa-arrow-left me-2"></i>ফিরে যান
                    </a>
                    <button type="submit" class="btn btn-gov-submit px-4 d-flex align-items-center gap-2">
                        নিবন্ধন সম্পন্ন করুন <i class="fas fa-check-circle"></i>
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