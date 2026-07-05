@extends('backend.master', ['mainMenu' => 'Admin', 'subMenu' => 'AdminList'])

@push('style')
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 10mm;
            /* Consistent margins for all pages */
        }



        /* Main certificate style container */
        .people-certificate-page {
            max-width: 1100px;
            margin: 0 auto;
            /* Remove top/bottom margin */
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: visible;
            /* Changed from hidden to allow page breaks */
            border-radius: 4px;
        }

        .people-certificate-content {
            padding: 10mm 15mm;
            /* Consistent padding for all content */
        }

        /* Ensure consistent padding on all pages */
        .people-certificate-content>* {
            margin-bottom: 0;
            /* Reset margins */
        }

        /* Pad Header (Letterhead) */
        .pad-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double #0f766e;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        .pad-header img {
            height: 70px;
            width: 70px;
            object-fit: contain;
        }

        .pad-header-center {
            text-align: center;
            flex-grow: 1;
        }

        .pad-header-center h4 {
            margin: 0;
            font-size: 16px;
            color: #475569;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .pad-header-center h2 {
            margin: 4px 0;
            font-size: 17px;
            color: #0f766e;
            font-weight: 700;
        }

        .pad-header-center p {
            margin: 4px 0 0;
            font-size: 13px;
            color: #64748b;
        }

        /* Citizen Title Section */
        .citizen-title {
            text-align: center;
            margin: 10px 0;
        }

        .citizen-title h4 {
            font-size: 20px;
            font-weight: bold;
            color: #17a2b8;
            margin: 0;
        }

        .citizen-title p {
            font-size: 16px;
            color: #003366;
            margin: 0;
        }

        /* Section Headers - Prevent page breaks after */
        .section-header {
            background: #17a2b8;
            color: #fff;
            font-weight: bold;
            padding: 6px 12px;
            margin: 20px 0 12px 0;
            font-size: 16px;
            border-radius: 4px;
            letter-spacing: 1px;
            page-break-after: avoid;
            /* Prevent break after section header */
            break-after: avoid;
        }

        .info-row {
            display: flex;
            margin-bottom: 8px;
            font-size: 13px;
            border-bottom: 1px dotted #e0e0e0;
            padding-bottom: 5px;
            page-break-inside: avoid;
            /* Prevent info rows from breaking */
            break-inside: avoid;
        }

        .info-label {
            width: 200px;
            font-weight: bold;
            color: #2c3e4e;
        }

        .info-value {
            flex: 1;
            color: #1e2a36;
        }

        /* Grid for nested sections */
        .nested-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 20px;
            margin-top: 5px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        /* Signature area */
        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            text-align: center;
            border-top: 1px dashed #aaa;
            padding-top: 25px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .sig-block {
            width: 30%;
        }

        .sig-line {
            border-top: 1px solid #000;
            margin: 30px 0 5px;
        }

        /* Photo & ID badge style - Square photo and column layout */
        .photo-badge {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            background: #f8f9fc;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            align-items: flex-start;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .photo-box {
            text-align: center;
            flex-shrink: 0;
        }

        .photo-box img {
            width: 180px;
            height: 210px;
            object-fit: cover;
            border: 2px solid #17a2b8;
            background: #fff;
            border-radius: 8px;
        }

        /* ID info as two columns */
        .id-info-columns {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4px 6px;
            padding: 5px 0;
        }

        .id-info-item {
            background: #e9ecef;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            word-break: break-word;
        }

        .id-info-item span {
            font-weight: normal;
            color: #2c3e4e;
        }

        /* Two column layout for large sections */
        .two-columns {
            display: flex;
            gap: 30px;
            margin-top: 10px;
        }

        .col {
            flex: 1;
        }

        .property-card-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 10px;
        }

        .property-card {
            background: #fbfdfc;
            border: 1px solid #d5e6dd;
            border-radius: 8px;
            padding: 12px 14px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .property-card-title {
            margin: 0 0 10px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #dbe8e2;
            color: #0f5132;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        .property-card .info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .property-card-grid {
                grid-template-columns: 1fr;
            }

            .property-card .info-row {
                flex-direction: column;
                gap: 2px;
            }

            .property-card .info-label {
                width: 100%;
            }
        }

        /* Education table styles */
        .education-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .education-table th,
        .education-table td {
            border: 1px solid #dee2e6;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
            font-size: 13px;
        }

        .education-table th {
            background-color: #e9ecef;
            font-weight: bold;
            color: #2c3e4e;
        }

        .education-table tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        /* Print styles */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .people-certificate-page {
                margin: 0;
                padding: 0;
                box-shadow: none;
                border-radius: 0;
                width: 100%;
            }

            .people-certificate-content {
                padding: 10mm 15mm;
                /* Consistent padding on all pages */
            }

            .no-print {
                display: none !important;
            }

            /* Ensure consistent margins across pages */
            .info-row,
            .section-header,
            .photo-badge,
            .two-columns,
            .nested-grid,
            .signature-area,
            .education-table {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            /* Allow page breaks between sections but maintain spacing */
            .section-header {
                page-break-after: avoid;
                break-after: avoid;
                margin-top: 20px;
            }

            /* Keep related content together */
            .section-header+.two-columns,
            .section-header+.nested-grid,
            .section-header+.education-table {
                page-break-before: avoid;
                break-before: avoid;
            }

            /* Ensure proper margins on new pages */
            @page {
                margin: 15mm 10mm;
            }

            /* Prevent orphaned content */
            p,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                orphans: 3;
                widows: 3;
            }

            .main-footer {
                display: none;
            }

            /* Remove box shadow for print */
            .people-certificate-page {
                box-shadow: none;
            }

            /* Print background colors for table headers */
            .education-table th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        .btn-print-custom {
            background: #17a2b8;
            border: none;
            padding: 8px 20px;
            font-weight: bold;
        }

        .btn-print-custom:hover {
            background: #138496;
        }

        /* Additional print-specific fixes */
        @media print {

            /* Force background colors to print */
            .section-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .id-info-item {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .photo-badge {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Ensure no content is cut off */
            * {
                box-sizing: border-box;
            }
        }
    </style>
@endpush

@section('title', 'Institutional Admin Information Details')

@section('content')
    <x-print-view title="ইনস্টিটিউশনাল অ্যাডমিন তথ্য বিবরণী">



        {{-- Photo and ID block --}}
        <div class="photo-badge">
            <div class="photo-box">
                <img src="{{ $user->image ? asset($user->image) : asset('public/no-image-found.jpeg') }}"
                    alt="Profile Photo">
            </div>
            <div class="id-info-columns">
                <div class="id-info-item"><span>Name :</span> {{ $user->name ?? '' }}</div> </br>
                <div class="id-info-item"><span>Role :</span> {{ $user->role?->name ?? 'N/A' }}</div> </br>
                <div class="id-info-item"><span>Department :</span> {{ optional($user->department)->name ?? 'N/A' }}
                </div> </br>
                <div class="id-info-item"><span>Section :</span> {{ optional($user->section)->name ?? 'N/A' }}</div>
                </br>
                <div class="id-info-item"><span>Status :</span>
                    {{ $user->status == 1 ? 'Active / Verified' : 'Pending Review' }}</div> </br>
            </div>
        </div>

        {{-- Personal Information --}}
        <div class="section-header">অ্যাকাউন্ট ও ব্যক্তিগত তথ্য / Account & Personal Information</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">Name (English) :</span><span
                        class="info-value">{{ $user->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Email Address :</span><span
                        class="info-value">{{ $user->email ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Mobile No. :</span><span
                        class="info-value">{{ $user->mobile ?? 'N/A' }}</span></div>
                <div class="info-row"><span class="info-label">NID No. :</span><span
                        class="info-value">{{ $user->nid ?? 'N/A' }}</span></div>
                @if($user->people)
                    <div class="info-row"><span class="info-label">Blood Group :</span><span
                            class="info-value">{{ people_constant_option('blood_group')[optional($user->people)->blood_group ?? ''] ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Date of Birth :</span><span
                            class="info-value">{{ optional($user->people)->date_of_birth ?? 'N/A' }}</span></div>
                @endif
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Name (Bangla) :</span><span
                        class="info-value">{{ optional($user->people)->bn_name ?? 'N/A' }}</span></div>
                <div class="info-row"><span class="info-label">Department :</span><span
                        class="info-value">{{ optional($user->department)->name ?? 'N/A' }}
                        @if(optional($user->department)->bn_name) ({{ optional($user->department)->bn_name }})
                        @endif</span></div>
                <div class="info-row"><span class="info-label">Section :</span><span
                        class="info-value">{{ optional($user->section)->name ?? 'N/A' }}
                        @if(optional($user->section)->bn_name) ({{ optional($user->section)->bn_name }}) @endif</span>
                </div>
                <div class="info-row"><span class="info-label">Primary Role :</span><span
                        class="info-value">{{ $user->role?->name ?? 'N/A' }}</span></div>
                @if($user->people)
                    <div class="info-row"><span class="info-label">Gender :</span><span
                            class="info-value">{{ people_constant_option('gender')[optional($user->people)->gender ?? ''] ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Religion :</span><span
                            class="info-value">{{ optional($user->people)->religion->name ?? 'N/A' }}</span></div>
                @endif
            </div>
        </div>

        {{-- Family Information (Only if populated) --}}
        @if($user->familyInfo)
            <div class="section-header">পারিবারিক তথ্য / Family Information</div>
            <div class="two-columns">
                <div class="col">
                    <div class="info-row"><span class="info-label">Father's Name :</span><span
                            class="info-value">{{ $user->familyInfo->father_name ?? '' }} </span></div>
                    <div class="info-row"><span class="info-label">Father's NID :</span><span
                            class="info-value">{{ $user->familyInfo->father_nid ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Mother's Name :</span><span
                            class="info-value">{{ $user->familyInfo->mother_name ?? '' }} </span></div>
                    <div class="info-row"><span class="info-label">Mother's NID :</span><span
                            class="info-value">{{ $user->familyInfo->mother_nid ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Marital Status :</span><span
                            class="info-value">{{ family_constant_option('marital_status')[$user->familyInfo->marital_status ?? ''] ?? '' }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="info-row"><span class="info-label">Father's Name (Bangla) :</span><span
                            class="info-value">{{ $user->familyInfo->father_name_bn ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Father's Live Status :</span><span
                            class="info-value">{{ family_constant_option('live_status')[$user->familyInfo->father_live_status ?? ''] ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Mother's Name (Bangla) :</span><span class="info-value">
                            {{ $user->familyInfo->mother_name_bn ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Mother's Live Status :</span><span
                            class="info-value">{{ family_constant_option('live_status')[$user->familyInfo->mother_live_status ?? ''] ?? '' }}</span>
                    </div>
                    @if(isset($user->familyInfo->marital_status) && $user->familyInfo->marital_status != 1)
                        <div class="info-row"><span class="info-label">Spouse NID :</span><span
                                class="info-value">{{ $user->familyInfo->spouse_nid ?? '' }}</span></div>
                    @endif
                </div>
            </div>
        @endif



        {{-- Education Section as Table (Only if populated) --}}
        @if($user->educationInfos && count($user->educationInfos) > 0)
            <div class="section-header">শিক্ষাগত যোগ্যতা / Education</div>
            <table class="education-table">
                <thead>
                    <tr>
                        <th>ডিগ্রি / Degree</th>
                        <th>গ্রুপ / Group</th>
                        <th>গ্রেড / Grade</th>
                        <th>বোর্ড / Board</th>
                        <th>ইনস্টিটিউট / Institute</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->educationInfos as $edu)
                        <tr>
                            <td>
                                @php
                                    $degreeNames = [
                                        1 => 'PSC',
                                        2 => 'JSC',
                                        3 => 'SSC',
                                        4 => 'HSC',
                                        5 => 'Diploma',
                                        6 => 'Bachelor of Arts (BA)',
                                        7 => 'Bachelor of Science (BSc)',
                                        8 => 'Bachelor of Business Administration (BBA)',
                                        9 => 'Bachelor of Social Science (BSS)',
                                        10 => 'Honours',
                                        11 => 'Masters',
                                        12 => 'MBA',
                                        13 => 'M.Sc',
                                        14 => 'M.A',
                                        15 => 'M.Phil',
                                        16 => 'PhD',
                                        17 => 'Post Graduate Diploma (PGD)',
                                        18 => 'LLB',
                                        19 => 'MBBS',
                                        20 => 'BDS',
                                        21 => 'B.Ed',
                                        22 => 'M.Ed',
                                        23 => 'Engineering (BSc Eng)',
                                        24 => 'Fazil',
                                        25 => 'Kamil',
                                        26 => 'Dakhil',
                                        27 => 'Alim',
                                        28 => 'Other'
                                    ];
                                @endphp
                                {{ $degreeNames[$edu->degree_id] ?? $edu->degree_id }}
                            </td>
                            <td>
                                @if($edu->group_id == 1) Science
                                @elseif($edu->group_id == 2) Business
                                @elseif($edu->group_id == 3) Humanities
                                @else {{ $edu->group_id ?? '' }}
                                @endif
                            </td>
                            <td>
                                @php
                                    $grades = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'D', 'F'];
                                @endphp
                                {{ $edu->grade_id ? ($grades[$edu->grade_id - 1] ?? '') : '' }}
                            </td>
                            <td>
                                @php
                                    $boards = ['Dhaka', 'Rajshahi', 'Rangpur', 'Jessore', 'Comilla', 'Sylhet', 'Chittagong'];
                                @endphp
                                {{ $edu->board_id ? ($boards[$edu->board_id - 1] ?? '') : '' }}
                            </td>
                            <td>{{ $edu->institute ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Profession Section --}}
        @if($user->professionalInfos && count($user->professionalInfos) > 0)
            <div class="section-header">পেশাগত তথ্য / Employment Information</div>
            @foreach($user->professionalInfos as $prof)
                @php
                    $deptName = '';
                    if ($prof->department) {
                        $dept = \App\Models\Department\Department::find($prof->department);
                        $deptName = $dept ? $dept->name : '';
                    }
                    $sectionName = '';
                    if ($prof->current_designation) {
                        $sectionValue = trim((string) $prof->current_designation);
                        if ($sectionValue !== '' && ctype_digit($sectionValue)) {
                            $sect = \App\Models\Department\Section::find((int) $sectionValue);
                            $sectionName = $sect
                                ? ($sect->name . (!empty($sect->bn_name) ? ' (' . $sect->bn_name . ')' : ''))
                                : $sectionValue;
                        } else {
                            $sectionName = $sectionValue;
                        }
                    }
                    $currentDesignationName = trim((string) ($prof->designation ?? ''));
                    if ($currentDesignationName === '') {
                        $currentDesignationName = $sectionName;
                    }
                @endphp
                <div class="two-columns">
                    <div class="col">
                        <div class="info-row"><span class="info-label">Recruitment Notice No :</span><span
                                class="info-value">{{ $prof->recruitment_notice_no ?? '' }}</span></div>
                        <div class="info-row"><span class="info-label">Appointment Letter No :</span><span
                                class="info-value">{{ $prof->appointment_letter_no ?? '' }}</span></div>
                        <div class="info-row"><span class="info-label">Designation at Joining :</span><span
                                class="info-value">{{ $prof->designation_joining ?? '' }}</span></div>
                        <div class="info-row"><span class="info-label">Date of Joining :</span><span
                                class="info-value">{{ $prof->date_of_joining ? date('d-m-Y', strtotime($prof->date_of_joining)) : '' }}</span>
                        </div>
                        <div class="info-row"><span class="info-label">Department :</span><span
                                class="info-value">{{ $deptName }}</span></div>
                    </div>
                    <div class="col">
                        <div class="info-row"><span class="info-label">Section :</span><span
                                class="info-value">{{ $sectionName ?: 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Current Designation :</span><span
                                class="info-value">{{ $currentDesignationName ?: 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Date of Current Designation :</span><span
                                class="info-value">{{ $prof->date_current_designation ? date('d-m-Y', strtotime($prof->date_current_designation)) : '' }}</span>
                        </div>
                        <div class="info-row"><span class="info-label">Current Workplace :</span><span
                                class="info-value">{{ $prof->current_workplace ?? '' }}</span></div>
                        <div class="info-row"><span class="info-label">Date of Joining Current Workplace :</span><span
                                class="info-value">{{ $prof->date_joining_current_workplace ? date('d-m-Y', strtotime($prof->date_joining_current_workplace)) : '' }}</span>
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                <hr style="border-top: 1px dotted #ccc;">@endif
            @endforeach
        @endif

        {{-- Financial Section --}}
        @if($user->financialInfos && count($user->financialInfos) > 0)
            <div class="section-header">আর্থিক তথ্য / Financial Information</div>
            @foreach($user->financialInfos as $fin)
                <div class="info-row"><span class="info-label">A/C No :</span><span class="info-value">{{ $fin->account_no ?? '' }}
                        ({{ optional($fin->accountType)->en_name ?? '' }})</span></div>
                <div class="info-row"><span class="info-label">Bank :</span><span
                        class="info-value">{{ optional($fin->bank)->en_name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Balance :</span><span
                        class="info-value">{{ $fin->account_balance ?? '0' }} BDT</span></div>
            @endforeach
        @endif

        {{-- Property Details --}}
        @if($user->propertyInfos && optional($user->propertyInfos)->is_property)
            @php
                $property = $user->propertyInfos;

                $districtCollection = collect($districts ?? []);
                $landThanaCollection = collect($landThanas ?? []);
                $landMouzaCollection = collect($landMouzas ?? []);
                $flatThanaCollection = collect($flatThanas ?? []);
                $flatMouzaCollection = collect($flatMouzas ?? []);

                $nameOf = function ($item) {
                    if (!$item) {
                        return '';
                    }
                    return $item->name ?? $item->en_name ?? $item->bn_name ?? '';
                };

                $hasText = function ($value) {
                    return !is_null($value) && trim((string) $value) !== '';
                };

                $hasAmount = function ($value) use ($hasText) {
                    if (!$hasText($value)) {
                        return false;
                    }
                    $normalized = str_replace(',', '', trim((string) $value));
                    return !is_numeric($normalized) || (float) $normalized > 0;
                };

                $formatCurrency = function ($value) {
                    $normalized = str_replace(',', '', trim((string) $value));
                    if (is_numeric($normalized)) {
                        return number_format((float) $normalized, 2) . ' BDT';
                    }
                    return $value . ' BDT';
                };

                $landDistrictName = $nameOf($districtCollection->firstWhere('id', $property->land_district_id));
                $landThanaName = $nameOf($landThanaCollection->firstWhere('id', $property->land_thana_id));
                $landMouzaName = $nameOf($landMouzaCollection->firstWhere('id', $property->land_mouza_id));
                $landLocationParts = array_filter([$landDistrictName, $landThanaName, $landMouzaName]);

                $flatDistrictName = $nameOf($districtCollection->firstWhere('id', $property->flat_district_id));
                $flatThanaName = $nameOf($flatThanaCollection->firstWhere('id', $property->flat_thana_id));
                $flatMouzaName = $nameOf($flatMouzaCollection->firstWhere('id', $property->flat_mouza_id));
                $flatLocationParts = array_filter([$flatDistrictName, $flatThanaName, $flatMouzaName]);

                $showGeneralCard = $hasAmount($property->cash_amount) || $hasText($property->tin_number);
            @endphp

            <div class="section-header">সম্পত্তির তথ্য / Property Information</div>
            <div class="property-card-grid">
                @if($showGeneralCard)
                    <div class="property-card">
                        <h5 class="property-card-title">General Property Info</h5>
                        @if($hasAmount($property->cash_amount))
                            <div class="info-row"><span class="info-label">Cash Amount :</span><span
                                    class="info-value">{{ $formatCurrency($property->cash_amount) }}</span></div>
                        @endif
                        @if($hasText($property->tin_number))
                            <div class="info-row"><span class="info-label">E-TIN :</span><span
                                    class="info-value">{{ $property->tin_number }}</span></div>
                        @endif
                    </div>
                @endif

                @if($property->house)
                    <div class="property-card">
                        <h5 class="property-card-title">House Information</h5>
                        @if($hasText($property->house_type))
                            <div class="info-row"><span class="info-label">House Type :</span><span
                                    class="info-value">{{ $property->house_type }}</span></div>
                        @endif
                        @if($hasText($property->house_area))
                            <div class="info-row"><span class="info-label">House Area :</span><span
                                    class="info-value">{{ $property->house_area }}</span></div>
                        @endif
                        @if($hasText($property->house_land_quantity))
                            <div class="info-row"><span class="info-label">Land Quantity :</span><span
                                    class="info-value">{{ $property->house_land_quantity }}</span></div>
                        @endif
                        @if($hasAmount($property->house_price))
                            <div class="info-row"><span class="info-label">House Price :</span><span
                                    class="info-value">{{ $formatCurrency($property->house_price) }}</span></div>
                        @endif
                        @if($hasText($property->house_ownership_status))
                            <div class="info-row"><span class="info-label">Owner Information :</span><span
                                    class="info-value">{{ $property->house_ownership_status }}</span></div>
                        @endif
                        @if($hasText($property->house_address))
                            <div class="info-row"><span class="info-label">House Address :</span><span
                                    class="info-value">{{ $property->house_address }}</span></div>
                        @endif
                    </div>
                @endif

                @if($property->land)
                    <div class="property-card">
                        <h5 class="property-card-title">Land Information</h5>
                        @if($hasText($property->land_quantity))
                            <div class="info-row"><span class="info-label">Land Quantity :</span><span
                                    class="info-value">{{ $property->land_quantity }}</span></div>
                        @endif
                        @if($hasText($property->land_type))
                            <div class="info-row"><span class="info-label">Land Type :</span><span
                                    class="info-value">{{ $property->land_type }}</span></div>
                        @endif
                        @if($hasText($property->land_ownership_status))
                            <div class="info-row"><span class="info-label">Owner Information :</span><span
                                    class="info-value">{{ $property->land_ownership_status }}</span></div>
                        @endif
                        @if(!empty($landLocationParts))
                            <div class="info-row"><span class="info-label">Location :</span><span
                                    class="info-value">{{ implode(', ', $landLocationParts) }}</span></div>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        {{-- Signature Area like Certificate --}}
        <div class="signature-area" style="margin-top: 100px;">
            <div class="sig-block">
                <div class="sig-line"></div>
                স্বাক্ষর / Signature
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                সীল / Seal
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                কর্তৃপক্ষ / Authority
            </div>
        </div>
        <div class="text-center mt-3 small text-muted">ইস্যুর তারিখ: {{ date('d/m/Y') }}</div>
    </x-print-view>
    
    <!-- Navigation Buttons (Hidden on Print) -->
    <div class="no-print" style="display: flex; gap: 10px; margin-top: 20px; margin-bottom: 40px; justify-content: center;">
        <a href="{{ route('institutional-admin.edit', $user->id) }}" class="btn btn-warning text-white"
            style="font-weight: 700; border-radius: 6px; padding: 7px 14px;">
            <i class="fa fa-edit"></i> Edit / এডিট
        </a>
        <a href="{{ route('institutional-admin.index') }}" class="btn btn-secondary"
            style="font-weight: 700; border-radius: 6px; padding: 7px 14px;">
            <i class="fa fa-arrow-left"></i> Back to List / তালিকা
        </a>
        <button onclick="window.print()" class="btn btn-info text-white"
            style="font-weight: 700; border-radius: 6px; padding: 7px 14px; display: flex; align-items: center;">
            <img src="{{ asset('design_tem/print.png') }}" alt="Print" style="width: 20px; height: 20px; margin-right: 8px; filter: brightness(0) invert(1);"> Printout
        </button>
    </div>
@endsection