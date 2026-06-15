@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'PersonGunLicense'])

@section('title', 'Person Gun License Applications')

@push('style')
    <style>
        .badge-submitted {
            background-color: #f59e0b;
            color: white;
        }

        .badge-verified {
            background-color: #3b82f6;
            color: white;
        }

        .badge-interviewed {
            background-color: #8b5cf6;
            color: white;
        }

        .badge-approved {
            background-color: #10b981;
            color: white;
        }

        .badge-rejected {
            background-color: #ef4444;
            color: white;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Person Gun License Applications</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('gun-license.person.create') }}" class="btn btn-primary"><i
                            class="fas fa-plus-circle"></i> New Application</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 20px;">Bangladesh Ministry of Home Affairs / District
                        Magistrate workflow</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="personLicensesTable">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Tracking No</th>
                                <th>Applicant Name</th>
                                <th>Weapon Nature</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Verification</th>
                                <th>Interview</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $index => $app)
                                <tr>
                                    <td>{{ $applications->firstItem() + $index }}</td>
                                    <td><a href="{{ route('gun-license.person.show', $app->id) }}"><strong
                                                class="text-primary">{{ $app->tracking_no }}</strong></a></td>
                                    <td>{{ $app->applicant_name }}</td>
                                    <td><span class="badge badge-secondary">{{ $app->weapon_details }}</span></td>
                                    <td>{{ $app->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if($app->status == 'Submitted')
                                            <span class="badge badge-submitted">Submitted</span>
                                        @elseif($app->status == 'Verified')
                                            <span class="badge badge-verified">Verified</span>
                                        @elseif($app->status == 'Interviewed')
                                            <span class="badge badge-interviewed">Interviewed</span>
                                        @elseif($app->status == 'Approved')
                                            <span class="badge badge-approved">Approved</span>
                                        @elseif($app->status == 'Rejected')
                                            <span class="badge badge-rejected">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($app->verification)
                                            <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
                                        @else
                                            <a href="{{ route('gun-license.person.verification.create', $app->id) }}"
                                                class="btn btn-xs btn-outline-primary"><i class="fas fa-user-check"></i> Fill
                                                Appendix-4</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($app->interview)
                                            <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
                                        @else
                                            @if($app->status == 'Verified' || $app->status == 'Interviewed')
                                                <a href="{{ route('gun-license.person.interview.create', $app->id) }}"
                                                    class="btn btn-xs btn-outline-purple"
                                                    style="color: #8b5cf6; border-color: #8b5cf6;"><i class="fas fa-microphone"></i>
                                                    Fill Appendix-5</a>
                                            @else
                                                <span class="text-muted"><i class="fas fa-lock"></i> Pending Verification</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex" style="gap: 5px;">
                                            <a href="{{ route('gun-license.person.show', $app->id) }}"
                                                class="btn btn-xs btn-info" title="View"><i class="fas fa-eye"></i> View</a>
                                            @if(in_array($app->status, ['Submitted', 'Verified', 'Interviewed']))
                                                <form action="{{ route('gun-license.person.approve', $app->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to approve this application?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-success" title="Approve"><i
                                                            class="fas fa-thumbs-up"></i> Approve</button>
                                                </form>
                                                <form action="{{ route('gun-license.person.reject', $app->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to reject this application?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-xs btn-danger" title="Reject"><i
                                                            class="fas fa-thumbs-down"></i> Reject</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection