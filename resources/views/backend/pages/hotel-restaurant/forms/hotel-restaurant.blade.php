

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
                        <option value="{{ $category->id }}"
                            {{ isset($organization->hotel_category_id) ? ($organization->hotel_category_id == $category->id ? 'selected' : '') : '' }}>
                            {{ $category->en_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-4">
            <label for="organization_subcategory_id">Sub Category</label>
            <select class="form-control select2" name="organization_subcategory_id" id="organization_subcategory_id">
                @if (isset($organization->hotel_subcategory_id))
                    <option value="{{ $organization->hotel_subcategory_id }}">
                        {{ $organization->subcategory->en_name }}</option>
                @endif
            </select>
        </div>
        <div class="col-sm-4">
            <label for="organization_type_id">Type </label>
            <select class="form-control select2" name="organization_type_id" id="organization_type_id">
                <option value="">Select Type </option>
                @if (isset($types))
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ isset($organization->hotel_type_id) ? ($organization->hotel_type_id == $type->id ? 'selected' : '') : '' }}>
                            {{ $type->en_name }}</option>
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
                <option value="new"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'new' ? 'selected' : '') : '' }}>
                    NEW</option>
                <option value="old"
                    {{ isset($organization->application_type) ? ($organization->application_type == 'old' ? 'selected' : '') : '' }}>
                    OLD</option>
            </select>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-12">
            <h5 class="text-secondary mb-2">Registered Address</h5>
        </div>
    </div>

    <x-location-type-selector
        title="Registered Address"
        nameLocationType="location_type"
        nameDivision="division_id"
        nameDistrict="district_id"
        nameThana="thana_id"
        nameCityCorporation="city_id"
        namePourashava="pos_id"
        nameUnion="union_id"
        namePostOffice="post_office_id"
        nameVillage="village_id"
        nameWard="ward_id"
        nameRoad="road"
        nameHouse="house"
        nameHouseBn="house_bn"
        :selectedLocationType="$organization->location_type ?? null"
        :selectedDivision="$organization->division_id ?? null"
        :selectedDistrict="$organization->district_id ?? null"
        :selectedThana="$organization->thana_id ?? null"
        :selectedCityCorporation="$organization->city_id ?? null"
        :selectedPourashava="$organization->pos_id ?? null"
        :selectedUnion="$organization->union_id ?? null"
        :selectedPostOffice="$organization->post_office_id ?? null"
        :selectedVillage="$organization->village_id ?? null"
        :selectedWard="$organization->ward_id ?? null"
        :selectedRoad="$organization->road ?? null"
        :selectedHouse="$organization->house ?? null"
        :selectedHouseBn="$organization->house_bn ?? null"
        :divisions="$divisions ?? null"
        :districts="$districts ?? null"
        :thanas="$thanas ?? null"
        :cityCorporations="$city_corporations ?? null"
        :pourashavas="$pourashavas ?? null"
        :unions="$unions ?? null"
        :postOffices="$post_officeses ?? null"
        :villages="$villages ?? null"
        :wards="$wards ?? null"
        containerClass="present_address_filed"
        cityContainerClass="city_type"
        pourashavaContainerClass="pos_type"
        unionContainerClass="union_type"
        radioClass="location-type-radio"
        cardClass="location-type-card"
    />


    <div class="row align-items-center mb-2">
        <div class="col-sm-5">
            <input type="text" class="form-control form-control-sm" value="Hotel & Restaurant Logo" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
        </div>
        <div class="col-sm-5">
            <div class="custom-file">
                <input type="file" name="hotel_logo" class="custom-file-input form-control-sm">
                <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
            </div>
        </div>
    </div>

    <div class="form-group row pt-3 align-items-center">
        <label class="col-sm-2 col-form-label font-weight-bold" style="font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase; color: #475569;"><i class="fas fa-home text-primary mr-1"></i> Premises Ownership</label>
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
            <h6 class="text-secondary mb-3 font-weight-bold" style="font-size: 0.95rem; color: #475569;"><i class="fas fa-file-alt text-primary mr-1"></i> Self-Owned Premises Documents</h6>
        </div>
        <div class="col-sm-12">
            <div class="premises-docs-owned-list">
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control form-control-sm"
                            value="Proof of Land Ownership" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-primary btn-sm add-doc-row" data-target="owned" style="border-radius: 6px; padding: 4px 12px; font-weight: 600;">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="owned_document_name[]" class="form-control form-control-sm"
                            value="Building Approval Certificate" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
                        <input type="text" name="owned_document_name[]" class="form-control form-control-sm"
                            value="Environmental Clearance Certificate" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
                        <input type="text" name="owned_document_name[]" class="form-control form-control-sm"
                            value="Fire Service Clearance Certificate" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
                        <input type="text" name="owned_document_name[]" class="form-control form-control-sm"
                            value="National ID (NID) – Mandatory" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="owned_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
            <h6 class="text-secondary mb-3 font-weight-bold" style="font-size: 0.95rem; color: #475569;"><i class="fas fa-file-alt text-primary mr-1"></i> Rented Premises Documents</h6>
        </div>
        <div class="col-sm-12">
            <div class="premises-docs-rented-list">
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control form-control-sm"
                            value="Rental Agreement Document" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
                        </div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <button type="button" class="btn btn-primary btn-sm add-doc-row" data-target="rented" style="border-radius: 6px; padding: 4px 12px; font-weight: 600;">
                            <i class="fas fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
                <div class="row align-items-center mb-2 premises-doc-row">
                    <div class="col-sm-5">
                        <input type="text" name="rented_document_name[]" class="form-control form-control-sm"
                            value="Environmental Clearance Certificate" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
                        <input type="text" name="rented_document_name[]" class="form-control form-control-sm"
                            value="Fire Service Clearance Certificate" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
                        <input type="text" name="rented_document_name[]" class="form-control form-control-sm"
                            value="National ID (NID) – Mandatory" readonly style="background-color: #f8fafc; border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="rented_document_file[]" class="custom-file-input form-control-sm">
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
        $(document).on('change', '#organization_category_id', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('hotel-subcategory-options') }}/" + _this_value,
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

        // organization_type_id change: show/hide RJSC, owner, and director fields
        $(document).on('change', '#organization_type_id', function(e) {
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

        $(document).on('change', '#organization_subcategory_id', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('organization-work-area-options') }}/" + _this_value,
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

        // Present address district selector: load districts for selected division
        // Registered address: load district options when division changes
        $(document).on('change', '#division_id', function(e) {
            e.preventDefault();
            let district_id = $('#district_id')
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
                // district_id.prop("disabled", true);
            }
        })

        // Registered address: after district selection, load thana, city corporation, and pourashava options
        $(document).on('change', '#district_id', function(e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#thana_id");
            let city_corporation_id = $("#city_corporation_id");
            let pourashova_id = $("#pourashova_id");

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

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    beforeSend: function() {
                        city_corporation_id.prop("disabled", true);
                        console.log("Searcing City Corporation");
                    },
                    success: function(response) {
                        city_corporation_id.html(response)
                        city_corporation_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        city_corporation_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    beforeSend: function() {
                        pourashova_id.prop("disabled", true);
                        console.log("Searcing Pourashava");
                    },
                    success: function(response) {
                        pourashova_id.html(response)
                        pourashova_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        pourashova_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

            } else {
                thana_id.prop("disabled", true);
            }

        })

        $(document).on('change', '#thana_id', function(e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let postOffice_id = $('#post_office_id');
            let union_id = $('#union_id');

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function() {
                        postOffice_id.prop("disabled", true);
                        console.log("Searcing Post Offices");
                    },
                    success: function(response) {
                        postOffice_id.html(response)
                        postOffice_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        postOffice_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
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
                postOffice_id.prop("disabled", true);
            }
        })

        $('#pourashova_id, #union_id').change(function(e) {
            e.preventDefault();
            let village_id = $('#village_id')
            let _this_value = $(this).val();
            let _this_type = $(this).data('type');
            console.log(_this_type);
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-type') }}/" + _this_value + '/' + _this_type,
                    beforeSend: function() {
                        village_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        village_id.html(response)
                        village_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
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
        $(document).on('change', '#office_division_id', function(e) {
            e.preventDefault();
            let district_id = $('#office_district_id')
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
                // district_id.prop("disabled", true);
            }
        })


        // Office address: after office district selection, load office thana, city corporation, and pourashava options
        $(document).on('change', '#office_district_id', function(e) {
            e.preventDefault();
            let district_id = $(this).val();
            let thana_id = $("#office_thana_id");
            let city_corporation_id = $("#office_city_corporation_id");
            let pourashova_id = $("#office_pourashova_id");

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
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    beforeSend: function() {
                        city_corporation_id.prop("disabled", true);
                        console.log("Searcing City Corporation");
                    },
                    success: function(response) {
                        city_corporation_id.html(response)
                        city_corporation_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        city_corporation_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    beforeSend: function() {
                        pourashova_id.prop("disabled", true);
                        console.log("Searcing Pourashava");
                    },
                    success: function(response) {
                        pourashova_id.html(response)
                        pourashova_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        pourashova_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });

            } else {
                thana_id.prop("disabled", true);
            }

        })

        $(document).on('change', '#office_thana_id', function(e) {
            e.preventDefault();
            let thana_id = $(this).val();
            let postOffice_id = $('#office_post_office_id');
            let union_id = $('#office_union_id');

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-postOffice-by-thana') }}/" + thana_id,
                    beforeSend: function() {
                        postOffice_id.prop("disabled", true);
                        console.log("Searcing Post Offices");
                    },
                    success: function(response) {
                        postOffice_id.html(response)
                        postOffice_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        postOffice_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
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
                postOffice_id.prop("disabled", true);
            }
        })

        $('#office_pourashova_id, #office_union_id').change(function(e) {
            e.preventDefault();
            let village_id = $('#office_village_id')
            let _this_value = $(this).val();
            let _this_type = $(this).data('type');
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-villages-by-type') }}/" + _this_value + '/' + _this_type,
                    beforeSend: function() {
                        village_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        village_id.html(response)
                        village_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
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
        $(document).on('change', '.location-type-radio', function() {
            let val = $(this).val();

            // Toggle active card class
            let container = $(this).closest('.col-sm-10');
            container.find('.location-type-card').removeClass('active');
            if ($(this).is(':checked')) {
                $(this).closest('.location-type-card').addClass('active');
            }

            $('.present_address_filed').removeClass('d-none');
            $('.thana_list').removeClass('d-none');
            $('.po_list').removeClass('d-none');

            // Show selected location type and hide others
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

        // Office address location type: show/hide office city, union, or pourashava selectors based on radio selection
        $(document).on('change', '.office-location-type-radio', function() {
            let val = $(this).val();

            // Toggle active card class
            let container = $(this).closest('.col-sm-10');
            container.find('.office-location-type-card').removeClass('active');
            if ($(this).is(':checked')) {
                $(this).closest('.office-location-type-card').addClass('active');
            }

            $('.office_address_field').removeClass('d-none');
            $('.office_thana_list').removeClass('d-none');
            $('.office_po_list').removeClass('d-none');

            // Show selected office location type and hide others
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

        // Premises ownership: show owned or rented document sections based on radio selection
        $(document).on('change', 'input[name="premises_ownership"]', function() {
            // Toggle active card class
            let container = $(this).closest('.col-sm-10');
            container.find('.premises-ownership-card').removeClass('active');
            if ($(this).is(':checked')) {
                $(this).closest('.premises-ownership-card').addClass('active');
            }

            // When 'owned' is selected, show owned documents section and hide rented section
            if ($(this).val() === 'owned') {
                $('.premises-docs-owned').removeClass('d-none');
                $('.premises-docs-rented').addClass('d-none');
            } else if ($(this).val() === 'rented') {
                // When 'rented' is selected, show rented documents section and hide owned section
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
                        <input type="text" name="${target}_document_name[]" class="form-control form-control-sm"
                            placeholder="Enter Document Name" required style="border-color: #cbd5e1; font-weight: 500; color: #475569;">
                    </div>
                    <div class="col-sm-5">
                        <div class="custom-file">
                            <input type="file" name="${target}_document_file[]" class="custom-file-input form-control-sm" required>
                            <label class="custom-file-label col-form-label-sm" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Choose file...</label>
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
