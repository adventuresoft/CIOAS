@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Thana'])

@push('style')
@endpush

@section('title', 'Edit Thana')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form id="thanaForm" action="{{ route('basic-settings.thana.update', $thana->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-building"></i> Edit Thana Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">

                            <div class="form-group row mb-4">
                                <label for="district_id" class="col-sm-3 col-form-label text-dark font-weight-bold">District <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select District</option>
                                        @if ($districts)
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" {{ $district->id == $thana->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error district_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark font-weight-bold">Thana Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Thana Name" value="{{ $thana->name }}" required>
                                    <small class="text-danger error name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Thana Name (Bengali) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" class="form-control" placeholder="Thana Name (Bengali)" value="{{ $thana->bn_name }}" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" {{ $thana->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $thana->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.thana.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            
            $("#thanaForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.thana.update', $thana->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        if(response.status) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.href = "{{ route('basic-settings.thana.index') }}";
                            }, 1500);
                        } else {
                            toastr.error(response.message || 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "An error occurred");
                        if(responseText.errors) {
                            $.each(responseText.errors, function(key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
