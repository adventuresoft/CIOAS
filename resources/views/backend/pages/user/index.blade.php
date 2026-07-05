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
        <div class="cioas-panel">
            <div class="cioas-panel-header">
                <h3 class="cioas-panel-title">
                    <i class="fas fa-users"></i> Employee Directory
                </h3>
                @if(in_array(auth()->user()->user_type, ['admin', 'developer']))
                <a href="{{ route('user.create') }}" class="btn btn-material btn-material-primary" style="background-color: #0f766e; border-color: #0f766e; color: white;">
                    <i class="fas fa-plus-circle"></i> Add New Employee
                </a>
                @endif
            </div>
            <div class="cioas-panel-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label class="text-secondary" style="font-size: 0.85rem; font-weight: 600;">Filter by Department</label>
                        <select id="filter_department" class="form-control form-control-premium">
                            <option value="">All Departments</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="text-secondary" style="font-size: 0.85rem; font-weight: 600;">Filter by Section</label>
                        <select id="filter_section" class="form-control form-control-premium">
                            <option value="">All Sections</option>
                            @foreach($sections as $sec)
                                <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" id="clear_filters" class="btn btn-outline-danger w-100" style="padding: 0.375rem 0.75rem;">
                            <i class="fas fa-times-circle mr-1"></i> Clear Filters
                        </button>
                    </div>
                </div>
                {!! $dataTable->table(['class' => 'table table-bordered table-striped cioas-datatable w-100']) !!}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Trigger datatable reload when filters change
            $('#filter_department, #filter_section').on('change', function() {
                window.LaravelDataTables["user-table"].ajax.reload();
            });

            // Clear filters button
            $('#clear_filters').on('click', function() {
                $('#filter_department').val('');
                $('#filter_section').val('');
                window.LaravelDataTables["user-table"].ajax.reload();
            });

            // Load sections when department changes
            $('#filter_department').on('change', function () {
                var departmentId = $(this).val();
                var sectionSelect = $('#filter_section');

                sectionSelect.html('<option value="">All Sections</option>');

                if (departmentId) {
                    $.ajax({
                        url: "{{ route('basic-settings.get-sections-by-department', '') }}/" + departmentId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $.each(data, function (key, section) {
                                sectionSelect.append('<option value="' + section.id + '">' + section.name + ' (' + (section.bn_name ? section.bn_name : '') + ')</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error("Failed to load sections: " + error);
                        }
                    });
                }
            });

            // Make rows clickable to view profile
            $('#user-table').on('click', 'tbody tr', function(e) {
                if ($(e.target).closest('a, button').length > 0) return;
                
                var rowId = $(this).attr('id');
                if (rowId) {
                    window.location.href = "{{ url('dashboard/user') }}/" + rowId;
                }
            });

            // Add pointer cursor to rows
            $('#user-table').on('mouseenter', 'tbody tr', function() {
                $(this).css('cursor', 'pointer');
            });
        });
    </script>
@endpush