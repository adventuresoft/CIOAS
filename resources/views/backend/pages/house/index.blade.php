@extends('backend.master', ['mainMenu' => 'House', 'subMenu' =>'HouseList'])
@push('style')
@endpush
@section('title', 'House List')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>House List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('house.index')}}">House List</a></li>
            <li class="breadcrumb-item active">View</li>
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
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">House List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                  @if (Auth::user()->institute_id && create_permission() )
                                    <a href="{{route('house.create')}}" class="btn btn-primary">Create</a>
                                   @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                          <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>House Name</th>
                                    <th>Village / Ward No.</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if (count($houses))
                                  @foreach ($houses as $key => $house)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$house->house}}</td>
                                      <td>{{$house->village->en_name ?? ''}} / Ward {{$house->unionWard->en_ward_no ?? ''}}</td>
                                      <td style="width: 10%">

                                        <div class="table-action">
                                            @if (Auth::user()->institute_id && create_permission() )
                                                <a href="{{ route('house.edit', $house->id) }}" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <form class="deleteHouse" method="post">
                                                  @csrf
                                                  @method('Delete')
                                                  <input type="hidden" class="deleteUrl" name="delete_url" value="{{route('house.destroy', $house->id)}}">
                                                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                        


                                      </td>
                                    </tr>
                                  @endforeach
                                @endif
                               

                              </tbody>

                            </table>
                          </div>
                           
                          </div>
                          <!-- /.card-body -->

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

  $(document).ready(function(){
    $(".deleteHouse").on('submit', function(e){
      e.preventDefault();
      var thisForm = $(this);
      var formData = $(this).serialize();
      var deleteUrl = $(this).find(".deleteUrl").val();
      $("#toast-container").show();
      toastr.success("<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",'Are you sure, you want to delete it?',
      {
        closeButton: false,
        allowHtml: true,
        onShown: function (toast) {
          $("#confirmationRevertYes").click(function(){
            $.ajax({
                      type: "POST",
                      url: deleteUrl,
                      data: formData,
                      beforeSend: function() {
                          thisForm.find('button[type="submit"]').prop("disabled",true);
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
                      }
                  });
  
                  
            
          });
  
          $("#confirmationRevertNo").click(function(){
            $("#toast-container").hide();
          })
        }
      });
    })
  });
  
  </script>
@endpush

