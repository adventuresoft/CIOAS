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
                            @method('PUT')
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
                                                        <input type="text" name="engine_number" value="{{ $vehicle->engine_number }}" class="form-control" id="engine_number" placeholder="Enter Engine Number">
                                                        <span class="error engine_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="chassis_number">Chassis Number - চ্যাসিস নম্বর</label>
                                                        <input type="text" name="chassis_number" value="{{ $vehicle->chassis_number }}" class="form-control" id="chassis_number" placeholder="Enter Chassis Number">
                                                        <span class="error chassis_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tyre_number">Tyre Number - টায়ারের নম্বর</label>
                                                        <input type="text" name="tyre_number" value="{{ $vehicle->tyre_number }}" class="form-control" id="tyre_number" placeholder="Enter Tyre Number">
                                                        <span class="error tyre_number-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="hp_cc">HP/CC - হর্সপাওয়ার / সিসি (ইঞ্জিন ক্ষমতা)</label>
                                                        <input type="text" name="hp_cc" value="{{ $vehicle->hp_cc }}" class="form-control" id="hp_cc" placeholder="Enter HP/CC">
                                                        <span class="error hp_cc-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="seat_capacity">Seat Capacity - আসন সংখ্যা</label>
                                                        <input type="text" name="seat_capacity" value="{{ $vehicle->seat_capacity }}" class="form-control" id="seat_capacity" placeholder="Enter Seat Capacity">
                                                        <span class="error seat_capacity-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="height">Height - উচ্চতা</label>
                                                        <input type="text" name="height" value="{{ $vehicle->height }}" class="form-control" id="height" placeholder="Enter Height">
                                                        <span class="error height-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="width">Width - প্রস্থ</label>
                                                        <input type="text" name="width" value="{{ $vehicle->width }}" class="form-control" id="width" placeholder="Enter Width">
                                                        <span class="error width-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tyre_size">Tyre Size - টায়ারের সাইজ</label>
                                                        <input type="text" name="tyre_size" value="{{ $vehicle->tyre_size }}" class="form-control" id="tyre_size" placeholder="Enter Tyre Size">
                                                        <span class="error tyre_size-error text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="color">Color - রং</label>
                                                        <input type="text" name="color" value="{{ $vehicle->color }}" class="form-control" id="color" placeholder="Enter Color">
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
                                                <label for="registration_no">Registration No</label>
                                                <input type="text" value="{{ $vehicle->registration_no }}" class="form-control" name="registration_no" id="registration_no" placeholder="Enter Registration No">
                                                <span class="error registration_no-error text-danger"></span>
                                            </div>

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
                                                <input type="text" required value="{{ $vehicle->vehicle_model }}" class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Enter Vehicle Model">
                                                <span class="error vehicle_model-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="make_year">Make Year</label>
                                                <input type="number" required value="{{ $vehicle->make_year }}" class="form-control" name="make_year" id="make_year" placeholder="Enter Year (e.g. 2024)" min="1900" max="2099">
                                                <span class="error make_year-error text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="make_company">Make Company</label>
                                                <input type="text" required value="{{ $vehicle->make_company }}" class="form-control" name="make_company" id="make_company" placeholder="Enter Company Name">
                                                <span class="error make_company-error text-danger"></span>
                                            </div>

                                            <div class="form-group mb-0">
                                                <label for="price">Price</label>
                                                <input type="text" name="price" placeholder="Price" value="{{ $vehicle->price }}" class="form-control" id="price">
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
                                        <option value="own" {{ $vehicle->ownership_type == "own" ? "selected" : "" }}>Own</option>
                                        <option value="rental" {{ $vehicle->ownership_type == "rental" ? "selected" : "" }}>Rental</option>
                                    </select>
                                    <span class="error ownership_type-error text-danger"></span>
                                </div>
                            </div>


                            <hr>
                            <h5 class="text-info mb-3"><i class="fas fa-file-contract"></i> Certificates & Attachments</h5>
                            <div class="vehicle-info-layout">
                                <div class="row">
                                    <!-- RC -->
                                    <div class="col-md-6 mb-3">
                                        <div class="vehicle-info-panel">
                                            <h6 class="vehicle-info-panel-title">RC (Registration Certificate)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                @if($vehicle->rc_attachment)
                                                    <small class="ml-2"><a href="{{ asset('storage/'.$vehicle->rc_attachment) }}" target="_blank"><i class="fas fa-paperclip"></i> View Current</a></small>
                                                @endif
                                                <input type="file" class="form-control" name="rc_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" value="{{ $vehicle->rc_issue_date }}" class="form-control" name="rc_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" value="{{ $vehicle->rc_validity_date }}" class="form-control" name="rc_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RP -->
                                    <div class="col-md-6 mb-3">
                                        <div class="vehicle-info-panel">
                                            <h6 class="vehicle-info-panel-title">RP (Road Permit)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                @if($vehicle->rp_attachment)
                                                    <small class="ml-2"><a href="{{ asset('storage/'.$vehicle->rp_attachment) }}" target="_blank"><i class="fas fa-paperclip"></i> View Current</a></small>
                                                @endif
                                                <input type="file" class="form-control" name="rp_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" value="{{ $vehicle->rp_issue_date }}" class="form-control" name="rp_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" value="{{ $vehicle->rp_validity_date }}" class="form-control" name="rp_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TT -->
                                    <div class="col-md-6 mb-3">
                                        <div class="vehicle-info-panel">
                                            <h6 class="vehicle-info-panel-title">TT (Tax Token)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                @if($vehicle->tt_attachment)
                                                    <small class="ml-2"><a href="{{ asset('storage/'.$vehicle->tt_attachment) }}" target="_blank"><i class="fas fa-paperclip"></i> View Current</a></small>
                                                @endif
                                                <input type="file" class="form-control" name="tt_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" value="{{ $vehicle->tt_issue_date }}" class="form-control" name="tt_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" value="{{ $vehicle->tt_validity_date }}" class="form-control" name="tt_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- IN -->
                                    <div class="col-md-6 mb-3">
                                        <div class="vehicle-info-panel">
                                            <h6 class="vehicle-info-panel-title">IN (Insurance)</h6>
                                            <div class="form-group">
                                                <label>Attachment Upload</label>
                                                @if($vehicle->in_attachment)
                                                    <small class="ml-2"><a href="{{ asset('storage/'.$vehicle->in_attachment) }}" target="_blank"><i class="fas fa-paperclip"></i> View Current</a></small>
                                                @endif
                                                <input type="file" class="form-control" name="in_attachment">
                                            </div>
                                            <div class="form-group">
                                                <label>Issue Date</label>
                                                <input type="date" value="{{ $vehicle->in_issue_date }}" class="form-control" name="in_issue_date">
                                            </div>
                                            <div class="form-group">
                                                <label>Validity Date</label>
                                                <input type="date" value="{{ $vehicle->in_validity_date }}" class="form-control" name="in_validity_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-info mb-3"><i class="fas fa-id-card"></i> Assign Driver</h5>
                            <div class="vehicle-info-layout">
                                <div class="vehicle-info-panel">
                                    <div class="form-group">
                                        <label for="driver_registration_no">Registration Number (Driver ID/Staff ID/System ID)</label>
                                        <input type="text" name="driver_registration_no" value="{{ $vehicle->driver_registration_no ?? '' }}" class="form-control" id="driver_registration_no" placeholder="Enter Registration Number">
                                        <div id="driver_info_display" class="mt-2 text-primary" style="display: none; font-weight: 500;">
                                            <i class="fas fa-user-check"></i> Driver Found: <span id="driver_name_display"></span> (<span id="driver_phone_display"></span>)
                                        </div>
                                        <div id="driver_info_error" class="mt-2 text-danger" style="display: none; font-weight: 500;">
                                            <i class="fas fa-times-circle"></i> Driver not found
                                        </div>driver_registration_no }}" class="form-control" id="driver_registration_no" placeholder="Enter Registration Number">
                                        <span class="error driver_registration_no-error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="routeAllocationSection" style="display: {{ $vehicle->vehicle_type == \'Heavy Passenger Vehicle\' ? \'block\' : \'none\' }};">
                            <hr>
                            <h5 class="text-info mb-3"><i class="fas fa-route"></i> Allocate to Route</h5>
                            <div class="vehicle-info-layout">
                                <div class="vehicle-info-panel">
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
                                            @if($vehicle->routes->count() > 0)
                                                @foreach($vehicle->routes as $index => $route)
                                                <tr>
                                                    <td><input type="text" name="routes[{{ $index }}][from_point]" value="{{ $route->from_point }}" class="form-control" placeholder="From Point" required></td>
                                                    <td><input type="text" name="routes[{{ $index }}][middle_point]" value="{{ $route->middle_point }}" class="form-control" placeholder="Middle Point"></td>
                                                    <td><input type="text" name="routes[{{ $index }}][end_point]" value="{{ $route->end_point }}" class="form-control" placeholder="End Point" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td><input type="text" name="routes[0][from_point]" value="" class="form-control" placeholder="From Point" required></td>
                                                    <td><input type="text" name="routes[0][middle_point]" value="" class="form-control" placeholder="Middle Point"></td>
                                                    <td><input type="text" name="routes[0][end_point]" value="" class="form-control" placeholder="End Point" required></td>
                                                    <td><button type="button" class="btn btn-danger btn-sm remove-route"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm mt-2" id="addRouteBtn"><i class="fas fa-plus"></i> Add More Route</button>
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
    $type.val('{{ $vehicle->vehicle_type }}').trigger('change');

    populateSelect($category, vehicleData['{{ $vehicle->vehicle_type }}'] || [], "Select Vehicle Category");
    $category.val('{{ $vehicle->vehicle_category }}').trigger('change');

    // Toggle Route Allocation Section based on vehicle type
    $type.on("change", function () {
        if ($(this).val() === "Heavy Passenger Vehicle") {
            $("#routeAllocationSection").slideDown();
        } else {
            $("#routeAllocationSection").slideUp();
        }
    });


    $type.on("change", function () {
        const selectedType = $(this).val();
        const categories = selectedType ? vehicleData[selectedType] : [];
        populateSelect($category, categories, "Select Vehicle Category");
    });



    $("#vehicleForm").on("submit", function (e) {
        e.preventDefault();

        const thisForm = $(this);
        const submitBtn = thisForm.find('button[type="submit"]');

        $.ajax({
            type: "POST",
            url: "{{ route('vehicle.update', $vehicle->id) }}",
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

    let routeIndex = {{ $vehicle->routes->count() > 0 ? $vehicle->routes->count() : 1 }};
    $('#addRouteBtn').click(function() {
        let html = `
            <tr>
                <td><input type="text" name="routes[${routeIndex}][from_point]" value="" class="form-control" placeholder="From Point" required></td>
                <td><input type="text" name="routes[${routeIndex}][middle_point]" value="" class="form-control" placeholder="Middle Point"></td>
                <td><input type="text" name="routes[${routeIndex}][end_point]" value="" class="form-control" placeholder="End Point" required></td>
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
