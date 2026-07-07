@extends('backend.master', ['mainMenu' => 'Admin', 'subMenu' =>'AdminList'])
@push('style')
@endpush
@section('title', 'Institutional Admin Edit')
@section('content')

    <section class="content mt-4">
        <div class="container-fluid">
            <form id="institionalForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card cioas-shell">
                    <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-dark font-weight-bold mb-0">
                            <i class="fas fa-user-edit text-teal mr-2" style="color: #0f766e;"></i> Modify Institutional Admin Details
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Left Side: Basic Profile Information -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="premium-form-label" for="name">Admin Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" 
                                               class="form-control premium-form-control" 
                                               value="{{ $admin->name }}" 
                                               placeholder="Institutional Super Admin Name" required>
                                        <small class="error name-error text-danger"></small>
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label class="premium-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" 
                                               class="form-control premium-form-control" 
                                               value="{{ $admin->email }}" 
                                               placeholder="email@example.com" required>
                                        <small class="error email-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="premium-form-label" for="mobile">Contact Number <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" id="mobile" 
                                               class="form-control premium-form-control" 
                                               value="{{ $admin->mobile }}" 
                                               placeholder="e.g. 01700000000" required>
                                        <small class="error mobile-error text-danger"></small>
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label class="premium-form-label" for="department_id">Department</label>
                                        <select name="department_id" id="department_id" class="form-control premium-form-control select2">
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
                                        <label class="premium-form-label" for="section_id">Section</label>
                                        <select name="section_id" id="section_id" class="form-control premium-form-control select2">
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
                                        <label class="premium-form-label" for="password">Access Password (Optional)</label>
                                        <input type="password" name="password" id="password" 
                                               class="form-control premium-form-control" 
                                               placeholder="Leave blank to keep current password">
                                        <small class="error password-error text-danger"></small>
                                    </div>

                                    <div class="col-md-6 form-group mb-4">
                                        <label class="premium-form-label" for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" 
                                               class="form-control premium-form-control" 
                                               placeholder="Repeat password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group mb-4">
                                        <label class="premium-form-label" for="image">Profile Image</label>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($admin->image)
                                                <img src="{{ asset($admin->image) }}" alt="Profile" class="rounded-circle border" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endif
                                            <input type="file" name="image" id="image" 
                                                   class="form-control premium-form-control p-1" accept="image/*">
                                        </div>
                                        <small class="text-muted">Leave blank to keep current image</small>
                                        <small class="error image-error text-danger d-block"></small>
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
                                        <label class="premium-form-label" for="role_id">Primary Security Role <span class="text-danger">*</span></label>
                                        <select name="role_id" id="role_id" class="form-control premium-form-control select2" required>
                                            <option value="" disabled selected>Select a Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $admin->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="error role_id-error text-danger"></small>
                                    </div>

                                    <div class="alert alert-info mt-3" style="border-radius: 8px; border-left: 4px solid #0ea5e9;">
                                        <strong>Institutional Admin</strong>
                                        <p class="text-sm mb-0 mt-1">This operator has administrative control for your specific institution/office level.</p>
                                    </div>

                                    <!-- Account Status -->
                                    <div class="mb-4 mt-4 pt-3 border-top">
                                        <h5 class="font-weight-bold text-dark mb-3">
                                            Account Status
                                        </h5>
                                        
                                        <div class="form-check pl-0">
                                            <label class="text-success font-weight-bold">
                                                <input type="radio" name="status" value="1" {{ $admin->status == 1 ? 'checked' : '' }}>
                                                Verified / Active
                                            </label>
                                        </div>
                                        <div class="form-check pl-0">
                                            <label class="text-warning font-weight-bold">
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
                </div>
                
                <div class="card cioas-shell mt-4">
                    <div class="card-body d-flex justify-content-end p-3" style="gap: 15px;">
                        <a href="{{ route('institutional-admin.index') }}" class="btn btn-premium-cancel">Cancel</a>
                        <button type="submit" class="btn btn-premium-submit">Update Admin</button>
                    </div>
                </div>

            </form>
        </div>
    </section>

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
