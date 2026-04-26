@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'RegistrationFees'])
@push('style')
@endpush
@section('title', 'Organization Fees Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Organization Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('organizationA.registration-fees.index') }}">Organization Registration
                                Fees</a></li>
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
                            <h3 class="card-title">Organization Fees Info</h3>
                        </div>
                        <!-- /.card-header -->



                        <form class="form-horizontal" id="organizationFeesForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" id="user_id">
                            <div class="card-body">
                                <div class="tabl-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Financial Year</th>
                                                <th>
                                                    <select class="form-control" name="tax_year_id">
                                                        <option value="">Select Financial Year</option>
                                                        @if ($tax_years)
                                                            @foreach ($tax_years as $tax_year)
                                                                <option value="{{ $tax_year->id }}">{{ $tax_year->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error tax_year_id-error text-danger"></small>
                                                </th>
                                                <th>Institute Type</th>
                                                <th>

                                                    <select class="form-control" id="institute_type_id" name="institute_type_id">
                                                        <option value="">Select Institute Type</option>
                                                        @if (count($institute_types))

                                                            @foreach ($institute_types as $institute_type)
                                                                <option value="{{ $institute_type->id }}">
                                                                    {{ $institute_type->name }}</option>
                                                            @endforeach

                                                        @endif

                                                    </select>
                                                    <small class="error institute_type_id-error text-danger"></small>


                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Organization Category</th>
                                                <th>
                                                    <select class="form-control" id="organization_category_id"
                                                        name="organization_category_id">
                                                        <option value="">Select Org. Category</option>
                                                        @if (count($organization_categories))
                                                            @foreach ($organization_categories as $org_category)
                                                                <option value="{{ $org_category->id }}">
                                                                    {{ $org_category->en_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error organization_category_id-error text-danger"></small>

                                                </th>
                                                <th>Organizaiton Subcategory</th>
                                                <th>
                                                    <select class="form-control" id="organization_subcategory_id"
                                                        name="organization_subcategory_id">
                                                        <option value="">Select Org. Subcategory</option>
                                                        @if (count($organization_sub_categories))
                                                            @foreach ($organization_sub_categories as $organization_sub_category)
                                                                <option value="{{ $organization_sub_category->id }}">
                                                                    {{ $organization_sub_category->en_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error organization_subcategory_id-error text-danger"></small>

                                                </th>
                                            </tr>

                                        </thead>
                                    </table>


                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="width: 10%">SL No.</th>
                                                <th rowspan="2">Fees Head</th>
                                                <th colspan="3">Fees</th>
                                            </tr>
                                            <tr>
                                                <th>A Category</th>
                                                <th>B Category</th>
                                                <th>C Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            <tr>
                                                <td>1. </td>
                                                <td><input class="form-control text-left" value="New Registration Charge"
                                                        name="name[]"></td>
                                                <td><input class="form-control text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></">
                                                </td>
                                                <td><input class="form-control text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2. </td>
                                                <td><input class="form-control text-left" value="Yearly Charge"
                                                        name="name[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>3. </td>
                                                <td><input class="form-control text-left" value="Renew Charge"
                                                        name="name[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>4. </td>
                                                <td><input class="form-control text-left" value="Signboard Fees"
                                                        name="name[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>5. </td>
                                                <td><input class="form-control text-left" value="Surcharge"
                                                        name="name[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>6. </td>
                                                <td><input class="form-control text-left" value="Others" name="name[]">
                                                </td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>7. </td>
                                                <td><input class="form-control text-left" value="VAT" name="name[]">
                                                </td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>8. </td>
                                                <td><input class="form-control text-left" value="TAX" name="name[]">
                                                </td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>

                                            <tr>
                                                <td>9. </td>
                                                <td><input class="form-control text-left" value="Fine" name="name[]">
                                                </td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_a_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_b_fees[]"></td>
                                                <td><input class="form-control  text-right" value="0" min="0"
                                                        type="number" name="category_c_fees[]"></td>
                                            </tr>


                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <button type="reset" class="btn btn-danger">Reset</button>
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
            $("#organizationFeesForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('organizationA.registration-fees.store')}}",
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
                        setTimeout(function() {
                            location.href = "{{route('organizationA.registration-fees.index')}}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('change', '#organization_category_id', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('organization-subcategory-options') }}/" + _this_value,
                    beforeSend: function() {
                        $('#organization_subcategory_id').prop("disabled", true);
                        console.log("Searcing organization category");
                    },
                    success: function(response) {
                        $('#organization_subcategory_id').html(response)
                        $('#organization_subcategory_id').prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            }
        })
    </script>
@endpush
