@push('style')
<style>
    /* Premium Smart Form Design System */
    .card-body label:not(.form-check-label) {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #475569;
        margin-bottom: 8px;
        display: block;
    }

    .card-body .form-control:not(.custom-file-input) {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 40px !important;
        font-size: 0.9rem !important;
        color: #1e293b !important;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }

    /* Increased vertical gap between form rows */
    .card-body .form-group.row {
        margin-bottom: 28px !important;
    }

    .card-body .form-control:focus:not(.custom-file-input) {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        background-color: #ffffff !important;
    }

    .card-body .form-control[readonly] {
        background-color: #f8fafc !important;
        border-color: #cbd5e1 !important;
        font-weight: 500 !important;
        color: #475569 !important;
    }

    /* Select2 Styling overrides */
    .card-body .select2-container--default .select2-selection--single {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        height: 40px !important;
        transition: all 0.2s ease-in-out;
    }

    .card-body .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        padding-left: 12px !important;
        color: #1e293b !important;
    }

    .card-body .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        right: 8px !important;
    }

    .card-body .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
    }

    /* Custom Radio/Checkbox Cards */
    .location-type-card {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 24px;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        color: #475569;
        transition: all 0.2s ease-in-out;
        margin-bottom: 0;
        user-select: none;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .location-type-card:hover {
        border-color: #94a3b8;
        background: #f8fafc;
        color: #1e293b;
    }

    .location-type-card.active {
        border-color: #2563eb !important;
        background: #eff6ff !important;
        color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .location-type-card .location-icon {
        font-size: 1.05rem;
        color: #64748b;
        transition: color 0.2s ease-in-out;
    }

    .location-type-card.active .location-icon {
        color: #2563eb !important;
    }

    /* Custom File Input Styling */
    .custom-file {
        height: 40px !important;
    }

    .custom-file-label {
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        height: 40px !important;
        line-height: 28px !important;
        padding-left: 12px !important;
        font-size: 0.9rem !important;
        color: #64748b !important;
        background: #ffffff !important;
        display: flex;
        align-items: center;
        box-shadow: none !important;
    }

    .custom-file-label::after {
        height: 37px !important;
        line-height: 26px !important;
        border-radius: 0 7px 7px 0 !important;
        background-color: #f1f5f9 !important;
        border-left: 1.5px solid #cbd5e1 !important;
        color: #475569 !important;
        font-weight: 600 !important;
        padding: 4px 18px !important;
        display: flex;
        align-items: center;
        content: "Browse" !important;
    }

    .custom-file-input:focus ~ .custom-file-label {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }

    /* Section Headings */
    .section-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 8px;
        margin-top: 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #2563eb;
    }
</style>
@endpush

<div class="card-body">
    {{-- Hotel/restaurant organization form: basic details, address, and supporting documents --}}
    {{-- Name, Bangla Name --}}
    <div class="form-group row">
        <div class="col-sm-6">
            <label for="name">Name</label>
            <input type="text" required name="name" value="{{ $organization->name ?? '' }}"
                placeholder="Organization Name" class="form-control" id="name">
        </div>
        <div class="col-sm-6">
            <label for="bn_name">Name (Bangla)</label>
            <input type="text" name="bn_name" value="{{ $organization->bn_name ?? '' }}"
                placeholder="Organization Name Bangla" class="form-control" id="bn_name">
        </div>
    </div>

    {{-- Category, Subcategory, Work Area: selection controls for hotel classification --}}
    <div class="form-group row">
        <div class="col-sm-4">
            <label for="organization_category_id">Category</label>
            <select class="form-control select2" name="organization_category_id" id="organization_category_id">
                <option value=""> Category</option>
                @if (count($categories))
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($organization->hotel_category_id) ? ($organization->hotel_category_id == $category->id ? 'selected' : '') : '' }}>
                            {{ $category->en_name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-4">
            <label for="organization_subcategory_id">Sub Category</label>
            <select class="form-control select2" name="organization_subcategory_id" id="organization_subcategory_id">
                @if (isset($organization->hotel_subcategory_id))
                    <option value="{{ $organization->hotel_subcategory_id }}">
                        {{ $organization->subcategory->en_name }}
                    </option>
                @endif
            </select>
        </div>
        <div class="col-sm-4">
            <label for="organization_type_id">Type </label>
            <select class="form-control select2" name="organization_type_id" id="organization_type_id">
                <option value="">Select Type </option>
                @if (isset($types))
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ isset($organization->hotel_type_id) ? ($organization->hotel_type_id == $type->id ? 'selected' : '') : '' }}>
                            {{ $type->en_name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- Organization details: type-specific fields, capital, year, and application type --}}
    <div class="form-group row">
        <div class="col-sm-4 {{ !empty($organization->rjsc_reg_no) ? '' : 'd-none' }}" id="rjsc_reg_no_div">
            <label for="rjsc_reg_no">RJSC Reg.</label>
            <input type="text" name="rjsc_reg_no" value="{{ $organization->rjsc_reg_no ?? '' }}"
                placeholder="RJSC Reg. No." class="form-control" id="rjsc_reg_no">
        </div>
        <div class="col-sm-4 {{ !empty($organization->no_of_owner) ? '' : 'd-none' }}" id="no_of_owner_div">
            <label for="no_of_owner">Owner</label>
            <input type="number" name="no_of_owner" value="{{ $organization->no_of_owner ?? '' }}"
                placeholder="Number of Owners" class="form-control" id="no_of_owner">
        </div>
        <div class="col-sm-4 {{ !empty($organization->no_of_dir) ? '' : 'd-none' }}" id="no_of_dir_div">
            <label for="no_of_dir">Director</label>
            <input type="number" name="no_of_dir" value="{{ $organization->no_of_dir ?? '' }}"
                placeholder="Number of Directors" class="form-control" id="no_of_dir">
        </div>
        <div class="col-sm-4">
            <label for="capital">Capital</label>
            <input type="number" name="capital" value="{{ $organization->capital ?? '' }}" placeholder="Capital"
                class="form-control" id="capital">
        </div>
        <div class="col-sm-2">
            <label for="establish_year">Est. Year</label>
            <input type="number" min="1900" max="{{ date('Y') }}" step="1" name="establish_year"
                value="{{ $organization->establish_year ?? date('Y') }}" placeholder="Established Year "
                class="form-control" id="establish_year">
        </div>
        <div class="col-sm-2">
            <label for="application_type">Application Type</label>
            <select class="form-control select2" name="application_type" id="application_type">
                <option value="new" {{ isset($organization->application_type) ? ($organization->application_type == 'new' ? 'selected' : '') : '' }}>
                    NEW</option>
                <option value="old" {{ isset($organization->application_type) ? ($organization->application_type == 'old' ? 'selected' : '') : '' }}>
                    OLD</option>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <h5 class="section-title"><i class="fas fa-map-marked-alt"></i> Registered Address</h5>
        </div>
    </div>

    <!-- Present address location selector -->
    {{-- Registered address location type options: choose which local government unit applies --}}
    <div class="form-group row align-items-center pt-3 location_cat">
        <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
            <i class="fas fa-map-marker-alt text-primary mr-1"></i> Location Type
        </label>
        <div class="col-sm-10">
            <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
                <label class="location-type-card {{ (isset($organization->location_type) && $organization->location_type == 'city_type') ? 'active' : '' }}">
                    <input type="radio" name="location_type" value="city_type" class="location-type-radio d-none"
                        {{ (isset($organization->location_type) && $organization->location_type == 'city_type' ? 'checked' : '') }}>
                    <i class="fas fa-city location-icon"></i>
                    <span>City Corporation</span>
                </label>
                <label class="location-type-card {{ (isset($organization->location_type) && $organization->location_type == 'pos_type') ? 'active' : '' }}">
                    <input type="radio" name="location_type" value="pos_type" class="location-type-radio d-none"
                        {{ (isset($organization->location_type) && $organization->location_type == 'pos_type' ? 'checked' : '') }}>
                    <i class="fas fa-building location-icon"></i>
                    <span>Pourashava</span>
                </label>
                <label class="location-type-card {{ (isset($organization->location_type) && $organization->location_type == 'union_type') ? 'active' : '' }}">
                    <input type="radio" name="location_type" value="union_type" class="location-type-radio d-none"
                        {{ (isset($organization->location_type) && $organization->location_type == 'union_type' ? 'checked' : '') }}>
                    <i class="fas fa-warehouse location-icon"></i>
                    <span>Union</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Registered address fields: division, district, thana, and location type --}}
    <div class="present_address_filed {{ !empty($organization->location_type) ? '' : 'd-none' }}">
        <div class="form-group row g-4">
            <div class="col-sm-4">
                <label for="division_id">Division</label>
                <select name="division_id" class="form-control select2 select2bs4" id="division_id">
                    <option value="">Select Division</option>
                    @if ($divisions)
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ isset($organization->division_id) && $organization->division_id == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error division_id_error"></small>
            </div>
            <div class="col-sm-4">
                <label for="district_id">District</label>
                <select name="district_id" class="form-control select2 select2bs4" id="district_id">
                    <option value="">Select District</option>
                    @if (isset($districts))
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ isset($organization->district_id) && $organization->district_id == $district->id ? 'selected' : '' }}>
                                {{ $district->name ?? 'Select District' }}
                            </option>
                        @endforeach
                    @endif

                </select>

                <small class="text-danger error district_id_error"></small>
            </div>

            {{-- City corporation option shown when location type is city corporation --}}
            <div class="col-sm-4 city_type {{ !empty($organization->city_id) ? '' : 'd-none' }}">
                <label for="city_corporation_id">City Corporation</label>
                <select name="city_id" class="form-control select2 select2bs4" id="city_corporation_id" data-type="City">
                    <option value="">Select City Corporation</option>
                    @if (isset($city_corporations))
                        @foreach ($city_corporations as $city_corporation)
                            <option value="{{ $city_corporation->id }}" {{ isset($organization->city_id) ? ($organization->city_id == $city_corporation->id ? 'selected' : '') : '' }}>
                                {{ $city_corporation->bn_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error permanent_village_id_error"></small>
            </div>

            <div class="col-sm-4">
                <label for="thana_id">Thana</label>
                <select name="thana_id" class="form-control select2 select2bs4" id="thana_id">
                    <option value="">Select Thana</option>
                    @if (isset($thanas))
                        @foreach ($thanas as $thana)
                            <option value="{{ $thana->id }}" {{ isset($organization->thana_id) && $organization->thana_id == $thana->id ? 'selected' : '' }}>
                                {{ $thana->name ?? 'Select Thana' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error thana_id_error"></small>

            </div>

            {{-- Pourashava option shown when location type is pourashava --}}
            <div class="col-sm-4 pos_type {{ !empty($organization->pos_id) ? '' : 'd-none' }}">
                <label for="pourashova_id">Pourashava</label>
                <select name="pos_id" class="form-control select2 select2bs4" id="pourashova_id" data-type="pourashova">
                    <option value="">Select Pourashova</option>
                    @if (isset($pourashavas))
                        @foreach ($pourashavas as $pourashava)
                            <option value="{{ $pourashava->id }}" {{ isset($organization->pos_id) ? ($organization->pos_id == $pourashava->id ? 'selected' : '') : '' }}>
                                {{ $pourashava->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error permanent_village_id_error"></small>
            </div>


            {{-- Union option shown when location type is union --}}
            <div class="col-sm-4 union_type {{ !empty($organization->union_id) ? '' : 'd-none' }}">
                <label for="union_id">Union</label>
                <select name="union_id" class="form-control select2 select2bs4" id="union_id" data-type="union">
                    <option value="">Select Union</option>
                    @if (isset($unions))
                        @foreach ($unions as $union)
                            <option value="{{ $union->id }}" {{ isset($organization->union_id) && $organization->union_id == $union->id ? 'selected' : '' }}>
                                {{ $union->name ?? 'Select Union' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error union_id_error"></small>
            </div>

            {{-- Registered address postal and location selectors --}}
            <div class="col-sm-4">
                <label for="post_office_id">Post Office</label>
                <select name="post_office_id" class="form-control select2 select2bs4" id="post_office_id">
                    <option value="">Select Post Office</option>
                    @if (isset($post_officeses))
                        @foreach ($post_officeses as $post_officese)
                            <option value="{{ $post_officese->id }}" {{ isset($organization->post_office_id) ? ($organization->post_office_id == $post_officese->id ? 'selected' : '') : '' }}>
                                {{ $post_officese->bn_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error permanent_village_id_error"></small>
            </div>

            <div class="col-sm-4">
                <label for="village_id">Village</label>
                <select name="village_id" class="form-control select2 select2bs4" id="village_id">
                    <option value="">Select Village</option>
                    @if (isset($organization) && isset($villages))
                        @foreach ($villages as $village)
                            <option value="{{ $village->id ?? '' }}" {{ isset($organization->village_id) && $organization->village_id == $village->id ? 'selected' : '' }}>
                                {{ $village->bn_name ?? 'Select Village' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error village_id_error"></small>
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-3">
                <label for="ward_id">Ward</label>
                <select name="ward_id" class="form-control select2 select2bs4" id="ward_id">
                    <option value="">Select Ward</option>
                    @if ($wards)
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}" {{ isset($organization->ward_id) ? ($organization->ward_id == $ward->id ? 'selected' : '') : '' }}>
                                {{ $ward->en_ward_no }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error ward_id_error"></small>

            </div>
            <div class="col-sm-3">
                <label for="road">Road</label>
                <input type="text" name="road" class="form-control" id="road" value="{{ $organization->road ?? '' }}"
                    placeholder="Present Road">

                <small class="text-danger error road_error"></small>
            </div>
            <div class="col-sm-3">
                <label for="house">House/Holding No.</label>
                <input type="text" name="house" class="form-control" id="house" value="{{ $organization->house ?? '' }}"
                    placeholder="Present House">

                <small class="text-danger error house_error"></small>
            </div>
            <div class="col-sm-3">
                <label for="house">House/Holding No. (Bangla)</label>
                <input type="text" name="house_bn" class="form-control" id="house"
                    value="{{ $organization->house_bn ?? '' }}" placeholder="Present House Bangla">

                <small class="text-danger error house_error"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h5 class="section-title"><i class="fas fa-building"></i> Corporate Office/Factory Address</h5>
        </div>
    </div>

    <div class="form-group row align-items-center pt-3 office_location_cat">
        <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
            <i class="fas fa-map-marker-alt text-primary mr-1"></i> Location Type
        </label>
        <div class="col-sm-10">
            <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
                <label class="location-type-card office-location-type-card {{ (isset($organization->office_location_type) && $organization->office_location_type == 'city_type') ? 'active' : '' }}">
                    <input type="radio" name="office_location_type" value="city_type" class="office-location-type-radio d-none"
                        {{ (isset($organization->office_location_type) && $organization->office_location_type == 'city_type' ? 'checked' : '') }}>
                    <i class="fas fa-city location-icon"></i>
                    <span>City Corporation</span>
                </label>
                <label class="location-type-card office-location-type-card {{ (isset($organization->office_location_type) && $organization->office_location_type == 'pos_type') ? 'active' : '' }}">
                    <input type="radio" name="office_location_type" value="pos_type" class="office-location-type-radio d-none"
                        {{ (isset($organization->office_location_type) && $organization->office_location_type == 'pos_type' ? 'checked' : '') }}>
                    <i class="fas fa-building location-icon"></i>
                    <span>Pourashava</span>
                </label>
                <label class="location-type-card office-location-type-card {{ (isset($organization->office_location_type) && $organization->office_location_type == 'union_type') ? 'active' : '' }}">
                    <input type="radio" name="office_location_type" value="union_type" class="office-location-type-radio d-none"
                        {{ (isset($organization->office_location_type) && $organization->office_location_type == 'union_type' ? 'checked' : '') }}>
                    <i class="fas fa-warehouse location-icon"></i>
                    <span>Union</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Corporate office address fields: office division, district, thana, location type, and office-specific selectors
    --}}

    <div class="office_address_field {{ !empty($organization->office_location_type) ? '' : 'd-none' }}">
        <div class="form-group row g-4">
            <div class="col-sm-4">
                <label for="office_division_id">Division</label>
                <select name="office_division_id" class="form-control select2 select2bs4" id="office_division_id">
                    <option value="">Select Division</option>
                    @if (isset($divisions))
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ isset($organization->office_division_id) && $organization->office_division_id == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_division_id_error"></small>
            </div>
            <div class="col-sm-4">
                <label for="office_district_id">District</label>
                <select name="office_district_id" class="form-control select2 select2bs4" id="office_district_id">
                    <option value="">Select District</option>
                    @if (isset($office_districts))
                        @foreach ($office_districts as $district)
                            <option value="{{ $district->id }}" {{ isset($organization->office_district_id) && $organization->office_district_id == $district->id ? 'selected' : '' }}>
                                {{ $district->name ?? 'Select District' }}
                            </option>
                        @endforeach
                    @endif
                </select>

                <small class="text-danger error office_district_id_error"></small>
            </div>

            {{-- Office city corporation option shown when office location type is city corporation --}}
            <div class="col-sm-4 office_city_type {{ !empty($organization->office_city_id) ? '' : 'd-none' }}">
                <label for="city_corporation_id">City Corporation</label>
                <select name="office_city_id" class="form-control select2 select2bs4" id="office_city_corporation_id" data-type="City">
                    <option value="">Select City Corporation</option>
                    @if (isset($office_city_corporations))
                        @foreach ($office_city_corporations as $city_corporation)
                            <option value="{{ $city_corporation->id }}" {{ isset($organization->office_city_id) ? ($organization->office_city_id == $city_corporation->id ? 'selected' : '') : '' }}>
                                {{ $city_corporation->bn_name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_city_id"></small>
            </div>

            <div class="col-sm-4">
                <label for="office_thana_id">Thana</label>
                <select name="office_thana_id" class="form-control select2 select2bs4" id="office_thana_id">
                    <option value="">Select Thana</option>
                    @if (isset($office_thanas))
                        @foreach ($office_thanas as $thana)
                            <option value="{{ $thana->id }}" {{ isset($organization->office_thana_id) && $organization->office_thana_id == $thana->id ? 'selected' : '' }}>
                                {{ $thana->name ?? 'Select Thana' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_thana_id_error"></small>
            </div>

            {{-- Office pourashava option shown when office location type is pourashava --}}
            <div class="col-sm-4 office_pos_type {{ !empty($organization->office_pos_id) ? '' : 'd-none' }}">
                <label for="pourashova_id">Pourashova</label>
                <select name="office_pos_id" class="form-control select2 select2bs4" id="office_pourashova_id"
                    data-type="pourashova">
                    <option value="">Select City Pourashova</option>
                    @if (isset($office_pourashavas))
                        @foreach ($office_pourashavas as $pourashava)
                            <option value="{{ $pourashava->id }}" {{ isset($organization->office_pos_id) ? ($organization->office_pos_id == $pourashava->id ? 'selected' : '') : '' }}>
                                {{ $pourashava->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error permanent_village_id_error"></small>
            </div>


            {{-- Office union option shown when office location type is union --}}
            <div class="col-sm-4 office_union_type {{ !empty($organization->office_union_id) ? '' : 'd-none' }}">
                <label for="union_id">Union</label>
                <select name="office_union_id" class="form-control select2 select2bs4" id="office_union_id"
                    data-type="union">
                    <option value="">Select Union</option>
                    @if (isset($office_unions))
                        @foreach ($office_unions as $union)
                            <option value="{{ $union->id }}" {{ isset($organization->office_union_id) && $organization->office_union_id == $union->id ? 'selected' : '' }}>
                                {{ $union->name ?? 'Select Union' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_union_id_error"></small>
            </div>

            {{-- Corporate office postal and location selectors --}}
            <div class="col-sm-4">
                <label for="office_post_office_id">Post Office</label>
                <select name="office_post_office_id" class="form-control select2 select2bs4" id="office_post_office_id">
                    <option value="">Select Post Office </option>
                    @if (isset($office_post_officeses))
                        @foreach ($office_post_officeses as $post_officese)
                            <option value="{{ $post_officese->id }}" {{ isset($organization->office_post_office_id) ? ($organization->office_post_office_id == $post_officese->id ? 'selected' : '') : '' }}>
                                {{ $post_officese->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_post_office_id_error"></small>
            </div>

            <div class="col-sm-4">
                <label for="office_village_id">Village</label>
                <select name="office_village_id" class="form-control select2 select2bs4" id="office_village_id">
                    <option value="">Select Village</option>
                    @if (isset($organization) && isset($office_villages))
                        @foreach ($office_villages as $village)
                            <option value="{{ $village->id ?? '' }}" {{ isset($organization->office_village_id) && $organization->office_village_id == $village->id ? 'selected' : '' }}>
                                {{ $village->bn_name ?? 'Select Village' }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_village_id_error"></small>
            </div>
        </div>




        <div class="form-group row">
            <div class="col-sm-3">
                <label for="office_ward_id">Ward</label>
                <select name="office_ward_id" class="form-control select2 select2bs4" id="office_ward_id">
                    <option value="">Select Ward</option>
                    @if ($wards)
                        @foreach ($wards as $ward)
                            <option value="{{ $ward->id }}" {{ isset($organization->office_ward_id) ? ($organization->office_ward_id == $ward->id ? 'selected' : '') : '' }}>
                                {{ $ward->en_ward_no }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <small class="text-danger error office_ward_id_error"></small>

            </div>
            <div class="col-sm-3">
                <label for="office_road">Road</label>
                <input type="text" name="office_road" class="form-control" id="office_road"
                    value="{{ $organization->office_road ?? '' }}" placeholder="Present Road">

                <small class="text-danger error office_road_error"></small>
            </div>
            <div class="col-sm-3">
                <label for="office_house">House/Holding No.</label>
                <input type="text" name="office_house" class="form-control" id="office_house"
                    value="{{ $organization->office_house ?? '' }}" placeholder="Present House">

                <small class="text-danger error office_house_error"></small>
            </div>
            <div class="col-sm-3">
                <label for="office_house_bn">House/Holding No. (Bangla)</label>
                <input type="text" name="office_house_bn" class="form-control" id="office_house_bn"
                    value="{{ $organization->office_house_bn ?? '' }}" placeholder="Present House Bangla">

                <small class="text-danger error office_house_error"></small>
            </div>
        </div>

    </div>


    <div class="row align-items-center mb-4">
        <div class="col-sm-5">
            <input type="text" class="form-control" value="Hotel & Restaurant Logo" readonly>
        </div>
        <div class="col-sm-7">
            <div class="custom-file">
                <input type="file" name="hotel_logo" class="custom-file-input">
                <label class="custom-file-label">Choose file...</label>
            </div>
        </div>
    </div>

    <div class="form-group row pt-3 align-items-center">
        <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
            <i class="fas fa-home text-primary mr-1"></i> Premises Ownership
        </label>
        <div class="col-sm-10">
            <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
                <label class="location-type-card premises-ownership-card {{ (isset($organization->premises_ownership) && $organization->premises_ownership == 'rented') ? 'active' : '' }}">
                    <input type="radio" name="premises_ownership" value="rented" class="premises-ownership-radio d-none"
                        {{ (isset($organization->premises_ownership) && $organization->premises_ownership == 'rented') ? 'checked' : '' }}>
                    <i class="fas fa-file-contract location-icon" style="font-size: 1rem; color: #64748b;"></i>
                    <span>Rented</span>
                </label>
                
                <label class="location-type-card premises-ownership-card {{ (isset($organization->premises_ownership) && $organization->premises_ownership == 'owned') ? 'active' : '' }}">
                    <input type="radio" name="premises_ownership" value="owned" class="premises-ownership-radio d-none"
                        {{ (isset($organization->premises_ownership) && $organization->premises_ownership == 'owned') ? 'checked' : '' }}>
                    <i class="fas fa-key location-icon" style="font-size: 1rem; color: #64748b;"></i>
                    <span>Owned</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Owned premises supporting documents: shown when premises_ownership = owned --}}
    <div class="form-group row premises-docs premises-docs-owned d-none">
        <div class="col-sm-12">
            <h6 class="font-weight-bold text-dark mb-3 mt-2" style="font-size: 0.95rem;">
                <i class="fas fa-file-alt text-primary mr-1"></i> Self-Owned Premises Documents
            </h6>
        </div>
        <div class="col-sm-12">
            <div class="premises-docs-owned-list">
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control"
                            value="Proof of Land Ownership" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-primary btn-sm add-doc-row" data-target="owned" style="border-radius: 6px; padding: 4px 14px; font-weight: 600;">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control"
                            value="Building Approval Certificate" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control"
                            value="Environmental Clearance Certificate" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control"
                            value="Fire Service Clearance Certificate" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control"
                            value="National ID (NID) – Mandatory" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Rented premises supporting documents: shown when premises_ownership = rented --}}
    <div class="form-group row premises-docs premises-docs-rented d-none">
        <div class="col-sm-12">
            <h6 class="font-weight-bold text-dark mb-3 mt-2" style="font-size: 0.95rem;">
                <i class="fas fa-file-contract text-primary mr-1"></i> Rented Premises Documents
            </h6>
        </div>
        <div class="col-sm-12">
            <div class="premises-docs-rented-list">
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control"
                            value="Rental Agreement Document" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-primary btn-sm add-doc-row" data-target="rented" style="border-radius: 6px; padding: 4px 14px; font-weight: 600;">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control"
                            value="Environmental Clearance Certificate" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control"
                            value="Fire Service Clearance Certificate" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control"
                            value="National ID (NID) – Mandatory" readonly>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input">
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@push('script')
    {{-- Form scripts: dependent dropdowns, address location selectors, and premises ownership controls --}}
    <script>
        $(document).on('change', '#organization_category_id', function (e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ $subcategoryOptionsUrl ?? url('hotel-subcategory-options') }}/" + _this_value,
                    beforeSend: function () {
                        $('#organization_subcategory_id').prop("disabled", true);
                        console.log("Searcing organization category");
                    },
                    success: function (response) {
                        $('#organization_subcategory_id').html(response)
                        $('#organization_subcategory_id').prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            }
        })

        // organization_type_id change: show/hide RJSC, owner, and director fields
        $(document).on('change', '#organization_type_id', function (e) {
            let or_type_id = $(this).val();
            if (or_type_id == 2) {
                $('#rjsc_reg_no_div').addClass('d-none');
                $('#no_of_dir_div').addClass('d-none');
                $('#no_of_owner_div').removeClass('d-none');
            } else if (or_type_id == 3) {
                $('#no_of_owner_div').addClass('d-none');
                $('#rjsc_reg_no_div').removeClass('d-none');
                $('#no_of_dir_div').removeClass('d-none');
            } else if (or_type_id == 1) {
                $('#rjsc_reg_no_div').addClass('d-none');
                $('#no_of_owner_div').addClass('d-none');
                $('#no_of_dir_div').addClass('d-none');
            }

        });

        $(document).on('change', '#organization_subcategory_id', function (e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('organization-work-area-options') }}/" + _this_value,
                    beforeSend: function () {
                        $('#organization_work_area_id').prop("disabled", true);
                        console.log("Searcing Work Area");
                    },
                    success: function (response) {
                        $('#organization_work_area_id').html(response)
                        $('#organization_work_area_id').prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            }
        })

        // Present address district selector: load districts for selected division
        // Registered address: load district options when division changes
        $(document).on('change', '#division_id', function (e) {
            e.preventDefault();
            let district_id = $('#district_id')
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + division_id,
                    beforeSend: function () {
                        district_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function (response) {
                        district_id.html(response)
                        district_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        district_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                // district_id.prop("disabled", true);
            }
        })

        // Registered address: after district selection, load thana, city corporation, and pourashava options
        $(document).on('change', '#district_id', function (e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#thana_id");
            let city_corporation_id = $("#city_corporation_id");
            let pourashova_id = $("#pourashova_id");

            if (district_id) {

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                    beforeSend: function () {
                        thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function (response) {
                        thana_id.html(response)
                        thana_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    beforeSend: function () {
                        city_corporation_id.prop("disabled", true);
                        console.log("Searcing City Corporation");
                    },
                    success: function (response) {
                        city_corporation_id.html(response)
                        city_corporation_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        city_corporation_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    beforeSend: function () {
                        pourashova_id.prop("disabled", true);
                        console.log("Searcing Pourashava");
                    },
                    success: function (response) {
                        pourashova_id.html(response)
                        pourashova_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        pourashova_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

            } else {
                thana_id.prop("disabled", true);
            }

        })

        $(document).on('change', '#thana_id', function (e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let postOffice_id = $('#post_office_id');
            let union_id = $('#union_id');

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function () {
                        postOffice_id.prop("disabled", true);
                        console.log("Searcing Post Offices");
                    },
                    success: function (response) {
                        postOffice_id.html(response)
                        postOffice_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        postOffice_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                    beforeSend: function () {
                        union_id.prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function (response) {
                        union_id.html(response)
                        union_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        union_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                postOffice_id.prop("disabled", true);
            }
        })

        $('#pourashova_id, #union_id, #city_corporation_id').change(function (e) {
            e.preventDefault();
            let village_id = $('#village_id')
            let _this_value = $(this).val();
            let _this_type = $(this).data('type');
            console.log(_this_type);
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-type') }}/" + _this_value + '/' + _this_type,
                    beforeSend: function () {
                        village_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function (response) {
                        village_id.html(response)
                        village_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        village_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                // district_id.prop("disabled", true);
            }
        })


        // Office address dropdown list

        // Office address: load districts when an office division is selected
        $(document).on('change', '#office_division_id', function (e) {
            e.preventDefault();
            let district_id = $('#office_district_id')
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + division_id,
                    beforeSend: function () {
                        district_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function (response) {
                        district_id.html(response)
                        district_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        district_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                // district_id.prop("disabled", true);
            }
        })


        // Office address: after office district selection, load office thana, city corporation, and pourashava options
        $(document).on('change', '#office_district_id', function (e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#office_thana_id");
            let city_corporation_id = $("#office_city_corporation_id");
            let pourashova_id = $("#office_pourashova_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                    beforeSend: function () {
                        thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function (response) {
                        thana_id.html(response)
                        thana_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    beforeSend: function () {
                        city_corporation_id.prop("disabled", true);
                        console.log("Searcing City Corporation");
                    },
                    success: function (response) {
                        city_corporation_id.html(response)
                        city_corporation_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        city_corporation_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    beforeSend: function () {
                        pourashova_id.prop("disabled", true);
                        console.log("Searcing Pourashava");
                    },
                    success: function (response) {
                        pourashova_id.html(response)
                        pourashova_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        pourashova_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

            } else {
                thana_id.prop("disabled", true);
            }

        })

        $(document).on('change', '#office_thana_id', function (e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let postOffice_id = $('#office_post_office_id');
            let union_id = $('#office_union_id');

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function () {
                        postOffice_id.prop("disabled", true);
                        console.log("Searcing Post Offices");
                    },
                    success: function (response) {
                        postOffice_id.html(response)
                        postOffice_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        postOffice_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                    beforeSend: function () {
                        union_id.prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function (response) {
                        union_id.html(response)
                        union_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        union_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                postOffice_id.prop("disabled", true);
            }
        })

        $('#office_pourashova_id, #office_union_id, #office_city_corporation_id').change(function (e) {
            e.preventDefault();
            let village_id = $('#office_village_id')
            let _this_value = $(this).val();
            let _this_type = $(this).data('type');
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-type') }}/" + _this_value + '/' + _this_type,
                    beforeSend: function () {
                        village_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function (response) {
                        village_id.html(response)
                        village_id.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        village_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                // district_id.prop("disabled", true);
            }
        })

        // Registered address location type: show/hide city, union, or pourashava selectors based on radio selection
        // Handle click on location card label to set checked state of the nested radio button
        $(document).on('click', '.location-type-card', function() {
            let radio = $(this).find('input[type="radio"]');
            if (radio.length) {
                radio.prop('checked', true).trigger('change');
                
                // Toggle active classes
                if ($(this).hasClass('office-location-type-card')) {
                    $('.office-location-type-card').removeClass('active');
                } else if ($(this).hasClass('premises-ownership-card')) {
                    $('.premises-ownership-card').removeClass('active');
                } else {
                    $('.location-type-card:not(.office-location-type-card):not(.premises-ownership-card)').removeClass('active');
                }
                $(this).addClass('active');
            }
        });

        // Registered address location type change handler
        $(document).on('change', 'input[name="location_type"]', function() {
            let val = $(this).val();
            $('.present_address_filed').removeClass('d-none');
            $('.thana_list').removeClass('d-none');
            $('.po_list').removeClass('d-none');
            
            // Clear village selection on type change
            $('#village_id').html('<option value="">Select Village</option>').trigger('change');
            
            if (val == 'city_type') {
                $('.city_type').removeClass('d-none');
                $('.union_type').addClass('d-none');
                $('.pos_type').addClass('d-none');
            } else if (val == 'union_type') {
                $('.union_type').removeClass('d-none');
                $('.city_type').addClass('d-none');
                $('.pos_type').addClass('d-none');
            } else if (val == 'pos_type') {
                $('.pos_type').removeClass('d-none');
                $('.city_type').addClass('d-none');
                $('.union_type').addClass('d-none');
            }
        });

        // Office address location type change handler
        $(document).on('change', 'input[name="office_location_type"]', function() {
            let val = $(this).val();
            $('.office_address_field').removeClass('d-none');
            $('.office_thana_list').removeClass('d-none');
            $('.office_po_list').removeClass('d-none');
            
            // Clear village selection on type change
            $('#office_village_id').html('<option value="">Select Village</option>').trigger('change');
            
            if (val == 'city_type') {
                $('.office_city_type').removeClass('d-none');
                $('.office_union_type').addClass('d-none');
                $('.office_pos_type').addClass('d-none');
            } else if (val == 'union_type') {
                $('.office_union_type').removeClass('d-none');
                $('.office_city_type').addClass('d-none');
                $('.office_pos_type').addClass('d-none');
            } else if (val == 'pos_type') {
                $('.office_pos_type').removeClass('d-none');
                $('.office_city_type').addClass('d-none');
                $('.office_union_type').addClass('d-none');
            }
        });

        // Premises ownership change handler
        $(document).on('change', 'input[name="premises_ownership"]', function() {
            let val = $(this).val();
            if (val === 'owned') {
                $('.premises-docs-owned').removeClass('d-none');
                $('.premises-docs-rented').addClass('d-none');
            } else if (val === 'rented') {
                $('.premises-docs-rented').removeClass('d-none');
                $('.premises-docs-owned').addClass('d-none');
            }
        });

        // Add document row dynamically
        $(document).on('click', '.add-doc-row', function() {
            let target = $(this).data('target');
            let list = $(`.premises-docs-${target}-list`);
            let newRow = `
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="${target}_document_name[]" class="form-control"
                            placeholder="Enter Document Name" required>
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="${target}_document_file[]" class="custom-file-input" required>
                            <label class="custom-file-label">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-doc-row" style="border-radius: 6px; padding: 4px 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;
            list.append(newRow);
        });

        // Remove document row
        $(document).on('click', '.remove-doc-row', function() {
            $(this).closest('.premises-doc-row').remove();
        });

        // Update custom file input label with the selected filename
        $(document).on('change', '.custom-file-input', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : "Choose file...";
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endpush
