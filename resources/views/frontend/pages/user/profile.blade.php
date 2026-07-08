@extends('backend.master')
@section('title', 'SUKTAIL UNION PARISHAD - Profile')
@push('style')

@endpush
@section('content')
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

                    <!-- Profile Image Card -->
                    <div class="card card-emerald card-outline shadow-sm border-0 rounded-3">
                        <div class="card-body box-profile text-center py-4">
                            <div class="position-relative d-inline-d-block mb-3">
                                <img class="profile-user-img img-fluid img-round object-cover border-2 border-emerald"
                                    src="{{ $user->image && file_exists(public_path($user->image)) ? asset($user->image) : asset('backend/img/user8-128x128.jpg') }}"
                                    alt="User profile picture" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>

                            <h3 class="profile-username font-weight-bold text-dark fs-card-title mb-1">{{ $user->name }}
                            </h3>


                            <ul class="list-group list-group-unbordered mb-3 text-left fs-content pt-4">
                                <li
                                    class="list-group-item d-flex justify-content-between align-align-items-center py-2 px-0 border-top-0">
                                    <span class="text-muted"><i class="fas fa-user-tag mr-2 text-emerald"></i>ACCOUNT
                                        TYPE</span>
                                    <span
                                        class="font-weight-bold text-dark text-text-uppercase">{{ $user->user_type }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-align-items-center py-2 px-0">
                                    <span class="text-muted"><i class="fas fa-building mr-2 text-emerald"></i>
                                        ডিপার্টমেন্ট</span>
                                    <span class="font-weight-bold text-dark">{{ $user->department->name ?? 'N/A' }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-align-items-center py-2 px-0">
                                    <span class="text-muted"><i class="fas fa-sitemap mr-2 text-emerald"></i> সেকশন</span>
                                    <span class="font-weight-bold text-dark">{{ $user->section->name ?? 'N/A' }}</span>
                                </li>

                                <li
                                    class="list-group-item d-flex justify-content-between align-align-items-center py-2 px-0">
                                    <span class="text-muted"><i class="fas fa-briefcase mr-2 text-emerald"></i> পদবি</span>
                                    <span class="font-weight-bold text-dark">{{ $user->designation ?? 'N/A' }}</span>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-emerald shadow-sm border-0 rounded-3">
                        <div class="card-header bg-light border-bottom-0 py-3">
                            <h3 class="card-title font-weight-bold m-0" style="color: #006a4e;"><i
                                    class="fas fa-info-circle mr-2"></i> About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body fs-content py-3">
                            <strong><i class="fas fa-mobile-alt mr-1 text-emerald"></i> মোবাইল নম্বর</strong>
                            <p class="text-muted mb-3">{{ $user->mobile }}</p>

                            <hr class="my-2" style="border-top: 1px solid #f1f5f9;">

                            <strong><i class="far fa-envelope mr-1 text-emerald"></i> ইমেইল</strong>
                            <p class="text-muted mb-3">{{ $user->email }}</p>

                            <hr class="my-2" style="border-top: 1px solid #f1f5f9;">

                            <strong><i class="fas fa-map-marker-alt mr-1 text-emerald"></i> ঠিকানা</strong>
                            <p class="text-muted mb-0">{{ $user->addressInfo->present_address ?? 'ঠিকানা প্রদান করা হয়নি' }}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card profile-card border-0 shadow-sm">
                        <div class="card-header  py-3 px-4" style="background: #ffffff; border-bottom: 1px solid #f1f5f9;">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                    style="width: 36px; height: 36px; background-color: #e6f3ef;">
                                    <i class="fas fa-user-edit" style="color: #006a4e; font-size: 1.05rem;"></i>
                                </div>
                                <h5 class="m-0 font-weight-bold text-dark"
                                    style="font-size: 1.1rem; letter-spacing: 0.3px;">প্রোফাইল আপডেট ফরম</h5>
                            </div>
                            <ul class="nav nav-pills border-0">
                                <li class="nav-item"><a class="nav-link active" href="#personal"
                                        data-toggle="tab">Personal</a></li>
                                @if(!in_array(auth()->user()->user_type, [ 'admin', 'superadmin' ]))
                                    <li class="nav-item"><a class="nav-link" href="#family" data-toggle="tab">Family</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#address" data-toggle="tab">Address</a></li>
                                @endif
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body p-3">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert"
                                    style="background-color: #e6f3ef; color: #006a4e; border-radius: 8px;">
                                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="color: #006a4e;">
                                        <span aria-d-none="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content profile-form-container">

                                    <div class="active tab-pane" id="personal">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name">Name (English) <span class="text-danger">*</span></label>
                                                <input type="text" required value="{{ $user->name ?? '' }}"
                                                    class="form-control" name="name" id="name" placeholder="Name English">
                                                <small class="error name-error text-danger d-block mt-1"></small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="bn_name">Name (Bangla) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" required value="{{ $user->bn_name ?? '' }}"
                                                    class="form-control" name="bn_name" id="bn_name"
                                                    placeholder="Name Bangla">
                                                <small class="error bn_name-error text-danger d-block mt-1"></small>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input type="email" required value="{{ $user->email ?? '' }}" name="email"
                                                    placeholder="Email" class="form-control" id="email">
                                                <small class="error email-error text-danger d-block mt-1"></small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobile">Mobile No.</label>
                                                <input type="tel" value="{{ $user->mobile ?? '' }}" name="mobile"
                                                    placeholder="Mobile" class="form-control" id="mobile">
                                                <small class="error mobile-error text-danger d-block mt-1"></small>
                                            </div>
                                        </div>

                                        <div class="row mb-3 align-align-items-center">
                                            <div class="col-md-6">
                                                <label for="image">Photo</label>
                                                <input type="file" name="image" class="form-control" id="image"
                                                    style="height: auto !important; padding: 6px 12px !important;">
                                                <span class="error image-error text-danger d-block mt-1"></span>
                                            </div>
                                            <div class="col-md-6 text-md-left text-center mt-3 mt-md-0">
                                                <img class="img-fluid img-thumbnail rounded shadow-sm"
                                                    src="{{ $user->image && file_exists(public_path($user->image)) ? asset($user->image) : asset('public/no-image-found.jpeg') }}"
                                                    id="preview" alt="Preview" width="80" height="80"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-submit-profile btn-primary"><i
                                                    class="fas fa-save mr-2"></i> Save Changes</button>
                                        </div>
                                    </div>


                                    <!-- /.tab-pane -->
                                    @if(!in_array(auth()->user()->user_type, [ 'admin', 'superadmin' ]))
                                        <div class="tab-pane" id="family">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="fatherName">Father's Name</label>
                                                    <input type="text" name="father_name"
                                                        value="{{$user->familyInfo->father_name ?? ''}}" class="form-control"
                                                        id="fatherName" placeholder="Father's Name">
                                                    <small class="text-danger error father_name_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="father_name_bn">Father's Name (Bangla)</label>
                                                    <input type="text" name="father_name_bn"
                                                        value="{{$user->familyInfo->father_name_bn ?? ''}}" class="form-control"
                                                        id="father_name_bn" placeholder="Father's Name in Bangla">
                                                    <small class="text-danger error father_name_bn_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="fathersLiveStatus">Father's Live Status</label>
                                                    <select name="father_live_status" class="form-control"
                                                        id="fathersLiveStatus">
                                                        @foreach (family_constant_option('live_status') as $key => $live_status)
                                                            <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->father_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small
                                                        class="text-danger error father_live_status_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="fatherNID">Father's ID</label>
                                                    <input type="text" name="father_nid" class="form-control" id="fatherNID"
                                                        value="{{$user->familyInfo->father_nid ?? ''}}"
                                                        placeholder="Father's NID">
                                                    <small class="text-danger error father_nid_error d-block mt-1"></small>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="motherName">Mother's Name</label>
                                                    <input type="text" class="form-control" name="mother_name" id="motherName"
                                                        value="{{$user->familyInfo->mother_name ?? ''}}"
                                                        placeholder="Mother's Name">
                                                    <small class="text-danger error mother_name_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="mother_name_bn">Mother's Name (Bangla)</label>
                                                    <input type="text" class="form-control" name="mother_name_bn"
                                                        id="mother_name_bn" value="{{$user->familyInfo->mother_name_bn ?? ''}}"
                                                        placeholder="Mother's Name in Bangla">
                                                    <small class="text-danger error mother_name_bn_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="motherLiveStatus">Mother's Live Status</label>
                                                    <select name="mother_live_status" class="form-control"
                                                        id="motherLiveStatus">
                                                        @foreach (family_constant_option('live_status') as $key => $live_status)
                                                            <option value="{{$key}}" {{$user->familyInfo ? ($user->familyInfo->mother_live_status == $key ? 'selected' : '') : ''}}>{{$live_status}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small
                                                        class="text-danger error mother_live_status_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="motherNID">Mother's ID</label>
                                                    <input type="text" name="mother_nid" class="form-control" id="motherNID"
                                                        value="{{$user->familyInfo->mother_nid ?? ''}}"
                                                        placeholder="Mother's NID">
                                                    <small class="text-danger error mother_nid_error d-block mt-1"></small>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label for="marital_status">Marital Status</label>
                                                    <select name="marital_status" class="form-control" id="marital_status">
                                                        <option value="1" {{$user->familyInfo ? ($user->familyInfo->marital_status == 1 ? 'selected' : '') : ''}}>
                                                            Married</option>
                                                        <option value="2" {{$user->familyInfo ? ($user->familyInfo->marital_status == 2 ? 'selected' : '') : ''}}>
                                                            Unmarried</option>
                                                    </select>
                                                    <small class="text-danger error marital_status_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="spouse_name">Spouse Name</label>
                                                    <input type="text" class="form-control" name="spouse_name" id="spouse_name"
                                                        value="{{$user->familyInfo->spouse_name ?? ''}}"
                                                        placeholder="Spouse Name" />
                                                    <small class="text-danger error spouse_name_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="spouse_nid">Spouse NID</label>
                                                    <input type="text" class="form-control" name="spouse_nid" id="spouse_nid"
                                                        value="{{$user->familyInfo->spouse_nid ?? ''}}"
                                                        placeholder="Spouse NID" />
                                                    <small class="text-danger error spouse_nid_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="married_date">Marriage Date</label>
                                                    <input type="date" class="form-control" name="married_date"
                                                        id="married_date" value="{{$user->familyInfo->married_date ?? ''}}" />
                                                    <small class="text-danger error married_date_error d-block mt-1"></small>
                                                </div>
                                            </div>

                                            <div class="row mb-3 align-align-items-center">
                                                <div class="col-md-4">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="have_children"
                                                            id="have_children" value="1" {{$user->familyInfo && $user->familyInfo->have_children == 1 ? 'checked' : ''}} />
                                                        <label class="custom-control-label font-weight-bold"
                                                            for="have_children">Do you have children?</label>
                                                    </div>
                                                    <small class="text-danger error have_children_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="boys">No. of Boys</label>
                                                    <input type="number" class="form-control" name="boys" id="boys"
                                                        value="{{$user->familyInfo->boys ?? ''}}" placeholder="Boys" />
                                                    <small class="text-danger error boys_error d-block mt-1"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="girls">No. of Girls</label>
                                                    <input type="number" class="form-control" name="girls" id="girls"
                                                        value="{{$user->familyInfo->girls ?? ''}}" placeholder="Girls" />
                                                    <small class="text-danger error girls_error d-block mt-1"></small>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-submit-profile btn-primary"><i
                                                        class="fas fa-save mr-2"></i> Save Changes</button>
                                            </div>
                                        </div>

                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="address">

                                            <!-- Present Address Sub-Section -->
                                            <div class="mb-3 pb-2 border-bottom"
                                                style="border-bottom: 2px solid #e6f3ef !important;">
                                                <h6 class="font-weight-bold" style="color: #006a4e;"><i
                                                        class="fas fa-map-marked-alt mr-2"></i> Present Address (বর্তমান ঠিকানা)
                                                </h6>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label for="present_division_id">Division</label>
                                                    <select name="present_division_id" class="form-control select2 select2bs4"
                                                        id="present_division_id">
                                                        <option value="">Select Division</option>
                                                        @if ($divisions)
                                                            @foreach ($divisions as $division)
                                                                <option value="{{ $division->id }}" {{$user->addressInfo && $user->addressInfo->present_division_id == $division->id ? 'selected' : ''}}>{{ $division->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_division_id_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_district_id">District</label>
                                                    <select name="present_district_id" class="form-control select2 select2bs4"
                                                        id="present_district_id">
                                                        <option value="">Select District</option>
                                                        @if ($districts)
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}" {{$user->addressInfo && $user->addressInfo->present_district_id == $district->id ? 'selected' : ''}}>{{ $district->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_district_id_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_thana_id">Thana</label>
                                                    <select name="present_thana_id" class="form-control select2 select2bs4"
                                                        id="present_thana_id">
                                                        <option value="">Select Thana</option>
                                                        @if ($thanas)
                                                            @foreach ($thanas as $thana)
                                                                <option value="{{ $thana->id }}" {{$user->addressInfo && $user->addressInfo->present_thana_id == $thana->id ? 'selected' : ''}}>{{ $thana->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_thana_id_error"></small>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label for="present_union_id">Union</label>
                                                    <select name="present_union_id" class="form-control select2 select2bs4"
                                                        id="present_union_id">
                                                        <option value="">Select Union</option>
                                                        @if ($unions)
                                                            @foreach ($unions as $union)
                                                                <option value="{{ $union->id }}" {{$user->addressInfo && $user->addressInfo->present_union_id == $union->id ? 'selected' : ''}}>{{ $union->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_union_id_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_ward_id">Ward</label>
                                                    <select name="present_ward_id" class="form-control select2 select2bs4"
                                                        id="present_ward_id">
                                                        <option value="">Select Ward</option>
                                                        @if ($wards)
                                                            @foreach ($wards as $ward)
                                                                <option value="{{$ward->id}}" {{$user->addressInfo && $user->addressInfo->present_ward_id == $ward->id ? 'selected' : ''}}>
                                                                    {{$ward->en_ward_no}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_ward_id_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_village_id">Village</label>
                                                    <select name="present_village_id" class="form-control select2 select2bs4"
                                                        id="present_village_id">
                                                        <option value="">Select Village</option>
                                                        @if ($villages)
                                                            @foreach ($villages as $village)
                                                                <option value="{{$village->id}}" {{$user->addressInfo && $user->addressInfo->present_village_id == $village->id ? 'selected' : ''}}>{{$village->en_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger error present_village_id_error"></small>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label for="present_road">Road</label>
                                                    <input type="text" name="present_road" class="form-control"
                                                        id="present_road" value="{{ $user->addressInfo->present_road ?? '' }}"
                                                        placeholder="Present Road">
                                                    <small class="text-danger error present_road_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_house">House</label>
                                                    <input type="text" name="present_house" class="form-control"
                                                        id="present_house" value="{{ $user->addressInfo->present_house ?? '' }}"
                                                        placeholder="Present House">
                                                    <small class="text-danger error present_house_error"></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="present_flat">Flat</label>
                                                    <input type="text" name="present_flat" class="form-control"
                                                        id="present_flat" value="{{ $user->addressInfo->present_flat ?? '' }}"
                                                        placeholder="Present Flat">
                                                    <small class="text-danger error present_flat_error"></small>
                                                </div>
                                            </div>



                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="submit" class="btn btn-submit-profile btn-primary"><i
                                                        class="fas fa-save mr-2"></i> Save Changes</button>
                                            </div>
                                        </div>

                                        <!-- /.tab-pane -->
                                    @endif
                                    <div class="tab-pane" id="password">
                                        <div class="mb-3 pb-2 border-bottom"
                                            style="border-bottom: 2px solid #e6f3ef !important;">
                                            <h6 class="font-weight-bold" style="color: #006a4e;"><i
                                                    class="fas fa-lock mr-2"></i> Change Password (পাসওয়ার্ড পরিবর্তন)</h6>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" name="current_password" class="form-control"
                                                    id="current_password" placeholder="Enter current password">
                                                @error('current_password')
                                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="new_password">New Password</label>
                                                <input type="password" name="new_password" class="form-control"
                                                    id="new_password" placeholder="Enter new password">
                                                @error('new_password')
                                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="new_password_confirmation">Confirm New Password</label>
                                                <input type="password" name="new_password_confirmation" class="form-control"
                                                    id="new_password_confirmation" placeholder="Confirm new password">
                                                @error('new_password_confirmation')
                                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-submit-profile btn-primary"><i
                                                    class="fas fa-key mr-2"></i> Update Password</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </form>
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

@endsection
@push('script')
    <script>
        $(document).ready(function () {
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
            $('#date_of_birth').on('change', function () {
                setAgeFromDob($(this).val());
            });

            $('#birth_place').on('change', function () {
                let value = $(this).val();
                if (value == 1) {
                    $('.districts-countries-row').removeClass('d-none');
                    $('.districts').removeClass('d-none');
                    $('.countries').addClass('d-none');
                } else if (value == 2) {
                    $('.districts-countries-row').removeClass('d-none');
                    $('.districts').addClass('d-none');
                    $('.countries').removeClass('d-none');
                } else {
                    $('.districts-countries-row').addClass('d-none');
                    $('.districts').addClass('d-none');
                    $('.countries').addClass('d-none');
                }
            });

            // Same as present checkbox handler
            $('#same_as_present').on('change', function () {
                if (this.checked) {
                    $('#permanent_division_id').val($('#present_division_id').val()).trigger('change');
                    setTimeout(function () {
                        $('#permanent_district_id').val($('#present_district_id').val()).trigger('change');
                    }, 500);
                    setTimeout(function () {
                        $('#permanent_thana_id').val($('#present_thana_id').val()).trigger('change');
                    }, 1000);
                    setTimeout(function () {
                        $('#permanent_union_id').val($('#present_union_id').val()).trigger('change');
                    }, 1500);
                    setTimeout(function () {
                        $('#permanent_village_id').val($('#present_village_id').val()).trigger('change');
                    }, 2000);
                    $('#permanent_ward_id').val($('#present_ward_id').val()).trigger('change');
                    $('#permanent_road').val($('#present_road').val());
                    $('#permanent_house').val($('#present_house').val());
                    $('#permanent_flat').val($('#present_flat').val());
                }
            });

            // Dynamic Select Box Handlers
            function bindCascadeDropdowns(prefix) {
                // Division -> District
                $(document).on('change', '#' + prefix + '_division_id', function () {
                    let division_id = $(this).val();
                    let district_select = $('#' + prefix + '_district_id');
                    if (division_id) {
                        $.get('{{ url("/get-districts-by-division") }}/' + division_id, function (html) {
                            district_select.html(html).trigger('change');
                        });
                    } else {
                        district_select.html('<option value="">Select District</option>').trigger('change');
                    }
                });

                // District -> Thana
                $(document).on('change', '#' + prefix + '_district_id', function () {
                    let district_id = $(this).val();
                    let thana_select = $('#' + prefix + '_thana_id');
                    if (district_id) {
                        $.get('{{ url("/get-thanas-by-district") }}/' + district_id, function (html) {
                            thana_select.html(html).trigger('change');
                        });
                    } else {
                        thana_select.html('<option value="">Select Thana</option>').trigger('change');
                    }
                });

                // Thana -> Union
                $(document).on('change', '#' + prefix + '_thana_id', function () {
                    let thana_id = $(this).val();
                    let union_select = $('#' + prefix + '_union_id');
                    if (thana_id) {
                        $.get('{{ url("/get-unions-by-thana") }}/' + thana_id, function (html) {
                            union_select.html(html).trigger('change');
                        });
                    } else {
                        union_select.html('<option value="">Select Union</option>').trigger('change');
                    }
                });

                // Union -> Village
                $(document).on('change', '#' + prefix + '_union_id', function () {
                    let union_id = $(this).val();
                    let village_select = $('#' + prefix + '_village_id');
                    if (union_id) {
                        $.get('{{ url("/get-villages-by-union") }}/' + union_id, function (res) {
                            village_select.html(res.villageOptions).trigger('change');
                        });
                    } else {
                        village_select.html('<option value="">Select Village</option>').trigger('change');
                    }
                });
            }

            bindCascadeDropdowns('present');
            bindCascadeDropdowns('permanent');
        });
    </script>
@endpush