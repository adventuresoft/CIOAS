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
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Vehicle Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Vehicle Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Name (Bangla)</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Name Bangla" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="vehicle_type" id="vehicle_type">
                                            <option value="">Select Vehicle Type</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="vehicle_category" id="vehicle_category">
                                            <option value="">Select Vehicle Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Sub Category </label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="vehicle_subcategory" id="vehicle_subcategory">
                                            <option value="">Select Vehicle Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Model</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Vehicle Model</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Make Year</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Make Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Make Company</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Make Company</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Ownership Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Ownership Type</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Owner ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Owner Id" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Owner Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Price" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">BRTA Reg. No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="BRTA Reg. No." class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Reg. Authority</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Reg. Authority</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="" class="btn btn-default float-right">Cancel</a>
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
         $(document).ready(function() {
             $(".select2").select2();
             const vehicleData = {
                 "Two Wheeler": {
                     "Motorcycle": ["Standard Motorcycle", "Sport Bike", "Moped"],
                     "Scooter": ["Gearless Scooter", "Electric Scooter"],
                     "Bicycle": ["Standard Bicycle", "Electric Bicycle"]
                 },
                 "Three Wheeler": {
                     "Auto Rickshaw (CNG)": ["Passenger CNG", "Cargo CNG"],
                     "E-Rickshaw": ["Passenger E-Rickshaw", "Loader E-Rickshaw"],
                     "Rickshaw (Non-motorized)": ["Passenger Rickshaw", "Van Rickshaw"]
                 },
                 "Passenger Vehicle": {
                     "Sedan": ["Compact Sedan", "Mid-size Sedan", "Premium Sedan"],
                     "SUV/Jeep": ["Compact SUV", "Full-size SUV", "Off-road Jeep"],
                     "Microbus": ["7 Seater", "9 Seater"],
                     "Bus/Minibus": ["Minibus", "Intercity Bus", "City Bus"]
                 },
                 "Goods Vehicle": {
                     "Pickup": ["Single Cab", "Double Cab"],
                     "Truck": ["Light Truck", "Medium Truck", "Heavy Truck"],
                     "Covered Van": ["Small Covered Van", "Large Covered Van"],
                     "Cargo Van": ["Refrigerated Van", "Delivery Van"]
                 },
                 "Special Purpose": {
                     "Ambulance": ["Basic Ambulance", "ICU Ambulance"],
                     "Fire Service Vehicle": ["Fire Engine", "Rescue Vehicle"],
                     "Construction Equipment": ["Excavator", "Loader", "Roller"]
                 }
             };

             const $type = $("#vehicle_type");
             const $category = $("#vehicle_category");
             const $subcategory = $("#vehicle_subcategory");

             const populateSelect = (select, items, placeholder) => {
                 select.empty();
                 select.append(new Option(placeholder, ""));
                 items.forEach((item) => {
                     select.append(new Option(item, item));
                 });
                 select.trigger("change");
             };

             populateSelect($type, Object.keys(vehicleData), "Select Vehicle Type");
             populateSelect($category, [], "Select Vehicle Category");
             populateSelect($subcategory, [], "Select Vehicle Sub Category");

             $type.on("change", function() {
                 const selectedType = $(this).val();
                 const categories = selectedType ? Object.keys(vehicleData[selectedType]) : [];
                 populateSelect($category, categories, "Select Vehicle Category");
                 populateSelect($subcategory, [], "Select Vehicle Sub Category");
             });

             $category.on("change", function() {
                 const selectedType = $type.val();
                 const selectedCategory = $(this).val();
                 const subcategories =
                     selectedType && selectedCategory
                         ? vehicleData[selectedType][selectedCategory]
                         : [];
                 populateSelect($subcategory, subcategories, "Select Vehicle Sub Category");
             });
            $("#deathCertificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

    </script>
@endpush
