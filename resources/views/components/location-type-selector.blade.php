@props([
    // Title of the address group
    'title' => 'Address Details',

    // Location Type selector parameters
    'nameLocationType' => 'location_type',
    'selectedLocationType' => null,
    'radioClass' => 'location-type-radio',
    'cardClass' => 'location-type-card',

    // Address selector wrapper classes
    'containerClass' => 'present_address_filed',
    'cityContainerClass' => 'city_type',
    'pourashavaContainerClass' => 'pos_type',
    'unionContainerClass' => 'union_type',

    // Input/Select names
    'nameDivision' => 'division_id',
    'nameDistrict' => 'district_id',
    'nameThana' => 'thana_id',
    'nameCityCorporation' => 'city_id',
    'namePourashava' => 'pos_id',
    'nameUnion' => 'union_id',
    'namePostOffice' => 'post_office_id',
    'nameVillage' => 'village_id',
    'nameWard' => 'ward_id',
    'nameRoad' => 'road',
    'nameHouse' => 'house',
    'nameHouseBn' => 'house_bn',

    // Selected values (for edit forms)
    'selectedDivision' => null,
    'selectedDistrict' => null,
    'selectedThana' => null,
    'selectedCityCorporation' => null,
    'selectedPourashava' => null,
    'selectedUnion' => null,
    'selectedPostOffice' => null,
    'selectedVillage' => null,
    'selectedWard' => null,
    'selectedRoad' => null,
    'selectedHouse' => null,
    'selectedHouseBn' => null,

    // Data collections passed from Controller
    'divisions' => null,
    'districts' => null,
    'thanas' => null,
    'cityCorporations' => null,
    'pourashavas' => null,
    'unions' => null,
    'postOffices' => null,
    'villages' => null,
    'wards' => null,
])

@once
<style>
    .location-type-card {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        border-radius: 10px;
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        cursor: pointer;
        font-weight: 600;
        color: #475569;
        font-size: 0.92rem;
        transition: all 0.2s ease;
        margin-bottom: 0;
    }
    .location-type-card:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #1e293b;
    }
    .location-type-card.active {
        background-color: #eff6ff !important;
        border-color: #3b82f6 !important;
        color: #1d4ed8 !important;
    }
    .location-type-card.active i {
        color: #2563eb !important;
    }
    .location-icon {
        font-size: 1.1rem;
        color: #64748b;
        transition: color 0.2s ease;
    }

    /* Professional Dropdowns and Inputs Container styling */
    .address-fields-container {
        margin-top: 1.5rem;
    }

    .address-fields-container label {
        font-size: 0.82rem !important;
        font-weight: 600 !important;
        color: #475569 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        margin-bottom: 8px !important;
        display: inline-block !important;
    }

    /* Premium styling for default input/select elements */
    .address-fields-container .form-control {
        height: 42px !important;
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 8px 14px !important;
        font-size: 0.95rem !important;
        color: #334155 !important;
        background-color: #ffffff !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
        box-shadow: none !important;
    }

    .address-fields-container .form-control:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
    }

    /* Custom select chevron style */
    .address-fields-container select.form-control {
        appearance: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 14px center !important;
        background-size: 14px !important;
        padding-right: 40px !important;
    }

    /* Overwrite Select2 components to align with design */
    .address-fields-container .select2-container--bootstrap4 .select2-selection--single {
        height: 42px !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
        padding: 6px 14px !important;
        display: flex !important;
        align-items: center !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }

    .address-fields-container .select2-container--bootstrap4 .select2-selection--single:hover {
        border-color: #94a3b8 !important;
    }

    .address-fields-container .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12) !important;
    }

    .address-fields-container .select2-container--bootstrap4 .select2-selection__rendered {
        color: #334155 !important;
        font-size: 0.95rem !important;
        padding: 0 !important;
        line-height: normal !important;
    }

    .address-fields-container .select2-container--bootstrap4 .select2-selection__placeholder {
        color: #64748b !important;
    }

    .address-fields-container .select2-container--bootstrap4 .select2-selection__arrow {
        height: 100% !important;
        top: 0 !important;
        right: 12px !important;
        width: 20px !important;
    }

    .address-fields-container .select2-container--bootstrap4 .select2-selection__arrow b {
        border: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: center !important;
        background-size: 14px !important;
        width: 14px !important;
        height: 14px !important;
        margin: 0 !important;
        transform: translate(-50%, -50%) !important;
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
    }
</style>
@endonce

<div class="form-group row pt-3 location-selector-wrapper">
    <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;">
        <i class="fas fa-map-marked-alt text-primary mr-1"></i> Location Type
    </label>
    <div class="col-sm-10">
        <div class="d-flex align-items-center flex-wrap" style="gap: 12px;">
            <label class="location-type-card {{ $cardClass }} {{ $selectedLocationType == 'city_type' ? 'active' : '' }}">
                <input type="radio" name="{{ $nameLocationType }}" value="city_type" class="{{ $radioClass }} d-none"
                    {{ $selectedLocationType == 'city_type' ? 'checked' : '' }}>
                <i class="fas fa-city location-icon"></i>
                <span>City Corporation</span>
            </label>
            
            <label class="location-type-card {{ $cardClass }} {{ $selectedLocationType == 'pos_type' ? 'active' : '' }}">
                <input type="radio" name="{{ $nameLocationType }}" value="pos_type" class="{{ $radioClass }} d-none"
                    {{ $selectedLocationType == 'pos_type' ? 'checked' : '' }}>
                <i class="fas fa-building location-icon"></i>
                <span>Pourashava</span>
            </label>
            
            <label class="location-type-card {{ $cardClass }} {{ $selectedLocationType == 'union_type' ? 'active' : '' }}">
                <input type="radio" name="{{ $nameLocationType }}" value="union_type" class="{{ $radioClass }} d-none"
                    {{ $selectedLocationType == 'union_type' ? 'checked' : '' }}>
                <i class="fas fa-store location-icon"></i>
                <span>Union</span>
            </label>
        </div>
    </div>
</div>

<div class="{{ $containerClass }} address-fields-container {{ !empty($selectedLocationType) ? '' : 'd-none' }}">
    <div class="form-group row">
        <!-- Division -->
        <div class="col-sm-4">
            <label>Division</label>
            <select name="{{ $nameDivision }}" class="form-control select2 select2bs4" id="{{ $nameDivision }}">
                <option value="">Select Division</option>
                @if ($divisions)
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}"
                            {{ $selectedDivision == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameDivision }}_error"></small>
        </div>

        <!-- District -->
        <div class="col-sm-4">
            <label>District</label>
            <select name="{{ $nameDistrict }}" class="form-control select2 select2bs4" id="{{ $nameDistrict }}">
                <option value="">Select District</option>
                @if ($districts)
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}"
                            {{ $selectedDistrict == $district->id ? 'selected' : '' }}>
                            {{ $district->name ?? 'Select District' }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameDistrict }}_error"></small>
        </div>

        <!-- City Corporation -->
        <div class="col-sm-4 {{ $cityContainerClass }} {{ $selectedLocationType == 'city_type' ? '' : 'd-none' }}">
            <label>City Corporation</label>
            <select name="{{ $nameCityCorporation }}" class="form-control select2 select2bs4" id="{{ $nameCityCorporation }}">
                <option value="">Select City Corporation</option>
                @if ($cityCorporations)
                    @foreach ($cityCorporations as $cityCorporation)
                        <option value="{{ $cityCorporation->id }}"
                            {{ $selectedCityCorporation == $cityCorporation->id ? 'selected' : '' }}>
                            {{ $cityCorporation->bn_name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameCityCorporation }}_error"></small>
        </div>

        <!-- Thana -->
        <div class="col-sm-4">
            <label>Thana</label>
            <select name="{{ $nameThana }}" class="form-control select2 select2bs4" id="{{ $nameThana }}">
                <option value="">Select Thana</option>
                @if ($thanas)
                    @foreach ($thanas as $thana)
                        <option value="{{ $thana->id }}"
                            {{ $selectedThana == $thana->id ? 'selected' : '' }}>
                            {{ $thana->name ?? 'Select Thana' }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameThana }}_error"></small>
        </div>

        <!-- Pourashava -->
        <div class="col-sm-4 {{ $pourashavaContainerClass }} {{ $selectedLocationType == 'pos_type' ? '' : 'd-none' }}">
            <label>Pourashava</label>
            <select name="{{ $namePourashava }}" class="form-control select2 select2bs4" id="{{ $namePourashava }}" data-type="pourashova">
                <option value="">Select Pourashava</option>
                @if ($pourashavas)
                    @foreach ($pourashavas as $pourashava)
                        <option value="{{ $pourashava->id }}"
                            {{ $selectedPourashava == $pourashava->id ? 'selected' : '' }}>
                            {{ $pourashava->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $namePourashava }}_error"></small>
        </div>

        <!-- Union -->
        <div class="col-sm-4 {{ $unionContainerClass }} {{ $selectedLocationType == 'union_type' ? '' : 'd-none' }}">
            <label>Union</label>
            <select name="{{ $nameUnion }}" class="form-control select2 select2bs4" id="{{ $nameUnion }}" data-type="union">
                <option value="">Select Union</option>
                @if ($unions)
                    @foreach ($unions as $union)
                        <option value="{{ $union->id }}"
                            {{ $selectedUnion == $union->id ? 'selected' : '' }}>
                            {{ $union->name ?? 'Select Union' }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameUnion }}_error"></small>
        </div>

        <!-- Post Office -->
        <div class="col-sm-4">
            <label>Post Office</label>
            <select name="{{ $namePostOffice }}" class="form-control select2 select2bs4" id="{{ $namePostOffice }}">
                <option value="">Select Post Office</option>
                @if ($postOffices)
                    @foreach ($postOffices as $postOffice)
                        <option value="{{ $postOffice->id }}"
                            {{ $selectedPostOffice == $postOffice->id ? 'selected' : '' }}>
                            {{ $postOffice->bn_name ?? $postOffice->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $namePostOffice }}_error"></small>
        </div>

        <!-- Village -->
        <div class="col-sm-4">
            <label>Village</label>
            <select name="{{ $nameVillage }}" class="form-control select2 select2bs4" id="{{ $nameVillage }}">
                <option value="">Select Village</option>
                @if ($villages)
                    @foreach ($villages as $village)
                        <option value="{{ $village->id }}"
                            {{ $selectedVillage == $village->id ? 'selected' : '' }}>
                            {{ $village->bn_name ?? 'Select Village' }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameVillage }}_error"></small>
        </div>
    </div>

    <!-- Ward, Road, House/Holding No -->
    <div class="form-group row">
        <div class="col-sm-3">
            <label>Ward</label>
            <select name="{{ $nameWard }}" class="form-control select2 select2bs4" id="{{ $nameWard }}">
                <option value="">Select Ward</option>
                @if ($wards)
                    @foreach ($wards as $ward)
                        <option value="{{ $ward->id }}"
                            {{ $selectedWard == $ward->id ? 'selected' : '' }}>
                            {{ $ward->en_ward_no }}
                        </option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error {{ $nameWard }}_error"></small>
        </div>

        <div class="col-sm-3">
            <label>Road</label>
            <input type="text" name="{{ $nameRoad }}" class="form-control" id="{{ $nameRoad }}"
                value="{{ $selectedRoad }}" placeholder="Present Road">
            <small class="text-danger error {{ $nameRoad }}_error"></small>
        </div>

        <div class="col-sm-3">
            <label>House/Holding No.</label>
            <input type="text" name="{{ $nameHouse }}" class="form-control" id="{{ $nameHouse }}"
                value="{{ $selectedHouse }}" placeholder="Present House">
            <small class="text-danger error {{ $nameHouse }}_error"></small>
        </div>

        <div class="col-sm-3">
            <label>House/Holding No. (Bangla)</label>
            <input type="text" name="{{ $nameHouseBn }}" class="form-control" id="{{ $nameHouseBn }}"
                value="{{ $selectedHouseBn }}" placeholder="Present House Bangla">
            <small class="text-danger error {{ $nameHouseBn }}_error"></small>
        </div>
    </div>
</div>
