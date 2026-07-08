@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'OrgGunLicense'])

@section('title', 'View Organization Gun License Application')

@push('style')
    <style>
        .details-table th {
            width: 30%;
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        .details-table td {
            color: #1e293b;
            font-size: 0.95rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-top: 30px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #2563eb;
        }
    </style>
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Tracking ID:** {{ $application->tracking_no }}</h3>
                    <div class="card-tools">
                        <span class="badge p-2" style="font-size: 14px;">Status:
                            <strong>{{ $application->status }}</strong></span>
                    </div>
                </div>
                <div class="card-body">

                    <!-- 1. Org details -->
                    <h5 class="section-title"><i class="fas fa-university"></i> প্রতিষ্ঠানের বিবরণ</h5>
                    <table class="table table-bordered details-table">
                        <tr>
                            <th>প্রতিষ্ঠানের নাম</th>
                            <td><strong>{{ $application->org_name }}</strong></td>
                        </tr>
                        <tr>
                            <th>মোবাইল নম্বর</th>
                            <td>{{ $application->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>ইমেইল</th>
                            <td>{{ $application->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>কার্যক্রম শুরু করার তারিখ</th>
                            <td>{{ $application->operation_start_date ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>সিন্দুক সীমা</th>
                            <td>
                                @if($application->vault_limit == 'up_to_1_crore')
                                    সর্বোচ্চ ১ কোটি টাকা
                                @elseif($application->vault_limit == '1_to_5_crore')
                                    ১ কোটি টাকার উর্ধ্বে কিন্তু ৫ কোটি টাকার নিম্মে
                                @elseif($application->vault_limit == 'above_5_crore')
                                    ৫ কোটি টাকার উর্ধ্বে
                                @else
                                    {{ $application->vault_limit ?? 'N/A' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>অর্থ পরিবহনের গাড়ীর সংখ্যা</th>
                            <td>{{ $application->vehicle_count }} টি</td>
                        </tr>
                        <tr>
                            <th>বাংলাদেশ ব্যাংকের অনুমতি পত্র</th>
                            <td>{{ $application->bangladesh_bank_permission ? 'হ্যাঁ' : 'না' }}</td>
                        </tr>
                        <tr>
                            <th>মালিক/নির্বাহী প্রধানের বিবরণ</th>
                            <td>{{ $application->owner_or_ceo_details ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>জনবল/অর্গানোগ্রাম</th>
                            <td>{{ $application->organogram_manpower_details ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>আয়কর সংক্রান্ত তথ্যাদি</th>
                            <td>{{ $application->tax_details ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>বর্তমান নিরাপত্তা ব্যবস্থার বিবরণ</th>
                            <td>{{ $application->current_security_description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>বাড়ি ভাড়ার চুক্তি পত্রের বিবরণ</th>
                            <td>
                                @if($application->rental_agreement_details)
                                    @if(filter_var($application->rental_agreement_details, FILTER_VALIDATE_URL) || \Illuminate\Support\Str::startsWith($application->rental_agreement_details, 'uploads/'))
                                        <a href="{{ asset($application->rental_agreement_details) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-pdf"></i> ফাইলটি দেখুন
                                        </a>
                                    @else
                                        {{ $application->rental_agreement_details }}
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>প্রার্থীত আগ্নেয়াস্ত্রের সংখ্যা ও প্রকৃতি</th>
                            <td><span class="badge badge-dark p-2">{{ $application->weapon_count_requested }}x
                                    {{ $application->weapon_nature_requested }}</span></td>
                        </tr>
                        <tr>
                            <th>আগ্নেয়াস্ত্রের প্রয়োজনীয়তার যৌক্তিকতা</th>
                            <td>{{ $application->justification_of_necessity ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>পূর্বে নেওয়া আগ্নেয়াস্ত্রের বিবরণ</th>
                            <td>{{ $application->existing_weapons_details ?? 'None' }}</td>
                        </tr>
                    </table>

                    <!-- 2. Guard Details -->
                    <h5 class="section-title"><i class="fas fa-user-shield"></i> গার্ডের বিবরণ</h5>
                    @if($application->guardDetails->count() > 0)
                        @foreach($application->guardDetails as $index => $guard)
                            <h6 class="font-weight-bold text-secondary mt-3 mb-2"><i class="fas fa-user"></i> গার্ড #{{ $index + 1 }}</h6>
                            <table class="table table-bordered details-table mb-4">
                                <tr>
                                    <th>গার্ডের নাম</th>
                                    <td>{{ $guard->guard_name }}</td>
                                </tr>
                                <tr>
                                    <th>পিতা/মাতার নাম</th>
                                    <td>পিতা: {{ $guard->father_name ?? 'N/A' }} | মাতা: {{ $guard->mother_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>বর্তমান ঠিকানা</th>
                                    <td>{{ $guard->present_address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>স্থায়ী ঠিকানা</th>
                                    <td>{{ $guard->permanent_address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>বয়স ও শিক্ষাগত যোগ্যতা</th>
                                    <td>{{ $guard->age ?? 'N/A' }} বছর (শিক্ষাগত যোগ্যতা: {{ $guard->education ?? 'N/A' }})</td>
                                </tr>
                                <tr>
                                    <th>জাতীয় পরিচিতি নম্বর</th>
                                    <td>{{ $guard->nid_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>প্রশিক্ষণপ্রাপ্ত কিনা</th>
                                    <td>
                                        @if($guard->training_certificate_status)
                                            <span class="badge badge-success">প্রশিক্ষিত</span>
                                        @else
                                            <span class="badge badge-warning">অপ্রশিক্ষিত</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> Warning: No guard detail has been associated with this
                            application.
                        </div>
                    @endif

                    <!-- 3. Police Verification Details -->
                    <h5 class="section-title"><i class="fas fa-shield-alt"></i> পুলিশ ভেরিফিকেশন (পরিশিষ্ট-৭)</h5>
                    @if($application->verification)
                        <table class="table table-bordered details-table">
                            <tr>
                                <th>অস্ত্রের আবশ্যকতা আছে কিনা</th>
                                <td>
                                    @if($application->verification->weapon_necessity_approved)
                                        হ্যাঁ (যুক্তিসঙ্গত)
                                    @else
                                        না (অযুক্তিসঙ্গত)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>প্রতিষ্ঠানের নামে পূর্বের কোন আগ্নেয়াস্ত্র আছে কিনা</th>
                                <td>{{ $application->verification->existing_weapons_verified ?? 'None' }}</td>
                            </tr>
                            <tr>
                                <th>সিন্দুক সীমা সঠিক কিনা</th>
                                <td>{{ $application->verification->vault_limit_verified ? 'সঠিক' : 'সঠিক নয়' }}</td>
                            </tr>
                            <tr>
                                <th>কোন মামলার চার্জশীটভুক্ত আসামী কিনা</th>
                                <td>
                                    @if($application->verification->guard_has_criminal_record)
                                        <span class="badge badge-danger">হ্যাঁ</span> (মামলার বিবরণ:
                                        {{ $application->verification->guard_case_details ?? 'N/A' }})
                                    @else
                                        <span class="badge badge-success">না</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>সামাজিক শান্তি-শৃঙ্খলা ভঙ্গের অভিযোগ</th>
                                <td>{{ $application->verification->guard_social_discipline_issue ? 'হ্যাঁ' : 'না' }}
                                </td>
                            </tr>
                            <tr>
                                <th>অস্ত্র পরিচালনা ও রক্ষণাবেক্ষণের ব্যবহারিক জ্ঞান</th>
                                <td>
                                    @if($application->verification->guard_practical_knowledge)
                                        হ্যাঁ (আছে)
                                    @else
                                        না (নেই)
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>গার্ডের নামে অন্য লাইসেন্স আছে কিনা</th>
                                <td>{{ $application->verification->guard_existing_license ? 'হ্যাঁ' : 'না' }}</td>
                            </tr>
                            <tr>
                                <th>সার্টিফিকেট সঠিক আছে কিনা</th>
                                <td>{{ $application->verification->certificate_verification_status ? 'সঠিক' : 'সঠিক নয়' }}
                                </td>
                            </tr>
                            <tr>
                                <th>বিবিধ (বিরূপ তথ্য)</th>
                                <td>{{ $application->verification->adverse_info ?? 'None' }}</td>
                            </tr>
                            <tr>
                                <th>অফিসার ইনচার্জ এর সার্বিক মন্তব্য</th>
                                <td>{{ $application->verification->oc_comments ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>পুলিশ সুপার, জেলা বিশেষ শাখা এর মন্তব্য</th>
                                <td>{{ $application->verification->sp_dsb_comments ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Police Verification (Appendix-7) has not been filled out
                            yet.
                        </div>
                    @endif

                    <!-- 4. Magistrate Interview Details -->
                    <h5 class="section-title"><i class="fas fa-microphone"></i> সাক্ষাৎকার গ্রহণ (পরিশিষ্ট-৫)</h5>
                    @if($application->interviews->count() > 0)
                        @foreach($application->interviews as $interview)
                            <table class="table table-bordered details-table">
                                <tr>
                                    <th>গার্ডের নাম</th>
                                    <td>{{ optional($interview->guardDetail)->guard_name }}</td>
                                </tr>
                                <tr>
                                    <th>শারীরিক ও মানসিক সক্ষমতা</th>
                                    <td>
                                        @if($interview->guard_physical_mental_capability)
                                            উপযুক্ত
                                        @else
                                            অনুপযুক্ত
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>অস্ত্র পরিচালনা জ্ঞান</th>
                                    <td>{{ $interview->guard_weapon_knowledge ? 'সন্তোষজনক' : 'অসন্তোষজনক' }}</td>
                                </tr>
                                <tr>
                                    <th>সামাজিক মর্যাদা/আচরণ</th>
                                    <td>{{ $interview->guard_behavior_satisfactory ? 'সন্তোষজনক' : 'অসন্তোষজনক' }}</td>
                                </tr>
                                <tr>
                                    <th>সেইফ কাস্টডি</th>
                                    <td>
                                        @if($interview->safe_custody_capability)
                                            হ্যাঁ (আছে)
                                        @else
                                            না (নেই)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>পুলিশ প্রতিবেদনের সারমর্ম</th>
                                    <td>{{ $interview->police_report_comments ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>কর্মকর্তার মন্তব্য/সুপারিশ</th>
                                    <td><strong>{{ $interview->magistrate_final_comments ?? 'N/A' }}</strong></td>
                                </tr>
                            </table>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Guard Interview Assessment (Appendix-8) has not been
                            filled out yet.
                        </div>
                    @endif

                </div>
                <div class="card-footer text-right">
                    @if(in_array($application->status, ['Submitted', 'Verified', 'Interviewed']))
                        <div class="d-inline-flex" style="gap: 10px;">
                            <form action="{{ route('gun-license.org.approve', $application->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to approve this application?');">
                                @csrf
                                <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> অনুমোদন</button>
                            </form>
                            <form action="{{ route('gun-license.org.reject', $application->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to reject this application?');">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle"></i> প্রত্যাখ্যান</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection