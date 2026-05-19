@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', isset($role) ? 'Edit Control Identity' : 'Role Definitions')

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

    .form-control-premium {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 16px;
        font-size: 0.95rem;
        color: #334155;
        transition: all 0.2s ease;
        height: auto;
    }

    .form-control-premium:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        color: #0f172a;
    }

    .premium-table {
        margin-bottom: 0;
    }

    .premium-table thead th {
        font-weight: 600;
        color: #475569;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 16px;
        background: #f8fafc;
    }

    .premium-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .premium-table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .premium-table td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 0.9rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Custom Checkbox Design matching Screenshot */
    .role-permission-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1.5px solid #cbd5e1;
        cursor: pointer;
        transition: all 0.2s ease;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        vertical-align: middle;
    }
    .role-permission-checkbox:checked {
        background-color: #2563eb;
        border-color: #2563eb;
    }
    .role-permission-checkbox:checked::after {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: #fff;
        font-size: 10px;
    }

    .btn-operation {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        padding: 0;
    }

    .btn-operation-edit {
        background-color: #eff6ff;
        color: #2563eb;
        border-color: #dbeafe;
    }

    .btn-operation-edit:hover {
        background-color: #2563eb;
        color: #ffffff;
    }

    .btn-operation-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border-color: #fee2e2;
    }

    .btn-operation-delete:hover {
        background-color: #dc2626;
        color: #ffffff;
    }

    /* Sidebar and Category styling */
    .sidebar-category-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding-right: 15px;
        border-right: 1px solid #e2e8f0;
    }
    .category-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 14px;
        border-radius: 8px;
        color: #475569;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    .category-item:hover {
        background-color: #f8fafc;
        color: #1e293b;
    }
    .category-item.active {
        background-color: #eff6ff;
        color: #2563eb;
        font-weight: 600;
        border-left: 4px solid #2563eb;
    }
    .category-badge {
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 9999px;
        background-color: #e2e8f0;
        color: #475569;
        font-weight: 600;
    }
    .category-item.active .category-badge {
        background-color: #3b82f6;
        color: #ffffff;
    }
    .sidebar-actions {
        margin-top: 15px;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .action-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #475569;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 6px 10px;
        border-radius: 6px;
    }
    .action-link:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    /* Permission Indicators */
    .module-permission-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .module-permission-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }
    .perm-indicator {
        width: 22px;
        height: 22px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        color: #fff;
    }
    .perm-indicator.read { background-color: #10b981; }
    .perm-indicator.create { background-color: #3b82f6; }
    .perm-indicator.update { background-color: #f59e0b; }
    .perm-indicator.delete { background-color: #ef4444; }
    .perm-indicator.disabled { background-color: #f1f5f9; color: #cbd5e1; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4" style="min-height: 1000px;">
    
    <!-- Top Tabs Navigation -->
    @include('backend.pages.access-nav-tabs')

    <!-- Alert Notifications -->
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert" style="border-left: 5px solid #10b981;">
            <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert" style="border-left: 5px solid #ef4444;">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @php
        $coreModules = [
            'people', 'organization', 'trade_license', 'trade-license', 'trades', 
            'tax', 'taxes', 'house', 'houses', 'land', 'lands', 'vehicle', 'vehicles', 
            'road', 'roads', 'marriage', 'marriages', 'divorce', 'divorces', 
            'chairman', 'councilor', 'bridge', 'bridges', 'market', 'markets', 
            'hotel_restaurant', 'hotel-restaurant', 'application_form', 'application-form'
        ];
        
        $totalCount = count($groupedPermissions);
        $coreCount = 0;
        $certCount = 0;
        $basicCount = 0;
        $uncatCount = 0;
        
        foreach (array_keys($groupedPermissions) as $mod) {
            $isC = in_array($mod, $coreModules);
            $isCe = str_contains($mod, 'certificate');
            $isB = !$isC && !$isCe && (
                str_contains($mod, 'setting') || 
                str_contains($mod, 'type') || 
                str_contains($mod, 'category') || 
                str_contains($mod, 'class') || 
                str_contains($mod, 'ward') || 
                str_contains($mod, 'village') || 
                str_contains($mod, 'union') || 
                str_contains($mod, 'institute') || 
                str_contains($mod, 'department') || 
                str_contains($mod, 'section') || 
                str_contains($mod, 'area') || 
                str_contains($mod, 'owner')
            );
            
            if ($isC) $coreCount++;
            elseif ($isCe) $certCount++;
            elseif ($isB) $basicCount++;
            else $uncatCount++;
        }
    @endphp

    <!-- Main Creation/Edit Form -->
    <div class="card premium-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas {{ isset($role) ? 'fa-edit' : 'fa-plus-circle' }} text-primary"></i> 
                {{ isset($role) ? 'Modify Security Role : ' . $role->name : 'Initialize New Security Role' }}
            </h3>
        </div>

        <form role="form" method="POST" action="{{ isset($role) ? route('role.update', $role->id) : route('role.store') }}">
            @csrf
            @if(isset($role))
                @method('PATCH')
            @endif

            <div class="card-body">
                <!-- Role Identity Input Group -->
                <div class="row">
                    <div class="form-group mb-4 col-md-6">
                        <label class="form-label text-dark font-weight-bold" style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em; color: #475569;" for="name">Role Name</label>
                        <input type="text" name="name" 
                               class="form-control form-control-premium @error('name') is-invalid @enderror" 
                               value="{{ old('name', $role->name ?? '') }}" 
                               id="name" 
                               placeholder="e.g. Finance Administrator" 
                               required>
                        <small class="text-muted mt-1 d-block">Unique name for this security profile.</small>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-4 col-md-6">
                        <label class="form-label text-dark font-weight-bold" style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em; color: #475569;" for="description">Description</label>
                        <input type="text" name="description" 
                               class="form-control form-control-premium" 
                               value="{{ old('description', $role->description ?? '') }}" 
                               id="description" 
                               placeholder="e.g. Access to financial setups and basic configurations">
                        <small class="text-muted mt-1 d-block">Brief explanation of this role's responsibilities.</small>
                    </div>
                </div>

                <!-- Capability Matrix Section -->
                <div class="mt-4 border-top pt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="gap: 15px;">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-shield-alt text-primary mr-2"></i> Role Permissions (Ability Matrix)
                        </h5>
                        <!-- Search Bar -->
                        <div style="min-width: 300px;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0" style="border-radius: 10px 0 0 10px; border: 1px solid #cbd5e1; padding: 6px 12px;">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" id="permissionSearch" class="form-control border-left-0 form-control-premium" style="border-radius: 0 10px 10px 0; padding: 6px 12px;" placeholder="Search modules or permissions...">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Matrix Columns: Left Sidebar, Right Matrix Table -->
                    <div class="row">
                        <!-- Sidebar Categories -->
                        <div class="col-md-3">
                            <div class="sidebar-category-list">
                                <div class="category-item active" data-category="all">
                                    <span><i class="fas fa-cubes mr-2"></i> All Modules</span>
                                    <span class="category-badge">{{ $totalCount }}</span>
                                </div>
                                <div class="category-item" data-category="core">
                                    <span><i class="fas fa-key mr-2"></i> Core Resources</span>
                                    <span class="category-badge">{{ $coreCount }}</span>
                                </div>
                                <div class="category-item" data-category="basic">
                                    <span><i class="fas fa-cog mr-2"></i> Basic Settings</span>
                                    <span class="category-badge">{{ $basicCount }}</span>
                                </div>
                                <div class="category-item" data-category="certificate">
                                    <span><i class="fas fa-certificate mr-2"></i> Certificates</span>
                                    <span class="category-badge">{{ $certCount }}</span>
                                </div>
                                <div class="category-item" data-category="uncategorized">
                                    <span><i class="fas fa-ellipsis-h mr-2"></i> Uncategorized</span>
                                    <span class="category-badge">{{ $uncatCount }}</span>
                                </div>
                            </div>
                            
                            <div class="sidebar-actions">
                                <span class="action-link text-primary" id="selectAllVisible" style="cursor: pointer;">
                                    <i class="far fa-check-square"></i> Select All Active
                                </span>
                                <span class="action-link text-danger" id="deselectAllVisible" style="cursor: pointer;">
                                    <i class="far fa-square"></i> Deselect All Active
                                </span>
                            </div>
                        </div>
                        
                        <!-- Ability Matrix Table -->
                        <div class="col-md-9">
                            <div class="matrix-container" style="max-height: 520px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.02);">
                                <table class="table premium-table table-hover table-striped mb-0">
                                    <thead style="position: sticky; top: 0; z-index: 10;">
                                        <tr>
                                            <th style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">Module Name</th>
                                            <th class="text-center" style="width: 100px; background: #f8fafc; color: #10b981; border-bottom: 2px solid #e2e8f0;">
                                                <input type="checkbox" id="col-read" class="col-toggle-checkbox mr-1" style="cursor:pointer;"> Read
                                            </th>
                                            <th class="text-center" style="width: 100px; background: #f8fafc; color: #3b82f6; border-bottom: 2px solid #e2e8f0;">
                                                <input type="checkbox" id="col-create" class="col-toggle-checkbox mr-1" style="cursor:pointer;"> Create
                                            </th>
                                            <th class="text-center" style="width: 100px; background: #f8fafc; color: #f59e0b; border-bottom: 2px solid #e2e8f0;">
                                                <input type="checkbox" id="col-update" class="col-toggle-checkbox mr-1" style="cursor:pointer;"> Update
                                            </th>
                                            <th class="text-center" style="width: 100px; background: #f8fafc; color: #ef4444; border-bottom: 2px solid #e2e8f0;">
                                                <input type="checkbox" id="col-delete" class="col-toggle-checkbox mr-1" style="cursor:pointer;"> Delete
                                            </th>
                                            <th class="text-center" style="width: 150px; background: #f8fafc; border-bottom: 2px solid #e2e8f0;">Row Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="matrixBody">
                                        @foreach($groupedPermissions as $module => $actions)
                                            @php
                                                $isC = in_array($module, $coreModules);
                                                $isCe = str_contains($module, 'certificate');
                                                $isB = !$isC && !$isCe && (
                                                    str_contains($module, 'setting') || 
                                                    str_contains($module, 'type') || 
                                                    str_contains($module, 'category') || 
                                                    str_contains($module, 'class') || 
                                                    str_contains($module, 'ward') || 
                                                    str_contains($module, 'village') || 
                                                    str_contains($module, 'union') || 
                                                    str_contains($module, 'institute') || 
                                                    str_contains($module, 'department') || 
                                                    str_contains($module, 'section') || 
                                                    str_contains($module, 'area') || 
                                                    str_contains($module, 'owner')
                                                );
                                                
                                                $cat = 'uncategorized';
                                                if ($isC) $cat = 'core';
                                                elseif ($isCe) $cat = 'certificate';
                                                elseif ($isB) $cat = 'basic';

                                                $icon = 'fa-folder text-warning';
                                                if (str_contains($module, 'certificate')) {
                                                    $icon = 'fa-certificate text-danger';
                                                } elseif (str_contains($module, 'village') || str_contains($module, 'area')) {
                                                    $icon = 'fa-map-marked-alt text-info';
                                                } elseif (str_contains($module, 'union') || str_contains($module, 'ward')) {
                                                    $icon = 'fa-university text-primary';
                                                } elseif (str_contains($module, 'road') || str_contains($module, 'bridge')) {
                                                    $icon = 'fa-road text-secondary';
                                                } elseif (str_contains($module, 'vehicle')) {
                                                    $icon = 'fa-car text-success';
                                                } elseif (str_contains($module, 'house')) {
                                                    $icon = 'fa-home text-warning';
                                                } elseif (str_contains($module, 'land')) {
                                                    $icon = 'fa-mountain text-success';
                                                } elseif (str_contains($module, 'market')) {
                                                    $icon = 'fa-store text-danger';
                                                } elseif (str_contains($module, 'organization') || str_contains($module, 'trade')) {
                                                    $icon = 'fa-briefcase text-primary';
                                                } elseif (str_contains($module, 'hotel') || str_contains($module, 'restaurant')) {
                                                    $icon = 'fa-hotel text-info';
                                                } elseif (str_contains($module, 'department') || str_contains($module, 'section')) {
                                                    $icon = 'fa-sitemap text-indigo';
                                                } elseif (str_contains($module, 'user') || str_contains($module, 'role') || str_contains($module, 'permission')) {
                                                    $icon = 'fa-user-shield text-dark';
                                                } elseif (str_contains($module, 'people')) {
                                                    $icon = 'fa-users text-primary';
                                                } elseif (str_contains($module, 'tax')) {
                                                    $icon = 'fa-money-bill-wave text-success';
                                                } elseif (str_contains($module, 'marriage') || str_contains($module, 'divorce')) {
                                                    $icon = 'fa-ring text-warning';
                                                }
                                            @endphp
                                            <tr data-category="{{ $cat }}" data-module-name="{{ $module }}">
                                                <td class="font-weight-bold text-dark text-capitalize">
                                                    <div><i class="fas {{ $icon }} mr-2"></i> {{ str_replace(['_', '-'], ' ', $module) }}</div>
                                                    @php
                                                        $extraActions = [];
                                                        foreach($actions as $actName => $permObj) {
                                                            if(!in_array($actName, ['create', 'read', 'update', 'delete'])) {
                                                                $extraActions[$actName] = $permObj;
                                                            }
                                                        }
                                                    @endphp
                                                    @if(count($extraActions) > 0)
                                                        <div class="mt-2 pl-4 d-flex flex-wrap" style="gap: 12px; font-weight: normal;">
                                                            @foreach($extraActions as $actName => $permObj)
                                                                <div class="d-inline-flex align-items-center">
                                                                    <input type="checkbox" name="permissions[]" value="{{ $permObj->name }}" class="role-permission-checkbox mr-1 chk-extra" {{ isset($rolePermissions) && in_array($permObj->name, $rolePermissions) ? 'checked' : '' }}>
                                                                    <span class="text-muted text-capitalize" style="font-size: 0.75rem;">{{ $actName }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if(isset($actions['read']))
                                                        <input type="checkbox" name="permissions[]" value="{{ $actions['read']->name }}" class="role-permission-checkbox chk-read" {{ isset($rolePermissions) && in_array($actions['read']->name, $rolePermissions) ? 'checked' : '' }}>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if(isset($actions['create']))
                                                        <input type="checkbox" name="permissions[]" value="{{ $actions['create']->name }}" class="role-permission-checkbox chk-create" {{ isset($rolePermissions) && in_array($actions['create']->name, $rolePermissions) ? 'checked' : '' }}>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if(isset($actions['update']))
                                                        <input type="checkbox" name="permissions[]" value="{{ $actions['update']->name }}" class="role-permission-checkbox chk-update" {{ isset($rolePermissions) && in_array($actions['update']->name, $rolePermissions) ? 'checked' : '' }}>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if(isset($actions['delete']))
                                                        <input type="checkbox" name="permissions[]" value="{{ $actions['delete']->name }}" class="role-permission-checkbox chk-delete" {{ isset($rolePermissions) && in_array($actions['delete']->name, $rolePermissions) ? 'checked' : '' }}>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-xs btn-outline-primary btn-row-check-all" title="Select All in Row" style="padding: 2px 6px; font-size: 0.75rem;">
                                                        <i class="fas fa-check-double"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-outline-danger btn-row-uncheck-all" title="Deselect All in Row" style="padding: 2px 6px; font-size: 0.75rem; margin-left: 4px;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 d-flex justify-content-start pb-4 px-4">
                @if(isset($role))
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px; font-weight: 600; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);"><i class="fas fa-save mr-1"></i> Update & Publish Security Role</button>
                    <a href="{{ route('role.index') }}" class="btn btn-light ml-2" style="border-radius: 8px; font-weight: 600; border: 1px solid #cbd5e1;"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
                @else
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 8px; font-weight: 600; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);"><i class="fas fa-plus-circle mr-1"></i> Initialize & Publish Security Role</button>
                    <button type="reset" class="btn btn-light ml-2" style="border-radius: 8px; font-weight: 600; border: 1px solid #cbd5e1;"><i class="fas fa-undo-alt mr-1"></i> Reset Matrix</button>
                @endif
            </div>
        </form>
    </div>

    <!-- Registered Roles Directory -->
    <div class="card premium-card mt-4">
        <div class="card-header bg-light">
            <h3 class="card-title text-dark">
                <i class="fas fa-list-alt text-secondary"></i> 
                Registered Role Directory
            </h3>
        </div>
        <div class="card-body">
            @if($roles->count() == 0)
                <div class="text-center py-5">
                    <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                    <h5 class="text-secondary">No Roles Found</h5>
                    <p class="text-muted">No security profiles are currently initialized.</p>
                </div>
            @else
                <div class="role-list-container">
                    @foreach($roles as $key => $value)
                        @php
                            $roleGroupedPerms = [];
                            foreach ($value->permissions as $perm) {
                                $parts = explode('.', $perm->name);
                                $mod = $parts[0] ?? 'general';
                                $act = $parts[1] ?? 'read';
                                $roleGroupedPerms[$mod][$act] = true;
                            }
                        @endphp
                        <div class="role-card-item mb-4 p-4" style="border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; transition: all 0.2s ease;">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="gap: 15px;">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-1" style="font-size: 1.1rem;">
                                        {{ $value->name }}
                                    </h4>
                                    <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                        <code class="text-secondary bg-light px-2 py-0.5 rounded" style="font-size: 0.8rem;">{{ $value->slug }}</code>
                                        @if($value->description)
                                            <span class="text-muted" style="font-size: 0.85rem;">— {{ $value->description }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <span class="badge badge-primary px-3 py-1.5 font-weight-bold" style="border-radius: 30px; font-size: 0.8rem; background-color: #3b82f6;">
                                        {{ $value->permissions->count() }} Permissions
                                    </span>
                                    <div class="d-flex align-items-center" style="gap: 8px;">
                                        <a href="{{ route('role.edit', $value->id) }}" class="btn btn-operation btn-operation-edit" title="Edit Role Identity">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <!-- Protect Default Developer/Superadmin Roles -->
                                        @if(!in_array($value->id, [1, 4]) && !in_array(strtolower($value->name), ['admin', 'developer']))
                                            <form action="{{ route('role.destroy', $value->id) }}" method="POST" class="d-inline delete-form-confirm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-operation btn-operation-delete" title="Delete Role Identity">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted font-italic px-2" style="font-size: 0.8rem;">System Reserved</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Permissions Matrix Preview -->
                            @if(count($roleGroupedPerms) > 0)
                                <div class="d-flex flex-wrap" style="gap: 8px; max-height: 220px; overflow-y: auto; padding: 5px;">
                                    @foreach($roleGroupedPerms as $mod => $acts)
                                        @php
                                            $modIcon = 'fa-folder text-warning';
                                            if (str_contains($mod, 'certificate')) {
                                                $modIcon = 'fa-certificate text-danger';
                                            } elseif (str_contains($mod, 'village') || str_contains($mod, 'area')) {
                                                $modIcon = 'fa-map-marked-alt text-info';
                                            } elseif (str_contains($mod, 'union') || str_contains($mod, 'ward')) {
                                                $modIcon = 'fa-university text-primary';
                                            } elseif (str_contains($mod, 'road') || str_contains($mod, 'bridge')) {
                                                $modIcon = 'fa-road text-secondary';
                                            } elseif (str_contains($mod, 'vehicle')) {
                                                $modIcon = 'fa-car text-success';
                                            } elseif (str_contains($mod, 'house')) {
                                                $modIcon = 'fa-home text-warning';
                                            } elseif (str_contains($mod, 'land')) {
                                                $modIcon = 'fa-mountain text-success';
                                            } elseif (str_contains($mod, 'market')) {
                                                $modIcon = 'fa-store text-danger';
                                            } elseif (str_contains($mod, 'organization') || str_contains($mod, 'trade')) {
                                                $modIcon = 'fa-briefcase text-primary';
                                            } elseif (str_contains($mod, 'hotel') || str_contains($mod, 'restaurant')) {
                                                $modIcon = 'fa-hotel text-info';
                                            } elseif (str_contains($mod, 'department') || str_contains($mod, 'section')) {
                                                $modIcon = 'fa-sitemap text-indigo';
                                            } elseif (str_contains($mod, 'user') || str_contains($mod, 'role') || str_contains($mod, 'permission')) {
                                                $modIcon = 'fa-user-shield text-dark';
                                            } elseif (str_contains($mod, 'people')) {
                                                $modIcon = 'fa-users text-primary';
                                            } elseif (str_contains($mod, 'tax')) {
                                                $modIcon = 'fa-money-bill-wave text-success';
                                            } elseif (str_contains($mod, 'marriage') || str_contains($mod, 'divorce')) {
                                                $modIcon = 'fa-ring text-warning';
                                            }
                                        @endphp
                                        <div class="module-permission-card bg-white" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px 12px; min-width: 145px; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                                            <div class="module-name-lbl font-weight-bold text-dark text-capitalize mb-2" style="font-size: 0.8rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ str_replace(['_', '-'], ' ', $mod) }}">
                                                <i class="fas {{ $modIcon }} mr-1" style="font-size: 0.75rem;"></i> {{ str_replace(['_', '-'], ' ', $mod) }}
                                            </div>
                                            <div class="indicator-container d-flex" style="gap: 4px;">
                                                <span class="perm-indicator {{ isset($acts['read']) ? 'read' : 'disabled' }}" title="Read Access">R</span>
                                                <span class="perm-indicator {{ isset($acts['create']) ? 'create' : 'disabled' }}" title="Create Access">C</span>
                                                <span class="perm-indicator {{ isset($acts['update']) ? 'update' : 'disabled' }}" title="Update Access">U</span>
                                                <span class="perm-indicator {{ isset($acts['delete']) ? 'delete' : 'disabled' }}" title="Delete Access">D</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted font-italic" style="font-size: 0.85rem; padding: 10px 5px;">No active capabilities granted.</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {!! $roles->links('pagination::bootstrap-4') !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    // Confirm delete operation
    $('.delete-form-confirm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Delete Role Profile?',
            text: "This will revoke this role assignment from all associated user accounts.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#475569',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Filter rows based on search and active category
    function applyFilters() {
        var query = $('#permissionSearch').val().toLowerCase();
        var category = $('.category-item.active').data('category');
        
        $('#matrixBody tr').each(function() {
            var rowModule = $(this).data('module-name').toLowerCase();
            var rowCategory = $(this).data('category');
            
            var matchesCategory = (category === 'all' || rowCategory === category);
            var matchesSearch = (rowModule.includes(query) || $(this).find('td:first-child').text().toLowerCase().includes(query));
            
            if (matchesCategory && matchesSearch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Trigger filter on typing
    $('#permissionSearch').on('keyup', function() {
        applyFilters();
    });

    // Trigger filter on category selection
    $('.category-item').on('click', function() {
        $('.category-item').removeClass('active');
        $(this).addClass('active');
        applyFilters();
    });

    // Select all visible checkboxes
    $('#selectAllVisible').on('click', function() {
        $('#matrixBody tr:visible input[type="checkbox"]').prop('checked', true);
    });
    
    // Deselect all visible checkboxes
    $('#deselectAllVisible').on('click', function() {
        $('#matrixBody tr:visible input[type="checkbox"]').prop('checked', false);
    });

    // Column checkboxes toggle (Read, Create, Update, Delete)
    $('#col-read').on('change', function() {
        $('#matrixBody tr:visible .chk-read').prop('checked', $(this).is(':checked'));
    });
    $('#col-create').on('change', function() {
        $('#matrixBody tr:visible .chk-create').prop('checked', $(this).is(':checked'));
    });
    $('#col-update').on('change', function() {
        $('#matrixBody tr:visible .chk-update').prop('checked', $(this).is(':checked'));
    });
    $('#col-delete').on('change', function() {
        $('#matrixBody tr:visible .chk-delete').prop('checked', $(this).is(':checked'));
    });

    // Row check/uncheck all button handlers
    $(document).on('click', '.btn-row-check-all', function() {
        $(this).closest('tr').find('input[type="checkbox"]').prop('checked', true);
    });
    
    $(document).on('click', '.btn-row-uncheck-all', function() {
        $(this).closest('tr').find('input[type="checkbox"]').prop('checked', false);
    });
});
</script>
@endpush