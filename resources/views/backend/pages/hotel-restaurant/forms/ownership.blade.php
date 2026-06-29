<div class="card shadow-sm border mb-4" style="border-radius: 8px;">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="card-title text-dark fw-bold m-0" style="font-size: 1.1rem;">
            <i class="fas fa-user-tie text-success mr-2"></i> {{ $organization->no_of_owner ? 'Owner Information' : 'Director Information' }} - {{ $ownership->name ?? $index + 1 }}
        </h5>
    </div>

    @if (!empty($ownership))
        <input type="hidden" name="owner_id[]" value="{{ $ownership->id }}">
    @endif
    <div class="card-body">
        <!--Row 1: Name and Bangla Name -->
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="name{{ $index }}">Owner Name <span class="text-danger" title="Required"
                        data-toggle="tooltip">*</span></label>
                <input type="text" required class="form-control" name="name[]" id="name{{ $index }}"
                    placeholder="Name English" value="{{ $ownership->name ?? '' }}">
                <small class="error name-error text-danger"></small>
            </div>
            <div class="col-sm-6">
                <label for="bn_name{{ $index }}">Owner Name Bangla <span class="text-danger" title="Required"
                        data-toggle="tooltip">*</span></label>
                <input type="text" required class="form-control" name="bn_name[]" id="bn_name{{ $index }}"
                    placeholder="Name Bangla" value="{{ $ownership->bn_name ?? '' }}">
                <small class="error bn_name-error text-danger"></small>
            </div>
        </div>


        <!-- Row 2: Date of Birth, Birth Reg., NID No. -->
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="date_of_birth_{{ $index }}">Date of Birth</label>
                <input type="date" name="date_of_birth[]" class="form-control"
                    id="date_of_birth_{{ $index }}" value="{{ $ownership->date_of_birth ?? '' }}">
                <small class="error date_of_birth-error text-danger"></small>
            </div>
            <div class="col-sm-4">
                <label for="birth_certificate">Birth Reg. No.</label>
                <input type="text"name="birth_certificate[]" placeholder="Birth Reg. No." class="form-control"
                    id="birth_certificate_{{ $index }}" value="{{ $ownership->birth_certificate ?? '' }}">
                <small class="error birth_certificate-error text-danger"></small>
            </div>
            <div class="col-sm-4">
                <label for="nid_{{ $index }}">NID No.</label>
                <input type="text" name="nid[]" placeholder="NID No." class="form-control"
                    id="nid_{{ $index }}" value="{{ $ownership->nid ?? '' }}">
                <span class="error nid-error text-danger"></span>
            </div>
        </div>

        <!-- Row 3: Gender, Religion, Blood Group -->
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="gender">Gender</label>
                <select name="gender[]" class="form-control" id="gender">
                    <option value="">Select Gender</option>
                    @if (count(people_constant_option('gender')))
                        @foreach (people_constant_option('gender') as $key => $item)
                            <option value="{{ $key }}"
                                {{ !empty($ownership->gender) && $ownership->gender == $key ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="error gender-error text-danger"></small>
            </div>
            <div class="col-sm-4">
                <label for="religion">Religion</label>
                <select name="religion[]" class="form-control" id="religion">
                    <option value="">Select Religion</option>
                    @if (count($religions))
                        @foreach ($religions as $religion)
                            <option value="{{ $religion->id }}"
                                {{ !empty($ownership->religion) && $ownership->religion == $religion->id ? 'selected' : '' }}>
                                {{ $religion->name }}</option>
                        @endforeach
                    @endif
                </select>
                <small class="error religion-error text-danger"></small>
            </div>
            <div class="col-sm-4">
                <label for="blood_group">Blood Group</label>
                <select name="blood_group[]" class="form-control" id="blood_group">
                    <option value="">Select Blood Group</option>
                    @if (count(people_constant_option('blood_group')))
                        @foreach (people_constant_option('blood_group') as $key => $item)
                            <option value="{{ $key }}"
                                {{ !empty($ownership->blood_group) && $ownership->blood_group == $key ? 'selected' : '' }}>
                                {{ $item }}</option>
                        @endforeach
                    @endif
                </select>
                <small class="error blood_group-error text-danger"></small>
            </div>
        </div>

        <!-- Row 4: Mobile No., Email -->
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="mobile_{{ $index }}">Mobile No.</label>
                <input type="tel" value="{{ $ownership->mobile ?? '' }}" name="mobile[]" placeholder="Mobile"
                    class="form-control" id="mobile_{{ $index }}">
                <small class="error mobile-error text-danger"></small>
            </div>
            <div class="col-sm-6">
                <label for="email_{{ $index }}">Email</label>
                <input type="email" required value="{{ $ownership->email ?? '' }}" name="email[]" placeholder="Email"
                    class="form-control" id="email_{{ $index }}">
                <small class="error email-error text-danger"></small>
            </div>
        </div>


        <!-- Father Name -->
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="father_name_{{ $index }}">Father Name (English)
                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                </label>
                <input type="text" required class="form-control" name="father_name[]"
                    id="father_name_{{ $index }}" placeholder="Father Name English"
                    value="{{ $ownership->father_name ?? '' }}">
                <small class="error father_name-error text-danger"></small>
            </div>

            <div class="col-sm-6">
                <label for="father_name_bn_{{ $index }}">Father Name (Bangla)
                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                </label>
                <input type="text" required class="form-control" name="father_name_bn[]"
                    id="father_name_bn_{{ $index }}" placeholder="Father Name Bangla"
                    value="{{ $ownership->father_name_bn ?? '' }}">
                <small class="error father_name_bn-error text-danger"></small>
            </div>
        </div>

        <!-- Mother Name -->
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="mother_name_{{ $index }}">Mother Name (English)
                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                </label>
                <input type="text" required class="form-control" name="mother_name[]"
                    id="mother_name_{{ $index }}" placeholder="Mother Name English"
                    value="{{ $ownership->mother_name ?? '' }}">
                <small class="error mother_name-error text-danger"></small>
            </div>

            <div class="col-sm-6">
                <label for="mother_name_bn_{{ $index }}">Mother Name (Bangla)
                    <span class="text-danger" title="Required" data-toggle="tooltip">*</span>
                </label>
                <input type="text" required class="form-control" name="mother_name_bn[]"
                    id="mother_name_bn_{{ $index }}" placeholder="Mother Name Bangla"
                    value="{{ $ownership->mother_name_bn ?? '' }}">
                <small class="error mother_name_bn-error text-danger"></small>
            </div>
        </div>

        <!-- Permanent Address Section -->
        <div class="card-header bg-light border-bottom mt-4 mb-3 rounded-0">
            <h6 class="card-title text-dark fw-bold m-0"><i class="fas fa-home text-muted mr-2"></i> Permanent Address</h6>
        </div>
        <div class="card-body p-0 m-0">
            <!-- Row 3: Division, District, Thana -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="permanent_division_{{ $index }}">Division</label>
                    <select name="permanent_division[]" class="form-control select2 select2bs4"
                        id="permanent_division_{{ $index }}">
                        <option value="">Select Division</option>
                        @if ($divisions)
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ !empty($ownership->permanent_division) && $ownership->permanent_division == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_division_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">

                    <label for="permanent_district_{{ $index }}">District</label>
                    <select name="permanent_district[]" class="form-control select2 select2bs4"
                        id="permanent_district_{{ $index }}">
                        @if ($districts)
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ !empty($ownership->permanent_district) && $ownership->permanent_district == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_district_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">
                    <label for="permanent_thana_{{ $index }}">Thana</label>
                    <select name="permanent_thana[]" class="form-control select2 select2bs4"
                        id="permanent_thana_{{ $index }}">
                        @if ($thanas)
                            @foreach ($thanas as $thana)
                                <option value="{{ $thana->id }}"
                                    {{ !empty($ownership->permanent_thana) && $ownership->permanent_thana == $thana->id ? 'selected' : '' }}>
                                    {{ $thana->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_thana_{{ $index }}_error"></small>
                </div>
            </div>

            <!-- Row 1: Village, Post Office, Permanent Ward -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="permanent_post_office_{{ $index }}">Post Office</label>
                    <select name="permanent_post_office[]" class="form-control select2 select2bs4"
                        id="permanent_post_office_{{ $index }}">
                        <option value="">Select Post Office</option>
                        @if ($post_officeses)
                            @foreach ($post_officeses as $post_officese)
                                <option value="{{ $post_officese->id }}"
                                    {{ !empty($ownership->permanent_post_office) && $ownership->permanent_post_office == $post_officese->id ? 'selected' : '' }}>
                                    {{ $post_officese->bn_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_post_office_{{ $index }}_error"></small>
                </div>



                <div class="col-sm-4">
                    <label for="permanent_village_{{ $index }}">Village</label>

                    <select name="permanent_village_id[]" class="form-control select2 select2bs4"
                        id="permanent_village_{{ $index }}">
                        <option value="">Select Village</option>
                        @if ($villages)
                            @foreach ($villages as $village)
                                <option value="{{ $village->id }}"
                                    {{ !empty($ownership->permanent_village_id) && $ownership->permanent_village_id == $village->id ? 'selected' : '' }}>
                                    {{ $village->bn_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_village_{{ $index }}_error"></small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="permanent_ward_{{ $index }}">Permanent Ward</label>
                    <select name="permanent_ward_id[]" class="form-control select2 select2bs4"
                        id="permanent_ward_{{ $index }}">
                        <option value="">Select Ward</option>
                        @if ($wards)
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}"
                                    {{ !empty($ownership->permanent_ward_id) && $ownership->permanent_ward_id == $ward->id ? 'selected' : '' }}>
                                    {{ $ward->en_ward_no }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error permanent_ward_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">
                    <label for="permanent_road_{{ $index }}">Road</label>
                    <input type="text" name="permanent_road[]" class="form-control"
                        id="permanent_road_{{ $index }}" value="{{ $ownership->permanent_road ?? '' }}"
                        placeholder="Permanent Road">
                    <small class="text-danger error permanent_road_error"></small>
                </div>
                <div class="col-sm-3">
                    <label for="permanent_house_{{ $index }}">Holding/House No.</label>
                    <input type="text" name="permanent_house[]" class="form-control"
                        id="permanent_house_{{ $index }}" value="{{ $ownership->permanent_house ?? '' }}"
                        placeholder="Permanent House">
                    <small class="text-danger error permanent_house_error"></small>
                </div>
                <div class="col-sm-3">
                    <label for="permanent_house_bn_{{ $index }}">Holding/House No.
                        (Bangla)</label>
                    <input type="text" name="permanent_house_bn[]" class="form-control"
                        id="permanent_house_bn_{{ $index }}"
                        value="{{ $ownership->permanent_house_bn ?? '' }}" placeholder="স্থায়ী বাড়ি">
                    <small class="text-danger error permanent_house_bn_error"></small>
                </div>
            </div>
        </div>

        <!-- Row 2:  -->

        <div class="form-group row">
        </div>

        <!-- Present Address Section -->
        <div class="card-header bg-light border-bottom mt-4 mb-3 rounded-0">
            <h6 class="card-title text-dark fw-bold m-0"><i class="fas fa-map-marker-alt text-muted mr-2"></i> Present Address</h6>
        </div>
        <div class="card-body p-0 m-0">
            <!--Row 3: Division, District, Thana -->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="present_division_{{ $index }}">Division</label>
                    <select name="present_division[]" class="form-control select2 select2bs4"
                        id="present_division_{{ $index }}">
                        <option value="">Select Division</option>
                        @if ($divisions)
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ !empty($ownership->present_division) && $ownership->present_division == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_division_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">
                    <label for="present_district_{{ $index }}">District</label>
                    <select name="present_district_id[]" class="form-control select2 select2bs4"
                        id="present_district_{{ $index }}">
                        @if ($present_districts)
                            @foreach ($present_districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ !empty($ownership->present_district_id) && $ownership->present_district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_district_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">
                    <label for="present_thana_{{ $index }}">Thana</label>
                    <select name="present_thana_id[]" class="form-control select2 select2bs4"
                        id="present_thana_{{ $index }}">
                        @if ($present_thanas)
                            @foreach ($present_thanas as $thana)
                                <option value="{{ $thana->id }}"
                                    {{ !empty($ownership->present_thana_id) && $ownership->present_thana_id == $thana->id ? 'selected' : '' }}>
                                    {{ $thana->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_thana_{{ $index }}_error"></small>
                </div>
            </div>

            <!--Row 4: Post Office, UP, Village-->
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="present_post_office_{{ $index }}">Post Office</label>
                    <select name="present_post_office_id[]" class="form-control select2 select2bs4"
                        id="present_post_office_{{ $index }}">
                        <option value="">Select Post Office</option>
                        @if ($post_officeses)
                            @foreach ($post_officeses as $post_officese)
                                <option value="{{ $post_officese->id }}"
                                    {{ !empty($ownership->present_post_office_id) && $ownership->present_post_office_id == $post_officese->id ? 'selected' : '' }}>
                                    {{ $post_officese->bn_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_post_office_{{ $index }}_error"></small>
                </div>

                <div class="col-sm-4">
                    <label for="present_village_{{ $index }}">Village</label>
                    <select name="present_village_id[]" class="form-control select2 select2bs4"
                        id="present_village_{{ $index }}">
                        @if ($villages)
                            @foreach ($villages as $village)
                                <option value="{{ $village->id }}"
                                    {{ !empty($ownership->present_village_id) && $ownership->present_village_id == $village->id ? 'selected' : '' }}>
                                    {{ $village->bn_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_village_{{ $index }}_error"></small>
                </div>
            </div>

            <!-- Row 5: Ward, Road, House -->
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="present_ward_{{ $index }}">Ward</label>
                    <select name="present_ward_id[]" class="form-control select2 select2bs4"
                        id="present_ward_{{ $index }}">
                        <option value="">Select Ward</option>
                        @if ($wards)
                            @foreach ($wards as $ward)
                                <option value="{{ $ward->id }}"
                                    {{ !empty($ownership->present_ward_id) && $ownership->present_ward_id == $ward->id ? 'selected' : '' }}>
                                    {{ $ward->en_ward_no }}</option>
                            @endforeach
                        @endif
                    </select>
                    <small class="text-danger error present_ward_{{ $index }}_error"></small>
                </div>
                <div class="col-sm-4">
                    <label for="present_road_{{ $index }}">Road</label>
                    <input type="text" name="present_road[]" class="form-control"
                        id="present_road_{{ $index }}" value="{{ $ownership->present_road ?? '' }}"
                        placeholder="Present Road">
                    <small class="text-danger error present_road_error"></small>
                </div>
                <div class="col-sm-3">
                    <label for="present_house_{{ $index }}">House</label>
                    <input type="text" name="present_house[]" class="form-control"
                        id="present_house_{{ $index }}" value="{{ $ownership->present_house ?? '' }}"
                        placeholder="Present House">
                    <small class="text-danger error present_house_error"></small>
                </div>
                <div class="col-sm-3">
                    <label for="present_house_bn_{{ $index }}">House (Bangla)</label>
                    <input type="text" name="present_house_bn[]" class="form-control"
                        id="present_house_bn_{{ $index }}" value="{{ $ownership->present_house_bn ?? '' }}"
                        placeholder="বর্তমান বাড়ি">
                    <small class="text-danger error present_house_bn_error"></small>
                </div>
            </div>

            <!-- Row 5: Photo -->
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="image">Photo</label>
                    <input type="file" name="image[]" class="image form-control-file"
                        id="image_{{ $index }}">
                    <span class="error image-error text-danger"></span>
                </div>
                <div class="col-sm-6">
                    <img class="img-fluid img-thumbnail"
                        src="{{ !empty($ownership->image) ? asset($ownership->image) : asset('no-image-found.jpeg') }}"
                        id="preview_{{ $index }}" alt="Preview" width="100" height="100">
                </div>
            </div>

        </div>
    </div>
</div>
@push('script')
    <script>
        $(document).on('change', '#permanent_division_{{ $index }}', function(e) {
            e.preventDefault();
            let district_id = $('#permanent_district_{{ $index }}');
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + division_id,
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

        $(document).on('change', '#permanent_district_{{ $index }}', function(e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#permanent_thana_{{ $index }}");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/" + district_id,
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

        $(document).on('change', '#present_division_{{ $index }}', function(e) {
            e.preventDefault();
            let district_id = $('#present_district_{{ $index }}');
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + division_id,
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

        $(document).on('change', '#present_district_{{ $index }}', function(e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#present_thana_{{ $index }}");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/" + district_id,
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
    </script>
@endpush
