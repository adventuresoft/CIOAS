@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Income'])
@push('style')
<style>

</style>
@endpush
@section('title', 'Income Certificate')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Income Certificate</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('income.index')}}">Income Certificate</a></li>
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
                        <h3 class="card-title">People Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="certificateForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">People</label>
                                <div class="col-sm-9">
                                    <select required class="form-control select2" name="user_id" id="">
                                        <option value="">Select People</option>
                                        @if (count($users))
                                        @foreach ($users as $user)
                                        @if (isset($user->people->approved_id))
                                        <option value="{{$user->id}}">{{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        <option value="">No People Found</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Monthly Income</label>
    <div class="col-sm-9">
        <input type="number"
               name="monthly_income"
               class="form-control"
               placeholder="Enter Monthly Income"
               required>
    </div>
</div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="form-group row">
                                <a href="{{route('income.index')}}" class="btn btn-default float-right">Cancel</a>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-info">Submit</button>
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
        $("#certificateForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('income.store') }}",
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
                    }, 2000)
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