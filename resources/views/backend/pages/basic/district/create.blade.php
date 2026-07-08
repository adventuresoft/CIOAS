@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'District'])

@push('style')
@endpush

@section('title', 'Create District')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form id="districtForm" method="POST" class="form-horizontal">
                @csrf
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-map-marked-alt"></i> District Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">

                            <div class="form-group row mb-4">
                                <label for="division_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Division <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select Division</option>
                                        @if ($divisions)
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error division_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark font-weight-bold">District Name (English) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="District Name (English)" required>
                                    <small class="text-danger error name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">District Name (Bengali) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" class="form-control" placeholder="District Name (Bengali)" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.district.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Submit</button>
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

            $("#districtForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.district.store') }}",
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
                                location.href = "{{ route('basic-settings.district.index') }}";
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
