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
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Organization Application Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.org.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Back to List</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Tracking ID: {{ $application->tracking_no }}</h3>
                <div class="card-tools">
                    <span class="badge badge-light p-2" style="font-size: 14px;">Status: <strong>{{ $application->status }}</strong></span>
                </div>
            </div>
            <div class="card-body">
                
                <!-- 1. Org details -->
                <h5 class="section-title"><i class="fas fa-university"></i> Organization Details</h5>
                <table class="table table-bordered details-table">
                    <tr>
                        <th>Organization Name</th>
                        <td><strong>{{ $application->org_name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Operation Start Date</th>
                        <td>{{ $application->operation_start_date ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Vault Limit</th>
                        <td>{{ $application->vault_limit ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Cash-Carrying Vehicle Count</th>
                        <td>{{ $application->vehicle_count }} vehicles</td>
                    </tr>
                    <tr>
                        <th>Bangladesh Bank Permission Status</th>
                        <td>{{ $application->bangladesh_bank_permission ? 'Yes (Granted)' : 'No / Pending' }}</td>
                    </tr>
                    <tr>
                        <th>Owner / CEO Details</th>
                        <td>{{ $application->owner_or_ceo_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Organogram & Manpower Details</th>
                        <td>{{ $application->organogram_manpower_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tax Details</th>
                        <td>{{ $application->tax_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Current Security Description</th>
                        <td>{{ $application->current_security_description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Rental Agreement Details</th>
                        <td>{{ $application->rental_agreement_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Weapon Count & Nature Requested</th>
                        <td><span class="badge badge-dark p-2">{{ $application->weapon_count_requested }}x {{ $application->weapon_nature_requested }}</span></td>
                    </tr>
                    <tr>
                        <th>Justification of Necessity</th>
                        <td>{{ $application->justification_of_necessity ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Existing Weapons Details</th>
                        <td>{{ $application->existing_weapons_details ?? 'None' }}</td>
                    </tr>
                </table>

                <!-- 2. Guard Details -->
                <h5 class="section-title"><i class="fas fa-user-shield"></i> Designated Guard Details</h5>
                @if($application->guardDetails->count() > 0)
                    @foreach($application->guardDetails as $guard)
                    <table class="table table-bordered details-table mb-4">
                        <tr>
                            <th>Guard Name</th>
                            <td>{{ $guard->guard_name }}</td>
                        </tr>
                        <tr>
                            <th>Father's / Mother's Name</th>
                            <td>Father: {{ $guard->father_name ?? 'N/A' }} | Mother: {{ $guard->mother_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Present Address</th>
                            <td>{{ $guard->present_address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Permanent Address</th>
                            <td>{{ $guard->permanent_address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Age & Education</th>
                            <td>{{ $guard->age ?? 'N/A' }} years old (Education: {{ $guard->education ?? 'N/A' }})</td>
                        </tr>
                        <tr>
                            <th>National ID (NID)</th>
                            <td>{{ $guard->nid_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Trained / Certified Status</th>
                            <td>
                                @if($guard->training_certificate_status)
                                    <span class="badge badge-success">Trained & Certified</span>
                                @else
                                    <span class="badge badge-warning">Untrained</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    @endforeach
                @else
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> Warning: No guard detail has been associated with this application.
                </div>
                @endif

                <!-- 3. Police Verification Details -->
                <h5 class="section-title"><i class="fas fa-shield-alt"></i> Appendix-7 Police Verification Findings</h5>
                @if($application->verification)
                <table class="table table-bordered details-table">
                    <tr>
                        <th>Weapon Necessity Approved?</th>
                        <td>{{ $application->verification->weapon_necessity_approved ? 'Yes (অনুমোদিত)' : 'No (অননুমোদিত)' }}</td>
                    </tr>
                    <tr>
                        <th>Existing Weapons Verified Comments</th>
                        <td>{{ $application->verification->existing_weapons_verified ?? 'None' }}</td>
                    </tr>
                    <tr>
                        <th>Vault Limit Verified?</th>
                        <td>{{ $application->verification->vault_limit_verified ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Guard Has Criminal Record?</th>
                        <td>
                            @if($application->verification->guard_has_criminal_record)
                                <span class="badge badge-danger">Yes</span> (Case details: {{ $application->verification->guard_case_details ?? 'N/A' }})
                            @else
                                <span class="badge badge-success">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Guard Social Discipline Issues?</th>
                        <td>{{ $application->verification->guard_social_discipline_issue ? 'Yes (Adverse)' : 'No (Satisfactory)' }}</td>
                    </tr>
                    <tr>
                        <th>Guard Practical Knowledge of Weapons?</th>
                        <td>{{ $application->verification->guard_practical_knowledge ? 'Yes (আছে)' : 'No (নেই)' }}</td>
                    </tr>
                    <tr>
                        <th>Guard Already Holds other Arms License?</th>
                        <td>{{ $application->verification->guard_existing_license ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th>Documents Verification Status</th>
                        <td>{{ $application->verification->certificate_verification_status ? 'Verified / Correct' : 'Unverified' }}</td>
                    </tr>
                    <tr>
                        <th>Adverse Information (If any)</th>
                        <td>{{ $application->verification->adverse_info ?? 'None' }}</td>
                    </tr>
                    <tr>
                        <th>OC Comments</th>
                        <td>{{ $application->verification->oc_comments ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>SP / DSB Comments</th>
                        <td>{{ $application->verification->sp_dsb_comments ?? 'N/A' }}</td>
                    </tr>
                </table>
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Police Verification (Appendix-7) has not been filled out yet.
                </div>
                @endif

                <!-- 4. Magistrate Interview Details -->
                <h5 class="section-title"><i class="fas fa-microphone"></i> Appendix-8 Magistrate Guard Interview Assessment</h5>
                @if($application->interviews->count() > 0)
                    @foreach($application->interviews as $interview)
                    <table class="table table-bordered details-table">
                        <tr>
                            <th>Designated Guard Interviewed</th>
                            <td>{{ optional($interview->guardDetail)->guard_name }}</td>
                        </tr>
                        <tr>
                            <th>Guard Physical & Mental Capability</th>
                            <td>{{ $interview->guard_physical_mental_capability ? 'Fit (উপযুক্ত)' : 'Unfit (অনুপযুক্ত)' }}</td>
                        </tr>
                        <tr>
                            <th>Guard Weapon Knowledge</th>
                            <td>{{ $interview->guard_weapon_knowledge ? 'Satisfactory' : 'Unsatisfactory' }}</td>
                        </tr>
                        <tr>
                            <th>Guard General Behavior / Reputation</th>
                            <td>{{ $interview->guard_behavior_satisfactory ? 'Satisfactory' : 'Unsatisfactory' }}</td>
                        </tr>
                        <tr>
                            <th>Safe Custody Capability</th>
                            <td>{{ $interview->safe_custody_capability ? 'Yes (আছে)' : 'No (নেই)' }}</td>
                        </tr>
                        <tr>
                            <th>Summary of Police Report Comments</th>
                            <td>{{ $interview->police_report_comments ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Magistrate / DC Final Recommendation</th>
                            <td><strong>{{ $interview->magistrate_final_comments ?? 'N/A' }}</strong></td>
                        </tr>
                    </table>
                    @endforeach
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Guard Interview Assessment (Appendix-8) has not been filled out yet.
                </div>
                @endif

            </div>
            <div class="card-footer text-right">
                @if(in_array($application->status, ['Submitted', 'Verified', 'Interviewed']))
                    <div class="d-inline-flex" style="gap: 10px;">
                        <form action="{{ route('gun-license.org.approve', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this application?');">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Approve Application</button>
                        </form>
                        <form action="{{ route('gun-license.org.reject', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this application?');">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle"></i> Reject Application</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
