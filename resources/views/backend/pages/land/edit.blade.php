@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCreate'])

@section('title', 'জমির রেকর্ড সম্পাদনা')

@php
    $blankLocation = [
        'record' => '',
        'district_id' => '',
        'thana_id' => '',
        'mouza_id' => '',
        'dag_no' => '',
        'khatian' => '',
        'record_group' => '',
        'total_dag_no' => '',
        'total_land' => '',
        'record_owner_name' => '',
    ];
    $locationRows = is_array($land->locations) && count($land->locations) ? $land->locations : [$blankLocation];
    $documentRows = is_array($land->documents) ? $land->documents : [];
@endphp



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>নতুন জমির এন্ট্রি</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('land.index') }}">জমির রেকর্ড</a></li>
                        <li class="breadcrumb-item active">সম্পাদনা</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">

                <form id="FormSubmit" method="POST" enctype="multipart/form-data"
                    action="{{ route('land.update', $land->id) }}" data-url="{{ route('land.update', $land->id) }}"
                    data-redirect-url="{{ route('land.index') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="approve" id="approve_input" value="0">

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-map-marked-alt"></i> জমির এন্ট্রি ফরম</h3>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="land_type">জমির ধরণ <span class="text-danger">*</span></label>
                                        <select name="land_type" id="land_type" class="form-control select2" required>
                                            <option value="">Select Land Type</option>
                                            @foreach($landTypes as $type)
                                                <option value="{{ $type->id }}" @selected($land->land_type == $type->id)>
                                                    {{ $type->bn_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="record_type">রেকর্ড <span class="text-danger">*</span></label>
                                        <select name="record_type" id="record_type" class="form-control select2" required>
                                            <option value="">Select Record</option>
                                            @foreach($records as $rec)
                                                <option value="{{ $rec->id }}" @selected($land->record_type == $rec->id)>
                                                    {{ $rec->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="district_id">জেলা <span class="text-danger">*</span></label>
                                        <select name="district_id" id="district_id" class="form-control select2" required>
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}"
                                                    @selected($land->district_id == $district->id)>{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="upazila_id">উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila_id" id="upazila_id" class="form-control select2" required>
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $upazila)
                                                <option value="{{ $upazila->id }}" @selected($land->upazila_id == $upazila->id)>
                                                    {{ $upazila->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="mouza_id">মৌজা <span class="text-danger">*</span></label>
                                        <select name="mouza_id" id="mouza_id" class="form-control select2" required>
                                            <option value="">Select Mouza</option>
                                            @foreach($mouzas as $mouza)
                                                <option value="{{ $mouza->id }}" @selected($land->mouza_id == $mouza->id)>
                                                    {{ $mouza->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-list-ol"></i> জমির বিবরণ</h3>
                        </div>
                        <div style="overflow-x: auto;">
                            <table style="width:100%; border-collapse:collapse; font-size:13px; font-family: inherit;">
                                <thead>
                                    <tr
                                        style="background: linear-gradient(135deg,#0f766e,#115e59); color:#fff; text-align:center;">
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:80px;">
                                            দাগ নং <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:80px;">
                                            খতিয়ান নং <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:140px;">
                                            রেকর্ডীয় শ্রেণি <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:140px;">
                                            বাস্তব শ্রেণি <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:120px;">
                                            দাগে মোট জমি (একর) <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:120px;">
                                            জমির পরিমাণ (একর) <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:140px;">
                                            দখল সংক্রান্ত অবস্থা <span style="color:#fca5a5;">*</span></th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:90px;">
                                            মামলা নং</th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:120px;">
                                            গেজেট/প্রমাণক নং</th>
                                        <th
                                            style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:160px;">
                                            মন্তব্য</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="background:#ffffff;">
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="text" name="details[0][dag_no]"
                                                class="form-control form-control-sm" value="{{ $land->dag_no ?? '' }}"
                                                required>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="text" name="details[0][khatian_no]"
                                                class="form-control form-control-sm" value="{{ $land->khatian_no ?? '' }}"
                                                required>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <select name="details[0][recorded_class]"
                                                class="form-control form-control-sm select2" required>
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach($recordGroups as $group)
                                                    <option value="{{ $group->id }}"
                                                        @selected($land->recorded_class == $group->id)>{{ $group->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <select name="details[0][actual_class]"
                                                class="form-control form-control-sm select2" required>
                                                <option value="">নির্বাচন করুন</option>
                                                @foreach($recordGroups as $group)
                                                    <option value="{{ $group->id }}" @selected($land->actual_class == $group->id)>
                                                        {{ $group->bn_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="number" step="any" name="details[0][total_land]"
                                                class="form-control form-control-sm" value="{{ $land->total_land ?? '' }}"
                                                required>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="number" step="any" name="details[0][land_amount]"
                                                class="form-control form-control-sm" value="{{ $land->land_amount ?? '' }}"
                                                required>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <select name="details[0][possession_status]"
                                                class="form-control form-control-sm select2" required>
                                                <option value="">নির্বাচন করুন</option>
                                                <option value="সরকার পক্ষে" @selected($land->possession_status == 'সরকার পক্ষে')>সরকার পক্ষে</option>
                                                <option value="দখলে" @selected($land->possession_status == 'দখলে')>দখলে
                                                </option>
                                                <option value="বেদখল" @selected($land->possession_status == 'বেদখল')>বেদখল
                                                </option>
                                                <option value="অন্যান্য" @selected($land->possession_status == 'অন্যান্য')>
                                                    অন্যান্য</option>
                                            </select>
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="text" name="details[0][case_no]"
                                                class="form-control form-control-sm" value="{{ $land->case_no ?? '' }}">
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="text" name="details[0][gazette_no]"
                                                class="form-control form-control-sm" value="{{ $land->gazette_no ?? '' }}">
                                        </td>
                                        <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                            <input type="text" name="details[0][remarks]"
                                                class="form-control form-control-sm" value="{{ $land->remarks ?? '' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="cioas-panel">
                            <div class="cioas-panel-header" style="cursor:pointer;" id="locationToggleHeader">
                                <h3 class="cioas-panel-title"><i class="fas fa-map-marked-alt"></i> রেকর্ড অনুযায়ী অবস্থান
                                    তথ্য</h3>
                                <button type="button" class="btn btn-sm btn-outline-info" id="locationToggleBtn">
                                    <i class="fas fa-chevron-down" id="locationToggleIcon"></i> দেখুন
                                </button>
                            </div>
                            <div style="overflow-x: auto; display:none;" id="locationTableWrapper">
                                <table style="width:100%; border-collapse:collapse; font-size:13px; font-family: inherit;">
                                    <thead>
                                        <tr
                                            style="background: linear-gradient(135deg,#0f766e,#115e59); color:#fff; text-align:center;">
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:75px;">
                                                রেকর্ড</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:140px;">
                                                জেলা</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:155px;">
                                                উপজেলা</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:155px;">
                                                মৌজা</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:80px;">
                                                দাগ নং</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:80px;">
                                                খতিয়ান</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:120px;">
                                                রেকর্ড শ্রেণি</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:85px;">
                                                মোট দাগ নং</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:100px;">
                                                মোট জমি (একর)</th>
                                            <th
                                                style="padding:10px 8px; white-space:nowrap; border:1px solid #0d6460; min-width:160px;">
                                                রেকর্ডীয় মালিকের নাম</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $recIndex => $rec)
                                            @php
                                                $savedLoc = collect($locationRows)->firstWhere('record_type', $rec->id) ?? collect($locationRows)->firstWhere('record', $rec->id) ?? [];
                                                $rowBg = $recIndex % 2 === 0 ? '#ffffff' : '#f8fffe';
                                            @endphp
                                            <tr style="background:{{ $rowBg }}; transition: background 0.2s;" class="loc-row"
                                                data-record-id="{{ $rec->id }}" onmouseover="this.style.background='#e6f7f5'"
                                                onmouseout="this.style.background='{{ $rowBg }}'">

                                                {{-- Record badge --}}
                                                <td
                                                    style="padding:6px 8px; border:1px solid #e2e8f0; text-align:center; vertical-align:middle;">
                                                    <span
                                                        style="display:inline-block; background:#0f766e; color:#fff; font-weight:700; font-size:11px; padding:3px 8px; border-radius:12px; white-space:nowrap; letter-spacing:.4px;">
                                                        {{ $rec->name }}
                                                    </span>
                                                    <input type="hidden" name="location[{{ $recIndex }}][record]"
                                                        value="{{ $rec->id }}">
                                                </td>

                                                {{-- District --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <select name="location[{{ $recIndex }}][district_id]"
                                                        id="loc_district_{{ $recIndex }}" data-row="{{ $recIndex }}"
                                                        data-record="{{ $rec->id }}"
                                                        data-selected-thana="{{ $savedLoc['upazila_id'] ?? $savedLoc['thana_id'] ?? '' }}"
                                                        data-selected-mouza="{{ $savedLoc['mouza_id'] ?? '' }}"
                                                        class="form-control form-control-sm select2 location-district">
                                                        <option value="">-- জেলা নির্বাচন --</option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->id }}" @selected((string) ($savedLoc['district_id'] ?? '') === (string) $district->id)>
                                                                {{ $district->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                {{-- Upazila --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <select name="location[{{ $recIndex }}][thana_id]"
                                                        id="loc_thana_{{ $recIndex }}" data-row="{{ $recIndex }}"
                                                        class="form-control form-control-sm select2 location-thana">
                                                        <option value="">-- উপজেলা --</option>
                                                    </select>
                                                </td>

                                                {{-- Mouza --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <select name="location[{{ $recIndex }}][mouza_id]"
                                                        id="loc_mouza_{{ $recIndex }}" data-row="{{ $recIndex }}"
                                                        class="form-control form-control-sm select2 location-mouza">
                                                        <option value="">-- মৌজা --</option>
                                                    </select>
                                                </td>

                                                {{-- Dag No --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <input type="number" name="location[{{ $recIndex }}][dag_no]"
                                                        class="form-control form-control-sm" style="text-align:center;"
                                                        value="{{ $savedLoc['dag_no'] ?? '' }}" placeholder="০" min="0">
                                                </td>

                                                {{-- Khatian --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <input type="number" name="location[{{ $recIndex }}][khatian]"
                                                        class="form-control form-control-sm" style="text-align:center;"
                                                        value="{{ $savedLoc['khatian_no'] ?? $savedLoc['khatian'] ?? '' }}"
                                                        placeholder="০" min="0">
                                                </td>

                                                {{-- Record Group --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <select name="location[{{ $recIndex }}][record_group]"
                                                        id="loc_rg_{{ $recIndex }}"
                                                        class="form-control form-control-sm select2">
                                                        <option value="">-- শ্রেণি --</option>
                                                        @foreach ($recordGroups as $group)
                                                            <option value="{{ $group->id }}" @selected(($savedLoc['record_group'] ?? '') == $group->id)>
                                                                {{ $group->bn_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                {{-- Total Dag No --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <input type="number" name="location[{{ $recIndex }}][total_dag_no]"
                                                        class="form-control form-control-sm" style="text-align:center;"
                                                        value="{{ $savedLoc['total_dag_no'] ?? '' }}" placeholder="০" min="0">
                                                </td>

                                                {{-- Total Land --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <input type="number" name="location[{{ $recIndex }}][total_land]"
                                                        class="form-control form-control-sm" style="text-align:center;"
                                                        value="{{ $savedLoc['total_land'] ?? '' }}" placeholder="০.০০০০" min="0"
                                                        step="0.0001">
                                                </td>

                                                {{-- Owner Name --}}
                                                <td style="padding:5px 6px; border:1px solid #e2e8f0; vertical-align:middle;">
                                                    <input type="text" name="location[{{ $recIndex }}][record_owner_name]"
                                                        class="form-control form-control-sm"
                                                        value="{{ $savedLoc['owner_name'] ?? $savedLoc['record_owner_name'] ?? '' }}"
                                                        placeholder="মালিকের নাম">
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="cioas-panel">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-paperclip"></i> গেজেট/প্রমাণক / ছবি সংযোজন
                                </h3>
                                <button class="btn btn-sm btn-outline-success add-file" type="button"><i
                                        class="fas fa-plus"></i> Add More</button>
                            </div>
                            <div class="cioas-panel-body" id="file_wrap">
                                @foreach($documentRows as $doc)
                                    <div class="party-item" data-file-item>
                                        <div class="party-item-top">
                                            <span class="party-item-title">Attachment</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-existing-file"
                                                data-path="{{ $doc['file_path'] }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="existing_documents[]" value="{{ $doc['file_path'] }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>ফাইলের নাম / প্রমাণকের নাম</label>
                                                    <input type="text" class="form-control md-control"
                                                        value="{{ $doc['document_name'] ?? 'Document' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>বর্তমান ফাইল</label>
                                                    <div>
                                                        <a href="{{ str_starts_with($doc['file_path'] ?? '', 'uploads/') ? asset($doc['file_path']) : asset('storage/' . ($doc['file_path'] ?? '')) }}" target="_blank"
                                                            class="btn btn-sm btn-info text-white">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="party-item" data-file-item>
                                    <div class="party-item-top">
                                        <span class="party-item-title">New Attachment</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-file">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-field">
                                                <label>ফাইলের নাম / প্রমাণকের নাম</label>
                                                <input type="text" name="attachments[0][name]"
                                                    class="form-control md-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-field">
                                                <label>ফাইল নির্বাচন করুন</label>
                                                <input type="file" name="attachments[0][file]"
                                                    class="form-control md-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cioas-actions">
                            <a href="{{ route('land.index') }}" class="btn btn-light btn-material">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-material btn-material-primary" id="btnSave">
                                <i class="fas fa-save"></i> Update Form
                        </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            let detailIndex = 1;
            let fileIndex = 1;



            // ── Location table helpers ──────────────────────────────────────
            function initLocSelect2(jqEl) {
                jqEl.select2({ theme: 'bootstrap4', width: '100%' });
            }

            // Init select2 on all location selects
            $('select.location-district, select.location-thana, select.location-mouza, select[id^="loc_rg_"]').each(function () {
                initLocSelect2($(this));
            });

            function loadLocMouzas(row, thanaId, selectedMouza) {
                let mouza = $('#loc_mouza_' + row);
                mouza.html('<option value="">লোড হচ্ছে...</option>').trigger('change.select2');
                if (!thanaId) { mouza.html('<option value="">-- মৌজা --</option>').trigger('change.select2'); return; }
                $.ajax({
                    url: '/get-mouzas-by-thana/' + thanaId,
                    success: function (response) {
                        mouza.html(response);
                        if (selectedMouza) mouza.val(String(selectedMouza));
                        mouza.trigger('change.select2');
                    },
                    error: function () { mouza.html('<option value="">-- মৌজা --</option>').trigger('change.select2'); }
                });
            }

            function loadLocThanas(row, districtId, recordId, selectedThana, selectedMouza) {
                let thana = $('#loc_thana_' + row);
                thana.html('<option value="">লোড হচ্ছে...</option>').trigger('change.select2');
                let mouza = $('#loc_mouza_' + row);
                mouza.html('<option value="">-- মৌজা --</option>').trigger('change.select2');
                if (!districtId) { thana.html('<option value="">-- উপজেলা --</option>').trigger('change.select2'); return; }

                let url = '/get-upazilas-by-district/' + districtId;
                if (recordId) url += '?record=' + encodeURIComponent(recordId);

                $.ajax({
                    url: url,
                    success: function (response) {
                        thana.html(response);
                        if (selectedThana) {
                            thana.val(String(selectedThana));
                            loadLocMouzas(row, selectedThana, selectedMouza);
                        }
                        thana.trigger('change.select2');
                    },
                    error: function () { thana.html('<option value="">-- উপজেলা --</option>').trigger('change.select2'); }
                });
            }

            // Init on page load for each location row
            $('select.location-district').each(function () {
                let row = $(this).data('row');
                let districtId = $(this).val();
                let recordId = $(this).data('record');
                let selectedThana = $(this).data('selected-thana');
                let selectedMouza = $(this).data('selected-mouza');
                if (districtId) {
                    loadLocThanas(row, districtId, recordId, selectedThana, selectedMouza);
                }
            });

            // On district change in location table
            $(document).on('change', 'select.location-district', function () {
                let row = $(this).data('row');
                let recordId = $(this).data('record');
                loadLocThanas(row, $(this).val(), recordId, '', '');
            });

            // On thana change in location table
            $(document).on('change', 'select.location-thana', function () {
                let row = $(this).data('row');
                loadLocMouzas(row, $(this).val(), '');
            });

            // Dynamic Upazila loading for main form
            function loadMainUpazilas() {
                let districtId = $('#district_id').val();
                let record = $('#record_type').val() || '';
                let upazilaSelect = $('#upazila_id');
                let mouzaSelect = $('#mouza_id');

                upazilaSelect.html('<option value="">Select Upazila</option>').prop('disabled', true);
                mouzaSelect.html('<option value="">Select Mouza</option>').prop('disabled', true);

                if (districtId) {
                    let url = '/get-upazilas-by-district/' + districtId;
                    if (record) {
                        url += '?record=' + encodeURIComponent(record);
                    }
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            upazilaSelect.html(response).prop('disabled', false);
                            upazilaSelect.trigger('change.select2');
                        },
                        error: function () {
                            toastr.error('উপজেলা লোড করতে ব্যর্থ হয়েছে।');
                        }
                    });
                }
            }

            $('#district_id').on('change', function () {
                loadMainUpazilas();
            });

            function hideLocationRow(recordId) {
                // First show all and enable inputs
                $('.loc-row').show().find('input, select').prop('disabled', false);

                if (recordId) {
                    // Hide the selected row and disable its inputs so they aren't submitted
                    $('.loc-row[data-record-id="' + recordId + '"]')
                        .hide()
                        .find('input, select').prop('disabled', true);
                }
            }

            $('#record_type').on('change', function () {
                loadMainUpazilas();
                hideLocationRow($(this).val());
            });

            // Trigger on load
            if ($('#record_type').val()) {
                hideLocationRow($('#record_type').val());
            }

            // Dynamic Mouza loading
            $('#upazila_id').on('change', function () {
                let upazilaId = $(this).val();
                let mouzaSelect = $('#mouza_id');

                mouzaSelect.html('<option value="">Select Mouza</option>').prop('disabled', true);

                if (upazilaId) {
                    $.ajax({
                        url: '/get-mouzas-by-thana/' + upazilaId,
                        type: 'GET',
                        success: function (response) {
                            mouzaSelect.html(response).prop('disabled', false);
                            mouzaSelect.trigger('change.select2');
                        },
                        error: function () {
                            toastr.error('মৌজা লোড করতে ব্যর্থ হয়েছে।');
                        }
                    });
                }
            });

            // Detail JS Logic removed (single fixed row, no add/remove)

            // Location table toggle
            $('#locationToggleHeader, #locationToggleBtn').on('click', function (e) {
                e.stopPropagation();
                var wrapper = $('#locationTableWrapper');
                var btn = $('#locationToggleBtn');
                if (wrapper.is(':hidden')) {
                    wrapper.slideDown(200);
                    btn.html('<i class="fas fa-chevron-up"></i> লুকান');
                } else {
                    wrapper.slideUp(200);
                    btn.html('<i class="fas fa-chevron-down"></i> দেখুন');
                }
            });


            function fileTemplate(index) {
                return `
                                        <div class="party-item" data-file-item>
                                            <div class="party-item-top">
                                                <span class="party-item-title">Attachment</span>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-file">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="md-field">
                                                        <label>ফাইলের নাম / প্রমাণকের নাম</label>
                                                        <input type="text" name="attachments[${index}][name]" class="form-control md-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="md-field">
                                                        <label>ফাইল নির্বাচন করুন</label>
                                                        <input type="file" name="attachments[${index}][file]" class="form-control md-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
            }

            $(document).on('click', '.add-file', function () {
                $('#file_wrap').append(fileTemplate(fileIndex));
                fileIndex++;
            });

            $(document).on('click', '.remove-file', function () {
                let wrap = $(this).closest('.cioas-panel-body');
                if (wrap.find('[data-file-item]').length > 1) {
                    $(this).closest('[data-file-item]').remove();
                    return;
                }
                $(this).closest('[data-file-item]').find('input').val('');
            });





            $(document).on('click', '.remove-existing-file', function () {
                let docPath = $(this).data('path');
                // Append a hidden input to tell server to remove this doc
                $('#FormSubmit').append('<input type="hidden" name="remove_documents[]" value="' + docPath + '">');

                let wrap = $(this).closest('.cioas-panel-body');
                if (wrap.find('[data-file-item]').length > 1) {
                    $(this).closest('[data-file-item]').remove();
                } else {
                    $(this).closest('[data-file-item]').hide();
                }
            });


            $('#btnApprove').on('click', function () {
                $('#approve_input').val('1');
                $('#FormSubmit').submit();
            });
        });
    </script>
@endpush