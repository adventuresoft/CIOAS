@extends('backend.master', ['mainMenu' => 'HotelRestaurant', 'subMenu' => 'HotelRestaurantEdit'])
@push('style')
@endpush
@section('title', 'Hotel Restaurant Edit')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hotel Restaurant Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('hotel-restaurant.index') }}">Hotel Restaurant</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form id="organizationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $organization->id }}">

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-briefcase"></i> 
                                <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="text-dark">Hotel Restaurant Information</a>
                                <span class="text-secondary mx-2">|</span>
                                <a href="{{ route('hotelRestaurant-ownership.edit', $organization->id) }}" class="text-muted">Ownership Information</a>
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            @include('backend.pages.hotel-restaurant.forms.hotel-restaurant', [
                                'organization' => $organization,
                            ])
                        </div>
                    </div>

                    <div class="cioas-actions">
                        <a href="{{ route('hotel-restaurant.index') }}" class="btn btn-material btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-material btn-material-primary">Update & Next</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!-- /.content -->@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $("#organizationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('hotel-restaurant.update', $organization->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
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
