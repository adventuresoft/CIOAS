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

@section('title', 'পুলিশ ভেরিফিকেশন প্রতিবেদন (পরিশিষ্ট-৭)')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>পুলিশ ভেরিফিকেশন প্রতিবেদন (পরিশিষ্ট-৭)</h1>
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
                        <h3 class="card-title">পুলিশ ভেরিফিকেশন (পরিশিষ্ট-৭)</h3>
                    </div>
                    <form class="form-horizontal" id="verificationForm" method="POST">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-university"></i> আবেদনের যাচাই</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="weapon_necessity_approved">আবেদনকৃত অস্ত্রের আবশ্যকতা আছে কিনা <span class="text-danger">*</span></label>
                                    <select name="weapon_necessity_approved" class="form-control" id="weapon_necessity_approved" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->weapon_necessity_approved ? 'selected' : '' }}>হ্যাঁ (যুক্তিসঙ্গত)</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->weapon_necessity_approved ? 'selected' : '' }}>না (অযুক্তিসঙ্গত)</option>
                                    </select>
                                    <small class="text-danger error weapon_necessity_approved_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="vault_limit_verified">সিন্দুক সীমা কত এবং আবেদনে বর্ণিত পরিমাণ সঠিক কিনা <span class="text-danger">*</span></label>
                                    <select name="vault_limit_verified" class="form-control" id="vault_limit_verified" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->vault_limit_verified ? 'selected' : '' }}>সঠিক</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->vault_limit_verified ? 'selected' : '' }}>সঠিক নয়</option>
                                    </select>
                                    <small class="text-danger error vault_limit_verified_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="certificate_verification_status">মূল আবেদনপত্রের সঙ্গে সংযুক্ত সকল সার্টিফিকেট সঠিক আছে কিনা এ সম্পর্কিত প্রত্যয়নপত্র <span class="text-danger">*</span></label>
                                    <select name="certificate_verification_status" class="form-control" id="certificate_verification_status" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->certificate_verification_status ? 'selected' : '' }}>সঠিক (Verified)</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->certificate_verification_status ? 'selected' : '' }}>সঠিক নয় (Unverified)</option>
                                    </select>
                                    <small class="text-danger error certificate_verification_status_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="existing_weapons_verified">প্রতিষ্ঠানের নামে পূর্বের কোন আগ্নেয়াস্ত্র আছে কিনা (সংখ্যাসহ বিস্তারিত বিবরণ)</label>
                                    <textarea name="existing_weapons_verified" class="form-control" id="existing_weapons_verified" rows="2" style="height: auto !important;" placeholder="বিস্তারিত বিবরণ">{{ $application->verification->existing_weapons_verified ?? '' }}</textarea>
                                    <small class="text-danger error existing_weapons_verified_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-user-shield"></i> নিয়োগকৃত গার্ড সংক্রান্ত তথ্য</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="guard_has_criminal_record">কোন মামলার চার্জশীটভুক্ত আসামী কিনা <span class="text-danger">*</span></label>
                                    <select name="guard_has_criminal_record" class="form-control" id="guard_has_criminal_record" required>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->guard_has_criminal_record ? 'selected' : '' }}>না</option>
                                        <option value="1" {{ isset($application->verification) && $application->verification->guard_has_criminal_record ? 'selected' : '' }}>হ্যাঁ</option>
                                    </select>
                                    <small class="text-danger error guard_has_criminal_record_error"></small>
                                </div>
                                <div class="col-sm-8">
                                    <label for="guard_case_details">কোন মামলায় সাজাপ্রাপ্ত (মেয়াদসহ)/খালাসপ্রাপ্ত কিনা</label>
                                    <input type="text" name="guard_case_details" class="form-control" id="guard_case_details" value="{{ $application->verification->guard_case_details ?? '' }}" placeholder="বিস্তারিত বিবরণ">
                                    <small class="text-danger error guard_case_details_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="guard_social_discipline_issue">অভ্যাসগতভাবে সামাজিক শান্তি-শৃঙ্খলা ভঙ্গের সাথে জড়িত থাকার অভিযোগ আছে কিনা <span class="text-danger">*</span></label>
                                    <select name="guard_social_discipline_issue" class="form-control" id="guard_social_discipline_issue" required>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->guard_social_discipline_issue ? 'selected' : '' }}>না</option>
                                        <option value="1" {{ isset($application->verification) && $application->verification->guard_social_discipline_issue ? 'selected' : '' }}>হ্যাঁ</option>
                                    </select>
                                    <small class="text-danger error guard_social_discipline_issue_error"></small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="guard_existing_license">গার্ডের নামে কোন প্রকার আগ্নেয়াস্ত্রের লাইসেন্স আছে কিনা <span class="text-danger">*</span></label>
                                    <select name="guard_existing_license" class="form-control" id="guard_existing_license" required>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->guard_existing_license ? 'selected' : '' }}>না</option>
                                        <option value="1" {{ isset($application->verification) && $application->verification->guard_existing_license ? 'selected' : '' }}>হ্যাঁ</option>
                                    </select>
                                    <small class="text-danger error guard_existing_license_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="guard_practical_knowledge">অস্ত্র পরিচালনা ও রক্ষণাবেক্ষণের ব্যবহারিক জ্ঞান আছে কিনা <span class="text-danger">*</span></label>
                                    <select name="guard_practical_knowledge" class="form-control" id="guard_practical_knowledge" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->guard_practical_knowledge ? 'selected' : '' }}>হ্যাঁ (আছে)</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->guard_practical_knowledge ? 'selected' : '' }}>না (নেই)</option>
                                    </select>
                                    <small class="text-danger error guard_practical_knowledge_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-comments"></i> মন্তব্য ও স্বাক্ষর</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="adverse_info">বিবিধ (আবেদনকারী প্রতিষ্ঠান/গার্ড সম্পর্কে বিরূপ তথ্য আছে কিনা)</label>
                                    <textarea name="adverse_info" class="form-control" id="adverse_info" rows="2" style="height: auto !important;" placeholder="বিস্তারিত বিবরণ">{{ $application->verification->adverse_info ?? '' }}</textarea>
                                    <small class="text-danger error adverse_info_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="oc_comments">আবেদনকারী প্রতিষ্ঠান ও নিয়োগকৃত গার্ডের সম্পর্কে অফিসার ইনচার্জ এর সার্বিক মন্তব্য ও স্বাক্ষর</label>
                                    <textarea name="oc_comments" class="form-control" id="oc_comments" rows="2" style="height: auto !important;" placeholder="সার্বিক মন্তব্য">{{ $application->verification->oc_comments ?? '' }}</textarea>
                                    <small class="text-danger error oc_comments_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sp_dsb_comments">সংশ্লিষ্ট পুলিশ সুপার, জেলা বিশেষ শাখা এর মন্তব্য ও স্বাক্ষর</label>
                                    <textarea name="sp_dsb_comments" class="form-control" id="sp_dsb_comments" rows="2" style="height: auto !important;" placeholder="মন্তব্য">{{ $application->verification->sp_dsb_comments ?? '' }}</textarea>
                                    <small class="text-danger error sp_dsb_comments_error"></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">ভেরিফিকেশন সেভ করুন</button>
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
        $("#verificationForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $(".error").text('');

            $.ajax({
                type: "POST",
                url: "{{ route('gun-license.org.verification.store', $application->id) }}",
                data: thisForm.serialize(),
                dataType: "json",
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
