@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@push('style')
@endpush
@section('title', 'chairman Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chairman Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('chairman.index') }}">Chairman</a></li>
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
                                @include('backend.pages.chairman.tabs.tab_header', ['user' => $user, 'active_tab' => 'family'])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="peopleFamilyForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            <div class="card-body">



                                <div class="form-group row">
                                    <label for="family_type_id" class="col-sm-2 col-form-label">
                                        Family Member Type
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="family_type_id" required class="form-control" id="family_type_id">
                                            <option value="">Select Member Type</option>
                                            @if (count($familyTypes))
                                                @foreach ($familyTypes as $familyType)
                                                    <option value="{{$familyType->id}}" {{$user->familyInfo ? ($user->familyInfo->family_type_id == $familyType->id ? 'selected' : '') : ''}}>{{$familyType->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error family_type_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="family_category_id" class="col-sm-2 col-form-label">
                                        Family Category
                                    </label>
                                    <div class="col-sm-10">
                                        <select required name="family_category_id" class="form-control" id="family_category_id">
                                            <option value="">Select Family Category</option>
                                            @if (count($familyCategories))
                                                @foreach ($familyCategories as $familyCategory)
                                                    <option value="{{$familyCategory->id}}" {{$user->familyInfo ? ($user->familyInfo->family_type_id == $familyCategory->id ? 'selected' : '') : ''}}>{{$familyCategory->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <small class="text-danger error family_category_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fatherName" class="col-sm-2 col-form-label">Father's Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="father_name" value="{{$user->familyInfo->father_name ?? ''}}" class="form-control" id="fatherName" placeholder="Father's Name">
                                        <small class="text-danger error father_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="father_name_bn" class="col-sm-2 col-form-label">Father's Name in Bangla</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="father_name_bn" value="{{$user->familyInfo->father_name_bn ?? ''}}" class="form-control" id="father_name_bn" placeholder="Father's Name in Bangla">
                                        <small class="text-danger error father_name_bn_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fathersLiveStatus" class="col-sm-2 col-form-label">Father's Live Statu</label>
                                    <div class="col-sm-10">
                                        <select name="father_live_status" class="form-control" id="fathersLiveStatus">
                                            @foreach (family_constant_option('live_status') as $key => $live_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->father_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error father_live_status_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fatherNID" class="col-sm-2 col-form-label">Father's ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="father_nid" class="form-control" id="fatherNID"  value="{{$user->familyInfo->father_nid ?? ''}}"  placeholder="Fatherss NID">
                                        <small class="text-danger error father_nid_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="motherName" class="col-sm-2 col-form-label">
                                        Mother's Name
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mother_name" id="motherName"  value="{{$user->familyInfo->mother_name ??''}}"  placeholder="Mother's Name">
                                        <small class="text-danger error mother_name_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mother_name_bn" class="col-sm-2 col-form-label">
                                        Mother's Name in Bangla
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mother_name_bn" id="mother_name_bn"  value="{{$user->familyInfo->mother_name_bn ??''}}"  placeholder="Mother's Name in Bangla">
                                        <small class="text-danger error mother_name_bn_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="motherLiveStatus" class="col-sm-2 col-form-label">
                                        Mother's Live Status
                                    </label>
                                    <div class="col-sm-10">
                                        <select name="mother_live_status" class="form-control" id="motherLiveStatus">
                                            @foreach (family_constant_option('live_status') as $key => $live_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->mother_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                            @endforeach
                                        </select>

                                        <small class="text-danger error mother_live_status_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="motherNID" class="col-sm-2 col-form-label">
                                        Mother's ID
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mother_nid" class="form-control" id="motherNID"  value="{{$user->familyInfo->mother_nid ?? ''}}" placeholder="Mother's NID">
                                        <small class="text-danger error mother_nid_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="maritalStatus" class="col-sm-2 col-form-label">Marital Status</label>
                                    <div class="col-sm-10">
                                        <select name="marital_status" class="form-control" id="maritalStatus">

                                            @foreach (family_constant_option('marital_status') as $key => $marital_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? (($user->familyInfo->marital_status == $key) ? 'selected' : '') : ''}}>{{$marital_status}}</option>
                                            @endforeach

                                        </select>

                                        <small class="text-danger error marital_status_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row marital_status_content {{$user->familyInfo ? ( ($user->familyInfo->marital_status == 1) ? 'd-none' : 'block') : 'd-none'}}">
                                    <label for="spouseName" class="col-sm-2 col-form-label">Spouse Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="spouse_name" class="form-control" id="spouseName" value="{{$user->familyInfo->spouse_name ?? ''}}" placeholder="Spouse Name" />
                                        <small class="text-danger error spouse_name_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row marital_status_content {{$user->familyInfo ? (($user->familyInfo->marital_status == 1) ? 'd-none' : 'block') : 'd-none'}}">
                                    <label for="spouseNID" class="col-sm-2 col-form-label">
                                        Spouse's ID
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="spouse_nid" class="form-control"  value="{{$user->familyInfo->spouse_nid ?? ''}}" id="spouseNID" placeholder="Spouse's NID" />
                                        <small class="text-danger error spouse_nid_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row marital_status_content {{$user->familyInfo ? (($user->familyInfo->marital_status == 1) ? 'd-none' : 'block') : 'd-none'}}">
                                    <label for="married_date" class="col-sm-2 col-form-label">
                                        Married Date
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="date" name="married_date"   value="{{$user->familyInfo->married_date ?? ''}}" class="form-control" id="married_date" />
                                        <small class="text-danger error married_date_error"></small>

                                    </div>
                                </div>

                                <div class="form-check row marital_status_content {{$user->familyInfo ? ( ($user->familyInfo->marital_status == 1) ? 'd-none' : 'block') : 'd-none'}}">
                                    <input type="checkbox" value="1" {{$user->familyInfo ? ($user->familyInfo->have_children ? "checked" : "") : ""}} name="have_children" class="form-check-input" id="haveChildren">
                                    <label for="haveChildren" class=" form-check-label"> Have any children?</label>
                                </div>

                                <div class="form-group row have_children_content {{$user->familyInfo ? ($user->familyInfo->have_children ? 'block' : 'd-none') : 'd-none'}}">
                                    <label for="boys" class="col-sm-2 col-form-label">
                                        Number of boys
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="number" name="boys" class="form-control" id="boys"  value="{{$user->familyInfo->boys ?? ''}}"  placeholder="Number of Boys" />
                                        <small class="text-danger error boys_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row have_children_content {{$user->familyInfo ? ($user->familyInfo->have_children ? 'block' : 'd-none') : 'd-none'}}">
                                    <label for="girls" class="col-sm-2 col-form-label">
                                        Number of Girls
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="girls" id="girls" value="{{$user->familyInfo->girls ?? ''}}"  placeholder="Number of Girls" />
                                        <small class="text-danger error girls_error"></small>

                                    </div>
                                </div>
                            </div>
                          
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{route('people.edit', $user->id)}}" class="btn btn-danger btn-block"> Personal</a>

                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>

                                    <div class="col-sm-3">
                                        <a href="{{route('people.address',$user->id)}}" class="btn btn-primary btn-block ">Address </a>
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
            $("#peopleFamilyForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('chairman.familyStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
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
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('change', '#maritalStatus', function(e){
            let maritalStaus = $(this).val();
            if (maritalStaus == 1) {
                $('.marital_status_content').addClass('d-none');
            } else{
                $('.marital_status_content').removeClass('d-none');
            }
        })

        $(document).on('change', '#haveChildren', function(e){
            e.preventDefault();
            if (this.checked) {
                $('.have_children_content').removeClass('d-none');
            } else {
                $('.have_children_content').addClass('d-none');
            }
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
