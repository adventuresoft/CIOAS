@extends('backend.master', ['mainMenu' => 'hotel_restaurant', 'subMenu' => 'HotelRestaurantCreate'])
@push('style')
@endpush
@section('title', 'Hotel & Restaurant Create')
@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form id="organizationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-briefcase"></i> Hotel & Restaurant Information
                            </h3>
                        </div>
                        <div class="cioas-panel-body">
                            @include('backend.pages.hotel-restaurant.forms.hotel-restaurant', [
                                'organization' => null,
                            ])
                        </div>
                    </div>

                    <div class="cioas-actions">
                        <a href="{{ route('hotel-restaurant.index') }}" class="btn btn-material btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-material btn-material-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $("#organizationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('hotel-restaurant.store') }}",
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
                        setTimeout(() => {
                            location.href = response.redirect_url;
                        }, 2000);
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
