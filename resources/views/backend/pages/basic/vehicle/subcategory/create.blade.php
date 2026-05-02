@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'VehicleSubcategory'])
@push('style')
@endpush
@section('title', 'Vehicle Subcategory')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Vehicle Subcategory</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            {{-- {{route('death.index')}} --}}
            <li class="breadcrumb-item"><a href="">Vehicle Subcategory</a></li>
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
                            <h3 class="card-title">Vehicle Subcategory Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Vehicle Sub Category</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Vehicle Sub Category" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Vehicle Sub Category Bangla</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Vehicle Sub Category Bangla" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Vehicle Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Vehicle Category</option>
                                        </select>
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
                    dataSubcategory: "json",
                    contentSubcategory:false,
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
