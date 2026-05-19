@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', isset($role_permission) ? 'Edit Capability Mapping' : 'Capability Mapping (Role-Permission)')

@push('style')
<style>
    /* Premium Styling */
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

    /* Modern Table styling */
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

    /* Modern Badges */
    .badge-modern {
        padding: 5px 10px;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-modern-success { background-color: #dcfce7; color: #15803d; }
    .badge-modern-primary { background-color: #dbeafe; color: #1d4ed8; }
    .badge-modern-warning { background-color: #fef9c3; color: #a16207; }
    .badge-modern-danger { background-color: #fee2e2; color: #b91c1c; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4" style="min-height: 1000px;">
    <!-- Content Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-sm-6">
            <h1 class="h3 font-weight-bold text-dark mb-0">Role & Capability Mapping</h1>
            <p class="text-muted mb-0">Map fine-grained system permissions directly to specific security groups.</p>
        </div>
        <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
            <ol class="breadcrumb bg-transparent p-0 m-0 justify-content-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item active">Role Permissions</li>
            </ol>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert" style="border-left: 5px solid #10b981;">
            <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('warning'))
        <div class="alert alert-warning alert-dismissible fade show premium-card p-3 mb-4" role="alert" style="border-left: 5px solid #f59e0b;">
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session()->get('warning') }}
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

    <div class="row">
        <!-- Left Panel: Assignment Form -->
        <div class="col-md-5">
            <div class="card premium-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-link text-primary"></i> 
                        {{ isset($role_permission) ? 'Modify Capability Mapping' : 'Execute Capability Mapping' }}
                    </h3>
                </div>
                
                @if(isset($role_permission))
                    <form role="form" method="POST" action="{{ route('rolepermission.update', $role_permission->role_id) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="old_role_id" value="{{ $role_permission->role_id }}">
                        <input type="hidden" name="old_permission_id" value="{{ $role_permission->permission_id }}">
                        
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <label class="form-label text-dark font-weight-bold" for="role_id">Target Identity (Role)</label>
                                <select class="form-control form-control-premium" name="role_id" id="role_id" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $role_permission->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label text-dark font-weight-bold" for="permission_id">Granted Capability (Permission)</label>
                                <select class="form-control form-control-premium" name="permission_id" id="permission_id" required>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}" {{ $permission->id == $role_permission->permission_id ? 'selected' : '' }}>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 d-flex justify-content-end gap-2 pb-4 px-4">
                            <a href="{{ route('rolepermission.index') }}" class="btn btn-light btn-premium mr-2"><i class="fas fa-times-circle"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary btn-premium"><i class="fas fa-save"></i> Execute Mapping</button>
                        </div>
                    </form>
                @else
                    <form role="form" method="POST" action="{{ route('rolepermission.store') }}">
                        @csrf
                        
                        <div class="card-body">
                            <div class="form-group mb-4">
                                <label class="form-label text-dark font-weight-bold" for="role_id">Target Identity (Role)</label>
                                <select class="form-control form-control-premium" name="role_id" id="role_id" required>
                                    <option value="" disabled selected>Select Target Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label text-dark font-weight-bold" for="permission_id">Granted Capability (Permission)</label>
                                <select class="form-control form-control-premium" name="permission_id" id="permission_id" required>
                                    <option value="" disabled selected>Select Capability</option>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top-0 d-flex justify-content-end gap-2 pb-4 px-4">
                            <button type="reset" class="btn btn-light btn-premium mr-2"><i class="fas fa-undo-alt"></i> Reset Form</button>
                            <button type="submit" class="btn btn-success btn-premium"><i class="fas fa-link"></i> Execute Mapping</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Right Panel: Inventory Table -->
        <div class="col-md-7">
            <div class="card premium-card">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white">
                        <i class="fas fa-list-alt text-white"></i> 
                        Role-Permission Mapping Inventory
                    </h3>
                </div>
                
                <div class="card-body">
                    @if($role_permissions->count() == 0)
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                            <h5 class="text-secondary">No Mappings Registered</h5>
                            <p class="text-muted">Generate a new role-permission mapping to assign scope credentials.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table premium-table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">SL</th>
                                        <th>Target Identity (Role)</th>
                                        <th>Granted Capability (Permission)</th>
                                        <th style="width: 180px" class="text-center">Security Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role_permissions as $key => $value)
                                        @if($value->role && $value->permission)
                                            <tr>
                                                <td>{{ $role_permissions->firstItem() + $key }}</td>
                                                <td>
                                                    <span class="badge badge-modern {{ in_array($value->role->id, [1,4]) ? 'badge-modern-danger' : 'badge-modern-primary' }}">
                                                        {{ $value->role->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <code class="bg-light px-2 py-1 rounded text-dark font-weight-bold" style="font-size: 0.85rem;">
                                                        {{ $value->permission->name }}
                                                    </code>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('rolepermission.edit', ['role_id' => $value->role_id, 'permission_id' => $value->permission_id]) }}" class="btn btn-outline-primary" title="Edit Mapping">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        @if(!(in_array($value->role_id, [1, 4]) && in_array($value->permission->name, ['roles.read', 'permissions.read', 'users.read'])))
                                                            <form action="{{ route('rolepermission.destroy') }}" method="POST" class="d-inline delete-form-confirm">
                                                                @csrf
                                                                <input type="hidden" name="role_id" value="{{ $value->role_id }}">
                                                                <input type="hidden" name="permission_id" value="{{ $value->permission_id }}">
                                                                <button type="submit" class="btn btn-outline-danger ml-1" title="Revoke Permission">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {!! $role_permissions->links('pagination::bootstrap-4') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function () {
    // Confirm delete mapping action
    $('.delete-form-confirm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "This operation will completely revoke this granted capability from the specified role.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, revoke mapping!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
<!-- Include SweetAlert2 from CDN if not already included in layouts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush