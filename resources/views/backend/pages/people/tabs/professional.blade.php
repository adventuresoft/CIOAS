@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>People Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
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
                            @include('backend.pages.people.tabs.tab_header', [
                                'user' => $user,
                                'active_tab' => 'professional',
                            ])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleProfessionalForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="card-body" id="multiple-profession">

                                @if (count($user->professionalInfos))
                                    @foreach ($user->professionalInfos as $professionalInfo)
                                        <div class="single-profession">

                                            <div class="form-group row">
                                                <label for="profession" class="col-sm-2 col-form-label">Profession</label>
                                                <div class="col-sm-9">
                                                    <select name="professionU[{{ $professionalInfo->id }}]"
                                                        class="form-control select2 profession">
                                                        <option value="">Select Profession</option>
                                                        @if (count($professions))
                                                            @foreach ($professions as $profession)
                                                                <option value="{{ $profession->id }}"
                                                                    {{ isset($professionalInfo->subcategory->category->type->profession_id) ? ($professionalInfo->subcategory->category->type->profession_id == $profession->id ? 'selected' : '') : '' }}>
                                                                    {{ $profession->en_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="profession_type" class="col-sm-2 col-form-label">Type</label>
                                                <div class="col-sm-9">
                                                    <select name="profession_typeU[{{ $professionalInfo->id }}]"
                                                        class="form-control select2 profession_type">
                                                        <option
                                                            value="{{ $professionalInfo->subcategory->category->type->id ?? '' }}">
                                                            {{ $professionalInfo->subcategory->category->type->en_name ?? 'Select Profession Type' }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="profession_category"
                                                    class="col-sm-2  col-form-label">Category</label>
                                                <div class="col-sm-9">
                                                    <select name="profession_categoryU[{{ $professionalInfo->id }}]"
                                                        class="form-control select2 profession_category">
                                                        <option
                                                            value="{{ $professionalInfo->subcategory->category->id ?? '' }}">
                                                            {{ $professionalInfo->subcategory->category->en_name ?? 'Select Profession Category' }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="profession_subcategory"
                                                    class="col-sm-2 col-form-label">Subcategory</label>
                                                <div class="col-sm-9">
                                                    <select required
                                                        name="profession_subcategoryU[{{ $professionalInfo->id }}]"
                                                        class="form-control select2 profession_subcategory">
                                                        <option value="{{ $professionalInfo->subcategory->id ?? '' }}">
                                                            {{ $professionalInfo->subcategory->en_name ?? 'Select Profession Subcategory' }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="profession_start" class="col-sm-2 col-form-label">Start
                                                    Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        name="profession_startU[{{ $professionalInfo->id }}]"
                                                        value="{{ $professionalInfo->profession_start ?? '' }}"
                                                        placeholder="Profession Start Date" class="form-control"
                                                        id="profession_start">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="profession_end" class="col-sm-2 col-form-label">End Date</label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        name="profession_endU[{{ $professionalInfo->id }}]"
                                                        value="{{ $professionalInfo->profession_end ?? '' }}"
                                                        placeholder="Profession End Date" class="form-control"
                                                        id="profession_end">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="organization"
                                                    class="col-sm-2 col-form-label">Organization</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="organizationU[{{ $professionalInfo->id }}]"
                                                        placeholder="Enter name of professional organization"
                                                        value="{{ $professionalInfo->organization ?? '' }}"
                                                        class="form-control organization">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="designationU[{{ $professionalInfo->id }}]"
                                                        placeholder="Enter name of professional designation"
                                                        value="{{ $professionalInfo->designation ?? '' }}"
                                                        class="form-control designation">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <textarea name="addressU[{{ $professionalInfo->id }}]" class="form-control address"
                                                        placeholder="Enter name of professional address" cols="30" rows="3">{{ $professionalInfo->address ?? '' }}</textarea>
                                                </div>
                                                <div class="col-sm-1 mt-1">
                                                    <button type="button" data-id="{{ $professionalInfo->id }}"
                                                        class="btn btn-danger deleteBtn">X</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="single-profession">
                                        <div class="form-group row">
                                            <label for="profession" class="col-sm-2 col-form-label">Profession</label>
                                            <div class="col-sm-9">
                                                <select name="profession[]" class="form-control select2 profession">
                                                    <option value="">Select Profession</option>
                                                    @if (count($professions))
                                                        @foreach ($professions as $profession)
                                                            <option value="{{ $profession->id }}">
                                                                {{ $profession->en_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="profession_type" class="col-sm-2 col-form-label">Type</label>
                                            <div class="col-sm-9">
                                                <select name="profession_type[]" class="form-control select2 profession_type">
                                                    <option value="">Select Profession Type</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="profession_category"
                                                class="col-sm-2  col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select name="profession_category[]"
                                                    class="form-control select2 profession_category">
                                                    <option value="">Select Profession Category</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="profession_subcategory"
                                                class="col-sm-2 col-form-label">Subcategory</label>
                                            <div class="col-sm-9">
                                                <select required name="profession_subcategory[]"
                                                    class="form-control select2 profession_subcategory">
                                                    <option value="">Select Profession Subcategory</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="profession_start" class="col-sm-2 col-form-label">Start
                                                Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="profession_start[]" value=""
                                                    placeholder="Profession Start Date" class="form-control"
                                                    id="profession_start">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="profession_end" class="col-sm-2 col-form-label">End Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="profession_end[]" value=""
                                                    placeholder="Profession End Date" class="form-control"
                                                    id="profession_end">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="organization" class="col-sm-2 col-form-label">Organization</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="organization[]"
                                                    placeholder="Enter name of professional organization" value=""
                                                    class="form-control organization">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="designation" class="col-sm-2 col-form-label">Designation</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="designation[]"
                                                    placeholder="Enter name of professional designation" value=""
                                                    class="form-control designation">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="address[]" class="form-control address" placeholder="Enter name of professional address"
                                                    cols="30" rows="3"></textarea>
                                            </div>
                                            <div class="col-sm-1 mt-1">
                                                <button type="button" class="btn btn-danger removeBtn">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row mb-1">
                                    <div class="col-sm-3">
                                        <button type="button" id="addNewProfession" title="Add More"
                                            class="btn btn-primary btn-block">Add Previous Profession</button>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <a href="{{ route('people.education', $user->id) }}"
                                            class="btn btn-danger btn-block">Education</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.financial', $user->id) }}"
                                            class="btn btn-primary btn-block ">Financial</a>
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

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $("#peopleProfessionalForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.professionalStore') }}",
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
                            location.href = response.redirect_url;
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

        $("#addNewProfession").on('click', function() {

            let addNewProfession = '';

            addNewProfession += '<div class="single-profession">';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession" class="col-sm-2 col-form-label">Profession</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<select name="profession[]" class="form-control select2 profession">';
                            addNewProfession += '<option value="">Select Profession</option>';
                                @if (count($professions))
                                    @foreach ($professions as $profession)
                                        addNewProfession += '<option value="{{ $profession->id }}">{{ $profession->en_name }}</option>';
                                    @endforeach
                                @endif
                        addNewProfession += '</select>';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession_type" class="col-sm-2 col-form-label">Type</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<select name="profession_type[]" class="form-control select2 profession_type">';
                            addNewProfession += '<option value="">Select Profession Type</option>';
                        addNewProfession += '</select>';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession_category" class="col-sm-2  col-form-label">Category</label>';
                        addNewProfession += '<div class="col-sm-9">';
                            addNewProfession += '<select name="profession_category[]" class="form-control select2 profession_category">';
                                addNewProfession += '<option value="">Select Profession Category</option>';
                            addNewProfession += '</select>';
                        addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession_subcategory" class="col-sm-2 col-form-label">Subcategory</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<select required name="profession_subcategory[]" class="form-control select2 profession_subcategory">';
                            addNewProfession += '<option value="">Select Profession Subcategory</option>';
                        addNewProfession += '</select>';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession_start" class="col-sm-2 col-form-label">Start Date</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<input type="date" name="profession_start[]" value="" placeholder="Profession Start Date" class="form-control" id="profession_start">';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="profession_end" class="col-sm-2 col-form-label">End Date</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<input type="date" name="profession_end[]" value="" placeholder="Profession End Date" class="form-control" id="profession_end">';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="organization" class="col-sm-2 col-form-label">Organization</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<input type="text" name="organization[]" placeholder="Enter name of professional organization" value="" class="form-control organization">';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="designation" class="col-sm-2 col-form-label">Designation</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<input type="text" name="designation[]" placeholder="Enter name of professional designation" value="" class="form-control designation">';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';

                addNewProfession += '<div class="form-group row">';
                    addNewProfession += '<label for="address" class="col-sm-2 col-form-label">Address</label>';
                    addNewProfession += '<div class="col-sm-9">';
                        addNewProfession += '<textarea name="address[]" class="form-control address" placeholder="Enter name of professional address" cols="30" rows="3"></textarea>';
                    addNewProfession += '</div>';
                    addNewProfession += '<div class="col-sm-1 mt-1">';
                        addNewProfession += '<button type="button" class="btn btn-danger removeBtn">X</button>';
                    addNewProfession += '</div>';
                addNewProfession += '</div>';


            addNewProfession += '</div>';
          


            $("#multiple-profession").append(addNewProfession);
        })

      

        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            let _this =  $(this)
            let deleteID = _this.attr('data-id');
            console.log(deleteID);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('dashboard/people/professional-delete') }}/" + deleteID,
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success' )
                            _this.closest('.single-profession').remove();
                        },
                        error: function(xhr, status, error) {
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                        }
                    });
                }
            })



        })

        $(document).on('click', '.removeBtn', function(e) {
            e.preventDefault();
            let _this =  $(this)

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Removed!', 'Removed Successfully', 'success' )
                    _this.closest('.single-profession').remove();
                }
            })



        })



        $(document).on('change', '.profession', function(e) {
            e.preventDefault();

            let _this = $(this);
            let profession_id = _this.val();
            let default_profession_type_option = '<option value="">Select Profession Type</option>';
            let _this_single_profession = _this.closest('.single-profession');
            let _this_profession_type = _this_single_profession.find('.profession_type');

            if (profession_id) {
                console.log("profession_id", profession_id);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profession-type-options-by-profession') }}/" + profession_id,
                    beforeSend: function() {
                        console.log("Searcing...");
                        _this_profession_type.html(default_profession_type_option);
                    },
                    success: function(response) {
                        _this_profession_type.html(response);
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        _this_profession_type.html(default_profession_type_option);
                    }
                });
            } else {
                _this_profession_type.html(default_profession_type_option);
            }
        })

        $(document).on('change', '.profession_type', function(e) {
            e.preventDefault();
            let profession_type_id = $(this).val();
            let option = '<option value="">Select Profession Category</option>';
            let _this = $(this).closest('.single-profession');
            let profession_category = _this.find(".profession_category");

            if (profession_type_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profession-category-options-by-profession-type') }}/" +
                        profession_type_id,
                    beforeSend: function() {
                        console.log("Searcing...");
                        profession_category.html(option);
                    },
                    success: function(response) {
                        profession_category.html(response);
                    },
                    error: function(xhr, status, error) {
                        profession_category.html(option);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                profession_category.html(option);
            }
        })

        $(document).on('change', '.profession_category', function(e) {
            e.preventDefault();
            let profession_category_id = $(this).val();
            let option = '<option value="">Select Profession Subategory</option>';
            let _this = $(this).closest('.single-profession');
            let profession_subcategory = _this.find(".profession_subcategory");

            if (profession_category_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profession-subcategory-options-by-profession-category') }}/" +
                        profession_category_id,
                    beforeSend: function() {
                        console.log("Searcing...");
                        profession_subcategory.html(option);
                    },
                    success: function(response) {
                        profession_subcategory.html(response);
                    },
                    error: function(xhr, status, error) {
                        profession_subcategory.html(option);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                profession_subcategory.html(option);
            }
        })
    </script>
@endpush
