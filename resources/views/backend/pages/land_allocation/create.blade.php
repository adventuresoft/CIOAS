@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandAllocationList'])

@section('title', 'নতুন বরাদ্দ / লীজ / বন্দোবস্ত')

@push('style')
<style>
    .alloc-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 24px;
    }
    .alloc-panel-header {
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #fff;
        padding: 14px 22px;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .alloc-panel-header h4 { margin:0; font-size:16px; font-weight:700; }
    .alloc-panel-body { padding: 22px; }

    .custom-table td {
        padding: 11px 16px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .custom-table td.label-cell {
        width: 28%;
        font-weight: 600;
        color: #374151;
        background: #f8fafc;
        font-size: 14px;
    }
    .custom-table td.colon-cell {
        width: 20px;
        text-align: center;
        color: #94a3b8;
    }
    .form-control {
        border: 1.5px solid #d1d5db;
        border-radius: 6px;
        padding: 9px 13px;
        width: 100%;
        color: #1e293b;
        background-color: #fff;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15,118,110,0.12);
        outline: none;
    }

    /* Person rows table */
    .persons-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .persons-table thead tr {
        background: linear-gradient(135deg, #0f766e, #115e59);
        color: #fff;
        text-align: center;
    }
    .persons-table thead th {
        padding: 10px 8px;
        white-space: nowrap;
        border: 1px solid #0d6460;
    }
    .persons-table tbody td {
        padding: 6px 6px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .persons-table tbody tr:hover { background: #f0fdfa; }
    .total-price-cell { font-weight: 700; color: #0f766e; }
    .form-footer {
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-radius: 0 0 8px 8px;
    }

    /* ── Custom Autocomplete ── */
    .land-search-wrap { position: relative; }
    .land-search-wrap .search-icon {
        position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
        color: #94a3b8; font-size: 14px; pointer-events: none; transition: color .2s;
    }
    .land-search-wrap:focus-within .search-icon { color: #0f766e; }
    .land-search-wrap input.land-search-input {
        padding-left: 34px;
        padding-right: 36px;
    }
    .land-search-wrap .clear-btn {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #94a3b8; font-size: 18px;
        cursor: pointer; padding: 0 4px; line-height: 1;
        display: none; transition: color .2s;
    }
    .land-search-wrap .clear-btn:hover { color: #ef4444; }
    .land-dropdown {
        position: absolute; z-index: 9999;
        top: calc(100% + 4px); left: 0; right: 0;
        background: #fff;
        border: 1.5px solid #d1d5db;
        border-radius: 8px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.12);
        max-height: 220px; overflow-y: auto;
        display: none;
        animation: dropIn .15s ease;
    }
    @keyframes dropIn {
        from { opacity:0; transform: translateY(-6px); }
        to   { opacity:1; transform: translateY(0); }
    }
    .land-dropdown .dd-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; cursor: pointer;
        font-size: 13.5px; color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        transition: background .12s;
    }
    .land-dropdown .dd-item:last-child { border-bottom: none; }
    .land-dropdown .dd-item:hover,
    .land-dropdown .dd-item.active { background: #f0fdfa; color: #0f766e; }
    .land-dropdown .dd-item .dd-icon {
        width: 28px; height: 28px; border-radius: 6px;
        background: #ccfbf1; display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
        font-size: 12px; color: #0f766e;
    }
    .land-dropdown .dd-loading,
    .land-dropdown .dd-empty {
        padding: 14px; text-align: center;
        color: #64748b; font-size: 13px;
    }
    .land-dropdown .dd-loading i { animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')
<section class="content-header pt-4 pb-0">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-gray-800" style="font-weight: 700; font-size: 24px;">নতুন বরাদ্দ / লীজ / বন্দোবস্ত</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background: transparent; padding: 0; margin-bottom: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #3b82f6;">হোম</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('land-allocations.index') }}" style="color: #3b82f6;">বরাদ্দ তালিকা</a></li>
                    <li class="breadcrumb-item active" style="color: #64748b;">নতুন বরাদ্দ</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content pt-3 pb-5">
    <div class="container-fluid">

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius:6px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('land-allocations.store') }}" method="POST" id="allocationForm">
            @csrf

            {{-- ───── Basic Info ───── --}}
            <div class="alloc-panel">
                <div class="alloc-panel-header">
                    <h4><i class="fas fa-map-pin"></i> মৌলিক তথ্য</h4>
                </div>
                <div class="alloc-panel-body">
                    <table class="custom-table" style="width:100%; border-collapse:collapse;">
                        <tbody>
                            <tr>
                                <td class="label-cell">
                                    <i class="fas fa-map-pin" style="color:#0f766e; margin-right:6px;"></i>
                                    জমির নাম্বার <span class="text-danger" style="display:inline;">*</span>
                                </td>
                                <td class="colon-cell">:</td>
                                <td>
                                    <input type="hidden" name="land_no" id="land_no_hidden" value="{{ old('land_no') }}">
                                    <div class="land-search-wrap">
                                        <i class="fas fa-search search-icon"></i>
                                        <input type="text"
                                               id="land_no_search"
                                               class="form-control land-search-input"
                                               placeholder="জমির নাম্বার টাইপ করুন..."
                                               value="{{ old('land_no') }}"
                                               autocomplete="off">
                                        <button type="button" class="clear-btn" id="land_clear_btn" title="পরিষ্কার করুন">&times;</button>
                                        <div class="land-dropdown" id="land_dropdown"></div>
                                    </div>
                                    @error('land_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="label-cell">বরাদ্দ / লীজ / বন্দোবস্ত কয়জনকে দেওয়া হয়েছে <span class="text-danger">*</span></td>
                                <td class="colon-cell">:</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2" style="gap:10px;">
                                        <input type="number" id="total_persons_input" name="total_persons"
                                               class="form-control" style="max-width:150px;" min="1"
                                               value="{{ old('total_persons', 1) }}" required
                                               placeholder="সংখ্যা লিখুন">
                                        <button type="button" id="btnGenerateRows" class="btn btn-success" style="white-space:nowrap;">
                                            <i class="fas fa-plus"></i> সারি তৈরি করুন
                                        </button>
                                    </div>
                                    @error('total_persons') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ───── Land Details Info Panel ───── --}}
            <div class="alloc-panel" id="landDetailsPanel" style="display:none; border-top: 4px solid #0f766e;">
                <div class="alloc-panel-header" style="background: linear-gradient(135deg, #115e59, #0d9488);">
                    <h4><i class="fas fa-info-circle"></i> জমির বিস্তারিত তথ্য (সংক্ষিপ্ত বিবরণী)</h4>
                </div>
                <div class="alloc-panel-body" style="background-color: #fafbfc; padding: 24px;">
                    <div class="row">
                        <!-- Column 1: location info -->
                        <div class="col-md-6 mb-3">
                            <h5 style="color: #0f766e; font-size: 15px; font-weight: 700; margin-bottom: 12px; border-bottom: 1.5px solid #e2e8f0; padding-bottom: 6px;">
                                <i class="fas fa-map-marker-alt"></i> অবস্থান ও ধরন
                            </h5>
                            <table class="table table-sm table-borderless" style="font-size: 13.5px; line-height: 2;">
                                <tbody>
                                    <tr>
                                        <td style="width: 35%; font-weight: 600; color: #475569;">জমির নাম্বার:</td>
                                        <td id="details_land_no" style="font-weight: 700; color: #1e293b;">—</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #475569;">জমির ধরণ:</td>
                                        <td id="details_land_type" style="color: #1e293b;">—</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #475569;">রেকর্ড টাইপ:</td>
                                        <td id="details_record_type" style="color: #1e293b;">—</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 600; color: #475569;">জেলা/উপজেলা/মৌজা:</td>
                                        <td>
                                            <span id="details_district">—</span> / 
                                            <span id="details_upazila">—</span> / 
                                            <span id="details_mouza">—</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Column 2: Land size & Allocations summary -->
                        <div class="col-md-6 mb-3">
                            <h5 style="color: #0f766e; font-size: 15px; font-weight: 700; margin-bottom: 12px; border-bottom: 1.5px solid #e2e8f0; padding-bottom: 6px;">
                                <i class="fas fa-chart-pie"></i> জমির পরিমাণ ও বরাদ্দ পরিসংখ্যান
                            </h5>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div style="background: #f1f5f9; padding: 10px; border-radius: 8px; border: 1.5px solid #e2e8f0;">
                                        <div style="font-size: 11px; color: #64748b; font-weight: 600;">মোট জমির পরিমাণ</div>
                                        <div id="details_total_acres" style="font-size: 15px; font-weight: 700; color: #334155; margin-top: 4px;">0.0000 একর</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div style="background: #fff1f2; padding: 10px; border-radius: 8px; border: 1.5px solid #fecdd3;">
                                        <div style="font-size: 11px; color: #be123c; font-weight: 600;">ইতিমধ্যে বরাদ্দকৃত</div>
                                        <div id="details_allocated_acres" style="font-size: 15px; font-weight: 700; color: #9f1239; margin-top: 4px;">0.0000 একর</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div style="background: #ecfdf5; padding: 10px; border-radius: 8px; border: 1.5px solid #a7f3d0;">
                                        <div style="font-size: 11px; color: #047857; font-weight: 600;">অবশিষ্ট জমির পরিমাণ</div>
                                        <div id="details_remaining_acres" style="font-size: 15px; font-weight: 700; color: #065f46; margin-top: 4px;">0.0000 একর</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 p-3" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-radius: 8px; border: 1px solid #bbf7d0;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 13px; font-weight: 600; color: #166534;">
                                            <i class="fas fa-calculator"></i> বর্তমান বরাদ্দের পর অবশিষ্ট জমি:
                                        </span>
                                    </div>
                                    <div>
                                        <span id="display_remaining_live" style="font-size: 18px; font-weight: 800; color: #15803d;">0.0000 একর</span>
                                    </div>
                                </div>
                                <div id="warning_excess_allocated" class="text-danger mt-2" style="display:none; font-size: 12px; font-weight: 700;">
                                    <i class="fas fa-exclamation-triangle"></i> সতর্কীকরণ: বরাদ্দকৃত জমি অবশিষ্ট জমির চেয়ে বেশি হচ্ছে!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ───── Persons Table ───── --}}
            <div class="alloc-panel" id="personsPanel" style="{{ old('persons') ? '' : 'display:none;' }}">
                <div class="alloc-panel-header">
                    <h4><i class="fas fa-users"></i> ব্যক্তির তথ্য</h4>
                </div>
                <div class="alloc-panel-body" style="overflow-x:auto; padding:0;">
                    <table class="persons-table" id="personsTable">
                        <thead>
                            <tr>
                                <th style="min-width:35px;">#</th>
                                <th style="min-width:160px;">নাম <span style="color:#fca5a5;">*</span></th>
                                <th style="min-width:130px;">NID নম্বর</th>
                                <th style="min-width:120px;">ফোন</th>
                                <th style="min-width:160px;">পিতার নাম</th>
                                <th style="min-width:200px;">বর্তমান ঠিকানা</th>
                                <th style="min-width:200px;">স্থায়ী ঠিকানা</th>
                                <th style="min-width:110px;">একর (পরিমাণ) <span style="color:#fca5a5;">*</span></th>
                                <th style="min-width:120px;">প্রতি একর মূল্য <span style="color:#fca5a5;">*</span></th>
                                <th style="min-width:130px;">মোট মূল্য</th>
                            </tr>
                        </thead>
                        <tbody id="personsBody">
                            @if(old('persons'))
                                @foreach(old('persons') as $i => $p)
                                <tr>
                                    <td style="text-align:center; font-weight:700;">{{ $i+1 }}</td>
                                    <td><input type="text" name="persons[{{ $i }}][name]" class="form-control form-control-sm" value="{{ $p['name'] ?? '' }}" required></td>
                                    <td><input type="text" name="persons[{{ $i }}][nid]" class="form-control form-control-sm" value="{{ $p['nid'] ?? '' }}"></td>
                                    <td><input type="text" name="persons[{{ $i }}][phone]" class="form-control form-control-sm" value="{{ $p['phone'] ?? '' }}"></td>
                                    <td><input type="text" name="persons[{{ $i }}][father_name]" class="form-control form-control-sm" value="{{ $p['father_name'] ?? '' }}"></td>
                                    <td><input type="text" name="persons[{{ $i }}][present_address]" class="form-control form-control-sm" value="{{ $p['present_address'] ?? '' }}"></td>
                                    <td><input type="text" name="persons[{{ $i }}][permanent_address]" class="form-control form-control-sm" value="{{ $p['permanent_address'] ?? '' }}"></td>
                                    <td><input type="number" step="any" name="persons[{{ $i }}][acres]" class="form-control form-control-sm acres-input" value="{{ $p['acres'] ?? '' }}" required></td>
                                    <td><input type="number" step="any" name="persons[{{ $i }}][price_per_acre]" class="form-control form-control-sm price-input" value="{{ $p['price_per_acre'] ?? '' }}" required></td>
                                    <td class="total-price-cell"><span class="total-display">৳ 0.00</span></td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer --}}
            <div class="form-footer alloc-panel" style="text-align:center;">
                <button type="submit" class="btn btn-success" style="font-weight:600; padding:9px 28px;">
                    <i class="fas fa-save"></i> সংরক্ষণ করুন
                </button>
                <a href="{{ route('land-allocations.index') }}" class="btn btn-secondary ml-2" style="font-weight:600; padding:9px 28px;">
                    <i class="fas fa-arrow-left"></i> ফিরে যান
                </a>
            </div>

        </form>
    </div>
</section>
@endsection

@push('script')
<script>
$(document).ready(function () {

    /* ════════════════════════════════
       Custom Land Autocomplete
       ════════════════════════════════ */
    var searchTimer = null;
    var activeIndex = -1;
    var $input    = $('#land_no_search');
    var $hidden   = $('#land_no_hidden');
    var $dd       = $('#land_dropdown');
    var $clearBtn = $('#land_clear_btn');

    var currentLandRemainingAcres = 0;
    var currentLandTotalAcres = 0;
    var currentLandAlreadyAllocated = 0;

    function showDropdown(html) { $dd.html(html).show(); activeIndex = -1; }
    function hideDropdown() { $dd.hide(); activeIndex = -1; }

    function selectLand(val) {
        $input.val(val);
        $hidden.val(val);
        $clearBtn.show();
        hideDropdown();
        fetchLandDetails(val);
    }

    function fetchLandDetails(landNo) {
        if (!landNo) return;
        $.get("{{ route('ajax.getLandAllocationDetails') }}", { land_no: landNo }, function (res) {
            if (res.success) {
                currentLandTotalAcres = parseFloat(res.total_land_acres) || 0;
                currentLandAlreadyAllocated = parseFloat(res.already_allocated_acres) || 0;
                currentLandRemainingAcres = parseFloat(res.remaining_land_acres) || 0;

                $('#details_land_no').text(res.land_no);
                $('#details_land_type').text(res.land_type);
                $('#details_record_type').text(res.record_type);
                $('#details_district').text(res.district_name);
                $('#details_upazila').text(res.upazila_name);
                $('#details_mouza').text(res.mouza_name);

                $('#details_total_acres').text(currentLandTotalAcres.toFixed(4) + ' একর');
                $('#details_allocated_acres').text(currentLandAlreadyAllocated.toFixed(4) + ' একর');
                $('#details_remaining_acres').text(currentLandRemainingAcres.toFixed(4) + ' একর');

                $('#landDetailsPanel').slideDown();
                updateLiveCalculations();
            } else {
                alert(res.message || 'জমির বিস্তারিত তথ্য পাওয়া যায়নি।');
            }
        }).fail(function () {
            alert('সার্ভার থেকে তথ্য আনতে ব্যর্থ হয়েছে।');
        });
    }

    function updateLiveCalculations() {
        var totalAcresInput = 0;
        $('.acres-input').each(function () {
            var val = parseFloat($(this).val()) || 0;
            totalAcresInput += val;
        });

        var liveRemaining = currentLandRemainingAcres - totalAcresInput;
        $('#display_remaining_live').text(liveRemaining.toFixed(4) + ' একর');

        if (liveRemaining < 0) {
            $('#display_remaining_live').css('color', '#ef4444');
            $('#warning_excess_allocated').slideDown();
        } else {
            $('#display_remaining_live').css('color', '#15803d');
            $('#warning_excess_allocated').slideUp();
        }
    }

    function renderItems(items) {
        if (!items.length) {
            showDropdown('<div class="dd-empty"><i class="fas fa-search" style="margin-right:6px;"></i>কোনো জমি পাওয়া যায়নি</div>');
            return;
        }
        var html = items.map(function(item) {
            return '<div class="dd-item" data-val="' + item.text + '">' +
                   '<span class="dd-icon"><i class="fas fa-map-marked-alt"></i></span>' +
                   '<span>' + item.text + '</span></div>';
        }).join('');
        showDropdown(html);
    }

    $input.on('input', function () {
        var q = $(this).val().trim();
        $hidden.val('');
        $clearBtn.toggle(q.length > 0);
        clearTimeout(searchTimer);
        if (q.length < 1) { hideDropdown(); return; }
        showDropdown('<div class="dd-loading"><i class="fas fa-circle-notch"></i> খোঁজা হচ্ছে...</div>');
        searchTimer = setTimeout(function () {
            $.get("{{ route('ajax.searchLandNo') }}", { q: q }, function (data) {
                renderItems(data);
            }).fail(function () {
                showDropdown('<div class="dd-empty">সার্ভার ত্রুটি</div>');
            });
        }, 280);
    });

    /* keyboard navigation */
    $input.on('keydown', function (e) {
        var $items = $dd.find('.dd-item');
        if (!$items.length) return;
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            activeIndex = Math.min(activeIndex + 1, $items.length - 1);
            $items.removeClass('active').eq(activeIndex).addClass('active');
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            activeIndex = Math.max(activeIndex - 1, 0);
            $items.removeClass('active').eq(activeIndex).addClass('active');
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (activeIndex >= 0) $items.eq(activeIndex).trigger('click');
        } else if (e.key === 'Escape') {
            hideDropdown();
        }
    });

    $(document).on('click', '.dd-item', function () { selectLand($(this).data('val')); });

    $clearBtn.on('click', function () {
        $input.val(''); $hidden.val('');
        $clearBtn.hide(); hideDropdown(); $input.focus();
        $('#landDetailsPanel').slideUp();
        currentLandTotalAcres = 0;
        currentLandAlreadyAllocated = 0;
        currentLandRemainingAcres = 0;
        updateLiveCalculations();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.land-search-wrap').length) hideDropdown();
    });

    if ($input.val()) {
        $clearBtn.show();
        fetchLandDetails($input.val());
    }

    /* ════════════════════════════════
       Generate person rows
       ════════════════════════════════ */
    $('#btnGenerateRows').on('click', function () {
        var count = parseInt($('#total_persons_input').val());
        if (!count || count < 1) { alert('কমপক্ষে ১ জন দিন।'); return; }
        var tbody = $('#personsBody');
        tbody.empty();
        for (var i = 0; i < count; i++) { tbody.append(buildRow(i)); }
        $('#personsPanel').show();
        bindCalculation();
    });

    function buildRow(i) {
        return `<tr>
            <td style="text-align:center; font-weight:700; color:#0f766e;">${i + 1}</td>
            <td><input type="text" name="persons[${i}][name]" class="form-control form-control-sm" required placeholder="নাম"></td>
            <td><input type="text" name="persons[${i}][nid]" class="form-control form-control-sm" placeholder="NID"></td>
            <td><input type="text" name="persons[${i}][phone]" class="form-control form-control-sm" placeholder="ফোন"></td>
            <td><input type="text" name="persons[${i}][father_name]" class="form-control form-control-sm" placeholder="পিতার নাম"></td>
            <td><input type="text" name="persons[${i}][present_address]" class="form-control form-control-sm" placeholder="বর্তমান ঠিকানা"></td>
            <td><input type="text" name="persons[${i}][permanent_address]" class="form-control form-control-sm" placeholder="স্থায়ী ঠিকানা"></td>
            <td><input type="number" step="any" name="persons[${i}][acres]" class="form-control form-control-sm acres-input" required placeholder="০.০০" min="0"></td>
            <td><input type="number" step="any" name="persons[${i}][price_per_acre]" class="form-control form-control-sm price-input" required placeholder="০.০০" min="0"></td>
            <td class="total-price-cell"><span class="total-display">৳ 0.00</span></td>
        </tr>`;
    }

    function bindCalculation() {
        $(document).off('input', '.acres-input, .price-input').on('input', '.acres-input, .price-input', function () {
            var row = $(this).closest('tr');
            var acres = parseFloat(row.find('.acres-input').val()) || 0;
            var price = parseFloat(row.find('.price-input').val()) || 0;
            row.find('.total-display').text('৳ ' + (acres * price).toLocaleString('en-BD', {minimumFractionDigits:2, maximumFractionDigits:2}));

            updateLiveCalculations();
        });
    }
    bindCalculation();
    $('.acres-input, .price-input').trigger('input');
});
</script>
@endpush
