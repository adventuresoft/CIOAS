@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleList'])
@push('style')
@endpush
@section('title', 'Vehicle Edit')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vehicle Edit</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Vehicle Edit Info</h3>
                    </div>

                    <form class="form-horizontal" id="vehicleEditForm" method="POST" action="{{ route('vehicle.update', $vehicle->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <h5 class="text-info mb-3">Vehicle Info</h5>

                            <div class="form-group row">
                                <label for="vehicle_type" class="col-sm-2 col-form-label">Vehicle Type</label>
                                <div class="col-sm-9">
                                    <select required class="form-control select2" name="vehicle_type" id="vehicle_type">
                                        <option value="">Select Vehicle Type</option>
                                    </select>
                                    <span class="error vehicle_type-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vehicle_category" class="col-sm-2 col-form-label">Vehicle Category</label>
                                <div class="col-sm-9">
                                    <select required class="form-control select2" name="vehicle_category" id="vehicle_category">
                                        <option value="">Select Vehicle Category</option>
                                    </select>
                                    <span class="error vehicle_category-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vehicle_model" class="col-sm-2 col-form-label">Vehicle Model</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" name="vehicle_model" id="vehicle_model" value="{{ $vehicle->vehicle_model }}" placeholder="Enter Vehicle Model">
                                    <span class="error vehicle_model-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="make_year" class="col-sm-2 col-form-label">Make Year</label>
                                <div class="col-sm-9">
                                    <input type="number" required class="form-control" name="make_year" id="make_year" value="{{ $vehicle->make_year }}" placeholder="Enter Year (e.g. 2024)" min="1900" max="2099">
                                    <span class="error make_year-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="make_company" class="col-sm-2 col-form-label">Make Company</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" name="make_company" id="make_company" value="{{ $vehicle->make_company }}" placeholder="Enter Company Name">
                                    <span class="error make_company-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" class="form-control" id="price" value="{{ $vehicle->price }}" placeholder="Price">
                                    <span class="error price-error text-danger"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="engine_number">Engine Number - ইঞ্জিন নম্বর</label>
                                        <input type="text" name="engine_number" class="form-control" id="engine_number" value="{{ $vehicle->engine_number }}" placeholder="Enter Engine Number">
                                        <span class="error engine_number-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chassis_number">Chassis Number - চ্যাসিস নম্বর</label>
                                        <input type="text" name="chassis_number" class="form-control" id="chassis_number" value="{{ $vehicle->chassis_number }}" placeholder="Enter Chassis Number">
                                        <span class="error chassis_number-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tyre_number">Tyre Number - টায়ারের নম্বর</label>
                                        <input type="text" name="tyre_number" class="form-control" id="tyre_number" value="{{ $vehicle->tyre_number }}" placeholder="Enter Tyre Number">
                                        <span class="error tyre_number-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hp_cc">HP/CC - হর্সপাওয়ার / সিসি (ইঞ্জিন ক্ষমতা)</label>
                                        <input type="text" name="hp_cc" class="form-control" id="hp_cc" value="{{ $vehicle->hp_cc }}" placeholder="Enter HP/CC">
                                        <span class="error hp_cc-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seat_capacity">Seat Capacity - আসন সংখ্যা</label>
                                        <input type="text" name="seat_capacity" class="form-control" id="seat_capacity" value="{{ $vehicle->seat_capacity }}" placeholder="Enter Seat Capacity">
                                        <span class="error seat_capacity-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="height">Height - উচ্চতা</label>
                                        <input type="text" name="height" class="form-control" id="height" value="{{ $vehicle->height }}" placeholder="Enter Height">
                                        <span class="error height-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="width">Width - প্রস্থ</label>
                                        <input type="text" name="width" class="form-control" id="width" value="{{ $vehicle->width }}" placeholder="Enter Width">
                                        <span class="error width-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tyre_size">Tyre Size - টায়ারের সাইজ</label>
                                        <input type="text" name="tyre_size" class="form-control" id="tyre_size" value="{{ $vehicle->tyre_size }}" placeholder="Enter Tyre Size">
                                        <span class="error tyre_size-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color">Color - রং</label>
                                        <input type="text" name="color" class="form-control" id="color" value="{{ $vehicle->color }}" placeholder="Enter Color">
                                        <span class="error color-error text-danger"></span>
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
                                        <option value="personal" {{ $vehicle->ownership_type === 'personal' ? 'selected' : '' }}>Personal</option>
                                        <option value="institutional" {{ $vehicle->ownership_type === 'institutional' ? 'selected' : '' }}>Institutional</option>
                                    </select>
                                    <span class="error ownership_type-error text-danger"></span>
                                </div>
                            </div>

                            <div id="personal-owner-field" class="{{ $vehicle->ownership_type === 'personal' ? '' : 'd-none' }}">
                                <div class="form-group row">
                                    <label for="owner_id" class="col-sm-2 col-form-label">Owner ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="owner_id" class="form-control" id="owner_id" value="{{ $vehicle->owner_id }}" placeholder="Owner ID (User ID / System ID)">
                                        <small class="text-muted">Personal ownership-এর ক্ষেত্রে এই ID থেকে user details দেখানো হবে view page-এ।</small>
                                        <span class="error owner_id-error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="institutional-fields" class="{{ $vehicle->ownership_type === 'institutional' ? '' : 'd-none' }}">
                                <div class="form-group row">
                                    <label for="institutional_name" class="col-sm-2 col-form-label">Institutional Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="institutional_name" class="form-control" id="institutional_name" value="{{ $vehicle->institutional_name }}" placeholder="Institutional Name">
                                        <span class="error institutional_name-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="trade_license" class="col-sm-2 col-form-label">Trade License</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="trade_license" class="form-control" id="trade_license" value="{{ $vehicle->trade_license }}" placeholder="Trade License">
                                        <span class="error trade_license-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="institutional_address" class="col-sm-2 col-form-label">Institutional Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="institutional_address" class="form-control" id="institutional_address" rows="3" placeholder="Institutional Address">{{ $vehicle->institutional_address }}</textarea>
                                        <span class="error institutional_address-error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="form-group row">
                                <a href="{{ route('vehicle.index') }}" class="btn btn-default float-right">Cancel</a>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info">Update</button>
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
    const selectedType = @json($vehicle->vehicle_type);
    const selectedCategory = @json($vehicle->vehicle_category);

    function populateSelect(select, items, placeholder, selectedValue = null) {
        select.empty();
        select.append(new Option(placeholder, ""));

        items.forEach(function (item) {
            const option = new Option(item, item, false, selectedValue === item);
            select.append(option);
        });

        if (selectedValue && items.indexOf(selectedValue) === -1) {
            select.append(new Option(selectedValue, selectedValue, true, true));
        }

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
    }

    const types = Object.keys(vehicleData);
    populateSelect($type, types, "Select Vehicle Type", selectedType);

    const categories = selectedType && vehicleData[selectedType] ? vehicleData[selectedType] : [];
    populateSelect($category, categories, "Select Vehicle Category", selectedCategory);

    $type.on("change", function () {
        const type = $(this).val();
        const typeCategories = type && vehicleData[type] ? vehicleData[type] : [];
        populateSelect($category, typeCategories, "Select Vehicle Category");
    });

    $ownershipType.on("change", toggleOwnershipFields);
    toggleOwnershipFields();

    $("#vehicleEditForm").on("submit", function (e) {
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
});
</script>
@endpush
