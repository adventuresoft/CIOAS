@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'PersonGunLicense'])

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

@section('title', 'Person License Interview (Appendix-5)')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>District Magistrate Interview (Appendix-5)</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.person.index') }}" class="btn btn-default">Back</a>
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
                        <h3 class="card-title">Interview Assessment: {{ $application->tracking_no }} - {{ $application->applicant_name }}</h3>
                    </div>
                    <form class="form-horizontal" id="interviewForm" method="POST">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-id-card"></i> Demographics & Background</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="age">Verified Age <span class="text-danger">*</span></label>
                                    <input type="number" name="age" class="form-control" id="age" required value="{{ $application->interview->age ?? '' }}" placeholder="Enter applicant age">
                                    <small class="text-danger error age_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="education">Educational Qualification <span class="text-danger">*</span></label>
                                    <input type="text" name="education" class="form-control" id="education" required value="{{ $application->interview->education ?? '' }}" placeholder="e.g. Graduate, HSC">
                                    <small class="text-danger error education_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-heartbeat"></i> Fitness & Knowledge Assessment</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="physical_mental_fitness">Physical & Mental Fitness <span class="text-danger">*</span></label>
                                    <select name="physical_mental_fitness" class="form-control" id="physical_mental_fitness" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->physical_mental_fitness ? 'selected' : '' }}>Fit (উপযুক্ত)</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->physical_mental_fitness ? 'selected' : '' }}>Unfit (অনুপযুক্ত)</option>
                                    </select>
                                    <small class="text-danger error physical_mental_fitness_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="weapon_handling_knowledge">Weapon Handling Knowledge? <span class="text-danger">*</span></label>
                                    <select name="weapon_handling_knowledge" class="form-control" id="weapon_handling_knowledge" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->weapon_handling_knowledge ? 'selected' : '' }}>Yes (আছে)</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->weapon_handling_knowledge ? 'selected' : '' }}>No (নেই)</option>
                                    </select>
                                    <small class="text-danger error weapon_handling_knowledge_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="gun_law_knowledge">Knowledge of Arms/Gun Law? <span class="text-danger">*</span></label>
                                    <select name="gun_law_knowledge" class="form-control" id="gun_law_knowledge" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->gun_law_knowledge ? 'selected' : '' }}>Yes (সন্তোষজনক)</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->gun_law_knowledge ? 'selected' : '' }}>No (অসন্তোষজনক)</option>
                                    </select>
                                    <small class="text-danger error gun_law_knowledge_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="safe_custody_capability">Safe Custody Capability? <span class="text-danger">*</span></label>
                                    <select name="safe_custody_capability" class="form-control" id="safe_custody_capability" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->safe_custody_capability ? 'selected' : '' }}>Yes (আছে)</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->safe_custody_capability ? 'selected' : '' }}>No (নেই)</option>
                                    </select>
                                    <small class="text-danger error safe_custody_capability_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="safety_necessity_justification">Actual Safety Necessity Justified? <span class="text-danger">*</span></label>
                                    <select name="safety_necessity_justification" class="form-control" id="safety_necessity_justification" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->safety_necessity_justification ? 'selected' : '' }}>Justified (যুক্তিসঙ্গত)</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->safety_necessity_justification ? 'selected' : '' }}>Not Justified (অযুক্তিসঙ্গত)</option>
                                    </select>
                                    <small class="text-danger error safety_necessity_justification_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="behavior_satisfactory">General Behavior / Reputation <span class="text-danger">*</span></label>
                                    <select name="behavior_satisfactory" class="form-control" id="behavior_satisfactory" required>
                                        <option value="1" {{ isset($application->interview) && $application->interview->behavior_satisfactory ? 'selected' : '' }}>Good / Satisfactory</option>
                                        <option value="0" {{ isset($application->interview) && !$application->interview->behavior_satisfactory ? 'selected' : '' }}>Adverse / Unsatisfactory</option>
                                    </select>
                                    <small class="text-danger error behavior_satisfactory_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-file-signature"></i> Final Assessment Notes</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="police_report_comments">Summary of Police Verification Report Comments</label>
                                    <textarea name="police_report_comments" class="form-control" id="police_report_comments" rows="3" style="height: auto !important;" placeholder="Summarize police finding comments">{{ $application->interview->police_report_comments ?? '' }}</textarea>
                                    <small class="text-danger error police_report_comments_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="magistrate_final_comments">Magistrate / DC Final Comments & Recommendations</label>
                                    <textarea name="magistrate_final_comments" class="form-control" id="magistrate_final_comments" rows="3" style="height: auto !important;" placeholder="Enter final remarks and recommendations">{{ $application->interview->magistrate_final_comments ?? '' }}</textarea>
                                    <small class="text-danger error magistrate_final_comments_error"></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Save Interview Details</button>
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
