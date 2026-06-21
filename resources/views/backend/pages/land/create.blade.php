@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCreate'])

@section('title', 'নতুন জমির এন্ট্রি')

@php
    $records = ['CS', 'SA', 'RS', 'City/BRS'];
    $recordGroups = ['NULL' => 'NULL', 'HOME' => 'HOME'];
    $savedLocationRows = old('location', []);
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
    $locationRows = is_array($savedLocationRows) && count($savedLocationRows) ? $savedLocationRows : [$blankLocation];
@endphp

@push('style')
    <style>
        .miscase-page {
            --mc-primary: #0f766e;
            --mc-primary-dark: #115e59;
            --mc-accent: #f59e0b;
            --mc-ink: #17202a;
            --mc-muted: #64748b;
            --mc-line: #dbe5ea;
            --mc-surface: #ffffff;
            --mc-soft: #eef7f5;
            background:
                linear-gradient(135deg, rgba(15, 118, 110, .12), rgba(245, 158, 11, .09)),
                #f5f7fa;
            min-height: calc(100vh - 120px);
            padding-bottom: 32px;
        }

        .miscase-shell {
            max-width: 1320px;
            margin: 0 auto;
        }

        .miscase-panel {
            background: var(--mc-surface);
            border: 1px solid rgba(219, 229, 234, .85);
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
            margin-bottom: 18px;
            overflow: hidden;
        }

        .miscase-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--mc-line);
            background: linear-gradient(180deg, #fff, #f8fbfb);
        }

        .miscase-panel-title {
            display: flex;
            gap: 10px;
            align-items: center;
            color: var(--mc-ink);
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .miscase-panel-title i {
            color: var(--mc-primary);
        }

        .miscase-panel-body {
            padding: 18px;
        }

        .md-field {
            margin-bottom: 16px;
        }

        .md-field label {
            color: var(--mc-muted);
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .md-control,
        .miscase-page .select2-container--bootstrap4 .select2-selection,
        .miscase-page .select2-container--default .select2-selection {
            border: 1px solid var(--mc-line) !important;
            border-radius: 8px !important;
            min-height: 42px;
            box-shadow: none !important;
        }

        .md-control:focus {
            border-color: var(--mc-primary) !important;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, .12) !important;
        }

        .party-item {
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 12px;
            background: #fbfdfd;
        }

        .party-item-top {
            align-items: center;
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .party-item-title {
            color: var(--mc-ink);
            font-weight: 700;
        }

        .miscase-actions {
            align-items: center;
            background: rgba(255, 255, 255, .9);
            border: 1px solid var(--mc-line);
            border-radius: 8px;
            bottom: 14px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, .1);
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            padding: 12px;
            position: sticky;
            z-index: 9;
        }

        .btn-material {
            border-radius: 8px;
            font-weight: 700;
            padding: 10px 18px;
        }

        .btn-material-primary {
            background: var(--mc-primary);
            border-color: var(--mc-primary);
            color: #fff;
        }

        .btn-material-primary:hover {
            background: var(--mc-primary-dark);
            border-color: var(--mc-primary-dark);
            color: #fff;
        }
    </style>
@endpush

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
                        <li class="breadcrumb-item active">নতুন এন্ট্রি</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content miscase-page pt-5">
        <div class="container-fluid">
            <div class="miscase-shell">

                <form id="FormSubmit" method="POST" enctype="multipart/form-data" action="{{ route('land.store') }}"
                    data-url="{{ route('land.store') }}" data-redirect-url="{{ route('land.index') }}">
                    @csrf
                    <input type="hidden" name="approve" id="approve_input" value="0">

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-map-marked-alt"></i> জমির এন্ট্রি ফরম</h3>
                        </div>
                        <div class="miscase-panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="land_type">জমির ধরণ <span class="text-danger">*</span></label>
                                        <select name="land_type" id="land_type" class="form-control select2" required>
                                            <option value="">Select Land Type</option>
                                            <option value="অকৃষি">অকৃষি</option>
                                            <option value="কৃষি">কৃষি</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="record_type">রেকর্ড <span class="text-danger">*</span></label>
                                        <select name="record_type" id="record_type" class="form-control select2" required>
                                            <option value="">Select Record</option>
                                            <option value="CS">CS</option>
                                            <option value="SA">SA</option>
                                            <option value="RS">RS</option>
                                            <option value="City/BRS">City/BRS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="district_id">জেলা <span class="text-danger">*</span></label>
                                        <select name="district_id" id="district_id" class="form-control select2" required>
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="upazila_id">উপজেলা <span class="text-danger">*</span></label>
                                        <select name="upazila_id" id="upazila_id" class="form-control select2" required
                                            disabled>
                                            <option value="">Select Upazila</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="mouza_id">মৌজা <span class="text-danger">*</span></label>
                                        <select name="mouza_id" id="mouza_id" class="form-control select2" required
                                            disabled>
                                            <option value="">Select Mouza</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-list-ol"></i> জমির বিবরণ</h3>
                        </div>
                        <div class="miscase-panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দাগ নং <span class="text-danger">*</span></label>
                                        <input type="text" name="details[0][dag_no]" class="form-control md-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>খতিয়ান নং <span class="text-danger">*</span></label>
                                        <input type="text" name="details[0][khatian_no]" class="form-control md-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>রেকর্ডীয় মালিকের নাম</label>
                                        <input type="text" name="details[0][recorded_owner_name]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>রেকর্ডীয় শ্রেণি <span class="text-danger">*</span></label>
                                        <select name="details[0][recorded_class]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="নাল">নাল</option>
                                            <option value="বাড়ী">বাড়ী</option>
                                            <option value="ভিটি">ভিটি</option>
                                            <option value="নালা">নালা</option>
                                            <option value="পুকুর">পুকুর</option>
                                            <option value="ডোবা">ডোবা</option>
                                            <option value="পতিত">পতিত</option>
                                            <option value="বাগান">বাগান</option>
                                            <option value="রাস্তা">রাস্তা</option>
                                            <option value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>বাস্তব শ্রেণি <span class="text-danger">*</span></label>
                                        <select name="details[0][actual_class]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="নাল">নাল</option>
                                            <option value="বাড়ী">বাড়ী</option>
                                            <option value="ভিটি">ভিটি</option>
                                            <option value="নালা">নালা</option>
                                            <option value="পুকুর">পুকুর</option>
                                            <option value="ডোবা">ডোবা</option>
                                            <option value="পতিত">পতিত</option>
                                            <option value="বাগান">বাগান</option>
                                            <option value="রাস্তা">রাস্তা</option>
                                            <option value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দাগে মোট জমি (একর) <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="details[0][total_land]" class="form-control md-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>জমির পরিমাণ (একর) <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="details[0][land_amount]" class="form-control md-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দখল সংক্রান্ত অবস্থা <span class="text-danger">*</span></label>
                                        <select name="details[0][possession_status]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="সরকার পক্ষে">সরকার পক্ষে</option>
                                            <option value="দখলে">দখলে</option>
                                            <option value="বেদখল">বেদখল</option>
                                            <option value="অন্যান্য">অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>মামলা নং</label>
                                        <input type="text" name="details[0][case_no]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>গেজেট/প্রমাণক নাম্বার</label>
                                        <input type="text" name="details[0][gazette_no]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label>মন্তব্য</label>
                                        <input type="text" name="details[0][remarks]" class="form-control md-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-map-marked-alt"></i> Location And Land Records
                            </h3>
                            <button class="btn btn-sm btn-outline-success add-location" type="button"><i
                                    class="fas fa-plus"></i> Add More</button>
                        </div>
                        <div class="miscase-panel-body" id="location_wrap">
                            @foreach ($locationRows as $index => $row)
                                <div class="party-item" data-location-item>
                                    <div class="party-item-top">
                                        <span class="party-item-title">Location Information</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-location">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Record</label>
                                                <select name="location[{{ $index }}][record]" data-row="{{ $index }}"
                                                    class="form-control select2 location-record">
                                                    <option value="">Select</option>
                                                    @foreach ($records as $rec)
                                                        <option value="{{ $rec }}" @selected($row['record'] == $rec)>{{ $rec }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>District</label>
                                                <select name="location[{{ $index }}][district_id]" data-row="{{ $index }}"
                                                    data-selected-thana="{{ $row['thana_id'] }}"
                                                    data-selected-mouza="{{ $row['mouza_id'] }}"
                                                    class="form-control select2 location-district">
                                                    <option value="">Select</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}" @selected((string) ($row['district_id'] ?? '') === (string) $district->id)>
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Upazila</label>
                                                <select name="location[{{ $index }}][thana_id]" id="thana_{{ $index }}"
                                                    class="form-control select2 location-thana">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Mouza</label>
                                                <select name="location[{{ $index }}][mouza_id]" id="mouza_{{ $index }}"
                                                    class="form-control select2 location-mouza">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Record Group</label>
                                                <select name="location[{{ $index }}][record_group]" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach ($recordGroups as $value => $label)
                                                        <option value="{{ $value }}" @selected($row['record_group'] == $value)>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Dag no</label>
                                                <input type="text" name="location[{{ $index }}][dag_no]"
                                                    class="form-control md-control" value="{{ $row['dag_no'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Khatian</label>
                                                <input type="text" name="location[{{ $index }}][khatian]"
                                                    class="form-control md-control" value="{{ $row['khatian'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Total Dag no</label>
                                                <input type="text" name="location[{{ $index }}][total_dag_no]"
                                                    class="form-control md-control" value="{{ $row['total_dag_no'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-field mb-0">
                                                <label>Total Land</label>
                                                <input type="text" name="location[{{ $index }}][total_land]"
                                                    class="form-control md-control" value="{{ $row['total_land'] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-field mb-0">
                                                <label>Owner Name</label>
                                                <input type="text" name="location[{{ $index }}][record_owner_name]"
                                                    class="form-control md-control" value="{{ $row['record_owner_name'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-paperclip"></i> গেজেট/প্রমাণক / ছবি সংযোজন</h3>
                            <button class="btn btn-sm btn-outline-success add-file" type="button"><i
                                    class="fas fa-plus"></i> Add More</button>
                        </div>
                        <div class="miscase-panel-body" id="file_wrap">
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
                                            <input type="text" name="attachments[0][name]" class="form-control md-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-field">
                                            <label>ফাইল নির্বাচন করুন</label>
                                            <input type="file" name="attachments[0][file]" class="form-control md-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="miscase-actions">
                        <a href="{{ route('land.index') }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-material btn-material-primary" id="btnSave">
                            <i class="fas fa-save"></i> সংরক্ষণ করুন
                        </button>
                        <button type="button" class="btn btn-material btn-info" id="btnApprove" style="color:white">
                            <i class="fas fa-check-double"></i> অনুমোদন করুন
                        </button>
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

            let detailIndex = 0;
            let fileIndex = 1;
            let locationIndex = {{ count($locationRows) }};

            function refreshSelect($select) {
                $select.trigger('change.select2');
            }

            function resetSelect($select, placeholder) {
                $select.html('<option value="">' + placeholder + '</option>');
                refreshSelect($select);
            }

            function loadMouzas(row, thanaId, selectedMouza = '') {
                let mouza = $('#mouza_' + row);
                resetSelect(mouza, 'Loading...');

                if (!thanaId) {
                    resetSelect(mouza, 'Select');
                    return;
                }

                $.ajax({
                    url: '/get-mouzas-by-thana/' + thanaId,
                    success: function (response) {
                        mouza.html(response);
                        if (selectedMouza) {
                            mouza.val(String(selectedMouza));
                        }
                        refreshSelect(mouza);
                    },
                    error: function () {
                        resetSelect(mouza, 'Select');
                    }
                });
            }

            function loadThanas(row, districtId, selectedThana = '', selectedMouza = '') {
                let thana = $('#thana_' + row);
                let record = $('select[name="location[' + row + '][record]"]').val() || '';
                resetSelect(thana, 'Loading...');

                if (!districtId) {
                    resetSelect(thana, 'Select');
                    resetSelect($('#mouza_' + row), 'Select');
                    return;
                }

                let url = '/get-upazilas-by-district/' + districtId;
                if (record) {
                    url += '?record=' + encodeURIComponent(record);
                }

                $.ajax({
                    url: url,
                    success: function (response) {
                        thana.html(response);
                        if (selectedThana) {
                            thana.val(String(selectedThana));
                            loadMouzas(row, selectedThana, selectedMouza);
                        } else {
                            resetSelect($('#mouza_' + row), 'Select');
                        }
                        refreshSelect(thana);
                    },
                    error: function () {
                        resetSelect(thana, 'Select');
                        resetSelect($('#mouza_' + row), 'Select');
                    }
                });
            }

            $('.location-district').each(function () {
                let districtId = $(this).val();
                if (districtId) {
                    loadThanas($(this).data('row'), districtId, $(this).data('selected-thana'), $(this)
                        .data('selected-mouza'));
                }
            });

            $(document).on('change', '.location-district', function () {
                loadThanas($(this).data('row'), $(this).val());
            });

            $(document).on('change', '.location-record', function () {
                let row = $(this).data('row');
                let districtId = $('select[name="location[' + row + '][district_id]"]').val();
                if (districtId) {
                    loadThanas(row, districtId);
                }
            });

            $(document).on('change', '.location-thana', function () {
                let row = $(this).attr('id').split('_')[1];
                loadMouzas(row, $(this).val());
            });

            function locationTemplate(index) {
                return `
                        <div class="party-item" data-location-item>
                            <div class="party-item-top">
                                <span class="party-item-title">Location Information</span>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-location">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Record</label>
                                        <select name="location[${index}][record]" data-row="${index}" class="form-control select2 location-record">
                                            <option value="">Select</option>
                                            @foreach ($records as $rec)
                                                <option value="{{ $rec }}">{{ $rec }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>District</label>
                                        <select name="location[${index}][district_id]" data-row="${index}"
                                            class="form-control select2 location-district">
                                            <option value="">Select</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Upazila</label>
                                        <select name="location[${index}][thana_id]" id="thana_${index}"
                                            class="form-control select2 location-thana">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Mouza</label>
                                        <select name="location[${index}][mouza_id]" id="mouza_${index}"
                                            class="form-control select2 location-mouza">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Record Group</label>
                                        <select name="location[${index}][record_group]" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach ($recordGroups as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Dag no</label>
                                        <input type="text" name="location[${index}][dag_no]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Khatian</label>
                                        <input type="text" name="location[${index}][khatian]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>Total Dag no</label>
                                        <input type="text" name="location[${index}][total_dag_no]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field mb-0">
                                        <label>Total Land</label>
                                        <input type="text" name="location[${index}][total_land]" class="form-control md-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field mb-0">
                                        <label>Owner Name</label>
                                        <input type="text" name="location[${index}][record_owner_name]" class="form-control md-control">
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }

            $(document).on('click', '.add-location', function () {
                $('#location_wrap').append(locationTemplate(locationIndex));
                $('#location_wrap').find('.select2').select2({
                    theme: 'bootstrap4',
                    width: '100%'
                });
                locationIndex++;
            });

            $(document).on('click', '.remove-location', function () {
                let wrap = $(this).closest('.miscase-panel-body');

                if (wrap.find('[data-location-item]').length > 1) {
                    $(this).closest('[data-location-item]').remove();
                    return;
                }

                $(this).closest('[data-location-item]').find('input').val('');
                $(this).closest('[data-location-item]').find('select').val('');
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

            $('#district_id, #record_type').on('change', function () {
                loadMainUpazilas();
            });

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

            // Remove Fixed Form JS Logic


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
                let wrap = $(this).closest('.miscase-panel-body');
                if (wrap.find('[data-file-item]').length > 1) {
                    $(this).closest('[data-file-item]').remove();
                    return;
                }
                $(this).closest('[data-file-item]').find('input').val('');
            });

            // Form Submit via AJAX (as before, but handle errors/success appropriately for this layout)
            $('#FormSubmit').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);
                let url = form.data('url');

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#btnSave, #btnApprove').prop('disabled', true);
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.href = form.data('redirect-url');
                        }, 1500);
                    },
                    error: function (xhr) {
                        $('#btnSave, #btnApprove').prop('disabled', false);
                        let err = xhr.responseJSON;
                        if (err && err.errors) {
                            $.each(err.errors, function (key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error(err.message || 'ডাটা সংরক্ষণ করতে ব্যর্থ হয়েছে।');
                        }
                    }
                });
            });

            $('#btnApprove').on('click', function () {
                $('#approve_input').val('1');
                $('#FormSubmit').submit();
            });
        });
    </script>
@endpush