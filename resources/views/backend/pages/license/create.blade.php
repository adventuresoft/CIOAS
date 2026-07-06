@extends('backend.master', ['mainMenu' => 'license', 'subMenu' => 'LicenseCreate'])
@section('title', 'License Create')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>License Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('license.index') }}">License</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form id="licenseForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-certificate"></i> License Information
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            @include('backend.pages.license.forms.license', ['license' => null])
                        </div>
                    </div>

                    <div class="cioas-actions">
                        <a href="{{ route('license.index') }}" class="btn btn-material btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-material btn-material-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('#licenseForm').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $('.error').text('');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('license.store') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = response.redirect_url;
                        }, 1000);
                    },
                    error: function (xhr) {
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function (key, val) {
                            thisForm.find('.' + key + '-error').text(val[0]);
                        });
                    }
                });
            });
        });
    </script>
@endpush