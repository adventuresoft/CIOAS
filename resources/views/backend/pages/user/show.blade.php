@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', 'Operator Profile Details')

@push('style')
<style>
    /* Premium Page Styling */
    .premium-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        background: #fff;
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .premium-card .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 18px 24px;
    }
    
    .premium-card .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Operator Profile Avatar */
    .profile-avatar-large {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #eff6ff;
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 2.2rem;
        border: 3px solid #dbeafe;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.1);
        margin: 0 auto;
    }

    .detail-label {
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 1.05rem;
        color: #1e293b;
        font-weight: 600;
    }

    .info-group {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
        margin-bottom: 16px;
    }
    .info-group:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4" style="min-height: 1000px;">
    
    <!-- Top Tabs Navigation -->
    @include('backend.pages.access-nav-tabs')

    <div class="row">
        <!-- Left Side: Profile Summary Card -->
        <div class="col-md-4">
            <div class="card premium-card text-center py-4">
                <div class="card-body">
                    @php
                        $firstLetter = strtoupper(substr($user->name, 0, 1));
                    @endphp
                    
                    @if(!empty($user->image) && file_exists(public_path('upload/users/images/' . $user->image)))
                        <img src="{{ asset('upload/users/images/' . $user->image) }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 3px solid #fff;">
                    @else
                        <div class="profile-avatar-large mb-3">{{ $firstLetter }}</div>
                    @endif

                    <h4 class="font-weight-bold text-dark mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3" style="font-size: 0.9rem;">{{ $user->email }}</p>
                    
                    @if($user->status == 1)
                        <span class="badge badge-success px-3 py-2 font-weight-bold" style="border-radius: 9999px;"><i class="fas fa-check-circle mr-1"></i> Verified Active</span>
                    @else
                        <span class="badge badge-warning px-3 py-2 font-weight-bold" style="border-radius: 9999px;"><i class="fas fa-clock mr-1"></i> Pending Review</span>
                    @endif

                    <hr class="my-4">

                    <div class="d-flex justify-content-center" style="gap: 12px;">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm px-3 font-weight-bold" style="border-radius: 6px;">
                            <i class="fas fa-edit mr-1"></i> Modify Profile
                        </a>
                        <a href="{{ route('user.index') }}" class="btn btn-light btn-sm px-3 font-weight-bold" style="border-radius: 6px; border: 1px solid #cbd5e1;">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Profile Details Card -->
        <div class="col-md-8">
            <div class="card premium-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-id-card text-primary"></i> 
                        Security Operator Profile Details
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Metadata -->
                        <div class="col-md-6">
                            <div class="info-group">
                                <div class="detail-label">System Registry ID</div>
                                <div class="detail-value text-primary font-weight-bold">
                                    <code>{{ $user->system_id }}</code>
                                </div>
                            </div>
                            
                            <div class="info-group">
                                <div class="detail-label">Full Name</div>
                                <div class="detail-value">{{ $user->name }}</div>
                            </div>

                            <div class="info-group">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value">{{ $user->email }}</div>
                            </div>

                            <div class="info-group">
                                <div class="detail-label">Contact Number</div>
                                <div class="detail-value">{{ $user->mobile ?? 'Not Specified' }}</div>
                            </div>
                        </div>

                        <!-- Location & Access Details -->
                        <div class="col-md-6 border-left pl-md-4">
                            @php
                                $areaName = 'No Area Mapped';
                                if ($user->institute) {
                                    if ($user->institute->institute_type_id == 1) {
                                        $areaName = ($user->institute->union->name ?? '') . ' (' . ($user->institute->type->name ?? 'Union') . ')';
                                    } elseif ($user->institute->institute_type_id == 2) {
                                        $areaName = ($user->institute->pourashava->name ?? '') . ' (' . ($user->institute->type->name ?? 'Pourashava') . ')';
                                    } elseif ($user->institute->institute_type_id == 3) {
                                        $areaName = ($user->institute->cityCorporation->name ?? '') . ' (' . ($user->institute->type->name ?? 'City Corp') . ')';
                                    } elseif ($user->institute->institute_type_id == 4) {
                                        $areaName = ($user->institute->district->name ?? '') . ' (' . ($user->institute->type->name ?? 'District') . ')';
                                    } else {
                                        $areaName = 'Area ID: ' . $user->institute->id;
                                    }

                                    if (!empty($user->institute->district->name)) {
                                        $areaName .= ' - District: ' . $user->institute->district->name;
                                    }
                                }
                            @endphp
                            <div class="info-group">
                                <div class="detail-label">Assigned Area</div>
                                <div class="detail-value">
                                    <i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $areaName }}
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="detail-label">Security Role</div>
                                <div class="detail-value">
                                    @if($user->roles->count() > 0)
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-primary px-2 py-1 font-weight-bold" style="border-radius: 6px;">{{ $role->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted font-italic">No Role Assigned</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="detail-label">Direct Override Permissions</div>
                                <div class="detail-value">
                                    @if($user->permissions->count() > 0)
                                        <span class="badge badge-success px-2 py-1 font-weight-bold" style="border-radius: 6px;">{{ $user->permissions->count() }} Direct Overrides</span>
                                    @else
                                        <span class="text-muted font-italic">None (Strict Role-Based Policies)</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="detail-label">Registered At</div>
                                <div class="detail-value">
                                    {{ $user->created_at ? $user->created_at->format('M d, Y h:i A') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="font-weight-bold text-dark mb-3">
                        <i class="fas fa-shield-alt text-primary mr-1"></i> Active System Permissions
                    </h5>
                    @php
                        $allPermissions = $user->getAllPermissions();
                        $groupedPerms = [];
                        foreach ($allPermissions as $perm) {
                            $parts = explode('.', $perm->name);
                            $module = $parts[0] ?? 'general';
                            $groupedPerms[$module] = ($groupedPerms[$module] ?? 0) + 1;
                        }
                    @endphp
                    @if(count($groupedPerms) > 0)
                        <div class="d-flex flex-wrap" style="gap: 8px;">
                            @foreach($groupedPerms as $module => $count)
                                <span class="d-inline-flex align-items-center bg-light border px-3 py-2 text-dark" style="border-radius: 8px; font-size: 0.88rem; font-weight: 600; border-color: #cbd5e1 !important;">
                                    {{ ucfirst(str_replace('_', ' ', $module)) }}
                                    <span class="badge badge-secondary ml-2" style="background-color: #64748b; color: #fff; font-size: 0.75rem; padding: 3px 6px; border-radius: 4px;">{{ $count }}</span>
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-muted font-italic">No Permissions Mapped</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection