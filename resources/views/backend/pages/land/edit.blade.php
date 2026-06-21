@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])

@section('title', 'জমির রেকর্ড সংশোধন')

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
                    <h1>জমির রেকর্ড সংশোধন</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('land.index') }}">জমির রেকর্ড</a></li>
                        <li class="breadcrumb-item active">সংশোধন</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content miscase-page pt-5">
        <div class="container-fluid">
            <div class="miscase-shell">

                <form id="landRecordForm" method="POST" enctype="multipart/form-data" action="{{ route('land.update', $land->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-map-marked-alt"></i> জমির রেকর্ড সংশোধন ফরম</h3>
                        </div>
                        <div class="miscase-panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="land_type">জমির ধরণ <span class="text-danger">*</span></label>
                                        <select name="land_type" id="land_type" class="form-control select2" required>
                                            <option value="">Select Land Type</option>
                                            <option value="অকৃষি" {{ $land->land_type == 'অকৃষি' ? 'selected' : '' }}>অকৃষি</option>
                                            <option value="কৃষি" {{ $land->land_type == 'কৃষি' ? 'selected' : '' }}>কৃষি</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label for="record_type">রেকর্ড <span class="text-danger">*</span></label>
                                        <select name="record_type" id="record_type" class="form-control select2" required>
                                            <option value="">Select Record</option>
                                            <option value="সি.এস" {{ $land->record_type == 'সি.এস' ? 'selected' : '' }}>সি.এস (CS)</option>
                                            <option value="এস.এ" {{ $land->record_type == 'এস.এ' ? 'selected' : '' }}>এস.এ (SA)</option>
                                            <option value="আর.এস" {{ $land->record_type == 'আর.এস' ? 'selected' : '' }}>আর.এস (RS)</option>
                                            <option value="বি.এস" {{ $land->record_type == 'বি.এস' ? 'selected' : '' }}>বি.এস (BS)</option>
                                            <option value="দিয়াড়া" {{ $land->record_type == 'দিয়াড়া' ? 'selected' : '' }}>দিয়াড়া (Diara)</option>
                                            <option value="পেটি" {{ $land->record_type == 'পেটি' ? 'selected' : '' }}>পেটি (Peti)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-field">
                                        <label for="district_id">জেলা <span class="text-danger">*</span></label>
                                        <select name="district_id" id="district_id" class="form-control select2" required>
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ $land->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
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
                                                <option value="{{ $upazila->id }}" {{ $land->upazila_id == $upazila->id ? 'selected' : '' }}>{{ $upazila->name }}</option>
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
                                                <option value="{{ $mouza->id }}" {{ $land->mouza_id == $mouza->id ? 'selected' : '' }}>{{ $mouza->name }}</option>
                                            @endforeach
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
                                @php
                                    $detail = $land->details->first();
                                @endphp
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দাগ নং <span class="text-danger">*</span></label>
                                        <input type="text" name="details[0][dag_no]" class="form-control md-control" value="{{ $detail ? $detail->dag_no : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>খতিয়ান নং <span class="text-danger">*</span></label>
                                        <input type="text" name="details[0][khatian_no]" class="form-control md-control" value="{{ $detail ? $detail->khatian_no : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>রেকর্ডীয় মালিকের নাম</label>
                                        <input type="text" name="details[0][recorded_owner_name]" class="form-control md-control" value="{{ $detail ? $detail->recorded_owner_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>রেকর্ডীয় শ্রেণি <span class="text-danger">*</span></label>
                                        <select name="details[0][recorded_class]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="নাল" {{ ($detail && $detail->recorded_class == 'নাল') ? 'selected' : '' }}>নাল</option>
                                            <option value="বাড়ী" {{ ($detail && $detail->recorded_class == 'বাড়ী') ? 'selected' : '' }}>বাড়ী</option>
                                            <option value="ভিটি" {{ ($detail && $detail->recorded_class == 'ভিটি') ? 'selected' : '' }}>ভিটি</option>
                                            <option value="নালা" {{ ($detail && $detail->recorded_class == 'নালা') ? 'selected' : '' }}>নালা</option>
                                            <option value="পুকুর" {{ ($detail && $detail->recorded_class == 'পুকুর') ? 'selected' : '' }}>পুকুর</option>
                                            <option value="ডোবা" {{ ($detail && $detail->recorded_class == 'ডোবা') ? 'selected' : '' }}>ডোবা</option>
                                            <option value="পতিত" {{ ($detail && $detail->recorded_class == 'পতিত') ? 'selected' : '' }}>পতিত</option>
                                            <option value="বাগান" {{ ($detail && $detail->recorded_class == 'বাগান') ? 'selected' : '' }}>বাগান</option>
                                            <option value="রাস্তা" {{ ($detail && $detail->recorded_class == 'রাস্তা') ? 'selected' : '' }}>রাস্তা</option>
                                            <option value="অন্যান্য" {{ ($detail && $detail->recorded_class == 'অন্যান্য') ? 'selected' : '' }}>অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>বাস্তব শ্রেণি <span class="text-danger">*</span></label>
                                        <select name="details[0][actual_class]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="নাল" {{ ($detail && $detail->actual_class == 'নাল') ? 'selected' : '' }}>নাল</option>
                                            <option value="বাড়ী" {{ ($detail && $detail->actual_class == 'বাড়ী') ? 'selected' : '' }}>বাড়ী</option>
                                            <option value="ভিটি" {{ ($detail && $detail->actual_class == 'ভিটি') ? 'selected' : '' }}>ভিটি</option>
                                            <option value="নালা" {{ ($detail && $detail->actual_class == 'নালা') ? 'selected' : '' }}>নালা</option>
                                            <option value="পুকুর" {{ ($detail && $detail->actual_class == 'পুকুর') ? 'selected' : '' }}>পুকুর</option>
                                            <option value="ডোবা" {{ ($detail && $detail->actual_class == 'ডোবা') ? 'selected' : '' }}>ডোবা</option>
                                            <option value="পতিত" {{ ($detail && $detail->actual_class == 'পতিত') ? 'selected' : '' }}>পতিত</option>
                                            <option value="বাগান" {{ ($detail && $detail->actual_class == 'বাগান') ? 'selected' : '' }}>বাগান</option>
                                            <option value="রাস্তা" {{ ($detail && $detail->actual_class == 'রাস্তা') ? 'selected' : '' }}>রাস্তা</option>
                                            <option value="অন্যান্য" {{ ($detail && $detail->actual_class == 'অন্যান্য') ? 'selected' : '' }}>অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দাগে মোট জমি (একর) <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="details[0][total_land]" class="form-control md-control" value="{{ $detail ? $detail->total_land : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>জমির পরিমাণ (একর) <span class="text-danger">*</span></label>
                                        <input type="number" step="any" name="details[0][land_amount]" class="form-control md-control" value="{{ $detail ? $detail->land_amount : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>দখল সংক্রান্ত অবস্থা <span class="text-danger">*</span></label>
                                        <select name="details[0][possession_status]" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন</option>
                                            <option value="সরকার পক্ষে" {{ ($detail && $detail->possession_status == 'সরকার পক্ষে') ? 'selected' : '' }}>সরকার পক্ষে</option>
                                            <option value="দখলে" {{ ($detail && $detail->possession_status == 'দখলে') ? 'selected' : '' }}>দখলে</option>
                                            <option value="বেদখল" {{ ($detail && $detail->possession_status == 'বেদখল') ? 'selected' : '' }}>বেদখল</option>
                                            <option value="অন্যান্য" {{ ($detail && $detail->possession_status == 'অন্যান্য') ? 'selected' : '' }}>অন্যান্য</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>মামলা নং</label>
                                        <input type="text" name="details[0][case_no]" class="form-control md-control" value="{{ $detail ? $detail->case_no : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-field">
                                        <label>গেজেট/প্রমাণক নাম্বার</label>
                                        <input type="text" name="details[0][gazette_no]" class="form-control md-control" value="{{ $detail ? $detail->gazette_no : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-field">
                                        <label>মন্তব্য</label>
                                        <input type="text" name="details[0][remarks]" class="form-control md-control" value="{{ $detail ? $detail->remarks : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-paperclip"></i> বিদ্যমান ফাইলসমূহ</h3>
                        </div>
                        <div class="miscase-panel-body">
                            @if(count($land->documents))
                                <div class="row">
                                    @foreach($land->documents as $doc)
                                        <div class="col-md-4 mb-3 existing-doc-row" data-id="{{ $doc->id }}">
                                            <div class="party-item mb-0" style="padding: 10px;">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-truncate mr-2">
                                                        <i class="far fa-file-alt text-primary mr-1"></i>
                                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" title="{{ $doc->document_name }}">
                                                            {{ \Illuminate\Support\Str::limit($doc->document_name, 25) }}
                                                        </a>
                                                    </span>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-existing-doc" data-id="{{ $doc->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">কোনো ফাইল যুক্ত করা হয়নি।</p>
                            @endif
                        </div>
                    </div>

                    <div class="miscase-panel">
                        <div class="miscase-panel-header">
                            <h3 class="miscase-panel-title"><i class="fas fa-paperclip"></i> নতুন গেজেট/প্রমাণক / ছবি সংযোজন</h3>
                            <button class="btn btn-sm btn-outline-success add-file" type="button"><i class="fas fa-plus"></i> Add More</button>
                        </div>
                        <div class="miscase-panel-body" id="file_wrap">
                            <!-- New attachments will be added here -->
                        </div>
                    </div>

                    <div id="removedDocumentsContainer"></div>

                    <div class="miscase-actions">
                        <a href="{{ route('land.index') }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-material btn-material-primary" id="btnSave">
                            <i class="fas fa-save"></i> সংশোধন করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });

            // Initialize counters based on existing count
            let detailIndex = {{ count($land->details) }};
            let fileIndex = 1;

            // Dynamic Upazila loading
            $('#district_id').on('change', function() {
                let districtId = $(this).val();
                let upazilaSelect = $('#upazila_id');
                let mouzaSelect = $('#mouza_id');

                upazilaSelect.html('<option value="">Select Upazila</option>').prop('disabled', true);
                mouzaSelect.html('<option value="">Select Mouza</option>').prop('disabled', true);

                if (districtId) {
                    $.ajax({
                        url: '/get-upazilas-by-district/' + districtId,
                        type: 'GET',
                        success: function(response) {
                            upazilaSelect.html(response).prop('disabled', false);
                            upazilaSelect.trigger('change.select2');
                        },
                        error: function() {
                            toastr.error('উপজেলা লোড করতে ব্যর্থ হয়েছে।');
                        }
                    });
                }
            });

            // Dynamic Mouza loading
            $('#upazila_id').on('change', function() {
                let upazilaId = $(this).val();
                let mouzaSelect = $('#mouza_id');

                mouzaSelect.html('<option value="">Select Mouza</option>').prop('disabled', true);

                if (upazilaId) {
                    $.ajax({
                        url: '/get-mouzas-by-thana/' + upazilaId,
                        type: 'GET',
                        success: function(response) {
                            mouzaSelect.html(response).prop('disabled', false);
                            mouzaSelect.trigger('change.select2');
                        },
                        error: function() {
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
                                    <label>ফাইলের নাম / প্রমাণকের নাম <span class="text-danger">*</span></label>
                                    <input type="text" name="attachments[${index}][name]" class="form-control md-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-field">
                                    <label>ফাইল নির্বাচন করুন <span class="text-danger">*</span></label>
                                    <input type="file" name="attachments[${index}][file]" class="form-control md-control" required>
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
                $(this).closest('[data-file-item]').remove();
            });

            // Remove existing document
            $('.btn-remove-existing-doc').on('click', function() {
                let id = $(this).data('id');
                $(this).closest('.existing-doc-row').remove();
                $('#removedDocumentsContainer').append(`<input type="hidden" name="remove_documents[]" value="${id}">`);
            });

            // Submit form handler
            $('#landRecordForm').on('submit', function(e) {
                e.preventDefault();
                
                let form = $(this);
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: "POST", // Standard Laravel RESTful API files upload works with POST + _method override
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnSave').prop('disabled', true);
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = response.redirect_url;
                        }, 1500);
                    },
                    error: function(xhr) {
                        $('#btnSave').prop('disabled', false);
                        let err = xhr.responseJSON;
                        if (err && err.errors) {
                            $.each(err.errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            toastr.error(err.message || 'ডাটা সংশোধন করতে ব্যর্থ হয়েছে।');
                        }
                    }
                });
            });
        });
    </script>
@endpush
