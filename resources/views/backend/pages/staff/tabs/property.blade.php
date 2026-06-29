@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'Create'])
@section('title', 'Staff Create')
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
            margin: 0 auto;
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

        .property-choice-grid .property-toggle-label {
            margin-bottom: 0;
            border-radius: 10px;
            padding: 10px 12px;
            font-weight: 600;
            transition: 0.2s ease all;
        }

        .property-choice-grid .property-toggle-input:checked + .property-toggle-label {
            background: #5b4bdf;
            border-color: #5b4bdf;
            color: #fff;
        }

        .property-section-card {
            border: none;
            padding: 0;
            background: transparent;
            box-shadow: none;
            margin-bottom: 0;
        }

        .property-section-card .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 12px;
        }

    </style>
@endpush
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

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            @include('backend.pages.staff.tabs.tab_header', [
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
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label for="cash_amount" class="col-form-label font-weight-bold">Cash Amount</label>
                                            <input type="number" class="form-control" value="{{ $user->propertyInfos->cash_amount ?? '' }}" name="cash_amount" id="cash_amount" placeholder="Cash Amount">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tin_number" class="col-form-label font-weight-bold">E-TIN</label>
                                            <input type="text" name="tin_number" value="{{ $user->propertyInfos->tin_number ?? '' }}" class="form-control" id="tin_number" placeholder="">
                                        </div>
                                    </div>

                                    <div class="row property-choice-grid mt-4">
                                        <!-- House Column -->
                                        <div class="col-xl col-lg-4 col-md-6 col-12 mb-4 px-2">
                                            <div class="text-center font-weight-bold mb-2" style="font-size: 15px; color: #1e293b;">
                                                <i class="fas fa-home mr-1"></i> Have any house?
                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="toggle-button toggle-button-1 r mx-auto" style="top: auto;">
                                                    <input type="checkbox" class="checkbox property-toggle-input" name="house" id="house" value="1" data-target="#house-property" {{ $user->propertyInfos ? ($user->propertyInfos->house ? 'checked' : '') : '' }}>
                                                    <div class="knobs"></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                            <div id="house-property" class="property-section-card {{ $user->propertyInfos ? ($user->propertyInfos->house ? '' : 'd-none') : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="house_type" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">House Type</label>
                                                    <input type="text" name="house_type" value="{{ $user->propertyInfos->house_type ?? '' }}" placeholder="House Type" class="form-control" id="house_type">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_land_quantity" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Land Quantity (in Acre)</label>
                                                    <input type="text" name="house_land_quantity" value="{{ $user->propertyInfos->house_land_quantity ?? '' }}" placeholder="0.0000" class="form-control" id="house_land_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_price" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">House Price</label>
                                                    <input type="number" step="any" name="house_price" value="{{ $user->propertyInfos->house_price ?? '' }}" placeholder="0.00" class="form-control" id="house_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="house_information" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">House Information</label>
                                                    <textarea name="house_information" rows="3" placeholder="House Information" class="form-control" id="house_information">{{ $user->propertyInfos->house_information ?? $user->propertyInfos->house_ownership_status ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Land Column -->
                                        <div class="col-xl col-lg-4 col-md-6 col-12 mb-4 px-2">
                                            <div class="text-center font-weight-bold mb-2" style="font-size: 15px; color: #1e293b;">
                                                <i class="fas fa-mountain mr-1"></i> Have any land?
                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="toggle-button toggle-button-1 r mx-auto" style="top: auto;">
                                                    <input type="checkbox" class="checkbox property-toggle-input" name="land" id="land" value="1" data-target="#land-property" {{ $user->propertyInfos ? ($user->propertyInfos->land ? 'checked' : '') : '' }}>
                                                    <div class="knobs"></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                            <div id="land-property" class="property-section-card {{ $user->propertyInfos ? ($user->propertyInfos->land ? '' : 'd-none') : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="land_type" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Land Type</label>
                                                    <input type="text" name="land_type" value="{{ $user->propertyInfos->land_type ?? '' }}" placeholder="Land Type" class="form-control" id="land_type">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_quantity" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Land Quantity (in Acre)</label>
                                                    <input type="text" name="land_quantity" value="{{ $user->propertyInfos->land_quantity ?? '' }}" placeholder="0.0000" class="form-control" id="land_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_price" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Land Price</label>
                                                    <input type="number" step="any" name="land_price" value="{{ $user->propertyInfos->land_price ?? '' }}" placeholder="0.00" class="form-control" id="land_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="land_information" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Land Information</label>
                                                    <textarea name="land_information" rows="3" placeholder="Land Information" class="form-control" id="land_information">{{ $user->propertyInfos->land_information ?? $user->propertyInfos->land_ownership_status ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Diamond Column -->
                                        <div class="col-xl col-lg-4 col-md-6 col-12 mb-4 px-2">
                                            <div class="text-center font-weight-bold mb-2" style="font-size: 15px; color: #1e293b;">
                                                <i class="fas fa-gem mr-1"></i> Have any diamond?
                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="toggle-button toggle-button-1 r mx-auto" style="top: auto;">
                                                    <input type="checkbox" class="checkbox property-toggle-input" name="diamond" id="diamond" value="1" data-target="#diamond-property" {{ $user->propertyInfos ? ($user->propertyInfos->diamond ? 'checked' : '') : '' }}>
                                                    <div class="knobs"></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                            <div id="diamond-property" class="property-section-card {{ $user->propertyInfos ? ($user->propertyInfos->diamond ? '' : 'd-none') : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="diamond_quantity" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Diamond Quantity (in gram)</label>
                                                    <input type="text" name="diamond_quantity" value="{{ $user->propertyInfos->diamond_quantity ?? '' }}" placeholder="0.00" class="form-control" id="diamond_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="diamond_price" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Diamond Price</label>
                                                    <input type="number" step="any" name="diamond_price" value="{{ $user->propertyInfos->diamond_price ?? '' }}" placeholder="0.00" class="form-control" id="diamond_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="diamond_information" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Diamond Information</label>
                                                    <textarea name="diamond_information" rows="3" placeholder="Diamond Information" class="form-control" id="diamond_information">{{ $user->propertyInfos->diamond_information ?? $user->propertyInfos->diamond_ownership_status ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gold Column -->
                                        <div class="col-xl col-lg-4 col-md-6 col-12 mb-4 px-2">
                                            <div class="text-center font-weight-bold mb-2" style="font-size: 15px; color: #1e293b;">
                                                <i class="fas fa-coins mr-1"></i> Have any gold?
                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="toggle-button toggle-button-1 r mx-auto" style="top: auto;">
                                                    <input type="checkbox" class="checkbox property-toggle-input" name="gold" id="gold" value="1" data-target="#gold-property" {{ $user->propertyInfos ? ($user->propertyInfos->gold ? 'checked' : '') : '' }}>
                                                    <div class="knobs"></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                            <div id="gold-property" class="property-section-card {{ $user->propertyInfos ? ($user->propertyInfos->gold ? '' : 'd-none') : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="gold_quantity" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Gold Quantity (in gram)</label>
                                                    <input type="text" name="gold_quantity" value="{{ $user->propertyInfos->gold_quantity ?? '' }}" placeholder="0.00" class="form-control" id="gold_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="gold_price" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Gold Price</label>
                                                    <input type="number" step="any" name="gold_price" value="{{ $user->propertyInfos->gold_price ?? '' }}" placeholder="0.00" class="form-control" id="gold_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="gold_information" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Gold Information</label>
                                                    <textarea name="gold_information" rows="3" placeholder="Gold Information" class="form-control" id="gold_information">{{ $user->propertyInfos->gold_information ?? $user->propertyInfos->gold_ownership_status ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Silver Column -->
                                        <div class="col-xl col-lg-4 col-md-6 col-12 mb-4 px-2">
                                            <div class="text-center font-weight-bold mb-2" style="font-size: 15px; color: #1e293b;">
                                                <i class="fas fa-key mr-1"></i> Have any silver?
                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <div class="toggle-button toggle-button-1 r mx-auto" style="top: auto;">
                                                    <input type="checkbox" class="checkbox property-toggle-input" name="silver" id="silver" value="1" data-target="#silver-property" {{ $user->propertyInfos ? ($user->propertyInfos->silver ? 'checked' : '') : '' }}>
                                                    <div class="knobs"></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                            <div id="silver-property" class="property-section-card {{ $user->propertyInfos ? ($user->propertyInfos->silver ? '' : 'd-none') : 'd-none' }}">
                                                <div class="form-group mb-2">
                                                    <label for="silver_quantity" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Silver Quantity (in gram)</label>
                                                    <input type="text" name="silver_quantity" value="{{ $user->propertyInfos->silver_quantity ?? '' }}" placeholder="0.00" class="form-control" id="silver_quantity">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="silver_price" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Silver Price</label>
                                                    <input type="number" step="any" name="silver_price" value="{{ $user->propertyInfos->silver_price ?? '' }}" placeholder="0.00" class="form-control" id="silver_price">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="silver_information" class="font-weight-bold mb-1" style="font-size: 13px; color: #334155;">Silver Information</label>
                                                    <textarea name="silver_information" rows="3" placeholder="Silver Information" class="form-control" id="silver_information">{{ $user->propertyInfos->silver_information ?? $user->propertyInfos->silver_ownership_status ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <!-- /.card-body -->
                            <div class="card-footer bg-white mt-3" style="border-top: none;">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('staff.financial', $user->id) }}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Financial</a>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Next</button>
        </div>
        <div class="col-md-4">
            <a href="{{ route('staff.disability', $user->id) }}" class="btn btn-outline-primary btn-block" style="color: #5b4bdf; border-color: #5b4bdf;">Disability <i class="fas fa-arrow-right ml-1"></i></a>
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
            function syncPropertySection(toggle) {
                let $toggle = $(toggle);
                let target = $($toggle.data('target'));
                let optionBox = $toggle.closest('.col-6, .col-md-2');

                if ($toggle.is(':checked')) {
                    target.removeClass('d-none');
                    target.find(':input').prop('disabled', false);
                    optionBox.addClass('active');
                } else {
                    target.addClass('d-none');
                    target.find(':input').prop('disabled', true);
                    optionBox.removeClass('active');
                }
            }

            function syncPropertyMode() {
                let isProperty = $('input[type=radio][name=is_property]:checked').val() === '1';
                let content = $('.property-content');

                if (isProperty) {
                    content.removeClass('d-none');
                    content.find('#cash_amount, #tin_number, .property-toggle-input').prop('disabled', false);
                    content.find('.property-section-card').each(function() {
                        let toggle = content.find('.property-toggle-input[data-target="#' + this.id + '"]');
                        if (toggle.length) {
                            syncPropertySection(toggle);
                        }
                    });
                } else {
                    content.addClass('d-none');
                    content.find(':input').prop('disabled', true);
                }
            }

            $('#peoplePropertyForm').on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('staff.propertyStore') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop('disabled', false);
                        toastr.success(response.message);
                        if (response.redirect_url) {
                            setTimeout(function() {
                                location.href = response.redirect_url;
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop('disabled', false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors || {}, function(key, val) {
                            thisForm.find('.' + key + '-error').text(val[0]);
                        });
                    }
                });
            });

            $(document).on('change', '.property-toggle-input', function() {
                syncPropertySection(this);
            });

            $(document).on('change', 'input[type=radio][name=is_property]', function() {
                syncPropertyMode();
            });

            $('.property-toggle-input').each(function() {
                syncPropertySection(this);
            });

            syncPropertyMode();
        });
    </script>
@endpush
