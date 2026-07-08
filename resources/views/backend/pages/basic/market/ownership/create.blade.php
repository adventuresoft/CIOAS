@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'MarketOwnershipType'])
@push('style')
@endpush
@section('title', 'Market Ownership')
@section('content')
   

    <!-- Main content -->
    <section class="content cioas-page pt-3">
    <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">Market Ownership Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="marketOwnershipTypeForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="cioas-panel-body">

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Market Ownership type</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" placeholder="Market Ownership Type" class="form-control" id="en_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Market Ownership Type Bangla</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" placeholder="Market Ownership Type Bangla" class="form-control" id="bn_name">
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="cioas-actions mt-4">
                                <div class="form-group row">
                                    
                                    <a href="{{route('basic-settings.market-ownership-type.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-material btn-material-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    </div>
                    <!-- /.cioas-shell -->
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
            $("#marketOwnershipTypeForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('basic-settings.market-ownership-type.store')}}",
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
                            location.href = "{{route('basic-settings.market-ownership-type.index')}}";
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
