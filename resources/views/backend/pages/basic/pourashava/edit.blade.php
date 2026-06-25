@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Pourashava'])
@section('title', 'Edit Pourashava')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Pourashava</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('basic-settings.pourashava.index') }}">Pourashava List</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content cioas-page pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="cioas-shell">
                    <form class="form-horizontal" id="pourashavaForm" action="{{route('basic-settings.pourashava.update', $pourashava->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="cioas-panel mb-4">
                            <div class="cioas-panel-header">
                                <h3 class="cioas-panel-title"><i class="fas fa-edit"></i> Pourashava Info</h3>
                            </div>
                            
                            <div class="cioas-panel-body">
                                <div class="form-group row">
                                    <label for="district_id" class="col-sm-3 col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-7">
                                        <select required class="form-control select2" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            @if ($districts)
                                                @foreach ($districts as $district)
                                                    <option value="{{$district->id}}" {{$pourashava->district_id == $district->id ? 'selected' : ''}}>{{$district->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error district_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Pourashava Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" required name="name" value="{{$pourashava->name}}" placeholder="Pourashava Name" class="form-control" id="name">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-3 col-form-label">Bangla Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" required name="bn_name" value="{{$pourashava->bn_name}}" placeholder="Bangla Name" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category" class="col-sm-3 col-form-label">Category <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-7">
                                        <select required class="form-control select2" name="category" id="category">
                                            <option value="">Select Category</option>
                                            <option value="A" {{$pourashava->category == 'A' ? 'selected' : ''}}>A</option>
                                            <option value="B" {{$pourashava->category == 'B' ? 'selected' : ''}}>B</option>
                                            <option value="C" {{$pourashava->category == 'C' ? 'selected' : ''}}>C</option>
                                            <option value="D" {{$pourashava->category == 'D' ? 'selected' : ''}}>D</option>
                                        </select>
                                        <small class="text-danger error category_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-3 col-form-label">Status <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-7">
                                        <select required class="form-control select2" name="status" id="status">
                                            <option value="1" {{$pourashava->status == 1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$pourashava->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                        <small class="text-danger error status_error"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cioas-actions mt-4 text-right">
                            <a href="{{route('basic-settings.pourashava.index')}}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $(".select2").select2();

        $("#pourashavaForm").on('submit', function(e){
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('basic-settings.pourashava.update', $pourashava->id)}}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                    $('.error').text('');
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{route('basic-settings.pourashava.index')}}";
                    }, 2000)
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
</script>
@endpush
