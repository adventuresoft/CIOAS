@extends('frontend.master')
@section('title', 'নতুন লাইসেন্সের আবেদন')

@push('style')

@endpush

@section('content')
    <div class="container pb-3">
        <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3">
            <!-- Header -->
            <div class="d-flex align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3">
                <div
                    class="d-flex h-12 w-12 align-items-center justify-content-center rounded-full bg-white text-gov-green">
                    <i class="fas fa-file-signature text-2xl"></i>
                </div>
                <div>
                    <h5 class="fw-semibold fs-6">লাইসেন্স আবেদন ফরম</h5>
                    <p class="fs-content text-green-100 mt-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস
                        অটোমেশন সিস্টেম</p>
                </div>
            </div>

            <!-- Form Body -->
            <div class="gov-body">
                <form id="publicLicenseForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div id="step-1">


                        <!-- Organization Name -->
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="name">প্রতিষ্ঠানের নাম (English) <span class="text-danger">*</span></label>
                                <input type="text" required name="name" placeholder="Enter Organization Name"
                                    class="form-control" id="name">
                                <small class="error-text error name_error"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="bn_name">প্রতিষ্ঠানের নাম (বাংলা)</label>
                                <input type="text" name="bn_name" placeholder="প্রতিষ্ঠানের বাংলা নাম লিখুন"
                                    class="form-control" id="bn_name">
                                <small class="error-text error bn_name_error"></small>
                            </div>
                        </div>

                        <!-- Category, Subcategory, Type -->
                        <div class="row g-4 mb-3">
                            <div class="col-md-4">
                                <label for="organization_category_id">ক্যাটেগরি <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="organization_category_id"
                                    id="organization_category_id" required>
                                    <option value="">ক্যাটেগরি নির্বাচন করুন</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->en_name }}</option>
                                    @endforeach
                                </select>
                                <small class="error-text error organization_category_id_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="organization_subcategory_id">সাব-ক্যাটেগরি <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" name="organization_subcategory_id"
                                    id="organization_subcategory_id" required>
                                    <option value="">সাব-ক্যাটেগরি নির্বাচন করুন</option>
                                </select>
                                <small class="error-text error organization_subcategory_id_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="organization_type_id">মালিকানার ধরন</label>
                                <select class="form-control select2" name="organization_type_id" id="organization_type_id">
                                    <option value="">ধরন নির্বাচন করুন</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->en_name }}</option>
                                    @endforeach
                                </select>
                                <small class="error-text error organization_type_id_error"></small>
                            </div>
                        </div>

                        <!-- Organization Details (RJSC, Owners, Capital, Est. Year, Application Type) -->
                        <div class="row g-4 mb-3">
                            <div class="col-md-4 d-none" id="rjsc_reg_no_div">
                                <label for="rjsc_reg_no">RJSC রেজিস্ট্রেশন নম্বর</label>
                                <input type="text" name="rjsc_reg_no" placeholder="RJSC Reg. No." class="form-control"
                                    id="rjsc_reg_no">
                                <small class="error-text error rjsc_reg_no_error"></small>
                            </div>
                            <div class="col-md-4 d-none" id="no_of_owner_div">
                                <label for="no_of_owner">মালিকের সংখ্যা</label>
                                <input type="number" name="no_of_owner" placeholder="Number of Owners" class="form-control"
                                    id="no_of_owner">
                                <small class="error-text error no_of_owner_error"></small>
                            </div>
                            <div class="col-md-4 d-none" id="no_of_dir_div">
                                <label for="no_of_dir">পরিচালকের সংখ্যা</label>
                                <input type="number" name="no_of_dir" placeholder="Number of Directors" class="form-control"
                                    id="no_of_dir">
                                <small class="error-text error no_of_dir_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="capital">মূলধন (টাকা)</label>
                                <input type="number" name="capital" placeholder="Capital Amount" class="form-control"
                                    id="capital">
                                <small class="error-text error capital_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="establish_year">প্রতিষ্ঠার সাল</label>
                                <input type="number" min="1900" max="{{ date('Y') }}" name="establish_year"
                                    value="{{ date('Y') }}" class="form-control" id="establish_year">
                                <small class="error-text error establish_year_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label for="application_type">আবেদনের ধরন</label>
                                <select class="form-control select2" name="application_type" id="application_type">
                                    <option value="new" selected>নতুন (NEW)</option>
                                    <option value="old">পুরাতন (OLD)</option>
                                </select>
                                <small class="error-text error application_type_error"></small>
                            </div>
                        </div>

                        <!-- Section: Registered Address -->
                        <h5 class="section-title"><i class="fas fa-map-marked-alt"></i> নিবন্ধিত ঠিকানা (Registered Address)
                        </h5>

                        <!-- Registered Address Location Type -->
                        <div class="row align-align-items-center mb-3 pt-2">
                            <label class="col-md-2 font-weight-bold">ঠিকানার ধরন:</label>
                            <div class="col-md-10">
                                <div class="d-d-flex align-align-items-center flex-wrap gap-3">
                                    <label class="location-type-card">
                                        <input type="radio" name="location_type" value="city_type"
                                            class="location-type-radio d-none">
                                        <i class="fas fa-city location-icon"></i>
                                        <span>সিটি কর্পোরেশন (City Corporation)</span>
                                    </label>
                                    <label class="location-type-card">
                                        <input type="radio" name="location_type" value="pos_type"
                                            class="location-type-radio d-none">
                                        <i class="fas fa-building location-icon"></i>
                                        <span>পৌরসভা (Pourashava)</span>
                                    </label>
                                    <label class="location-type-card">
                                        <input type="radio" name="location_type" value="union_type"
                                            class="location-type-radio d-none">
                                        <i class="fas fa-warehouse location-icon"></i>
                                        <span>ইউনিয়ন (Union)</span>
                                    </label>
                                </div>
                                <small class="error-text error location_type_error"></small>
                            </div>
                        </div>

                        <!-- Registered Address Details -->
                        <div class="present_address_filed d-none mb-3">
                            <div class="row g-4 mb-3">
                                <div class="col-md-4">
                                    <label for="division_id">বিভাগ</label>
                                    <select name="division_id" class="form-control select2" id="division_id">
                                        <option value="">বিভাগ নির্বাচন করুন</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="error-text error division_id_error"></small>
                                </div>
                                <div class="col-md-4">
                                    <label for="district_id">জেলা</label>
                                    <select name="district_id" class="form-control select2" id="district_id" disabled>
                                        <option value="">জেলা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error district_id_error"></small>
                                </div>
                                <div class="col-md-4">
                                    <label for="thana_id">থানা</label>
                                    <select name="thana_id" class="form-control select2" id="thana_id" disabled>
                                        <option value="">থানা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error thana_id_error"></small>
                                </div>
                            </div>

                            <div class="row g-4 mb-3">
                                <!-- City Corporation -->
                                <div class="col-md-4 city_type d-none">
                                    <label for="city_corporation_id">সিটি কর্পোরেশন</label>
                                    <select name="city_id" class="form-control select2" id="city_corporation_id"
                                        data-type="City" disabled>
                                        <option value="">সিটি কর্পোরেশন নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error city_id_error"></small>
                                </div>
                                <!-- Pourashava -->
                                <div class="col-md-4 pos_type d-none">
                                    <label for="pourashova_id">পৌরসভা</label>
                                    <select name="pos_id" class="form-control select2" id="pourashova_id"
                                        data-type="pourashova" disabled>
                                        <option value="">পৌরসভা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error pos_id_error"></small>
                                </div>
                                <!-- Union -->
                                <div class="col-md-4 union_type d-none">
                                    <label for="union_id">ইউনিয়ন</label>
                                    <select name="union_id" class="form-control select2" id="union_id" data-type="union"
                                        disabled>
                                        <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error union_id_error"></small>
                                </div>
                                <!-- Post Office -->
                                <div class="col-md-4">
                                    <label for="post_office_id">পোস্ট অফিস</label>
                                    <select name="post_office_id" class="form-control select2" id="post_office_id" disabled>
                                        <option value="">পোস্ট অফিস নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error post_office_id_error"></small>
                                </div>
                                <!-- Village -->
                                <div class="col-md-4">
                                    <label for="village_id">গ্রাম/মহল্লা</label>
                                    <select name="village_id" class="form-control select2" id="village_id" disabled>
                                        <option value="">গ্রাম নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error village_id_error"></small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label for="ward_id">ওয়ার্ড</label>
                                    <select name="ward_id" class="form-control select2" id="ward_id">
                                        <option value="">ওয়ার্ড নির্বাচন করুন</option>
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}</option>
                                        @endforeach
                                    </select>
                                    <small class="error-text error ward_id_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="road">রোড/রাস্তা</label>
                                    <input type="text" name="road" class="form-control" id="road" placeholder="Road Name">
                                    <small class="error-text error road_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="house">হোল্ডিং/বাসা নং</label>
                                    <input type="text" name="house" class="form-control" id="house" placeholder="House No">
                                    <small class="error-text error house_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="house_bn">হোল্ডিং/বাসা নং (বাংলা)</label>
                                    <input type="text" name="house_bn" class="form-control" id="house_bn"
                                        placeholder="বাসা নম্বর বাংলা">
                                    <small class="error-text error house_bn_error"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Corporate Office/Factory Address -->
                        <h5 class="section-title"><i class="fas fa-building"></i> কর্পোরেট অফিস/ফ্যাক্টরি ঠিকানা</h5>

                        <!-- Corporate Office Address Location Type -->
                        <div class="row align-align-items-center mb-3 pt-2">
                            <label class="col-md-2 font-weight-bold">ঠিকানার ধরন:</label>
                            <div class="col-md-10">
                                <div class="d-d-flex align-align-items-center flex-wrap gap-3">
                                    <label class="location-type-card office-location-type-card">
                                        <input type="radio" name="office_location_type" value="city_type"
                                            class="office-location-type-radio d-none">
                                        <i class="fas fa-city location-icon"></i>
                                        <span>সিটি কর্পোরেশন (City Corporation)</span>
                                    </label>
                                    <label class="location-type-card office-location-type-card">
                                        <input type="radio" name="office_location_type" value="pos_type"
                                            class="office-location-type-radio d-none">
                                        <i class="fas fa-building location-icon"></i>
                                        <span>পৌরসভা (Pourashava)</span>
                                    </label>
                                    <label class="location-type-card office-location-type-card">
                                        <input type="radio" name="office_location_type" value="union_type"
                                            class="office-location-type-radio d-none">
                                        <i class="fas fa-warehouse location-icon"></i>
                                        <span>ইউনিয়ন (Union)</span>
                                    </label>
                                </div>
                                <small class="error-text error office_location_type_error"></small>
                            </div>
                        </div>

                        <!-- Corporate Office Address Details -->
                        <div class="office_address_field d-none mb-3">
                            <div class="row g-4 mb-3">
                                <div class="col-md-4">
                                    <label for="office_division_id">বিভাগ</label>
                                    <select name="office_division_id" class="form-control select2" id="office_division_id">
                                        <option value="">বিভাগ নির্বাচন করুন</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="error-text error office_division_id_error"></small>
                                </div>
                                <div class="col-md-4">
                                    <label for="office_district_id">জেলা</label>
                                    <select name="office_district_id" class="form-control select2" id="office_district_id"
                                        disabled>
                                        <option value="">জেলা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_district_id_error"></small>
                                </div>
                                <div class="col-md-4">
                                    <label for="office_thana_id">থানা</label>
                                    <select name="office_thana_id" class="form-control select2" id="office_thana_id"
                                        disabled>
                                        <option value="">থানা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_thana_id_error"></small>
                                </div>
                            </div>

                            <div class="row g-4 mb-3">
                                <!-- City Corporation -->
                                <div class="col-md-4 office_city_type d-none">
                                    <label for="office_city_corporation_id">সিটি কর্পোরেশন</label>
                                    <select name="office_city_id" class="form-control select2"
                                        id="office_city_corporation_id" data-type="City" disabled>
                                        <option value="">সিটি কর্পোরেশন নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_city_id_error"></small>
                                </div>
                                <!-- Pourashava -->
                                <div class="col-md-4 office_pos_type d-none">
                                    <label for="office_pourashova_id">পৌরসভা</label>
                                    <select name="office_pos_id" class="form-control select2" id="office_pourashova_id"
                                        data-type="pourashova" disabled>
                                        <option value="">পৌরসভা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_pos_id_error"></small>
                                </div>
                                <!-- Union -->
                                <div class="col-md-4 office_union_type d-none">
                                    <label for="office_union_id">ইউনিয়ন</label>
                                    <select name="office_union_id" class="form-control select2" id="office_union_id"
                                        data-type="union" disabled>
                                        <option value="">ইউনিয়ন নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_union_id_error"></small>
                                </div>
                                <!-- Post Office -->
                                <div class="col-md-4">
                                    <label for="office_post_office_id">পোস্ট অফিস</label>
                                    <select name="office_post_office_id" class="form-control select2"
                                        id="office_post_office_id" disabled>
                                        <option value="">পোস্ট অফিস নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_post_office_id_error"></small>
                                </div>
                                <!-- Village -->
                                <div class="col-md-4">
                                    <label for="office_village_id">গ্রাম/মহল্লা</label>
                                    <select name="office_village_id" class="form-control select2" id="office_village_id"
                                        disabled>
                                        <option value="">গ্রাম নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_village_id_error"></small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label for="office_ward_id">ওয়ার্ড</label>
                                    <select name="office_ward_id" class="form-control select2" id="office_ward_id">
                                        <option value="">ওয়ার্ড নির্বাচন করুন</option>
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}</option>
                                        @endforeach
                                    </select>
                                    <small class="error-text error office_ward_id_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="office_road">রোড/রাস্তা</label>
                                    <input type="text" name="office_road" class="form-control" id="office_road"
                                        placeholder="Road Name">
                                    <small class="error-text error office_road_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="office_house">হোল্ডিং/বাসা নং</label>
                                    <input type="text" name="office_house" class="form-control" id="office_house"
                                        placeholder="House No">
                                    <small class="error-text error office_house_error"></small>
                                </div>
                                <div class="col-md-3">
                                    <label for="office_house_bn">হোল্ডিং/বাসা নং (বাংলা)</label>
                                    <input type="text" name="office_house_bn" class="form-control" id="office_house_bn"
                                        placeholder="বাসা নম্বর বাংলা">
                                    <small class="error-text error office_house_bn_error"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Logo Upload -->
                        <h5 class="section-title"><i class="fas fa-image"></i> লোগো আপলোড (Organization Logo)</h5>
                        <div class="row align-align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="hotel_logo" class="font-weight-bold">প্রতিষ্ঠানের লোগো / ছবি:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="hotel_logo" class="form-control" id="hotel_logo" accept="image/*"
                                    style="padding: 10px 14px; height: auto;">
                                <small class="error-text error hotel_logo-error hotel_logo_error"></small>
                            </div>
                        </div>

                        <!-- Section: Premises Ownership -->
                        <h5 class="section-title"><i class="fas fa-home"></i> প্রাঙ্গণ মালিকানা বিবরণী (Premises Ownership)
                        </h5>
                        <div class="row align-align-items-center mb-3 pt-2">
                            <label class="col-md-2 font-weight-bold">মালিকানার ধরন:</label>
                            <div class="col-md-10">
                                <div class="d-d-flex align-align-items-center flex-wrap gap-3">
                                    <label class="location-type-card premises-ownership-card">
                                        <input type="radio" name="premises_ownership" value="rented"
                                            class="premises-ownership-radio d-none">
                                        <i class="fas fa-file-contract location-icon"></i>
                                        <span>ভাড়া নেয়া (Rented)</span>
                                    </label>
                                    <label class="location-type-card premises-ownership-card">
                                        <input type="radio" name="premises_ownership" value="owned"
                                            class="premises-ownership-radio d-none">
                                        <i class="fas fa-key location-icon"></i>
                                        <span>স্বীয় মালিকানাধীন (Owned)</span>
                                    </label>
                                </div>
                                <small class="error-text error premises_ownership_error"></small>
                            </div>
                        </div>

                        <!-- Owned Premises Docs -->
                        <div class="premises-docs premises-docs-owned d-none mb-3">
                            <div class="d-d-flex justify-content-between align-align-items-center mb-3">
                                <h6 class="font-weight-bold text-dark m-0"><i class="fas fa-file-alt text-success mr-1"></i>
                                    মালিকানাধীন প্রাঙ্গণের প্রামাণিক দলিলপত্র</h6>
                                <button type="button" class="btn btn-sm btn-outline-success add-doc-row"
                                    data-target="owned">
                                    <i class="fas fa-plus mr-1"></i> Add Document
                                </button>
                            </div>
                            <div class="premises-docs-owned-list">
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="owned_document_name[]" class="form-control"
                                            value="Proof of Land Ownership" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="owned_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <span class="text-muted fs-content">Mandatory</span>
                                    </div>
                                </div>
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="owned_document_name[]" class="form-control"
                                            value="Building Approval Certificate" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="owned_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rented Premises Docs -->
                        <div class="premises-docs premises-docs-rented d-none mb-3">
                            <div class="d-d-flex justify-content-between align-align-items-center mb-3">
                                <h6 class="font-weight-bold text-dark m-0"><i
                                        class="fas fa-file-contract text-success mr-1"></i> ভাড়া নেয়া প্রাঙ্গণের প্রামাণিক
                                    চুক্তি ও দলিলপত্র</h6>
                                <button type="button" class="btn btn-sm btn-outline-success add-doc-row"
                                    data-target="rented">
                                    <i class="fas fa-plus mr-1"></i> Add Document
                                </button>
                            </div>
                            <div class="premises-docs-rented-list">
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="rented_document_name[]" class="form-control"
                                            value="Rental Agreement Document" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="rented_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <span class="text-muted fs-content">Mandatory</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>

            <!-- Footer Buttons Step 1 -->
            <div class="d-d-flex justify-content-end gap-3 mt-8 border-t pt-4">
                <a href="{{ route('home') }}" class="btn btn-gov-cancel">বাতিল করুন</a>
                <button type="button" id="btn-next-step" class="btn btn-gov-submit">পরবর্তী ধাপ <i
                        class="fas fa-arrow-right ms-2"></i></button>
            </div>
        </div> <!-- End Step 1 -->

        <div id="step-2" class="d-none">
            <h4 class="mb-4 text-center fw-bold text-success border-bottom pb-2">মালিক/পরিচালকের তথ্য (Ownership
                Information)</h4>

            <div id="ownership-forms-container">
                <!-- Ownership forms will be generated here -->
            </div>

            <!-- Footer Buttons Step 2 -->
            <div class="d-d-flex justify-content-between gap-3 mt-8 border-t pt-4">
                <button type="button" id="btn-prev-step" class="btn btn-gov-cancel"><i class="fas fa-arrow-left me-2"></i>
                    পূর্ববর্তী ধাপ</button>
                <button type="submit" class="btn btn-gov-submit">আবেদন সম্পন্ন করুন <i
                        class="fas fa-check-circle ms-2"></i></button>
            </div>
        </div>

        <template id="ownership-template">
            <div class="card shadow-sm border mb-4 ownership-card" style="border-radius: 8px;">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title text-dark fw-bold m-0" style="font-size: 1.1rem;">
                        <i class="fas fa-user-tie text-success mr-2"></i> মালিক/পরিচালক - <span class="owner-index"></span>
                    </h5>
                </div>
                <div class="card-body bg-light p-4">
                    <!-- Row 1 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Owner Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name[]" class="form-control" placeholder="Name English" required>
                        </div>
                        <div class="col-md-6">
                            <label>Owner Name Bangla <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name_bn[]" class="form-control" placeholder="Name Bangla"
                                required>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="owner_date_of_birth[]" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Birth Reg. No.</label>
                            <input type="text" name="owner_birth_certificate[]" class="form-control"
                                placeholder="Birth Reg. No.">
                        </div>
                        <div class="col-md-4">
                            <label>NID No.</label>
                            <input type="text" name="owner_nid[]" class="form-control" placeholder="NID No.">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="owner_gender[]" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Religion</label>
                            <select name="owner_religion[]" class="form-control">
                                <option value="">Select Religion</option>
                                <option value="Islam">Islam</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Blood Group</label>
                            <select name="owner_blood_group[]" class="form-control">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Mobile No.</label>
                            <input type="text" name="owner_mobile[]" class="form-control" placeholder="Mobile">
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="owner_email[]" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Father Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="owner_father_name[]" class="form-control"
                                placeholder="Father Name English" required>
                        </div>
                        <div class="col-md-6">
                            <label>Father Name (Bangla) <span class="text-danger">*</span></label>
                            <input type="text" name="owner_father_name_bn[]" class="form-control"
                                placeholder="Father Name Bangla" required>
                        </div>
                    </div>

                    <!-- Row 6 -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Mother Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="owner_mother_name[]" class="form-control"
                                placeholder="Mother Name English" required>
                        </div>
                        <div class="col-md-6">
                            <label>Mother Name (Bangla) <span class="text-danger">*</span></label>
                            <input type="text" name="owner_mother_name_bn[]" class="form-control"
                                placeholder="Mother Name Bangla" required>
                        </div>
                    </div>

                    <!-- Permanent Address -->
                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <h6 class="text-dark fw-bold border-bottom pb-2"><i class="fas fa-home text-muted mr-2"></i>
                                Permanent Address</h6>
                        </div>
                    </div>

                    <div class="owner-perm-address-section">
                        <div class="row align-align-items-center mb-3 pt-2">
                            <label class="col-md-3 font-weight-bold">ঠিকানার ধরন:</label>
                            <div class="col-md-9">
                                <div class="d-d-flex align-align-items-center flex-wrap gap-3">
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_permanent_location_type___INDEX__" value="city_type"
                                            class="location-type-radio d-none owner-perm-location-type-radio">
                                        <i class="fas fa-city location-icon"></i>
                                        <span>সিটি কর্পোরেশন (City Corporation)</span>
                                    </label>
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_permanent_location_type___INDEX__" value="pos_type"
                                            class="location-type-radio d-none owner-perm-location-type-radio">
                                        <i class="fas fa-building location-icon"></i>
                                        <span>পৌরসভা (Pourashava)</span>
                                    </label>
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_permanent_location_type___INDEX__"
                                            value="union_type"
                                            class="location-type-radio d-none owner-perm-location-type-radio">
                                        <i class="fas fa-warehouse location-icon"></i>
                                        <span>ইউনিয়ন (Union)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="owner-perm-fields d-none">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Division</label>
                                    <select name="owner_permanent_division[]"
                                        class="form-control select2 owner-address-division">
                                        <option value="">Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>District</label>
                                    <select name="owner_permanent_district[]"
                                        class="form-control select2 owner-address-district">
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Thana</label>
                                    <select name="owner_permanent_thana[]" class="form-control select2 owner-address-thana">
                                        <option value="">Select Thana</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 owner-perm-city-type d-none">
                                    <label>City Corporation</label>
                                    <select name="owner_permanent_city[]" class="form-control select2 owner-address-city"
                                        data-type="city">
                                        <option value="">Select City Corporation</option>
                                    </select>
                                </div>
                                <div class="col-md-4 owner-perm-pos-type d-none">
                                    <label>Pourashava</label>
                                    <select name="owner_permanent_pourashava[]"
                                        class="form-control select2 owner-address-pourashava" data-type="pos">
                                        <option value="">Select Pourashava</option>
                                    </select>
                                </div>
                                <div class="col-md-4 owner-perm-union-type d-none">
                                    <label>Union</label>
                                    <select name="owner_permanent_union[]" class="form-control select2 owner-address-union"
                                        data-type="union">
                                        <option value="">Select Union</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Post Office</label>
                                    <select name="owner_permanent_post_office[]"
                                        class="form-control select2 owner-address-post-office">
                                        <option value="">Select Post Office</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Village</label>
                                    <select name="owner_permanent_village_id[]"
                                        class="form-control select2 owner-address-village">
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label>Permanent Ward</label>
                                    <select name="owner_permanent_ward_id[]" class="form-control select2">
                                        <option value="">Select Ward</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Road</label>
                                    <input type="text" name="owner_permanent_road[]" class="form-control"
                                        placeholder="Permanent Road">
                                </div>
                                <div class="col-md-3">
                                    <label>Holding/House No.</label>
                                    <input type="text" name="owner_permanent_house[]" class="form-control"
                                        placeholder="Permanent House">
                                </div>
                                <div class="col-md-3">
                                    <label>Holding/House No. (Bangla)</label>
                                    <input type="text" name="owner_permanent_house_bn[]" class="form-control"
                                        placeholder="স্থায়ী বাড়ি">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Present Address -->
                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <h6 class="text-dark fw-bold border-bottom pb-2"><i
                                    class="fas fa-map-marker-alt text-muted mr-2"></i> Present Address</h6>
                        </div>
                    </div>

                    <div class="owner-present-address-section">
                        <div class="row align-align-items-center mb-3 pt-2">
                            <label class="col-md-3 font-weight-bold">ঠিকানার ধরন:</label>
                            <div class="col-md-9">
                                <div class="d-d-flex align-align-items-center flex-wrap gap-3">
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_present_location_type___INDEX__" value="city_type"
                                            class="location-type-radio d-none owner-present-location-type-radio">
                                        <i class="fas fa-city location-icon"></i>
                                        <span>সিটি কর্পোরেশন (City Corporation)</span>
                                    </label>
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_present_location_type___INDEX__" value="pos_type"
                                            class="location-type-radio d-none owner-present-location-type-radio">
                                        <i class="fas fa-building location-icon"></i>
                                        <span>পৌরসভা (Pourashava)</span>
                                    </label>
                                    <label class="location-type-card owner-address-type-card">
                                        <input type="radio" name="owner_present_location_type___INDEX__" value="union_type"
                                            class="location-type-radio d-none owner-present-location-type-radio">
                                        <i class="fas fa-warehouse location-icon"></i>
                                        <span>ইউনিয়ন (Union)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="owner-present-fields d-none">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Division</label>
                                    <select name="owner_present_division[]"
                                        class="form-control select2 owner-address-division">
                                        <option value="">Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>District</label>
                                    <select name="owner_present_district_id[]"
                                        class="form-control select2 owner-address-district">
                                        <option value="">Select District</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Thana</label>
                                    <select name="owner_present_thana_id[]"
                                        class="form-control select2 owner-address-thana">
                                        <option value="">Select Thana</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 owner-present-city-type d-none">
                                    <label>City Corporation</label>
                                    <select name="owner_present_city[]" class="form-control select2 owner-address-city"
                                        data-type="city">
                                        <option value="">Select City Corporation</option>
                                    </select>
                                </div>
                                <div class="col-md-4 owner-present-pos-type d-none">
                                    <label>Pourashava</label>
                                    <select name="owner_present_pourashava[]"
                                        class="form-control select2 owner-address-pourashava" data-type="pos">
                                        <option value="">Select Pourashava</option>
                                    </select>
                                </div>
                                <div class="col-md-4 owner-present-union-type d-none">
                                    <label>Union</label>
                                    <select name="owner_present_union[]" class="form-control select2 owner-address-union"
                                        data-type="union">
                                        <option value="">Select Union</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Post Office</label>
                                    <select name="owner_present_post_office_id[]"
                                        class="form-control select2 owner-address-post-office">
                                        <option value="">Select Post Office</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Village</label>
                                    <select name="owner_present_village_id[]"
                                        class="form-control select2 owner-address-village">
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label>Ward</label>
                                    <select name="owner_present_ward_id[]" class="form-control select2">
                                        <option value="">Select Ward</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Road</label>
                                    <input type="text" name="owner_present_road[]" class="form-control"
                                        placeholder="Present Road">
                                </div>
                                <div class="col-md-3">
                                    <label>House</label>
                                    <input type="text" name="owner_present_house[]" class="form-control"
                                        placeholder="Present House">
                                </div>
                                <div class="col-md-3">
                                    <label>House (Bangla)</label>
                                    <input type="text" name="owner_present_house_bn[]" class="form-control"
                                        placeholder="বর্তমান বাড়ি">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-3">
                        <div class="col-md-4">
                            <label>Photo</label>
                            <input type="file" name="owner_photo[]" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </template>
        </form>
    </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('.select2').select2({
                width: '100%'
            });

            // Handle AJAX Form Submission
            $('#publicLicenseForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $('.error').text('');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('frontend.license.store') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop('disabled', true).text('প্রক্রিয়াধীন...');
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = response.redirect_url;
                        }, 1000);
                    },
                    error: function (xhr) {
                        thisForm.find('button[type="submit"]').prop('disabled', false).text('আবেদন সম্পন্ন করুন');
                        if (xhr.status === 400) {
                            let responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                            $.each(responseText.errors, function (key, val) {
                                thisForm.find('.' + key + '-error').text(val[0]);
                            });
                        } else {
                            toastr.error('দুঃখিত, আবেদন প্রক্রিয়াকরণে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                        }
                    }
                });
            });

            // Dependent Category -> Subcategory
            $(document).on('change', '#organization_category_id', function (e) {
                e.preventDefault();
                let cat_id = $(this).val();
                let subcat_id = $('#organization_subcategory_id');
                if (cat_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('license-subcategory-options') }}/" + cat_id,
                        beforeSend: function () {
                            subcat_id.prop("disabled", true);
                        },
                        success: function (response) {
                            subcat_id.html(response).prop("disabled", false).trigger('change');
                        },
                        error: function () {
                            toastr.error('সাব-ক্যাটেগরি লোড করা যায়নি।');
                        }
                    });
                } else {
                    subcat_id.html('<option value="">সাব-ক্যাটেগরি নির্বাচন করুন</option>').trigger('change');
                }
            });

            // Owner Type Controls: RJSC, Owner count, Director count visibility
            $(document).on('change', '#organization_type_id', function (e) {
                let type_id = $(this).val();
                if (type_id == 2) { // Sole Proprietorship / Partner
                    $('#rjsc_reg_no_div').addClass('d-none');
                    $('#no_of_dir_div').addClass('d-none');
                    $('#no_of_owner_div').removeClass('d-none');
                } else if (type_id == 3) { // Private/Public Ltd
                    $('#no_of_owner_div').addClass('d-none');
                    $('#rjsc_reg_no_div').removeClass('d-none');
                    $('#no_of_dir_div').removeClass('d-none');
                } else {
                    $('#rjsc_reg_no_div').addClass('d-none');
                    $('#no_of_owner_div').addClass('d-none');
                    $('#no_of_dir_div').addClass('d-none');
                }
            });

            // Registered Address dependencies: Division -> District
            $(document).on('change', '#division_id', function (e) {
                e.preventDefault();
                let div_id = $(this).val();
                let dist_id = $('#district_id');
                if (div_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/" + div_id,
                        beforeSend: function () {
                            dist_id.prop("disabled", true);
                        },
                        success: function (response) {
                            dist_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Registered Address dependencies: District -> Thana, City Corp, Pourashava
            $(document).on('change', '#district_id', function (e) {
                e.preventDefault();
                let dist_id = $(this).val();
                let thana_id = $("#thana_id");
                let city_id = $("#city_corporation_id");
                let pos_id = $("#pourashova_id");

                if (dist_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-thanas-by-district') }}/" + dist_id,
                        success: function (response) {
                            thana_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-city-corporation-by-district') }}/" + dist_id,
                        success: function (response) {
                            city_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-pourashava-by-district') }}/" + dist_id,
                        success: function (response) {
                            pos_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Registered Address dependencies: Thana -> Post Office & Union
            $(document).on('change', '#thana_id', function (e) {
                e.preventDefault();
                let thana_id = $(this).val();
                let po_id = $('#post_office_id');
                let union_id = $('#union_id');

                if (thana_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                        success: function (response) {
                            po_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                        success: function (response) {
                            union_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Registered Address dependencies: Pourashava, Union, City Corp -> Village
            $('#pourashova_id, #union_id, #city_corporation_id').change(function (e) {
                e.preventDefault();
                let village_id = $('#village_id');
                let val = $(this).val();
                let type = $(this).data('type');
                if (val) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-villages-by-type') }}/" + val + '/' + type,
                        success: function (response) {
                            village_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });


            // Corporate Office Address dependencies: Division -> District
            $(document).on('change', '#office_division_id', function (e) {
                e.preventDefault();
                let div_id = $(this).val();
                let dist_id = $('#office_district_id');
                if (div_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/" + div_id,
                        beforeSend: function () {
                            dist_id.prop("disabled", true);
                        },
                        success: function (response) {
                            dist_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Corporate Office Address dependencies: District -> Thana, City Corp, Pourashava
            $(document).on('change', '#office_district_id', function (e) {
                e.preventDefault();
                let dist_id = $(this).val();
                let thana_id = $("#office_thana_id");
                let city_id = $("#office_city_corporation_id");
                let pos_id = $("#office_pourashova_id");

                if (dist_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-thanas-by-district') }}/" + dist_id,
                        success: function (response) {
                            thana_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-city-corporation-by-district') }}/" + dist_id,
                        success: function (response) {
                            city_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-pourashava-by-district') }}/" + dist_id,
                        success: function (response) {
                            pos_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Corporate Office Address dependencies: Thana -> Post Office & Union
            $(document).on('change', '#office_thana_id', function (e) {
                e.preventDefault();
                let thana_id = $(this).val();
                let po_id = $('#office_post_office_id');
                let union_id = $('#office_union_id');

                if (thana_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                        success: function (response) {
                            po_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                        success: function (response) {
                            union_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Corporate Office Address dependencies: Pourashava, Union, City Corp -> Village
            $('#office_pourashova_id, #office_union_id, #office_city_corporation_id').change(function (e) {
                e.preventDefault();
                let village_id = $('#office_village_id');
                let val = $(this).val();
                let type = $(this).data('type');
                if (val) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-villages-by-type') }}/" + val + '/' + type,
                        success: function (response) {
                            village_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });


            // Toggle card selection state and active styles
            $(document).on('click', '.location-type-card', function () {
                let radio = $(this).find('input[type="radio"]');
                if (radio.length) {
                    radio.prop('checked', true).trigger('change');
                    if ($(this).hasClass('office-location-type-card')) {
                        $('.office-location-type-card').removeClass('active');
                    } else if ($(this).hasClass('premises-ownership-card')) {
                        $('.premises-ownership-card').removeClass('active');
                    } else if ($(this).hasClass('owner-address-type-card')) {
                        $(this).siblings().removeClass('active');
                    } else {
                        $('.location-type-card:not(.office-location-type-card):not(.premises-ownership-card):not(.owner-address-type-card)').removeClass('active');
                    }
                    $(this).addClass('active');
                }
            });

            // Registered Address Location type toggles
            $(document).on('change', 'input[name="location_type"]', function () {
                let val = $(this).val();
                $('.present_address_filed').removeClass('d-none');
                $('#village_id').html('<option value="">গ্রাম নির্বাচন করুন</option>').trigger('change');

                if (val == 'city_type') {
                    $('.city_type').removeClass('d-none');
                    $('.union_type').addClass('d-none');
                    $('.pos_type').addClass('d-none');
                } else if (val == 'union_type') {
                    $('.union_type').removeClass('d-none');
                    $('.city_type').addClass('d-none');
                    $('.pos_type').addClass('d-none');
                } else if (val == 'pos_type') {
                    $('.pos_type').removeClass('d-none');
                    $('.city_type').addClass('d-none');
                    $('.union_type').addClass('d-none');
                }
            });

            // Corporate Address Location type toggles
            $(document).on('change', 'input[name="office_location_type"]', function () {
                let val = $(this).val();
                $('.office_address_field').removeClass('d-none');
                $('#office_village_id').html('<option value="">গ্রাম নির্বাচন করুন</option>').trigger('change');

                if (val == 'city_type') {
                    $('.office_city_type').removeClass('d-none');
                    $('.office_union_type').addClass('d-none');
                    $('.office_pos_type').addClass('d-none');
                } else if (val == 'union_type') {
                    $('.office_union_type').removeClass('d-none');
                    $('.office_city_type').addClass('d-none');
                    $('.office_pos_type').addClass('d-none');
                } else if (val == 'pos_type') {
                    $('.office_pos_type').removeClass('d-none');
                    $('.office_city_type').addClass('d-none');
                    $('.office_union_type').addClass('d-none');
                }
            });

            // Premises Ownership Toggles
            $(document).on('change', 'input[name="premises_ownership"]', function () {
                let val = $(this).val();
                if (val === 'owned') {
                    $('.premises-docs-owned').removeClass('d-none');
                    $('.premises-docs-rented').addClass('d-none');
                } else if (val === 'rented') {
                    $('.premises-docs-rented').removeClass('d-none');
                    $('.premises-docs-owned').addClass('d-none');
                }
            });

            // Add Document row dynamically
            $(document).on('click', '.add-doc-row', function () {
                let target = $(this).data('target');
                let list = $(`.premises-docs-${target}-list`);
                let newRow = `
                            <div class="row align-align-items-center mb-2 premises-doc-row">
                                <div class="col-md-5 mb-2 mb-md-0">
                                    <input type="text" name="${target}_document_name[]" class="form-control" placeholder="Enter Document Name" required>
                                </div>
                                <div class="col-md-5 mb-2 mb-md-0">
                                    <input type="file" name="${target}_document_file[]" class="form-control" required>
                                </div>
                                <div class="col-md-2 text-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        `;
                list.append(newRow);
            });

            // Remove Document row
            $(document).on('click', '.remove-doc-row', function () {
                $(this).closest('.premises-doc-row').remove();
            });

            // Update filename labels in file inputs
            $(document).on('change', '.custom-file-input', function (e) {
                var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file...";
                $(this).next('.custom-file-label').html(fileName);
            });

            // Step transition and dynamic ownership cloning
            $('#btn-next-step').on('click', function () {
                // Determine number of owners/directors
                let numOwners = parseInt($('#no_of_owner').val()) || parseInt($('#no_of_dir').val()) || 0;

                if (numOwners <= 0) {
                    alert('Please enter a valid number of owners/directors before proceeding.');
                    return;
                }

                // Clear existing forms to prevent duplicates if user goes back and forth
                $('#ownership-forms-container').empty();

                let template = document.getElementById('ownership-template').innerHTML;

                for (let i = 1; i <= numOwners; i++) {
                    let htmlString = template.replace(/__INDEX__/g, i);
                    let formHtml = $(htmlString);
                    formHtml.find('.owner-index').text(i);
                    $('#ownership-forms-container').append(formHtml);
                }

                $('#ownership-forms-container .select2').select2({
                    width: '100%'
                });

                $('#step-1').addClass('d-none');
                $('#step-2').removeClass('d-none');

                // Scroll to top of step 2
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            $('#btn-prev-step').on('click', function () {
                $('#step-2').addClass('d-none');
                $('#step-1').removeClass('d-none');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Ownership Permanent Address Location type toggles
            $(document).on('change', '.owner-perm-location-type-radio', function () {
                let val = $(this).val();
                let context = $(this).closest('.owner-perm-address-section');

                context.find('.owner-perm-fields').removeClass('d-none');

                if (val == 'city_type') {
                    context.find('.owner-perm-city-type').removeClass('d-none');
                    context.find('.owner-perm-union-type').addClass('d-none');
                    context.find('.owner-perm-pos-type').addClass('d-none');
                } else if (val == 'union_type') {
                    context.find('.owner-perm-union-type').removeClass('d-none');
                    context.find('.owner-perm-city-type').addClass('d-none');
                    context.find('.owner-perm-pos-type').addClass('d-none');
                } else if (val == 'pos_type') {
                    context.find('.owner-perm-pos-type').removeClass('d-none');
                    context.find('.owner-perm-city-type').addClass('d-none');
                    context.find('.owner-perm-union-type').addClass('d-none');
                }
            });

            // Ownership Present Address Location type toggles
            $(document).on('change', '.owner-present-location-type-radio', function () {
                let val = $(this).val();
                let context = $(this).closest('.owner-present-address-section');

                context.find('.owner-present-fields').removeClass('d-none');

                if (val == 'city_type') {
                    context.find('.owner-present-city-type').removeClass('d-none');
                    context.find('.owner-present-union-type').addClass('d-none');
                    context.find('.owner-present-pos-type').addClass('d-none');
                } else if (val == 'union_type') {
                    context.find('.owner-present-union-type').removeClass('d-none');
                    context.find('.owner-present-city-type').addClass('d-none');
                    context.find('.owner-present-pos-type').addClass('d-none');
                } else if (val == 'pos_type') {
                    context.find('.owner-present-pos-type').removeClass('d-none');
                    context.find('.owner-present-city-type').addClass('d-none');
                    context.find('.owner-present-union-type').addClass('d-none');
                }
            });

            // Ownership dependencies: Division -> District
            $(document).on('change', '.owner-address-division', function (e) {
                e.preventDefault();
                let div_id = $(this).val();
                let parentBlock = $(this).closest('.owner-perm-fields, .owner-present-fields');
                let dist_id = parentBlock.find('.owner-address-district');
                if (div_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/" + div_id,
                        beforeSend: function () {
                            dist_id.prop("disabled", true);
                        },
                        success: function (response) {
                            dist_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Ownership dependencies: District -> Thana, City Corp, Pourashava
            $(document).on('change', '.owner-address-district', function (e) {
                e.preventDefault();
                let dist_id = $(this).val();
                let parentBlock = $(this).closest('.owner-perm-fields, .owner-present-fields');
                let thana_id = parentBlock.find('.owner-address-thana');
                let city_id = parentBlock.find('.owner-address-city');
                let pos_id = parentBlock.find('.owner-address-pourashava');

                if (dist_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-thanas-by-district') }}/" + dist_id,
                        success: function (response) {
                            thana_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-city-corporation-by-district') }}/" + dist_id,
                        success: function (response) {
                            city_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-pourashava-by-district') }}/" + dist_id,
                        success: function (response) {
                            pos_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Ownership dependencies: Thana -> Post Office & Union
            $(document).on('change', '.owner-address-thana', function (e) {
                e.preventDefault();
                let thana_id = $(this).val();
                let parentBlock = $(this).closest('.owner-perm-fields, .owner-present-fields');
                let po_id = parentBlock.find('.owner-address-post-office');
                let union_id = parentBlock.find('.owner-address-union');

                if (thana_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                        success: function (response) {
                            po_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                        success: function (response) {
                            union_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });

            // Ownership dependencies: Pourashava, Union, City Corp -> Village
            $(document).on('change', '.owner-address-pourashava, .owner-address-union, .owner-address-city', function (e) {
                e.preventDefault();
                let val = $(this).val();
                let type = $(this).data('type');
                let parentBlock = $(this).closest('.owner-perm-fields, .owner-present-fields');
                let village_id = parentBlock.find('.owner-address-village');

                if (val) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-villages-by-type') }}/" + val + '/' + type,
                        success: function (response) {
                            village_id.html(response).prop("disabled", false).trigger('change');
                        }
                    });
                }
            });
        });
    </script>
@endpush