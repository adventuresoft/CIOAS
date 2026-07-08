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

@section('title', 'Person License Interview (Appendix-5)')
@section('content')
<section class="content">
    <div class="container-fluid">
        <form id="interviewForm" method="POST">
            @csrf
            
            <div class="cioas-form-panel">
                <div class="cioas-form-header">
                    <i class="fas fa-heartbeat" style="color: #0f766e;"></i>
                    <h3 class="cioas-form-title">সাক্ষাৎকার মূল্যায়ন: {{ $application->tracking_no }} ({{ $application->applicant_name }})</h3>
                </div>
                
                <div class="cioas-form-body">
                    
                    <!-- Section 1 -->
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="physical_mental_fitness">৯. আবেদনকারীকে শারীরিক/মানসিকভাবে সুস্থ প্রতীয়মান হয় কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="physical_mental_fitness" class="form-control form-select" id="physical_mental_fitness" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->physical_mental_fitness ? 'selected' : '' }}>হ্যাঁ (উপযুক্ত)</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->physical_mental_fitness ? 'selected' : '' }}>না (অনুপযুক্ত)</option>
                            </select>
                            <small class="text-danger error physical_mental_fitness_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="weapon_handling_knowledge">১০. আবেদনকারীর অস্ত্র পরিচালনা সম্পর্কিত প্রাথমিক জ্ঞান আছে কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="weapon_handling_knowledge" class="form-control form-select" id="weapon_handling_knowledge" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->weapon_handling_knowledge ? 'selected' : '' }}>হ্যাঁ</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->weapon_handling_knowledge ? 'selected' : '' }}>না</option>
                            </select>
                            <small class="text-danger error weapon_handling_knowledge_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="gun_law_knowledge">১১. আবেদনকারীর অস্ত্র আইন ও বিধিমালা সম্পর্কে অবহিত কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="gun_law_knowledge" class="form-control form-select" id="gun_law_knowledge" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->gun_law_knowledge ? 'selected' : '' }}>হ্যাঁ</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->gun_law_knowledge ? 'selected' : '' }}>না</option>
                            </select>
                            <small class="text-danger error gun_law_knowledge_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="safe_custody_capability">১২. আবেদনকারীর আগ্নেয়াস্ত্র নিরাপদ হেফাজতে সংরক্ষণকরার জ্ঞান ও সক্ষমতা আছে কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="safe_custody_capability" class="form-control form-select" id="safe_custody_capability" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->safe_custody_capability ? 'selected' : '' }}>হ্যাঁ</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->safe_custody_capability ? 'selected' : '' }}>না</option>
                            </select>
                            <small class="text-danger error safe_custody_capability_error"></small>
                        </div>
                    </div>
                    
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="safety_necessity_justification">১৩. আবেদনকারীর নিরাপত্তার জন্য আগ্নেয়াস্ত্রের আবশ্যকতা আছে কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="safety_necessity_justification" class="form-control form-select" id="safety_necessity_justification" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->safety_necessity_justification ? 'selected' : '' }}>হ্যাঁ (যুক্তিসঙ্গত)</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->safety_necessity_justification ? 'selected' : '' }}>না (অযুক্তিসঙ্গত)</option>
                            </select>
                            <small class="text-danger error safety_necessity_justification_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="behavior_satisfactory">১৪. আবেদনকারীর আচার-আচরণ সন্তোষজনক কিনা <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <select name="behavior_satisfactory" class="form-control form-select" id="behavior_satisfactory" required>
                                <option value="1" {{ isset($application->interview) && $application->interview->behavior_satisfactory ? 'selected' : '' }}>হ্যাঁ (সন্তোষজনক)</option>
                                <option value="0" {{ isset($application->interview) && !$application->interview->behavior_satisfactory ? 'selected' : '' }}>না (অসন্তোষজনক)</option>
                            </select>
                            <small class="text-danger error behavior_satisfactory_error"></small>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Section 2 -->
                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="police_report_comments">১৫. পুলিশ প্রতিবেদনের সারমর্ম</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="police_report_comments" class="form-control" id="police_report_comments" rows="3" placeholder="পুলিশ প্রতিবেদনের সারমর্ম">{{ isset($application->interview) ? $application->interview->police_report_comments : '' }}</textarea>
                            <small class="text-danger error police_report_comments_error"></small>
                        </div>
                    </div>

                    <div class="row form-row-custom">
                        <div class="col-md-4 pt-2">
                            <label class="form-label-left" for="magistrate_final_comments">১৬. সাক্ষাৎকার গ্রহণকারী কর্মকর্তার মন্তব্য/সুপারিশ</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="magistrate_final_comments" class="form-control" id="magistrate_final_comments" rows="3" placeholder="সাক্ষাৎকার গ্রহণকারী কর্মকর্তার মন্তব্য/সুপারিশ">{{ isset($application->interview) ? $application->interview->magistrate_final_comments : '' }}</textarea>
                            <small class="text-danger error magistrate_final_comments_error"></small>
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
        $("#interviewForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $(".error").text('');

            $.ajax({
                type: "POST",
                url: "{{ route('gun-license.person.interview.store', $application->id) }}",
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