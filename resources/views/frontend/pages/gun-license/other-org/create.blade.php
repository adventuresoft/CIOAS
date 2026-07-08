@extends('frontend.master')
@section('title', 'প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স আবেদন ফরম')

@push('style')

@endpush

@section('content')
    <div class="theme-form-card">
        <!-- Header -->
        <div class="theme-form-card-header">
            <i class="fas fa-gun text-2xl"></i>
            <h2>প্রতিষ্ঠান আগ্নেয়াস্ত্র লাইসেন্স আবেদন ফরম</h2>
        </div>

        <!-- Form Body -->
        <div class="gov-body">
            <form id="publicOtherOrgGunForm" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- 1. Institution Details -->
                <h5 class="section-title"><i class="fas fa-building"></i> প্রতিষ্ঠানের বিবরণ</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="org_name">প্রতিষ্ঠানের নাম <span class="text-danger">*</span></label>
                        <input type="text" name="org_name" class="form-control" id="org_name" required
                            placeholder="প্রতিষ্ঠানের নাম">
                        <small class="error-text error org_name_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label>লাইসেন্সের ধরণ</label>
                        <input type="text" class="form-control" value="প্রতিষ্ঠান" readonly
                            style="background-color: #f1f5f9 !important;">
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="org_type">প্রতিষ্ঠানের ধরণ</label>
                        <input type="text" name="org_type" class="form-control" id="org_type" value="other" readonly
                            style="background-color: #f1f5f9 !important;">
                        <small class="error-text error org_type_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="operation_start_date">প্রতিষ্ঠান চালু হবার/কার্যক্রম শুরু করার তারিখ</label>
                        <input type="date" name="operation_start_date" class="form-control" id="operation_start_date">
                        <small class="error-text error operation_start_date_error"></small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="org_address">প্রতিষ্ঠানের ঠিকানা</label>
                        <textarea name="org_address" class="form-control" id="org_address" rows="2"
                            style="height: auto !important;" placeholder="প্রতিষ্ঠানের ঠিকানা"></textarea>
                        <small class="error-text error org_address_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="phone">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" id="phone" required placeholder="মোবাইল নম্বর"
                            value="{{ Auth::check() ? Auth::user()->mobile : '' }}" {{ Auth::check() ? 'readonly' : '' }}>
                        <small class="error-text error phone_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="email">ইমেইল</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="ইমেইল এড্রেস">
                        <small class="error-text error email_error"></small>
                    </div>
                </div>

                <!-- 2. Management & Legal info -->
                <h5 class="section-title"><i class="fas fa-users"></i> ব্যবস্থাপনা ও আইনী তথ্যাদি</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="owner_or_ceo_details">মালিক/নির্বাহী প্রধানের নাম, বর্তমান ঠিকানা ও স্থায়ী
                            ঠিকানা</label>
                        <textarea name="owner_or_ceo_details" class="form-control" id="owner_or_ceo_details" rows="2"
                            style="height: auto !important;" placeholder="প্রধান নির্বাহীর বিস্তারিত তথ্য"></textarea>
                        <small class="error-text error owner_or_ceo_details_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="organogram_manpower_details">প্রতিষ্ঠানের জনবল ও অর্গানোগ্রাম</label>
                        <textarea name="organogram_manpower_details" class="form-control" id="organogram_manpower_details"
                            rows="2" style="height: auto !important;"
                            placeholder="জনবল এবং অর্গানোগ্রাম এর বিস্তারিত"></textarea>
                        <small class="error-text error organogram_manpower_details_error"></small>
                    </div>
                </div>

                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="has_trade_license_mou_aou">ট্রেড লাইসেন্স, মেমোরেন্ডাম ও আর্টিকেল অব
                            এসোসিয়েশন</label>
                        <input type="file" name="has_trade_license_mou_aou" class="form-control"
                            id="has_trade_license_mou_aou" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="error-text error has_trade_license_mou_aou_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="rental_agreement_details">বাড়ি ভাড়ার চুক্তি পত্র/জমি সংক্রান্ত কাগজপত্র</label>
                        <input type="file" name="rental_agreement_details" class="form-control"
                            id="rental_agreement_details" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="error-text error rental_agreement_details_error"></small>
                    </div>
                </div>

                <!-- 3. Tax & Financial Info -->
                <h5 class="section-title"><i class="fas fa-file-invoice-dollar"></i> আয়কর ও আর্থিক তথ্যাদি</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-4">
                        <label for="tin_no">টিআইএন (TIN)</label>
                        <input type="text" name="tin_no" class="form-control" id="tin_no" placeholder="TIN Number">
                        <small class="error-text error tin_no_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="paid_up_capital">পরিশোধিত মূলধনের পরিমাণ (১০ কোটি বা তদ্বোর্ধ্ব)</label>
                        <input type="text" name="paid_up_capital" class="form-control" id="paid_up_capital"
                            placeholder="পরিশোধিত মূলধনের পরিমাণ">
                        <small class="error-text error paid_up_capital_error"></small>
                    </div>
                    <div class="col-md-4">
                        <label for="tax_history">পূর্ববর্তী ৩ কর বছরের আয়করের বিবরণ</label>
                        <textarea name="tax_history" class="form-control" id="tax_history" rows="2"
                            style="height: auto !important;" placeholder="আয়করের বিবরণ"></textarea>
                        <small class="error-text error tax_history_error"></small>
                    </div>
                </div>

                <!-- 4. Weapon details -->
                <h5 class="section-title"><i class="fas fa-shield-alt"></i> আগ্নেয়াস্ত্র ও নিরাপত্তা</h5>
                <div class="row g-4 mb-3">
                    <div class="col-md-6">
                        <label for="existing_weapons_details">বর্তমানে প্রতিষ্ঠানের নামে কোন আগ্নেয়াস্ত্র আছে
                            কিনা</label>
                        <textarea name="existing_weapons_details" class="form-control" id="existing_weapons_details"
                            rows="2" style="height: auto !important;"
                            placeholder="আগ্নেয়াস্ত্রের বিবরণ (যদি থাকে)"></textarea>
                        <small class="error-text error existing_weapons_details_error"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="safe_custody_details">নিরাপদ হেফাজতে সংরক্ষণ করার ব্যবস্থা ও সক্ষমতা (বিবরণ)</label>
                        <textarea name="safe_custody_details" class="form-control" id="safe_custody_details" rows="2"
                            style="height: auto !important;" placeholder="নিরাপত্তা ব্যবস্থা"></textarea>
                        <small class="error-text error safe_custody_details_error"></small>
                    </div>
                </div>

                <!-- 5. Guard Info -->
                <h5 class="section-title"><i class="fas fa-user-shield"></i> গার্ডের বিবরণ ও জীবন বৃত্তান্ত</h5>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="trained_guard_count">আগ্নেয়াস্ত্র প্রশিক্ষণ প্রাপ্ত নিয়োগকৃত গার্ডের সংখ্যা</label>
                        <input type="number" name="trained_guard_count" class="form-control" id="trained_guard_count"
                            value="0" min="0">
                        <small class="error-text error trained_guard_count_error"></small>
                    </div>
                </div>

                <div id="guards_container">
                    <div class="guard-d-block border p-3 mb-3 rounded bg-light position-relative" data-index="0">
                        <div class="d-flex justify-content-between align-align-items-center mb-3">
                            <h6 class="font-weight-bold text-success mb-0"><i class="fas fa-user"></i> গার্ড #১</h6>
                        </div>

                        <div class="row g-4 mb-3">
                            <div class="col-md-4">
                                <label>গার্ডের নাম <span class="text-danger">*</span></label>
                                <input type="text" name="guards[0][guard_name]" class="form-control" required
                                    placeholder="গার্ডের নাম">
                                <small class="error-text error guards_0_guard_name_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label>গার্ডের পিতার নাম</label>
                                <input type="text" name="guards[0][guard_father_name]" class="form-control"
                                    placeholder="গার্ডের পিতার নাম">
                                <small class="error-text error guards_0_guard_father_name_error"></small>
                            </div>
                            <div class="col-md-4">
                                <label>গার্ডের মাতার নাম</label>
                                <input type="text" name="guards[0][guard_mother_name]" class="form-control"
                                    placeholder="গার্ডের মাতার নাম">
                                <small class="error-text error guards_0_guard_mother_name_error"></small>
                            </div>
                        </div>

                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label>বর্তমান ঠিকানা</label>
                                <textarea name="guards[0][guard_present_address]" class="form-control" rows="2"
                                    style="height: auto !important;" placeholder="গার্ডের বর্তমান ঠিকানা"></textarea>
                                <small class="error-text error guards_0_guard_present_address_error"></small>
                            </div>
                            <div class="col-md-6">
                                <label>স্থায়ী ঠিকানা</label>
                                <textarea name="guards[0][guard_permanent_address]" class="form-control" rows="2"
                                    style="height: auto !important;" placeholder="গার্ডের স্থায়ী ঠিকানা"></textarea>
                                <small class="error-text error guards_0_guard_permanent_address_error"></small>
                            </div>
                        </div>

                        <div class="row g-4 mb-3">
                            <div class="col-md-3">
                                <label>বয়স</label>
                                <input type="number" name="guards[0][guard_age]" class="form-control" placeholder="বয়স">
                                <small class="error-text error guards_0_guard_age_error"></small>
                            </div>
                            <div class="col-md-3">
                                <label>শিক্ষাগত যোগ্যতা</label>
                                <input type="text" name="guards[0][guard_education]" class="form-control"
                                    placeholder="যেমন: এসএসসি / এইচএসসি">
                                <small class="error-text error guards_0_guard_education_error"></small>
                            </div>
                            <div class="col-md-3">
                                <label>জাতীয় পরিচিতি নম্বর</label>
                                <input type="text" name="guards[0][guard_nid_number]" class="form-control"
                                    placeholder="NID নম্বর">
                                <small class="error-text error guards_0_guard_nid_number_error"></small>
                            </div>
                            <div class="col-md-3">
                                <label>প্রশিক্ষণপ্রাপ্ত কিনা <span class="text-danger">*</span></label>
                                <select name="guards[0][guard_training_certificate_status]" class="form-control" required>
                                    <option value="1">হ্যাঁ</option>
                                    <option value="0">না</option>
                                </select>
                                <small class="error-text error guards_0_guard_training_certificate_status_error"></small>
                            </div>
                        </div>

                        <div class="row align-align-items-center mt-2">
                            <div class="col-md-4">
                                <label>গার্ডের পুলিশ প্রতিবেদন:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="guards[0][police_report_for_guard]" class="form-control"
                                    accept=".pdf,.jpg,.jpeg,.png">
                                <small class="error-text error guards_0_police_report_for_guard_error"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-outline-success" id="add_more_guard">
                            <i class="fas fa-plus mr-1"></i> আরও গার্ড যুক্ত করুন (Add More)
                        </button>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-8 border-t pt-4">
                    <a href="{{ route('frontend.gun-license.select') }}" class="btn btn-gov-cancel">বাতিল করুন</a>
                    <button type="submit" class="btn btn-gov-submit">আবেদন সম্পন্ন করুন</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Dynamic guards add-more logic
            let guardIndex = 1;
            $('#add_more_guard').on('click', function () {
                let template = `
                                                <div class="guard-d-block border p-3 mb-3 rounded bg-light position-relative" data-index="${guardIndex}">
                                                    <div class="d-flex justify-content-between align-align-items-center mb-3">
                                                        <h6 class="font-weight-bold text-success mb-0"><i class="fas fa-user"></i> গার্ড #${guardIndex + 1}</h6>
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-guard"><i class="fas fa-trash-alt"></i> মুছুন</button>
                                                    </div>

                                                    <div class="row g-4 mb-3">
                                                        <div class="col-md-4">
                                                            <label>গার্ডের নাম <span class="text-danger">*</span></label>
                                                            <input type="text" name="guards[${guardIndex}][guard_name]" class="form-control" required placeholder="গার্ডের নাম">
                                                            <small class="error-text error guards_${guardIndex}_guard_name_error"></small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>গার্ডের পিতার নাম</label>
                                                            <input type="text" name="guards[${guardIndex}][guard_father_name]" class="form-control" placeholder="গার্ডের পিতার নাম">
                                                            <small class="error-text error guards_${guardIndex}_guard_father_name_error"></small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>গার্ডের মাতার নাম</label>
                                                            <input type="text" name="guards[${guardIndex}][guard_mother_name]" class="form-control" placeholder="গার্ডের মাতার নাম">
                                                            <small class="error-text error guards_${guardIndex}_guard_mother_name_error"></small>
                                                        </div>
                                                    </div>

                                                    <div class="row g-4 mb-3">
                                                        <div class="col-md-6">
                                                            <label>বর্তমান ঠিকানা</label>
                                                            <textarea name="guards[${guardIndex}][guard_present_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের বর্তমান ঠিকানা"></textarea>
                                                            <small class="error-text error guards_${guardIndex}_guard_present_address_error"></small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>স্থায়ী ঠিকানা</label>
                                                            <textarea name="guards[${guardIndex}][guard_permanent_address]" class="form-control" rows="2" style="height: auto !important;" placeholder="গার্ডের স্থায়ী ঠিকানা"></textarea>
                                                            <small class="error-text error guards_${guardIndex}_guard_permanent_address_error"></small>
                                                        </div>
                                                    </div>

                                                    <div class="row g-4 mb-3">
                                                        <div class="col-md-3">
                                                            <label>বয়স</label>
                                                            <input type="number" name="guards[${guardIndex}][guard_age]" class="form-control" placeholder="বয়স">
                                                            <small class="error-text error guards_${guardIndex}_guard_age_error"></small>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>শিক্ষাগত যোগ্যতা</label>
                                                            <input type="text" name="guards[${guardIndex}][guard_education]" class="form-control" placeholder="যেমন: এসএসসি / এইচএসসি">
                                                            <small class="error-text error guards_${guardIndex}_guard_education_error"></small>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>জাতীয় পরিচিতি নম্বর</label>
                                                            <input type="text" name="guards[${guardIndex}][guard_nid_number]" class="form-control" placeholder="NID নম্বর">
                                                            <small class="error-text error guards_${guardIndex}_guard_nid_number_error"></small>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>প্রশিক্ষণপ্রাপ্ত কিনা <span class="text-danger">*</span></label>
                                                            <select name="guards[${guardIndex}][guard_training_certificate_status]" class="form-control" required>
                                                                <option value="1">হ্যাঁ</option>
                                                                <option value="0">না</option>
                                                            </select>
                                                            <small class="error-text error guards_${guardIndex}_guard_training_certificate_status_error"></small>
                                                        </div>
                                                    </div>

                                                    <div class="row align-align-items-center mt-2">
                                                        <div class="col-md-4">
                                                            <label>গার্ডের police প্রতিবেদন:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="file" name="guards[${guardIndex}][police_report_for_guard]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                                            <small class="error-text error guards_${guardIndex}_police_report_for_guard_error"></small>
                                                        </div>
                                                    </div>
                                                </div>`;

                $('#guards_container').append(template);
                guardIndex++;
            });

            $(document).on('click', '.remove-guard', function () {
                $(this).closest('.guard-d-block').remove();
                reIndexGuards();
            });

            function reIndexGuards() {
                guardIndex = 0;
                $('#guards_container .guard-d-block').each(function () {
                    let dd_block = $(this);
                    dd_block.attr('data-index', guardIndex);
                    dd_block.find('h6').html(`<i class="fas fa-user"></i> গার্ড #${guardIndex + 1}`);

                    dd_block.find('input, select, textarea').each(function () {
                        let input = $(this);
                        let name = input.attr('name');
                        if (name) {
                            let newName = name.replace(/guards\[\d+\]/, `guards[${guardIndex}]`);
                            input.attr('name', newName);
                        }
                    });

                    dd_block.find('.error-text').each(function () {
                        let errorSpan = $(this);
                        let classList = errorSpan.attr('class').split(' ');
                        let newClassList = classList.map(cls => {
                            if (cls.startsWith('guards_') && cls.endsWith('_error')) {
                                return cls.replace(/guards_\d+_\w+_error/, function (match) {
                                    return match.replace(/guards_\d+_/, `guards_${guardIndex}_`);
                                });
                            }
                            return cls;
                        });
                        errorSpan.attr('class', newClassList.join(' '));
                    });

                    guardIndex++;
                });
            }

            // Submit Action
            $('#publicOtherOrgGunForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $('.error-text').text('');
                $('.form-control').removeClass('is-invalid');

                $.ajax({
                    type: "POST",
                    url: "{{ route('frontend.gun-license.other-org.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop("disabled", true).text('প্রক্রিয়াধীন...');
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.href = response.redirect_url;
                        }, 1000);
                    },
                    error: function (xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false).text('আবেদন সম্পন্ন করুন');
                        if (xhr.status === 400) {
                            let responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message || "ভুল এন্ট্রি রয়েছে।");
                            if (responseText.errors) {
                                $.each(responseText.errors, function (key, val) {
                                    let errorClass = key.replace(/\./g, '_') + "_error";
                                    thisForm.find("." + errorClass).text(val[0]);

                                    let fieldName = key.replace(/\.(\d+)\./, '[$1]');
                                    if (fieldName.includes('.')) {
                                        fieldName = fieldName.split('.').reduce((acc, part, idx) => idx === 0 ? part : acc + '[' + part + ']', '');
                                    }
                                    thisForm.find('[name="' + fieldName + '"]').addClass('is-invalid');
                                });
                            }
                        } else {
                            toastr.error('দুঃখিত, আবেদন প্রক্রিয়াকরণে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
                        }
                    }
                });
            });

            // Update filename labels in file inputs
            $(document).on('change', '.custom-file-input', function (e) {
                var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file...";
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
@endpush