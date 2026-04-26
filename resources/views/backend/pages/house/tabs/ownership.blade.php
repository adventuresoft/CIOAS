@extends('backend.master', ['mainMenu' => 'House', 'subMenu' =>'HouseCreate'])
@push('style')
@endpush
@section('title', 'House Create')
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
                                <a href="{{route('house.edit', $house->id)}}">  <span class="text-dark">House Information</span>  </a> <span class="text-secondary">|</span>
                                <a href="{{route('house-ownership.edit', $house->id)}}">  <span class="text-light">Ownership Information</span>  </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="houseOwnershipForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="house_id" value="{{$house->id}}">
                            <div class="card-body">

                                <div id="load-ownership">
                                    @if (count($house->ownership))
                                        @foreach($house->ownership as $ownership)
                                            @include('backend.pages.house.forms.ownership', ['ownership' => $ownership ]) 
                                        @endforeach
                                    @else 
                                        @include('backend.pages.house.forms.ownership', ['ownership' => null ]) 
                                    @endif



                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                                @if ($house->house_owner_type_id == 2)
                                    <div class="row mb-1">
                                        <div class="col-sm-3">
                                            <button type="button" id="addMoreOwner" title="Add More Owner" class="btn btn-primary">Add More Owner</button>
                                        </div>
                                    </div>
                                @endif

                                

                                <div class="row">
                                    <a href="{{route('house.edit', $house->id)}}" class="btn btn-danger float-right">House Info</a>
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
            $("#houseOwnershipForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('house-ownership.store')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        $('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('click', '#addMoreOwner', function(e){
            e.preventDefault();
            $.ajax({
               type: "GET",
               url: "{{ url('/house-single-ownership-form') }}",
               beforeSend: function() {
                   console.log("Searcing Owner Form");
               },
               success: function(response) {
                   $('#load-ownership').append(response)
               },
               error: function(xhr, status, error) {
                   var responseText = jQuery.parseJSON(xhr.responseText);
                   toastr.error(responseText.message);
                  
               }

           });
        })

        $(document).on('click', '.remove-single-ownership', function(){
            let _this = $(this);

            if (confirm("Are you sure?")){
                let _this_id = _this.attr('data-id');
                if (_this_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/house-ownership-remove') }}/"+_this_id,
                        beforeSend: function() {
                            console.log("Removeing ownership");
                        },
                        success: function(response) {
                            _this.closest('.signle-ownership').remove();
                            toastr.success(response.message);
                        },
                        error: function(xhr, status, error) {
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                            
                        }

                    });
                }else {
                    _this.closest('.signle-ownership').remove();
                }

                
            }else {
                return false;
            }
        })
    </script>
@endpush
