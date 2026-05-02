@extends('frontend.master')
@section('title', 'SUKTAIL UNION PARISHAD - Profile')
@push('style')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('backend') }}/img/user8-128x128.jpg"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">Nina Mcintire</h3>

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                    fermentum enim neque.</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="active tab-pane" id="personal">
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger" title="Required" data-toggle="tooltip" >*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" required value="{{ $user->name ?? '' }}" class="form-control"
                                                        name="name" id="name" placeholder="Name English">
                                                    <small class="error name-error text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="bn_name" class="col-sm-2 col-form-label">Name Bangla <span class="text-danger" title="Required" data-toggle="tooltip" >*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" required value="{{ $user->people->bn_name ?? '' }}" class="form-control"
                                                        name="bn_name" id="bn_name" placeholder="Name Bangla">
                                                    <small class="error bn_name-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger" title="Required" data-toggle="tooltip" >*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="email" required value="{{ $user->email ?? '' }}" name="email"
                                                        placeholder="Email" class="form-control" id="email">
                                                    <small class="error email-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="date_of_birth" class="col-sm-2 col-form-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <input type="date" value="{{ $user->people->date_of_birth ?? '' }}" name="date_of_birth"
                                                                class="form-control" id="date_of_birth">
                                                            <small class="error date_of_birth-error text-danger"></small>
                                                        </div>
                                                        <div class="col-md-4 mt-2 mt-md-0">
                                                            <label for="age" class="col-form-label">Age</label>
                                                            <input type="text" class="form-control" id="age" readonly
                                                                placeholder="Auto calculated">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="birth_place" class="col-sm-2 col-form-label">Birth Place</label>
                                                <div class="col-sm-9">
                                                    <select name="birth_place"  class="form-control" id="birth_place">
                                                            <option value="">Select Birth Place</option>
                                                        @if (count(people_constant_option('birth_place')))
                                                            @foreach (people_constant_option('birth_place') as $key => $item)
                                                                <option value="{{ $key }}" {{isset($user->people->birth_place) ? (($user->people->birth_place == $key) ? 'selected' : '') : ''}}>{{ $item }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error birth_place-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row districts {{isset($user->people->birth_place) ? (($user->people->birth_place == 1) ? '' : 'd-none') : 'd-none'}} ">
                                                <label for="district_id" class="col-sm-2 col-form-label">District</label>
                                                <div class="col-sm-9">
                                                    <select name="district_id" class="form-control" id="district_id">
                                                        @if (count($districts))
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}" {{isset($user->people->district_id) ? (($user->people->district_id == $district->id) ? 'selected' : '') : ''}}>{{ $district->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error district_id-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row countries {{isset($user->people->birth_place) ? (($user->people->birth_place == 2) ? '' : 'd-none') : 'd-none'}} ">
                                                <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                                                <div class="col-sm-9">
                                                    <select name="country_id" class="form-control" id="country_id">
                                                        @if (count($countries))
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}" {{isset($user->people->country_id) ? (($user->people->country_id == $country->id) ? 'selected' : '') : ''}}>{{ $country->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error country_id-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <select name="gender" class="form-control" id="gender">
                                                        <option value="">Select Gender</option>
                                                        @if (count(people_constant_option('gender')))
                                                            @foreach (people_constant_option('gender') as $key => $item)
                                                                <option value="{{ $key }}" {{isset($user->people->gender) ? (($user->people->gender == $key) ? 'selected' : '') : ''}}>{{ $item }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error gender-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                                                <div class="col-sm-9">
                                                    <select name="religion" class="form-control" id="religion">
                                                        <option value="">Select Religion</option>
                                                        @if (count($religions))
                                                            @foreach ($religions as $religion)
                                                                <option value="{{ $religion->id }}" {{isset($user->people->religion_id) ? (($user->people->religion_id == $religion->id) ? 'selected' : '') : ''}} >{{ $religion->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error religion-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="blood_group" class="col-sm-2 col-form-label">Blood Group</label>
                                                <div class="col-sm-9">
                                                    <select name="blood_group" class="form-control" id="blood_group">
                                                        <option value="">Select Blood Group</option>
                                                        @if (count(people_constant_option('blood_group')))
                                                            @foreach (people_constant_option('blood_group') as $key => $item)
                                                                <option value="{{ $key }}" {{isset($user->people->blood_group) ? (($user->people->blood_group == $key) ? 'selected' : '') : ''}} >{{ $item }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error blood_group-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="mobile" class="col-sm-2 col-form-label">Mobile No.</label>
                                                <div class="col-sm-9">
                                                    <input type="tel" value="{{ $user->mobile ?? '' }}" name="mobile"
                                                        placeholder="Mobile" class="form-control" id="mobile">
                                                    <small class="error mobile-error text-danger"></small>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="birth_certificate" class="col-sm-2 col-form-label">Birth Reg. No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="{{ $user->birth_certificate ?? '' }}"
                                                        name="birth_certificate" placeholder="Birth Reg. No." class="form-control"
                                                        id="birth_certificate">
                                                    <small class="error birth_certificate-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nid" class="col-sm-2 col-form-label">NID No. </label>
                                                <div class="col-sm-9">
                                                    <input type="text" value="{{ $user->nid ?? '' }}" name="nid"
                                                        placeholder="NID No." class="form-control" id="nid">
                                                    <span class="error nid-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-sm-2 col-form-label">Photo </label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="image" class="image" id="image">
                                                    <span class="error image-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <img class="img-fluid img-thumbnail" src="{{ $user->image ? asset($user->image) : asset('public/no-image-found.jpeg') }}" id="preview" alt="Preview" width="100" height="100">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="family">
                                        <form class="form-horizontal">
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

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="address">
                                        <form class="form-horizontal">




                                            <div class="form-group row">
                                                <label for="permanent_village_id" class="col-sm-2 col-form-label">Village</label>
                                                <div class="col-sm-10">
                                                    <select name="permanent_village_id" class="form-control select2 select2bs4" id="permanent_village_id">
                                                        <option value="">Select Village</option>
                                                        @if ($villages)
                                                            @foreach ($villages as $village)
                                                                <option value="{{$village->id}}" {{$user->addressInfo ? ($user->addressInfo->permanent_village_id == $village->id ? 'selected' : '' ) : ''}}>{{$village->en_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error permanent_village_id_error"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="permanent_village_area_id" class="col-sm-2 col-form-label">Village Area</label>
                                                <div class="col-sm-10">
                                                    <select name="permanent_village_area_id" class="form-control select2 select2bs4" id="permanent_village_area_id">
                                                        <option value="">Select Village Area</option>
                                                        @if ($permanentVillageAreas)
                                                            @foreach ($permanentVillageAreas as $permanentVillageArea)
                                                                <option value="{{$permanentVillageArea->id}}" {{$user->addressInfo ? (($user->addressInfo->permanent_village_area_id == $permanentVillageArea->id) ? 'selected' : '' ) : ''}}>{{$permanentVillageArea->en_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error permanent_ward_id_error"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="permanent_ward_id" class="col-sm-2 col-form-label">Permanent Ward</label>
                                                <div class="col-sm-10">
                                                    <select name="permanent_ward_id" class="form-control select2 select2bs4" id="permanent_ward_id">
                                                        <option value="">Select Ward</option>
                                                        @if ($wards)
                                                            @foreach ($wards as $ward)
                                                                <option value="{{$ward->id}}" {{$user->addressInfo ? (($user->addressInfo->permanent_ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error permanent_ward_id_error"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="permanent_road" class="col-sm-2 col-form-label">Road</label>
                                                <div class="col-sm-10">
                                                        <select class="form-control select2" id="permanent_road" name="permanent_road" >
                                                            <option value="">Select Road</option>
                                                            @if (count($roads))
                                                                @foreach($roads as $road)
                                                                    <option value="{{$road->id}}" {{isset($user->addressInfo->permanentRoad->id) ? (($user->addressInfo->permanentRoad->id == $road->id) ? 'selected' : '' ) : '' }} >{{$road->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <small class="text-danger error permanent_road_error"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="permanent_house" class="col-sm-2 col-form-label">House</label>
                                                <div class="col-sm-10">

                                                    <select name="permanent_house" class="form-control select2 select2bs4" id="permanent_house">
                                                        @if (count($permanent_houses))
                                                            @foreach ($permanent_houses as $house)
                                                                <option value="{{$house->id}}" {{isset($user->addressInfo->permanentHouse->id) ? ($user->addressInfo->permanentHouse->id == $house->id ? 'selected' : '') : ''}} >{{$house->house}}</option>
                                                            @endforeach

                                                        @else
                                                            <option value="{{$user->addressInfo->permanentHouse->id ?? ''}}">{{$user->addressInfo->permanentHouse->house ?? 'No House Found' }}</option>
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error permanent_house_error"></small>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="permanent_flat" class="col-sm-2 col-form-label">Flat</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="permanent_flat" class="form-control" id="permanent_flat"
                                                        value="{{ $user->addressInfo->permanent_flat ?? '' }}" placeholder="Permanent Flat">

                                                        <small class="text-danger error permanent_flat_error"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->


                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            function calculateAge(dob) {
                if (!dob) {
                    return '';
                }

                let birthDate = new Date(dob);
                if (Number.isNaN(birthDate.getTime())) {
                    return '';
                }

                let today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                return age;
            }

            function setAgeFromDob(dob) {
                let age = calculateAge(dob);
                $('#age').val(age !== '' && age >= 0 ? age + ' years' : '');
            }

            setAgeFromDob($('#date_of_birth').val());
            $('#date_of_birth').on('change', function() {
                setAgeFromDob($(this).val());
            });
        });
    </script>
@endpush
