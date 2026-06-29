@extends('frontend.master')
@section('title', 'ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্স আবেদন ফরম')

@push('style')

@endpush

@section('content')
<div class="container py-8">
    <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3">
        <!-- Header -->
        <div class="d-d-flex align-align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3">
            <div class="d-d-flex h-12 w-12 align-align-items-center justify-content-center rounded-full bg-white text-gov-green">
                <i class="fas fa-user-shield text-2xl"></i>
            </div>
            <div>
                <h2>ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্স আবেদন ফরম</h2>
                <p class="fs-content text-green-100 mt-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
            </div>
        </div>

        <!-- Form Body -->
        <div class="gov-body">
            <form id="publicPersonGunForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- 1. Primary Details -->
                <h5 class="section-title"><i class="fas fa-file-alt"></i> আবেদনের প্রাথমিক তথ্য</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="district_magistrate">জেলা ম্যাজিস্ট্রেট <span class="text-danger">*</span></label>
                        <input type="text" name="district_magistrate" class="form-control" id="district_magistrate" required placeholder="যেমন: ঢাকা">
                        <small class="error-text error district_magistrate_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="application_class">আবেদনের শ্রেণী <span class="text-danger">*</span></label>
                        <select name="application_class" class="form-control" id="application_class" required>
                            <option value="সাধারণ" selected>সাধারণ</option>
                            <option value="বিশেষাধিকারযুক্ত">বিশেষাধিকারযুক্ত</option>
                            <option value="ওয়ারিশসূত্রে">ওয়ারিশসূত্রে</option>
                            <option value="শ্যুটার">শ্যুটার</option>
                        </select>
                        <small class="error-text error application_class_error"></small>
                    </div>
                </div>

                <!-- 2. Personal Details -->
                <h5 class="section-title"><i class="fas fa-user"></i> আবেদনকারীর বিবরণ</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="applicant_name">আবেদনকারীর নাম বাংলায় <span class="text-danger">*</span></label>
                        <input type="text" name="applicant_name" class="form-control" id="applicant_name" required placeholder="বাংলায় পুরো নাম ও ডাকনাম">
                        <small class="error-text error applicant_name_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="applicant_name_en">আবেদনকারীর নাম ইংরেজীতে <span class="text-danger">*</span></label>
                        <input type="text" name="applicant_name_en" class="form-control" id="applicant_name_en" required placeholder="ইংরেজীতে বড় অক্ষরে নাম">
                        <small class="error-text error applicant_name_en_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="nid_no">জাতীয় পরিচিতি নম্বর <span class="text-danger">*</span></label>
                        <input type="text" name="nid_no" class="form-control" id="nid_no" required placeholder="NID বা স্মার্ট কার্ড নম্বর">
                        <small class="error-text error nid_no_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-3">
                        <label for="dob">জন্ম তারিখ <span class="text-danger">*</span></label>
                        <input type="date" name="dob" class="form-control" id="dob" required>
                        <small class="error-text error dob_error"></small>
                    </div>
                    <div class="col-md-3">
                        <label for="age_at_application">আবেদনের তারিখে বয়স <span class="text-danger">*</span></label>
                        <input type="text" name="age_at_application" class="form-control" id="age_at_application" required placeholder="আবেদনের তারিখে বয়স">
                        <small class="error-text error age_at_application_error"></small>
                    </div>
                    <div class="col-md-3">
                        <label for="gender">লিঙ্গ <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control" id="gender" required>
                            <option value="">সিলেক্ট করুন</option>
                            <option value="পুরুষ" selected>পুরুষ</option>
                            <option value="মহিলা">মহিলা</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                        <small class="error-text error gender_error"></small>
                    </div>
                    <div class="col-md-3">
                        <label for="nationality">জাতীয়তা <span class="text-danger">*</span></label>
                        <input type="text" name="nationality" class="form-control" id="nationality" required value="বাংলাদেশী">
                        <small class="error-text error nationality_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="phone">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" id="phone" required placeholder="মোবাইল নম্বর">
                        <small class="error-text error phone_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="email">ইমেইল</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="ইমেইল এড্রেস">
                        <small class="error-text error email_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="father_name">পিতার নাম <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control" id="father_name" required placeholder="পিতার নাম">
                        <small class="error-text error father_name_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="father_profession">পিতার পেশা</label>
                        <input type="text" name="father_profession" class="form-control" id="father_profession" placeholder="পিতার পেশা">
                        <small class="error-text error father_profession_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="mother_name">মাতার নাম <span class="text-danger">*</span></label>
                        <input type="text" name="mother_name" class="form-control" id="mother_name" required placeholder="মাতার নাম">
                        <small class="error-text error mother_name_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="mother_profession">মাতার পেশা</label>
                        <input type="text" name="mother_profession" class="form-control" id="mother_profession" placeholder="মাতার পেশা">
                        <small class="error-text error mother_profession_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="marital_status">বৈবাহিক অবস্থা <span class="text-danger">*</span></label>
                        <select name="marital_status" class="form-control" id="marital_status" required>
                            <option value="অবিবাহিত" selected>অবিবাহিত</option>
                            <option value="বিবাহিত">বিবাহিত</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                        <small class="error-text error marital_status_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="religion">ধর্ম <span class="text-danger">*</span></label>
                        <select name="religion" class="form-control" id="religion" required>
                            <option value="">সিলেক্ট করুন</option>
                            <option value="ইসলাম" selected>ইসলাম</option>
                            <option value="हिंदू">হিন্দু</option>
                            <option value="বৌদ্ধ">বৌদ্ধ</option>
                            <option value="খ্রিস্টান">খ্রিস্টান</option>
                            <option value="অন্যান্য">অন্যান্য</option>
                        </select>
                        <small class="error-text error religion_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="education_qualification">শিক্ষাগত যোগ্যতা <span class="text-danger">*</span></label>
                        <input type="text" name="education_qualification" class="form-control" id="education_qualification" required placeholder="যেমন: বিএ/এমএ/সমমান">
                        <small class="error-text error education_qualification_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3" id="spouse_details_div" style="display: none;">
                    <div class="col-md-6">
                        <label for="spouse_name">স্বামী/স্ত্রীর নাম</label>
                        <input type="text" name="spouse_name" class="form-control" id="spouse_name" placeholder="স্বামী/স্ত্রীর নাম">
                        <small class="error-text error spouse_name_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="spouse_profession">স্বামী/স্ত্রীর পেশা</label>
                        <input type="text" name="spouse_profession" class="form-control" id="spouse_profession" placeholder="স্বামী/স্ত্রীর পেশা">
                        <small class="error-text error spouse_profession_error"></small>
                    </div>
                </div>

                <!-- 3. Address Details -->
                <h5 class="section-title"><i class="fas fa-map-marker-alt"></i> ঠিকানা</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="present_address">বর্তমান ঠিকানা <span class="text-danger">*</span></label>
                        <textarea name="present_address" class="form-control" id="present_address" rows="3" style="height: auto !important;" required placeholder="বর্তমান যোগাযোগের ঠিকানা"></textarea>
                        <small class="error-text error present_address_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="permanent_address">স্থায়ী ঠিকানা <span class="text-danger">*</span></label>
                        <textarea name="permanent_address" class="form-control" id="permanent_address" rows="3" style="height: auto !important;" required placeholder="স্থায়ী ঠিকানা"></textarea>
                        <small class="error-text error permanent_address_error"></small>
                    </div>
                </div>

                <!-- 4. Profession & Income -->
                <h5 class="section-title"><i class="fas fa-briefcase"></i> পেশা ও আয়</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="profession_details">পেশার বিবরণ <span class="text-danger">*</span></label>
                        <input type="text" name="profession_details" class="form-control" id="profession_details" required placeholder="পেশা বা ব্যবসায়ের বিবরণ">
                        <small class="error-text error profession_details_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="annual_income">বার্ষিক আয় <span class="text-danger">*</span></label>
                        <input type="text" name="annual_income" class="form-control" id="annual_income" required placeholder="যেমন: ৫,০০,০০০">
                        <small class="error-text error annual_income_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="income_source">আয়ের উৎস <span class="text-danger">*</span></label>
                        <input type="text" name="income_source" class="form-control" id="income_source" required placeholder="আয়ের প্রধান উৎস">
                        <small class="error-text error income_source_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="profession_address">প্রতিষ্ঠানের নাম ও ঠিকানা</label>
                        <textarea name="profession_address" class="form-control" id="profession_address" rows="2" style="height: auto !important;" placeholder="কর্মস্থল বা প্রতিষ্ঠানের নাম ও ঠিকানা"></textarea>
                        <small class="error-text error profession_address_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="tin_no">আয়কর টিআইএন নম্বর</label>
                        <input type="text" name="tin_no" class="form-control" id="tin_no" placeholder="১২ ডিজিটের টিআইএন (TIN)">
                        <small class="error-text error tin_no_error"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="tax_history_details">পূর্ববর্তী ৩ কর বছরের আয়করের বিবরণ</label>
                        <textarea name="tax_history_details" class="form-control" id="tax_history_details" rows="2" style="height: auto !important;" placeholder="কর বছর এবং করের পরিমাণসহ বিবরণ দিন (যেমন: ২০২২-২৩: ৫০,০০০ টাকা)"></textarea>
                        <small class="error-text error tax_history_details_error"></small>
                    </div>
                </div>

                <!-- 5. Government Employee fields -->
                <h5 class="section-title"><i class="fas fa-user-tie"></i> সরকারি কর্মচারী সংক্রান্ত</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="is_govt_employee">আবেদনকারী কি একজন সরকারি কর্মচারী? <span class="text-danger">*</span></label>
                        <select name="is_govt_employee" class="form-control" id="is_govt_employee" required>
                            <option value="0" selected>না</option>
                            <option value="1">হ্যাঁ</option>
                        </select>
                        <small class="error-text error is_govt_employee_error"></small>
                    </div>
                </div>

                <div id="govt_employee_details_div" style="display: none;" class="mb-3">
                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <label for="cadre_service_name">ক্যাডার/সার্ভিসের নাম</label>
                            <input type="text" name="cadre_service_name" class="form-control" id="cadre_service_name" placeholder="যেমন: বিসিএস (প্রশাসন)">
                            <small class="error-text error cadre_service_name_error"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="designation">পদবী</label>
                            <input type="text" name="designation" class="form-control" id="designation" placeholder="বর্তমান পদবী">
                            <small class="error-text error designation_error"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="pay_grade_salary">বেতন গ্রেড ও মূলবেতন</label>
                            <input type="text" name="pay_grade_salary" class="form-control" id="pay_grade_salary" placeholder="যেমন: ৯ম গ্রেড, ২২,০০০/-">
                            <small class="error-text error pay_grade_salary_error"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="workplace_address">বর্তমান কর্মস্থলের ঠিকানা</label>
                            <textarea name="workplace_address" class="form-control" id="workplace_address" rows="2" style="height: auto !important;" placeholder="বর্তমান কর্মস্থলের পূর্ণাঙ্গ ঠিকানা"></textarea>
                            <small class="error-text error workplace_address_error"></small>
                        </div>
                    </div>
                </div>

                <!-- 6. Previous Firearm details -->
                <h5 class="section-title"><i class="fas fa-history"></i> পূর্ববর্তী অস্ত্রের বিবরণ</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="duty_free_import">ইতঃপূর্বে শুল্কমুক্ত সুবিধায় বিদেশ হতে অস্ত্র আমদানি করেছেন কি?</label>
                        <input type="text" name="duty_free_import" class="form-control" id="duty_free_import" placeholder="আমদানি করে থাকলে অস্ত্রের বিবরণ, অন্যথায় 'না' লিখুন">
                        <small class="error-text error duty_free_import_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="license_cancelled_before">ইতঃপূর্বে কোনো আগ্নেয়াস্ত্রের লাইসেন্স বাতিল করা হয়েছে কি? <span class="text-danger">*</span></label>
                        <select name="license_cancelled_before" class="form-control" id="license_cancelled_before" required>
                            <option value="0" selected>না</option>
                            <option value="1">হ্যাঁ</option>
                        </select>
                        <small class="error-text error license_cancelled_before_error"></small>
                    </div>
                </div>

                <div id="cancellation_details_div" style="display: none;" class="mb-3">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="cancelled_weapon_type">বাতিলকৃত অস্ত্রের ধরণ</label>
                            <input type="text" name="cancelled_weapon_type" class="form-control" id="cancelled_weapon_type" placeholder="অস্ত্রের ধরণ ও লাইসেন্স নম্বর">
                            <small class="error-text error cancelled_weapon_type_error"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="cancellation_reason">বাতিলের কারণ</label>
                            <textarea name="cancellation_reason" class="form-control" id="cancellation_reason" rows="2" style="height: auto !important;" placeholder="লাইসেন্স বাতিলের কারণ"></textarea>
                            <small class="error-text error cancellation_reason_error"></small>
                        </div>
                    </div>
                </div>

                <!-- 7. Weapon Requirements & Affidavit -->
                <h5 class="section-title"><i class="fas fa-crosshairs"></i> চাহিত অস্ত্র ও হলফনামা</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="weapon_details">চাহিত আগ্নেয়াস্ত্রের ধরণ <span class="text-danger">*</span></label>
                        <select name="weapon_details" class="form-control select2" id="weapon_details" required>
                            <option value="">সিলেক্ট করুন</option>
                            <option value="পিস্তল /রিভলবার">পিস্তল /রিভলবার</option>
                            <option value="বন্দুক/শটগান/রাইফেল">বন্দুক/শটগান/রাইফেল</option>
                        </select>
                        <small class="error-text error weapon_details_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="weapon_count">আগ্নেয়াস্ত্র সংখ্যা <span class="text-danger">*</span></label>
                        <input type="number" name="weapon_count" class="form-control" id="weapon_count" value="1" min="1" required>
                        <small class="error-text error weapon_count_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label>লাইসেন্সের ধরণ</label>
                        <input type="text" class="form-control" value="ব্যক্তিগত" readonly style="background-color: #f1f5f9 !important;">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="necessity_reason">কী কারণে চাহিত আগ্নেয়াস্ত্র লাইসেন্সের প্রয়োজন <span class="text-danger">*</span></label>
                        <textarea name="necessity_reason" class="form-control" id="necessity_reason" rows="3" style="height: auto !important;" required placeholder="অস্ত্র লাইসেন্সের যৌক্তিকতা ব্যাখ্যা করুন"></textarea>
                        <small class="error-text error necessity_reason_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="affidavit_attached">হলফনামা প্রদান করা হয়েছে কি? <span class="text-danger">*</span></label>
                        <select name="affidavit_attached" class="form-control" id="affidavit_attached" required>
                            <option value="0">না</option>
                            <option value="1">হ্যাঁ (সংযুক্ত করা হয়েছে)</option>
                        </select>
                        <small class="error-text error affidavit_attached_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="heir_deed_attached">না-দাবীনামা সংযুক্ত করা হয়েছে কি? <span class="text-danger">*</span></label>
                        <select name="heir_deed_attached" class="form-control" id="heir_deed_attached" required>
                            <option value="0" selected>না (প্রযোজ্য নয়)</option>
                            <option value="1">হ্যাঁ (সংযুক্ত করা হয়েছে)</option>
                        </select>
                        <small class="error-text error heir_deed_attached_error"></small>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="d-d-flex justify-content-end gap-3 mt-8 border-t pt-4">
                    <a href="{{ route('frontend.gun-license.select') }}" class="btn btn-gov-cancel">বাতিল করুন</a>
                    <button type="submit" class="btn btn-gov-submit">আবেদন সম্পন্ন করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        width: '100%'
    });

    // Dynamic weapon count max validation based on application class
    function updateWeaponCountMax() {
        let appClass = $('#application_class').val();
        let weaponCountInput = $('#weapon_count');
        let maxWeapons = (appClass === 'শ্যুটার') ? 3 : 1;
        
        weaponCountInput.attr('max', maxWeapons);
        
        let val = parseInt(weaponCountInput.val()) || 0;
        if (val > maxWeapons) {
            weaponCountInput.val(maxWeapons);
            toastr.warning("এই আবেদনের শ্রেণীর জন্য সর্বোচ্চ " + maxWeapons + " টি আগ্নেয়াস্ত্রের আবেদন করা যাবে।");
        }
    }
    
    $('#application_class').on('change', function() {
        updateWeaponCountMax();
    });

    $('#weapon_count').on('input change keyup', function() {
        updateWeaponCountMax();
    });

    updateWeaponCountMax();

    // Toggle Spouse Details
    $('#marital_status').on('change', function() {
        if ($(this).val() === 'বিবাহিত') {
            $('#spouse_details_div').slideDown();
        } else {
            $('#spouse_details_div').slideUp();
            $('#spouse_name, #spouse_profession').val('');
        }
    });

    // Toggle Govt Employee Details
    $('#is_govt_employee').on('change', function() {
        if ($(this).val() === '1') {
            $('#govt_employee_details_div').slideDown();
        } else {
            $('#govt_employee_details_div').slideUp();
            $('#govt_employee_details_div').find('input, textarea').val('');
        }
    });

    // Toggle Cancellation Details
    $('#license_cancelled_before').on('change', function() {
        if ($(this).val() === '1') {
            $('#cancellation_details_div').slideDown();
        } else {
            $('#cancellation_details_div').slideUp();
            $('#cancellation_details_div').find('input, textarea').val('');
        }
    });

    // Form Submission
    $('#publicPersonGunForm').on('submit', function(e) {
        e.preventDefault();
        let thisForm = $(this);
        $('.error-text').text('');
        $('.form-control').removeClass('is-invalid');

        let appClass = $('#application_class').val();
        let weapons = parseInt($('#weapon_count').val()) || 0;
        let maxAllowed = (appClass === 'শ্যুটার') ? 3 : 1;

        if (weapons > maxAllowed) {
            toastr.error("আবেদনের শ্রেণী অনুযায়ী আগ্নেয়াস্ত্র সংখ্যা সর্বোচ্চ " + maxAllowed + " টি হতে পারে।");
            $('#weapon_count').addClass('is-invalid');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('frontend.gun-license.person.store') }}",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                thisForm.find('button[type="submit"]').prop("disabled", true).text('প্রক্রিয়াধীন...');
            },
            success: function(response) {
                toastr.success(response.message);
                setTimeout(() => {
                    location.href = response.redirect_url;
                }, 1000);
            },
            error: function(xhr) {
                thisForm.find('button[type="submit"]').prop("disabled", false).text('আবেদন সম্পন্ন করুন');
                if (xhr.status === 400) {
                    let responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "ভুল এন্ট্রি রয়েছে।");
                    if (responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                            thisForm.find('[name="' + key + '"]').addClass('is-invalid');
                        });
                    }
                } else {
                    toastr.error('দুঃখিত, আবেদন প্রক্রিয়াকরণে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                }
            }
        });
    });
});
</script>
@endpush
