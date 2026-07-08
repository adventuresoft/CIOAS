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
<section class="content cioas-page pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="cioas-shell">
                    <form class="form-horizontal" id="vehicleForm" method="POST" action="{{ route('vehicle.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Primary Vehicle Details -->
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-car"></i> Primary Vehicle Details</h3>
                            </div>
                            <div class="cioas-panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="registration_no">Registration No</label>
                                            <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="Enter Registration No">
                                            <span class="error registration_no-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vehicle_type">Vehicle Type</label>
                                            <select required class="form-control select2" name="vehicle_type" id="vehicle_type">
                                                <option value="">Select Vehicle Type</option>
                                            </select>
                                            <span class="error vehicle_type-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vehicle_category">Vehicle Category</label>
                                            <select required class="form-control select2" name="vehicle_category" id="vehicle_category">
                                                <option value="">Select Vehicle Category</option>
                                            </select>
                                            <span class="error vehicle_category-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vehicle_model">Vehicle Model</label>
                                            <input type="text" required class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Enter Vehicle Model">
                                            <span class="error vehicle_model-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="make_year">Make Year</label>
                                            <input type="number" required class="form-control" name="make_year" id="make_year" placeholder="Enter Year (e.g. 2024)" min="1900" max="2099">
                                            <span class="error make_year-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="make_company">Make Company</label>
                                            <input type="text" required class="form-control" name="make_company" id="make_company" placeholder="Enter Company Name">
                                            <span class="error make_company-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" placeholder="Price" class="form-control" id="price">
                                            <span class="error price-error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Specifications -->
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-cogs"></i> Technical Specifications</h3>
                            </div>
                            <div class="cioas-panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="engine_number">Engine Number - ইঞ্জিন নম্বর</label>
                                            <input type="text" name="engine_number" class="form-control" id="engine_number" placeholder="Enter Engine Number">
                                            <span class="error engine_number-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="chassis_number">Chassis Number - চ্যাসিস নম্বর</label>
                                            <input type="text" name="chassis_number" class="form-control" id="chassis_number" placeholder="Enter Chassis Number">
                                            <span class="error chassis_number-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tyre_number">Tyre Number - টায়ারের নম্বর</label>
                                            <input type="text" name="tyre_number" class="form-control" id="tyre_number" placeholder="Enter Tyre Number">
                                            <span class="error tyre_number-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hp_cc">HP/CC - হর্সপাওয়ার / সিসি</label>
                                            <input type="text" name="hp_cc" class="form-control" id="hp_cc" placeholder="Enter HP/CC">
                                            <span class="error hp_cc-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seat_capacity">Seat Capacity - আসন সংখ্যা</label>
                                            <input type="text" name="seat_capacity" class="form-control" id="seat_capacity" placeholder="Enter Seat Capacity">
                                            <span class="error seat_capacity-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="height">Height - উচ্চতা</label>
                                            <input type="text" name="height" class="form-control" id="height" placeholder="Enter Height">
                                            <span class="error height-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="width">Width - প্রস্থ</label>
                                            <input type="text" name="width" class="form-control" id="width" placeholder="Enter Width">
                                            <span class="error width-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tyre_size">Tyre Size - টায়ারের সাইজ</label>
                                            <input type="text" name="tyre_size" class="form-control" id="tyre_size" placeholder="Enter Tyre Size">
                                            <span class="error tyre_size-error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="color">Color - রং</label>
                                            <input type="text" name="color" class="form-control" id="color" placeholder="Enter Color">
                                            <span class="error color-error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Owner Info -->
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-user-tie"></i> Owner Info</h3>
                            </div>
                            <div class="cioas-panel-body">
                                <div class="form-group row">
                                    <label for="ownership_type" class="col-sm-2 col-form-label">Ownership Type</label>
                                    <div class="col-sm-6">
                                        <select required class="form-control select2" name="ownership_type" id="ownership_type">
                                            <option value="">Select Ownership Type</option>
                                            <option value="own">Own</option>
                                            <option value="rental">Rental</option>
                                        </select>
                                        <span class="error ownership_type-error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificates & Attachments -->
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-file-contract"></i> Certificates & Attachments</h3>
                            </div>
                            <div class="cioas-panel-body">
                                <div class="row">
                                    <!-- RC -->
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="font-weight-bold text-primary mb-3">RC (Registration Certificate)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                <input type="file" class="form-control" name="rc_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" class="form-control" name="rc_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" class="form-control" name="rc_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RP -->
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="font-weight-bold text-primary mb-3">RP (Road Permit)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                <input type="file" class="form-control" name="rp_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" class="form-control" name="rp_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" class="form-control" name="rp_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TT -->
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="font-weight-bold text-primary mb-3">TT (Tax Token)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                <input type="file" class="form-control" name="tt_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" class="form-control" name="tt_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" class="form-control" name="tt_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- IN -->
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="font-weight-bold text-primary mb-3">IN (Insurance)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                <input type="file" class="form-control" name="in_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" class="form-control" name="in_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" class="form-control" name="in_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Assign Driver -->
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-id-card"></i> Assign Driver</h3>
                            </div>
                            <div class="cioas-panel-body">
                                <div class="form-group">
                                    <label for="driver_registration_no">Registration Number (Driver ID/Staff ID/System ID)</label>
                                    <input type="text" name="driver_registration_no" value="{{ old('driver_registration_no') }}" class="form-control" id="driver_registration_no" placeholder="Enter Registration Number">
                                    <div id="driver_info_display" class="mt-2 text-primary" style="display: none; font-weight: 500;">
                                        <i class="fas fa-user-check"></i> Driver Found: <span id="driver_name_display"></span> (<span id="driver_phone_display"></span>)
                                    </div>
                                    <div id="driver_info_error" class="mt-2 text-danger" style="display: none; font-weight: 500;">
                                        <i class="fas fa-times-circle"></i> Driver not found
                                    </div>
                                    <span class="error driver_registration_no-error text-danger"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Allocate to Route -->
                        <div id="routeAllocationSection" style="display: none;">
                            <div class="cioas-panel mb-4">
                                <div class="cioas-panel-header">
                                    <h3 class="cioas-panel-title"><i class="fas fa-route"></i> Allocate to Route</h3>
                                </div>
                                <div class="cioas-panel-body">
                                    <table class="table table-bordered" id="routeTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Route (From Point)</th>
                                                <th>Route (Middle Point)</th>
                                                <th>Route (End Point)</th>
                                                <th style="width: 100px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="routeBody">
                                            <tr>
                                                <td><input type="text" name="routes[0][from_point]" class="form-control" placeholder="From Point"></td>
                                                <td><input type="text" name="routes[0][middle_point]" class="form-control" placeholder="Middle Point"></td>
                                                <td><input type="text" name="routes[0][end_point]" class="form-control" placeholder="End Point"></td>
                                                <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm mt-2" id="addRouteBtn"><i class="fas fa-plus"></i> Add More Route</button>
                                </div>
                            </div>
                        </div>

                        <div class="cioas-actions mt-4">
                            <a href="{{ route('vehicle.index') }}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Submit</button>
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
        "Heavy Passenger Vehicle": [
            "Bus - বাস",
            "Mini Bus - মিনি বাস"
        ],
        "Light Passenger Vehicle": [
            "Micro Bus - মাইক্রোবাস",
            "Private Car - প্রাইভেট কার",
            "Jeep / SUV - জিপ / এসইউভি"
        ],
        "Cargo / Freight Vehicle": [
            "Truck - ট্রাক",
            "Covered Van - কাভার্ড ভ্যান",
            "Pick-up - পিক-আপ"
        ],
        "Two & Three Wheeler": [
            "Motorcycle - মোটরসাইকেল",
            "Scooter - স্কুটার",
            "CNG Auto Rickshaw - সিএনজি অটোরিকশা",
            "Easy Bike - ইজিবাইক"
        ],
        "Non-Motorized / Manual": [
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



    populateSelect($type, Object.keys(vehicleData), "Select Vehicle Type");
    populateSelect($category, [], "Select Vehicle Category");

    $type.on("change", function () {
        const selectedType = $(this).val();
        const categories = selectedType ? vehicleData[selectedType] : [];
        populateSelect($category, categories, "Select Vehicle Category");
    });

    // Toggle Route Allocation Section based on vehicle type
    function toggleRouteSection(selectedType) {
        if (selectedType === "Heavy Passenger Vehicle") {
            $("#routeAllocationSection").slideDown();
            $("#routeAllocationSection :input").prop("disabled", false);
        } else {
            $("#routeAllocationSection").slideUp();
            $("#routeAllocationSection :input").prop("disabled", true);
        }
    }

    $type.on("change", function () {
        toggleRouteSection($(this).val());
    });

    // Initialize state on page load
    toggleRouteSection($type.val());



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

    let routeIndex = 1;
    $('#addRouteBtn').click(function() {
        let html = `
            <tr>
                <td><input type="text" name="routes[${routeIndex}][from_point]" class="form-control" placeholder="From Point"></td>
                <td><input type="text" name="routes[${routeIndex}][middle_point]" class="form-control" placeholder="Middle Point"></td>
                <td><input type="text" name="routes[${routeIndex}][end_point]" class="form-control" placeholder="End Point"></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
        $('#routeBody').append(html);
        routeIndex++;
    });

    $(document).on("click", ".remove-route", function() {
        if ($("#routeBody tr").length > 1) {
            $(this).closest("tr").remove();
        } else {
            toastr.warning("At least one route is required.");
        }
    });
});

    const driverInput = $('#driver_registration_no');
    const driverInfoDisplay = $('#driver_info_display');
    const driverInfoError = $('#driver_info_error');
    const driverNameDisplay = $('#driver_name_display');
    const driverPhoneDisplay = $('#driver_phone_display');

    function fetchDriverInfo() {
        const driverId = driverInput.val();
        if (driverId.length > 0) {
            $.ajax({
                url: "{{ route('vehicle.api.driver_info') }}",
                type: "GET",
                data: { driver_id: driverId },
                success: function(response) {
                    if (response.status) {
                        driverNameDisplay.text(response.name);
                        driverPhoneDisplay.text(response.phone || 'No Phone');
                        driverInfoDisplay.show();
                        driverInfoError.hide();
                    } else {
                        driverInfoDisplay.hide();
                        driverInfoError.show();
                    }
                },
                error: function() {
                    driverInfoDisplay.hide();
                    driverInfoError.hide();
                }
            });
        } else {
            driverInfoDisplay.hide();
            driverInfoError.hide();
        }
    }

    driverInput.on('input', function() {
        clearTimeout(window.driverTimeout);
        window.driverTimeout = setTimeout(fetchDriverInfo, 500);
    });

    // Run once on load if there's a value
    if (driverInput.val() !== '') {
        fetchDriverInfo();
    }
    
</script>
@endpush
