@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCaseList'])

@section('title', 'মামলা আপডেট করুন')

@push('style')
<style>
    .case-form-panel {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        margin-top: 20px;
    }
    .case-form-header {
        background-color: #007bff;
        color: #fff;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .case-form-body {
        padding: 0;
    }
    .custom-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }
    .custom-table td {
        padding: 12px 20px;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
    }
    .custom-table td.label-cell {
        width: 25%;
        color: #475569;
        font-weight: 500;
    }
    .custom-table td.colon-cell {
        width: 20px;
        text-align: center;
        color: #94a3b8;
    }
    .custom-table td.input-cell {
        width: auto;
    }
    .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        padding: 8px 12px;
        width: 100%;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        background-color: #fff;
        outline: none;
    }
    
    /* Select2 custom styling */
    .select2-container .select2-selection--single {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        background-color: #f8fafc !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
    }
    
    .radio-group {
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .radio-item {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .radio-item input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #10b981;
    }
    .form-footer {
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
    }
    .btn-save {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-save:hover {
        background-color: #0056b3;
        color: white;
    }
    .btn-back {
        background-color: #1e293b;
        color: white;
        border: none;
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-left: 10px;
    }
    .btn-back:hover {
        background-color: #0f172a;
        color: white;
    }
    
    /* Validation errors */
    .text-danger {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
</style>
@endpush

@section('content')
<section class="content pt-3 pb-5">
    <div class="container-fluid">
        
        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 4px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('land-cases.update', $landCase->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="case-form-panel">
                <div class="case-form-header">
                    মামলা আপডেট করুন
                </div>
                
                <div class="case-form-body">
                    <table class="custom-table">
                        <tbody>
                            <tr>
                                <td class="label-cell">জমির নাম্বার</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <select name="land_no" id="land_no" class="form-control" required style="width: 100%;">
                                        <option value="{{ old('land_no', $landCase->land_no) }}" selected>{{ old('land_no', $landCase->land_no) }}</option>
                                    </select>
                                    @error('land_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="label-cell">কোনো মামলা আছে</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <div class="radio-group">
                                        <label class="radio-item">
                                            <input type="radio" name="has_case" value="1" {{ old('has_case', $landCase->has_case) == '1' ? 'checked' : '' }} required>
                                            <span>হ্যাঁ</span>
                                        </label>
                                        <label class="radio-item">
                                            <input type="radio" name="has_case" value="0" {{ old('has_case', $landCase->has_case) == '0' ? 'checked' : '' }} required>
                                            <span>না</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Case Details Section (Hidden by default) -->
                            <tr class="case-fields" style="display: none;">
                                <td class="label-cell">মামলা নম্বর</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="case_no" class="form-control" value="{{ old('case_no', $landCase->case_no) }}">
                                    @error('case_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display: none;">
                                <td class="label-cell">আদালতের নাম</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="court_name" class="form-control" value="{{ old('court_name', $landCase->court_name) }}">
                                    @error('court_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display: none;">
                                <td class="label-cell">মামলার সর্বশেষ অবস্থা</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="case_status" class="form-control" value="{{ old('case_status', $landCase->case_status) }}">
                                    @error('case_status') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr class="case-fields" style="display: none;">
                                <td class="label-cell">মন্তব্য</td>
                                <td class="colon-cell">:</td>
                                <td class="input-cell">
                                    <input type="text" name="comment" class="form-control" value="{{ old('comment', $landCase->comment) }}">
                                    @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="form-footer">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> আপডেট করুন
                    </button>
                    <a href="{{ route('land-cases.index') }}" class="btn-back">
                        <i class="fas fa-step-backward"></i> ব্যাক করুন
                    </a>
                </div>
            </div>
            
        </form>
    </div>
</section>
@endsection

@push('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        
        // Initialize Select2 for Land Number Autocomplete
        $('#land_no').select2({
            placeholder: "কমপক্ষে ৩টি অক্ষর টাইপ করুন...",
            minimumInputLength: 3,
            ajax: {
                url: "{{ route('ajax.searchLandNo') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                inputTooShort: function(args) {
                    return "কমপক্ষে ৩টি অক্ষর টাইপ করুন...";
                },
                noResults: function() {
                    return "কোনো জমির নাম্বার পাওয়া যায়নি";
                },
                searching: function() {
                    return "খোঁজা হচ্ছে...";
                }
            }
        });

        // Toggle case fields visibility based on Yes/No selection
        function toggleCaseFields() {
            let hasCase = $('input[name="has_case"]:checked').val();
            if (hasCase == '1') {
                $('.case-fields').show();
            } else {
                $('.case-fields').hide();
                // Optionally clear fields when hidden
                //$('.case-fields input').val('');
            }
        }

        // Run on page load
        toggleCaseFields();

        // Run on change
        $('input[name="has_case"]').on('change', function() {
            toggleCaseFields();
        });
    });
</script>
@endpush
