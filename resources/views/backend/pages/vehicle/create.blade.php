@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleCreate'])
@push('style')
@endpush
@section('title', 'Vehicle Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Vehicle Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('vehicle.index')}}">Vehicle</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Vehicle Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="vehicleForm" method="POST" action="{{route('vehicle.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">



                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="vehicle_type" id="vehicle_type">
                                            <option value="">Select Vehicle Type</option>
                                        </select>
                                        <span class="error vehicle_type-error text-danger"></span>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Category</label>
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
                                <div class="form-group row">
                                    <label for="owner_id" class="col-sm-2 col-form-label">Owner ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="owner_id" placeholder="Owner Id" class="form-control" id="owner_id">
                                        <span class="error owner_id-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="owner_name" class="col-sm-2 col-form-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="owner_name" placeholder="Owner Name" class="form-control" id="owner_name">
                                        <span class="error owner_name-error text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="price" placeholder="Price" class="form-control" id="price">
                                        <span class="error price-error text-danger"></span>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="{{route('vehicle.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

{{-- {{ route('death.store') }} --}}
@endsection
@push('script')

    <script>
$(document).ready(function () {

    // Initialize select2
    $(".select2").select2();

    // Vehicle Data (FIXED STRUCTURE)
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

    // Function to populate select
    function populateSelect(select, items, placeholder) {
        select.empty();
        select.append(new Option(placeholder, ""));

        items.forEach(function(item) {
            select.append(new Option(item, item));
        });

        select.trigger("change");
    }

    // Initial Load
    populateSelect($type, Object.keys(vehicleData), "Select Vehicle Type");
    populateSelect($category, [], "Select Vehicle Category");

    // On Type Change
    $type.on("change", function () {
        const selectedType = $(this).val();
        const categories = selectedType ? vehicleData[selectedType] : [];
        populateSelect($category, categories, "Select Vehicle Category");
    });

    $("#vehicleForm").on("submit", function (e) {
        e.preventDefault();

        let thisForm = $(this);
        let submitBtn = thisForm.find('button[type="submit"]');

        $.ajax({
            type: "POST",
            url: "{{route('vehicle.store')}}",
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
                }, 2000);
            },

            error: function (xhr) {
                submitBtn.prop("disabled", false);
                let response = xhr.responseJSON || {};
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
