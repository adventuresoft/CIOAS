@extends('backend.master', ['mainMenu' => 'People', 'subMenu' =>'Create'])
@section('title', 'People Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>People Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('people.index')}}">People</a></li>
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
                            @include('backend.pages.people.tabs.tab_header', ['user' => $user, 'active_tab' => 'financial'])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleFinancialForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                           
                           

                            <div class="card-body" id="multiple-financial">

                                @if (count($user->financialInfos))

                                    @foreach ($user->financialInfos as $financial)
                                    <div class="single-financial-{{$financial->id}}">
                                        <div class="form-group row">
                                            <label for="account_no" class="col-sm-2 col-form-label">A/C No</label>
                                            <div class="col-sm-9">
                                                <input type="text" required class="form-control" value="{{$financial->account_no}}" name="account_noU[{{$financial->id}}]" id="account_no" placeholder="A/C No">
                                                <small class="text-danger error account_noU_error"></small>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_type_id" class="col-sm-2 col-form-label">A/C Type</label>
                                            <div class="col-sm-9">
                                                <select name="account_typeU[{{$financial->id}}]" class="form-control account_type_id">
                                                    @if (count($account_types))
                                                        @foreach($account_types as $type)
                                                            <option value="{{$type->id}}" @if ($type->id == $financial->account_type_id) selected @endif >{{$type->en_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small class="text-danger error account_typeU_error"></small>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_id" class="col-sm-2 col-form-label">Bank</label>
                                            <div class="col-sm-9">
                                                <select name="bank_idU[{{$financial->id}}]" class="form-control" id="bank_id">
                                                    @if (count($banks))
                                                        @foreach ($banks as $bank)
                                                            <option value="{{$bank->id}}" @if ($bank->id == $financial->bank_id) selected @endif >{{$bank->en_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small class="text-danger error bank_idU_error"></small>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_balance" class="col-sm-2 col-form-label">Balance</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{$financial->account_balance}}" name="account_balanceU[{{$financial->id}}]" class="form-control" id="account_balance">
                                            </div>
                                            <div class="remove-single-financial col-sm-1 mt-1">
                                                <button type="button" class="btn btn-danger">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                @else
                                    <div class="single-financial">
                                        <div class="form-group row">
                                            <label for="account_no" class="col-sm-2 col-form-label">A/C No</label>
                                            <div class="col-sm-9">
                                                <input type="text" required class="form-control" name="account_no[]" id="account_no" placeholder="A/C No">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_type_id" class="col-sm-2 col-form-label">A/C Type</label>
                                            <div class="col-sm-9">
                                                <select name="account_type_id[]" class="form-control account_type_id">
                                                    @if (count($account_types))
                                                        @foreach($account_types as $type)
                                                            <option value="{{$type->id}}">{{$type->en_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_id" class="col-sm-2 col-form-label">Bank</label>
                                            <div class="col-sm-9">
                                                <select name="bank_id[]" class="form-control bank_id">
                                                    @if (count($banks))
                                                        @foreach ($banks as $bank)
                                                            <option value="{{$bank->id}}">{{$bank->en_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_balance" class="col-sm-2 col-form-label">Balance</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="account_balance[]" class="form-control" id="account_balance">
                                            </div>
                                            <div class="remove-single-financial col-sm-1 mt-1">
                                                <button type="button" class="btn btn-danger">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row mb-1">
                                    <div class="col-sm-3">
                                        <button type="button" id="addNewFinancial" title="Add More" class="btn btn-primary btn-block">Add New More</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{route('people.professional', $user->id)}}" class="btn btn-danger btn-block">Profession</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{route('people.property',$user->id)}}" class="btn btn-primary btn-block ">Property</a>
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
            $("#peopleFinancialForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.financialStore') }}",
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
                        // setTimeout(function() {
                        //     location.href = "/";
                        // }, 2000)
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

        $("#addNewFinancial").on('click', function () {
                var addNewFinancial = '';

                addNewFinancial += '<div class="single-financial">';
                    addNewFinancial += '<div class="form-group row">';
                        addNewFinancial += '<label for="account_no" class="col-sm-2 col-form-label">A/C No</label>';
                        addNewFinancial += '<div class="col-sm-9">';
                            addNewFinancial += ' <input type="text" required class="form-control" name="account_no[]" id="account_no" placeholder="A/C No">';
                        addNewFinancial += '</div>';
                    addNewFinancial += '</div>';
                    addNewFinancial += '<div class="form-group row">';
                        addNewFinancial += '<label for="account_type" class="col-sm-2 col-form-label">A/C Type</label>';
                        addNewFinancial += '<div class="col-sm-9">';
                            addNewFinancial += '<select name="account_type_id[]" class="form-control" >';
                                @if (count($account_types))
                                    @foreach ($account_types as $type)
                                    addNewFinancial += '<option value="{{$type->id}}">{{$type->en_name}}</option>';
                                    @endforeach
                                @endif
                                addNewFinancial += '</select>';
                        addNewFinancial += '</div>';
                    addNewFinancial += '</div>';
                    addNewFinancial += '<div class="form-group row">';
                        addNewFinancial += '<label for="bank_id" class="col-sm-2 col-form-label">Bank</label>';
                        addNewFinancial += '<div class="col-sm-9">';
                            addNewFinancial += '<select name="bank_id[]" class="form-control">';
                                @if (count($banks))
                                    @foreach ($banks as $bank)
                                    addNewFinancial += '<option value="{{$bank->id}}">{{$bank->en_name}}</option>';
                                    @endforeach
                                @endif
                                addNewFinancial += '</select>';
                        addNewFinancial += '</div>';
                    addNewFinancial += '</div>';
                    addNewFinancial += '<div class="form-group row">';
                        addNewFinancial += '<label for="account_balance" class="col-sm-2 col-form-label">Balance</label>';
                        addNewFinancial += '<div class="col-sm-9">';
                            addNewFinancial += '<input type="text" name="account_balance[]" class="form-control" id="account_balance">';
                        addNewFinancial += '</div>';
                        addNewFinancial += '<div class="remove-single-financial col-sm-1 mt-1">';
                            addNewFinancial += '<button type="button" class="btn btn-danger">X</button>';
                        addNewFinancial += '</div>';
                    addNewFinancial += '</div>';
                addNewFinancial += '</div>';

                $("#multiple-financial").append(addNewFinancial);

        })

        $(document).on('click', '.remove-single-financial', function(){
            if (confirm("Are you sure?")){
                $(this).closest('.single-financial').remove();
            }else {
                return false;
            }
        })

    </script>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush
