@extends('backend.master', ['mainMenu' => 'People', 'subMenu' =>'Create'])
@section('title', 'People Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>People Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('people.index')}}">People</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

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
                                @include('backend.pages.people.tabs.tab_header', ['user' => $user, 'active_tab' => 'education'])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleEducationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="card-body" id="multiple-education">

                                @if (count($user->educationInfos))
                                    @foreach ($user->educationInfos as $education)
                                        <div class="single-education-{{$education->id}}">
                                            <div class="form-group row">
                                                <label for="degree_id" class="col-sm-2 col-form-label">Degree</label>
                                                <div class="col-sm-9">
                                                    <select name="degree_idU[{{$education->id}}]" required class="form-control" id="degree_id">
                                                        <option value="1" @if($education->degree_id == 1) selected @endif >HSC</option>
                                                        <option value="2"  @if($education->degree_id == 2) selected @endif >SSC</option>
                                                        <option value="3"  @if($education->degree_id == 3) selected @endif >JSC</option>
                                                    </select>
                                                    <small class="text-danger error degree_id_error"></small>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="group_id" class="col-sm-2 col-form-label">Group</label>
                                                <div class="col-sm-9">
                                                    <select name="group_idU[{{$education->id}}]" class="form-control" id="group_id">
                                                        <option value="1"  @if($education->group_id == 1) selected @endif >Science</option>
                                                        <option value="2"  @if($education->group_id == 2) selected @endif >Business</option>
                                                        <option value="3"  @if($education->group_id == 3) selected @endif >Humanties</option>
                                                    </select>
                                                    <small class="text-danger error group_id_error"></small>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="grade_id" class="col-sm-2 col-form-label">Grade</label>
                                                <div class="col-sm-9">
                                                    <select name="grade_idU[{{$education->id}}]" class="form-control" id="grade_id">
                                                        <option value="1"  @if($education->grade_id == 1) selected @endif >A+</option>
                                                        <option value="2"  @if($education->grade_id == 2) selected @endif>A</option>
                                                        <option value="3"  @if($education->grade_id == 3) selected @endif>A-</option>
                                                        <option value="4"  @if($education->grade_id == 4) selected @endif>B+</option>
                                                        <option value="5"  @if($education->grade_id == 5) selected @endif>B</option>
                                                        <option value="6"  @if($education->grade_id == 6) selected @endif>B-</option>
                                                        <option value="7"  @if($education->grade_id == 7) selected @endif>C+</option>
                                                        <option value="8"  @if($education->grade_id == 8) selected @endif>C</option>
                                                        <option value="9"  @if($education->grade_id == 9) selected @endif>D</option>
                                                        <option value="10"  @if($education->grade_id == 10) selected @endif>F</option>
                                                    </select>
                                                    <small class="text-danger error grade_id_error"></small>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="board_id" class="col-sm-2 col-form-label">Board</label>
                                                <div class="col-sm-9">
                                                    <select name="board_idU[{{$education->id}}]" class="form-control" id="board_id">
                                                        <option value="1" @if($education->board_id == 1) selected @endif >Dhaka</option>
                                                        <option value="2" @if($education->board_id == 2) selected @endif>Rajshashi</option>
                                                        <option value="3" @if($education->board_id == 3) selected @endif>Rangpur</option>
                                                        <option value="4" @if($education->board_id == 4) selected @endif>Jessore</option>
                                                        <option value="5" @if($education->board_id == 5) selected @endif>Comilla</option>
                                                        <option value="6" @if($education->board_id == 6) selected @endif>Sylhet</option>
                                                        <option value="7" @if($education->board_id == 7) selected @endif>Chittagong</option>
                                                    </select>

                                                    <small class="text-danger error board_id_error"></small>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="institute" class="col-sm-2 col-form-label">Educational Institute</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="instituteU[{{$education->id}}]" value="{{$education->institute}}" placeholder="Educational Institute" class="form-control" id="institute">
                                                </div>
                                                <div class="col-sm-1 mt-1" onclick="deleteEducation({{$education->id}})">
                                                    <button type="button" class="btn btn-danger">X</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="single-education">
                                        <div class="form-group row">
                                            <label for="degree_id" class="col-sm-2 col-form-label">Degree</label>
                                            <div class="col-sm-9">
                                                <select name="degree_id[]" required class="form-control" id="degree_id">
                                                    <option value="1">HSC</option>
                                                    <option value="2">SSC</option>
                                                    <option value="3">JSC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="group_id" class="col-sm-2 col-form-label">Group</label>
                                            <div class="col-sm-9">
                                                <select name="group_id[]" class="form-control" id="group_id">
                                                    <option value="1">Science</option>
                                                    <option value="2">Business</option>
                                                    <option value="3">Humanties</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="grade_id" class="col-sm-2 col-form-label">Grade</label>
                                            <div class="col-sm-9">
                                                <select name="grade_id[]" class="form-control" id="grade_id">
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
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="board_id" class="col-sm-2 col-form-label">Board</label>
                                            <div class="col-sm-9">
                                                <select name="board_id[]" class="form-control" id="board_id">
                                                    <option value="1">Dhaka</option>
                                                    <option value="2">Rajshashi</option>
                                                    <option value="3">Rangpur</option>
                                                    <option value="4">Jessore</option>
                                                    <option value="5">Comilla</option>
                                                    <option value="6">Sylhet</option>
                                                    <option value="7">Chittagong</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="institute" class="col-sm-2 col-form-label">Educational Institute</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="institute[]" placeholder="Educational Institute" class="form-control" id="institute">
                                            </div>
                                            <div class="remove-single-education col-sm-1 mt-1">
                                                <button type="button" class="btn btn-danger">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row mb-1">
                                    <div class="col-sm-3">
                                        <button type="button" id="addNewEducation" title="Add More" class="btn btn-primary btn-block">Add New More</button>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <a href="{{route('people.address',$user->id)}}" class="btn btn-danger btn-block ">Address </a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{route('people.professional',$user->id)}}" class="btn btn-primary btn-block ">Profession</a>
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
                    url: "{{ route('people.educationStore') }}",
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

                addNewEducation += '<div class="single-education">';
                    addNewEducation += '<div class="form-group row">';
                        addNewEducation += '<label for="degree_id" class="col-sm-2 col-form-label">Degree</label>';
                        addNewEducation += '<div class="col-sm-9">';
                            addNewEducation += '<select name="degree_id[]" required class="form-control" id="degree_id">';
                                addNewEducation += '<option value="1">HSC</option>';
                                addNewEducation += '<option value="2">SSC</option>';
                                addNewEducation += '<option value="3">JSC</option>';
                            addNewEducation += '</select>';
                        addNewEducation += '</div>';
                    addNewEducation += '</div>';
                    addNewEducation += '<div class="form-group row">';
                        addNewEducation += '<label for="group_id" class="col-sm-2 col-form-label">Group</label>';
                        addNewEducation += '<div class="col-sm-9">';
                            addNewEducation += '<select name="group_id[]" class="form-control" id="group_id">';
                                addNewEducation += '<option value="1">Science</option>';
                                addNewEducation += '<option value="2">Business</option>';
                                addNewEducation += '<option value="3">Humanties</option>';
                            addNewEducation += '</select>';
                        addNewEducation += '</div>';
                    addNewEducation += '</div>';
                    addNewEducation += '<div class="form-group row">';
                        addNewEducation += '<label for="grade_id" class="col-sm-2 col-form-label">Grade</label>';
                        addNewEducation += '<div class="col-sm-9">';
                            addNewEducation += '<select name="grade_id[]" class="form-control" id="grade_id">';
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
                        addNewEducation += '</div>';
                    addNewEducation += '</div>';
                    addNewEducation += '<div class="form-group row">';
                        addNewEducation += '<label for="board_id" class="col-sm-2 col-form-label">Board</label>';
                        addNewEducation += '<div class="col-sm-9">';
                            addNewEducation += '<select name="board_id[]" class="form-control" id="board_id">';
                                addNewEducation += '<option value="1">Dhaka</option>';
                                addNewEducation += '<option value="2">Rajshashi</option>';
                                addNewEducation += '<option value="3">Rangpur</option>';
                                addNewEducation += '<option value="4">Jessore</option>';
                                addNewEducation += '<option value="5">Comilla</option>';
                                addNewEducation += '<option value="6">Sylhet</option>';
                                addNewEducation += '<option value="7">Chittagong</option>';
                            addNewEducation += '</select>';
                        addNewEducation += '</div>';
                    addNewEducation += '</div>';
                    addNewEducation += '<div class="form-group row">';
                        addNewEducation += '<label for="institute" class="col-sm-2 col-form-label">Educational Institute</label>';
                        addNewEducation += ' <div class="col-sm-9">';
                            addNewEducation += '<input type="text" name="institute[]" placeholder="Educational Institute" class="form-control" id="institute">';
                        addNewEducation += '</div>';
                        addNewEducation += '<div class="remove-single-education col-sm-1 mt-1">';
                            addNewEducation += '<button type="button" class="btn btn-danger">X</button>';
                            addNewEducation += '</div>';
                        addNewEducation += ' </div>';
                    addNewEducation += '</div>';


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
                    url: "{{url('/admin/people/education-delete')}}/"+id,
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
