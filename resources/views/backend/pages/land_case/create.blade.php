@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCaseList'])

@section('title', 'নতুন মামলা তৈরী করুন')

@push('style')
<style>
    .case-form-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .case-form-header {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        color: #fff;
        padding: 14px 22px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .case-form-body { padding: 0; }
    .custom-table { width: 100%; margin-bottom: 0; border-collapse: collapse; }
    .custom-table td {
        padding: 13px 20px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .custom-table td.label-cell {
        width: 26%;
        color: #374151;
        font-weight: 600;
        background: #f8fafc;
        font-size: 14px;
    }
    .custom-table td.colon-cell { width: 24px; text-align: center; color: #94a3b8; }
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
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        outline: none;
    }
    .radio-group { display: flex; gap: 24px; align-items: center; }
    .radio-item { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; }
    .radio-item input[type="radio"] { width: 17px; height: 17px; accent-color: #1d4ed8; cursor: pointer; }
    .form-footer {
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-radius: 0 0 8px 8px;
    }
    .btn-save {
        background: linear-gradient(135deg,#1d4ed8,#1e40af);
        color: white; border: none;
        padding: 10px 28px; border-radius: 6px;
        font-weight: 600; font-size: 14px;
        display: inline-flex; align-items: center; gap: 8px;
        transition: opacity .2s;
    }
    .btn-save:hover { opacity: .88; color: white; }
    .btn-back {
        background: #1e293b; color: white; border: none;
        padding: 10px 24px; border-radius: 6px;
        font-weight: 600; font-size: 14px;
        display: inline-flex; align-items: center; gap: 8px;
        margin-left: 10px; transition: opacity .2s;
    }
    .btn-back:hover { opacity: .85; color: white; }
    .text-danger { color: #ef4444; font-size: 12px; margin-top: 4px; display: block; }

    /* ── Custom Autocomplete ── */
    .land-search-wrap { position: relative; }
    .land-search-wrap .search-icon {
        position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
        color: #94a3b8; font-size: 14px; pointer-events: none;
        transition: color .2s;
    }
    .land-search-wrap input.land-search-input {
        padding-left: 34px;
        padding-right: 80px;
    }
    .land-search-wrap input.land-search-input:focus ~ .search-icon,
    .land-search-wrap:focus-within .search-icon { color: #3b82f6; }
    .land-search-wrap .search-badge {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: #e0f2fe; color: #0369a1;
        font-size: 11px; font-weight: 600; padding: 2px 8px;
        border-radius: 20px; white-space: nowrap;
        display: none;
    }
    .land-search-wrap .clear-btn {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: #94a3b8; font-size: 16px;
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
    .land-dropdown .dd-item.active { background: #eff6ff; color: #1d4ed8; }
    .land-dropdown .dd-item .dd-icon {
        width: 28px; height: 28px; border-radius: 6px;
        background: #dbeafe; display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
        font-size: 12px; color: #1d4ed8;
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
<section class="content pt-3 pb-5">
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius:6px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('land-cases.store') }}" method="POST">
            @csrf
            <div class="case-form-panel">
                <div class="case-form-header">
                    <i class="fas fa-gavel"></i> নতুন মামলা তৈরী করুন
                </div>

                <div class="case-form-body">
                    <table class="custom-table">
                        <tbody>
                            {{-- ── জমির নাম্বার ── --}}
                            <tr>
                                <td class="label-cell">
                                    <i class="fas fa-map-pin" style="color:#3b82f6; margin-right:6px;"></i>
                                    জমির নাম্বার <span class="text-danger" style="display:inline;">*</span>
                                </td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    {{-- Hidden real value for form submit --}}
                                    <input type="hidden" name="land_no" id="land_no_hidden" value="{{ old('land_no') }}" required>

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

                            {{-- ── কোনো মামলা আছে ── --}}
                            <tr>
                                <td class="label-cell">
                                    <i class="fas fa-question-circle" style="color:#3b82f6; margin-right:6px;"></i>
                                    কোনো মামলা আছে
                                </td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <div class="radio-group">
                                        <label class="radio-item">
                                            <input type="radio" name="has_case" value="1" {{ old('has_case') == '1' ? 'checked' : '' }} required>
                                            <span>হ্যাঁ</span>
                                        </label>
                                        <label class="radio-item">
                                            <input type="radio" name="has_case" value="0" {{ old('has_case', '0') == '0' ? 'checked' : '' }} required>
                                            <span>না</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>

                            {{-- ── Case fields (hidden by default) ── --}}
                            <tr class="case-fields" style="display:none;">
                                <td class="label-cell"><i class="fas fa-hashtag" style="color:#3b82f6; margin-right:6px;"></i> মামলা নম্বর</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="case_no" id="case_no" class="form-control"
                                           value="{{ old('case_no') }}"
                                           placeholder="জমির নাম্বার নির্বাচন করলে স্বয়ংক্রিয়ভাবে পূরণ হবে">
                                    @error('case_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display:none;">
                                <td class="label-cell"><i class="fas fa-landmark" style="color:#3b82f6; margin-right:6px;"></i> আদালতের নাম</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="court_name" class="form-control" value="{{ old('court_name') }}">
                                    @error('court_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display:none;">
                                <td class="label-cell"><i class="fas fa-info-circle" style="color:#3b82f6; margin-right:6px;"></i> মামলার সর্বশেষ অবস্থা</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="case_status" class="form-control" value="{{ old('case_status') }}">
                                    @error('case_status') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display:none;">
                                <td class="label-cell"><i class="fas fa-comment" style="color:#3b82f6; margin-right:6px;"></i> মন্তব্য</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="comment" class="form-control" value="{{ old('comment') }}">
                                    @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> সংরক্ষণ করুন
                    </button>
                    <a href="{{ route('land-cases.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> ফিরে যান
                    </a>
                </div>
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
    var $input   = $('#land_no_search');
    var $hidden  = $('#land_no_hidden');
    var $dd      = $('#land_dropdown');
    var $clearBtn = $('#land_clear_btn');

    function showDropdown(html) {
        $dd.html(html).show();
        activeIndex = -1;
    }
    function hideDropdown() { $dd.hide(); activeIndex = -1; }

    function selectLand(val) {
        $input.val(val);
        $hidden.val(val);
        $clearBtn.show();
        hideDropdown();
        fetchCaseNo(val);
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

    /* click on item */
    $(document).on('click', '.dd-item', function () {
        selectLand($(this).data('val'));
    });

    /* clear button */
    $clearBtn.on('click', function () {
        $input.val('');
        $hidden.val('');
        $clearBtn.hide();
        $('#case_no').val('');
        hideDropdown();
        $input.focus();
    });

    /* close on outside click */
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.land-search-wrap').length) hideDropdown();
    });

    /* init clear btn if old value present */
    if ($input.val()) $clearBtn.show();

    /* ════════════════════════════════
       Auto-fill case_no
    ════════════════════════════════ */
    function fetchCaseNo(landNo) {
        $.get("{{ route('ajax.getLandCaseNo') }}", { land_no: landNo }, function (res) {
            $('#case_no').val(res.case_no || '');
        });
    }

    /* ════════════════════════════════
       Toggle case fields
    ════════════════════════════════ */
    function toggleCaseFields() {
        $('input[name="has_case"]:checked').val() == '1'
            ? $('.case-fields').show()
            : $('.case-fields').hide();
    }
    toggleCaseFields();
    $('input[name="has_case"]').on('change', toggleCaseFields);
});
</script>
@endpush
