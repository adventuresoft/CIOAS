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
                                @include('backend.pages.people.tabs.tab_header', ['user' => $user, 'active_tab' => 'health'])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleHealthForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            @if ($user->healthInfo)
                                <div class="card-body">

                                    <div class="form-group row">
                                    <label for="bp" class="col-sm-2 col-form-label">BP</label>
                                    <div class="col-sm-10">
                                        <select name="bp" class="form-control" id="bp">
                                            <option value="high" @if ($user->healthInfo->bp == "high") selected @endif >High</option>
                                            <option value="low"  @if ($user->healthInfo->bp == "low") selected @endif>Low</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                    <label for="bp_up" class="col-sm-2 col-form-label">BP Up</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bp_up" value="{{$user->healthInfo->bp_up}}" class="form-control" id="bp_up">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="bp_down" class="col-sm-2 col-form-label">BP Down</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bp_down" value="{{$user->healthInfo->bp_down}}" class="form-control" id="bp_down">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes" class="col-sm-2 col-form-label">Dibetis</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes" class="form-control" id="diabetes">
                                            <option value="no"  @if ($user->healthInfo->diabetes == "no") selected @endif >No</option>
                                            <option value="yes" @if ($user->healthInfo->diabetes == "yes") selected @endif >Yes</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_start_date" class="col-sm-2 col-form-label">Dibetis Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="diabetes_start_date" value="{{$user->healthInfo->diabetes_start_date}}" class="form-control" id="diabetes_start_date">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_status" class="col-sm-2 col-form-label">Dibetis Status</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes_status" class="form-control" id="diabetes_status">
                                            <option value="md"  @if ($user->healthInfo->diabetes_status == "md") selected @endif>MD</option>
                                            <option value="others"  @if ($user->healthInfo->diabetes_status == "others") selected @endif>Others</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_treatment_status" class="col-sm-2 col-form-label">Treatment Status</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes_treatment_status" class="form-control" id="diabetes_treatment_status">
                                            <option value="running"  @if ($user->healthInfo->diabetes_treatment_status == "running") selected @endif >Running</option>
                                            <option value="break"  @if ($user->healthInfo->diabetes_treatment_status == "break") selected @endif>Break</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="diabetes_doctor" value="{{$user->healthInfo->diabetes_doctor}}" class="form-control" id="diabetes_doctor">
                                    </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="azma" class="col-sm-2 col-form-label">Azma</label>
                                        <div class="col-sm-10">
                                            <select name="azma" class="form-control" id="azma">
                                                <option value="no"  @if ($user->healthInfo->azma == "no") selected @endif >No</option>
                                                <option value="yes"  @if ($user->healthInfo->azma == "yes") selected @endif>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_start_date" class="col-sm-2 col-form-label">Azma Start Date</label>
                                        <div class="col-sm-10">
                                        <input type="date" name="azma_start_date" value="{{$user->healthInfo->azma_start_date}}" class="form-control" id="azma_start_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_status" class="col-sm-2 col-form-label">Azma Status</label>
                                        <div class="col-sm-10">
                                            <select name="azma_status" class="form-control" id="azma_status">
                                                <option value="md"  @if ($user->healthInfo->azma_status == "md") selected @endif>MD</option>
                                                <option value="others"  @if ($user->healthInfo->azma_status == "others") selected @endif>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_treatment_status" class="col-sm-2 col-form-label">Azma Treatment Status</label>
                                        <div class="col-sm-10">
                                            <select name="azma_treatment_status" class="form-control" id="azma_treatment_status">
                                                <option value="running" @if ($user->healthInfo->azma_treatment_status == "running") selected @endif>Running</option>
                                                <option value="break" @if ($user->healthInfo->azma_treatment_status == "break") selected @endif>Break</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="azma_doctor" value="{{$user->healthInfo->azma_doctor}}" class="form-control" id="azma_doctor">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="kidney" class="col-sm-2 col-form-label">Kidney</label>
                                        <div class="col-sm-10">
                                            <select name="kidney" class="form-control" id="kidney">
                                                <option value="no" @if ($user->healthInfo->kidney == "no") selected @endif>No</option>
                                                <option value="yes" @if ($user->healthInfo->kidney == "yes") selected @endif>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_start_date" class="col-sm-2 col-form-label">Kidney Start Date</label>
                                        <div class="col-sm-10">
                                        <input type="date" name="kidney_start_date" value="{{$user->healthInfo->kidney_start_date}}" class="form-control" id="kidney_start_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_status" class="col-sm-2 col-form-label">Kidney Status</label>
                                        <div class="col-sm-10">
                                            <select name="kidney_status" class="form-control" id="kidney_status">
                                                <option value="md"  @if ($user->healthInfo->kidney_status == "md") selected @endif>MD</option>
                                                <option value="others"  @if ($user->healthInfo->kidney_status == "others") selected @endif>Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_treatment_status" class="col-sm-2 col-form-label">Kidney Treatment Status</label>
                                        <div class="col-sm-10">
                                            <select name="kidney_treatment_status" class="form-control" id="kidney_treatment_status">
                                                <option value="running"  @if ($user->healthInfo->kidney_treatment_status == "running") selected @endif >Running</option>
                                                <option value="break"  @if ($user->healthInfo->kidney_treatment_status == "break") selected @endif >Break</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="kidney_doctor" class="form-control" value="{{$user->healthInfo->kidney_doctor}}" id="kidney_doctor">
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                            @else

                                <div class="card-body">

                                    <div class="form-group row">
                                    <label for="bp" class="col-sm-2 col-form-label">BP</label>
                                    <div class="col-sm-10">
                                        <select name="bp" class="form-control" id="bp">
                                            <option value="high">High</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                    <label for="bp_up" class="col-sm-2 col-form-label">BP Up</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bp_up" class="form-control" id="bp_up">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="bp_down" class="col-sm-2 col-form-label">BP Down</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bp_down" class="form-control" id="bp_down">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes" class="col-sm-2 col-form-label">Dibetis</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes" class="form-control" id="diabetes">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_start_date" class="col-sm-2 col-form-label">Dibetis Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="diabetes_start_date" class="form-control" id="diabetes_start_date">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_status" class="col-sm-2 col-form-label">Dibetis Status</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes_status" class="form-control" id="diabetes_status">
                                            <option value="md">MD</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_treatment_status" class="col-sm-2 col-form-label">Treatment Status</label>
                                    <div class="col-sm-10">
                                        <select name="diabetes_treatment_status" class="form-control" id="diabetes_treatment_status">
                                            <option value="running">Running</option>
                                            <option value="break">Break</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="diabetes_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="diabetes_doctor" class="form-control" id="diabetes_doctor">
                                    </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="azma" class="col-sm-2 col-form-label">Azma</label>
                                        <div class="col-sm-10">
                                            <select name="azma" class="form-control" id="azma">
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_start_date" class="col-sm-2 col-form-label">Azma Start Date</label>
                                        <div class="col-sm-10">
                                        <input type="date" name="azma_start_date" class="form-control" id="azma_start_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_status" class="col-sm-2 col-form-label">Azma Status</label>
                                        <div class="col-sm-10">
                                            <select name="azma_status" class="form-control" id="azma_status">
                                                <option value="md">MD</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_treatment_status" class="col-sm-2 col-form-label">Azma Treatment Status</label>
                                        <div class="col-sm-10">
                                            <select name="azma_treatment_status" class="form-control" id="azma_treatment_status">
                                                <option value="running">Running</option>
                                                <option value="break">Break</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="azma_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="azma_doctor" class="form-control" id="azma_doctor">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="kidney" class="col-sm-2 col-form-label">Kidney</label>
                                        <div class="col-sm-10">
                                            <select name="kidney" class="form-control" id="kidney">
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_start_date" class="col-sm-2 col-form-label">Kidney Start Date</label>
                                        <div class="col-sm-10">
                                        <input type="date" name="kidney_start_date" class="form-control" id="kidney_start_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_status" class="col-sm-2 col-form-label">Kidney Status</label>
                                        <div class="col-sm-10">
                                            <select name="kidney_status" class="form-control" id="kidney_status">
                                                <option value="md">MD</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_treatment_status" class="col-sm-2 col-form-label">Kidney Treatment Status</label>
                                        <div class="col-sm-10">
                                            <select name="kidney_treatment_status" class="form-control" id="kidney_treatment_status">
                                                <option value="running">Running</option>
                                                <option value="break">Break</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kidney_doctor" class="col-sm-2 col-form-label">Dr.Name/ID</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="kidney_doctor" class="form-control" id="kidney_doctor">
                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->
                            @endif


                              <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{route('people.property',$user->id)}}" class="btn btn-danger btn-block ">Property</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>

                                    <div class="col-sm-3">
                                        <a href="{{route('people.disability',$user->id)}}" class="btn btn-primary btn-block ">Disability</a>
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
            $("#peopleHealthForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.healthStore') }}",
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
        })

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
