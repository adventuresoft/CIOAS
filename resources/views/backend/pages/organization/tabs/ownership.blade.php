@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'OrganizationCreate'])

@section('title', 'Organization Create')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Organization Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('organization.index')}}">Organization</a></li>
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
    <h3 class="card-title">
        <a href="{{route('organization.edit', $organization->id)}}">
            <span class="text-dark">Organization Information</span>
        </a>
        <span class="text-secondary">|</span>
        <a href="{{route('organization-ownership.edit', $organization->id)}}">
            <span class="text-light">Ownership Information</span>
        </a>
    </h3>
</div>



<div class="card-body">

    {{-- ================= UNION OPTION ================= --}}
    <!--<div class="row mb-3">-->
    <!--    <label class="col-sm-3 col-form-label fw-bold">Is this Union?</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <label class="me-3">-->
    <!--            <input type="radio" name="is_union" value="no" > No-->
    <!--        </label>-->
    <!--        <label>-->
    <!--            <input type="radio" name="is_union" value="yes"> Yes-->
    <!--        </label>-->
    <!--    </div>-->
    <!--</div>-->

    {{-- ================= OWNERSHIP SECTION ================= --}}
    <div id="ownership-section" style="display:none">
        <form class="form-horizontal"   id="organizationOwnershipForm" method="POST" enctype="multipart/form-data" >
@csrf
<input type="hidden" name="organization_id" value="{{$organization->id}}">
        
        <div id="load-ownership">

            @if (count($organization->ownership))
                @foreach($organization->ownership as $ownership)
                    @include('backend.pages.organization.forms.ownership', ['ownership' => $ownership ]) 
                @endforeach
            @else
                @php $owner = $organization->no_of_owner ?? 1; @endphp

                @while ($owner > 0)
                    @include('backend.pages.organization.forms.ownership', ['ownership' => null ]) 
                    @php $owner--; @endphp
                @endwhile
            @endif

        </div>
        <div class="row">
    <a href="{{route('organization.edit', $organization->id)}}" class="btn btn-danger float-right">
        Organization Info
    </a>

    <div class="col-sm-9">
      <button type="submmit" class="btn btn-info">Submit</button>
    </div>
</div>
        </form>
    </div>

    {{-- ================= UNION SEARCH ================= --}}
    <div id="union-section" >
        <div class="row mb-3">
            <form id="ownershipForm" class="form-horizontal" action="{{route('savenewownership')}}" method="POST" enctype="multipart/form-data">
            
            <form id="ownershipForm" class="form-horizontal" action="javascript:void(0);" style="width:100%">
                            @csrf
                            
                            <input type="hidden" value="{{$organization->id}}" name="organization_id">
                            
                            <div class="card-body">
                                 <!--Row 1: Name and Bangla Name -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="name">Owner Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                        <input type="text" required value="" class="form-control" name="name" id="name" placeholder="Name English">
                                        <small class="error name-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="bn_name">Owner Name Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                        <input type="text" required value="" class="form-control" name="bn_name" id="bn_name" placeholder="Name Bangla">
                                        <small class="error bn_name-error text-danger"></small>
                                    </div>
                                </div>
                                
                                
                                 <!-- Row 2: Date of Birth, Birth Reg., NID No. --> 
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" value="" name="date_of_birth" class="form-control" id="date_of_birth">
                                        <small class="error date_of_birth-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="birth_certificate">Birth Reg. No.</label>
                                        <input type="text" value="" name="birth_certificate" placeholder="Birth Reg. No." class="form-control" id="birth_certificate">
                                        <small class="error birth_certificate-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="nid">NID No.</label>
                                        <input type="text" value="" name="nid" placeholder="NID No." class="form-control" id="nid">
                                        <span class="error nid-error text-danger"></span>
                                    </div>
                                </div>

                                 <!-- Row 3: Gender, Religion, Blood Group --> 
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            @if (count(people_constant_option('gender')))
                                                @foreach (people_constant_option('gender') as $key => $item)
                                                    <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error gender-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="religion">Religion</label>
                                        <select name="religion" class="form-control" id="religion">
                                            <option value="">Select Religion</option>
                                            @if (count($religions))
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error religion-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" class="form-control" id="blood_group">
                                            <option value="">Select Blood Group</option>
                                            @if (count(people_constant_option('blood_group')))
                                                @foreach (people_constant_option('blood_group') as $key => $item)
                                                    <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error blood_group-error text-danger"></small>
                                    </div>
                                </div>

                                 <!-- Row 4: Mobile No., Email -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="mobile">Mobile No.</label>
                                        <input type="tel" value="" name="mobile" placeholder="Mobile" class="form-control" id="mobile">
                                        <small class="error mobile-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">Email</label>
                                        <input type="email" required value="" name="email" placeholder="Email" class="form-control" id="email">
                                        <small class="error email-error text-danger"></small>
                                    </div>
                                </div>
                                
                                
                                 <!-- Father Name -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="father_name">Father Name (English)
                                            <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                                        </label>
                                        <input type="text" required class="form-control" name="father_name" id="father_name" placeholder="Father Name English">
                                        <small class="error father_name-error text-danger"></small>
                                    </div>
                                
                                    <div class="col-sm-6">
                                        <label for="father_name_bn">Father Name (Bangla)
                                            <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                                        </label>
                                        <input type="text" required class="form-control" name="father_name_bn" id="father_name_bn" placeholder="Father Name Bangla">
                                        <small class="error father_name_bn-error text-danger"></small>
                                    </div>
                                </div>
                                
                                 <!-- Mother Name -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="mother_name">Mother Name (English)
                                            <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                                        </label>
                                        <input type="text" required class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name English">
                                        <small class="error mother_name-error text-danger"></small>
                                    </div>
                                
                                    <div class="col-sm-6">
                                        <label for="mother_name_bn">Mother Name (Bangla)
                                            <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                                        </label>
                                        <input type="text" required class="form-control" name="mother_name_bn" id="mother_name_bn" placeholder="Mother Name Bangla">
                                        <small class="error mother_name_bn-error text-danger"></small>
                                    </div>
                                </div>
                                
                                 <!-- Permanent Address Section -->
                            <div class="card-header">
                                <h6 class="card-title p-0 m-0">Permanent Address</h6>
                            </div>
                            <div class="card-body p-0 m-0">
                                  <!-- Row 3: Division, District, Thana -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="permanent_division_id">Division</label>
                                        <select name="permanent_division_id" class="form-control select2 select2bs4" id="permanent_division_id">
                                            <option value="">Select Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" >{{ $division->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_division_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_district_id">District</label>
                                        <select name="permanent_district_id" class="form-control select2 select2bs4" id="permanent_district_id">
                                            <option value="{{$user->addressInfo->permanent_district_id ?? ''}}">{{$user->addressInfo->permanentDistrict->name ?? 'Select District'}}</option>
                                        </select>
                                        <small class="text-danger error present_district_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanentt_thana_id">Thana</label>
                                        <select name="permanent_thana_id" class="form-control select2 select2bs4" id="permanent_thana_id">
                                            <option value="{{$user->addressInfo->permanent_thana_id ?? ''}}">{{$user->addressInfo->permanentThana->name ?? 'Select Thana'}}</option>
                                        </select>
                                        <small class="text-danger error permanent_thana_id_error"></small>
                                    </div>
                                </div>
                                
                                 <!-- Row 1: Village, Post Office, Permanent Ward --> 
                                <div class="form-group row">
                                     <div class="col-sm-4">
                                         <label for="permanent_post_office_id">Post Office</label>
                                        <select name="permanent_post_office_id" class="form-control select2 select2bs4" id="permanent_post_office_id">
                                            <option value="">Select Post Office</option>
                                            @if ($post_officeses)
                                                @foreach ($post_officeses as $post_officese)
                                                    <option value="{{$post_officese->id}}" >{{$post_officese->bn_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_post_office_id_error"></small>
                                    </div>
                                    
                                      <!--<div class="col-sm-4">
                                        <label for="permanent_union_id">UP (Union Parishad)</label>
                                        <select name="permanent_union_id" class="form-control select2 select2bs4" id="permanent_union_id">
                                            <option value="{{$user->addressInfo->permanent_union_id ?? ''}}">{{$user->addressInfo->permanentUnion->name ?? 'Select Union'}}</option>
                                        </select>
                                        <small class="text-danger error present_union_id_error"></small>
                                    </div>-->
                                    
                                    
                                    <div class="col-sm-4">
                                        <label for="permanent_village_id">Village</label>
                                        <select name="permanent_village_id" class="form-control select2 select2bs4" id="permanent_village_id">
                                            <option value="">Select Village</option>
                                            @if ($villages)
                                                @foreach ($villages as $village)
                                                    <option value="{{$village->id}}" >{{$village->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_village_id_error"></small>
                                    </div>
                                    </div>
                                   <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="permanent_ward_id">Permanent Ward</label>
                                        <select name="permanent_ward_id" class="form-control select2 select2bs4" id="permanent_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" >{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_ward_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="permanent_road">Road</label>
                                        <input type="text" name="permanent_road" class="form-control" id="permanent_road"
                                            value="{{ $user->addressInfo->permanent_road ?? '' }}" placeholder="Permanent Road">
                                        <small class="text-danger error permanent_road_error"></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="permanent_house">Holding/House No.</label>
                                        <input type="text" name="permanent_house" class="form-control" id="permanent_house"
                                            value="{{ $user->addressInfo->permanent_house ?? '' }}" placeholder="Permanent House">
                                        <small class="text-danger error permanent_house_error"></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="permanent_house_bn">Holding/House No. (Bangla)</label>
                                        <input type="text" name="permanent_house_bn" class="form-control" id="permanent_house_bn"
                                            value="{{ $user->addressInfo->permanent_house_bn ?? '' }}" placeholder="স্থায়ী বাড়ি">
                                        <small class="text-danger error permanent_house_bn_error"></small>
                                    </div>
                                </div>
                                </div>

                                 <!-- Row 2:  -->
                              
                                    <div class="form-group row">
                            </div>

                             <!-- Present Address Section -->
                            <div class="card-header">
                                <h6 class="card-title p-0 m-0">Present Address</h6>
                            </div>
                            <div class="card-body p-0 m-0">
                                 <!--Row 3: Division, District, Thana -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="present_division_id">Division</label>
                                        <select name="present_division_id" class="form-control select2 select2bs4" id="present_division_id">
                                            <option value="">Select Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" >{{ $division->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_division_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_district_id">District</label>
                                        <select name="present_district_id" class="form-control select2 select2bs4" id="present_district_id">
                                            <option value="{{$user->addressInfo->present_district_id ?? ''}}">{{$user->addressInfo->presentDistrict->name ?? 'Select District'}}</option>
                                        </select>
                                        <small class="text-danger error present_district_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="present_thana_id">Thana</label>
                                        <select name="present_thana_id" class="form-control select2 select2bs4" id="present_thana_id">
                                            <option value="{{$user->addressInfo->present_thana_id ?? ''}}">{{$user->addressInfo->presentThana->name ?? 'Select Thana'}}</option>
                                        </select>
                                        <small class="text-danger error present_thana_id_error"></small>
                                    </div>
                                </div>

                                 <!--Row 4: Post Office, UP, Village--> 
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="present_post_office_id">Post Office</label>
                                        <select name="present_post_office_id" class="form-control select2 select2bs4" id="present_post_office_id">
                                            <option value="">Select Post Office</option>
                                            @if ($post_officeses)
                                                @foreach ($post_officeses as $post_officese)
                                                    <option value="{{$post_officese->id}}" >{{$post_officese->bn_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_post_office_id_error"></small>
                                    </div>
                                    <!--<div class="col-sm-4">
                                        <label for="present_union_id">UP (Union Parishad)</label>
                                        <select name="present_union_id" class="form-control select2 select2bs4" id="present_union_id">
                                            <option value="{{$user->addressInfo->present_union_id ?? ''}}">{{$user->addressInfo->presentUnion->name ?? 'Select Union'}}</option>
                                        </select>
                                        <small class="text-danger error present_union_id_error"></small>
                                    </div>-->
                                    <div class="col-sm-4">
                                        <label for="present_village_id">Village</label>
                                        <select name="present_village_id" class="form-control select2 select2bs4" id="present_village_id">
                                            <option value="{{$user->addressInfo->present_village_id ?? ''}}">{{$user->addressInfo->presentVillage->en_name ?? 'Select Village'}}</option>
                                        </select>
                                        <small class="text-danger error present_village_id_error"></small>
                                    </div>
                                </div>

                                 <!-- Row 5: Ward, Road, House -->
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="present_ward_id">Ward</label>
                                        <select name="present_ward_id" class="form-control select2 select2bs4" id="present_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" >{{$ward->en_ward_no}}</option>
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
                                    <div class="col-sm-3">
                                        <label for="present_house">House</label>
                                        <input type="text" name="present_house" class="form-control" id="present_house"
                                             placeholder="Present House">
                                        <small class="text-danger error present_house_error"></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="present_house_bn">House (Bangla)</label>
                                        <input type="text" name="present_house_bn" class="form-control" id="present_house_bn"
                                            placeholder="বর্তমান বাড়ি">
                                        <small class="text-danger error present_house_bn_error"></small>
                                    </div>
                                </div>

                                 <!-- Row 5: Photo --> 
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="image">Photo</label>
                                        <input type="file" name="image" class="image form-control-file" id="image">
                                        <span class="error image-error text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('no-image-found.jpeg') }}" id="preview" alt="Preview" width="100" height="100">
                                    </div>
                                </div>

                        
                          
                            
                            
                              
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                         <a href="{{route('organization.edit', $organization->id)}}" class="btn btn-danger float-right">
        Organization Info
    </a>

                                       
                                        <button type="submit" class="btn btn-info">Save</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
        </div>
    </div>

</div>

<div class="card-footer">

@if ($organization->organization_ownership_type_id == 2)
<div class="row mb-1" id="add-owner-section">
    <div class="col-sm-3">
        <button type="button" id="addMoreOwner" class="btn btn-primary">
            Add More Owner
        </button>
    </div>
</div>

@endif


</div>
<!--</form>-->

</div>
</div>
</div>

</div>
</section>

@endsection


@push('script')

<script>
$("#ownershipForm").on('submit', function(e) {
    e.preventDefault();

    let thisForm = $(this);

    $.ajax({
        type: "POST",
        url: "{{route('savenewownership')}}", // ðŸ”¥ CHANGE THIS
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
        },

        error: function(xhr) {
            thisForm.find('button[type="submit"]').prop("disabled",false);

            let res = JSON.parse(xhr.responseText);
            toastr.error(res.message);
        }
    });
});


</script>
<script>

$(document).ready(function() {

    $(".select2").select2();

    // ================= FORM SUBMIT =================
    $("#organizationOwnershipForm").on('submit', function(e) {
        e.preventDefault();

        let thisForm = $(this);

        $.ajax({
            type: "POST",
            url: "{{route('organization-ownership.store')}}",
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
            },

            error: function(xhr) {
                thisForm.find('button[type="submit"]').prop("disabled",false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
            }
        });
    });


    // ================= UNION TOGGLE =================
   $(document).on('change', 'input[name="is_union"]', function(){

    let value = $(this).val();

    if(value === 'yes'){
        // YES = SHOW OWNERSHIP
        $('#ownership-section').show();
        $('#union-section').hide();
        $('#add-owner-section').show();

    }else if(value === 'no'){
        // NO = SHOW UNION SEARCH
        $('#ownership-section').hide();
        $('#union-section').show();
        $('#add-owner-section').hide();
    }

});

});


// ================= ADD OWNER =================
$(document).on('click', '#addMoreOwner', function(e){
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: "{{ url('/organization-single-ownership-form') }}",
        success: function(response) {
            $('#load-ownership').append(response)
        }
    });
});


// ================= REMOVE OWNER =================
$(document).on('click', '.remove-single-ownership', function(){

    let _this = $(this);

    if (confirm("Are you sure?")){

        let id = _this.attr('data-id');

        if (id) {
            $.get("{{ url('/organization-ownership-remove') }}/"+id, function(){
                _this.closest('.signle-ownership').remove();
            });
        } else {
            _this.closest('.signle-ownership').remove();
        }
    }

});


// ================= FIND USER =================
$(document).on('click', '.find_user_info', function(e){

    e.preventDefault();

    let _this = $(this);
    let row = _this.closest('.row');
    let system_id = row.find('.system_id').val();
    let container = _this.closest('.user_info');

    if(system_id){

        $.get("{{ url('search-user-by-system-id') }}/"+system_id, function(response){

            container.find('.user_info_table').removeClass('d-none');
            container.find('.user_name').val(response.user.people.bn_name);
            container.find('.user_id').val(response.user.id);

        });

    }else{
        alert("System ID required");
    }

});


// ================= TRADE CHECK =================
$(document).on('change', '.trade-checkbox', function(){

    let hidden = $(this).closest('.trade-license-checkbox').find('.trade-hidden-check');

    if($(this).is(':checked')){
        hidden.prop("disabled", true);
    }else{
        hidden.prop("disabled", false);
    }

});


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
        
        
        // ------------ parmanent info --------------------
        
        $(document).on('change', '#permanent_division_id', function(e){
            e.preventDefault();
            let district_id = $('#permanent_district_id');
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
        $(document).on('change', '#permanent_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let present_thana_id = $("#permanent_thana_id");
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
        $(document).on('change', '#permanent_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let present_union_id = $('#permanent_union_id');
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
        $(document).on('change', '#permanent_union_id', function(e){
            e.preventDefault();
            let present_union_id = $(this).val();
            let present_village_id = $('#permanent_village_id');
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