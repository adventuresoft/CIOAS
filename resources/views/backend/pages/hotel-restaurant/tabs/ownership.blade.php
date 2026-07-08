@extends('backend.master', ['mainMenu' => 'hotel_restaurant', 'subMenu' => 'HotelRestaurantCreate'])

@section('title', 'Organization Create')

@push('style')
<style>
    .card-body.bg-light {
        background-color: #f8f9fc !important;
    }
    .select2-container {
        width: 100% !important;
    }
    .form-control, .select2-container--default .select2-selection--single {
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
    }
    .form-control:focus {
        background-color: #ffffff;
        border-color: #0f766e;
        box-shadow: 0 0 0 0.2rem rgba(15, 118, 110, 0.25);
    }
    label {
        font-weight: 500;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }
    #full-page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.85);
        z-index: 99999;
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .loader-spinner {
        width: 4rem;
        height: 4rem;
        color: #0f766e;
    }
</style>
@endpush

@section('content')

    <!-- Loader Overlay -->
    <div id="full-page-loader">
        <div class="spinner-border loader-spinner" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="mt-3 fw-bold fs-5" style="color: #0f766e;">Saving Ownership Data... Please wait.</div>
    </div>

    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="d-flex align-items-center mb-4" style="gap: 12px;">
                    <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="btn btn-light border rounded-pill px-4" style="color: #64748b; font-weight: 500; text-transform: none;">
                        <i class="fas fa-briefcase mr-1"></i> Hotel Restaurant Info
                    </a>
                    <a href="{{ route('hotelRestaurant-ownership.edit', $organization->id) }}" class="btn btn-material btn-material-primary rounded-pill px-4" style="text-transform: none; font-weight: 500;">
                        <i class="fas fa-users mr-1"></i> Ownership Info
                    </a>
                </div>

                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-users"></i> Ownership Information
                        </h3>
                    </div>
                    <div class="cioas-panel-body bg-light p-4">

                        {{-- ================= OWNERSHIP SECTION ================= --}}
                        <div>
                            <form class="form-horizontal" id="organizationOwnershipForm" action="{{ route('hotelRestaurant-ownership.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="hotel_restaurant_id" value="{{ $organization->id }}">
                                @php
                                    $no_of_owners = $organization->no_of_owner ?? ($organization->no_of_dir ?? 1);
                                @endphp

                                @for ($i = 0; $i < $no_of_owners; $i++)
                                    @include('backend.pages.hotel-restaurant.forms.ownership', [
                                        'ownership' => $ownerships[$i] ?? [],
                                        'index' => $i,
                                        'districts' => $districts[$i] ?? [],
                                        'thanas' => $thanas[$i] ?? [],
                                        'post_officeses' => $post_officeses[$i] ?? [],
                                        'present_districts' => $present_districts[$i] ?? [],
                                        'present_thanas' => $present_thanas[$i] ?? [],
                                        'present_post_officeses' => $present_post_officeses[$i] ?? [],
                                        'cities' => $cities[$i] ?? [],
                                        'pourashavas' => $pourashavas[$i] ?? [],
                                        'unions' => $unions[$i] ?? [],
                                        'villages' => $villages[$i] ?? [],
                                        'present_cities' => $present_cities[$i] ?? [],
                                        'present_pourashavas' => $present_pourashavas[$i] ?? [],
                                        'present_unions' => $present_unions[$i] ?? [],
                                        'present_villages' => $present_villages[$i] ?? [],
                                    ])
                                @endfor

                                @if ($organization->organization_ownership_type_id == 2)
                                    <div class="text-center mt-3 mb-4" id="add-owner-section">
                                        <button type="button" id="addMoreOwner" class="btn btn-outline-success px-4 rounded-pill fw-medium">
                                            <i class="fas fa-plus-circle mr-2"></i> Add More Owner
                                        </button>
                                    </div>
                                @endif

                                <div class="cioas-actions mt-4 pt-3 border-top d-flex justify-content-end gap-3">
                                    <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="btn btn-material btn-secondary">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-material btn-material-primary">
                                        Save Ownership
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();

            // ================= FORM SUBMIT =================
            $("#organizationOwnershipForm").on('submit', function(e) {
                e.preventDefault();

                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('hotelRestaurant-ownership.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $("#full-page-loader").css("display", "flex");
                    },

                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        $("#full-page-loader").hide();
                        toastr.success(response.message);
                        
                        setTimeout(function() {
                            window.location.href = "{{ route('hotel-restaurant.index') }}";
                        }, 1000);
                    },

                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        $("#full-page-loader").hide();
                        var response = jQuery.parseJSON(xhr.responseText);
                        if (xhr.status === 422) {
                            var errorMsg = '';
                            $.each(response.errors, function(key, val) {
                                errorMsg += val[0] + '<br>';
                            });
                            toastr.error(errorMsg, 'Validation Error', {timeOut: 7000, enableHtml: true});
                        } else {
                            toastr.error(response.message || "An error occurred");
                        }
                    }
                });
            });

        });
    </script>
@endpush
