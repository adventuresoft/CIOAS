@extends('backend.master', ['mainMenu' => 'InstitutionalAdmin', 'subMenu' =>'InstitutionalAdminCreate'])

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

@section('title', 'Institutional Admin Edit')

@section('content')
<div class="container-fluid py-4" style="min-height: 1000px;">
    
    <!-- Content Header -->
    <div class="row mb-3">
        <div class="col-sm-6">
            <h1 class="h3 font-weight-bold text-dark">Institutional Admin Edit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{route('institutional-admin.index')}}">Institutional Admin</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>

    <div class="card premium-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-edit text-primary"></i> 
                Modify Institutional Admin Details
            </h3>
        </div>

        <form id="institionalForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="card-body">
                <div class="row">
                    <!-- Left Side: Basic Profile Information -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="name">Admin Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" 
                                       class="form-control form-control-premium" 
                                       value="{{ $admin->name }}" 
                                       placeholder="Institutional Super Admin Name" required>
                                <small class="error name-error text-danger"></small>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" 
                                       class="form-control form-control-premium" 
                                       value="{{ $admin->email }}" 
                                       placeholder="email@example.com" required>
                                <small class="error email-error text-danger"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="mobile">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" id="mobile" 
                                       class="form-control form-control-premium" 
                                       value="{{ $admin->mobile }}" 
                                       placeholder="e.g. 01700000000" required>
                                <small class="error mobile-error text-danger"></small>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="form-control form-control-premium">
                                    <option value="">-- Select Department --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $admin->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }} ({{ $department->bn_name }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="error department_id-error text-danger"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="section_id">Section</label>
                                <select name="section_id" id="section_id" class="form-control form-control-premium">
                                    <option value="">-- Select Section --</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}" {{ $admin->section_id == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }} ({{ $section->bn_name }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="error section_id-error text-danger"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="password">Access Password (Optional)</label>
                                <input type="password" name="password" id="password" 
                                       class="form-control form-control-premium" 
                                       placeholder="Leave blank to keep current password">
                                <small class="error password-error text-danger"></small>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control form-control-premium" 
                                       placeholder="Repeat password">
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Account Role info -->
                    <div class="col-md-4 border-left pl-md-4">
                        <div class="mb-4">
                            <h5 class="font-weight-bold text-dark mb-3">
                                <i class="fas fa-shield-alt text-secondary mr-1"></i> Account Role
                            </h5>
                            
                            <div class="form-group mb-3">
                                <label class="form-label-premium" for="role_id">Primary Security Role <span class="text-danger">*</span></label>
                                <select name="role_id" id="role_id" class="form-control form-control-premium" required>
                                    <option value="" disabled selected>Select a Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="error role_id-error text-danger"></small>
                            </div>

                            <div class="alert alert-info mt-3" style="border-radius: 8px;">
                                <strong>Institutional Admin</strong>
                                <p class="text-sm mb-0 mt-1">This operator has administrative control for your specific institution/office level.</p>
                            </div>

                            <!-- Account Status -->
                            <div class="mb-4 mt-4 pt-3 border-top">
                                <h5 class="font-weight-bold text-dark mb-3">
                                    Account Status
                                </h5>
                                
                                <div class="form-check pl-0">
                                    <label class="status-radio-label text-success">
                                        <input type="radio" name="status" value="1" {{ $admin->status == 1 ? 'checked' : '' }}>
                                        Verified / Active
                                    </label>
                                </div>
                                <div class="form-check pl-0">
                                    <label class="status-radio-label text-warning">
                                        <input type="radio" name="status" value="0" {{ $admin->status == 0 ? 'checked' : '' }}>
                                        Pending Review
                                    </label>
                                </div>
                                <small class="error status-error text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="card-footer bg-white border-top-0 d-flex justify-content-start pb-4 px-4">
                <button type="submit" class="btn btn-info btn-premium px-5 py-2 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-check-circle mr-1"></i> Update Admin</button>
                <a href="{{ route('institutional-admin.index') }}" class="btn btn-light btn-premium ml-3 px-4 py-2 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
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
                    url: "{{ route('basic-settings.get-sections-by-department', '') }}/" + departmentId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, section) {
                            sectionSelect.append('<option value="' + section.id + '">' + section.name + ' (' + (section.bn_name ? section.bn_name : '') + ')</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to load sections: " + error);
                    }
                });
            }
        });

        $("#institionalForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            // Clear previous errors
            thisForm.find('.error').text('');
            
            $.ajax({
                type: "POST",
                url: "{{route('institutional-admin.update', $admin->id)}}",
                data: new FormData(this),
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{route('institutional-admin.index')}}";
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    if (responseText.errors) {
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                }
            });
        })
    })
</script>
@endpush
