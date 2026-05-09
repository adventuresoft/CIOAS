@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'OrganizationCreate'])

@section('title', 'Organization Create')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Organization Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organization</a></li>
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

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('organization.edit', $organization->id) }}">
                                    <span class="text-dark">Organization Information</span>
                                </a>
                                <span class="text-secondary">|</span>
                                <a href="{{ route('organization-ownership.edit', $organization->id) }}">
                                    <span class="text-light">Ownership Information</span>
                                </a>
                            </h3>
                        </div>

                        <div class="card-body">

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
                                            'ownership' => $ownerships[$i] ?? null,
                                            'index' => $i,
                                            'districts' => $districts[$i] ?? [],
                                            'thanas' => $thanas[$i] ?? [],
                                            'present_districts' => $present_districts[$i] ?? [],
                                            'present_thanas' => $present_thanas[$i] ?? [],
                                        ])
                                    @endfor
                                    <div class="row">
                                        <a href="{{ route('organization.edit', $organization->id) }}"
                                            class="btn btn-danger float-right">
                                            Organization Info
                                        </a>

                                        <div class="col-sm-9">
                                            <button type="submmit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="card-footer">

                            @if ($organization->organization_ownership_type_id == 2)
                                <div class="row mb-1" id="add-owner-section">
                                    <div class="col-sm-3">
                                        <button type="button" id="addMoreOwner" class="btn btn-primary">
                                            Add More Owner
                                        </button>
                                    </div>
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
