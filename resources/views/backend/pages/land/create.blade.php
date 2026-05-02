@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' =>'LandCreate'])
@push('style')
@endpush
@section('title', 'Land Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Land Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('land.index')}}">Land</a></li>
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
                            <h3 class="card-title">Land Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Tafshil Thana</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Thana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Tafshil Mouza</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Mouza</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">BRS Khatian</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="BRS Khatian" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">BRS Dag</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="BRS Dag" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Type</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Class</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Class</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Ownership Typey</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Ownership Type</option>
                                        </select>
                                    </div>
                                </div><div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Total Qty.</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Total Qty" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Ownership Qty</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Ownership Qty" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Price" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Owner ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Owner Id" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Owner Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-9">
                                        <textarea name="comment" class="form-control" id="" placeholder="Remarks" cols="30" rows="3"></textarea>
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
