@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'OtherOrgGunLicense'])

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

@section('title', 'Other Organization Guard Interview (Appendix-8)')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">সাক্ষাৎকার গ্রহণ: {{ $guard->guard_name }} (NID:
                                {{ $guard->nid_number ?? 'N/A' }})</h3>
                        </div>
                        <form class="form-horizontal" id="interviewForm" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="section-title"><i class="fas fa-university"></i> প্রতিষ্ঠানের তথ্য
                                        </h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>প্রতিষ্ঠানের নাম</label>
                                        <input type="text" class="form-control" value="{{ $application->org_name }}"
                                            readonly style="background-color: #f1f5f9 !important;">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>ট্র্যাকিং নম্বর</label>
                                        <input type="text" class="form-control" value="{{ $application->tracking_no }}"
                                            readonly style="background-color: #f1f5f9 !important;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="section-title"><i class="fas fa-heartbeat"></i> শারীরিক ও দক্ষতা যাচাই</h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="guard_physical_mental_capability">শারীরিক ও মানসিকভাবে উপযুক্ত কিনা <span
                                                class="text-danger">*</span></label>
                                        <select name="guard_physical_mental_capability" class="form-control"
                                            id="guard_physical_mental_capability" required>
                                            <option value="1" {{ isset($interview) && $interview->guard_physical_mental_capability ? 'selected' : '' }}>উপযুক্ত</option>
                                            <option value="0" {{ isset($interview) && !$interview->guard_physical_mental_capability ? 'selected' : '' }}>অনুপযুক্ত</option>
                                        </select>
                                        <small class="text-danger error guard_physical_mental_capability_error"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="guard_weapon_knowledge">অস্ত্র পরিচালনা ও রক্ষণাবেক্ষণের ব্যবহারিক জ্ঞান আছে কিনা
                                            <span class="text-danger">*</span></label>
                                        <select name="guard_weapon_knowledge" class="form-control"
                                            id="guard_weapon_knowledge" required>
                                            <option value="1" {{ isset($interview) && $interview->guard_weapon_knowledge ? 'selected' : '' }}>হ্যাঁ (সন্তোষজনক)</option>
                                            <option value="0" {{ isset($interview) && !$interview->guard_weapon_knowledge ? 'selected' : '' }}>না (অসন্তোষজনক)</option>
                                        </select>
                                        <small class="text-danger error guard_weapon_knowledge_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="guard_behavior_satisfactory">সামাজিক মর্যাদা/সম্মানজনক পেশা/আচরণ <span
                                                class="text-danger">*</span></label>
                                        <select name="guard_behavior_satisfactory" class="form-control"
                                            id="guard_behavior_satisfactory" required>
                                            <option value="1" {{ isset($interview) && $interview->guard_behavior_satisfactory ? 'selected' : '' }}>সন্তোষজনক</option>
                                            <option value="0" {{ isset($interview) && !$interview->guard_behavior_satisfactory ? 'selected' : '' }}>অসন্তোষজনক</option>
                                        </select>
                                        <small class="text-danger error guard_behavior_satisfactory_error"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="safe_custody_capability">অস্ত্রের সেইফ কাস্টডি (Safe Custody) আছে কিনা <span
                                                class="text-danger">*</span></label>
                                        <select name="safe_custody_capability" class="form-control"
                                            id="safe_custody_capability" required>
                                            <option value="1" {{ isset($interview) && $interview->safe_custody_capability ? 'selected' : '' }}>হ্যাঁ (আছে)</option>
                                            <option value="0" {{ isset($interview) && !$interview->safe_custody_capability ? 'selected' : '' }}>না (নেই)</option>
                                        </select>
                                        <small class="text-danger error safe_custody_capability_error"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="section-title"><i class="fas fa-file-signature"></i> চূড়ান্ত মূল্যায়ন</h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="police_report_comments">পুলিশ প্রতিবেদনের সারমর্ম</label>
                                        <textarea name="police_report_comments" class="form-control"
                                            id="police_report_comments" rows="3" style="height: auto !important;"
                                            placeholder="পুলিশ প্রতিবেদনের সারমর্ম">{{ $interview->police_report_comments ?? '' }}</textarea>
                                        <small class="text-danger error police_report_comments_error"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="magistrate_final_comments">সাক্ষাৎকার গ্রহণকারী কর্মকর্তার মন্তব্য/সুপারিশ</label>
                                        <textarea name="magistrate_final_comments" class="form-control"
                                            id="magistrate_final_comments" rows="3" style="height: auto !important;"
                                            placeholder="মন্তব্য/সুপারিশ">{{ $interview->magistrate_final_comments ?? '' }}</textarea>
                                        <small class="text-danger error magistrate_final_comments_error"></small>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info float-right">সাক্ষাৎকার সেভ করুন</button>
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
        $(document).ready(function () {
            $("#interviewForm").on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $(".error").text('');

                $.ajax({
                    type: "POST",
                    url: "{{ route('gun-license.other-org.interview.store', $application->id) }}",
                    data: thisForm.serialize(),
                    dataType: "json",
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.href = response.redirect_url;
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "An error occurred.");

                        if (responseText.errors) {
                            $.each(responseText.errors, function (key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
