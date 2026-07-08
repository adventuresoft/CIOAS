@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'Create'])
@section('title', 'Staff Create')
@section('content')

    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form class="form-horizontal" id="peoplePersonalForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            @include('backend.pages.staff.tabs.tab_header', ['user' => $user, 'active_tab' => 'personal'])
                        </div>

                        <div class="cioas-panel-body">
                            <!-- Row 1: Name, Name Bangla, NID No. -->
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="name">Name <span class="text-danger" title="Required"
                                            data-toggle="tooltip">*</span></label>
                                    <input type="text" required value="{{ $user->name ?? '' }}" class="form-control"
                                        name="name" id="name" placeholder="Name English" style="text-transform:uppercase">
                                    <small class="error name-error text-danger"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="bn_name">Name Bangla <span class="text-danger" title="Required"
                                            data-toggle="tooltip">*</span></label>
                                    <input type="text" required value="{{ $user->people->bn_name ?? '' }}"
                                        class="form-control" name="bn_name" id="bn_name" placeholder="নাম (বাংলা)" data-bangla-only="true">
                                    <small class="error bn_name-error text-danger"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nid">NID No.</label>
                                    <input type="text" value="{{ $user->nid ?? '' }}" name="nid" placeholder="NID No."
                                        class="form-control" id="nid" inputmode="numeric" maxlength="17">
                                    <span class="error nid-error text-danger"></span>
                                </div>
                            </div>

                            <!-- Row 2: Date of Birth, Age, Birth Place, Birth Reg. No. -->
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" value="{{ $user->people->date_of_birth ?? '' }}"
                                        name="date_of_birth" class="form-control" id="date_of_birth">
                                    <small class="error date_of_birth-error text-danger"></small>
                                </div>
                                <div class="col-sm-2">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" id="age" readonly
                                        placeholder="Auto">
                                    <small class="error age-error text-danger"></small>
                                </div>
                                <div class="col-sm-3">
                                    <label for="birth_place">Birth Place</label>
                                    <select name="birth_place" class="form-control" id="birth_place">
                                        <option value="">Select Birth Place</option>
                                        @if (count($districts))
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" {{isset($user->people->birth_place) ? (($user->people->birth_place == $district->id) ? 'selected' : '') : ''}}>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="error birth_place-error text-danger"></small>
                                </div>
                                <div class="col-sm-4">
                                    <label for="birth_certificate">Birth Reg. No.</label>
                                    <input type="text" value="{{ $user->birth_certificate ?? '' }}"
                                        name="birth_certificate" placeholder="Birth Reg. No." class="form-control"
                                        id="birth_certificate" inputmode="numeric" maxlength="17">
                                    <small class="error birth_certificate-error text-danger"></small>
                                </div>
                            </div>




                            <!-- Row 3: Blood Group, Gender, Religion, Mobile No., Email -->
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <label for="blood_group" style="white-space:nowrap; font-size:0.95rem;">Blood Group</label>
                                    <select name="blood_group" class="form-control" id="blood_group">
                                        <option value="">Select</option>
                                        @if (count(people_constant_option('blood_group')))
                                            @foreach (people_constant_option('blood_group') as $key => $item)
                                                <option value="{{ $key }}" {{isset($user->people->blood_group) ? (($user->people->blood_group == $key) ? 'selected' : '') : ''}}>{{ $item }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="error blood_group-error text-danger"></small>
                                </div>
                                <div class="col-sm-2">
                                    <label for="gender" style="display:block; text-align:center;">Gender</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="">Select</option>
                                        @if (count(people_constant_option('gender')))
                                            @foreach (people_constant_option('gender') as $key => $item)
                                                <option value="{{ $key }}" {{isset($user->people->gender) ? (($user->people->gender == $key) ? 'selected' : '') : ''}}>{{ $item }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="error gender-error text-danger"></small>
                                </div>
                                <div class="col-sm-2">
                                    <label for="religion">Religion</label>
                                    <select name="religion" class="form-control" id="religion">
                                        <option value="">Select</option>
                                        @if (count($religions))
                                            @foreach ($religions as $religion)
                                                <option value="{{ $religion->id }}" {{isset($user->people->religion_id) ? (($user->people->religion_id == $religion->id) ? 'selected' : '') : ''}}>
                                                    {{ $religion->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="error religion-error text-danger"></small>
                                </div>
                                <div class="col-sm-2">
                                    <label for="mobile">Mobile No.</label>
                                    <input type="tel" required value="{{ $user->mobile ?? '' }}" name="mobile"
                                        placeholder="Mobile" class="form-control" id="mobile" inputmode="numeric" maxlength="11">
                                    <small class="error mobile-error text-danger"></small>
                                </div>
                                <div class="col-sm-5">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ $user->email ?? '' }}" name="email"
                                        placeholder="Email" class="form-control" id="email">
                                    <small class="error email-error text-danger"></small>
                                </div>
                            </div>





                            <!-- Row 6: Photo with Preview -->
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="image">Photo</label>
                                    <input type="file" name="image" class="form-control-file" id="image">
                                    <span class="error image-error text-danger"></span>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-fluid img-thumbnail"
                                        src="{{ $user->image ? asset($user->image) : asset('public/no-image-found.jpeg') }}"
                                        id="preview" alt="Preview" width="100" height="100">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="signature">Signature</label>
                                    <input type="file" name="signature" class="form-control-file" id="signature">
                                    <span class="error signature-error text-danger"></span>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-fluid img-thumbnail"
                                        src="{{ $user->signature ? asset($user->signature) : asset('public/no-image-found.jpeg') }}"
                                        id="signature_preview" alt="Preview" width="100" height="100">
                                </div>
                            </div>
                        </div>
                        <div class="cioas-actions">
                            <a href="{{ route('staff.index') }}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update & Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Calculate age on page load if date of birth exists
            calculateAge();

            // Age calculation on date change
            $('#date_of_birth').on('change', function () {
                calculateAge();
            });

            function calculateAge() {
                let dob = $('#date_of_birth').val();
                if (dob) {
                    let birthDate = new Date(dob);
                    let today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    let monthDiff = today.getMonth() - birthDate.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    $('#age').val(age + ' years');
                } else {
                    $('#age').val('');
                }
            }

            // Form submission
            $("#peoplePersonalForm").on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);

                // Validate NID No. length
                let nidVal = $('#nid').val();
                if (nidVal.length > 0 && nidVal.length < 10) {
                    $('.nid-error').text('NID No. must be at least 10 digits.');
                    return;
                }
                // Validate Birth Reg. No. length
                let birthCertVal = $('#birth_certificate').val();
                if (birthCertVal.length > 0 && birthCertVal.length < 10) {
                    $('.birth_certificate-error').text('Birth Reg. No. must be at least 10 digits.');
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('staff.update', $user->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = response.redirect_url;
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function (key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            });
            // Name field: English only + auto uppercase
            $('#name').on('input', function () {
                let val = $(this).val();
                let cleaned = val.replace(/[^a-zA-Z\s.\-']/g, '').toUpperCase();
                if (val !== cleaned) {
                    let pos = this.selectionStart - (val.length - cleaned.length);
                    $(this).val(cleaned);
                    this.setSelectionRange(pos, pos);
                }
            });

            // Name Bangla field: Bangla only
            $('#bn_name').on('input', function () {
                let val = $(this).val();
                let cleaned = val.replace(/[^\u0980-\u09FF\s]/g, '');
                if (val !== cleaned) {
                    let pos = this.selectionStart - (val.length - cleaned.length);
                    $(this).val(cleaned);
                    this.setSelectionRange(pos, pos);
                }
            });

            // NID No., Birth Reg. No. & Mobile No.: digits only
            $('#nid, #birth_certificate, #mobile').on('input', function () {
                let val = $(this).val();
                let cleaned = val.replace(/[^0-9]/g, '');
                if (val !== cleaned) {
                    let pos = this.selectionStart - (val.length - cleaned.length);
                    $(this).val(cleaned);
                    this.setSelectionRange(pos, pos);
                }
            });
        });

        // Birth place change handler
        $(document).on('change', '#birth_place', function (e) {
            e.preventDefault();
        });

        // Image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    </script>
@endpush