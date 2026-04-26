@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
@section('title', 'People Create')
@push('style')
    {{-- <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(251, 24, 24);
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #21d937;
        }




        input:focus+.slider {
            box-shadow: 0 0 1px #21d937;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style> --}}

    <style>
    
        .knobs,
        .layer {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .toggle-button {
            position: relative;
            top: 50%;
            width: 74px;
            height: 36px;
            overflow: hidden;
        }

        .toggle-button.r,
        .toggle-button.r .layer {
            border-radius: 100px;
        }

        .checkbox {
            position: relative;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 3;
        }

        .knobs {
            z-index: 2;
        }

        .layer {
            width: 100%;
            background-color: #fcebeb;
            transition: 0.3s ease all;
            z-index: 1;
        }

        /* Button 1 */
        .toggle-button-1 .knobs:before {
            content: "NO";
            position: absolute;
            top: 4px;
            left: 4px;
            width: 30px;
            height: 30px;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 1;
            padding: 9px 4px;
            background-color: #f44336;
            border-radius: 50%;
            transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
        }

        .toggle-button-1 .checkbox:checked + .knobs:before {
            content: "YES";
            left: 42px;
            background-color: #03a9f4;
        }

        .toggle-button-1 .checkbox:checked ~ .layer {
            background-color: #ebf7fc;
        }

        .toggle-button-1 .knobs,
        .toggle-button-1 .knobs:before,
        .toggle-button-1 .layer {
            transition: 0.3s ease all;
        }

    </style>
@endpush
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
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
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
                            @include('backend.pages.people.tabs.tab_header', [
                                'user' => $user,
                                'active_tab' => 'property',
                            ])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peoplePropertyForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">


                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="is_property" class="col-sm-2 col-form-label">Any Property?</label>
                                    <div class="col-sm-10 px-2">
                                        <label for="property-no">
                                            <input type="radio" value="0" {{(isset($user->propertyInfos->is_property) ?  (($user->propertyInfos->is_property == 0) ? 'checked' : '')  : 'checked')}} id="property-no"
                                                name="is_property">
                                            No
                                        </label>

                                        <label for="property-yes">
                                            <input type="radio" value="1" {{(isset($user->propertyInfos->is_property) ?  (($user->propertyInfos->is_property == 1) ? 'checked' : '')  : '')}} id="property-yes" name="is_property">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="property-content {{(isset($user->propertyInfos->is_property) ?  (($user->propertyInfos->is_property == 1) ? '' : 'd-none')  : 'd-none')}}">
                                    <div class="form-group row">
                                        <label for="cash_amount" class="col-sm-2 col-form-label">Cash Amount</label>
                                        <div class="col-sm-9">
                                            <input type="number"  class="form-control"
                                                value="{{ $user->propertyInfos->cash_amount ?? '' }}" name="cash_amount"
                                                id="cash_amount" placeholder="Cash Amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tin_number" class="col-sm-2 col-form-label">E-TIN</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="tin_number"
                                                value="{{ $user->propertyInfos->tin_number ?? '' }}" class="form-control"
                                                id="tin_number">
                                        </div>
                                    </div>

                                    <br><br>
                                    {{-- House --}}
                                    <div class="form-check d-flex mr-2">
                                        <label for="house"> 
                                            <i class="fa fa-home"></i> 
                                            Have any house? 
                                        </label>
                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="house" id="house" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->house ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>
                                    </div>
                                
                                    
                                    
                                    <hr>

                                    <div
                                        class="house-property  {{ $user->propertyInfos ? ($user->propertyInfos->house ? '' : 'd-none') : 'd-none' }}">
                                        <div class="form-group row">
                                            <label for="house_type" class="col-sm-2 col-form-label">House Type</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="house_type"
                                                    value="{{ $user->propertyInfos->house_type ?? '' }}"
                                                    placeholder="Building/Tien Shed" class="form-control" id="house_type">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="house_area" class="col-sm-2 col-form-label">House Area</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="house_area"
                                                    value="{{ $user->propertyInfos->house_area ?? '' }}"
                                                    placeholder="House Area" class="form-control" id="house_area">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="house_land_quantity" class="col-sm-2 col-form-label">Land
                                                Quantity</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="house_land_quantity"
                                                    value="{{ $user->propertyInfos->house_land_quantity ?? '' }}"
                                                    placeholder="Land Quantity" class="form-control" id="house_land_quantity">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="house_price" class="col-sm-2 col-form-label">House Price</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="house_price"
                                                    value="{{ $user->propertyInfos->house_price ?? '' }}"
                                                    placeholder="House Price" class="form-control" id="house_price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="house_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="house_ownership_status"
                                                    value="{{ $user->propertyInfos->house_ownership_status ?? '' }}"
                                                    placeholder="Ownership Status" class="form-control"
                                                    id="house_ownership_status">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="house_address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3" name="house_address" placeholder="Address" id="house_address">{{ $user->propertyInfos->house_address ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <br><br>
                                    {{-- Land --}}
                                    <div class="form-check d-flex mr-2">
                                        <label for="land">
                                            <i class="fa fa-mountain"></i>
                                            Have any land?
                                        </label>


                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="land" id="land" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->land ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div
                                        class="land-property {{ $user->propertyInfos ? ($user->propertyInfos->land ? '' : 'd-none') : 'd-none' }}">

                                        <div class="form-group row">
                                            <label for="land_district_id" class="col-sm-2 col-form-label">District</label>
                                            <div class="col-sm-9">
                                                <select name="land_district_id" class="form-control select2" id="land_district_id">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $user->propertyInfos ? ($user->propertyInfos->land_district_id == $district->id ? 'selected' : '') : '' }}>
                                                            {{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_thana_id" class="col-sm-2 col-form-label">Thana</label>
                                            <div class="col-sm-9">
                                                <select name="land_thana_id" class="form-control select2" id="land_thana_id">
                                                    <option value="">Select Thana</option>
                                                    @if (count($landThanas))
                                                        @foreach($landThanas as $landThana)
                                                            <option value="{{$landThana->id}}" {{ $user->propertyInfos ? ($user->propertyInfos->land_thana_id == $landThana->id ? 'selected' : '') : '' }}  >{{$landThana->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_mouza_id" class="col-sm-2 col-form-label">Mouza</label>
                                            <div class="col-sm-9">
                                                <select name="land_mouza_id" class="form-control select2" id="land_mouza_id">
                                                    <option value="">Select Mouza</option>
                                                    @if (count($landMouzas))
                                                        @foreach($landMouzas as $landMouza)
                                                            <option value="{{$landMouza->id}}" {{ $user->propertyInfos ? ($user->propertyInfos->land_mouza_id == $landMouza->id ? 'selected' : '') : '' }}  >{{$landMouza->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_khatian_id" class="col-sm-2 col-form-label">Khatian</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_khatian_id"
                                                    value="{{ $user->propertyInfos->land_khatian_id ?? '' }}"
                                                    placeholder="Khatian No." class="form-control" id="land_khatian_id">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_dag_no" class="col-sm-2 col-form-label">Dag No.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_dag_no"
                                                    value="{{ $user->propertyInfos->land_dag_no ?? '' }}"
                                                    placeholder="Dag No." class="form-control" id="land_dag_no">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_bs" class="col-sm-2 col-form-label">BS</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_bs"
                                                    value="{{ $user->propertyInfos->land_bs ?? '' }}" placeholder="BS"
                                                    class="form-control" id="land_bs">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_rs" class="col-sm-2 col-form-label">RS</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_rs"
                                                    value="{{ $user->propertyInfos->land_rs ?? '' }}" placeholder="RS"
                                                    class="form-control" id="land_rs">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_sa" class="col-sm-2 col-form-label">SA</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_sa"
                                                    value="{{ $user->propertyInfos->land_sa ?? '' }}" placeholder="SA"
                                                    class="form-control" id="land_sa">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_cs" class="col-sm-2 col-form-label">CS</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_cs"
                                                    value="{{ $user->propertyInfos->land_cs ?? '' }}" placeholder="CS"
                                                    class="form-control" id="land_cs">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_quantity" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_quantity"
                                                    value="{{ $user->propertyInfos->land_quantity ?? '' }}"
                                                    placeholder="Quantity" class="form-control" id="land_quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_type" class="col-sm-2 col-form-label">Land Type</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_type"
                                                    value="{{ $user->propertyInfos->land_type ?? '' }}"
                                                    placeholder="Land Type" class="form-control" id="land_type">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="land_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="land_ownership_status"
                                                    value="{{ $user->propertyInfos->land_ownership_status ?? '' }}"
                                                    placeholder="Land Ownership Status" class="form-control"
                                                    id="land_ownership_status">
                                            </div>
                                        </div>

                                    </div>


                                    <br><br>
                                    {{-- Flat --}}
                                    <div class="form-check d-flex mr-2">

                                        <label for="flat">
                                            <i class="fa fa-building"></i>
                                            Have any flat?
                                        </label>
                                        {{-- <label class="switch">
                                            <input type="checkbox" name="flat" id="flat"
                                                {{ $user->propertyInfos ? ($user->propertyInfos->flat ? 'checked' : '') : '' }}
                                                value="1">
                                            <span class="slider round"></span>
                                        </label> --}}

                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="flat" id="flat" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->flat ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div
                                        class="flat-property {{ $user->propertyInfos ? ($user->propertyInfos->flat ? '' : 'd-none') : 'd-none' }}">

                                        <div class="form-group row">
                                            <label for="flat_district_id" class="col-sm-2 col-form-label">District</label>
                                            <div class="col-sm-9">
                                                <select name="flat_district_id" class="form-control select2" id="flat_district_id">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $user->propertyInfos ? ($user->propertyInfos->flat_district_id == $district->id ? 'selected' : '') : '' }}>
                                                            {{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_thana_id" class="col-sm-2 col-form-label">Thana</label>
                                            <div class="col-sm-9">
                                                <select name="flat_thana_id" class="form-control select2" id="flat_thana_id">
                                                    <option value="">Select Thana</option>
                                                    @if (count($flatThanas))
                                                        @foreach($flatThanas as $landThana)
                                                            <option value="{{$landThana->id}}" {{ $user->propertyInfos ? ($user->propertyInfos->flat_thana_id == $landThana->id ? 'selected' : '') : '' }}  >{{$landThana->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_mouza_id" class="col-sm-2 col-form-label">Mouza</label>
                                            <div class="col-sm-9">
                                                <select name="flat_mouza_id" class="form-control select2" id="flat_mouza_id">
                                                    <option value="">Select Mouza</option>
                                                    @if (count($flatMouzas))
                                                        @foreach($flatMouzas as $flatMouza)
                                                            <option value="{{$flatMouza->id}}" {{ $user->propertyInfos ? ($user->propertyInfos->flat_mouza_id == $flatMouza->id ? 'selected' : '') : '' }}  >{{$flatMouza->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_area" class="col-sm-2 col-form-label">Flat Area</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ $user->propertyInfos->flat_area ?? '' }}"
                                                    name="flat_area" placeholder="Flat Area" class="form-control"
                                                    id="flat_area">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_road" class="col-sm-2 col-form-label">Flat Road</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flat_road"
                                                    value="{{ $user->propertyInfos->flat_road ?? '' }}"
                                                    placeholder="Flat Road" class="form-control" id="flat_road">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_house_no" class="col-sm-2 col-form-label">Flat House No.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flat_house_no"
                                                    value="{{ $user->propertyInfos->flat_house_no ?? '' }}"
                                                    placeholder="Flat House No." class="form-control" id="flat_house_no">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_quantity" class="col-sm-2 col-form-label">Flat Quantity</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flat_quantity"
                                                    value="{{ $user->propertyInfos->flat_quantity ?? '' }}"
                                                    placeholder="Flat Quantity" class="form-control" id="flat_quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_price" class="col-sm-2 col-form-label">Flat Price</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flat_price" placeholder="Flat Price"
                                                    value="{{ $user->propertyInfos->flat_price ?? '' }}" class="form-control"
                                                    id="flat_price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="flat_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="flat_ownership_status"
                                                    value="{{ $user->propertyInfos->flat_ownership_status ?? '' }}"
                                                    placeholder="Flat Ownership Status" class="form-control"
                                                    id="flat_ownership_status">
                                            </div>
                                        </div>
                                    </div>


                                    <br><br>
                                    {{-- Diamond --}}
                                    <div class="form-check d-flex mr-2">
                                        <label for="diamond">
                                            <i class="fa fa-gem"></i>
                                            Have any diamond?
                                        </label>
                                        {{-- <label class="switch">
                                            <input type="checkbox" name="diamond" id="diamond"
                                                {{ $user->propertyInfos ? ($user->propertyInfos->diamond ? 'checked' : '') : '' }}
                                                value="1">
                                            <span class="slider round"></span>
                                        </label> --}}

                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="diamond" id="diamond" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->diamond ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>

                                    </div>
                                    <hr>

                                    <div
                                        class="diamond-property {{ $user->propertyInfos ? ($user->propertyInfos->diamond ? '' : 'd-none') : 'd-none' }}">

                                        <div class="form-group row">
                                            <label for="diamond_type" class="col-sm-2 col-form-label">Diamond Type</label>
                                            <div class="col-sm-9">
                                                <select name="diamond_type" class="form-control" id="diamond_type">
                                                    @foreach (property_constant_option('diamondType') as $key => $text)
                                                        <option value="{{$key}}" {{ $user->propertyInfos ? ($user->propertyInfos->diamond_type ==  $key ? 'selected' : '') : '' }}>{{$text}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="diamond_quantity" class="col-sm-2 col-form-label">Diamond Qty.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="diamond_quantity"
                                                    value="{{ $user->propertyInfos->diamond_quantity ?? '' }}"
                                                    placeholder="Diamond  Qty." class="form-control" id="diamond_quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="diamond_price" class="col-sm-2 col-form-label">Diamond Price.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="diamond_price"
                                                    value="{{ $user->propertyInfos->diamond_price ?? '' }}"
                                                    placeholder="Diamond  Price." class="form-control" id="diamond_price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="diamond_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="diamond_ownership_status"
                                                    value="{{ $user->propertyInfos->diamond_ownership_status ?? '' }}"
                                                    placeholder="Diamond Ownership Status" class="form-control"
                                                    id="diamond_ownership_status">
                                            </div>
                                        </div>

                                    </div>


                                    <br><br>
                                    {{-- Gold --}}
                                    <div class="form-check d-flex mr-2">

                                        <label for="gold">
                                            <i class="fa fa-coins"></i>
                                            Have any gold?
                                        </label>
                                        {{-- <label class="switch">
                                            <input type="checkbox" name="gold" id="gold"
                                                {{ $user->propertyInfos ? ($user->propertyInfos->gold ? 'checked' : '') : '' }}
                                                value="1">
                                            <span class="slider round"></span>
                                        </label> --}}
                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="gold" id="gold" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->gold ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div
                                        class="gold-property {{ $user->propertyInfos ? ($user->propertyInfos->gold ? '' : 'd-none') : 'd-none' }} ">
                                        <div class="form-group row">
                                            <label for="gold_type" class="col-sm-2 col-form-label">Gold Type</label>
                                            <div class="col-sm-9">
                                                <select name="gold_type" class="form-control" id="gold_type">
                                                    @foreach (property_constant_option('goldType') as $key => $text)
                                                        <option value="{{$key}}" {{ $user->propertyInfos ? ($user->propertyInfos->gold_type ==  $key ? 'selected' : '') : '' }}>{{$text}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gold_quantity" class="col-sm-2 col-form-label">Gold Qty.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gold_quantity"
                                                    value="{{ $user->propertyInfos->gold_quantity ?? '' }}"
                                                    placeholder="Gold  Qty." class="form-control" id="gold_quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gold_price" class="col-sm-2 col-form-label">Gold Price.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gold_price"
                                                    value="{{ $user->propertyInfos->gold_price ?? '' }}"
                                                    placeholder="Gold Price." class="form-control" id="gold_price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gold_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="gold_ownership_status"
                                                    value="{{ $user->propertyInfos->gold_ownership_status ?? '' }}"
                                                    placeholder="Gold Ownership Status" class="form-control"
                                                    id="gold_ownership_status">
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>
                                    {{-- Silver --}}
                                    <div class="form-check d-flex mr-2">
                                        <label for="silver">
                                            <i class="fa fa-utensil-spoon"></i>
                                            Have any silver?
                                        </label>
                                        {{-- <label class="switch">
                                            <input type="checkbox" name="silver" id="silver"
                                                {{ $user->propertyInfos ? ($user->propertyInfos->silver ? 'checked' : '') : '' }}
                                                value="1">
                                            <span class="slider round"></span>
                                        </label> --}}
                                        <div class="toggle-button r toggle-button-1">
                                            <input type="checkbox" class="checkbox" name="silver" id="silver" value="1"  {{ $user->propertyInfos ? ($user->propertyInfos->silver ? 'checked' : '') : '' }} />
                                            <div class="knobs"></div>
                                            <div class="layer"></div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div
                                        class="silver-property {{ $user->propertyInfos ? ($user->propertyInfos->silver ? '' : 'd-none') : 'd-none' }}">

                                        <div class="form-group row">
                                            <label for="silver_type" class="col-sm-2 col-form-label">Silver Type</label>
                                            <div class="col-sm-9">
                                                <select name="silver_type" class="form-control" id="silver_type">
                                                    @foreach (property_constant_option('silverType') as $key => $text)
                                                        <option value="{{$key}}" {{ $user->propertyInfos ? ($user->propertyInfos->silver_type ==  $key ? 'selected' : '') : '' }}>{{$text}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="silver_quantity" class="col-sm-2 col-form-label">Silver Qty.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="silver_quantity"
                                                    value="{{ $user->propertyInfos->silver_quantity ?? '' }}"
                                                    placeholder="Silver  Qty." class="form-control" id="silver_quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="silver_price" class="col-sm-2 col-form-label">Silver Price.</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="silver_price"
                                                    value="{{ $user->propertyInfos->silver_price ?? '' }}"
                                                    placeholder="Silver Price." class="form-control" id="silver_price">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="silver_ownership_status" class="col-sm-2 col-form-label">Ownership
                                                Status</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="silver_ownership_status"
                                                    value="{{ $user->propertyInfos->silver_ownership_status ?? '' }}"
                                                    placeholder="Silver Ownership Status" class="form-control"
                                                    id="silver_ownership_status">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.financial', $user->id) }}"
                                            class="btn btn-danger btn-block">Financial</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.disability', $user->id) }}"
                                            class="btn btn-primary btn-block ">Disability</a>
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
            $(".select2").select2();
            $("#peoplePropertyForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.propertyStore') }}",
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
                        // setTimeout(function() {
                        //     location.href = "/";
                        // }, 2000)
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

        $(document).on('change', '#house', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.house-property').removeClass('d-none');
            } else {
                $('.house-property').addClass('d-none');
            }
        })

        $(document).on('change', '#land', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.land-property').removeClass('d-none');
            } else {
                $('.land-property').addClass('d-none');
            }
        })

        $(document).on('change', '#flat', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.flat-property').removeClass('d-none');
            } else {
                $('.flat-property').addClass('d-none');
            }
        })

        $(document).on('change', '#diamond', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.diamond-property').removeClass('d-none');
            } else {
                $('.diamond-property').addClass('d-none');
            }
        })

        $(document).on('change', '#gold', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.gold-property').removeClass('d-none');
            } else {
                $('.gold-property').addClass('d-none');
            }
        })

        $(document).on('change', '#silver', function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('.silver-property').removeClass('d-none');
            } else {
                $('.silver-property').addClass('d-none');
            }
        })

        $(document).on('change', '#land_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let land_thana_id = $("#land_thana_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        land_thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function(response) {
                        land_thana_id.html(response)
                        land_thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        land_thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                land_thana_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#land_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let land_mouza_id = $("#land_mouza_id");

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-mouzas-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        land_mouza_id.prop("disabled", true);
                        console.log("Searcing Mouza");
                    },
                    success: function(response) {
                        land_mouza_id.html(response)
                        land_mouza_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        land_mouza_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                land_mouza_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#flat_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let land_thana_id = $("#flat_thana_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        land_thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function(response) {
                        land_thana_id.html(response)
                        land_thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        land_thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                land_thana_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#flat_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let flat_mouza_id = $("#flat_mouza_id");

            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-mouzas-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        flat_mouza_id.prop("disabled", true);
                        console.log("Searcing Mouza");
                    },
                    success: function(response) {
                        flat_mouza_id.html(response)
                        flat_mouza_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        flat_mouza_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                flat_mouza_id.prop("disabled", true);
            }
        })

        $(document).on('change', 'input[type=radio][name=is_property]', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            let _this_property_content =  $(".property-content");
            if (parseInt(_this_value)) {
                _this_property_content.removeClass('d-none');
                _this_property_content.find('input').prop('disabled', false);
            } else {
                _this_property_content.removeClass('d-none').addClass('d-none');
                _this_property_content.find('input').prop('disabled', true);
            }
        })
    </script>
@endpush
