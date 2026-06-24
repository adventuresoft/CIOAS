@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'View'])

@push('style')
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 10mm;
            /* Consistent margins for all pages */
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
            font-size: 14px !important;
            line-height: 1.4;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background: #f4f6f9;
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

        /* Header Logos and Title */
        .header-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #006600;
            padding-bottom: 10px;
        }

        .header-logos img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        /* Union header section - centered text */
        .union-header {
            text-align: center;
            flex: 1;
        }

        .union-title-bn {
            font-size: 20px;
            font-weight: bold;
            color: #006600;
            margin: 0;
        }

        .union-title-en {
            font-size: 18px;
            font-weight: bold;
            color: #2e3192;
            margin: 2px 0;
        }

        .union-address {
            font-size: 16px;
            margin: 0;
            color: #333;
        }

        /* Citizen Title Section */
        .citizen-title {
            text-align: center;
            margin: 10px 0;
        }

        .citizen-title h4 {
            font-size: 20px;
            font-weight: bold;
            color: #006600;
            margin: 0;
        }

        .citizen-title p {
            font-size: 16px;
            color: #003366;
            margin: 0;
        }

        /* Section Headers - Prevent page breaks after */
        .section-header {
            background: #006600;
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
            border: 2px solid #006600;
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
            background: #006600;
            border: none;
            padding: 8px 20px;
            font-weight: bold;
        }

        .btn-print-custom:hover {
            background: #004d00;
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

@section('title', 'Staff Information Details')

@section('content')
    <div class="people-certificate-page">
        <div class="people-certificate-content">

            {{-- Header with Logos --}}
            @php
                $headerUnion = $user->addressInfo?->presentUnion ?? $user->institute?->union;
            @endphp
            <div class="header-logos">
                <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
                <div class="union-header">
                    <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                    <div class="union-title-bn">{{ $headerUnion?->bn_name ?? '' }}</div>
                    <div class="union-title-en">{{ $headerUnion?->name ?? '' }}</div>
                    <p class="union-address">
                        থানাঃ {{ $headerUnion?->thana?->bn_name ?? '' }},
                        জেলাঃ {{ $headerUnion?->thana?->district?->bn_name ?? '' }},
                        বাংলাদেশ।
                    </p>
                </div>
                <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
            </div>


            {{-- Citizen Title (centered) --}}
            <div class="citizen-title">
                <h4>কর্মচারীর তথ্য বিবরণী</h4>
                <p>Staff Information Record</p>
            </div>

            {{-- Photo and ID block --}}
            <div class="photo-badge">
                <div class="photo-box">
                    <img src="{{ $user->image ? asset($user->image) : asset('public/no-image-found.jpeg') }}"
                        alt="Profile Photo">
                </div>
                <div class="id-info-columns">
                    <div class="id-info-item"><span>Name :</span> {{ $user->name ?? '' }}</div> </br>
                    <div class="id-info-item"><span>Name (Bangla) :</span> {{ $user->people->bn_name ?? '' }}</div> </br>
                    <div class="id-info-item"><span>Staff ID :</span>
                        {{ $user->people->staff_id ?? $user->people->approved_id ?? '' }}</div> </br>
                    <div class="id-info-item"><span>NID :</span> {{ $user->nid ?? '' }}</div> </br>
                    <div class="id-info-item"><span>Mobile :</span> {{ $user->mobile ?? '' }}</div> </br>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="section-header">ব্যক্তিগত তথ্য / Personal Information</div>
            <div class="two-columns">
                <div class="col">
                    <div class="info-row"><span class="info-label">Name (English) :</span><span
                            class="info-value">{{ $user->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">NID No. :</span><span
                            class="info-value">{{ $user->nid ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Blood Group :</span><span
                            class="info-value">{{ people_constant_option('blood_group')[$user->people->blood_group ?? ''] ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Date of Birth :</span><span
                            class="info-value">{{ $user->people->date_of_birth ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Birth Place :</span><span
                            class="info-value">{{ optional(\App\Models\District::find($user->people->birth_place ?? null))->name }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="info-row"><span class="info-label">Name (Bangla) :</span><span
                            class="info-value">{{ $user->people->bn_name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Birth Reg. No. :</span><span
                            class="info-value">{{ $user->birth_certificate ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Gender :</span><span
                            class="info-value">{{ people_constant_option('gender')[$user->people->gender ?? ''] ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Religion :</span><span
                            class="info-value">{{ $user->people->religion->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Email :</span><span
                            class="info-value">{{ $user->email ?? '' }}</span></div>
                </div>
            </div>

            {{-- Family Information --}}
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
                    <div class="info-row"><span class="info-label">Father's Name :</span><span
                            class="info-value">{{ $user->familyInfo->father_name_bn ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Father's Live Status :</span><span
                            class="info-value">{{ family_constant_option('live_status')[$user->familyInfo->father_live_status ?? ''] ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Mother's Name :</span><span class="info-value">
                            {{ $user->familyInfo->mother_name_bn ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Mother's Live Status :</span><span
                            class="info-value">{{ family_constant_option('live_status')[$user->familyInfo->mother_live_status ?? ''] ?? '' }}</span>
                    </div>
                    @if(isset($user->familyInfo->marital_status) && $user->familyInfo->marital_status != 1)
                        <div class="info-row"><span class="info-label">Spouse NID :</span><span
                                class="info-value">{{ $user->familyInfo->spouse_nid ?? '' }}</span></div>
                    @endif
                    @if($user->familyInfo->have_children ?? false)
                        <div class="info-row"><span class="info-label">Children :</span><span class="info-value">Boys:
                                {{ $user->familyInfo->boys ?? 0 }}, Girls: {{ $user->familyInfo->girls ?? 0 }}</span></div>
                    @endif
                </div>
            </div>

            @php
                //dd($user->addressInfo);
            @endphp
            {{-- Address Information (Permanent & Present side by side) --}}
            <div class="section-header">ঠিকানার তথ্য / Address Information</div>
            <div class="two-columns">
                <div class="col">
                    <h6 class="mb-2 font-weight-bold">স্থায়ী ঠিকানা / Permanent Address</h6>
                    <div class="info-row"><span class="info-label">District :</span><span
                            class="info-value">{{ $user->addressInfo->permanentDistrict->name ?? $user->addressInfo->permanentVillage->district->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Thana :</span><span
                            class="info-value">{{ $user->addressInfo->permanentThana->name ?? $user->addressInfo->permanentVillage->thana->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Union :</span><span
                            class="info-value">{{ $user->addressInfo->permanentUnion->name ?? $user->addressInfo->permanentVillage->union->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Post Office :</span><span
                            class="info-value">{{ $user->addressInfo->permanentPostoffice->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Village :</span><span
                            class="info-value">{{ $user->addressInfo->permanentVillage->en_name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Ward :</span><span
                            class="info-value">{{ $user->addressInfo->permanentWard->en_ward_no ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Area :</span><span
                            class="info-value">{{ $user->addressInfo->permanent_area ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Road :</span><span
                            class="info-value">{{ $user->addressInfo->permanentRoad->name ?? $user->addressInfo->permanent_road ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">House :</span><span
                            class="info-value">{{ $user->addressInfo->permanentHouse->house ?? $user->addressInfo->permanent_house ?? '' }}</span>
                    </div>
                </div>
                <div class="col">
                    <h6 class="mb-2 font-weight-bold">বর্তমান ঠিকানা / Present Address</h6>
                    <div class="info-row"><span class="info-label">District :</span><span
                            class="info-value">{{ $user->addressInfo->presentDistrict->name ?? $user->addressInfo->presentVillage->district->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Thana :</span><span
                            class="info-value">{{ $user->addressInfo->presentThana->name ?? $user->addressInfo->presentVillage->thana->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Union :</span><span
                            class="info-value">{{ $user->addressInfo->presentUnion->name ?? $user->addressInfo->presentVillage->union->name ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Post Office :</span><span
                            class="info-value">{{ $user->addressInfo->presentPostoffice->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Village :</span><span
                            class="info-value">{{ $user->addressInfo->presentVillage->en_name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Ward :</span><span
                            class="info-value">{{ $user->addressInfo->presentWard->en_ward_no ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Area :</span><span
                            class="info-value">{{ $user->addressInfo->present_area ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Road :</span><span
                            class="info-value">{{ $user->addressInfo->presentRoad->name ?? $user->addressInfo->present_road ?? '' }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">House :</span><span
                            class="info-value">{{ $user->addressInfo->presentHouse->house ?? $user->addressInfo->present_house ?? '' }}</span>
                    </div>
                </div>
            </div>

            {{-- Education Section as Table --}}
            @if(count($user->educationInfos) > 0)
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
            @if(count($user->professionalInfos) > 0)
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
                    <hr>@endif
                @endforeach
            @endif

            {{-- Financial & Property Info merged for brevity but structured --}}
            @if(count($user->financialInfos) > 0)
                <div class="section-header">আর্থিক তথ্য / Financial Information</div>
                @foreach($user->financialInfos as $fin)
                    <div class="info-row"><span class="info-label">A/C No :</span><span
                            class="info-value">{{ $fin->account_no ?? '' }} ({{ $fin->accountType->en_name ?? '' }})</span></div>
                    <div class="info-row"><span class="info-label">Bank :</span><span
                            class="info-value">{{ $fin->bank->en_name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Balance :</span><span
                            class="info-value">{{ $fin->account_balance ?? '0' }} BDT</span></div>
                @endforeach
            @endif

            {{-- Property Details (if any) --}}
            @if(isset($user->propertyInfos) && ($user->propertyInfos->is_property ?? false))
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
                @endphp

                @php
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
                            @if($hasText($property->land_khatian_id))
                                <div class="info-row"><span class="info-label">Khatian No :</span><span
                                        class="info-value">{{ $property->land_khatian_id }}</span></div>
                            @endif
                            @if($hasText($property->land_dag_no))
                                <div class="info-row"><span class="info-label">Dag No :</span><span
                                        class="info-value">{{ $property->land_dag_no }}</span></div>
                            @endif
                            @if($hasText($property->land_bs))
                                <div class="info-row"><span class="info-label">BS :</span><span
                                        class="info-value">{{ $property->land_bs }}</span></div>
                            @endif
                            @if($hasText($property->land_rs))
                                <div class="info-row"><span class="info-label">RS :</span><span
                                        class="info-value">{{ $property->land_rs }}</span></div>
                            @endif
                            @if($hasText($property->land_sa))
                                <div class="info-row"><span class="info-label">SA :</span><span
                                        class="info-value">{{ $property->land_sa }}</span></div>
                            @endif
                            @if($hasText($property->land_cs))
                                <div class="info-row"><span class="info-label">CS :</span><span
                                        class="info-value">{{ $property->land_cs }}</span></div>
                            @endif
                        </div>
                    @endif

                    @if($property->flat)
                        <div class="property-card">
                            <h5 class="property-card-title">Flat Information</h5>
                            @if($hasText($property->flat_area))
                                <div class="info-row"><span class="info-label">Flat Area :</span><span
                                        class="info-value">{{ $property->flat_area }}</span></div>
                            @endif
                            @if($hasText($property->flat_quantity))
                                <div class="info-row"><span class="info-label">Flat Quantity :</span><span
                                        class="info-value">{{ $property->flat_quantity }}</span></div>
                            @endif
                            @if($hasText($property->flat_road))
                                <div class="info-row"><span class="info-label">Road :</span><span
                                        class="info-value">{{ $property->flat_road }}</span></div>
                            @endif
                            @if($hasText($property->flat_house_no))
                                <div class="info-row"><span class="info-label">House No :</span><span
                                        class="info-value">{{ $property->flat_house_no }}</span></div>
                            @endif
                            @if($hasAmount($property->flat_price))
                                <div class="info-row"><span class="info-label">Flat Price :</span><span
                                        class="info-value">{{ $formatCurrency($property->flat_price) }}</span></div>
                            @endif
                            @if($hasText($property->flat_ownership_status))
                                <div class="info-row"><span class="info-label">Owner Information :</span><span
                                        class="info-value">{{ $property->flat_ownership_status }}</span></div>
                            @endif
                            @if(!empty($flatLocationParts))
                                <div class="info-row"><span class="info-label">Location :</span><span
                                        class="info-value">{{ implode(', ', $flatLocationParts) }}</span></div>
                            @endif
                        </div>
                    @endif

                    @if($property->gold)
                        <div class="property-card">
                            <h5 class="property-card-title">Gold Information</h5>
                            @if($hasText($property->gold_type))
                                <div class="info-row"><span class="info-label">Gold Type :</span><span
                                        class="info-value">{{ $property->gold_type }}</span></div>
                            @endif
                            @if($hasText($property->gold_quantity))
                                <div class="info-row"><span class="info-label">Quantity :</span><span
                                        class="info-value">{{ $property->gold_quantity }}</span></div>
                            @endif
                            @if($hasAmount($property->gold_price))
                                <div class="info-row"><span class="info-label">Price :</span><span
                                        class="info-value">{{ $formatCurrency($property->gold_price) }}</span></div>
                            @endif
                            @if($hasText($property->gold_ownership_status))
                                <div class="info-row"><span class="info-label">Owner Information :</span><span
                                        class="info-value">{{ $property->gold_ownership_status }}</span></div>
                            @endif
                        </div>
                    @endif

                    @if($property->diamond)
                        <div class="property-card">
                            <h5 class="property-card-title">Diamond Information</h5>
                            @if($hasText($property->diamond_type))
                                <div class="info-row"><span class="info-label">Diamond Type :</span><span
                                        class="info-value">{{ $property->diamond_type }}</span></div>
                            @endif
                            @if($hasText($property->diamond_quantity))
                                <div class="info-row"><span class="info-label">Quantity :</span><span
                                        class="info-value">{{ $property->diamond_quantity }}</span></div>
                            @endif
                            @if($hasAmount($property->diamond_price))
                                <div class="info-row"><span class="info-label">Price :</span><span
                                        class="info-value">{{ $formatCurrency($property->diamond_price) }}</span></div>
                            @endif
                            @if($hasText($property->diamond_ownership_status))
                                <div class="info-row"><span class="info-label">Owner Information :</span><span
                                        class="info-value">{{ $property->diamond_ownership_status }}</span></div>
                            @endif
                        </div>
                    @endif

                    @if($property->silver)
                        <div class="property-card">
                            <h5 class="property-card-title">Silver Information</h5>
                            @if($hasText($property->silver_type))
                                <div class="info-row"><span class="info-label">Silver Type :</span><span
                                        class="info-value">{{ $property->silver_type }}</span></div>
                            @endif
                            @if($hasText($property->silver_quantity))
                                <div class="info-row"><span class="info-label">Quantity :</span><span
                                        class="info-value">{{ $property->silver_quantity }}</span></div>
                            @endif
                            @if($hasAmount($property->silver_price))
                                <div class="info-row"><span class="info-label">Price :</span><span
                                        class="info-value">{{ $formatCurrency($property->silver_price) }}</span></div>
                            @endif
                            @if($hasText($property->silver_ownership_status))
                                <div class="info-row"><span class="info-label">Owner Information :</span><span
                                        class="info-value">{{ $property->silver_ownership_status }}</span></div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif

            {{-- Disability & Freedom Fighter (if any) --}}
            @if(isset($user->disabilityInfo) && ($user->disabilityInfo->is_disability ?? false))
                <div class="section-header">প্রতিবন্ধিতা তথ্য / Disability Information</div>
                <div class="info-row"><span class="info-label">Disability :</span><span
                        class="info-value">{{ disability_constant_option('disability_name')[$user->disabilityInfo->disability_name_id ?? ''] ?? '' }}
                        ({{ disability_constant_option('disability_category')[$user->disabilityInfo->disability_category_id ?? ''] ?? '' }})</span>
                </div>
                <div class="info-row"><span class="info-label">Type :</span><span
                        class="info-value">{{ disability_constant_option('disability_type')[$user->disabilityInfo->disability_type_id ?? ''] ?? '' }}</span>
                </div>
                <div class="info-row"><span class="info-label">Treatment :</span><span
                        class="info-value">{{ disability_constant_option('treatment_status')[$user->disabilityInfo->treatment_status_id ?? ''] ?? '' }}</span>
                </div>
                @if(!empty($user->disabilityInfo->disability_doctor))
                    <div class="info-row"><span class="info-label">Doctor :</span><span
                            class="info-value">{{ $user->disabilityInfo->disability_doctor }}</span></div>
                @endif
            @endif

            @if(isset($user->freedomFighterInfo) && ($user->freedomFighterInfo->is_freedom_fighter ?? false))
                <div class="section-header">মুক্তিযোদ্ধা তথ্য / Freedom Fighter Information</div>
                <div class="info-row"><span class="info-label">Type :</span><span
                        class="info-value">{{ freedom_fighter_constant_option('type')[$user->freedomFighterInfo->type_id ?? ''] ?? '' }}</span>
                </div>
                <div class="info-row"><span class="info-label">Area :</span><span
                        class="info-value">{{ freedom_fighter_constant_option('area')[$user->freedomFighterInfo->area_id ?? ''] ?? '' }}</span>
                </div>
                <div class="info-row"><span class="info-label">Designation :</span><span
                        class="info-value">{{ freedom_fighter_constant_option('designation')[$user->freedomFighterInfo->designation_id ?? ''] ?? '' }}</span>
                </div>
                <div class="info-row"><span class="info-label">FF ID :</span><span
                        class="info-value">{{ $user->freedomFighterInfo->freedom_fighter_id ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Commander :</span><span
                        class="info-value">{{ $user->freedomFighterInfo->commander_name ?? '' }}</span></div>
            @endif

            @if(isset($user->freedomFighterInfo) && ($user->freedomFighterInfo->is_july_fighter ?? false))
                <div class="section-header">জুলাই যোদ্ধা তথ্য / July Fighter Information</div>
                <div class="info-row"><span class="info-label">Type :</span><span
                        class="info-value">{{ freedom_fighter_constant_option('type')[$user->freedomFighterInfo->july_type_id ?? ''] ?? '' }}</span>
                </div>
                <div class="info-row"><span class="info-label">July Fighter ID :</span><span
                        class="info-value">{{ $user->freedomFighterInfo->july_fighter_id ?? '' }}</span></div>
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
        </div>
    </div>

    {{-- Print Buttons --}}
    <div class="no-print text-center my-4">


        <button class="btn btn-success px-5 py-2 btn-print-custom" onclick="window.print()"><i class="fa fa-print"></i>
            Print / প্রিন্ট</button>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary px-5 py-2 ms-3"><i class="fa fa-arrow-left"></i> Back
            to List</a>

        @if(empty($people->approved_id))

            <a href="{{ route('staff.approve', $people->user_id) }}" class="btn btn-primary px-5 py-2 ms-3"
                onclick="return confirm('আপনি কি নিশ্চিত অনুমোদন করতে চান?')">
                <i class="fa fa-check"></i> Approve
            </a>

        @endif

    </div>
@endsection

@push('script')

    <script>
        function approvePeople(id) {

            if (!confirm("আপনি কি নিশ্চিত অনুমোদন করতে চান?")) return;

            let url = "{{ route('staff.approve', ':id') }}";
            url = url.replace(':id', id);

            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    if (data.status) {
                        alert(data.message);
                        window.location.href = "{{ route('staff.index') }}";
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Something went wrong!");
                });
        }
    </script>
    <script>


        window.onload = function () {
            // any print handling if needed
        }
    </script>
@endpush