@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'OrgGunLicense'])

@push('style')
<style>
    /* Premium Smart Form Design System */
    .card-body label:not(.form-check-label) {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #475569;
        margin-bottom: 8px;
        display: block;
    }

    .card-body .form-control:not(.custom-file-input) {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 40px !important;
        font-size: 0.9rem !important;
        color: #1e293b !important;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }

    .card-body .form-group.row {
        margin-bottom: 28px !important;
    }

    .card-body .form-control:focus:not(.custom-file-input) {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        background-color: #ffffff !important;
    }

    .section-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 8px;
        margin-top: 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #2563eb;
    }
</style>
@endpush

@section('title', 'Create Organization Gun License')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ব্যাংক/আর্থিক প্রতিষ্ঠানের ক্ষেত্রে আগ্নেয়াস্ত্রের আবেদনপত্র</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.index') }}" class="btn btn-default">ফিরে যান</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">আবেদনপত্র (পরিশিষ্ট-৬)</h3>
                    </div>
                    <form class="form-horizontal" id="orgApplicationForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-building"></i> প্রতিষ্ঠানের বিবরণ</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="org_name">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="org_name" class="form-control" id="org_name" required placeholder="প্রতিষ্ঠানের নাম">
                                    <small class="text-danger error org_name_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label>লাইসেন্সের ধরণ</label>
                                    <input type="text" class="form-control" value="ব্যাংক/আর্থিক প্রতিষ্ঠান" readonly style="background-color: #e2e8f0 !important;">
                                </div>
                                <div class="col-sm-4">
                                    <label for="operation_start_date">প্রতিষ্ঠান চালু হবার/কার্যক্রম শুরু করার তারিখ</label>
                                    <input type="date" name="operation_start_date" class="form-control" id="operation_start_date">
                                    <small class="text-danger error operation_start_date_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="org_address">প্রতিষ্ঠানের ঠিকানা</label>
                                    <textarea name="org_address" class="form-control" id="org_address" rows="2" style="height: auto !important;" placeholder="প্রতিষ্ঠানের ঠিকানা"></textarea>
                                    <small class="text-danger error org_address_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="phone">মোবাইল নম্বর <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" id="phone" required placeholder="মোবাইল নম্বর">
                                    <small class="text-danger error phone_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="email">ইমেইল</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="ইমেইল এড্রেস">
                                    <small class="text-danger error email_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-shield-alt"></i> নিরাপত্তা ও কার্যক্রম</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="vault_limit">প্রতিষ্ঠানের সিন্দুক সীমা <span class="text-danger">*</span></label>
                                    <select name="vault_limit" class="form-control" id="vault_limit" required>
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="সর্বোচ্চ ১ কোটি টাকা">সর্বোচ্চ ১ কোটি টাকা</option>
                                        <option value="১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে">১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে</option>
                                        <option value="৫ কোটি টাকার উর্ধ্বে">৫ কোটি টাকার উর্ধ্বে</option>
                                    </select>
                                    <small class="text-danger error vault_limit_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="vehicle_count">প্রতিষ্ঠানের অর্থ পরিবহনের জন্য গাড়ীর সংখ্যা</label>
                                    <input type="number" name="vehicle_count" class="form-control" id="vehicle_count" value="0" min="0">
                                    <small class="text-danger error vehicle_count_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="bangladesh_bank_permission">ব্যাংক শাখা/আর্থিক প্রতিষ্ঠান খোলার জন্য বাংলাদেশ ব্যাংকের অনুমতি পত্র রয়েছে কিনা <span class="text-danger">*</span></label>
                                    <select name="bangladesh_bank_permission" class="form-control" id="bangladesh_bank_permission" required>
                                        <option value="0">না</option>
                                        <option value="1">হ্যাঁ</option>
                                    </select>
                                    <small class="text-danger error bangladesh_bank_permission_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="current_security_description">বর্তমানে কিভাবে নিরাপত্তা রক্ষা করা হচ্ছে</label>
                                    <textarea name="current_security_description" class="form-control" id="current_security_description" rows="2" style="height: auto !important;" placeholder="বর্তমান নিরাপত্তা ব্যবস্থার বিবরণ"></textarea>
                                    <small class="text-danger error current_security_description_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-users"></i> ব্যবস্থাপনা ও আয়কর</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="owner_or_ceo_details">প্রতিষ্ঠানের মালিক/নির্বাহী প্রধানের নাম, বর্তমান ঠিকানা ও স্থায়ী ঠিকানা</label>
                                    <textarea name="owner_or_ceo_details" class="form-control" id="owner_or_ceo_details" rows="2" style="height: auto !important;" placeholder="প্রধান নির্বাহীর বিস্তারিত তথ্য"></textarea>
                                    <small class="text-danger error owner_or_ceo_details_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="organogram_manpower_details">প্রতিষ্ঠানের জনবল/অর্গানোগ্রাম</label>
                                    <textarea name="organogram_manpower_details" class="form-control" id="organogram_manpower_details" rows="2" style="height: auto !important;" placeholder="জনবল এবং অর্গানোগ্রাম এর বিস্তারিত"></textarea>
                                    <small class="text-danger error organogram_manpower_details_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="tax_details">আয়কর সংক্রান্ত তথ্যাদির বিস্তারিত বিবরণ</label>
                                    <textarea name="tax_details" class="form-control" id="tax_details" rows="2" style="height: auto !important;" placeholder="টিআইএন (TIN) ও আয়কর সংক্রান্ত তথ্য"></textarea>
                                    <small class="text-danger error tax_details_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="rental_agreement_details">ভাড়াকৃত বাড়ির ক্ষেত্রে বাড়ি ভাড়ার চুক্তি পত্র</label>
                                    <input type="file" name="rental_agreement_details" class="form-control" id="rental_agreement_details" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="padding: 4px 6px;">
                                    <small class="text-danger error rental_agreement_details_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-crosshairs"></i> আগ্নেয়াস্ত্রের প্রয়োজনীয়তা</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="weapon_count_requested">প্রার্থীত আগ্নেয়াস্ত্রের সংখ্যা</label>
                                    <input type="number" name="weapon_count_requested" class="form-control" id="weapon_count_requested" value="1" min="1">
                                    <small class="text-danger error weapon_count_requested_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="weapon_nature_requested">প্রার্থীত আগ্নেয়াস্ত্রের প্রকৃতি <span class="text-danger">*</span></label>
                                    <select name="weapon_nature_requested" class="form-control" id="weapon_nature_requested" required>
                                        <option value="">সিলেক্ট করুন</option>
                                        <option value="Shotgun">শটগান (Shotgun)</option>
                                        <option value="Pistol">পিস্তল (Pistol)</option>
                                        <option value="Revolver">রিভলভার (Revolver)</option>
                                        <option value="Rifle">রাইফেল (Rifle)</option>
                                        <option value="Long Barrel">লং ব্যারেল (Long Barrel)</option>
                                    </select>
                                    <small class="text-danger error weapon_nature_requested_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="justification_of_necessity">প্রার্থীত আগ্নেয়াস্ত্রের প্রয়োজনীয়তার যৌক্তিকতা</label>
                                    <input type="text" name="justification_of_necessity" class="form-control" id="justification_of_necessity" placeholder="আগ্নেয়াস্ত্রের প্রয়োজনীয়তা">
                                    <small class="text-danger error justification_of_necessity_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="existing_weapons_details">বর্তমানে প্রতিষ্ঠানে যে সকল আগ্নেয়াস্ত্র আছে তার বিবরণ</label>
                                    <textarea name="existing_weapons_details" class="form-control" id="existing_weapons_details" rows="2" style="height: auto !important;" placeholder="পূর্বে নেওয়া আগ্নেয়াস্ত্রের বিবরণ (যদি থাকে)"></textarea>
                                    <small class="text-danger error existing_weapons_details_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-user-shield"></i> গার্ডের জীবন বৃত্তান্ত</h5>
                                </div>
                            </div>

                            <div id="guards_container">
                                <div class="guard-block border p-3 mb-4 rounded bg-light position-relative" data-index="0">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="font-weight-bold text-primary mb-0"><i class="fas fa-user"></i> গার্ড #১</h6>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>গার্ডের নাম <span class="text-danger">*</span></label>
                                            <input type="text" name="guards[0][guard_name]" class="form-control" required placeholder="গার্ডের নাম">
                                            <small class="text-danger error guards_0_guard_name_error"></small>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>গার্ডের পিতার নাম</label>
                                            <input type="text" name="guards[0][guard_father_name]" class="form-control" placeholder="গার্ডের পিতার নাম">
                                            <small class="text-danger error guards_0_guard_father_name_error"></small>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>গার্ডের মাতার নাম</label>
                                            <input type="text" name="guards[0][guard_mother_name]" class="form-control" placeholder="গার্ডের মাতার নাম">
                                            <small class="text-danger error guards_0_guard_mother_name_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>বর্তমান ঠিকানা</label>
                                            <textarea name="guards[0][guard_present_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের বর্তমান ঠিকানা"></textarea>
                                            <small class="text-danger error guards_0_guard_present_address_error"></small>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>স্থায়ী ঠিকানা</label>
                                            <textarea name="guards[0][guard_permanent_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের স্থায়ী ঠিকানা"></textarea>
                                            <small class="text-danger error guards_0_guard_permanent_address_error"></small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label>বয়স</label>
                                            <input type="number" name="guards[0][guard_age]" class="form-control" placeholder="বয়স">
                                            <small class="text-danger error guards_0_guard_age_error"></small>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>শিক্ষাগত যোগ্যতা</label>
                                            <input type="text" name="guards[0][guard_education]" class="form-control" placeholder="যেমন: এসএসসি / এইচএসসি">
                                            <small class="text-danger error guards_0_guard_education_error"></small>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>জাতীয় পরিচিতি নম্বর</label>
                                            <input type="text" name="guards[0][guard_nid_number]" class="form-control" placeholder="NID নম্বর">
                                            <small class="text-danger error guards_0_guard_nid_number_error"></small>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>প্রশিক্ষণপ্রাপ্ত কিনা <span class="text-danger">*</span></label>
                                            <select name="guards[0][guard_training_certificate_status]" class="form-control" required>
                                                <option value="1">হ্যাঁ</option>
                                                <option value="0">না</option>
                                            </select>
                                            <small class="text-danger error guards_0_guard_training_certificate_status_error"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-outline-primary" id="add_more_guard">
                                        <i class="fas fa-plus"></i> আরও গার্ড যুক্ত করুন (Add More)
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">আবেদন জমা দিন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Dynamic weapon count max validation based on vault limit
        function updateWeaponCountMax() {
            let limit = $('#vault_limit').val();
            let weaponInput = $('#weapon_count_requested');
            let maxWeapons = 4; // default maximum
            
            if (limit === 'সর্বোচ্চ ১ কোটি টাকা' || limit === 'up_to_1_crore') {
                maxWeapons = 2;
            } else if (limit === '১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে' || limit === '1_to_5_crore') {
                maxWeapons = 3;
            } else if (limit === '৫ কোটি টাকার উর্ধ্বে' || limit === 'above_5_crore') {
                maxWeapons = 4;
            }
            
            weaponInput.attr('max', maxWeapons);
            
            let val = parseInt(weaponInput.val()) || 0;
            if (val > maxWeapons) {
                weaponInput.val(maxWeapons);
                toastr.warning("এই সিন্দুক সীমার জন্য সর্বোচ্চ " + maxWeapons + " টি আগ্নেয়াস্ত্রের আবেদন করা যাবে।");
            }
        }
        
        $('#vault_limit').on('change', function() {
            updateWeaponCountMax();
        });

        $('#weapon_count_requested').on('input change keyup', function() {
            updateWeaponCountMax();
        });

        // Initialize once
        updateWeaponCountMax();
        
        // Dynamic guards add-more logic
        let guardIndex = 1;
        $('#add_more_guard').on('click', function() {
            let template = `
            <div class="guard-block border p-3 mb-4 rounded bg-light position-relative" data-index="${guardIndex}">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="font-weight-bold text-primary mb-0"><i class="fas fa-user"></i> গার্ড #${guardIndex + 1}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-guard"><i class="fas fa-trash-alt"></i> মুছুন</button>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label>গার্ডের নাম <span class="text-danger">*</span></label>
                        <input type="text" name="guards[${guardIndex}][guard_name]" class="form-control" required placeholder="গার্ডের নাম">
                        <small class="text-danger error guards_${guardIndex}_guard_name_error"></small>
                    </div>
                    <div class="col-sm-4">
                        <label>গার্ডের পিতার নাম</label>
                        <input type="text" name="guards[${guardIndex}][guard_father_name]" class="form-control" placeholder="গার্ডের পিতার নাম">
                        <small class="text-danger error guards_${guardIndex}_guard_father_name_error"></small>
                    </div>
                    <div class="col-sm-4">
                        <label>গার্ডের মাতার নাম</label>
                        <input type="text" name="guards[${guardIndex}][guard_mother_name]" class="form-control" placeholder="গার্ডের মাতার নাম">
                        <small class="text-danger error guards_${guardIndex}_guard_mother_name_error"></small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>বর্তমান ঠিকানা</label>
                        <textarea name="guards[${guardIndex}][guard_present_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের বর্তমান ঠিকানা"></textarea>
                        <small class="text-danger error guards_${guardIndex}_guard_present_address_error"></small>
                    </div>
                    <div class="col-sm-6">
                        <label>স্থায়ী ঠিকানা</label>
                        <textarea name="guards[${guardIndex}][guard_permanent_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের স্থায়ী ঠিকানা"></textarea>
                        <small class="text-danger error guards_${guardIndex}_guard_permanent_address_error"></small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>বয়স</label>
                        <input type="number" name="guards[${guardIndex}][guard_age]" class="form-control" placeholder="বয়স">
                        <small class="text-danger error guards_${guardIndex}_guard_age_error"></small>
                    </div>
                    <div class="col-sm-3">
                        <label>শিক্ষাগত যোগ্যতা</label>
                        <input type="text" name="guards[${guardIndex}][guard_education]" class="form-control" placeholder="যেমন: এসএসসি / এইচএসসি">
                        <small class="text-danger error guards_${guardIndex}_guard_education_error"></small>
                    </div>
                    <div class="col-sm-3">
                        <label>জাতীয় পরিচিতি নম্বর</label>
                        <input type="text" name="guards[${guardIndex}][guard_nid_number]" class="form-control" placeholder="NID নম্বর">
                        <small class="text-danger error guards_${guardIndex}_guard_nid_number_error"></small>
                    </div>
                    <div class="col-sm-3">
                        <label>প্রশিক্ষণপ্রাপ্ত কিনা <span class="text-danger">*</span></label>
                        <select name="guards[${guardIndex}][guard_training_certificate_status]" class="form-control" required>
                            <option value="1">হ্যাঁ</option>
                            <option value="0">না</option>
                        </select>
                        <small class="text-danger error guards_${guardIndex}_guard_training_certificate_status_error"></small>
                    </div>
                </div>
            </div>`;
            
            $('#guards_container').append(template);
            guardIndex++;
        });

        $(document).on('click', '.remove-guard', function() {
            $(this).closest('.guard-block').remove();
            reIndexGuards();
        });

        function reIndexGuards() {
            guardIndex = 0;
            $('#guards_container .guard-block').each(function() {
                let block = $(this);
                block.attr('data-index', guardIndex);
                block.find('h6').html(`<i class="fas fa-user"></i> গার্ড #${guardIndex + 1}`);
                
                block.find('input, select, textarea').each(function() {
                    let input = $(this);
                    let name = input.attr('name');
                    if (name) {
                        let newName = name.replace(/guards\[\d+\]/, `guards[${guardIndex}]`);
                        input.attr('name', newName);
                    }
                });
                
                block.find('.error').each(function() {
                    let errorSpan = $(this);
                    let classList = errorSpan.attr('class').split(' ');
                    let newClassList = classList.map(cls => {
                        if (cls.startsWith('guards_') && cls.endsWith('_error')) {
                            return cls.replace(/guards_\d+_/, `guards_${guardIndex}_`);
                        }
                        return cls;
                    });
                    errorSpan.attr('class', newClassList.join(' '));
                });
                
                guardIndex++;
            });
        }

        $("#orgApplicationForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $(".error").text(''); // reset errors
            $('.form-control').removeClass('is-invalid');

            // Frontend validation for weapon count limit
            let limit = $('#vault_limit').val();
            let weapons = parseInt($('#weapon_count_requested').val()) || 0;
            let maxAllowed = 4;
            
            if (limit === 'সর্বোচ্চ ১ কোটি টাকা' || limit === 'up_to_1_crore') {
                maxAllowed = 2;
            } else if (limit === '১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে' || limit === '1_to_5_crore') {
                maxAllowed = 3;
            } else if (limit === '৫ কোটি টাকার উর্ধ্বে' || limit === 'above_5_crore') {
                maxAllowed = 4;
            }
            
            if (limit && weapons > maxAllowed) {
                toastr.error("সিন্দুক সীমা অনুযায়ী প্রার্থীত আগ্নেয়াস্ত্রের সংখ্যা সর্বোচ্চ " + maxAllowed + " টি হতে পারে।");
                $('#weapon_count_requested').addClass('is-invalid');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('gun-license.org.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.href = response.redirect_url;
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message || "An error occurred.");
                    
                    if (responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            let errorClass = key.replace(/\./g, '_') + "_error";
                            thisForm.find("." + errorClass).text(val[0]);
                            
                            // Highlight invalid fields
                            let fieldName = key.replace(/\.(\d+)\./, '[$1]'); // e.g. guards.0.guard_name -> guards[0][guard_name]
                            if (fieldName.includes('.')) {
                                fieldName = fieldName.split('.').reduce((acc, part, idx) => idx === 0 ? part : acc + '[' + part + ']', '');
                            }
                            thisForm.find('[name="' + fieldName + '"]').addClass('is-invalid');
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
