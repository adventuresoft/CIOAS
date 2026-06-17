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
        $locationRows = [];

        foreach ($records as $index => $record) {
            $row = is_array($savedLocationRows) ? $savedLocationRows[$index] ?? [] : [];
            $locationRows[$index] = array_merge(
                [
                    'record' => $record,
                    'district_id' => '',
                    'thana_id' => '',
                    'mouza_id' => '',
                    'dag_no' => '',
                    'khatian' => '',
                    'record_group' => '',
                    'total_dag_no' => '',
                    'total_land' => '',
                    'record_owner_name' => '',
                ],
                is_array($row) ? $row : [],
            );

            $locationRows[$index]['record'] = $locationRows[$index]['record'] ?: $record;
        }

        $caseTypes = ['Civil', 'Criminal', 'Revenue', 'Other'];
        $statuses = ['draft' => 'Draft', 'running' => 'Running', 'closed' => 'Closed', 'rejected' => 'Rejected'];
        $recordGroups = ['NULL' => 'NULL', 'HOME' => 'HOME'];
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

            .miscase-page textarea.md-control {
                min-height: 96px;
                resize: vertical;
            }

            .section-chip {
                background: var(--mc-soft);
                border: 1px solid rgba(15, 118, 110, .16);
                border-radius: 999px;
                color: var(--mc-primary-dark);
                font-size: 12px;
                font-weight: 700;
                padding: 6px 11px;
            }

            .location-table {
                min-width: 1150px;
            }

            .location-table th {
                color: var(--mc-muted);
                font-size: 12px;
                text-transform: uppercase;
                vertical-align: middle;
                white-space: nowrap;
            }

            .location-table td {
                vertical-align: middle;
            }

            .record-pill {
                background: #fff7ed;
                border: 1px solid #fed7aa;
                border-radius: 999px;
                color: #9a3412;
                display: inline-block;
                font-weight: 700;
                min-width: 64px;
                padding: 6px 10px;
                text-align: center;
            }

            .party-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 18px;
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

            @media (max-width: 991px) {
                .party-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 767px) {
                .miscase-actions {
                    align-items: stretch;
                    flex-direction: column-reverse;
                    position: static;
                }

                .miscase-actions .btn {
                    width: 100%;
                }
            }
        </style>
    @endpush

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $pageTitle }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('miscase.index') }}">Missed Case</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content miscase-page pt-5">
        <div class="container-fluid">
            <div class="miscase-shell">

                <form id="FormSubmit" method="POST" enctype="multipart/form-data" action="{{ $formAction }}"
                    data-url="{{ $formAction }}" data-redirect-url="{{ route('miscase.index') }}">
                    @csrf

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-folder-open"></i> Case Information</h3>
                            <span class="section-chip">Required: Case Date</span>
                        </div>
                        <div class="miscase-panel-body">
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

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-map-marked-alt"></i> Location And Land Records
                            </h3>
                            <span class="section-chip">{{ count($records) }} records</span>
                        </div>
                        <div class="miscase-panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered location-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Record</th>
                                            <th>District</th>
                                            <th>Upazila</th>
                                            <th>Mouza</th>
                                            <th>Dag no</th>
                                            <th>Khatian</th>
                                            <th>Record Group</th>
                                            <th>Total Dag no</th>
                                            <th>Total Land</th>
                                            <th>Owner Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locationRows as $i => $row)
                                            <tr>
                                                <td>
                                                    <span class="record-pill">{{ $row['record'] }}</span>
                                                    <input type="hidden" name="location[{{ $i }}][record]"
                                                        value="{{ $row['record'] }}">
                                                </td>
                                                <td>
                                                    <select name="location[{{ $i }}][district_id]" data-row="{{ $i }}"
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
                                                </td>
                                                <td>
                                                    <select name="location[{{ $i }}][thana_id]" id="thana_{{ $i }}"
                                                        class="form-control location-thana ">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="location[{{ $i }}][mouza_id]" id="mouza_{{ $i }}"
                                                        class="form-control location-mouza ">
                                                        <option value="">Select</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="location[{{ $i }}][dag_no]"
                                                        class="form-control md-control" value="{{ $row['dag_no'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="location[{{ $i }}][khatian]"
                                                        class="form-control md-control" value="{{ $row['khatian'] }}">
                                                </td>
                                                <td>
                                                    <select name="location[{{ $i }}][record_group]" class="form-control ">
                                                        <option value="">Select</option>
                                                        @foreach ($recordGroups as $value => $label)
                                                            <option value="{{ $value }}" @selected($row['record_group'] == $value)>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="location[{{ $i }}][total_dag_no]"
                                                        class="form-control md-control" value="{{ $row['total_dag_no'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="location[{{ $i }}][total_land]"
                                                        class="form-control md-control" value="{{ $row['total_land'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="location[{{ $i }}][record_owner_name]"
                                                        class="form-control md-control" value="{{ $row['record_owner_name'] }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="party-grid">
                        <div class="miscase-panel">
                            <div class="miscase-panel-header">
                                <h3 class="miscase-panel-title"><i class="fas fa-user-check"></i> বাদীর তথ্য</h3>
                                <button class="btn btn-sm btn-outline-success add-party" data-party-type="plaintiffs"
                                    type="button"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="miscase-panel-body" id="plaintiffs_wrap">
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

                        <div class="miscase-panel">
                            <div class="miscase-panel-header">
                                <h3 class="miscase-panel-title"><i class="fas fa-user-shield"></i> বিবাদীর তথ্য</h3>
                                <button class="btn btn-sm btn-outline-success add-party" data-party-type="defendants"
                                    type="button"><i class="fas fa-plus"></i> Add</button>
                            </div>
                            <div class="miscase-panel-body" id="defendants_wrap">
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

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-paperclip"></i> Notes And Documents</h3>
                        </div>
                        <div class="miscase-panel-body">
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

                    <div class="miscase-actions">
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

                $('.miscase-page .select2').each(function () {
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
                    resetSelect(thana, 'Loading...');

                    if (!districtId) {
                        resetSelect(thana, 'Select');
                        resetSelect($('#mouza_' + row), 'Select');
                        return;
                    }

                    $.ajax({
                        url: '/get-thanas-by-district/' + districtId,
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
                    let wrap = $(this).closest('.miscase-panel-body');

                    if (wrap.find('[data-party-item]').length > 1) {
                        $(this).closest('[data-party-item]').remove();
                        return;
                    }

                    $(this).closest('[data-party-item]').find('input').val('');
                });
            });
        </script>
    @endpush
@endsection