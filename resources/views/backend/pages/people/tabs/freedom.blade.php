@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
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
                            <h3 class="card-title">
                                @include('backend.pages.people.tabs.tab_header', [
                                    'user' => $user,
                                    'active_tab' => 'freedom',
                                ])
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleFreedomForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">


                            <div class="card-body">

                            
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Is Freedom Fighter?</label>
                                    <div class="col-sm-9 px-2">
                                        <label for="fighter-no">
                                            <input type="radio" value="0" {{(isset($user->freedomFighterInfo->is_freedom_fighter) ?  (($user->freedomFighterInfo->is_freedom_fighter == 0) ? 'checked' : '')  : 'checked')}} id="fighter-no" name="is_freedom_fighter">
                                            No
                                        </label>

                                        <label for="fighter-yes">
                                            <input type="radio" value="1" {{(isset($user->freedomFighterInfo->is_freedom_fighter) ?  (($user->freedomFighterInfo->is_freedom_fighter == 1) ? 'checked' : '')  : '')}} id="fighter-yes" name="is_freedom_fighter">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="fighter-content {{(isset($user->freedomFighterInfo->is_freedom_fighter) ?  (($user->freedomFighterInfo->is_freedom_fighter == 1) ? '' : 'd-none')  : 'd-none')}}">

                                
                                <div class="form-group row">
                                    <label for="type_id" class="col-sm-3 col-form-label">Freedom Fighter Type</label>
                                    <div class="col-sm-9">
                                        <select name="type_id" required class="form-control" id="type_id">
                                            <option value="">Select Type</option>
                                            @foreach (freedom_fighter_constant_option('type') as $key => $item)
                                                <option value="{{$key}}" {{isset($user->freedomFighterInfo->type_id) ? (($user->freedomFighterInfo->type_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error type_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="area_id" class="col-sm-3 col-form-label">Freedom Fight Area</label>
                                    <div class="col-sm-9">
                                        <select name="area_id" required class="form-control" id="area_id">
                                            <option value="">Select Area</option>
                                            @foreach (freedom_fighter_constant_option('area') as $key => $item)
                                                <option value="{{$key}}" {{isset($user->freedomFighterInfo->area_id) ? (($user->freedomFighterInfo->area_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error area_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="designation_id" class="col-sm-3 col-form-label">Designation</label>
                                    <div class="col-sm-9">
                                        <select name="designation_id" required class="form-control" id="designation_id">
                                            <option value="">Select Designation</option>
                                            @foreach (freedom_fighter_constant_option('designation') as $key => $item)
                                                <option value="{{$key}}" {{isset($user->freedomFighterInfo->designation_id) ? (($user->freedomFighterInfo->designation_id == $key) ? 'selected' : '' ) : ''  }} >{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error designation_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="freedom_fighter_id" class="col-sm-3 col-form-label"> Freedom Fighter ID </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="freedom_fighter_id" value="{{$user->freedomFighterInfo->freedom_fighter_id ?? ''}}" class="form-control" id="freedom_fighter_id">
                                        <small class="text-danger error freedom_fighter_id_error"></small>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="commander_name" class="col-sm-3 col-form-label">Commander Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="commander_name" value="{{$user->freedomFighterInfo->commander_name ?? ''}}" class="form-control" id="commander_name">
                                        <small class="text-danger error commander_name_error"></small>

                                    </div>
                                </div>

                            </div>

                            </div>

                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.disability', $user->id) }}"
                                            class="btn btn-danger btn-block">Disability</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Finish</button>
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
            $("#peopleFreedomForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.freedomStore') }}",
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


        $(document).on('change', 'input[type=radio][name=is_freedom_fighter]', function(e) {
            e.preventDefault();
            let _this_value = $(this).val();
            if (parseInt(_this_value)) {
                $(".fighter-content").removeClass('d-none');
            } else {
                $(".fighter-content").removeClass('d-none').addClass('d-none');
            }
        })
    </script>
    
@endpush
