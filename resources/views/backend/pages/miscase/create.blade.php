@extends('backend.master', ['mainMenu' => 'MisCase', 'subMenu' => 'MisCaseCreate'])

@section('title', 'Create Missed Case')

@section('content')
    @php
        $nextId = (\App\Models\MisCase::max('id') ?? 0) + 1;
        $caseNoValue = sprintf('%04d', $nextId) . '(XI)/' . date('Y');
        $formAction = route('miscase.store');
        $pageTitle = 'Create Missed Case';
        $submitText = 'Save Case';
        $notesValue = old('notes', '');
        $notesText = is_array($notesValue) ? $notesValue['notes'] ?? '' : $notesValue;
        $records = ['CS', 'SA', 'RS', 'City/BRS'];
        $blankParty = [
            'name' => '',
            'nid' => '',
            'father_name' => '',
            'mobile' => '',
            'address' => '',
        ];
        $plaintiffs = old('plaintiffs', []);
        $defendants = old('defendants', []);
        $plaintiffs = is_array($plaintiffs) && count($plaintiffs) ? $plaintiffs : [$blankParty];
        $defendants = is_array($defendants) && count($defendants) ? $defendants : [$blankParty];
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

        $caseTypes = ['Civil', 'Criminal', 'Revenue', 'Other'];
        $statuses = ['draft' => 'Draft', 'running' => 'Running', 'closed' => 'Closed', 'rejected' => 'Rejected'];
        $recordGroups = ['NULL' => 'NULL', 'HOME' => 'HOME'];
    @endphp

    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">

                <form id="FormSubmit" method="POST" enctype="multipart/form-data" action="{{ $formAction }}"
                    data-url="{{ $formAction }}" data-redirect-url="{{ route('miscase.index') }}">
                    @csrf

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-folder-open"></i> Case Information</h3>
                            <span class="section-chip">Required: Case Date</span>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="case_no">কেস নং</label>
                                        <input type="text" name="case_no" id="case_no" class="form-control md-control"
                                            value="{{ $caseNoValue }}" disabled>
                                        <small class="text-danger error case_no_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="case_date">মিসকেস রুজুর তারিখ <span class="text-danger">*</span></label>
                                        <input type="date" name="case_date" id="case_date" class="form-control md-control"
                                            value="{{ old('case_date', date('Y-m-d')) }}" required>
                                        <small class="text-danger error case_date_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="case_type">মিসকেস ধরণ</label>
                                        <select name="case_type" id="case_type" class="form-control ">
                                            <option value="">Select case type</option>
                                            <option value="X-1" @selected(old('case_type') == 'X-1')>মামলা ও আপিল</option>
                                            <option value="XI-1" @selected(old('case_type') == 'XI-1')> নামজারি সংক্রান্ত
                                            </option>
                                            <option value="III-1" @selected(old('case_type') == 'III-1')>মুদ্রণজনিত ত্রুটি
                                            </option>
                                            <option value="I-1" @selected(old('case_type') == 'I-1')>নিলাম বিজ্ঞপ্তি</option>
                                            <option value="XII-1" @selected(old('case_type') == 'XII-1')>অর্পিত থেকে খাস করা
                                            </option>
                                            <option value="XI-1" @selected(old('case_type') == 'XI-1')>বন্দোবস্ত মামলা
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="case_fee">মিসকেস ফিস</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    style="border: 1px solid var(--mc-line); border-radius: 8px 0 0 8px; background: #f8fafc; font-weight: bold; color: var(--mc-primary); display: flex; align-items: center; justify-content: center; min-width: 42px; min-height: 42px;">৳</span>
                                            </div>
                                            <input type="number" step="0.01" name="case_fee" id="case_fee"
                                                class="form-control md-control"
                                                style="border-radius: 0 8px 8px 0 !important; border-left: none !important;"
                                                value="{{ old('case_fee', '') }}" placeholder="0.00">
                                        </div>
                                        <small class="text-danger error case_fee_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="case_reason">মিসকেস কিসের জন্য ধার্য</label>
                                        <input type="text" name="case_reason" id="case_reason"
                                            class="form-control md-control" value="{{ old('case_reason', '') }}"
                                            placeholder="Case Reason">
                                        <small class="text-danger error case_reason_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="next_hearing_date">পরবর্তী শুনানির তারিখ</label>
                                        <input type="date" name="next_hearing_date" id="next_hearing_date"
                                            class="form-control md-control" value="{{ old('next_hearing_date') }}">
                                        <small class="text-danger error next_hearing_date_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="status">মিসকেস অবস্থা</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="draft" @selected(old('status', 'draft') == 'draft')>Draft</option>
                                            <option value="running" @selected(old('status') == 'running')>Running</option>
                                            <option value="closed" @selected(old('status') == 'closed')>Closed</option>
                                            <option value="rejected" @selected(old('status') == 'rejected')>Rejected</option>
                                        </select>
                                        <small class="text-danger error status_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="header_one">Header One</label>
                                        <input type="text" name="header_one" id="header_one" class="form-control md-control"
                                            value="{{ old('header_one') }}">
                                        <small class="text-danger error header_one_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="header_two">Header Two</label>
                                        <input type="text" name="header_two" id="header_two" class="form-control md-control"
                                            value="{{ old('header_two') }}">
                                        <small class="text-danger error header_two_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="md-field">
                                        <label for="case_details">মিসকেস বিস্তারিত</label>
                                        <textarea name="case_details" id="case_details" class="form-control md-control"
                                            rows="4"
                                            placeholder="Write case summary">{{ old('case_details', '') }}</textarea>
                                        <small class="text-danger error case_details_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="md-field mb-0">
                                        <label for="rejection_reason">নিস্পত্তি না হওয়ার কারণ</label>
                                        <textarea name="rejection_reason" id="rejection_reason"
                                            class="form-control md-control" rows="2"
                                            placeholder="Required only when case is rejected">{{ old('rejection_reason', '') }}</textarea>
                                        <small class="text-danger error rejection_reason_error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-map-marked-alt"></i> Location And Land Records
                            </h3>
                            <button class="btn btn-sm btn-outline-success add-location" type="button"><i
                                    class="fas fa-plus"></i> Add More</button>
                        </div>
                        <div class="cioas-panel-body" id="location_wrap">
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
                                                    class="form-control location-record">
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
                                                    class="form-control location-district">
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
                                                    class="form-control location-thana">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Mouza</label>
                                                <select name="location[{{ $index }}][mouza_id]" id="mouza_{{ $index }}"
                                                    class="form-control location-mouza">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-field">
                                                <label>Record Group</label>
                                                <select name="location[{{ $index }}][record_group]" class="form-control">
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

                    <div class="party-grid">
                        <div class="cioas-panel">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-user-check"></i> বাদীর তথ্য</h3>
                                <button class="btn btn-sm btn-outline-success add-party" data-party-type="plaintiffs"
                                    type="button"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="cioas-panel-body" id="plaintiffs_wrap">
                                @foreach ($plaintiffs as $index => $party)
                                    <div class="party-item" data-party-item>
                                        <div class="party-item-top">
                                            <span class="party-item-title">Plaintiff Information</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-party">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Name</label>
                                                    <input type="text" name="plaintiffs[{{ $index }}][name]"
                                                        class="form-control md-control" value="{{ $party['name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>NID</label>
                                                    <input type="text" name="plaintiffs[{{ $index }}][nid]"
                                                        class="form-control md-control" value="{{ $party['nid'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Father's Name</label>
                                                    <input type="text" name="plaintiffs[{{ $index }}][father_name]"
                                                        class="form-control md-control"
                                                        value="{{ $party['father_name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Mobile</label>
                                                    <input type="text" name="plaintiffs[{{ $index }}][mobile]"
                                                        class="form-control md-control" value="{{ $party['mobile'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="md-field mb-0">
                                                    <label>Address</label>
                                                    <input type="text" name="plaintiffs[{{ $index }}][address]"
                                                        class="form-control md-control" value="{{ $party['address'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="cioas-panel">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-user-shield"></i> বিবাদীর তথ্য</h3>
                                <button class="btn btn-sm btn-outline-success add-party" data-party-type="defendants"
                                    type="button"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="cioas-panel-body" id="defendants_wrap">
                                @foreach ($defendants as $index => $party)
                                    <div class="party-item" data-party-item>
                                        <div class="party-item-top">
                                            <span class="party-item-title">Defendant Information</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-party">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Name</label>
                                                    <input type="text" name="defendants[{{ $index }}][name]"
                                                        class="form-control md-control" value="{{ $party['name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>NID</label>
                                                    <input type="text" name="defendants[{{ $index }}][nid]"
                                                        class="form-control md-control" value="{{ $party['nid'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Father's Name</label>
                                                    <input type="text" name="defendants[{{ $index }}][father_name]"
                                                        class="form-control md-control"
                                                        value="{{ $party['father_name'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="md-field">
                                                    <label>Mobile</label>
                                                    <input type="text" name="defendants[{{ $index }}][mobile]"
                                                        class="form-control md-control" value="{{ $party['mobile'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="md-field mb-0">
                                                    <label>Address</label>
                                                    <input type="text" name="defendants[{{ $index }}][address]"
                                                        class="form-control md-control" value="{{ $party['address'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-paperclip"></i> Notes And Documents</h3>
                        </div>
                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="md-field mb-md-0">
                                        <label for="notes">Notes</label>
                                        <textarea name="notes" id="notes" class="form-control md-control" rows="3"
                                            placeholder="Internal notes">{{ $notesText }}</textarea>
                                        <small class="text-danger error notes_error"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-field mb-0">
                                        <label for="documents">Documents</label>
                                        <input type="file" name="documents[]" id="documents" class="form-control md-control"
                                            multiple>
                                        <small class="text-danger error documents_error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cioas-actions">
                        <a href="{{ route('miscase.index') }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-material btn-material-primary">
                            <i class="fas fa-save"></i> {{ $submitText }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready(function () {
                let partyIndexes = {
                    plaintiffs: {{ count($plaintiffs) }},
                    defendants: {{ count($defendants) }}
                        };
                let locationIndex = {{ count($locationRows) }};

                $('.cioas-page .select2').each(function () {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            theme: 'bootstrap4',
                            width: '100%'
                        });
                    }
                });

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

                function partyTemplate(type, index) {
                    let title = type === 'plaintiffs' ? 'Plaintiff Information' : 'Defendant Information';

                    return `
                                                                                    <div class="party-item" data-party-item>
                                                                                        <div class="party-item-top">
                                                                                            <span class="party-item-title">${title}</span>
                                                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-party">
                                                                                                <i class="fas fa-times"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="md-field">
                                                                                                    <label>Name</label>
                                                                                                    <input type="text" name="${type}[${index}][name]" class="form-control md-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="md-field">
                                                                                                    <label>NID</label>
                                                                                                    <input type="text" name="${type}[${index}][nid]" class="form-control md-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="md-field">
                                                                                                    <label>Father's Name</label>
                                                                                                    <input type="text" name="${type}[${index}][father_name]" class="form-control md-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="md-field">
                                                                                                    <label>Mobile</label>
                                                                                                    <input type="text" name="${type}[${index}][mobile]" class="form-control md-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="md-field mb-0">
                                                                                                    <label>Address</label>
                                                                                                    <input type="text" name="${type}[${index}][address]" class="form-control md-control">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>`;
                }

                $(document).on('click', '.add-party', function () {
                    let type = $(this).data('party-type');
                    $('#' + type + '_wrap').append(partyTemplate(type, partyIndexes[type]));
                    partyIndexes[type]++;
                });

                $(document).on('click', '.remove-party', function () {
                    let wrap = $(this).closest('.cioas-panel-body');

                    if (wrap.find('[data-party-item]').length > 1) {
                        $(this).closest('[data-party-item]').remove();
                        return;
                    }

                    $(this).closest('[data-party-item]').find('input').val('');
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
                                            <select name="location[${index}][record]" data-row="${index}" class="form-control location-record">
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
                                                class="form-control location-district">
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
                                                class="form-control location-thana">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-field">
                                            <label>Mouza</label>
                                            <select name="location[${index}][mouza_id]" id="mouza_${index}"
                                                class="form-control location-mouza">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-field">
                                            <label>Record Group</label>
                                            <select name="location[${index}][record_group]" class="form-control">
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
                    locationIndex++;
                });

                $(document).on('click', '.remove-location', function () {
                    let wrap = $(this).closest('.cioas-panel-body');

                    if (wrap.find('[data-location-item]').length > 1) {
                        $(this).closest('[data-location-item]').remove();
                        return;
                    }

                    $(this).closest('[data-location-item]').find('input').val('');
                    $(this).closest('[data-location-item]').find('select').val('');
                });
            });
        </script>
    @endpush
@endsection