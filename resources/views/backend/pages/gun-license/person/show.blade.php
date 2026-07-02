@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'PersonGunLicense'])

@section('title', 'View Person Gun License Application')

@push('style')
    <style>
        .details-table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #cbd5e1;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .details-table th, .details-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            vertical-align: middle;
        }

        .details-table th {
            width: 32%;
            background-color: #f8fafc;
            color: #334155;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.03em;
        }

        .details-table td {
            color: #1e293b;
            font-size: 0.95rem;
            background-color: #ffffff;
        }

        .section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f766e;
            border-left: 4px solid #0f766e;
            background-color: #f0fdfa;
            padding: 8px 12px;
            margin-top: 25px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 4px;
        }

        .section-title i {
            color: #0d9488;
        }

        @media print {
            .details-table {
                border: 1px solid #000 !important;
                box-shadow: none !important;
            }
            .details-table th, .details-table td {
                border: 1px solid #000 !important;
                padding: 8px 10px !important;
                color: #000 !important;
            }
            .details-table th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .section-title {
                color: #000 !important;
                background-color: transparent !important;
                border-left: none !important;
                border-bottom: 2px solid #000 !important;
                padding: 4px 0 !important;
                margin-top: 15px !important;
            }
            .section-title i {
                display: none !important;
            }
            .badge {
                border: 1px solid #000 !important;
                color: #000 !important;
                background: transparent !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application Details</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('gun-license.index') }}" class="btn btn-default"><i
                            class="fas fa-arrow-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <x-print-view title="ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্স">
                <div class="card shadow-none border-0" style="background: transparent;">
                    <div class="card-header no-print">
                        <h3 class="card-title">Tracking ID: {{ $application->tracking_no }}</h3>
                        <div class="card-tools">
                            <span class="badge p-2" style="font-size: 14px;">Status:
                                <strong>{{ $application->status }}</strong></span>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- 1. Application details -->
                        <h5 class="section-title"><i class="fas fa-user"></i> ব্যক্তিগত বিবরণ</h5>
                        <table class="table table-bordered details-table mb-4">
                            <tr>
                                <th>জেলা ম্যাজিস্ট্রেট</th>
                                <td>{{ $application->district_magistrate ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>আবেদনের শ্রেণী</th>
                                <td>{{ $application->application_class ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>আবেদনকারীর নাম বাংলায়</th>
                                <td><strong>{{ $application->applicant_name }}</strong></td>
                            </tr>
                            <tr>
                                <th>আবেদনকারীর নাম ইংরেজীতে</th>
                                <td><strong>{{ $application->applicant_name_en ?? 'N/A' }}</strong></td>
                            </tr>
                            <tr>
                                <th>জাতীয় পরিচিতি নম্বর</th>
                                <td>{{ $application->nid_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>মোবাইল নম্বর ও ইমেইল</th>
                                <td>{{ $application->phone ?? 'N/A' }}
                                    {{ $application->email ? ' | ' . $application->email : '' }}</td>
                            </tr>
                            <tr>
                                <th>জন্ম তারিখ ও বয়স</th>
                                <td>
                                    {{ $application->dob ? \Carbon\Carbon::parse($application->dob)->format('d/m/Y') : 'N/A' }}
                                    (বয়স: {{ $application->age_at_application ?? 'N/A' }} বছর)
                                </td>
                            </tr>
                            <tr>
                                <th>জাতীয়তা ও ধর্ম</th>
                                <td>{{ $application->nationality ?? 'N/A' }} | {{ $application->religion ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>লিঙ্গ</th>
                                <td>{{ $application->gender ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>পিতার নাম ও পেশা</th>
                                <td>{{ $application->father_name ?? 'N/A' }} (পেশা:
                                    {{ $application->father_profession ?? 'N/A' }})</td>
                            </tr>
                            <tr>
                                <th>মাতার নাম ও পেশা</th>
                                <td>{{ $application->mother_name ?? 'N/A' }} (পেশা:
                                    {{ $application->mother_profession ?? 'N/A' }})</td>
                            </tr>
                            <tr>
                                <th>বৈবাহিক অবস্থা</th>
                                <td>{{ $application->marital_status ?? 'N/A' }}</td>
                            </tr>
                            @if($application->marital_status === 'বিবাহিত')
                                <tr>
                                    <th>স্বামী/স্ত্রীর নাম ও পেশা</th>
                                    <td>{{ $application->spouse_name ?? 'N/A' }} (পেশা:
                                        {{ $application->spouse_profession ?? 'N/A' }})</td>
                                </tr>
                            @endif
                            <tr>
                                <th>শিক্ষাগত যোগ্যতা</th>
                                <td>{{ $application->education_qualification ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>বর্তমান ঠিকানা</th>
                                <td>{{ $application->present_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>স্থায়ী ঠিকানা</th>
                                <td>{{ $application->permanent_address ?? 'N/A' }}</td>
                            </tr>
                        </table>

                        <!-- 1b. Professional & Tax details -->
                        <h5 class="section-title"><i class="fas fa-briefcase"></i> পেশা ও আয়কর বিবরণ</h5>
                        <table class="table table-bordered details-table mb-4">
                            <tr>
                                <th>পেশার বিবরণ</th>
                                <td>{{ $application->profession_details ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>প্রতিষ্ঠানের ঠিকানা</th>
                                <td>{{ $application->profession_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>বার্ষিক আয় ও উৎস</th>
                                <td>{{ $application->annual_income ?? 'N/A' }} (উৎস:
                                    {{ $application->income_source ?? 'N/A' }})</td>
                            </tr>
                            <tr>
                                <th>টিআইএন নম্বর</th>
                                <td>{{ $application->tin_no ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>আয়করের বিবরণ</th>
                                <td>{{ $application->tax_history_details ?? 'N/A' }}</td>
                            </tr>
                        </table>

                        <!-- 1c. Government Employee Info -->
                        @if($application->is_govt_employee)
                            <h5 class="section-title"><i class="fas fa-user-tie"></i> সরকারি চাকরিজীবীদের তথ্য</h5>
                            <table class="table table-bordered details-table mb-4">
                                <tr>
                                    <th>ক্যাডার/সার্ভিস</th>
                                    <td>{{ $application->cadre_service_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>পদবী</th>
                                    <td>{{ $application->designation ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>বেতন গ্রেড ও মূলবেতন</th>
                                    <td>{{ $application->pay_grade_salary ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>বর্তমান কর্মস্থলের ঠিকানা</th>
                                    <td>{{ $application->workplace_address ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        @endif

                        <!-- 1d. Previous Weapon details -->
                        <h5 class="section-title"><i class="fas fa-history"></i> পূর্ববর্তী অস্ত্রের বিবরণ</h5>
                        <table class="table table-bordered details-table mb-4">
                            <tr>
                                <th>শুল্কমুক্ত সুবিধা</th>
                                <td>{{ $application->duty_free_import ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>ইতঃপূর্বে লাইসেন্স বাতিল করা হয়েছে কি?</th>
                                <td>
                                    @if($application->license_cancelled_before)
                                        <span class="badge badge-danger">হ্যাঁ</span>
                                    @else
                                        <span class="badge badge-success">না</span>
                                    @endif
                                </td>
                            </tr>
                            @if($application->license_cancelled_before)
                                <tr>
                                    <th>বাতিলকৃত অস্ত্রের ধরণ</th>
                                    <td>{{ $application->cancelled_weapon_type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>বাতিলের কারণ</th>
                                    <td>{{ $application->cancellation_reason ?? 'N/A' }}</td>
                                </tr>
                            @endif
                        </table>

                        <!-- 1e. Weapon Requirements & Declarations -->
                        <h5 class="section-title"><i class="fas fa-crosshairs"></i> চাহিত অস্ত্র ও হলফনামা</h5>
                        <table class="table table-bordered details-table mb-4">
                            <tr>
                                <th>চাহিত আগ্নেয়াস্ত্রের ধরণ</th>
                                <td><span class="badge badge-dark p-2">{{ $application->weapon_details }}</span></td>
                            </tr>
                            <tr>
                                <th>আগ্নেয়াস্ত্র সংখ্যা</th>
                                <td>{{ $application->weapon_count ?? 1 }} টি</td>
                            </tr>
                            <tr>
                                <th>প্রয়োজনের কারণ</th>
                                <td>{{ $application->necessity_reason ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>হলফনামা সংযুক্ত?</th>
                                <td>
                                    @if($application->affidavit_attached)
                                        <span class="badge badge-success">হ্যাঁ (সংযুক্ত করা হয়েছে)</span>
                                    @else
                                        <span class="badge badge-warning">না</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>না-দাবীনামা সংযুক্ত?</th>
                                <td>
                                    @if($application->heir_deed_attached)
                                        <span class="badge badge-success">হ্যাঁ (সংযুক্ত করা হয়েছে)</span>
                                    @else
                                        <span class="badge badge-warning">না / প্রযোজ্য নয়</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- 2. Police Verification Details -->
                        <h5 class="section-title"><i class="fas fa-shield-alt"></i> পুলিশ ভেরিফিকেশন প্রতিবেদন</h5>
                        @if($application->verification)
                            <table class="table table-bordered details-table">
                                <tr>
                                    <th>ফৌজদারি রেকর্ড আছে কি?</th>
                                    <td>
                                        @if($application->verification->has_criminal_record)
                                            <span class="badge badge-danger">হ্যাঁ</span> (মামলার বিবরণ:
                                            {{ $application->verification->criminal_case_details ?? 'N/A' }})
                                        @else
                                            <span class="badge badge-success">না</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>সামাজিক শৃঙ্খলা সংক্রান্ত কোনো বিষয়?</th>
                                    <td>{{ $application->verification->social_discipline_issue ? 'হ্যাঁ (প্রতিকূল)' : 'না (সন্তোষজনক)' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>অস্ত্র চালনার বাস্তব জ্ঞান</th>
                                    <td>{{ $application->verification->practical_knowledge ? 'আছে' : 'নেই' }}</td>
                                </tr>
                                <tr>
                                    <th>জীবন নাশের আশঙ্কার যৌক্তিকতা</th>
                                    <td>{{ $application->verification->life_threat_justification }}</td>
                                </tr>
                                <tr>
                                    <th>সনদপত্র যাচাইয়ের অবস্থা</th>
                                    <td>{{ $application->verification->certificate_verification_status ? 'যাচাইকৃত / সঠিক' : 'অযাচাইকৃত' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>প্রতিকূল তথ্য (যদি থাকে)</th>
                                    <td>{{ $application->verification->adverse_info ?? 'নেই' }}</td>
                                </tr>
                                <tr>
                                    <th>ওসি (OC) এর মন্তব্য</th>
                                    <td>{{ $application->verification->oc_comments ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>এসপি (SP) / ডিএসবি (DSB) এর মন্তব্য</th>
                                    <td>{{ $application->verification->sp_dsb_comments ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> পুলিশ ভেরিফিকেশন (পরিশिष्ट-৪) এখনও সম্পন্ন করা হয়নি।
                            </div>
                        @endif

                        <!-- 3. Magistrate Interview Details -->
                        <h5 class="section-title"><i class="fas fa-microphone"></i> ম্যাজিস্ট্রেট ইন্টারভিউ মূল্যায়ন</h5>
                        @if($application->interview)
                            <table class="table table-bordered details-table">
       
                                <tr>
                                    <th>শারীরিক ও মানসিক সুস্থতা</th>
                                    <td>{{ $application->interview->physical_mental_fitness ? 'উপযুক্ত' : 'অনুপযুক্ত' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>অস্ত্র ব্যবহারের জ্ঞান</th>
                                    <td>{{ $application->interview->weapon_handling_knowledge ? 'সন্তোষজনক' : 'অসন্তোষজনক' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>অস্ত্র আইন সংক্রান্ত জ্ঞান</th>
                                    <td>{{ $application->interview->gun_law_knowledge ? 'সন্তোষজনক' : 'অসন্তোষজনক' }}</td>
                                </tr>
                                <tr>
                                    <th>নিরাপদ হেফাজতে রাখার সামর্থ্য</th>
                                    <td>{{ $application->interview->safe_custody_capability ? 'আছে' : 'নেই' }}</td>
                                </tr>
                                <tr>
                                    <th>নিরাপত্তা ও প্রয়োজনের যৌক্তিকতা</th>
                                    <td>{{ $application->interview->safety_necessity_justification ? 'যৌক্তিক' : 'অযৌক্তিক' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>আচরণগত মূল্যায়ন</th>
                                    <td>{{ $application->interview->behavior_satisfactory ? 'সন্তোষজনক' : 'অসন্তোষজনক' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>পুলিশ প্রতিবেদনের সারসংক্ষেপ</th>
                                    <td>{{ $application->interview->police_report_comments ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>ম্যাজিস্ট্রেট / ডিসি (DC) এর চূড়ান্ত সুপারিশ</th>
                                    <td><strong>{{ $application->interview->magistrate_final_comments ?? 'N/A' }}</strong></td>
                                </tr>
                            </table>


                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> ম্যাজিস্ট্রেট ইন্টারভিউ (পরিশिष्ट-৫) এখনও সম্পন্ন
                                করা হয়নি।
                            </div>
                        @endif

                </div>
            </x-print-view>
            
            <div class="text-center mt-4 mb-5 no-print">
                <div class="d-inline-flex justify-content-center align-items-center" style="gap: 15px;">
                    <a href="{{ route('gun-license.index') }}" class="btn btn-dark" style="border-radius: 6px; font-weight: 600; padding: 10px 20px;">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    
                    <button type="button" class="btn btn-secondary" onclick="window.print();" style="border-radius: 6px; font-weight: 600; padding: 10px 20px;">
                        <i class="fas fa-print"></i> Printout
                    </button>

                    @if(in_array($application->status, ['Submitted', 'Verified', 'Interviewed']))
                        <div style="width: 2px; height: 30px; background-color: #cbd5e1;"></div>
                        
                        <form action="{{ route('gun-license.person.approve', $application->id) }}" method="POST"
                            onsubmit="event.preventDefault(); Swal.fire({title: 'আবেদন অনুমোদন?', text: 'আপনি কি এই আবেদনটি অনুমোদন করতে চান?', icon: 'question', showCancelButton: true, confirmButtonColor: '#0f766e', cancelButtonColor: '#475569', confirmButtonText: 'হ্যাঁ, অনুমোদন করুন!', cancelButtonText: 'বাতিল'}).then((result) => { if (result.isConfirmed) { this.submit(); } });" style="margin-bottom:0;">
                            @csrf
                            <button type="submit" class="btn btn-success" style="border-radius: 6px; font-weight: 600; background-color: #10b981; border-color: #10b981; padding: 10px 20px;">
                                <i class="fas fa-check-circle"></i> অনুমোদন
                            </button>
                        </form>
                        <form action="{{ route('gun-license.person.reject', $application->id) }}" method="POST"
                            onsubmit="event.preventDefault(); Swal.fire({title: 'আবেদন প্রত্যাখ্যান?', text: 'আপনি কি এই আবেদনটি প্রত্যাখ্যান করতে চান?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626', cancelButtonColor: '#475569', confirmButtonText: 'হ্যাঁ, প্রত্যাখ্যান করুন!', cancelButtonText: 'বাতিল'}).then((result) => { if (result.isConfirmed) { this.submit(); } });" style="margin-bottom:0;">
                            @csrf
                            <button type="submit" class="btn btn-danger" style="border-radius: 6px; font-weight: 600; background-color: #ef4444; border-color: #ef4444; padding: 10px 20px;">
                                <i class="fas fa-times-circle"></i> প্রত্যাখ্যান
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection