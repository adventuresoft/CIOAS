@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', 'Modify Authorized Employee')

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
            padding: 12px 16px;
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

        .form-label-premium {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.92rem;
            margin-bottom: 8px;
        }

        /* Custom Radio styling */
        .status-radio-label {
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4" style="min-height: 1000px;">

        <!-- Top Tabs Navigation -->
        @include('backend.pages.access-nav-tabs')

        <!-- Alert Notifications -->
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                style="border-left: 5px solid #ef4444;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card premium-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-edit text-primary"></i>
                    Modify Authorized Employee : {{ $user->name }}
                </h3>
            </div>

            <form role="form" method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="row">
                        <!-- Left Side: Basic Profile Information -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="name">Full Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-premium @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter Full Name" required>
                                    @error('name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="email">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control form-control-premium @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" placeholder="email@example.com" required>
                                    @error('email')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="mobile">Contact Number</label>
                                    <input type="text" name="mobile" id="mobile"
                                        class="form-control form-control-premium @error('mobile') is-invalid @enderror"
                                        value="{{ old('mobile', $user->mobile) }}" placeholder="e.g. 01700000000" required>
                                    @error('mobile')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="institute_id">Assigned Area</label>
                                    <select name="institute_id" id="institute_id"
                                        class="form-control form-control-premium @error('institute_id') is-invalid @enderror"
                                        required>
                                        <option value="" disabled>-- Select Area --</option>
                                        @foreach ($institutes as $institute)
                                            @php
                                                $name = '';
                                                if ($institute->institute_type_id == 1) {
                                                    $name =
                                                        ($institute->union->name ?? '') .
                                                        ' (' .
                                                        ($institute->type->name ?? 'Union') .
                                                        ')';
                                                } elseif ($institute->institute_type_id == 2) {
                                                    $name =
                                                        ($institute->pourashava->name ?? '') .
                                                        ' (' .
                                                        ($institute->type->name ?? 'Pourashava') .
                                                        ')';
                                                } elseif ($institute->institute_type_id == 3) {
                                                    $name =
                                                        ($institute->cityCorporation->name ?? '') .
                                                        ' (' .
                                                        ($institute->type->name ?? 'City Corp') .
                                                        ')';
                                                } elseif ($institute->institute_type_id == 4) {
                                                    $name =
                                                        ($institute->district->name ?? '') .
                                                        ' (' .
                                                        ($institute->type->name ?? 'District') .
                                                        ')';
                                                } else {
                                                    $name = 'Area ID: ' . $institute->id;
                                                }

                                                if (!empty($institute->district->name)) {
                                                    $name .= ' - District: ' . $institute->district->name;
                                                }
                                            @endphp
                                            <option value="{{ $institute->id }}"
                                                {{ old('institute_id', $user->institute_id) == $institute->id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('institute_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="department_id">Department</label>
                                    <select name="department_id" id="department_id"
                                        class="form-control form-control-premium @error('department_id') is-invalid @enderror">
                                        <option value="" selected>-- Select Department --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }} ({{ $department->bn_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="section_id">Section</label>
                                    <select name="section_id" id="section_id"
                                        class="form-control form-control-premium @error('section_id') is-invalid @enderror">
                                        <option value="" selected>-- Select Section --</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ old('section_id', $user->section_id) == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }} ({{ $section->bn_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="password">Access Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-premium @error('password') is-invalid @enderror"
                                        placeholder="Leave blank to keep current password" autocomplete="new-password">
                                    <small class="text-muted d-block mt-1">Leave blank if password remains
                                        unchanged.</small>
                                    @error('password')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mb-4">
                                    <label class="form-label-premium" for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control form-control-premium" placeholder="Repeat password" autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Security Identity & Account Status -->
                        <div class="col-md-4 border-left pl-md-4">
                            <!-- Security Identity -->
                            <div class="mb-4">
                                <h5 class="font-weight-bold text-dark mb-3">
                                    <i class="fas fa-shield-alt text-secondary mr-1"></i> Security Identity
                                </h5>

                                <div class="form-group mb-3">
                                    <label class="form-label-premium" for="user_type">User Type</label>
                                    <select name="user_type" id="user_type"
                                        class="form-control form-control-premium @error('user_type') is-invalid @enderror"
                                        required>
                                        <option value="">Select User Type</option>
                                        <option value="staff" {{ old('user_type', $user->user_type) == 'staff' ? 'selected' : '' }}>Employee</option>
                                        <option value="admin" {{ old('user_type', $user->user_type) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <br>
                                    <label class="form-label-premium" for="role_id">Primary Security Role</label>
                                    <select name="role_id" id="role_id"
                                        class="form-control form-control-premium @error('role_id') is-invalid @enderror"
                                        required>
                                        <option value="">Select a Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted mt-2 d-block">
                                        Users inherit all capabilities assigned to their chosen role. Direct overrides are
                                        disabled for simplicity.
                                    </small>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Account Status -->
                            <div class="mb-4">
                                <label class="form-label-premium">Account Status</label>

                                <div class="form-check pl-0">
                                    <label class="status-radio-label text-success">
                                        <input type="radio" name="status" value="1" {{ old('status', $user->status) == '1' ? 'checked' : '' }}
                                            style="width: 18px; height: 18px; cursor: pointer;">
                                        Verified / Active
                                    </label>
                                </div>

                                <div class="form-check pl-0">
                                    <label class="status-radio-label text-warning">
                                        <input type="radio" name="status" value="0" {{ old('status', $user->status) == '0' ? 'checked' : '' }}
                                            style="width: 18px; height: 18px; cursor: pointer;">
                                        Pending Review
                                    </label>
                                </div>
                                @error('status')
                                    <span class="text-danger small font-weight-bold d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="card-footer bg-white border-top-0 d-flex justify-content-start pb-4 px-4">
                    <button type="submit" class="btn btn-primary btn-premium px-5 py-2 font-weight-bold"
                        style="border-radius: 8px;"><i class="fas fa-check-circle mr-1"></i> Update Employee</button>
                    <a href="{{ route('user.index') }}" class="btn btn-light btn-premium ml-3 px-4 py-2 font-weight-bold"
                        style="border-radius: 8px;"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#department_id').on('change', function() {
                var departmentId = $(this).val();
                var sectionSelect = $('#section_id');

                sectionSelect.html('<option value="">-- Select Section --</option>');

                if (departmentId) {
                    $.ajax({
                        url: "{{ route('basic-settings.get-sections-by-department', '') }}/" +
                            departmentId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $.each(data, function(key, section) {
                                sectionSelect.append('<option value="' + section.id +
                                    '">' + section.name + ' (' + (section.bn_name ?
                                        section.bn_name : '') + ')</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to load sections: " + error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
