@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'Create'])
@section('title', 'Staff Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staff Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            @include('backend.pages.staff.tabs.tab_header', [
                                'user' => $user,
                                'active_tab' => 'professional',
                            ])
                        </div>
                        <form class="form-horizontal" id="peopleProfessionalForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="card-body" id="multiple-profession">
                                @if (count($user->professionalInfos))
                                    @foreach ($user->professionalInfos as $professionalInfo)
                                        <div class="single-profession border p-3 mb-3 position-relative rounded">
                                            <div class="position-absolute" style="top: 10px; right: 10px;">
                                                <button type="button" data-id="{{ $professionalInfo->id }}" class="btn btn-danger btn-sm deleteBtn"><i class="fas fa-times"></i></button>
                                            </div>
                                            <h5 class="mb-3 text-info">Employment Details</h5>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Recruitment Notice No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="recruitment_notice_noU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->recruitment_notice_no ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Appointment Letter No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="appointment_letter_noU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->appointment_letter_no ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Designation at Joining</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="designation_joiningU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->designation_joining ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date of Joining</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="date_of_joiningU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->date_of_joining ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Department</label>
                                                <div class="col-sm-9">
                                                    <select name="departmentU[{{ $professionalInfo->id }}]" class="form-control department-select">
                                                        <option value="">-- Select Department --</option>
                                                        @foreach($departments as $department)
                                                            <option value="{{ $department->id }}" {{ $professionalInfo->department == $department->id ? 'selected' : '' }}>
                                                                {{ $department->name }} ({{ $department->bn_name }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Section</label>
                                                <div class="col-sm-9">
                                                    <select name="current_designationU[{{ $professionalInfo->id }}]" class="form-control section-select" data-selected="{{ $professionalInfo->current_designation }}">
                                                        <option value="">-- Select Section --</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date of Current Designation</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="date_current_designationU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->date_current_designation ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Current Workplace</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="current_workplaceU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->current_workplace ?? '' }}" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Date of Joining Current Workplace</label>
                                                <div class="col-sm-9">
                                                    <input type="date" name="date_joining_current_workplaceU[{{ $professionalInfo->id }}]" value="{{ $professionalInfo->date_joining_current_workplace ?? '' }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="single-profession border p-3 mb-3 position-relative rounded">
                                        <div class="position-absolute" style="top: 10px; right: 10px;">
                                            <button type="button" class="btn btn-danger btn-sm removeBtn"><i class="fas fa-times"></i></button>
                                        </div>
                                        <h5 class="mb-3 text-info">Employment Details</h5>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Recruitment Notice No.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="recruitment_notice_no[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Appointment Letter No.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="appointment_letter_no[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Designation at Joining</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="designation_joining[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Joining</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="date_of_joining[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Department</label>
                                            <div class="col-sm-9">
                                                <select name="department[]" class="form-control department-select">
                                                    <option value="">-- Select Department --</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->name }} ({{ $department->bn_name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Section</label>
                                            <div class="col-sm-9">
                                                <select name="current_designation[]" class="form-control section-select">
                                                    <option value="">-- Select Section --</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Current Designation</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="date_current_designation[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Current Workplace</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="current_workplace[]" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Joining Current Workplace</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="date_joining_current_workplace[]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-12 text-right mb-3">
                                <button type="button" class="btn btn-success" id="addNewProfession"><i class="fas fa-plus"></i> Add More Employment</button>
                            </div>

                            <div class="card-footer bg-white mt-3" style="border-top: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('staff.education', $user->id) }}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Education</a>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Next</button>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('staff.financial', $user->id) }}" class="btn btn-outline-primary btn-block" style="color: #5b4bdf; border-color: #5b4bdf;">Financial <i class="fas fa-arrow-right ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#peopleProfessionalForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('staff.professionalStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

        $("#addNewProfession").on('click', function() {
            let addNewProfession = `
            <div class="single-profession border p-3 mb-3 position-relative rounded">
                <div class="position-absolute" style="top: 10px; right: 10px;">
                    <button type="button" class="btn btn-danger btn-sm removeBtn"><i class="fas fa-times"></i></button>
                </div>
                <h5 class="mb-3 text-info">Employment Details</h5>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Recruitment Notice No.</label>
                    <div class="col-sm-9">
                        <input type="text" name="recruitment_notice_no[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Appointment Letter No.</label>
                    <div class="col-sm-9">
                        <input type="text" name="appointment_letter_no[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Designation at Joining</label>
                    <div class="col-sm-9">
                        <input type="text" name="designation_joining[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date of Joining</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_of_joining[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                        <select name="department[]" class="form-control department-select">
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }} ({{ $department->bn_name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Section</label>
                    <div class="col-sm-9">
                        <select name="current_designation[]" class="form-control section-select">
                            <option value="">-- Select Section --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date of Current Designation</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_current_designation[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Current Workplace</label>
                    <div class="col-sm-9">
                        <input type="text" name="current_workplace[]" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date of Joining Current Workplace</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_joining_current_workplace[]" class="form-control">
                    </div>
                </div>
            </div>`;

            $("#multiple-profession").append(addNewProfession);
        })

        $(document).on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            let _this =  $(this)
            let deleteID = _this.attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('dashboard/people/professional-delete') }}/" + deleteID,
                        success: function(response) {
                            Swal.fire('Deleted!', response.message, 'success' )
                            _this.closest('.single-profession').remove();
                        },
                        error: function(xhr, status, error) {
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                        }
                    });
                }
            })
        })

        $(document).on('click', '.removeBtn', function(e) {
            e.preventDefault();
            let _this =  $(this)

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Removed!', 'Removed Successfully', 'success' )
                    _this.closest('.single-profession').remove();
                }
            })
        })

        // Department change to fetch sections
        $(document).on('change', '.department-select', function() {
            let departmentId = $(this).val();
            let sectionSelect = $(this).closest('.single-profession').find('.section-select');
            let selectedSection = sectionSelect.attr('data-selected');
            
            sectionSelect.html('<option value="">-- Select Section --</option>');
            
            if (departmentId) {
                $.ajax({
                    url: "{{ route('basic-settings.get-sections-by-department', '') }}/" + departmentId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, section) {
                            let isSelected = (selectedSection == section.id) ? 'selected' : '';
                            sectionSelect.append('<option value="' + section.id + '" ' + isSelected + '>' + section.name + ' (' + (section.bn_name ? section.bn_name : '') + ')</option>');
                        });
                        sectionSelect.removeAttr('data-selected');
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to load sections: " + error);
                    }
                });
            }
        });

        // Trigger change for existing records on page load
        $('.department-select').each(function() {
            if ($(this).val()) {
                $(this).trigger('change');
            }
        });
    </script>
@endpush
