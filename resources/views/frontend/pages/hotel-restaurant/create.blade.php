@extends('frontend.master')
@section('title', 'হোটেল ও রেস্তোরাঁ আবেদন ফরম')

@push('style')

@endpush

@section('content')
    <div class="container py-8">
        <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3">
            <!-- Header -->
            <div class="d-d-flex align-align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3">
                <div
                    class="d-d-flex h-12 w-12 align-align-items-center justify-content-center rounded-full bg-white text-gov-green">
                    <i class="fas fa-utensils text-2xl"></i>
                </div>
                <div>
                    <h4>হোটেল ও রেস্তোরাঁ আবেদন ফরম</h4>
                        <p class="fs-content text-green-100 mt-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস
                            অটোমেশন সিস্টেম</p>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="gov-body">
                    <form id="publicHotelForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Hotel/Restaurant Name -->
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="name">প্রতিষ্ঠানের নাম (English) <span class="text-danger">*</span></label>
                                <input type="text" required name="name" placeholder="Enter Hotel/Restaurant Name"
                                    class="form-control" id="name">
                                <small class="error-text error name_error"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="bn_name">প্রতিষ্ঠানের নাম (বাংলা)</label>
                                <input type="text" name="bn_name" placeholder="হোটেল/রেস্তোরাঁর বাংলা নাম লিখুন"
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

                        <!-- Hotel Details (RJSC, Owners, Capital, Est. Year, Application Type) -->
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
                                    <select name="pos_id" class="form-control select2" id="pourashova_id" data-type="pourashova"
                                        disabled>
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
                                    <select name="office_thana_id" class="form-control select2" id="office_thana_id" disabled>
                                        <option value="">থানা নির্বাচন করুন</option>
                                    </select>
                                    <small class="error-text error office_thana_id_error"></small>
                                </div>
                            </div>

                            <div class="row g-4 mb-3">
                                <!-- City Corporation -->
                                <div class="col-md-4 office_city_type d-none">
                                    <label for="office_city_corporation_id">সিটি কর্পোরেশন</label>
                                    <select name="office_city_id" class="form-control select2" id="office_city_corporation_id"
                                        data-type="City" disabled>
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
                                    <select name="office_post_office_id" class="form-control select2" id="office_post_office_id"
                                        disabled>
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
                                <label>হোটেল/রেস্তোরাঁর লোগো / ছবি:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="hotel_logo" class="form-control" id="hotel_logo">
                                <small class="error-text error hotel_logo_error"></small>
                            </div>
                        </div>

                        <!-- Section: Premises Ownership -->
                        <h5 class="section-title"><i class="fas fa-home"></i> প্রাঙ্গণ মালিকানা বিবরণী (Premises Ownership)</h5>
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
                                <button type="button" class="btn btn-sm btn-outline-success add-doc-row" data-target="owned">
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
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="owned_document_name[]" class="form-control"
                                            value="Environmental Clearance Certificate" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="owned_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="owned_document_name[]" class="form-control"
                                            value="Fire Service Clearance Certificate" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="owned_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="owned_document_name[]" class="form-control"
                                            value="National ID (NID) – Mandatory" readonly>
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
                                <button type="button" class="btn btn-sm btn-outline-success add-doc-row" data-target="rented">
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
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="rented_document_name[]" class="form-control"
                                            value="Environmental Clearance Certificate" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="rented_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="rented_document_name[]" class="form-control"
                                            value="Fire Service Clearance Certificate" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="rented_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                                <div class="row align-align-items-center mb-2 premises-doc-row">
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="text" name="rented_document_name[]" class="form-control"
                                            value="National ID (NID) – Mandatory" readonly>
                                    </div>
                                    <div class="col-md-5 mb-2 mb-md-0">
                                        <input type="file" name="rented_document_file[]" class="form-control">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Buttons -->
                        <div class="d-d-flex justify-content-end gap-3 mt-8 border-t pt-4">
                            <a href="{{ route('home') }}" class="btn btn-gov-cancel">বাতিল করুন</a>
                            <button type="submit" class="btn btn-gov-submit">আবেদন সম্পন্ন করুন</button>
                        </div>
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
            $('#publicHotelForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $('.error').text('');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('frontend.hotel-restaurant.store') }}",
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
                                thisForm.find('.' + key + '_error').text(val[0]);
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
                        url: "{{ url('hotel-subcategory-options') }}/" + cat_id,
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
                    } else {
                        $('.location-type-card:not(.office-location-type-card):not(.premises-ownership-card)').removeClass('active');
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
        });
    </script>
@endpush