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
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">License Information</h3>
                </div>
                <form class="form-horizontal" id="licenseForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    @include('backend.pages.license.forms.license', ['license' => null])
                    <div class="card-footer">
                        <a href="{{ route('license.index') }}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info">Submit</button>
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