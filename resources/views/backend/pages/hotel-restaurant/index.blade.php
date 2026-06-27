@extends('backend.master', ['mainMenu' => 'hotel_restaurant', 'subMenu' => 'HotelRestaurantList'])
@push('style')
@endpush
@section('title', 'Hotel & Restaurant List')
@section('content')


    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> Hotel Restaurant Information
                        </h3>
                        <div>
                            @if (create_permission())
                                <a href="{{ route('hotel-restaurant.create') }}" class="btn btn-material btn-material-primary">
                                    <i class="fas fa-plus-circle"></i> Create
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="cioas-panel-body">
                        <!-- FILTER BAR -->
                        <div class="row mb-4 p-3"
                            style="background-color: #f8fafc; border-radius: 8px; border: 1px solid var(--mc-line); margin: 0 0 20px 0;">
                            <!-- Show Entries -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Show
                                    Entries</label>
                                <select id="tableLength" class="form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <!-- Organization Name Filter -->
                            <div class="col-md-3 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Hotel &
                                    Restaurant</label>
                                <input type="text" id="search_hotel_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-2 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Category</label>
                                <input type="text" id="search_category" class="form-control form-control-sm"
                                    placeholder="Category">
                            </div>

                            <!-- Subcategory Filter -->
                            <div class="col-md-2 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Subcategory</label>
                                <input type="text" id="search_subcategory" class="form-control form-control-sm"
                                    placeholder="Subcategory">
                            </div>

                            <!-- GLOBAL SEARCH -->
                            <div class="col-md-3 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Search</label>
                                <input type="text" id="search_global" class="form-control form-control-sm"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="hotelRestaurant" class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Application ID</th>
                                        <th>Hotel & Restaurant Name</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Status</th>
                                        <th>Applied Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
@push('script')
    <script>
        $(document).ready(function () {

            let table = $('#hotelRestaurant').DataTable({
                serverSide: true,
                ajax: {
                    url: '{{ route('hotel-restaurant.records') }}',
                    type: 'post',
                    data: function (d) {
                        // Add custom search parameters
                        d.csrf_token = $('meta[name="csrf-token"]').attr('content');
                        d.search_hotel_name = $('#search_hotel_name').val();
                        d.search_category = $('#search_category').val();
                        d.search_subcategory = $('#search_subcategory').val();
                        d.search_global = $('#search_global').val();
                    }

                },
                dom: 'rtip',
                pageLength: 10,
                lengthChange: false,
                processing: true,
                drawCallback: function (settings) {
                    bindDeleteEvents();
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'application_id',
                    name: 'application_id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_name',
                    name: 'category.en_name'
                },
                {
                    data: 'subcategory_name',
                    name: 'subcategory.en_name'
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
                ],

            });

            table.ajax.reload();

            // Function to bind delete events
            function bindDeleteEvents() {
                $(".deleteHouse").off('submit').on('submit', function (e) {
                    e.preventDefault();
                    var thisForm = $(this);
                    var formData = $(this).serialize();
                    var deleteUrl = $(this).find(".deleteUrl").val();
                    $("#toast-container").show();
                    toastr.success(
                        "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                        'Are you sure, you want to delete it?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function (toast) {
                            $("#confirmationRevertYes").click(function () {
                                $.ajax({
                                    type: "POST",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function () {
                                        thisForm.find(
                                            'button[type="submit"]'
                                        )
                                            .prop("disabled",
                                                true);
                                    },
                                    success: function (response) {
                                        thisForm.find(
                                            'button[type="submit"]'
                                        )
                                            .prop("disabled",
                                                false);
                                        toastr.success(response
                                            .message);
                                        table.ajax.reload();
                                    },
                                    error: function (xhr, status,
                                        error) {
                                        thisForm.find(
                                            'button[type="submit"]'
                                        )
                                            .prop("disabled",
                                                false);
                                        var responseText =
                                            jQuery.parseJSON(
                                                xhr
                                                    .responseText);
                                        toastr.error(
                                            responseText
                                                .message);
                                    }
                                });
                            });

                            $("#confirmationRevertNo").click(function () {
                                $("#toast-container").hide();
                            })
                        }
                    });
                });
            }

            // Initial binding of delete events
            bindDeleteEvents();

            // Server-side search handlers with debounce
            let searchTimeout;

            function debounceSearch() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    table.ajax.reload();
                }, 300);
            }

            $('#search_hotel_name').on('keyup', debounceSearch);
            $('#search_category').on('keyup', debounceSearch);
            $('#search_subcategory').on('keyup', debounceSearch);
            $('#search_global').on('keyup', debounceSearch);

            $('#tableLength').change(function () {
                table.page.len($(this).val()).draw();
            });

        });
    </script>
@endpush