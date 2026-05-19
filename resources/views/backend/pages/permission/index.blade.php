@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', isset($permission) ? 'Modify Permission Profile' : 'Permission Pool')

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

    /* Key Badge Design */
    .key-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .key-badge-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #ecfeff;
        color: #0891b2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .key-badge-text {
        font-family: Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        color: #db2777;
        background-color: #fdf2f8;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
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

    <div class="row">
        <!-- Left Side: Define New Permission Form -->
        <div class="col-md-5">
            <div class="card premium-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-key text-primary"></i> 
                        {{ isset($permission) ? 'Modify Permission' : 'Define New Permission' }}
                    </h3>
                </div>
                
                <form role="form" method="POST" action="{{ isset($permission) ? route('permission.update', $permission->id) : route('permission.store') }}">
                    @csrf
                    @if(isset($permission))
                        @method('PATCH')
                    @endif

                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label class="form-label text-dark font-weight-bold" for="name">Permission Descriptor</label>
                            <input type="text" name="name" 
                                   class="form-control form-control-premium @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $permission->name ?? '') }}" 
                                   id="name" 
                                   placeholder="e.g. view-dashboard" 
                                   required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer bg-white border-top-0 d-flex justify-content-start gap-2 pb-4 px-4">
                        @if(isset($permission))
                            <button type="submit" class="btn btn-primary btn-premium px-4"><i class="fas fa-save mr-1"></i> Update Entry</button>
                            <a href="{{ route('permission.index') }}" class="btn btn-light btn-premium ml-2"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
                        @else
                            <button type="submit" class="btn btn-primary btn-premium px-4"><i class="fas fa-plus-circle mr-1"></i> Register Entry</button>
                            <button type="reset" class="btn btn-light btn-premium ml-2"><i class="fas fa-undo-alt mr-1"></i> Reset</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Global Permission Registry -->
        <div class="col-md-7">
            <div class="card premium-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-lock text-primary"></i> 
                        Global Permission Registry
                    </h3>
                </div>
                <div class="card-body">
                    @if($permissions->count() == 0)
                        <div class="text-center py-5">
                            <i class="fas fa-lock-open text-muted fa-3x mb-3"></i>
                            <h5 class="text-secondary">No Permissions Registered</h5>
                            <p class="text-muted">Register a new key descriptor to assign capabilities.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table premium-table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">Index</th>
                                        <th>Key Identifier</th>
                                        <th style="width: 150px" class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $key => $value)
                                        <tr>
                                            <td class="font-weight-bold text-secondary">{{ $permissions->firstItem() + $key }}</td>
                                            <td>
                                                <div class="key-badge">
                                                    <div class="key-badge-circle">
                                                        <i class="fas fa-fingerprint"></i>
                                                    </div>
                                                    <span class="key-badge-text">{{ $value->name }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                                                    <a href="{{ route('permission.edit', $value->id) }}" class="btn btn-operation btn-operation-edit" title="Edit Permission">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('permission.destroy', $value->id) }}" method="POST" class="d-inline delete-form-confirm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-operation btn-operation-delete" title="Delete Permission">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {!! $permissions->links('pagination::bootstrap-4') !!}
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
    $('.delete-form-confirm').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Delete Permission?',
            text: "This will permanently remove this permission from all associated roles and users.",
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