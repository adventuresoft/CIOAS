@extends('backend.master', ['mainMenu' => 'HotelRestaurant', 'subMenu' => 'HotelRestaurantList'])
@push('style')
@endpush
@section('title', 'Hotel & Restaurant List')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Hotel Restaurant
                                        Information</h3>
                                </div>

                                <div class="col-md-6 text-right">
                                    @if (create_permission())
                                        <a href="{{ route('organization.create') }}" class="btn btn-primary">Create</a>
                                        <a href="{{ route('organization.index') }}" class="btn btn-primary">List</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">

                            <!-- FILTER BAR -->
                            <div class="row mb-3 align-items-center g-2">

                                <!-- Show Entries -->
                                <div class="col-md-1">
                                    <select id="tableLength" class="form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                                <!-- Organization Name Filter -->
                                <div class="col-md-2">
                                    <input type="text" id="search_hotel_name" class="form-control form-control-sm"
                                        placeholder="Hotel & Restaurant Name">
                                </div>

                                <!-- Category Filter -->
                                <div class="col-md-2">
                                    <input type="text" id="search_category" class="form-control form-control-sm"
                                        placeholder="Category">
                                </div>

                                <!-- Subcategory Filter -->
                                <div class="col-md-2">
                                    <input type="text" id="search_subcategory" class="form-control form-control-sm"
                                        placeholder="Subcategory">
                                </div>

                                <!-- GLOBAL SEARCH -->
                                <div class="col-md-2">
                                    <input type="text" id="search_global" class="form-control form-control-sm"
                                        placeholder="Search">
                                </div>

                            </div>
                            <table id="hotelRestaurant" class="table table-bordered table-striped">
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
                        <!-- /.card-body -->

                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
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