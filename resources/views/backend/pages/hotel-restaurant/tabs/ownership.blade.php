@extends('backend.master', ['mainMenu' => 'HotelRestaurant', 'subMenu' => 'HotelRestaurantCreate'])

@section('title', 'Organization Create')

@push('style')
<style>
    .card-body.bg-light {
        background-color: #f8f9fc !important;
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
</style>
@endpush

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hotel & Restaurant Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('hotel-restaurant.index') }}">Hotel & Restaurant</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h3 class="card-title m-0 fw-bold fs-5">
                                <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="text-secondary text-decoration-none mr-3 pb-2">
                                    <i class="fas fa-building mr-1"></i> Hotel & Restaurant Info
                                </a>
                                <span class="text-muted fw-light">|</span>
                                <a href="{{ route('hotelRestaurant-ownership.edit', $organization->id) }}" class="text-success text-decoration-none ml-3 border-bottom border-success border-3 pb-2">
                                    <i class="fas fa-users mr-1"></i> Ownership Info
                                </a>
                            </h3>
                        </div>

                        <div class="card-body bg-light p-4">

                            {{-- ================= OWNERSHIP SECTION ================= --}}
                            <div>
                                <form class="form-horizontal" action="{{ route('hotelRestaurant-ownership.store') }}"
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
                                            'present_districts' => $present_districts[$i] ?? [],
                                            'present_thanas' => $present_thanas[$i] ?? [],
                                        ])
                                    @endfor
                                    <div class="d-flex justify-content-end gap-3 mt-4">
                                        <a href="{{ route('hotel-restaurant.edit', $organization->id) }}"
                                            class="btn btn-outline-secondary px-4 fw-medium">
                                            <i class="fas fa-arrow-left mr-2"></i> Back to Hotel Info
                                        </a>

                                        <button type="submit" class="btn btn-success px-5 fw-medium" style="background-color: #0f766e; border-color: #0f766e;">
                                            <i class="fas fa-save mr-2"></i> Save Ownership
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="card-footer">

                            @if ($organization->organization_ownership_type_id == 2)
                                <div class="text-center mt-3" id="add-owner-section">
                                    <button type="button" id="addMoreOwner" class="btn btn-outline-success px-4 rounded-pill fw-medium">
                                        <i class="fas fa-plus-circle mr-2"></i> Add More Owner
                                    </button>
                                </div>
                            @endif


                        </div>
                        <!--</form>-->

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
                    },

                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                    },

                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            });


        });
    </script>
@endpush
