@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'GunLicenseList'])

@section('title', 'আগ্নেয়াস্ত্র লাইসেন্স আবেদন তালিকা')

@push('style')
<style>
    .badge-submitted { background-color: #f59e0b; color: white; }
    .badge-verified { background-color: #3b82f6; color: white; }
    .badge-interviewed { background-color: #8b5cf6; color: white; }
    .badge-approved { background-color: #10b981; color: white; }
    .badge-rejected { background-color: #ef4444; color: white; }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>আগ্নেয়াস্ত্র লাইসেন্স আবেদন তালিকা</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('gun-license.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> নতুন আবেদন করুন</a>
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
                <h3 class="card-title" style="font-size: 20px;">সকল আগ্নেয়াস্ত্র লাইসেন্স আবেদনকারীর তালিকা</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="unifiedLicensesTable">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Tracking No</th>
                            <th>আবেদনকারী/প্রতিষ্ঠানের নাম</th>
                            <th>লাইসেন্সের ধরণ</th>
                            <th>মোবাইল নম্বর</th>
                            <th>চাহিত আগ্নেয়াস্ত্র</th>
                            <th>অবস্থা</th>
                            <th>তদন্ত প্রতিবেদন</th>
                            <th>সাক্ষাৎকার</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $index => $app)
                        @php
                            // Type-based routing prefixes
                            $routePrefix = '';
                            if ($app->type === 'person') {
                                $routePrefix = 'gun-license.person';
                            } elseif ($app->type === 'org') {
                                $routePrefix = 'gun-license.org';
                            } else {
                                $routePrefix = 'gun-license.other-org';
                            }
                        @endphp
                        <tr>
                            <td>{{ $applications->firstItem() + $index }}</td>
                            <td>
                                <a href="{{ route($routePrefix . '.show', $app->id) }}">
                                    <strong class="text-primary">{{ $app->tracking_no }}</strong>
                                </a>
                            </td>
                            <td>
                                <strong>{{ $app->name }}</strong>
                            </td>
                            <td>
                                @if($app->type === 'person')
                                    <span class="badge badge-success">{{ $app->license_type }}</span>
                                @elseif($app->type === 'org')
                                    <span class="badge badge-primary">{{ $app->license_type }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $app->license_type }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $app->phone ?? 'N/A' }}
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $app->weapon }}</span>
                            </td>
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
                                @if($app->has_verification)
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
                                @else
                                    <a href="{{ route($routePrefix . '.verification.create', $app->id) }}" class="btn btn-xs btn-outline-primary"><i class="fas fa-shield-alt"></i> Fill Appendix-7</a>
                                @endif
                            </td>
                            <td>
                                @if($app->has_interview)
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Completed</span>
                                @else
                                    @if($app->status == 'Verified' || $app->status == 'Interviewed')
                                        <a href="{{ route($routePrefix . '.interview.create', $app->id) }}" class="btn btn-xs btn-outline-purple" style="color: #8b5cf6; border-color: #8b5cf6;"><i class="fas fa-microphone"></i> Fill Appendix-8</a>
                                    @else
                                        <span class="text-muted"><i class="fas fa-lock"></i> Pending Verification</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="d-flex" style="gap: 5px;">
                                    <a href="{{ route($routePrefix . '.show', $app->id) }}" class="btn btn-xs btn-info" title="View"><i class="fas fa-eye"></i> View</a>
                                    @if(in_array($app->status, ['Submitted', 'Verified', 'Interviewed']))
                                        <form action="{{ route($routePrefix . '.approve', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to approve this application?');">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-success" title="Approve"><i class="fas fa-thumbs-up"></i> Approve</button>
                                        </form>
                                        <form action="{{ route($routePrefix . '.reject', $app->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this application?');">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-danger" title="Reject"><i class="fas fa-thumbs-down"></i> Reject</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No applications found.</td>
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
