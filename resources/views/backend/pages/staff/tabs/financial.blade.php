@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' =>'Create'])
@section('title', 'Staff Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Staff Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('staff.index')}}">Staff</a></li>
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
                            @include('backend.pages.staff.tabs.tab_header', ['user' => $user, 'active_tab' => 'financial'])
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
                            <div class="card-footer bg-white mt-3" style="border-top: none;">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('staff.professional', $user->id) }}" class="btn btn-outline-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Profession</a>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #5b4bdf; border-color: #5b4bdf;"><i class="fas fa-save mr-1"></i> Save & Next</button>
        </div>
        <div class="col-md-4">
            <a href="{{ route('staff.property', $user->id) }}" class="btn btn-outline-primary btn-block" style="color: #5b4bdf; border-color: #5b4bdf;">Property <i class="fas fa-arrow-right ml-1"></i></a>
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
                    url: "{{ route('staff.financialStore') }}",
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
                        if (response.redirect_url) {
                            setTimeout(function() {
                                location.href = response.redirect_url;
                            }, 1500);
                        }
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
