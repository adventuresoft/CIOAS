@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'OrganizationClass'])
@push('style')
@endpush
@section('title', 'Organization Class')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Class</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Organization Class</a></li>
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
                                    <h3 class="card-title">Organization Class List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('basic-settings.organization-class.create')}}" class="btn btn-primary">Create</a>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                  <th>Sl.</th>
                                  <th>Name</th>
                                  <th>Bangla Name</th>
                                  <th>Organization Category</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                              @if($classes)
                                @foreach ($classes as $key=>$class)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$class->en_name}}</td>
                                    <td>{{$class->bn_name}}</td>
                                    <td>
                                      @if ($class->category)
                                      {{$class->category->en_name}}
                                      @endif
                                     
                                    
                                    </td>
                                    <td>
                                      <div style="display: inline-block">
                                        <a class="btn btn-primary" href="{{route('basic-settings.organization-class.edit', $class->id)}}">Edit</a>
                                        <form class="deleteClass" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <input type="hidden" class="id" name="id" value="{{$class->id}}">
                                          <input type="hidden" class="deleteUrl" name="deleteUrl" value="{{route('basic-settings.organization-class.destroy', $class->id)}}">
                                          <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                              @endif

                              

                            </tbody>

                          </table>
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
    $(".deleteClass").on('submit', function(e){
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
                            location.href = "{{route('basic-settings.organization-class.index')}}";
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

