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

@section('title', 'Create Other Organization Gun License')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ব্যাংক/আর্থিক প্রতিষ্ঠানের ক্ষেত্রে আগ্নেয়াস্ত্রের আবেদনপত্র</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.other-org.index') }}" class="btn btn-default">ফিরে যান</a>
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
                                    <label for="org_type">প্রতিষ্ঠানের ধরণ</label>
                                    <input type="text" name="org_type" class="form-control" id="org_type" value="other" readonly>
                                    <small class="text-danger error org_type_error"></small>
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
                                    <h5 class="section-title"><i class="fas fa-users"></i> ব্যবস্থাপনা ও আইনী তথ্যাদি</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="owner_or_ceo_details">প্রতিষ্ঠানের মালিক/নির্বাহী প্রধানের নাম, বর্তমান ঠিকানা ও স্থায়ী ঠিকানা</label>
                                    <textarea name="owner_or_ceo_details" class="form-control" id="owner_or_ceo_details" rows="2" style="height: auto !important;" placeholder="প্রধান নির্বাহীর বিস্তারিত তথ্য"></textarea>
                                    <small class="text-danger error owner_or_ceo_details_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="organogram_manpower_details">প্রতিষ্ঠানের জনবল ও অর্গানোগ্রাম</label>
                                    <textarea name="organogram_manpower_details" class="form-control" id="organogram_manpower_details" rows="2" style="height: auto !important;" placeholder="জনবল এবং অর্গানোগ্রাম এর বিস্তারিত"></textarea>
                                    <small class="text-danger error organogram_manpower_details_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="has_trade_license_mou_aou">ট্রেড লাইসেন্স, মেমোরেন্ডাম অব এসোসিয়েশন ও আর্টিকেল অব এসোসিয়েশন (সংযুক্ত করুন)</label>
                                    <input type="file" name="has_trade_license_mou_aou" class="form-control-file" id="has_trade_license_mou_aou" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-danger error has_trade_license_mou_aou_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="rental_agreement_details">ভাড়া বাড়ির ক্ষেত্রে বাড়ি ভাড়ার চুক্তি পত্র/জমি সংক্রান্ত কাগজপত্র (সংযুক্ত করুন)</label>
                                    <input type="file" name="rental_agreement_details" class="form-control-file" id="rental_agreement_details" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-danger error rental_agreement_details_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-file-invoice-dollar"></i> আয়কর ও আর্থিক তথ্যাদি</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="tin_no">টিআইএন (TIN)</label>
                                    <input type="text" name="tin_no" class="form-control" id="tin_no" placeholder="TIN Number">
                                    <small class="text-danger error tin_no_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="paid_up_capital">বেসরকারি প্রতিষ্ঠানের ক্ষেত্রে পরিশোধিত মূলধনের পরিমাণ (১০ কোটি বা তদূর্ধ্ব)</label>
                                    <input type="text" name="paid_up_capital" class="form-control" id="paid_up_capital" placeholder="পরিশোধিত মূলধনের পরিমাণ">
                                    <small class="text-danger error paid_up_capital_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="tax_history">পূর্ববর্তী ৩ কর বছরের আয়করের বিবরণ</label>
                                    <textarea name="tax_history" class="form-control" id="tax_history" rows="2" style="height: auto !important;" placeholder="আয়করের বিবরণ"></textarea>
                                    <small class="text-danger error tax_history_error"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="section-title"><i class="fas fa-shield-alt"></i> আগ্নেয়াস্ত্র ও নিরাপত্তা</h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="existing_weapons_details">বর্তমানে প্রতিষ্ঠানের নামে কোন আগ্নেয়াস্ত্র আছে কিনা</label>
                                    <textarea name="existing_weapons_details" class="form-control" id="existing_weapons_details" rows="2" style="height: auto !important;" placeholder="আগ্নেয়াস্ত্রের বিবরণ (যদি থাকে)"></textarea>
                                    <small class="text-danger error existing_weapons_details_error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="safe_custody_details">আগ্নেয়াস্ত্র নিরাপদ হেফাজতে সংরক্ষণ করার ব্যবস্থা ও সক্ষমতা আছে কিনা (বিবরণ)</label>
                                    <textarea name="safe_custody_details" class="form-control" id="safe_custody_details" rows="2" style="height: auto !important;" placeholder="নিরাপত্তা ব্যবস্থা"></textarea>
                                    <small class="text-danger error safe_custody_details_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="trained_guard_count">আগ্নেয়াস্ত্র প্রশিক্ষণ প্রাপ্ত নিয়োগকৃত গার্ডের সংখ্যা</label>
                                    <input type="number" name="trained_guard_count" class="form-control" id="trained_guard_count" value="0" min="0">
                                    <small class="text-danger error trained_guard_count_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="police_report_for_guard">গার্ডের অনুকূলে পুলিশ প্রতিবেদন (সংযুক্ত করুন)</label>
                                    <input type="file" name="police_report_for_guard" class="form-control-file" id="police_report_for_guard" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-danger error police_report_for_guard_error"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="guard_cv">গার্ডের জীবন বৃত্তান্ত (সংযুক্ত করুন)</label>
                                    <input type="file" name="guard_cv" class="form-control-file" id="guard_cv" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-danger error guard_cv_error"></small>
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
                url: "{{ route('gun-license.other-org.store') }}",
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
