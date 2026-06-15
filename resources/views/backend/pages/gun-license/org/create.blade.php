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
                <a href="{{ route('gun-license.org.index') }}" class="btn btn-default">ফিরে যান</a>
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
                                <div class="col-sm-6">
                                    <label for="org_name">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="org_name" class="form-control" id="org_name" required placeholder="প্রতিষ্ঠানের নাম">
                                    <small class="text-danger error org_name_error"></small>
                                </div>
                                <div class="col-sm-6">
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
                                    <label for="vault_limit">প্রতিষ্ঠানের সিন্দুক সীমা</label>
                                    <input type="text" name="vault_limit" class="form-control" id="vault_limit" placeholder="সিন্দুক সীমা">
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
                                    <textarea name="rental_agreement_details" class="form-control" id="rental_agreement_details" rows="2" style="height: auto !important;" placeholder="বাড়ি ভাড়ার চুক্তির বিস্তারিত"></textarea>
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

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="guard_name">গার্ডের নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="guard_name" class="form-control" id="guard_name" required placeholder="গার্ডের নাম">
                                    <small class="text-danger error guard_name_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="guard_father_name">গার্ডের পিতার নাম</label>
                                    <input type="text" name="guard_father_name" class="form-control" id="guard_father_name" placeholder="গার্ডের পিতার নাম">
                                    <small class="text-danger error guard_father_name_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="guard_mother_name">গার্ডের মাতার নাম</label>
                                    <input type="text" name="guard_mother_name" class="form-control" id="guard_mother_name" placeholder="গার্ডের মাতার নাম">
                                    <small class="text-danger error guard_mother_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="guard_present_address">বর্তমান ঠিকানা</label>
                                    <textarea name="guard_present_address" class="form-control" id="guard_present_address" rows="2" style="height: auto !important;" placeholder="গার্ডের বর্তমান ঠিকানা"></textarea>
                                    <small class="text-danger error guard_present_address_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="guard_permanent_address">স্থায়ী ঠিকানা</label>
                                    <textarea name="guard_permanent_address" class="form-control" id="guard_permanent_address" rows="2" style="height: auto !important;" placeholder="গার্ডের স্থায়ী ঠিকানা"></textarea>
                                    <small class="text-danger error guard_permanent_address_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="guard_age">বয়স</label>
                                    <input type="number" name="guard_age" class="form-control" id="guard_age" placeholder="বয়স">
                                    <small class="text-danger error guard_age_error"></small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="guard_education">শিক্ষাগত যোগ্যতা</label>
                                    <input type="text" name="guard_education" class="form-control" id="guard_education" placeholder="যেমন: এসএসসি / এইচএসসি">
                                    <small class="text-danger error guard_education_error"></small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="guard_nid_number">জাতীয় পরিচিতি নম্বর</label>
                                    <input type="text" name="guard_nid_number" class="form-control" id="guard_nid_number" placeholder="NID নম্বর">
                                    <small class="text-danger error guard_nid_number_error"></small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="guard_training_certificate_status">প্রশিক্ষণপ্রাপ্ত কিনা <span class="text-danger">*</span></label>
                                    <select name="guard_training_certificate_status" class="form-control" id="guard_training_certificate_status" required>
                                        <option value="1">হ্যাঁ</option>
                                        <option value="0">না</option>
                                    </select>
                                    <small class="text-danger error guard_training_certificate_status_error"></small>
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
        $("#orgApplicationForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $(".error").text(''); // reset errors

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
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
