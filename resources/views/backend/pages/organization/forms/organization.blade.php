<div class="card-body">
    {{-- Name, Bangla Name --}}
    <div class="form-group row">
        <div class="col-sm-6">
        <label for="name">Name</label>
            <input type="text" required name="name" value="{{ $organization->name ?? '' }}" placeholder="Organization Name"
                class="form-control" id="name">
        </div>
        <div class="col-sm-6">
        <label for="bn_name">Name (Bangla)</label>
            <input type="text" name="bn_name" value="{{ $organization->bn_name ?? '' }}"
                placeholder="Organization Name Bangla" class="form-control" id="bn_name">
        </div>
    </div>

    {{-- Category, Subcategory, Work Area --}}
    <div class="form-group row">
        <div class="col-sm-4">
        <label for="organization_category_id">Category</label>
            <select  class="form-control select2" name="organization_category_id" id="organization_category_id">
                <option value=""> Category</option>
                @if (count($categories))
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($organization->organization_category_id) ? ($organization->organization_category_id == $category->id ? 'selected' : '') : '' }}>
                            {{ $category->en_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-4">
        <label for="organization_subcategory_id">Sub Category</label>
            <select  class="form-control select2" name="organization_subcategory_id"
                id="organization_subcategory_id">
                @if (isset($organization->organization_subcategory_id))
                    <option value="{{ $organization->organization_subcategory_id }}">
                        {{ $organization->subcategory->en_name }}</option>
                @endif
            </select>
        </div>
        <div class="col-sm-4">
        <label for="organization_type_id">Type</label>
            <select  class="form-control select2" name="organization_type_id" id="organization_type_id">
                @if (isset($organization->type))
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{$organization->type->id == $type->id ? 'selected' : '' }}>{{$type->en_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    
    {{-- Organization Type, RJSC Reg., Capital, Established Year, Application Type --}}
    <div class="form-group row">
        <div class="col-sm-4">
        <label for="rjsc_reg_no">RJSC Reg.</label>
            <input type="text" name="rjsc_reg_no" value="{{ $organization->rjsc_reg_no ?? '' }}"
                placeholder="RJSC Reg. No." class="form-control" id="rjsc_reg_no">
        </div>
         <div class="col-sm-4">
        <label for="capital">Capital</label>
            <input type="number" name="capital" value="{{ $organization->capital ?? '' }}" placeholder="Capital"
                class="form-control" id="capital">
        </div>
         <div class="col-sm-2">
        <label for="establish_year">Est. Year</label>
            <input type="number" min="1900" max="{{ date('Y') }}" 
                step="1" name="establish_year" value="{{ $organization->establish_year ?? date('Y') }}"
                placeholder="Established Year " class="form-control" id="establish_year">
        </div>
         <div class="col-sm-2">
        <label for="application_type">Application Type</label>
            <select  class="form-control select2" name="application_type" id="application_type">
                <option value="new"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'new' ? 'selected' : '') : '' }}>
                    NEW</option>
                <option value="old"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'old' ? 'selected' : '') : '' }}>
                    OLD</option>
            </select>
        </div>
    </div>


    <!-- {{-- Village --}}-->
    <!-- <div class="form-group row">-->
    <!--    <label for="village_id" class="col-sm-2 col-form-label">Village</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <select class="form-control" id="village_id" name="village_id">-->
    <!--            <option value="">Select Village</option>-->
    <!--            @if (count($villages))-->
    <!--                @foreach ($villages as $village)-->
    <!--                    <option value="{{$village->id}}">{{$village->en_name}}</option>-->
    <!--                @endforeach-->
    <!--            @endif-->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->

    <!-- {{-- Ward No. --}}-->
    <!-- <div class="form-group row">-->
    <!--    <label for="ward_no_id" class="col-sm-2 col-form-label">Ward No.</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <select  class="form-control select2" name="union_ward_id" id="ward_no_id">-->
    <!--            <option value="">Ward No.</option>-->
    <!--            @if (count($wards))-->
    <!--                @foreach ($wards as $ward)-->
    <!--                    <option value="{{ $ward->id }}"-->
    <!--                        {{ isset($organization->union_ward_id) ? ($organization->union_ward_id == $ward->id ? 'selected' : '') : '' }}>-->
    <!--                        {{ $ward->en_ward_no }}</option>-->
    <!--                @endforeach-->
    <!--            @endif-->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->

    <!--{{-- Area --}}-->
    <!--<div class="form-group row">-->
    <!--    <label for="village_area_id" class="col-sm-2 col-form-label">Area</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <select class="form-control" id="village_area_id" name="village_area_id">-->
    <!--            <option value="">Select Village Area</option>-->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->

    <!-- {{-- Road --}}-->
    <!-- <div class="form-group row">-->
    <!--    <label for="road_id" class="col-sm-2 col-form-label">Road</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <select  class="form-control select2" name="road_id" id="road_id">-->
    <!--            <option value="">Select Road</option>-->
    <!--            @if (count($roads))-->
    <!--                @foreach ($roads as $road)-->
    <!--                    <option value="{{ $road->id }}"-->
    <!--                        {{ isset($organization->road_id) ? ($organization->road_id == $road->id ? 'selected' : '') : '' }}>-->
    <!--                        {{ $road->name }}</option>-->
    <!--                @endforeach-->
    <!--            @endif-->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->

    <!--{{-- House --}}-->
    <!--<div class="form-group row">-->
    <!--    <label for="house_id" class="col-sm-2 col-form-label">House</label>-->
    <!--    <div class="col-sm-9">-->
    <!--        <select  class="form-control select2" name="house_id" id="house_id">-->
    <!--            @if (isset($organization->house_id))-->
    <!--                <option value="{{ $organization->house_id }}">{{ $organization->house->en_name }}</option>-->
    <!--            @endif-->
    <!--        </select>-->
    <!--    </div>-->
    <!--</div>-->
    
    
    
    
    <div class="form-group row">
                                    <div class="col-sm-4">
                                    <label for="division_id">Division</label>
                                        <select name="division_id" class="form-control select2 select2bs4"
                                            id="division_id">
                                            <option value="">Select Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{isset($organization->division_id)  && $organization->division_id == $division->id ? 'selected' : ''}}>{{ $division->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error division_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label for="district_id">District</label>
                                        <select name="district_id" class="form-control select2 select2bs4"
                                            id="district_id">
                                            
                                             @if (isset ($districts))
                                                @foreach ($districts as $district)
                                            <option value="{{$organization->district_id ?? ''}}" {{isset($organization->district_id)  && $organization->district_id == $district->id ? 'selected' : ''}}>{{$district->name ?? 'Select District'}}</option>
                                                  @endforeach
                                            @endif
                                            
                                        </select>

                                        <small class="text-danger error district_id_error"></small>

                                    </div>
                                    <div class="col-sm-4">
                                    <label for="thana_id">Thana</label>
                                        <select name="thana_id" class="form-control select2 select2bs4"
                                            id="thana_id">
                                                @if (isset($thanas))
                                                @foreach ($thanas as $thana)
                                                     <option {{isset($organization->thana_id)  && $organization->thana_id == $thana->id ? 'selected' : ''}} value="{{$organization->thana_id ?? ''}}">{{$thana->name ?? 'Select Thana'}}</option>
                                             @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error thana_id_error"></small>

                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <div class="col-sm-4">
                                    <label for="post_office_id">Post Office</label>
                                        <select name="post_office_id" class="form-control select2 select2bs4" id="post_office_id">
                                            <option value="">Select Post Office</option>
                                            @if ($post_officeses)
                                                @foreach ($post_officeses as $post_officese)
                                                    <option value="{{$post_officese->id}}" {{isset($organization->post_office_id) ? ($organization->post_office_id == $post_officese->id ? 'selected' : '' ) : ''}}>{{$post_officese->bn_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_village_id_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                    <label for="village_id">Village</label>
                                        <select name="village_id"  class="form-control select2 select2bs4" id="village_id">
                                              @if ($villages)
                                                @foreach ($villages as $village)
                                            <option value="{{$organization->village_id ?? ''}}" {{isset($organization->village_id)  && $organization->village_id == $village->id ? 'selected' : ''}} >{{$village->bn_name ?? 'Select Village'}}</option>
                                             @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error village_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                    <label for="ward_id">Ward</label>
                                        <select name="ward_id" class="form-control select2 select2bs4"
                                            id="ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" {{isset($organization->ward_id) ? (( $organization->ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error ward_id_error"></small>

                                    </div>
                                    <div class="col-sm-3">
                                    <label for="road">Road</label>
                                        <input type="text" name="road" class="form-control" id="road"
                                            value="{{ $organization->road ?? '' }}" placeholder="Present Road">

                                            <small class="text-danger error road_error"></small>
                                    </div>
                                    <div class="col-sm-3">
                                    <label for="house" >House/Holding No.</label>
                                        <input type="text" name="house" class="form-control" id="house"
                                            value="{{ $organization->house ?? '' }}" placeholder="Present House">

                                            <small class="text-danger error house_error"></small>
                                    </div>
                                    <div class="col-sm-3">
                                    <label for="house" >House/Holding No. (Bangla)</label>
                                        <input type="text" name="house_bn" class="form-control" id="house"
                                            value="{{ $organization->house_bn ?? '' }}" placeholder="Present House Bangla">

                                            <small class="text-danger error house_error"></small>
                                    </div>
                                </div>
  
</div>

@push('script')

<script>
    $(document).on('change', '#organization_ownership_type_id', function(e){
        e.preventDefault();
        if($(this).val() == 2 ){
            $('.number_of_owner').removeClass('d-none');
        }else {
            $('.number_of_owner').removeClass('d-none').addClass('d-none');
        }
    })

    $(document).on('change', '#organization_category_id', function(e){
      e.preventDefault();
      let _this_value = $(this).val();
      if(_this_value){
          $.ajax({
              type: "GET",
              url: "{{ url('organization-subcategory-options') }}/"+_this_value,
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
          $.ajax({
            type: "GET",
            url: "{{ url('organization-type-options') }}/"+_this_value,
            beforeSend: function() {
                $('#organization_type_id').prop("disabled", true);
                console.log("Searcing organization type");
            },
            success: function(response) {
                $('#organization_type_id').html(response)
                $('#organization_type_id').prop("disabled", false);
            },
            error: function(xhr, status, error) {
                $('#organization_type_id').prop("disabled", false);
                var responseText = jQuery.parseJSON(xhr.responseText);
                toastr.error(responseText.message);
            }
          });
      }
    })
    
    $(document).on('change', '#organization_subcategory_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('organization-work-area-options') }}/"+_this_value,
                beforeSend: function() {
                    $('#organization_work_area_id').prop("disabled", true);
                    console.log("Searcing Work Area");
                },
                success: function(response) {
                    $('#organization_work_area_id').html(response)
                    $('#organization_work_area_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }
    })

     $(document).on('change', '#division_id', function(e){
                e.preventDefault();
                let district_id = $('#district_id')
                let division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/"+division_id,
                        beforeSend: function() {
                            district_id.prop("disabled", true);
                            console.log("Searcing Districts");
                        },
                        success: function(response) {
                            district_id.html(response)
                            district_id.prop("disabled", false);
                        },
                        error: function(xhr, status, error) {
                            district_id.prop("disabled", true);
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                        }

                    });
                } else {
                    district_id.prop("disabled", true);
                }
        })

        $(document).on('change', '#district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#thana_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function(response) {
                        thana_id.html(response)
                        thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                thana_id.prop("disabled", true);
            }
            
        })

        $(document).on('change', '#thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let union_id = $('#union_id');
            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        union_id.prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function(response) {
                        union_id.html(response)
                        union_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        union_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                union_id.prop("disabled", true);
            }
        })
        

        $(document).on('change', '#union_id', function(e){
            e.preventDefault();
            let union_id = $(this).val();
            let village_id = $('#village_id');
            if (union_id) {
                $.ajax({
                    type: "GET",

                    url: "{{ url('/get-villages-by-union') }}/"+union_id,
                    beforeSend: function() {
                        village_id.prop("disabled", true);
                        console.log("Searcing Villege");
                    },
                    success: function(response) {
                        village_id.html(response.villageOptions)
                        village_id.prop("disabled", false);
                        $("#road").html(response.roadOptions);
                    },
                    error: function(xhr, status, error) {
                        village_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                village_id.prop("disabled", true);
            }

        })

       
        $(document).on('change', '#permanent_village_id', function(e){
            e.preventDefault();
            let permanent_village_area = $('#permanent_village_area_id')
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                    beforeSend: function() {
                        permanent_village_area.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        permanent_village_area.html(response)
                        permanent_village_area.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        permanent_village_area.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#village_id', function(e){
            e.preventDefault();
            let village_area_id = $('#village_area_id')
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                    beforeSend: function() {
                        village_area_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        village_area_id.html(response)
                        village_area_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        village_area_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district_id.prop("disabled", true);
            }
        })
</script>
    
@endpush
