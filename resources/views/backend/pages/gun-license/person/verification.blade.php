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

    .custom-switch-card {
        padding: 12px 20px;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        margin-bottom: 0;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .custom-switch-card:hover {
        border-color: #94a3b8;
    }
</style>
@endpush

@section('title', 'Person Police Verification (Appendix-4)')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Police Verification Form (Appendix-4)</h1>
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
                        <h3 class="card-title">Verification for Application: {{ $application->tracking_no }} ({{ $application->applicant_name }})</h3>
                    </div>
                    <form class="form-horizontal" id="verificationForm" method="POST">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-gavel"></i> Criminal Record Checks</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="has_criminal_record">Has Criminal Record? <span class="text-danger">*</span></label>
                                    <select name="has_criminal_record" class="form-control" id="has_criminal_record" required>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->has_criminal_record ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ isset($application->verification) && $application->verification->has_criminal_record ? 'selected' : '' }}>Yes</option>
                                    </select>
                                    <small class="text-danger error has_criminal_record_error"></small>
                                </div>
                                <div class="col-sm-8">
                                    <label for="criminal_case_details">Criminal Case Details (If Yes)</label>
                                    <input type="text" name="criminal_case_details" class="form-control" id="criminal_case_details" value="{{ $application->verification->criminal_case_details ?? '' }}" placeholder="Enter case details if applicable">
                                    <small class="text-danger error criminal_case_details_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-shield-alt"></i> Security & Practical Checks</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="social_discipline_issue">Social Discipline / Peace Issue? <span class="text-danger">*</span></label>
                                    <select name="social_discipline_issue" class="form-control" id="social_discipline_issue" required>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->social_discipline_issue ? 'selected' : '' }}>No / Satisfactory</option>
                                        <option value="1" {{ isset($application->verification) && $application->verification->social_discipline_issue ? 'selected' : '' }}>Yes / Adverse</option>
                                    </select>
                                    <small class="text-danger error social_discipline_issue_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="practical_knowledge">Practical Knowledge of Weapons? <span class="text-danger">*</span></label>
                                    <select name="practical_knowledge" class="form-control" id="practical_knowledge" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->practical_knowledge ? 'selected' : '' }}>Yes (আছে)</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->practical_knowledge ? 'selected' : '' }}>No (নেই)</option>
                                    </select>
                                    <small class="text-danger error practical_knowledge_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="certificate_verification_status">Certificate Verification Status <span class="text-danger">*</span></label>
                                    <select name="certificate_verification_status" class="form-control" id="certificate_verification_status" required>
                                        <option value="1" {{ isset($application->verification) && $application->verification->certificate_verification_status ? 'selected' : '' }}>Verified / Correct</option>
                                        <option value="0" {{ isset($application->verification) && !$application->verification->certificate_verification_status ? 'selected' : '' }}>Unverified / False</option>
                                    </select>
                                    <small class="text-danger error certificate_verification_status_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="life_threat_justification">Life Threat Justification / Necessity <span class="text-danger">*</span></label>
                                    <textarea name="life_threat_justification" class="form-control" id="life_threat_justification" rows="3" style="height: auto !important;" required placeholder="Describe threat justifications">{{ $application->verification->life_threat_justification ?? '' }}</textarea>
                                    <small class="text-danger error life_threat_justification_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-comments"></i> Police Official Comments</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="adverse_info">Adverse Information (if any)</label>
                                    <textarea name="adverse_info" class="form-control" id="adverse_info" rows="2" style="height: auto !important;" placeholder="Specify any negative factors">{{ $application->verification->adverse_info ?? '' }}</textarea>
                                    <small class="text-danger error adverse_info_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="oc_comments">Officer In-Charge (OC) Comments</label>
                                    <textarea name="oc_comments" class="form-control" id="oc_comments" rows="2" style="height: auto !important;" placeholder="OC report details">{{ $application->verification->oc_comments ?? '' }}</textarea>
                                    <small class="text-danger error oc_comments_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="sp_dsb_comments">SP / DSB Office Comments</label>
                                    <textarea name="sp_dsb_comments" class="form-control" id="sp_dsb_comments" rows="2" style="height: auto !important;" placeholder="SP DSB review and signature notes">{{ $application->verification->sp_dsb_comments ?? '' }}</textarea>
                                    <small class="text-danger error sp_dsb_comments_error"></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Save Verification Details</button>
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
                url: "{{ route('gun-license.person.verification.store', $application->id) }}",
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
