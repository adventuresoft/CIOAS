@extends('backend.master', ['mainMenu' => 'Marriage', 'subMenu' =>'MarriageCreate'])
@push('style')
@endpush
@section('title', 'Marriage Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Marriage Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('marriage.index')}}">Marriage</a></li>
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
                            <h3 class="card-title">Marriage Reg. Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Marriage Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Marriage Address" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Thana</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Thana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">UP</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">UP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Village</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Village</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Ward No</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Ward</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Groom ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Groom ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Groom Age</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Groom Age" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Bried ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Bried ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Bried Age</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Bried Age" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Bried Status</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Un-Married/Devorssi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Groom Status</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Un-Married/Married/Devorssi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Bried Ukil</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Bried Ukil" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Withness (1) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Withness (2) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Groom Ukil</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Groom Ukil" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Withness (1) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Withness (2) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Marrige Withness (1) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Marrige Withness (2) ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Withness ID" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Marrige Final Date</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Marrige Final Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Den Mohor</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">TK</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Ward No</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Ward</option>
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
