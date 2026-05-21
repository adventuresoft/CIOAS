@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'Create'])
@section('title', 'Staff Create')
@section('content')
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
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                @include('backend.pages.staff.tabs.tab_header', [
                                    'user' => $user,
                                    'active_tab' => 'july_figher',
                                ])
                            </h3>
                        </div>

                        <form class="form-horizontal" id="peopleJulyFigherForm" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Is July Figher?</label>
                                    <div class="col-sm-9 px-2">
                                        <label for="july-fighter-no">
                                            <input type="radio" value="0" {{ (isset($user->freedomFighterInfo->is_july_fighter) ? (($user->freedomFighterInfo->is_july_fighter == 0) ? 'checked' : '') : 'checked') }} id="july-fighter-no" name="is_july_fighter">
                                            No
                                        </label>

                                        <label for="july-fighter-yes">
                                            <input type="radio" value="1" {{ (isset($user->freedomFighterInfo->is_july_fighter) ? (($user->freedomFighterInfo->is_july_fighter == 1) ? 'checked' : '') : '') }} id="july-fighter-yes" name="is_july_fighter">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="july-fighter-content {{ (isset($user->freedomFighterInfo->is_july_fighter) ? (($user->freedomFighterInfo->is_july_fighter == 1) ? '' : 'd-none') : 'd-none') }}">
                                    <div class="form-group row">
                                        <label for="july_type_id" class="col-sm-3 col-form-label">July Figher Type</label>
                                        <div class="col-sm-9">
                                            <select name="july_type_id" class="form-control" id="july_type_id">
                                                <option value="">Select Type</option>
                                                @foreach (freedom_fighter_constant_option('type') as $key => $item)
                                                    <option value="{{ $key }}" {{ isset($user->freedomFighterInfo->july_type_id) ? (($user->freedomFighterInfo->july_type_id == $key) ? 'selected' : '') : '' }}>{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger error july_type_id_error"></small>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="july_fighter_id" class="col-sm-3 col-form-label">July Figher ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="july_fighter_id" value="{{ $user->freedomFighterInfo->july_fighter_id ?? '' }}" class="form-control" id="july_fighter_id">
                                            <small class="text-danger error july_fighter_id_error"></small>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card-footer bg-white mt-3" style="border-top: none;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('staff.freedom', $user->id) }}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Freedom Fighter</a>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Finish</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#peopleJulyFigherForm').on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);

                Swal.fire({
                    title: 'স্টাফ তৈরি করতে Okay বাটনে ক্লিক করুন',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#5b4bdf',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Okay',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (!result.isConfirmed) {
                        return;
                    }

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('staff.julyFigherStore') }}",
                        data: new FormData(thisForm[0]),
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
                                }, 1000);
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
            });

            $(document).on('change', 'input[type=radio][name=is_july_fighter]', function(e) {
                e.preventDefault();
                let val = $(this).val();
                if (parseInt(val)) {
                    $('.july-fighter-content').removeClass('d-none');
                } else {
                    $('.july-fighter-content').removeClass('d-none').addClass('d-none');
                }
            });
        });
    </script>
@endpush
