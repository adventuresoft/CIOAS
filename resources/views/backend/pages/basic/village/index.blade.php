@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Village'])
@push('style')
@endpush
@section('title', 'Village')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Village</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.village.index')}}">Village</a></li>
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
                                    <h3 class="card-title">Village List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('basic-settings.village.create')}}" class="btn btn-primary">Create</a>
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
                                    <th>Village Name</th>
                                    <th>Benali Name</th>
                                    <th>Division</th>
                                    <th>Distict</th>
                                    <th>Thana</th>
                                    <th>Union</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if ($villages)

                                  @foreach ($villages as $key=>$village)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$village->en_name}}</td>
                                      <td>{{$village->bn_name}}</td>
                                      <td>{{$village->division->name}}</td>
                                      <td>{{$village->district->name}}</td>
                                      <td>{{$village->thana->name}}</td>
                                      <td>{{$village->union->name}}</td>
                                      <td>
                                        <div class="table-action">
                                            <a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" href="{{route('basic-settings.village.edit', $village->id)}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-info" title="Show" data-toggle="tooltip" href="{{route('basic-settings.village.show', $village->id)}}"><i class="fa fa-eye"></i></a>

                                            <form class="deleteVillage" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <input type="hidden" class="id" name="id" value="{{$village->id}}">
                                              <input type="hidden" class="deleteUrl" name="deleteUrl" value="{{route('basic-settings.village.destroy', $village->id)}}">
                                              <button type="submit" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
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
    $(".deleteVillage").on('submit', function(e){
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
                        setTimeout(function() {
                            location.href = "{{route('basic-settings.village.index')}}";
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

