@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Address Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
                        <li class="breadcrumb-item active">Address</li>
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
                                'active_tab' => 'address',
                            ])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleAddressForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            
                            <!-- Permanent Address Section -->
                            <div class="card-header">
                                <h6 class="card-title">Permanent Address</h6>
                            </div>
                            <div class="card-body">
                                <!-- Row 1: Village, Post Office, Permanent Ward -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="permanent_village_id">Village</label>
                                        <select name="permanent_village_id" class="form-control select2 select2bs4" id="permanent_village_id">
                                            <option value="">Select Village</option>
                                            @if ($villages)
                                                @foreach ($villages as $village)
                                                    <option value="{{$village->id}}" {{$user->addressInfo ? ($user->addressInfo->permanent_village_id == $village->id ? 'selected' : '' ) : ''}}>{{$village->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_village_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_post_office_id">Post Office</label>
                                        <select name="permanent_post_office_id" class="form-control select2 select2bs4" id="permanent_post_office_id">
                                            <option value="">Select Post Office</option>
                                            @if ($post_officeses)
                                                @foreach ($post_officeses as $post_officese)
                                                    <option value="{{$post_officese->id}}" {{$user->addressInfo ? ($user->addressInfo->permanent_post_office_id == $post_officese->id ? 'selected' : '' ) : ''}}>{{$post_officese->bn_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_post_office_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_ward_id">Permanent Ward</label>
                                        <select name="permanent_ward_id" class="form-control select2 select2bs4" id="permanent_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" {{$user->addressInfo ? (($user->addressInfo->permanent_ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_ward_id_error"></small>
                                    </div>
                                </div>

                                <!-- Row 2: Road, House, House (Bangla) -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="permanent_road">Road</label>
                                        <input type="text" name="permanent_road" class="form-control" id="permanent_road"
                                            value="{{ $user->addressInfo->permanent_road ?? '' }}" placeholder="Permanent Road">
                                        <small class="text-danger error permanent_road_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_house">House</label>
                                        <input type="text" name="permanent_house" class="form-control" id="permanent_house"
                                            value="{{ $user->addressInfo->permanent_house ?? '' }}" placeholder="Permanent House">
                                        <small class="text-danger error permanent_house_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_house_bn">House (Bangla)</label>
                                        <input type="text" name="permanent_house_bn" class="form-control" id="permanent_house_bn"
                                            value="{{ $user->addressInfo->permanent_house_bn ?? '' }}" placeholder="স্থায়ী বাড়ি">
                                        <small class="text-danger error permanent_house_bn_error"></small>
                                    </div>
                                </div>
                            </div>

                            <!-- Present Address Section -->
                            <div class="card-header">
                                <h6 class="card-title">Present Address</h6>
                            </div>
                            <div class="card-body">
                                <!-- Row 3: Division, District, Thana -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="present_division_id">Division</label>
                                        <select name="present_division_id" class="form-control select2 select2bs4" id="present_division_id">
                                            <option value="">Select Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{$user->addressInfo ? ($user->addressInfo->present_division_id == $division->id ? 'selected' : '') : ''}}>{{ $division->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_division_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_district_id">District</label>
                                        <select name="present_district_id" class="form-control select2 select2bs4" id="present_district_id">
                                            <option value="{{$user->addressInfo->present_district_id ?? ''}}">{{$user->addressInfo?->presentDistrict?->name ?? 'Select District'}}</option>
                                        </select>
                                        <small class="text-danger error present_district_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_thana_id">Thana</label>
                                        <select name="present_thana_id" class="form-control select2 select2bs4" id="present_thana_id">
                                            <option value="{{$user->addressInfo->present_thana_id ?? ''}}">{{$user->addressInfo?->presentThana?->name ?? 'Select Thana'}}</option>
                                        </select>
                                        <small class="text-danger error present_thana_id_error"></small>
                                    </div>
                                </div>

                                <!-- Row 4: Post Office, UP, Village -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="present_post_office_id">Post Office</label>
                                        <select name="present_post_office_id" class="form-control select2 select2bs4" id="present_post_office_id">
                                            <option value="">Select Post Office</option>
                                            @if ($post_officeses)
                                                @foreach ($post_officeses as $post_officese)
                                                    <option value="{{$post_officese->id}}" {{$user->addressInfo ? ($user->addressInfo->present_post_office_id == $post_officese->id ? 'selected' : '' ) : ''}}>{{$post_officese->bn_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_post_office_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_union_id">UP (Union Parishad)</label>
                                        <select name="present_union_id" class="form-control select2 select2bs4" id="present_union_id">
                                            <option value="{{$user->addressInfo->present_union_id ?? ''}}">{{$user->addressInfo?->presentUnion?->name ?? 'Select Union'}}</option>
                                        </select>
                                        <small class="text-danger error present_union_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_village_id">Village</label>
                                        <select name="present_village_id" class="form-control select2 select2bs4" id="present_village_id">
                                            @if($present_villages)
                                            @foreach($present_villages as $village)
                                            <option {{$user->addressInfo->present_village_id ==$village->id?'selected':''}} value="{{$village->id}}">{{$village->en_name ?? 'Select Village'}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_village_id_error"></small>
                                    </div>
                                </div>

                                <!-- Row 5: Ward, Road, House -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="present_ward_id">Ward</label>
                                        <select name="present_ward_id" class="form-control select2 select2bs4" id="present_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" {{$user->addressInfo ? (($user->addressInfo->present_ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_ward_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_road">Road</label>
                                        <input type="text" name="present_road" class="form-control" id="present_road"
                                            value="{{ $user->addressInfo->present_road ?? '' }}" placeholder="Present Road">
                                        <small class="text-danger error present_road_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_house">House</label>
                                        <input type="text" name="present_house" class="form-control" id="present_house"
                                            value="{{ $user->addressInfo->present_house ?? '' }}" placeholder="Present House">
                                        <small class="text-danger error present_house_error"></small>
                                    </div>
                                </div>

                                <!-- Row 6: House (Bangla) -->
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="present_house_bn">House (Bangla)</label>
                                        <input type="text" name="present_house_bn" class="form-control" id="present_house_bn"
                                            value="{{ $user->addressInfo->present_house_bn ?? '' }}" placeholder="বর্তমান বাড়ি">
                                        <small class="text-danger error present_house_bn_error"></small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Footer with Navigation -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <a href="{{ route('people.family', $user->id) }}" class="btn btn-danger btn-block">
                                            <i class="fas fa-arrow-left"></i> Family
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fas fa-save"></i> Save & Next
                                        </button>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{ route('people.education', $user->id) }}" class="btn btn-primary btn-block">
                                            Education <i class="fas fa-arrow-right"></i>
                                        </a>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Initialize select2
            $('.select2').select2();
            
            $("#peopleAddressForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.addressStore') }}",
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
            });
        });

        // Present Address - Division change handler
        $(document).on('change', '#present_division_id', function(e){
            e.preventDefault();
            let district_id = $('#present_district_id');
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/"+division_id,
                    beforeSend: function() {
                        district_id.prop("disabled", true);
                        district_id.html('<option value="">Loading...</option>');
                    },
                    success: function(response) {
                        district_id.html(response);
                        district_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        district_id.prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                district_id.html('<option value="">Select District</option>');
                district_id.prop("disabled", true);
            }
        });

        // Present Address - District change handler
        $(document).on('change', '#present_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let present_thana_id = $("#present_thana_id");
            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        present_thana_id.prop("disabled", true);
                        present_thana_id.html('<option value="">Loading...</option>');
                    },
                    success: function(response) {
                        present_thana_id.html(response);
                        present_thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_thana_id.prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_thana_id.html('<option value="">Select Thana</option>');
                present_thana_id.prop("disabled", true);
            }
        });

        // Present Address - Thana change handler
        $(document).on('change', '#present_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let present_union_id = $('#present_union_id');
            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        present_union_id.prop("disabled", true);
                        present_union_id.html('<option value="">Loading...</option>');
                    },
                    success: function(response) {
                        present_union_id.html(response);
                        present_union_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_union_id.prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_union_id.html('<option value="">Select Union</option>');
                present_union_id.prop("disabled", true);
            }
        });

        // Present Address - Union change handler
        $(document).on('change', '#present_union_id', function(e){
            e.preventDefault();
            let present_union_id = $(this).val();
            let present_village_id = $('#present_village_id');
            if (present_union_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-union') }}/"+present_union_id,
                    beforeSend: function() {
                        present_village_id.prop("disabled", true);
                        present_village_id.html('<option value="">Loading...</option>');
                    },
                    success: function(response) {
                        present_village_id.html(response.villageOptions);
                        present_village_id.prop("disabled", false);
                        if(response.roadOptions) {
                            $("#present_road").html(response.roadOptions);
                        }
                    },
                    error: function(xhr, status, error) {
                        present_village_id.prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_village_id.html('<option value="">Select Village</option>');
                present_village_id.prop("disabled", true);
            }
        });
    </script>
@endpush
