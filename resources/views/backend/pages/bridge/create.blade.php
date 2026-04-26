@extends('backend.master', ['mainMenu' => 'Bridge', 'subMenu' =>'BridgeCreate'])
@push('style')
@endpush
@section('title', 'Bridge Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bridge Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('bridge.index')}}">Bridge</a></li>
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
                            <h3 class="card-title">Bridge Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Bridge Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Bridge Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Bridge Name Bangla</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Bridge Name Bangla" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Distance</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Kilomitars" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Bridge Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Bridge Type</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Bridge Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Bridge Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Bridge Sub Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Bridge Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Make Year</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="0000-0000" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Make Contactor</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Contactor Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Make Value</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Make Value" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Current Condition</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Current Condition" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Ward No</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Ward No" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Road No</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Road No" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="" class="btn btn-default float-right">Cancel</a>
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

{{-- {{ route('death.store') }} --}}
@endsection
@push('script')

    <script>
         $(document).ready(function() {
             $(".select2").select2();
            $("#deathCertificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
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
@endpush
