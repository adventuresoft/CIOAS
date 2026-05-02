@extends('backend.master', ['mainMenu' => 'Road', 'subMenu' =>'RoadCreate'])
@push('style')
@endpush
@section('title', 'Road Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Road Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('road.index')}}">Road</a></li>
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
                            <h3 class="card-title">Road Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="roadForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Road</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" placeholder="Road" class="form-control" id="name">
                                        <span class="error name-error text-danger"></span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Road Bangla</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" placeholder="Road Bangla" class="form-control" id="bn_name">
                                        <span class="error bn_name-error text-danger"></span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="start_point" class="col-sm-2 col-form-label">Start Point</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="start_point" class="form-control" name="start_point" placeholder="Enter start point">
                                        <span class="error start_point-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="end_point" class="col-sm-2 col-form-label">End Point</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="end_point" class="form-control" name="end_point" placeholder="Enter end point">
                                        <span class="error end_point-error text-danger"></span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="distance" class="col-sm-2 col-form-label">Distance</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="any"  placeholder="0.00" name="distance" class="form-control" id="distance">
                                        <span class="error distance-error text-danger"></span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="road_type" class="col-sm-2 col-form-label">Road Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="road_type" id="road_type">
                                             @if (count($road_types))
                                                @foreach ($road_types as $road_type)
                                                    <option value="{{$road_type->id}}">{{$road_type->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error road_type-error text-danger"></span>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="road_category" class="col-sm-2 col-form-label">Road Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="road_category" id="road_category">
                                            <option value="">Select Road Category</option>
                                            @if (count($road_categories))
                                                @foreach ($road_categories as $road_category)
                                                    <option value="{{$road_category->id}}">{{$road_category->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error road_category-error text-danger"></span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="road_owner" class="col-sm-2 col-form-label">Road Owner</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="road_owner" id="road_owner">
                                            <option value="">Select Road Owner</option>
                                            @if (count($road_owners))
                                                @foreach ($road_owners as $road_owner)
                                                    <option value="{{$road_owner->id}}">{{$road_owner->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="error road_owner-error text-danger"></span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="make_year" class="col-sm-2 col-form-label">Make Year</label>
                                    <div class="col-sm-9">
                                        <input type="number" min="1900"  max="{{date('Y')}}" placeholder="YYYY" name="make_year"  class="form-control" id="make_year">
                                        <span class="error make_year-error text-danger"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="make_contactor" class="col-sm-2 col-form-label">Make Contactor</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="make_contactor" placeholder="Contactor Name" class="form-control" id="make_contactor">
                                        <span class="error make_contactor-error text-danger"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="make_value" class="col-sm-2 col-form-label">Make Value</label>
                                    <div class="col-sm-9">
                                        <input type="number" step="any" placeholder="eg.500000" name="make_value"  class="form-control" id="make_value">
                                        <span class="error make_value-error text-danger"></span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="current_condition" class="col-sm-2 col-form-label">Current Condition</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="current_condition" placeholder="Current Condition" class="form-control" id="current_condition">
                                        <span class="error current_condition-error text-danger"></span>

                                    </div>
                                </div>
                                 


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('road.index')}}" class="btn btn-default float-right">Cancel</a>
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
            $("#roadForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('road.store')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        $(".error").html('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = "{{route('road.index')}}";
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
