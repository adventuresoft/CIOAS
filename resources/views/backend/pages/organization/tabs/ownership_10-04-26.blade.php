@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'OrganizationCreate'])
@push('style')
@endpush
@section('title', 'Organization Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('organization.index')}}">Organization</a></li>
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
                                <a href="{{route('organization.edit', $organization->id)}}">  <span class="text-dark">Organization Information</span>  </a> <span class="text-secondary">|</span>
                                <a href="{{route('organization-ownership.edit', $organization->id)}}">  <span class="text-light">Ownership Information</span>  </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="organizationOwnershipForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="organization_id" value="{{$organization->id}}">
                            <div class="card-body">

                                <div id="load-ownership">
                                    @if (count($organization->ownership))
                                        @foreach($organization->ownership as $ownership)
                                            @include('backend.pages.organization.forms.ownership', ['ownership' => $ownership ]) 
                                        @endforeach
                                    @else
                                        @php
                                            $owner = $organization->no_of_owner ?? 1;
                                        @endphp
                                      @while ($owner > 0)
                                        @include('backend.pages.organization.forms.ownership', ['ownership' => null ]) 
                                        @php
                                            --$owner;
                                        @endphp
                                      @endwhile
                                    
                                    @endif



                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                                @if ($organization->organization_ownership_type_id == 2)
                                    <div class="row mb-1">
                                        <div class="col-sm-3">
                                            <button type="button" id="addMoreOwner" title="Add More Owner" class="btn btn-primary">Add More Owner</button>
                                        </div>
                                    </div>
                                @endif

                                

                                <div class="row">
                                    <a href="{{route('organization.edit', $organization->id)}}" class="btn btn-danger float-right">Organization Info </a>
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
            $("#organizationOwnershipForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('organization-ownership.store')}}",
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
                        // location.reload();
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

        $(document).on('click', '#addMoreOwner', function(e){
            e.preventDefault();
            $.ajax({
               type: "GET",
               url: "{{ url('/organization-single-ownership-form') }}",
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
                        url: "{{ url('/organization-ownership-remove') }}/"+_this_id,
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


        $(document).on('click', '.find_user_info', function(e){
            e.preventDefault();
            let _this = $(this);
            let _this_user_info = _this.closest('.user_info');
            let _this_row = _this.closest('.row');
            let _this_system_id = _this_row.find('.system_id').val();

            if(_this_system_id){

                $.ajax({
                    type: "GET",
                    url: "{{ url('search-user-by-system-id') }}/" + _this_system_id,
                    beforeSend: function() {
                        console.log("Searcing Owner Form");
                    },
                    success: function(response) {

                        _this_user_info.find('.user_info_table').removeClass('d-none')
                        _this_user_info.find('.user_name').val(response.user.people.bn_name);
                        _this_user_info.find('.user_id').val(response.user.id);

                        // _this_user_info.find('.user_img').attr('src', response.people.user.image);;

                    },
                    error: function(xhr, status, error) {
                        _this_row.find('.system_id').val('');
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });



            }else {
                alert("System ID field is required.");
            }

        })


    $(document).on('change', '.trade-checkbox', function(e){
        e.preventDefault();

        $(document).find('.trade-hidden-check').prop( "disabled", false );

        let _this = $(this);
        let tradeLicenseCheckbox = _this.closest('.trade-license-checkbox');
        let hiddenCheckbox = tradeLicenseCheckbox.find('.trade-hidden-check');
        if(_this.is(':checked')){
            hiddenCheckbox.prop( "disabled", true );
        } else {
            hiddenCheckbox.prop( "disabled", false );
        }
    })
    </script>
@endpush
