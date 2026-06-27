@extends('frontend.master')

@section('title', 'নাগরিক নিবন্ধন (Citizen Registration)')

@push('style')
<style>
    /* Premium Metallic & Slate Theme */
    .register-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.6);
        border-radius: 16px;
    }
    .form-header-banner {
        background: #ffffff !important;
        padding: 40px 32px;
        border-radius: 12px;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }
    .form-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        border-bottom: 2px solid #cbd5e1;
        padding-bottom: 10px;
        margin-top: 32px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-section-title i {
        color: #f42a41;
    }
    .location-card {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.95rem;
        color: #334155;
        transition: all 0.2s ease-in-out;
        user-select: none;
    }
    .location-card:hover {
        border-color: #006a4e;
        background: #f0fdf4;
    }
    .location-card.active {
        border-color: #006a4e !important;
        background: linear-gradient(180deg, #e8f5e9 0%, #c8e6c9 100%) !important;
        color: #006a4e !important;
        box-shadow: 0 4px 10px rgba(0, 106, 78, 0.12);
    }
    
    /* Font size and Height Override */
    #citizenRegisterForm, 
    #citizenRegisterForm input, 
    #citizenRegisterForm select, 
    #citizenRegisterForm label,
    #citizenRegisterForm span,
    #citizenRegisterForm button,
    .select2-container--default .select2-selection--single,
    .select2-results__option {
        font-size: 16px !important;
    }

    #citizenRegisterForm input,
    #citizenRegisterForm select {
        height: 52px !important;
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        background: #ffffff !important;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
        padding: 12px 16px !important;
        transition: all 0.2s ease-in-out !important;
    }
    
    #citizenRegisterForm input:focus,
    #citizenRegisterForm select:focus {
        border-color: #006a4e !important;
        box-shadow: 0 0 0 4px rgba(0, 106, 78, 0.15), inset 0 2px 4px rgba(0, 0, 0, 0.02) !important;
        outline: none !important;
    }

    /* Select2 Height Overrides */
    .select2-container--default .select2-selection--single {
        height: 52px !important;
        padding: 12px 16px !important;
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        background: #ffffff !important;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal !important;
        padding-left: 0 !important;
        color: #1e293b !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px !important;
        right: 12px !important;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto max-w-full w-full px-4 py-8">
    <div class="register-card p-6 md:p-8 w-full">
        
        <!-- Header -->
        <div class="form-header-banner text-center mb-8">
            <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}" class="mx-auto h-20 w-20 mb-4" alt="Gov Logo">
            <h1 class="text-2xl md:text-3xl font-bold text-[#006a4e]">নাগরিক নিবন্ধন ফরম</h1>
            <p class="text-sm text-gray-500 mt-1">Central Integrated Office Automation System (CIOAS)</p>
            <div class="mx-auto mt-4 w-16 h-1 bg-[#f42a41] rounded-full"></div>
        </div>

        <form id="citizenRegisterForm" class="space-y-6">
            @csrf

            <!-- Step 1: Personal Credentials -->
            <div>
                <h3 class="form-section-title">
                    <i class="fas fa-user"></i> ব্যক্তিগত তথ্য (Personal Information)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পূর্ণ নাম (English) <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="Full Name in English">
                        <span class="text-xs text-red-500 error-name"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পূর্ণ নাম (বাংলা) <span class="text-red-500">*</span></label>
                        <input type="text" name="bn_name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="বাংলায় পূর্ণ নাম">
                        <span class="text-xs text-red-500 error-bn_name"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পিতার নাম (Father's Name) <span class="text-red-500">*</span></label>
                        <input type="text" name="father_name" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="Father's Name">
                        <span class="text-xs text-red-500 error-father_name"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">জন্ম তারিখ (Date of Birth) <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-3 gap-2">
                            <div>
                                <input type="number" name="dob_day" min="1" max="31" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="দিন (Day)">
                            </div>
                            <div>
                                <select name="dob_month" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20">
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
                                <input type="number" name="dob_year" min="1900" max="{{ date('Y') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="বছর (Yr)">
                            </div>
                        </div>
                        <span class="text-xs text-red-500 error-dob"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">জাতীয় পরিচয়পত্র নম্বর (NID Number) <span class="text-red-500">*</span></label>
                        <input type="text" name="nid_no" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="National ID Card Number">
                        <span class="text-xs text-red-500 error-nid_no"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">মোবাইল নম্বর (Mobile Number) <span class="text-red-500">*</span></label>
                        <input type="text" name="mobile" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="01XXXXXXXXX">
                        <span class="text-xs text-red-500 error-mobile"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">ইমেইল ঠিকানা (Email Address) <span class="text-red-500">*</span></label>
                        <input type="email" name="email" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="example@domain.com">
                        <span class="text-xs text-red-500 error-email"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">লিঙ্গ (Gender) <span class="text-red-500">*</span></label>
                        <select name="gender" required class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                            <option value="1">পুরুষ (Male)</option>
                            <option value="2">মহিলা (Female)</option>
                            <option value="3">অন্যান্য (Other)</option>
                        </select>
                        <span class="text-xs text-red-500 error-gender"></span>
                    </div>
                </div>
            </div>

            <!-- Step 2: Address Details -->
            <div>
                <h3 class="form-section-title">
                    <i class="fas fa-map-marker-alt"></i> বর্তমান ঠিকানা (Registered Address)
                </h3>

                <!-- Location Type Radio Card Selection -->
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-3">স্থানের ধরণ (Location Type) <span class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-4">
                        <label class="location-card active">
                            <input type="radio" name="location_type" value="union_type" checked class="d-none">
                            <i class="fas fa-warehouse text-sm"></i>
                            <span>ইউনিয়ন (Union)</span>
                        </label>
                        <label class="location-card">
                            <input type="radio" name="location_type" value="pos_type" class="d-none">
                            <i class="fas fa-building text-sm"></i>
                            <span>পৌরসভা (Pourashava)</span>
                        </label>
                        <label class="location-card">
                            <input type="radio" name="location_type" value="city_type" class="d-none">
                            <i class="fas fa-city text-sm"></i>
                            <span>সিটি কর্পোরেশন (City Corporation)</span>
                        </label>
                    </div>
                </div>

                <!-- Dropdowns Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">বিভাগ (Division)</label>
                        <select name="division_id" id="division_id" class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-xs text-red-500 error-division_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">জেলা (District)</label>
                        <select name="district_id" id="district_id" disabled class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-district_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">উপজেলা/থানা (Thana)</label>
                        <select name="thana_id" id="thana_id" disabled class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-thana_id"></span>
                    </div>

                    <!-- Union Selection Box -->
                    <div class="union-box">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">ইউনিয়ন (Union)</label>
                        <select name="union_id" id="union_id" disabled class="form-control select2 select2bs4 w-full" data-type="union">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-union_id"></span>
                    </div>

                    <!-- Pourashava Selection Box -->
                    <div class="pos-box hidden">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পৌরসভা (Pourashava)</label>
                        <select name="pos_id" id="pos_id" disabled class="form-control select2 select2bs4 w-full" data-type="pourashova">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-pos_id"></span>
                    </div>

                    <!-- City Corporation Selection Box -->
                    <div class="city-box hidden">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">সিটি কর্পোরেশন (City Corp)</label>
                        <select name="city_id" id="city_id" disabled class="form-control select2 select2bs4 w-full" data-type="City">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-city_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পোস্ট অফিস (Post Office)</label>
                        <select name="post_office_id" id="post_office_id" disabled class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-post_office_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">গ্রাম/মহল্লা (Village)</label>
                        <select name="village_id" id="village_id" disabled class="form-control select2 select2bs4 w-full">
                            <option value="">নির্বাচন করুন</option>
                        </select>
                        <span class="text-xs text-red-500 error-village_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">ওয়ার্ড নম্বর (Ward No)</label>
                        <input type="number" name="ward_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="1-9">
                        <span class="text-xs text-red-500 error-ward_id"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">রোড/রাস্তা (Road/Street)</label>
                        <input type="text" name="road" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="Road Name/No">
                        <span class="text-xs text-red-500 error-road"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">হোল্ডিং নম্বর (House/Holding No)</label>
                        <input type="text" name="house" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="Holding/House No">
                        <span class="text-xs text-red-500 error-house"></span>
                    </div>
                </div>
            </div>

            <!-- Step 3: Password Credentials -->
            <div>
                <h3 class="form-section-title">
                    <i class="fas fa-lock"></i> নিরাপত্তা পাসওয়ার্ড (Account Security)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পাসওয়ার্ড (Password) <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="কমপক্ষে ৬ অক্ষরের পাসওয়ার্ড">
                        <span class="text-xs text-red-500 error-password"></span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">পাসওয়ার্ড নিশ্চিত করুন (Confirm Password) <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#006a4e] focus:ring focus:ring-[#006a4e]/20" placeholder="আবারো পাসওয়ার্ডটি লিখুন">
                        <span class="text-xs text-red-500 error-password_confirmation"></span>
                    </div>
                </div>
            </div>

            <!-- Submit buttons -->
            <div class="pt-6 border-t border-gray-100 flex items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
                    ফিরে যান
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-[#006a4e] px-6 py-3 text-base font-bold text-white shadow hover:bg-[#00523b] transition">
                    নিবন্ধন সম্পন্ন করুন
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Initialize Select2 components
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Toggle location selection card classes and inputs
        $(document).on('click', '.location-card', function() {
            $('.location-card').removeClass('active');
            $(this).addClass('active');
            $(this).find('input[type="radio"]').prop('checked', true).trigger('change');
        });

        // Toggle visibility and attributes based on location type selection
        $(document).on('change', 'input[name="location_type"]', function() {
            let val = $(this).val();
            // Clear drop values
            $('#union_id, #pos_id, #city_id, #village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
            
            if (val === 'union_type') {
                $('.union-box').removeClass('hidden');
                $('.pos-box, .city-box').addClass('hidden');
            } else if (val === 'pos_type') {
                $('.pos-box').removeClass('hidden');
                $('.union-box, .city-box').addClass('hidden');
            } else if (val === 'city_type') {
                $('.city-box').removeClass('hidden');
                $('.union-box, .pos-box').addClass('hidden');
            }

            // Trigger district re-load to populate unions/pourashavas
            let distVal = $('#district_id').val();
            if (distVal) {
                $('#district_id').trigger('change');
            }
        });

        // ── AJAX Dropdown cascade loaders ──

        // Load districts when division changes
        $(document).on('change', '#division_id', function() {
            let divId = $(this).val();
            let dist = $('#district_id');
            dist.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');
            $('#thana_id, #union_id, #pos_id, #city_id, #post_office_id, #village_id').html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

            if (divId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + divId,
                    success: function(response) {
                        dist.html(response).prop('disabled', false).trigger('change');
                    }
                });
            }
        });

        // Load thana, city corporation, pourashava when district changes
        $(document).on('change', '#district_id', function() {
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
                    success: function(response) {
                        thana.html(response).prop('disabled', false).trigger('change');
                    }
                });

                let locType = $('input[name="location_type"]:checked').val();
                if (locType === 'city_type') {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-city-corporation-by-district') }}/" + distId,
                        success: function(response) {
                            city.html(response).prop('disabled', false).trigger('change');
                        }
                    });
                } else if (locType === 'pos_type') {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-pourashava-by-district') }}/" + distId,
                        success: function(response) {
                            pos.html(response).prop('disabled', false).trigger('change');
                        }
                    });
                }
            }
        });

        // Load post offices & unions when thana changes
        $(document).on('change', '#thana_id', function() {
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
                    success: function(response) {
                        po.html(response).prop('disabled', false).trigger('change');
                    }
                });

                let locType = $('input[name="location_type"]:checked').val();
                if (locType === 'union_type') {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-unions-by-thana') }}/" + thanaId,
                        success: function(response) {
                            union.html(response).prop('disabled', false).trigger('change');
                        }
                    });
                }
            }
        });

        // Load villages based on union/pourashava/city-corp
        $('#union_id, #pos_id, #city_id').change(function() {
            let value = $(this).val();
            let type = $(this).data('type');
            let village = $('#village_id');
            village.html('<option value="">নির্বাচন করুন</option>').prop('disabled', true).trigger('change');

            if (value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-type') }}/" + value + '/' + type,
                    success: function(response) {
                        village.html(response).prop('disabled', false).trigger('change');
                    }
                });
            }
        });

        // Form Submit Handler via AJAX
        $('#citizenRegisterForm').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let btn = form.find('button[type="submit"]');

            // Clear errors
            form.find('.error-name, .error-bn_name, .error-father_name, .error-dob, .error-nid_no, .error-mobile, .error-email, .error-password, .error-password_confirmation').text('');

            $.ajax({
                type: "POST",
                url: "{{ route('frontend.user.register.store') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    btn.prop('disabled', true).html('নিবন্ধন হচ্ছে... <i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect_url;
                    }, 1500);
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('নিবন্ধন সম্পন্ন করুন <i class="fas fa-arrow-right"></i>');
                    let responseText = JSON.parse(xhr.responseText);
                    toastr.error(responseText.message);
                    
                    if (responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            form.find(".error-" + key).text(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
