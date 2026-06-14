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

@section('title', 'Create Person Gun License')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Person Gun License</h1>
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
                        <h3 class="card-title">Personal Application Form</h3>
                    </div>
                    <form class="form-horizontal" id="personApplicationForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-user"></i> Personal Details</h5>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="applicant_name">Applicant Name <span class="text-danger">*</span></label>
                                    <input type="text" name="applicant_name" class="form-control" id="applicant_name" required placeholder="Enter applicant name">
                                    <small class="text-danger error applicant_name_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="father_name">Father's Name</label>
                                    <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Enter father's name">
                                    <small class="text-danger error father_name_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="mother_name">Mother's Name</label>
                                    <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Enter mother's name">
                                    <small class="text-danger error mother_name_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-map-marker-alt"></i> Address & Contact</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="present_address">Present Address</label>
                                    <textarea name="present_address" class="form-control" id="present_address" rows="3" style="height: auto !important;" placeholder="Enter present address"></textarea>
                                    <small class="text-danger error present_address_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="permanent_address">Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control" id="permanent_address" rows="3" style="height: auto !important;" placeholder="Enter permanent address"></textarea>
                                    <small class="text-danger error permanent_address_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-briefcase"></i> Background Details</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="profession_details">Profession Details</label>
                                    <input type="text" name="profession_details" class="form-control" id="profession_details" placeholder="Profession / Business details">
                                    <small class="text-danger error profession_details_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="annual_income">Annual Income</label>
                                    <input type="text" name="annual_income" class="form-control" id="annual_income" placeholder="Annual income (e.g. 5,00,000)">
                                    <small class="text-danger error annual_income_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="income_source">Income Source</label>
                                    <input type="text" name="income_source" class="form-control" id="income_source" placeholder="Source of income">
                                    <small class="text-danger error income_source_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-crosshairs"></i> Weapon Requirements</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="weapon_details">Gun Type Requested <span class="text-danger">*</span></label>
                                    <select name="weapon_details" class="form-control" id="weapon_details" required>
                                        <option value="">Select Gun Type</option>
                                        <option value="Shotgun">Shotgun (শটগান / দোতালা-একতালা বন্দুক)</option>
                                        <option value="Pistol">Pistol (পিস্তল)</option>
                                        <option value="Revolver">Revolver (রিভলভার)</option>
                                        <option value="Rifle">Rifle (রাইফেল)</option>
                                        <option value="Other">Other (অন্যান্য)</option>
                                    </select>
                                    <small class="text-danger error weapon_details_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label>Gun License Type</label>
                                    <input type="text" class="form-control" value="Person (ব্যক্তিগত)" readonly style="background-color: #e2e8f0 !important;">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right">Submit Application</button>
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
        $("#personApplicationForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $(".error").text(''); // reset errors

            $.ajax({
                type: "POST",
                url: "{{ route('gun-license.person.store') }}",
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
