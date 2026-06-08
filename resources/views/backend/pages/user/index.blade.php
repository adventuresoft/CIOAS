@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', 'Employees Directory')

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

        /* Employee Profile Avatar */
        .avatar-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #eff6ff;
            color: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.05rem;
            border: 1.5px solid #dbeafe;
        }

        /* Search Bar Input Design */
        .search-wrapper {
            position: relative;
            max-width: 400px;
        }

        .search-wrapper .fa-search {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .search-wrapper input {
            padding-left: 40px;
            border-radius: 8px;
        }

        /* Operation Buttons matching Image 4 */
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

        .btn-operation-view {
            background-color: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
        }

        .btn-operation-view:hover {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-operation-edit {
            background-color: #fff7ed;
            color: #f97316;
            border-color: #ffedd5;
        }

        .btn-operation-edit:hover {
            background-color: #f97316;
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

        /* Verified Badges */
        .badge-verified {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4" style="min-height: 1000px;">

        <!-- Top Tabs Navigation -->
        @include('backend.pages.access-nav-tabs')

        <!-- Alert Notifications -->
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                style="border-left: 5px solid #10b981;">
                <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                style="border-left: 5px solid #ef4444;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Active Employee Registry -->
        <div class="card premium-card">

            <div class="card-body">
                <!-- Search Filter Bar -->
                <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" class="form-control form-control-premium"
                            placeholder="Search by name, email, mobile, or ID..." value="{{ request('search') }}">
                    </div>
                </form>

                @if($users->count() == 0)
                    <div class="text-center py-5">
                        <i class="fas fa-user-slash text-muted fa-3x mb-3"></i>
                        <h5 class="text-secondary">No Employees Registered</h5>
                        <p class="text-muted">Register a new Employee to assign security permissions.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table premium-table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 60px">#</th>
                                    <th>Employee Profile</th>
                                    <th>Contact & Area</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                    <th style="width: 160px" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $item)
                                    @php
                                        $firstLetter = strtoupper(substr($item->name, 0, 1));

                                        // Format Area Name
                                        $areaName = 'No Area';
                                        if ($item->institute) {
                                            if ($item->institute->institute_type_id == 1) {
                                                $areaName = ($item->institute->union->name ?? '') . ' (' . ($item->institute->type->name ?? 'Union') . ')';
                                            } elseif ($item->institute->institute_type_id == 2) {
                                                $areaName = ($item->institute->pourashava->name ?? '') . ' (' . ($item->institute->type->name ?? 'Pourashava') . ')';
                                            } elseif ($item->institute->institute_type_id == 3) {
                                                $areaName = ($item->institute->cityCorporation->name ?? '') . ' (' . ($item->institute->type->name ?? 'City Corp') . ')';
                                            } elseif ($item->institute->institute_type_id == 4) {
                                                $areaName = ($item->institute->district->name ?? '') . ' (' . ($item->institute->type->name ?? 'District') . ')';
                                            } else {
                                                $areaName = 'Area ID: ' . $item->institute->id;
                                            }

                                            if (!empty($item->institute->district->name)) {
                                                $areaName .= ' - District: ' . $item->institute->district->name;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td class="font-weight-bold text-secondary">{{ $users->firstItem() + $key }}</td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 12px;">
                                                @if(!empty($item->image) && file_exists(public_path('upload/users/images/' . $item->image)))
                                                    <img src="{{ asset('upload/users/images/' . $item->image) }}" class="rounded-circle"
                                                        width="44" height="44"
                                                        style="object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                                @else
                                                    <div class="avatar-circle">{{ $firstLetter }}</div>
                                                @endif
                                                <div>
                                                    <div class="font-weight-bold text-dark">{{ $item->name }}</div>
                                                    <div class="text-muted" style="font-size: 0.82rem;">{{ $item->email }}</div>
                                                    <div class="text-secondary" style="font-size: 0.8rem;"><i
                                                            class="fas fa-id-card mr-1"></i> {{ $item->system_id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="text-dark"><i class="fas fa-phone-alt text-secondary mr-2"
                                                        style="font-size: 0.85rem;"></i>{{ $item->mobile ?? 'N/A' }}</div>
                                                <div class="text-secondary" style="font-size: 0.85rem;"><i
                                                        class="fas fa-map-marker-alt text-danger mr-2"
                                                        style="font-size: 0.85rem;"></i>{{ $areaName }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->roles->count() > 0)
                                                @foreach($item->roles as $role)
                                                    <span class="badge text-white px-2 py-1"
                                                        style="background-color: #0ea5e9; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                                        <i class="fas fa-user-shield" style="font-size: 0.8rem;"></i> {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted font-italic" style="font-size: 0.85rem;">No role</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                                <span class="badge-verified"><i class="fas fa-check-circle"></i> Verified</span>
                                            @else
                                                <span class="badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                                                <a href="{{ route('user.show', $item->id) }}"
                                                    class="btn btn-operation btn-operation-view" title="View Employee Profile">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('user.edit', $item->id) }}"
                                                    class="btn btn-operation btn-operation-edit" title="Modify Employee Profile">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    class="d-inline delete-form-confirm">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-operation btn-operation-delete"
                                                        title="Delete Employee">
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
                        {!! $users->appends(request()->input())->links('pagination::bootstrap-4') !!}
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
                    title: 'Delete Employee Account?',
                    text: "This will permanently revoke all security clearance, roles, and profiles mapped to this user.",
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