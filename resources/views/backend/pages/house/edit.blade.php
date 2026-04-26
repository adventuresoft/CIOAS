@extends('backend.master', ['mainMenu' => 'House', 'subMenu' =>'HouseList'])
@push('style')
@endpush
@section('title', 'House Edit')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>House Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('house.index')}}">House</a></li>
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
                                <a href="{{route('house.create')}}">  <span class="text-light">House Information</span>  </a> <span class="text-secondary">|</span>
                                <a href="{{route('house-ownership.edit', $house->id)}}">  <span class="text-dark">Ownership Information</span>  </a> 
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="houseForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$house->id}}">
                            @include('backend.pages.house.forms.house', ['house' => $house ]) 

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="{{route('house.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit & Next</button>
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
       $("#houseForm").on('submit', function(e) {
           e.preventDefault();
           let thisForm = $(this);
           $.ajax({
               type: "POST",
               url: "{{route('house.store')}}",
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

    $(document).on('change', '#house_type_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('/house-category-options-by-type-id') }}/"+_this_value,
                beforeSend: function() {
                    $('#house_category_id').prop("disabled", true);
                    console.log("Searcing Category");
                },
                success: function(response) {
                    $('#house_category_id').html(response)
                    $('#house_category_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    
                }

            });
        }
    })

    $(document).on('change', '#village_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                beforeSend: function() {
                    $('#village_area_id').prop("disabled", true);
                    console.log("Searcing Village Area");
                },
                success: function(response) {
                    $('#village_area_id').html(response)
                    $('#village_area_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        }
    })
</script>
@endpush
