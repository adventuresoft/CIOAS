@push('style')
<style>
    /* Professional Location Type Button Cards */
    .location-type-card {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748b;
        transition: all 0.18s ease;
        margin-bottom: 0;
        user-select: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        position: relative;
        letter-spacing: 0.02em;
    }

    .location-type-card::before {
        content: '';
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid #cbd5e1;
        background: #fff;
        transition: all 0.18s ease;
        flex-shrink: 0;
    }

    .location-type-card:hover {
        border-color: #94a3b8;
        background: #f8fafc;
        color: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    .location-type-card.active {
        border-color: #2563eb !important;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%) !important;
        color: #1d4ed8 !important;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.12), 0 2px 6px rgba(37,99,235,0.15);
    }

    .location-type-card.active::before {
        border-color: #2563eb;
        background: #2563eb;
        box-shadow: inset 0 0 0 2px #fff;
    }

    .location-type-card .location-icon {
        font-size: 1rem;
        color: #94a3b8;
        transition: color 0.18s ease;
    }

    .location-type-card.active .location-icon {
        color: #2563eb !important;
    }
</style>
@endpush

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
            <div class="form-group row align-items-center pt-3">
                <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
                    <i class="fas fa-map-marker-alt text-primary mr-1"></i> Location Type
                </label>
                <div class="col-sm-10">
                    <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
                        <label class="location-type-card perm-loc-card-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'city_type') ? 'active' : '' }}">
                            <input type="radio" name="permanent_location_type[{{ $index }}]" value="city_type" class="d-none perm-loc-radio-{{ $index }}" {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'city_type') ? 'checked' : '' }}>
                            <span class="location-icon"><i class="fas fa-city"></i></span> City Corporation
                        </label>
                        <label class="location-type-card perm-loc-card-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'pos_type') ? 'active' : '' }}">
                            <input type="radio" name="permanent_location_type[{{ $index }}]" value="pos_type" class="d-none perm-loc-radio-{{ $index }}" {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'pos_type') ? 'checked' : '' }}>
                            <span class="location-icon"><i class="fas fa-building"></i></span> Pourashava
                        </label>
                        <label class="location-type-card perm-loc-card-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'union_type') ? 'active' : '' }}">
                            <input type="radio" name="permanent_location_type[{{ $index }}]" value="union_type" class="d-none perm-loc-radio-{{ $index }}" {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'union_type') ? 'checked' : '' }}>
                            <i class="fas fa-warehouse location-icon"></i>
                            <span>Union</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="perm-address-fields-{{ $index }} {{ isset($ownership->permanent_location_type) ? '' : 'd-none' }}">
                <div class="form-group row g-4">
                    <div class="col-sm-4">
                        <label>Division</label>
                        <select name="permanent_division[]" class="form-control select2 select2bs4" id="permanent_division_{{ $index }}">
                            <option value="">Select Division</option>
                            @if ($divisions)
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ !empty($ownership->permanent_division) && $ownership->permanent_division == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>District</label>
                        <select name="permanent_district[]" class="form-control select2 select2bs4" id="permanent_district_{{ $index }}">
                            <option value="">Select District</option>
                            @if ($districts)
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ !empty($ownership->permanent_district) && $ownership->permanent_district == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Thana</label>
                        <select name="permanent_thana[]" class="form-control select2 select2bs4" id="permanent_thana_{{ $index }}">
                            <option value="">Select Thana</option>
                            @if ($thanas)
                                @foreach ($thanas as $thana)
                                    <option value="{{ $thana->id }}"
                                        {{ !empty($ownership->permanent_thana) && $ownership->permanent_thana == $thana->id ? 'selected' : '' }}>
                                        {{ $thana->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 perm-city-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'city_type') ? '' : 'd-none' }}">
                        <label>City Corporation</label>
                        <select name="permanent_city_id[]" class="form-control select2 select2bs4" id="permanent_city_{{ $index }}" data-type="City">
                            <option value="">Select City Corporation</option>
                            @if (isset($cities) && $cities)
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ (!empty($ownership->permanent_city_id) && $ownership->permanent_city_id == $city->id) ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 perm-pos-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'pos_type') ? '' : 'd-none' }}">
                        <label>Pourashava</label>
                        <select name="permanent_pos_id[]" class="form-control select2 select2bs4" id="permanent_pos_{{ $index }}" data-type="pourashova">
                            <option value="">Select Pourashava</option>
                            @if (isset($pourashavas) && $pourashavas)
                                @foreach ($pourashavas as $pos)
                                    <option value="{{ $pos->id }}" {{ (!empty($ownership->permanent_pos_id) && $ownership->permanent_pos_id == $pos->id) ? 'selected' : '' }}>{{ $pos->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 perm-union-{{ $index }} {{ (isset($ownership->permanent_location_type) && $ownership->permanent_location_type == 'union_type') ? '' : 'd-none' }}">
                        <label>Union</label>
                        <select name="permanent_union_id[]" class="form-control select2 select2bs4" id="permanent_union_{{ $index }}" data-type="union">
                            <option value="">Select Union</option>
                            @if (isset($unions) && $unions)
                                @foreach ($unions as $union)
                                    <option value="{{ $union->id }}" {{ (!empty($ownership->permanent_union_id) && $ownership->permanent_union_id == $union->id) ? 'selected' : '' }}>{{ $union->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Post Office</label>
                        <select name="permanent_post_office[]" class="form-control select2 select2bs4" id="permanent_post_office_{{ $index }}">
                            <option value="">Select Post Office</option>
                            @if ($post_officeses)
                                @foreach ($post_officeses as $post_officese)
                                    <option value="{{ $post_officese->id }}"
                                        {{ !empty($ownership->permanent_post_office) && $ownership->permanent_post_office == $post_officese->id ? 'selected' : '' }}>
                                        {{ $post_officese->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Village</label>
                        <select name="permanent_village_id[]" class="form-control select2 select2bs4" id="permanent_village_{{ $index }}">
                            <option value="">Select Village</option>
                            @if ($villages)
                                @foreach ($villages as $village)
                                    <option value="{{ $village->id }}"
                                        {{ !empty($ownership->permanent_village_id) && $ownership->permanent_village_id == $village->id ? 'selected' : '' }}>
                                        {{ $village->bn_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Ward</label>
                        <select name="permanent_ward_id[]" class="form-control select2 select2bs4" id="permanent_ward_{{ $index }}">
                            <option value="">Select Ward</option>
                            @if ($wards)
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward->id }}"
                                        {{ !empty($ownership->permanent_ward_id) && $ownership->permanent_ward_id == $ward->id ? 'selected' : '' }}>
                                        {{ $ward->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Road</label>
                        <input type="text" name="permanent_road[]" class="form-control" id="permanent_road_{{ $index }}" value="{{ $ownership->permanent_road ?? '' }}" placeholder="Permanent Road">
                    </div>
                    <div class="col-sm-3">
                        <label>Holding/House No.</label>
                        <input type="text" name="permanent_house[]" class="form-control" id="permanent_house_{{ $index }}" value="{{ $ownership->permanent_house ?? '' }}" placeholder="Permanent House">
                    </div>
                    <div class="col-sm-3">
                        <label>Holding/House No. (Bangla)</label>
                        <input type="text" name="permanent_house_bn[]" class="form-control" id="permanent_house_bn_{{ $index }}" value="{{ $ownership->permanent_house_bn ?? '' }}" placeholder="স্থায়ী বাড়ি">
                    </div>
                </div>
            </div>
        </div>

        <!-- Present Address Section -->
        <div class="card-header bg-light border-bottom mt-4 mb-3 rounded-0">
            <h6 class="card-title text-dark fw-bold m-0"><i class="fas fa-map-marker-alt text-muted mr-2"></i> Present Address</h6>
        </div>
        <div class="card-body p-0 m-0">
            <div class="form-group row align-items-center pt-3">
                <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
                    <i class="fas fa-map-marker-alt text-primary mr-1"></i> Location Type
                </label>
                <div class="col-sm-10">
                    <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
                        <label class="location-type-card pres-loc-card-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'city_type') ? 'active' : '' }}">
                            <input type="radio" name="present_location_type[{{ $index }}]" value="city_type" class="d-none pres-loc-radio-{{ $index }}" {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'city_type') ? 'checked' : '' }}>
                            <i class="fas fa-city location-icon"></i>
                            <span>City Corporation</span>
                        </label>
                        <label class="location-type-card pres-loc-card-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'pos_type') ? 'active' : '' }}">
                            <input type="radio" name="present_location_type[{{ $index }}]" value="pos_type" class="d-none pres-loc-radio-{{ $index }}" {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'pos_type') ? 'checked' : '' }}>
                            <i class="fas fa-building location-icon"></i>
                            <span>Pourashava</span>
                        </label>
                        <label class="location-type-card pres-loc-card-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'union_type') ? 'active' : '' }}">
                            <input type="radio" name="present_location_type[{{ $index }}]" value="union_type" class="d-none pres-loc-radio-{{ $index }}" {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'union_type') ? 'checked' : '' }}>
                            <i class="fas fa-warehouse location-icon"></i>
                            <span>Union</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pres-address-fields-{{ $index }} {{ isset($ownership->present_location_type) ? '' : 'd-none' }}">
                <div class="form-group row g-4">
                    <div class="col-sm-4">
                        <label>Division</label>
                        <select name="present_division[]" class="form-control select2 select2bs4" id="present_division_{{ $index }}">
                            <option value="">Select Division</option>
                            @if ($divisions)
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ !empty($ownership->present_division) && $ownership->present_division == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>District</label>
                        <select name="present_district_id[]" class="form-control select2 select2bs4" id="present_district_{{ $index }}">
                            <option value="">Select District</option>
                            @if ($present_districts)
                                @foreach ($present_districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ !empty($ownership->present_district_id) && $ownership->present_district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Thana</label>
                        <select name="present_thana_id[]" class="form-control select2 select2bs4" id="present_thana_{{ $index }}">
                            <option value="">Select Thana</option>
                            @if ($present_thanas)
                                @foreach ($present_thanas as $thana)
                                    <option value="{{ $thana->id }}"
                                        {{ !empty($ownership->present_thana_id) && $ownership->present_thana_id == $thana->id ? 'selected' : '' }}>
                                        {{ $thana->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 pres-city-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'city_type') ? '' : 'd-none' }}">
                        <label>City Corporation</label>
                        <select name="present_city_id[]" class="form-control select2 select2bs4" id="present_city_{{ $index }}" data-type="City">
                            <option value="">Select City Corporation</option>
                            @if (isset($present_cities) && $present_cities)
                                @foreach ($present_cities as $city)
                                    <option value="{{ $city->id }}" {{ (!empty($ownership->present_city_id) && $ownership->present_city_id == $city->id) ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 pres-pos-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'pos_type') ? '' : 'd-none' }}">
                        <label>Pourashava</label>
                        <select name="present_pos_id[]" class="form-control select2 select2bs4" id="present_pos_{{ $index }}" data-type="pourashova">
                            <option value="">Select Pourashava</option>
                            @if (isset($present_pourashavas) && $present_pourashavas)
                                @foreach ($present_pourashavas as $pos)
                                    <option value="{{ $pos->id }}" {{ (!empty($ownership->present_pos_id) && $ownership->present_pos_id == $pos->id) ? 'selected' : '' }}>{{ $pos->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4 pres-union-{{ $index }} {{ (isset($ownership->present_location_type) && $ownership->present_location_type == 'union_type') ? '' : 'd-none' }}">
                        <label>Union</label>
                        <select name="present_union_id[]" class="form-control select2 select2bs4" id="present_union_{{ $index }}" data-type="union">
                            <option value="">Select Union</option>
                            @if (isset($present_unions) && $present_unions)
                                @foreach ($present_unions as $union)
                                    <option value="{{ $union->id }}" {{ (!empty($ownership->present_union_id) && $ownership->present_union_id == $union->id) ? 'selected' : '' }}>{{ $union->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Post Office</label>
                        <select name="present_post_office_id[]" class="form-control select2 select2bs4" id="present_post_office_{{ $index }}">
                            <option value="">Select Post Office</option>
                            @if (isset($present_post_officeses))
                                @foreach ($present_post_officeses as $post_officese)
                                    <option value="{{ $post_officese->id }}"
                                        {{ !empty($ownership->present_post_office_id) && $ownership->present_post_office_id == $post_officese->id ? 'selected' : '' }}>
                                        {{ $post_officese->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label>Village</label>
                        <select name="present_village_id[]" class="form-control select2 select2bs4" id="present_village_{{ $index }}">
                            <option value="">Select Village</option>
                            @if (isset($present_villages) && $present_villages)
                                @foreach ($present_villages as $village)
                                    <option value="{{ $village->id }}"
                                        {{ !empty($ownership->present_village_id) && $ownership->present_village_id == $village->id ? 'selected' : '' }}>
                                        {{ $village->bn_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Ward</label>
                        <select name="present_ward_id[]" class="form-control select2 select2bs4" id="present_ward_{{ $index }}">
                            <option value="">Select Ward</option>
                            @if ($wards)
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward->id }}"
                                        {{ !empty($ownership->present_ward_id) && $ownership->present_ward_id == $ward->id ? 'selected' : '' }}>
                                        {{ $ward->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Road</label>
                        <input type="text" name="present_road[]" class="form-control" id="present_road_{{ $index }}" value="{{ $ownership->present_road ?? '' }}" placeholder="Present Road">
                    </div>
                    <div class="col-sm-3">
                        <label>House</label>
                        <input type="text" name="present_house[]" class="form-control" id="present_house_{{ $index }}" value="{{ $ownership->present_house ?? '' }}" placeholder="Present House">
                    </div>
                    <div class="col-sm-3">
                        <label>House (Bangla)</label>
                        <input type="text" name="present_house_bn[]" class="form-control" id="present_house_bn_{{ $index }}" value="{{ $ownership->present_house_bn ?? '' }}" placeholder="বর্তমান বাড়ি">
                    </div>
                </div>
            </div>
        </div>

        <!-- Photo -->
        <div class="form-group row mt-3">
            <div class="col-sm-6">
                <label for="image">Photo</label>
                <input type="file" name="image[]" class="image form-control-file" id="image_{{ $index }}">
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
        // Permanent address location type card
        $(document).on('click', '.perm-loc-card-{{ $index }}', function() {
            let radio = $(this).find('input[type="radio"]');
            if (radio.length) {
                radio.prop('checked', true).trigger('change');
                $('.perm-loc-card-{{ $index }}').removeClass('active');
                $(this).addClass('active');
            }
        });

        $(document).on('change', 'input[name="permanent_location_type[{{ $index }}]"]', function() {
            let val = $(this).val();
            $('.perm-address-fields-{{ $index }}').removeClass('d-none');
            $('.perm-city-{{ $index }}, .perm-pos-{{ $index }}, .perm-union-{{ $index }}').addClass('d-none');
            if (val == 'city_type') {
                $('.perm-city-{{ $index }}').removeClass('d-none');
            } else if (val == 'pos_type') {
                $('.perm-pos-{{ $index }}').removeClass('d-none');
            } else if (val == 'union_type') {
                $('.perm-union-{{ $index }}').removeClass('d-none');
            }
        });

        // Present address location type card
        $(document).on('click', '.pres-loc-card-{{ $index }}', function() {
            let radio = $(this).find('input[type="radio"]');
            if (radio.length) {
                radio.prop('checked', true).trigger('change');
                $('.pres-loc-card-{{ $index }}').removeClass('active');
                $(this).addClass('active');
            }
        });

        $(document).on('change', 'input[name="present_location_type[{{ $index }}]"]', function() {
            let val = $(this).val();
            $('.pres-address-fields-{{ $index }}').removeClass('d-none');
            $('.pres-city-{{ $index }}, .pres-pos-{{ $index }}, .pres-union-{{ $index }}').addClass('d-none');
            if (val == 'city_type') {
                $('.pres-city-{{ $index }}').removeClass('d-none');
            } else if (val == 'pos_type') {
                $('.pres-pos-{{ $index }}').removeClass('d-none');
            } else if (val == 'union_type') {
                $('.pres-union-{{ $index }}').removeClass('d-none');
            }
        });

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
                    beforeSend: function() { thana_id.prop("disabled", true); },
                    success: function(response) { thana_id.html(response); thana_id.prop("disabled", false); },
                    error: function(xhr, status, error) { thana_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    success: function(r) { $("#permanent_pos_{{ $index }}").html(r); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    success: function(r) { $("#permanent_city_{{ $index }}").html(r); }
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
                    beforeSend: function() { thana_id.prop("disabled", true); },
                    success: function(response) { thana_id.html(response); thana_id.prop("disabled", false); },
                    error: function(xhr, status, error) { thana_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    success: function(r) { $("#present_pos_{{ $index }}").html(r); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    success: function(r) { $("#present_city_{{ $index }}").html(r); }
                });
            } else {
                thana_id.prop("disabled", true);
            }

        })

        // Permanent: union/pourashava/city change -> load villages
        $(document).on('change', '#permanent_union_{{ $index }}, #permanent_pos_{{ $index }}, #permanent_city_{{ $index }}', function() {
            let val = $(this).val();
            let type = $(this).data('type') || 'union';
            let village_id = $("#permanent_village_{{ $index }}");
            if (val) {
                $.ajax({ type: "GET", url: "{{ url('/get-villages-by-type') }}/" + val + '/' + type,
                    beforeSend: function() { village_id.prop("disabled", true); },
                    success: function(response) { village_id.html(response.villageOptions); village_id.prop("disabled", false); },
                    error: function() { village_id.prop("disabled", true); }
                });
            }
        });

        // Present: union/pourashava/city change -> load villages
        $(document).on('change', '#present_union_{{ $index }}, #present_pos_{{ $index }}, #present_city_{{ $index }}', function() {
            let val = $(this).val();
            let type = $(this).data('type') || 'union';
            let village_id = $("#present_village_{{ $index }}");
            if (val) {
                $.ajax({ type: "GET", url: "{{ url('/get-villages-by-type') }}/" + val + '/' + type,
                    beforeSend: function() { village_id.prop("disabled", true); },
                    success: function(response) { village_id.html(response.villageOptions); village_id.prop("disabled", false); },
                    error: function() { village_id.prop("disabled", true); }
                });
            }
        });
        $(document).on('change', '#permanent_thana_{{ $index }}', function(e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let post_office_id = $("#permanent_post_office_{{ $index }}");
            let village_id = $("#permanent_village_{{ $index }}");

            if (thana_id) {
                $.ajax({ type: "GET", url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function() { post_office_id.prop("disabled", true); },
                    success: function(response) { post_office_id.html(response); post_office_id.prop("disabled", false); },
                    error: function() { post_office_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-villages-by-type') }}/" + thana_id + "/thana",
                    beforeSend: function() { village_id.prop("disabled", true); },
                    success: function(response) { village_id.html(response.villageOptions); village_id.prop("disabled", false); },
                    error: function() { village_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                    success: function(response) { $("#permanent_union_{{ $index }}").html(response); }
                });
                let pd = $("#permanent_district_{{ $index }}").val();
                if (pd) {
                    $.ajax({ type: "GET", url: "{{ url('/get-city-corporation-by-district') }}/" + pd,
                        success: function(r) { $("#permanent_city_{{ $index }}").html(r); }
                    });
                    $.ajax({ type: "GET", url: "{{ url('/get-pourashava-by-district') }}/" + pd,
                        success: function(r) { $("#permanent_pos_{{ $index }}").html(r); }
                    });
                }
            } else {
                post_office_id.prop("disabled", true);
                village_id.prop("disabled", true);
            }
        })
        $(document).on('change', '#present_thana_{{ $index }}', function(e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let post_office_id = $("#present_post_office_{{ $index }}");
            let village_id = $("#present_village_{{ $index }}");

            if (thana_id) {
                $.ajax({ type: "GET", url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function() { post_office_id.prop("disabled", true); },
                    success: function(response) { post_office_id.html(response); post_office_id.prop("disabled", false); },
                    error: function() { post_office_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-villages-by-type') }}/" + thana_id + "/thana",
                    beforeSend: function() { village_id.prop("disabled", true); },
                    success: function(response) { village_id.html(response.villageOptions); village_id.prop("disabled", false); },
                    error: function() { village_id.prop("disabled", true); }
                });
                $.ajax({ type: "GET", url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                    success: function(response) { $("#present_union_{{ $index }}").html(response); }
                });
                let prsd = $("#present_district_{{ $index }}").val();
                if (prsd) {
                    $.ajax({ type: "GET", url: "{{ url('/get-city-corporation-by-district') }}/" + prsd,
                        success: function(r) { $("#present_city_{{ $index }}").html(r); }
                    });
                    $.ajax({ type: "GET", url: "{{ url('/get-pourashava-by-district') }}/" + prsd,
                        success: function(r) { $("#present_pos_{{ $index }}").html(r); }
                    });
                }
            } else {
                post_office_id.prop("disabled", true);
                village_id.prop("disabled", true);
            }
        })
    </script>
@endpush




