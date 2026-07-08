@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'PersonGunLicense'])

@push('style')
<style>
    /* Premium Smart Form Design System matching design_tem/form.png */
    .cioas-form-panel {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .cioas-form-header {
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cioas-form-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #0f766e;
    }
    
    .cioas-form-body {
        padding: 24px;
    }

    .cioas-form-footer {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        padding: 16px 24px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .form-label-left {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
    }

    .form-row-custom {
        margin-bottom: 20px;
        align-items: flex-start;
    }

    .form-control, .form-select {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 8px 12px !important;
        font-size: 14px !important;
        color: #334155 !important;
        box-shadow: none !important;
        transition: all 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0ea5e9 !important;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1) !important;
    }

    .btn-submit {
        background-color: #0f766e;
        color: white;
        font-weight: 600;
        border-radius: 6px;
        padding: 8px 24px;
        border: none;
        transition: all 0.2s;
    }
    
    .btn-submit:hover {
        background-color: #0d6861;
        color: white;
    }

    .btn-cancel {
        color: #475569;
        font-weight: 500;
        text-decoration: none;
        padding: 8px 16px;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        color: #1e293b;
        text-decoration: none;
    }

    .section-divider {
        height: 1px;
        background-color: #e2e8f0;
        margin: 32px 0;
    }
</style>
@endpush

@section('title', 'পুলিশ ভেরিফিকেশন')
@section('content')
<section class="content">
    <div class="container-fluid">
        <form id="verificationForm" method="POST">
            @csrf
            
            <div class="cioas-form-panel">
                <div class="cioas-form-header">
                    <i class="fas fa-gavel" style="color: #0f766e;"></i>
                    <h3 class="cioas-form-title">আবেদনের ভেরিফিকেশন: {{ $application->tracking_no }} ({{ $application->applicant_name }})</h3>
                </div>
                
                <div class="cioas-form-body">
                    
                    <!-- Section 1 -->
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="has_criminal_record">ক) চার্জশিটভুক্ত আসামি বা খ) কোনো মামলায় সাজাপ্রাপ্ত/খালাসপ্রাপ্ত কিনা? <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="has_criminal_record" class="form-control form-select" id="has_criminal_record" required>
                                <option value="0" {{ isset($application->verification) && !$application->verification->has_criminal_record ? 'selected' : '' }}>না</option>
                                <option value="1" {{ isset($application->verification) && $application->verification->has_criminal_record ? 'selected' : '' }}>হ্যাঁ</option>
                            </select>
                            <small class="text-danger error has_criminal_record_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="criminal_case_details">ফৌজদারি মামলার বিবরণ (যদি থাকে)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="criminal_case_details" class="form-control" id="criminal_case_details" value="{{ $application->verification->criminal_case_details ?? '' }}" placeholder="মামলার বিবরণ এবং বর্তমান অবস্থা লিখুন">
                            <small class="text-danger error criminal_case_details_error"></small>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Section 2 -->
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="social_discipline_issue">১০. অভ্যাসবশতভাবে সামাজিক শান্তি শৃঙ্খলা ভঙ্গের সাথে জড়িত কিনা? <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="social_discipline_issue" class="form-control form-select" id="social_discipline_issue" required>
                                <option value="0" {{ isset($application->verification) && !$application->verification->social_discipline_issue ? 'selected' : '' }}>না (সন্তোষজনক)</option>
                                <option value="1" {{ isset($application->verification) && $application->verification->social_discipline_issue ? 'selected' : '' }}>হ্যাঁ (প্রতিকূল)</option>
                            </select>
                            <small class="text-danger error social_discipline_issue_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="practical_knowledge">১১. অস্ত্র পরিচালনা ও রক্ষণাবেক্ষণের ব্যবহারিক জ্ঞান আছে কিনা? <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="practical_knowledge" class="form-control form-select" id="practical_knowledge" required>
                                <option value="1" {{ isset($application->verification) && $application->verification->practical_knowledge ? 'selected' : '' }}>হ্যাঁ (আছে)</option>
                                <option value="0" {{ isset($application->verification) && !$application->verification->practical_knowledge ? 'selected' : '' }}>না (নেই)</option>
                            </select>
                            <small class="text-danger error practical_knowledge_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="certificate_verification_status">১৩. সংযুক্ত সকল সার্টিফিকেটের সঠিকতা যাচাই সংক্রান্ত প্রত্যয়ন <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="certificate_verification_status" class="form-control form-select" id="certificate_verification_status" required>
                                <option value="1" {{ isset($application->verification) && $application->verification->certificate_verification_status ? 'selected' : '' }}>যাচাইকৃত / সঠিক</option>
                                <option value="0" {{ isset($application->verification) && !$application->verification->certificate_verification_status ? 'selected' : '' }}>অযাচাইকৃত / অসত্য</option>
                            </select>
                            <small class="text-danger error certificate_verification_status_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="life_threat_justification">১২. জীবননাশঙ্কা এবং আগ্নেয়াস্ত্রের প্রয়োজনীয়তার বিবরণ <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="life_threat_justification" class="form-control" id="life_threat_justification" rows="3" required placeholder="জীবননাশের আশঙ্কা এবং আগ্নেয়াস্ত্র লাইসেন্সের প্রয়োজনীয়তার বিস্তারিত বিবরণ ও প্রত্যয়ন লিখুন">{{ $application->verification->life_threat_justification ?? '' }}</textarea>
                            <small class="text-danger error life_threat_justification_error"></small>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Section 3 -->
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="adverse_info">১৪. বিবিধ (আবেদনকারী সম্পর্কে বিরূপ তথ্য আছে কিনা)</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="adverse_info" class="form-control" id="adverse_info" rows="2" placeholder="কোনো বিরূপ বা প্রতিকূল তথ্য থাকলে তা এখানে লিখুন">{{ $application->verification->adverse_info ?? '' }}</textarea>
                            <small class="text-danger error adverse_info_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="oc_comments">১৫. অফিসার ইনচার্জ (OC) এর সার্বিক মন্তব্য ও স্বাক্ষর</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="oc_comments" class="form-control" id="oc_comments" rows="2" placeholder="অফিসার ইনচার্জ এর সার্বিক মন্তব্য লিখুন">{{ $application->verification->oc_comments ?? '' }}</textarea>
                            <small class="text-danger error oc_comments_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="sp_dsb_comments">১৬. সংশ্লিষ্ট পুলিশ সুপার, জেলা বিশেষ শাখা (SP / DSB) এর মন্তব্য ও স্বাক্ষর</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="sp_dsb_comments" class="form-control" id="sp_dsb_comments" rows="2" placeholder="পুলিশ সুপার, জেলা বিশেষ শাখা এর মন্তব্য লিখুন">{{ $application->verification->sp_dsb_comments ?? '' }}</textarea>
                            <small class="text-danger error sp_dsb_comments_error"></small>
                        </div>
                    </div>

                </div>
            </div>

            <div class="cioas-form-footer">
                <a href="{{ route('gun-license.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Submit</button>
            </div>

        </form>
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
                url: "{{ route('gun-license.person.verification.store', $application->id) }}",
                data: thisForm.serialize(),
                dataType: "json",
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false).html('Submit');
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.href = response.redirect_url;
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled", false).html('Submit');
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
