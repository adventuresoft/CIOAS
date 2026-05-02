@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])
@push('style')
@endpush
@section('title', 'Organization Trade License Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Trade License Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('organizationA.trade-license.index')}}">Organization Trade License</a></li>
            <li class="breadcrumb-item">Create</li>
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
                            <h3 class="card-title">Organization Trade License Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="feesFormTradeLicense" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <table class="table">
                                    <thead>


                                        <tr>
                                            <th>Financial Year</th>
                                            <th>
                                                <select class="form-control" disabled id="tax_year_id" name="tax_year_id">
                                                    <option value="">{{$license->taxYear->name}}</option>                                                       
                                                </select>
                                                <small class="error tax_year_id-error text-danger"></small>
                                            </th>
                                            <th>Organizaiton ID</th>
                                            <th>

                                                <div class="row input-group input-group-sm user_info">
                                                    <input type="text" value="{{$license->organization->system_id}}" readonly name="system_id" id="system_id" placeholder="Search By Organization ID"  required class="form-control system_id">
                                                </div>
                                                <span class="error system_id-error text-danger"></span>

                                            </th>
                                        </tr>


                                 

                                        <tr>
                                            <td class="align-middle">Name:</td>
                                            <td class="align-middle"><strong class="organization_name">{{$license->organization->name}}</strong></td>
                                            <td class="align-middle">
                                                Address: 
                                                {{"House# ".($license->organization->house->house ?? '--'). ", "}} 
                                                {{"Road# ".($license->organization->road->name ?? '--'). ", "}}
                                                {{"Area# ".($license->organization->villageArea->en_name ?? '--'). ", "}}
                                                {{"Village# ".($license->organization->village->en_name ?? '-- ')}}
                                            </td>
                                            <td class="align-middle">
                                                <input type="hidden" class="organization_id" name="organization_id">
                                               <strong class="organization_address"></strong>
                                            </td>
                                        </tr>

                                    </thead>
                                </table>

                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 10%">SL No.</th>
                                            <th rowspan="2">Fees Head</th>
                                            <th>Fees</th>
                                        </tr>
                                    </thead>

                                    
                                    <tbody id="load-fees">
                                        @php
                                            $total_fee = 0;
                                            $index = 0;
                                            $fees = json_decode($license->fees, true);
                                        @endphp
                                        @if (!empty( $fees))
                                            
                                        @foreach ($fees as $key => $fee)
                                            @php
                                                $total_fee = $total_fee + $fee;
                                            @endphp
                                            <tr>
                                                <td>{{++$index}}</td>
                                                <td>
                                                    <input type="text" class="form-control text-left" readonly value="{{$key}}" name="name[]">
                                                </td>
                                                <td>
                                                    <input  type="text" class="form-control text-right" readonly  name="fees['{{$key}}']"   value="{{currencyFormat($fee)}}">
                                                </td>
                                            </tr> 
                                        @endforeach

                                        @endif

                                        
                                        <tr>
                                            <td>Total: </td>
                                            <td class="text-right" colspan="2">{{currencyFormat($total_fee)}}</td>
                                        </tr> 
                                    </tbody>

                                </table>

                                
                               


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <select name="status" class="form-control">
                                        <option value="1" {{$license->status == 1 ? "selected" : ""}} >Pending</option>
                                        <option value="2" {{$license->status == 2 ? "selected" : ""}}>Approved</option>
                                    </select>
                                </div>
                                
                                <div class="form-group row">
                                    <a href="{{route('organizationA.trade-license.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-success">$ Confirmed</button>
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
            $("#feesFormTradeLicense").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);


                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to receive the payment?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {


                                $.ajax({
                                    type: "POST",
                                    url: "{{route('organizationA.trade-license.confirmation', $license->id )}}",
                                    data: thisForm.serialize(),
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]').prop("disabled",true);
                                    },
                                    success: function (response) {
                                        thisForm.find('button[type="submit"]').prop("disabled",false);
                                        toastr.success(response.message);
                                        setTimeout(function() {
                                            location.href = "{{route('organizationA.trade-license.invoice', $license->id )}}";
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

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });


                
            })
        })
    </script>
@endpush
