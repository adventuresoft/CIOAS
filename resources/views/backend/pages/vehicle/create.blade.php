@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleCreate'])
@push('style')
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
                                    <input type="text" required class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Enter Vehicle Model">
                                    <span class="error vehicle_model-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="make_year" class="col-sm-2 col-form-label">Make Year</label>
                                <div class="col-sm-9">
                                    <input type="number" required class="form-control" name="make_year" id="make_year" placeholder="Enter Year (e.g. 2024)" min="1900" max="2099">
                                    <span class="error make_year-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="make_company" class="col-sm-2 col-form-label">Make Company</label>
                                <div class="col-sm-9">
                                    <input type="text" required class="form-control" name="make_company" id="make_company" placeholder="Enter Company Name">
                                    <span class="error make_company-error text-danger"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" placeholder="Price" class="form-control" id="price">
                                    <span class="error price-error text-danger"></span>
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
