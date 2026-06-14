@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'PersonGunLicense'])

@section('title', 'View Person Gun License Application')

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
                <h1>Application Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.person.index') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Back to List</a>
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
                
                <!-- 1. Application details -->
                <h5 class="section-title"><i class="fas fa-user"></i> Personal Application Details</h5>
                <table class="table table-bordered details-table">
                    <tr>
                        <th>Applicant Name</th>
                        <td>{{ $application->applicant_name }}</td>
                    </tr>
                    <tr>
                        <th>Father's Name</th>
                        <td>{{ $application->father_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Mother's Name</th>
                        <td>{{ $application->mother_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Present Address</th>
                        <td>{{ $application->present_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td>{{ $application->permanent_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Profession Details</th>
                        <td>{{ $application->profession_details ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Weapon Requested (Nature/Type)</th>
                        <td><span class="badge badge-dark p-2">{{ $application->weapon_details }}</span></td>
                    </tr>
                    <tr>
                        <th>Annual Income & Source</th>
                        <td>{{ $application->annual_income ?? 'N/A' }} (Source: {{ $application->income_source ?? 'N/A' }})</td>
                    </tr>
                </table>

                <!-- 2. Police Verification Details -->
                <h5 class="section-title"><i class="fas fa-shield-alt"></i> Appendix-4 Police Verification Findings</h5>
                @if($application->verification)
                <table class="table table-bordered details-table">
                    <tr>
                        <th>Has Criminal Record?</th>
                        <td>
                            @if($application->verification->has_criminal_record)
                                <span class="badge badge-danger">Yes</span> (Case details: {{ $application->verification->criminal_case_details ?? 'N/A' }})
                            @else
                                <span class="badge badge-success">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Social Discipline Issue?</th>
                        <td>{{ $application->verification->social_discipline_issue ? 'Yes (Adverse)' : 'No (Satisfactory)' }}</td>
                    </tr>
                    <tr>
                        <th>Practical Weapon Knowledge</th>
                        <td>{{ $application->verification->practical_knowledge ? 'Yes (আছে)' : 'No (নেই)' }}</td>
                    </tr>
                    <tr>
                        <th>Life Threat Justification</th>
                        <td>{{ $application->verification->life_threat_justification }}</td>
                    </tr>
                    <tr>
                        <th>Certificate Verification Status</th>
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
                    <i class="fas fa-exclamation-triangle"></i> Police Verification (Appendix-4) has not been filled out yet.
                </div>
                @endif

                <!-- 3. Magistrate Interview Details -->
                <h5 class="section-title"><i class="fas fa-microphone"></i> Appendix-5 Magistrate Interview Assessment</h5>
                @if($application->interview)
                <table class="table table-bordered details-table">
                    <tr>
                        <th>Age (Verified)</th>
                        <td>{{ $application->interview->age }} years</td>
                    </tr>
                    <tr>
                        <th>Education Qualification</th>
                        <td>{{ $application->interview->education }}</td>
                    </tr>
                    <tr>
                        <th>Physical & Mental Fitness</th>
                        <td>{{ $application->interview->physical_mental_fitness ? 'Fit (উপযুক্ত)' : 'Unfit (অনুপযুক্ত)' }}</td>
                    </tr>
                    <tr>
                        <th>Weapon Handling Knowledge</th>
                        <td>{{ $application->interview->weapon_handling_knowledge ? 'Satisfactory' : 'Unsatisfactory' }}</td>
                    </tr>
                    <tr>
                        <th>Gun Law Knowledge</th>
                        <td>{{ $application->interview->gun_law_knowledge ? 'Satisfactory' : 'Unsatisfactory' }}</td>
                    </tr>
                    <tr>
                        <th>Safe Custody Capability</th>
                        <td>{{ $application->interview->safe_custody_capability ? 'Yes (আছে)' : 'No (নেই)' }}</td>
                    </tr>
                    <tr>
                        <th>Safety Necessity Justification</th>
                        <td>{{ $application->interview->safety_necessity_justification ? 'Justified' : 'Not Justified' }}</td>
                    </tr>
                    <tr>
                        <th>Behavior Assessment</th>
                        <td>{{ $application->interview->behavior_satisfactory ? 'Satisfactory' : 'Unsatisfactory' }}</td>
                    </tr>
                    <tr>
                        <th>Summary of Police Report Comments</th>
                        <td>{{ $application->interview->police_report_comments ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Magistrate / DC Final Recommendation</th>
                        <td><strong>{{ $application->interview->magistrate_final_comments ?? 'N/A' }}</strong></td>
                    </tr>
                </table>
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> Magistrate Interview (Appendix-5) has not been filled out yet.
                </div>
                @endif

            </div>
            <div class="card-footer text-right">
                @if(in_array($application->status, ['Submitted', 'Verified', 'Interviewed']))
                    <div class="d-inline-flex" style="gap: 10px;">
                        <form action="{{ route('gun-license.person.approve', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this application?');">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Approve Application</button>
                        </form>
                        <form action="{{ route('gun-license.person.reject', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this application?');">
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
