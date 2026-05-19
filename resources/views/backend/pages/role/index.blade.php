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
        width: 20px;
        height: 20px;
        border-radius: 6px;
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
        font-size: 11px;
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
                <!-- Role Identity Input -->
                <div class="form-group mb-4 col-md-6 pl-0">
                    <label class="form-label text-dark font-weight-bold" style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em; color: #475569;" for="name">Role Identity</label>
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

                <!-- Capability Matrix Section -->
                <div class="mt-5">
                    <h5 class="font-weight-bold text-dark mb-3">Capability Matrix (Permissions)</h5>
                    <div class="table-responsive" style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                        <table class="table premium-table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Module / Feature</th>
                                    <th class="text-center" style="width: 120px; color: #10b981;">Create</th>
                                    <th class="text-center" style="width: 120px; color: #3b82f6;">Read</th>
                                    <th class="text-center" style="width: 120px; color: #f59e0b;">Update</th>
                                    <th class="text-center" style="width: 120px; color: #ef4444;">Delete</th>
                                    <th>Other Extras</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedPermissions as $module => $actions)
                                    <tr>
                                        <td class="font-weight-bold text-dark text-capitalize">
                                            <i class="fas fa-folder text-warning mr-2"></i> {{ str_replace('_', ' ', $module) }}
                                        </td>
                                        <td class="text-center">
                                            @if(isset($actions['create']))
                                                <input type="checkbox" name="permissions[]" value="{{ $actions['create']->name }}" class="role-permission-checkbox" {{ isset($rolePermissions) && in_array($actions['create']->name, $rolePermissions) ? 'checked' : '' }}>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($actions['read']))
                                                <input type="checkbox" name="permissions[]" value="{{ $actions['read']->name }}" class="role-permission-checkbox" {{ isset($rolePermissions) && in_array($actions['read']->name, $rolePermissions) ? 'checked' : '' }}>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($actions['update']))
                                                <input type="checkbox" name="permissions[]" value="{{ $actions['update']->name }}" class="role-permission-checkbox" {{ isset($rolePermissions) && in_array($actions['update']->name, $rolePermissions) ? 'checked' : '' }}>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(isset($actions['delete']))
                                                <input type="checkbox" name="permissions[]" value="{{ $actions['delete']->name }}" class="role-permission-checkbox" {{ isset($rolePermissions) && in_array($actions['delete']->name, $rolePermissions) ? 'checked' : '' }}>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach($actions as $actName => $permObj)
                                                @if(!in_array($actName, ['create', 'read', 'update', 'delete']))
                                                    <div class="d-inline-flex align-items-center mr-3 mt-1 mb-1">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permObj->name }}" class="role-permission-checkbox mr-2" {{ isset($rolePermissions) && in_array($permObj->name, $rolePermissions) ? 'checked' : '' }}>
                                                        <span class="text-dark text-capitalize" style="font-size: 0.85rem;">{{ $actName }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white border-top-0 d-flex justify-content-start pb-4 px-4">
                @if(isset($role))
                    <button type="submit" class="btn btn-primary btn-premium px-4"><i class="fas fa-save mr-1"></i> Update Security Role</button>
                    <a href="{{ route('role.index') }}" class="btn btn-light btn-premium ml-2"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
                @else
                    <button type="submit" class="btn btn-primary btn-premium px-4"><i class="fas fa-plus-circle mr-1"></i> Save Security Role</button>
                    <button type="reset" class="btn btn-light btn-premium ml-2"><i class="fas fa-undo-alt mr-1"></i> Reset Matrix</button>
                @endif
            </div>
        </form>
    </div>

    <!-- Registered Roles Inventory List -->
    <div class="card premium-card mt-4">
        <div class="card-header bg-light">
            <h3 class="card-title text-dark">
                <i class="fas fa-list-alt text-secondary"></i> 
                Registered Roles Registry
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
                <div class="table-responsive">
                    <table class="table premium-table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 80px">SL</th>
                                <th>Role Name</th>
                                <th>Sluggish Tag</th>
                                <th class="text-center" style="width: 150px">Capabilities Granted</th>
                                <th class="text-center" style="width: 150px">Action Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $value)
                                <tr>
                                    <td class="font-weight-bold text-secondary">{{ $roles->firstItem() + $key }}</td>
                                    <td class="font-weight-bold text-dark">{{ $value->name }}</td>
                                    <td><code class="text-secondary bg-light px-2 py-1 rounded">{{ $value->slug }}</code></td>
                                    <td class="text-center">
                                        <span class="badge badge-info px-2 py-1 font-weight-bold">{{ $value->permissions->count() }} Perms</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
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
                                                <span class="text-muted font-italic" style="font-size: 0.8rem;">System Reserved</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<script>
$(document).ready(function () {
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
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush