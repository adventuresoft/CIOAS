@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Name'])

@push('style')
<style>

</style>
@endpush

@section('title', 'Name Certificate')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Name Certificate</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('name.index')}}">Name Certificate</a>
                    </li>
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
                        <h3 class="card-title">People Info</h3>
                    </div>

                    <form class="form-horizontal" id="certificateForm" method="POST">
                        @csrf

                        <div class="card-body">

                            <!-- People Select -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">People ID</label>

                                <div class="col-sm-9">

                                    <select required class="form-control select2" name="user_id" id="user_id">

                                        <option value="">Select People</option>

                                        @if (count($users))

                                        @foreach ($users as $user)

                                        @if (isset($user->people->approved_id))

                                        <option value="{{$user->id}}">
                                            {{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile}}
                                        </option>

                                        @endif

                                        @endforeach

                                        @else

                                        <option>No People Found</option>

                                        @endif

                                    </select>

                                    <span class="text-danger user_id-error"></span>

                                </div>
                            </div>


                            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name English</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="name_english" placeholder="Enter Name English" required>
        <span class="text-danger name_english-error"></span>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name Bangla</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="name_bangla" placeholder="Enter Name Bangla" required>
        <span class="text-danger name_bangla-error"></span>
    </div>
</div>


                        </div>


                        <div class="card-footer">

                            <a href="{{route('name.index')}}" class="btn btn-default">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-info">
                                Submit
                            </button>

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

        $('.select2').select2();

        $("#certificateForm").on('submit', function(e) {

            e.preventDefault();

            let thisForm = $(this);

            $.ajax({

                type: "POST",

                url: "{{ route('name.store') }}",

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

                    setTimeout(function() {

                        location.href = response.redirect_url;

                    }, 2000);

                },

                error: function(xhr) {

                    thisForm.find('button[type="submit"]').prop("disabled", false);

                    var responseText = jQuery.parseJSON(xhr.responseText);

                    toastr.error(responseText.message);

                    $.each(responseText.errors, function(key, val) {

                        thisForm.find("." + key + "-error").text(val[0]);

                    });

                }

            });

        });

    });
</script>

@endpush