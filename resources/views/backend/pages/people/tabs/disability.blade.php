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
                            <h3 class="card-title">
                                @include('backend.pages.people.tabs.tab_header', [
                                    'user' => $user,
                                    'active_tab' => 'disability',
                                ])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleDisabilityForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">


                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="disability_status" class="col-sm-2 col-form-label">Any Disability?</label>
                                    <div class="col-sm-10 px-2">
                                        <label for="disabilty-no">
                                            <input type="radio" value="0" {{(isset($user->disabilityInfo->is_disability) ?  (($user->disabilityInfo->is_disability == 0) ? 'checked' : '')  : 'checked')}} id="disabilty-no"
                                                name="is_disability">
                                            No
                                        </label>

                                        <label for="disabilty-yes">
                                            <input type="radio" value="1" {{(isset($user->disabilityInfo->is_disability) ?  (($user->disabilityInfo->is_disability == 1) ? 'checked' : '')  : '')}} id="disabilty-yes" name="is_disability">
                                            Yes
                                        </label>
                                        <small class="text-danger error is_disability_error"></small>

                                    </div>
                                </div>

                                <div class="disability-content {{(isset($user->disabilityInfo->is_disability) ?  (($user->disabilityInfo->is_disability == 1) ? '' : 'd-none')  : 'd-none')}}">


                                    <div class="form-group row">
                                        <label for="disability_name_id" class="col-sm-2 col-form-label">Disability Name</label>
                                        <div class="col-sm-10">
                                            <select name="disability_name_id" class="form-control" id="disability_name_id">
                                                <option value="">Select Disability Name</option>
                                                @foreach (disability_constant_option('disability_name') as $key=>$item)
                                                    <option value="{{$key}}" {{isset($user->disabilityInfo->disability_name_id) ? (($user->disabilityInfo->disability_name_id == $key) ? 'selected' : '' ) : ''  }}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger error disability_name_id_error"></small>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="disability_category_id" class="col-sm-2 col-form-label">Disability
                                            Category</label>
                                        <div class="col-sm-10">
                                            <select name="disability_category_id" class="form-control"
                                                id="disability_category_id">
                                                <option value="">Select Disability Category</option>
                                                @foreach (disability_constant_option('disability_category') as $key=>$item)
                                                    <option value="{{$key}}" {{isset($user->disabilityInfo->disability_category_id) ? (($user->disabilityInfo->disability_category_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger error disability_category_id_error"></small>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="disability_type_id" class="col-sm-2 col-form-label">Disability type</label>
                                        <div class="col-sm-10">
                                            <select name="disability_type_id" class="form-control" id="disability_type_id">
                                                @foreach (disability_constant_option('disability_type') as $key=>$item)
                                                    <option value="{{$key}}" {{isset($user->disabilityInfo->disability_type_id) ? (($user->disabilityInfo->disability_type_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger error disability_type_id_error"></small>

                                        </div>
                                    </div>

                                    <div class="form-group disability-date-content {{isset($user->disabilityInfo->disability_type_id) ? (($user->disabilityInfo->disability_type_id != 1 ) ? '' : 'd-none' ) : 'd-none'  }} row" id="disability-date-content">
                                        <label for="start_date" class="col-sm-2 col-form-label">Disability Start
                                            Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="start_date" value="{{$user->disabilityInfo->start_date ?? ''}}" class="form-control"
                                                id="start_date">
                                                <small class="text-danger error start_date_error"></small>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="treatment_status_id" class="col-sm-2 col-form-label">Treatment
                                            Status</label>
                                        <div class="col-sm-10">
                                            <select name="treatment_status_id" class="form-control" id="treatment_status_id">
                                                @foreach (disability_constant_option('treatment_status') as $key => $item)
                                                    <option value="{{$key}}"  {{isset($user->disabilityInfo->treatment_status_id) ? (($user->disabilityInfo->treatment_status_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger error treatment_status_id_error"></small>

                                        </div>
                                    </div>

                                    <div class="form-group treatment-doctor-content {{isset($user->disabilityInfo->treatment_status_id) ? (($user->disabilityInfo->treatment_status_id != 1 ) ? '' : 'd-none' ) : 'd-none'  }} row">
                                        <label for="disability_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="disability_doctor" value="{{$user->disabilityInfo->disability_doctor ?? ''}}"
                                                placeholder="Dr. Name/ID" class="form-control" id="disability_doctor">

                                                <small class="text-danger error disability_doctor_error"></small>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.property', $user->id) }}"
                                            class="btn btn-danger btn-block">Property</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>

                                    <div class="col-sm-3">
                                        <a href="{{ route('people.freedom', $user->id) }}"
                                            class="btn btn-primary btn-block ">Freedom Fighter</a>
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
            $("#peopleDisabilityForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.disabilityStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
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
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('change', 'input[type=radio][name=is_disability]', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (parseInt(_this_value)) {
                $(".disability-content").removeClass('d-none');
            } else {
                $(".disability-content").removeClass('d-none').addClass('d-none');
            }
        })

        $(document).on('change', '#treatment_status_id', function(e) {
            e.preventDefault();

            let _this_value = $(this).val();
            if (parseInt(_this_value) !== 1) {
                $(".treatment-doctor-content").removeClass('d-none');
            } else {
                $(".treatment-doctor-content").removeClass('d-none').addClass('d-none');
            }
        })

        $(document).on('change', '#disability_type_id', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            console.log(_this_value);
            if (parseInt(_this_value) == 1) {
                $("#disability-date-content").removeClass('d-none').addClass('d-none');
            } else {
                $("#disability-date-content").removeClass('d-none');

            }
        })

    </script>
   
@endpush
