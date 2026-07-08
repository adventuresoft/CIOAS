@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' =>'Create'])
@section('title', 'Staff Create')
@section('content')
   <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                @include('backend.pages.staff.tabs.tab_header', ['user' => $user, 'active_tab' => 'education'])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleEducationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="mb-0" style="font-weight: 700; color: #5b4bdf !important;"><i class="fas fa-graduation-cap mr-2"></i> Educational Background</h4>
                                    <button type="button" id="addNewEducation" class="btn text-white px-3" style="background-color: #5b4bdf; border-color: #5b4bdf; border-radius: 6px; font-weight: 600;">
                                        <i class="fas fa-plus-circle mr-1"></i> Add More Info
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle" id="education-table">
                                        <thead>
                                            <tr style="border-bottom: 2px solid #e9ecef;">
                                                <th style="font-weight: 700; color: #333; width: 18%; padding-bottom: 12px;">Degree <span class="text-danger">*</span></th>
                                                <th style="font-weight: 700; color: #333; width: 15%; padding-bottom: 12px;">Group</th>
                                                <th style="font-weight: 700; color: #333; width: 12%; padding-bottom: 12px;">Grade</th>
                                                <th style="font-weight: 700; color: #333; width: 15%; padding-bottom: 12px;">Board</th>
                                                <th style="font-weight: 700; color: #333; width: 12%; padding-bottom: 12px;">Passing Year</th>
                                                <th style="font-weight: 700; color: #333; padding-bottom: 12px;">Educational Institute</th>
                                                <th style="font-weight: 700; color: #333; width: 8%; text-align: center; padding-bottom: 12px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="multiple-education">
                                            @if (count($user->educationInfos))
                                                @foreach ($user->educationInfos as $education)
                                                    <tr class="single-education-{{$education->id}}">
                                                        <td>
                                                            <select name="degree_idU[{{$education->id}}]" required class="form-control">
                                                                <option value="1" @if($education->degree_id == 1) selected @endif >PSC</option>
                                                                <option value="2" @if($education->degree_id == 2) selected @endif >JSC</option>
                                                                <option value="3" @if($education->degree_id == 3) selected @endif >SSC</option>
                                                                <option value="4" @if($education->degree_id == 4) selected @endif >HSC</option>
                                                                <option value="5" @if($education->degree_id == 5) selected @endif >Diploma</option>
                                                                <option value="6" @if($education->degree_id == 6) selected @endif >Bachelor of Arts (BA)</option>
                                                                <option value="7" @if($education->degree_id == 7) selected @endif >Bachelor of Science (BSc)</option>
                                                                <option value="8" @if($education->degree_id == 8) selected @endif >Bachelor of Business Administration (BBA)</option>
                                                                <option value="9" @if($education->degree_id == 9) selected @endif >Bachelor of Social Science (BSS)</option>
                                                                <option value="10" @if($education->degree_id == 10) selected @endif >Honours</option>
                                                                <option value="11" @if($education->degree_id == 11) selected @endif >Masters</option>
                                                                <option value="12" @if($education->degree_id == 12) selected @endif >MBA</option>
                                                                <option value="13" @if($education->degree_id == 13) selected @endif >M.Sc</option>
                                                                <option value="14" @if($education->degree_id == 14) selected @endif >M.A</option>
                                                                <option value="15" @if($education->degree_id == 15) selected @endif >M.Phil</option>
                                                                <option value="16" @if($education->degree_id == 16) selected @endif >PhD</option>
                                                                <option value="17" @if($education->degree_id == 17) selected @endif >Post Graduate Diploma (PGD)</option>
                                                                <option value="18" @if($education->degree_id == 18) selected @endif >LLB</option>
                                                                <option value="19" @if($education->degree_id == 19) selected @endif >MBBS</option>
                                                                <option value="20" @if($education->degree_id == 20) selected @endif >BDS</option>
                                                                <option value="21" @if($education->degree_id == 21) selected @endif >B.Ed</option>
                                                                <option value="22" @if($education->degree_id == 22) selected @endif >M.Ed</option>
                                                                <option value="23" @if($education->degree_id == 23) selected @endif >Engineering (BSc Eng)</option>
                                                                <option value="24" @if($education->degree_id == 24) selected @endif >Fazil</option>
                                                                <option value="25" @if($education->degree_id == 25) selected @endif >Kamil</option>
                                                                <option value="26" @if($education->degree_id == 26) selected @endif >Dakhil</option>
                                                                <option value="27" @if($education->degree_id == 27) selected @endif >Alim</option>
                                                                <option value="28" @if($education->degree_id == 28) selected @endif >Other</option>
                                                            </select>
                                                            <small class="text-danger error degree_idU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td>
                                                            <select name="group_idU[{{$education->id}}]" class="form-control">
                                                                <option value="1" @if($education->group_id == 1) selected @endif >Science</option>
                                                                <option value="2" @if($education->group_id == 2) selected @endif >Business</option>
                                                                <option value="3" @if($education->group_id == 3) selected @endif >Humanties</option>
                                                            </select>
                                                            <small class="text-danger error group_idU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td>
                                                            <select name="grade_idU[{{$education->id}}]" class="form-control">
                                                                <option value="1" @if($education->grade_id == 1) selected @endif >A+</option>
                                                                <option value="2" @if($education->grade_id == 2) selected @endif>A</option>
                                                                <option value="3" @if($education->grade_id == 3) selected @endif>A-</option>
                                                                <option value="4" @if($education->grade_id == 4) selected @endif>B+</option>
                                                                <option value="5" @if($education->grade_id == 5) selected @endif>B</option>
                                                                <option value="6" @if($education->grade_id == 6) selected @endif>B-</option>
                                                                <option value="7" @if($education->grade_id == 7) selected @endif>C+</option>
                                                                <option value="8" @if($education->grade_id == 8) selected @endif>C</option>
                                                                <option value="9" @if($education->grade_id == 9) selected @endif>D</option>
                                                                <option value="10" @if($education->grade_id == 10) selected @endif>F</option>
                                                            </select>
                                                            <small class="text-danger error grade_idU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td>
                                                            <select name="board_idU[{{$education->id}}]" class="form-control">
                                                                <option value="1" @if($education->board_id == 1) selected @endif >Dhaka</option>
                                                                <option value="2" @if($education->board_id == 2) selected @endif>Rajshashi</option>
                                                                <option value="3" @if($education->board_id == 3) selected @endif>Rangpur</option>
                                                                <option value="4" @if($education->board_id == 4) selected @endif>Jessore</option>
                                                                <option value="5" @if($education->board_id == 5) selected @endif>Comilla</option>
                                                                <option value="6" @if($education->board_id == 6) selected @endif>Sylhet</option>
                                                                <option value="7" @if($education->board_id == 7) selected @endif>Chittagong</option>
                                                            </select>
                                                            <small class="text-danger error board_idU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td>
                                                            <select name="passing_yearU[{{$education->id}}]" class="form-control">
                                                                <option value="">Select Year</option>
                                                                @foreach(range(date('Y'), 1960) as $yr)
                                                                    <option value="{{ $yr }}" @if($education->passing_year == $yr) selected @endif>{{ $yr }}</option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-danger error passing_yearU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="instituteU[{{$education->id}}]" value="{{$education->institute}}" placeholder="Educational Institute" class="form-control">
                                                            <small class="text-danger error instituteU[{{$education->id}}]_error"></small>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteEducation({{$education->id}})" style="background-color: #dc3545; border-color: #dc3545; padding: 6px 12px; border-radius: 4px;">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="single-education">
                                                    <td>
                                                        <select name="degree_id[]" required class="form-control">
                                                            <option value="1">PSC</option>
                                                            <option value="2">JSC</option>
                                                            <option value="3">SSC</option>
                                                            <option value="4">HSC</option>
                                                            <option value="5">Diploma</option>
                                                            <option value="6">Bachelor of Arts (BA)</option>
                                                            <option value="7">Bachelor of Science (BSc)</option>
                                                            <option value="8">Bachelor of Business Administration (BBA)</option>
                                                            <option value="9">Bachelor of Social Science (BSS)</option>
                                                            <option value="10">Honours</option>
                                                            <option value="11">Masters</option>
                                                            <option value="12">MBA</option>
                                                            <option value="13">M.Sc</option>
                                                            <option value="14">M.A</option>
                                                            <option value="15">M.Phil</option>
                                                            <option value="16">PhD</option>
                                                            <option value="17">Post Graduate Diploma (PGD)</option>
                                                            <option value="18">LLB</option>
                                                            <option value="19">MBBS</option>
                                                            <option value="20">BDS</option>
                                                            <option value="21">B.Ed</option>
                                                            <option value="22">M.Ed</option>
                                                            <option value="23">Engineering (BSc Eng)</option>
                                                            <option value="24">Fazil</option>
                                                            <option value="25">Kamil</option>
                                                            <option value="26">Dakhil</option>
                                                            <option value="27">Alim</option>
                                                            <option value="28">Other</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="group_id[]" class="form-control">
                                                            <option value="1">Science</option>
                                                            <option value="2">Business</option>
                                                            <option value="3">Humanties</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="grade_id[]" class="form-control">
                                                            <option value="1">A+</option>
                                                            <option value="2">A</option>
                                                            <option value="3">A-</option>
                                                            <option value="4">B+</option>
                                                            <option value="5">B</option>
                                                            <option value="6">B-</option>
                                                            <option value="7">C+</option>
                                                            <option value="8">C</option>
                                                            <option value="9">D</option>
                                                            <option value="10">F</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="board_id[]" class="form-control">
                                                            <option value="1">Dhaka</option>
                                                            <option value="2">Rajshashi</option>
                                                            <option value="3">Rangpur</option>
                                                            <option value="4">Jessore</option>
                                                            <option value="5">Comilla</option>
                                                            <option value="6">Sylhet</option>
                                                            <option value="7">Chittagong</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="passing_year[]" class="form-control">
                                                            <option value="">Select Year</option>
                                                            @foreach(range(date('Y'), 1960) as $yr)
                                                                <option value="{{ $yr }}">{{ $yr }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="institute[]" placeholder="Educational Institute" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-sm remove-single-education" style="background-color: #dc3545; border-color: #dc3545; padding: 6px 12px; border-radius: 4px;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer bg-white mt-3" style="border-top: none;">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('staff.address', $user->id) }}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Address</a>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Next</button>
        </div>
        <div class="col-md-4">
            <a href="{{ route('staff.professional', $user->id) }}" class="btn btn-outline-primary btn-block" style="color: #5b4bdf; border-color: #5b4bdf;">Profession <i class="fas fa-arrow-right ml-1"></i></a>
        </div>
    </div>
</div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@push('script')

    <script>
         $(document).ready(function() {
            $("#peopleEducationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('staff.educationStore') }}",
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
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })

            $("#addNewEducation").on('click', function () {
                var addNewEducation = '';

                addNewEducation += '<tr class="single-education">';
                    addNewEducation += '<td>';
                        addNewEducation += '<select name="degree_id[]" required class="form-control">';
                            addNewEducation += '<option value="1">PSC</option>';
                            addNewEducation += '<option value="2">JSC</option>';
                            addNewEducation += '<option value="3">SSC</option>';
                            addNewEducation += '<option value="4">HSC</option>';
                            addNewEducation += '<option value="5">Diploma</option>';
                            addNewEducation += '<option value="6">Bachelor of Arts (BA)</option>';
                            addNewEducation += '<option value="7">Bachelor of Science (BSc)</option>';
                            addNewEducation += '<option value="8">Bachelor of Business Administration (BBA)</option>';
                            addNewEducation += '<option value="9">Bachelor of Social Science (BSS)</option>';
                            addNewEducation += '<option value="10">Honours</option>';
                            addNewEducation += '<option value="11">Masters</option>';
                            addNewEducation += '<option value="12">MBA</option>';
                            addNewEducation += '<option value="13">M.Sc</option>';
                            addNewEducation += '<option value="14">M.A</option>';
                            addNewEducation += '<option value="15">M.Phil</option>';
                            addNewEducation += '<option value="16">PhD</option>';
                            addNewEducation += '<option value="17">Post Graduate Diploma (PGD)</option>';
                            addNewEducation += '<option value="18">LLB</option>';
                            addNewEducation += '<option value="19">MBBS</option>';
                            addNewEducation += '<option value="20">BDS</option>';
                            addNewEducation += '<option value="21">B.Ed</option>';
                            addNewEducation += '<option value="22">M.Ed</option>';
                            addNewEducation += '<option value="23">Engineering (BSc Eng)</option>';
                            addNewEducation += '<option value="24">Fazil</option>';
                            addNewEducation += '<option value="25">Kamil</option>';
                            addNewEducation += '<option value="26">Dakhil</option>';
                            addNewEducation += '<option value="27">Alim</option>';
                            addNewEducation += '<option value="28">Other</option>';
                        addNewEducation += '</select>';
                    addNewEducation += '</td>';
                    addNewEducation += '<td>';
                        addNewEducation += '<select name="group_id[]" class="form-control">';
                            addNewEducation += '<option value="1">Science</option>';
                            addNewEducation += '<option value="2">Business</option>';
                            addNewEducation += '<option value="3">Humanties</option>';
                        addNewEducation += '</select>';
                    addNewEducation += '</td>';
                    addNewEducation += '<td>';
                        addNewEducation += '<select name="grade_id[]" class="form-control">';
                            addNewEducation += '<option value="1">A+</option>';
                            addNewEducation += '<option value="2">A</option>';
                            addNewEducation += '<option value="3">A-</option>';
                            addNewEducation += '<option value="4">B+</option>';
                            addNewEducation += '<option value="5">B</option>';
                            addNewEducation += '<option value="6">B-</option>';
                            addNewEducation += '<option value="7">C+</option>';
                            addNewEducation += '<option value="8">C</option>';
                            addNewEducation += '<option value="9">D</option>';
                            addNewEducation += '<option value="10">F</option>';
                        addNewEducation += '</select>';
                    addNewEducation += '</td>';
                    addNewEducation += '<td>';
                        addNewEducation += '<select name="board_id[]" class="form-control">';
                            addNewEducation += '<option value="1">Dhaka</option>';
                            addNewEducation += '<option value="2">Rajshashi</option>';
                            addNewEducation += '<option value="3">Rangpur</option>';
                            addNewEducation += '<option value="4">Jessore</option>';
                            addNewEducation += '<option value="5">Comilla</option>';
                            addNewEducation += '<option value="6">Sylhet</option>';
                            addNewEducation += '<option value="7">Chittagong</option>';
                        addNewEducation += '</select>';
                    addNewEducation += '</td>';
                    addNewEducation += '<td>';
                        addNewEducation += '<select name="passing_year[]" class="form-control">';
                            addNewEducation += '<option value="">Select Year</option>';
                            for (var y = new Date().getFullYear(); y >= 1960; y--) {
                                addNewEducation += '<option value="' + y + '">' + y + '</option>';
                            }
                        addNewEducation += '</select>';
                    addNewEducation += '</td>';
                    addNewEducation += '<td>';
                        addNewEducation += '<input type="text" name="institute[]" placeholder="Educational Institute" class="form-control">';
                    addNewEducation += '</td>';
                    addNewEducation += '<td class="text-center">';
                        addNewEducation += '<button type="button" class="btn btn-danger btn-sm remove-single-education" style="background-color: #dc3545; border-color: #dc3545; padding: 6px 12px; border-radius: 4px;"><i class="fas fa-times"></i></button>';
                    addNewEducation += '</td>';
                addNewEducation += '</tr>';

                $("#multiple-education").append(addNewEducation);
            })







        })

        $(document).on('click', '.remove-single-education', function(){
            if (confirm("Are you sure?")){
                $(this).closest('.single-education').remove();
            }else {
                return false;
            }
        })

        function deleteEducation(id)
        {
           if (id) {
            if (confirm("Are you sure?")) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('staff.educationDelete', '') }}/" + id,
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            } else {
                return false
            }

           }
        }

    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush
