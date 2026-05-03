@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleCreate'])
@push('style')
<style>
    .vehicle-info-layout {
        margin-bottom: 10px;
    }

    .vehicle-info-panel {
        background: #f8fbff;
        border: 1px solid #d8e7ff;
        border-radius: 10px;
        padding: 16px 16px 10px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        height: 100%;
    }

    .primary-info-panel {
        background: #ffffff;
        border-color: #c8dcff;
    }

    .vehicle-info-panel-title {
        font-size: 15px;
        font-weight: 600;
        color: #0f5ba7;
        margin-bottom: 14px;
    }

    .vehicle-info-panel label {
        font-weight: 600;
        color: #2f3a4b;
        margin-bottom: 6px;
    }

    .vehicle-info-panel .form-control {
        border-radius: 8px;
    }

    .vehicle-info-panel .select2-container {
        width: 100% !important;
    }

    @media (max-width: 991.98px) {
        .vehicle-info-panel {
            margin-bottom: 12px;
        }
    }
</style>
@endpush
@section('title', 'Vehicle Create')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vehicle Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle</a></li> 
                    <li class="breadcrumb-item active">Create</li>
                </ol>
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
                        <h3 class="card-title">Vehicle Create Info</h3>
                    </div>

                    <form class="form-horizontal" id="vehicleForm" method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <h5 class="text-info mb-3">Vehicle Info</h5>

                            <div class="vehicle-info-layout">
                                <div class="row">
                                    <div class="col-lg-6 order-2 order-lg-2">
                                        <div class="vehicle-info-panel">
                                            <h6 class="vehicle-info-panel-title">Technical Specifications</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="engine_number">Engine Number - ইঞ্জিন নম্বর</label>
                                                        <input type="text" name="engine_number" class="form-control" id="engine_number" placeholder="Enter Engine Number">
                                                        <span class="error engine_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chassis_number">Chassis Number - চ্যাসিস নম্বর</label>
                                                        <input type="text" name="chassis_number" class="form-control" id="chassis_number" placeholder="Enter Chassis Number">
                                                        <span class="error chassis_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tyre_number">Tyre Number - টায়ারের নম্বর</label>
                                                        <input type="text" name="tyre_number" class="form-control" id="tyre_number" placeholder="Enter Tyre Number">
                                                        <span class="error tyre_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="hp_cc">HP/CC - হর্সপাওয়ার / সিসি (ইঞ্জিন ক্ষমতা)</label>
                                                        <input type="text" name="hp_cc" class="form-control" id="hp_cc" placeholder="Enter HP/CC">
                                                        <span class="error hp_cc-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="seat_capacity">Seat Capacity - আসন সংখ্যা</label>
                                                        <input type="text" name="seat_capacity" class="form-control" id="seat_capacity" placeholder="Enter Seat Capacity">
                                                        <span class="error seat_capacity-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="height">Height - উচ্চতা</label>
                                                        <input type="text" name="height" class="form-control" id="height" placeholder="Enter Height">
                                                        <span class="error height-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="width">Width - প্রস্থ</label>
                                                        <input type="text" name="width" class="form-control" id="width" placeholder="Enter Width">
                                                        <span class="error width-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tyre_size">Tyre Size - টায়ারের সাইজ</label>
                                                        <input type="text" name="tyre_size" class="form-control" id="tyre_size" placeholder="Enter Tyre Size">
                                                        <span class="error tyre_size-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="color">Color - রং</label>
                                                        <input type="text" name="color" class="form-control" id="color" placeholder="Enter Color">
                                                        <span class="error color-error text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-1 order-lg-1">
                                        <div class="vehicle-info-panel primary-info-panel">
                                            <h6 class="vehicle-info-panel-title">Primary Vehicle Details</h6>

                                            <div class="form-group">
                                                <label for="vehicle_type">Vehicle Type</label>
                                                <select required class="form-control select2" name="vehicle_type" id="vehicle_type">
                                                    <option value="">Select Vehicle Type</option>
                                                </select>
                                                <span class="error vehicle_type-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="vehicle_category">Vehicle Category</label>
                                                <select required class="form-control select2" name="vehicle_category" id="vehicle_category">
                                                    <option value="">Select Vehicle Category</option>
                                                </select>
                                                <span class="error vehicle_category-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="vehicle_model">Vehicle Model</label>
                                                <input type="text" required class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Enter Vehicle Model">
                                                <span class="error vehicle_model-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="make_year">Make Year</label>
                                                <input type="number" required class="form-control" name="make_year" id="make_year" placeholder="Enter Year (e.g. 2024)" min="1900" max="2099">
                                                <span class="error make_year-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="make_company">Make Company</label>
                                                <input type="text" required class="form-control" name="make_company" id="make_company" placeholder="Enter Company Name">
                                                <span class="error make_company-error text-danger"></span>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" placeholder="Price" class="form-control" id="price">
                                                <span class="error price-error text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-info mb-3">Owner Info</h5>

                            <div class="form-group row">
                                <label for="ownership_type" class="col-sm-2 col-form-label">Ownership Type</label>
                                <div class="col-sm-9">
                                    <select required class="form-control select2" name="ownership_type" id="ownership_type">
                                        <option value="">Select Ownership Type</option>
                                        <option value="personal">Personal</option>
                                        <option value="institutional">Institutional</option>
                                    </select>
                                    <span class="error ownership_type-error text-danger"></span>
                                </div>
                            </div>

                            <div id="personal-owner-field" class="d-none">
                                <div class="form-group row">
                                    <label for="owner_id" class="col-sm-2 col-form-label">Owner ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="owner_id" placeholder="Owner ID (User ID / System ID)" class="form-control" id="owner_id">
                                        <small class="text-muted">Personal ownership-এর ক্ষেত্রে এই ID থেকে user details দেখানো হবে view page-এ।</small>
                                        <span class="error owner_id-error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="institutional-fields" class="d-none">
                                <div class="form-group row">
                                    <label for="institutional_name" class="col-sm-2 col-form-label">Institutional Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="institutional_name" class="form-control" id="institutional_name" placeholder="Institutional Name">
                                        <span class="error institutional_name-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="trade_license" class="col-sm-2 col-form-label">Trade License</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="trade_license" class="form-control" id="trade_license" placeholder="Trade License">
                                        <span class="error trade_license-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="institutional_address" class="col-sm-2 col-form-label">Institutional Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="institutional_address" class="form-control" id="institutional_address" rows="3" placeholder="Institutional Address"></textarea>
                                        <span class="error institutional_address-error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group row">
                                <a href="{{ route('vehicle.index') }}" class="btn btn-default float-right">Cancel</a>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
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
    $(".select2").select2();

    const vehicleData = {
        "Auto": [
            "Rickshaw - রিকশা",
            "Van - ভ্যান / ভ্যানগাড়ি"
        ],
        "Manual": [
            "Rickshaw - রিকশা",
            "Van - ভ্যান / ভ্যানগাড়ি",
            "Thela Gari - ঠেলাগাড়ি",
            "Gorur Gari - গরুর গাড়ি"
        ]
    };

    const $type = $("#vehicle_type");
    const $category = $("#vehicle_category");
    const $ownershipType = $("#ownership_type");

    function populateSelect(select, items, placeholder) {
        select.empty();
        select.append(new Option(placeholder, ""));

        items.forEach(function (item) {
            select.append(new Option(item, item));
        });

        select.trigger("change");
    }

    function toggleOwnershipFields() {
        const isPersonal = $ownershipType.val() === "personal";
        const isInstitutional = $ownershipType.val() === "institutional";
        const personalField = $("#owner_id");
        const institutionalFields = $("#institutional_name, #trade_license, #institutional_address");

        $("#personal-owner-field").toggleClass("d-none", !isPersonal);
        personalField.prop("required", isPersonal);

        $("#institutional-fields").toggleClass("d-none", !isInstitutional);
        institutionalFields.prop("required", isInstitutional);

        if (!isPersonal) {
            personalField.val("");
        }

        if (!isInstitutional) {
            institutionalFields.val("");
        }
    }

    populateSelect($type, Object.keys(vehicleData), "Select Vehicle Type");
    populateSelect($category, [], "Select Vehicle Category");

    $type.on("change", function () {
        const selectedType = $(this).val();
        const categories = selectedType ? vehicleData[selectedType] : [];
        populateSelect($category, categories, "Select Vehicle Category");
    });

    $ownershipType.on("change", toggleOwnershipFields);
    toggleOwnershipFields();

    $("#vehicleForm").on("submit", function (e) {
        e.preventDefault();

        const thisForm = $(this);
        const submitBtn = thisForm.find('button[type="submit"]');

        $.ajax({
            type: "POST",
            url: "{{ route('vehicle.store') }}",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,

            beforeSend: function () {
                submitBtn.prop("disabled", true);
                $(".error").text("");
            },

            success: function (response) {
                submitBtn.prop("disabled", false);
                toastr.success(response.message);

                setTimeout(function () {
                    window.location.href = response.redirect_url;
                }, 1500);
            },

            error: function (xhr) {
                submitBtn.prop("disabled", false);
                const response = xhr.responseJSON || {};
                toastr.error(response.message || "Something went wrong! Please try again...");

                if (response.errors) {
                    $.each(response.errors, function (key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            }
        });
    });
});
</script>
@endpush
