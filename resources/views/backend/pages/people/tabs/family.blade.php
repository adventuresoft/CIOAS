@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Family Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
                        <li class="breadcrumb-item active">Family</li>
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
                            @include('backend.pages.people.tabs.tab_header', ['user' => $user, 'active_tab' => 'family'])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" id="peopleFamilyForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            <div class="card-body">
                                <!-- Row 1: Family Member Type & Family Category -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="family_type_id">Family Member Type <span class="text-danger">*</span></label>
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
                                    <div class="col-sm-6">
                                        <label for="family_category_id">Family Category <span class="text-danger">*</span></label>
                                        <select required name="family_category_id" class="form-control" id="family_category_id">
                                            <option value="">Select Family Category</option>
                                            @if (count($familyCategories))
                                                @foreach ($familyCategories as $familyCategory)
                                                    <option value="{{$familyCategory->id}}" {{$user->familyInfo ? ($user->familyInfo->family_category_id == $familyCategory->id ? 'selected' : '') : ''}}>{{$familyCategory->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error family_category_id_error"></small>
                                    </div>
                                </div>

                                <!-- Row 2: Father's Name, Father's Name Bangla, Father's Live Status -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="fatherName">Father's Name</label>
                                        <input type="text" name="father_name" value="{{$user->familyInfo->father_name ?? ''}}" class="form-control" id="fatherName" placeholder="Father's Name">
                                        <small class="text-danger error father_name_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="father_name_bn">Father's Name in Bangla</label>
                                        <input type="text" name="father_name_bn" value="{{$user->familyInfo->father_name_bn ?? ''}}" class="form-control" id="father_name_bn" placeholder="পিতার নাম">
                                        <small class="text-danger error father_name_bn_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="fathersLiveStatus">Father's Live Status</label>
                                        <select name="father_live_status" class="form-control" id="fathersLiveStatus">
                                            @foreach (family_constant_option('live_status') as $key => $live_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->father_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error father_live_status_error"></small>
                                    </div>
                                </div>

                                <!-- Row 3: Mother's Name, Mother's Name Bangla, Mother's Live Status -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="motherName">Mother's Name</label>
                                        <input type="text" class="form-control" name="mother_name" id="motherName" value="{{$user->familyInfo->mother_name ??''}}" placeholder="Mother's Name">
                                        <small class="text-danger error mother_name_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="mother_name_bn">Mother's Name in Bangla</label>
                                        <input type="text" class="form-control" name="mother_name_bn" id="mother_name_bn" value="{{$user->familyInfo->mother_name_bn ??''}}" placeholder="মাতার নাম">
                                        <small class="text-danger error mother_name_bn_error"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="motherLiveStatus">Mother's Live Status</label>
                                        <select name="mother_live_status" class="form-control" id="motherLiveStatus">
                                            @foreach (family_constant_option('live_status') as $key => $live_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->mother_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error mother_live_status_error"></small>
                                    </div>
                                </div>

                                <!-- Row 4: Father's ID & Mother's ID -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="fatherNID">Father's ID</label>
                                        <input type="text" name="father_nid" class="form-control" id="fatherNID" value="{{$user->familyInfo->father_nid ?? ''}}" placeholder="Father's NID">
                                        <small class="text-danger error father_nid_error"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="motherNID">Mother's ID</label>
                                        <input type="text" name="mother_nid" class="form-control" id="motherNID" value="{{$user->familyInfo->mother_nid ?? ''}}" placeholder="Mother's NID">
                                        <small class="text-danger error mother_nid_error"></small>
                                    </div>
                                </div>

                                <!-- Row 5: Marital Status -->
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="maritalStatus">Marital Status</label>
                                        <select name="marital_status" class="form-control" id="maritalStatus">
                                            @foreach (family_constant_option('marital_status') as $key => $marital_status)
                                                <option value="{{$key}}" {{$user->familyInfo ? (($user->familyInfo->marital_status == $key) ? 'selected' : '') : ''}}>{{$marital_status}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error marital_status_error"></small>
                                    </div>
                                </div>

                                <!-- Spouse Information (conditional) -->
                                <div class="marital_status_content {{$user->familyInfo ? ( ($user->familyInfo->marital_status == 1) ? 'd-none' : 'block') : 'd-none'}}">
                                    <!-- Row 6: Spouse Name & Spouse ID -->
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="spouseName">Spouse Name</label>
                                            <input type="text" name="spouse_name" class="form-control" id="spouseName" value="{{$user->familyInfo->spouse_name ?? ''}}" placeholder="Spouse Name" />
                                            <small class="text-danger error spouse_name_error"></small>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="spouseNID">Spouse's ID</label>
                                            <input type="text" name="spouse_nid" class="form-control" value="{{$user->familyInfo->spouse_nid ?? ''}}" id="spouseNID" placeholder="Spouse's NID" />
                                            <small class="text-danger error spouse_nid_error"></small>
                                        </div>
                                    </div>

                                    <!-- Row 7: Married Date -->
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="married_date">Married Date</label>
                                            <input type="date" name="married_date" value="{{$user->familyInfo->married_date ?? ''}}" class="form-control" id="married_date" />
                                            <small class="text-danger error married_date_error"></small>
                                        </div>
                                    </div>

                                    <!-- Row 8: Have Children Checkbox -->
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input type="checkbox" value="1" {{$user->familyInfo ? ($user->familyInfo->have_children ? "checked" : "") : ""}} name="have_children" class="form-check-input" id="haveChildren">
                                                <label for="haveChildren" class="form-check-label">Have any children?</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Children Information (conditional) -->
                                    <div class="have_children_content {{$user->familyInfo ? ($user->familyInfo->have_children ? 'block' : 'd-none') : 'd-none'}}">
                                        <!-- Row 9: Number of Boys & Girls -->
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="boys">Number of boys</label>
                                                <input type="number" name="boys" class="form-control" id="boys" value="{{$user->familyInfo->boys ?? ''}}" placeholder="Number of Boys" min="0" />
                                                <small class="text-danger error boys_error"></small>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="girls">Number of Girls</label>
                                                <input type="number" class="form-control" name="girls" id="girls" value="{{$user->familyInfo->girls ?? ''}}" placeholder="Number of Girls" min="0" />
                                                <small class="text-danger error girls_error"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <a href="{{route('people.edit', $user->id)}}" class="btn btn-danger btn-block">
                                            <i class="fas fa-arrow-left"></i> Personal
                                        </a>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="fas fa-save"></i> Save & Next
                                        </button>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{route('people.address', $user->id)}}" class="btn btn-primary btn-block">
                                            Address <i class="fas fa-arrow-right"></i>
                                        </a>
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
                    url: "{{ route('people.familyStore') }}",
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
            });

            // Marital status change handler
            $('#maritalStatus').on('change', function(e) {
                let maritalStatus = $(this).val();
                if (maritalStatus == 1) {
                    $('.marital_status_content').addClass('d-none');
                } else {
                    $('.marital_status_content').removeClass('d-none');
                }
            });

            // Have children checkbox handler
            $('#haveChildren').on('change', function(e) {
                e.preventDefault();
                if (this.checked) {
                    $('.have_children_content').removeClass('d-none');
                } else {
                    $('.have_children_content').addClass('d-none');
                }
            });
        });
    </script>
@endpush