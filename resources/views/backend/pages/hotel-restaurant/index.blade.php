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
                                    <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Organization
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
                            <table id="example1" class="table table-bordered table-striped">
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

                                    @if (count($organizations))
                                        @foreach ($organizations as $key => $organization)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $organization->application_id }}</td>
                                                <td>{{ $organization->name }}</td>
                                                <td>{{ optional($organization->category)->en_name ?? '' }}</td>
                                                <td>{{ optional($organization->subcategory)->en_name ?? '' }}</td>
                                                <td>
                                                    @if ($organization->status == 1)
                                                        <span class="badge badge-success">Approved</span>
                                                    @elseif($organization->status == 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('d-m-Y', strtotime($organization->created_at)) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @if (view_permission())
                                                            <a href="{{ route('hotel-restaurant.edit', $organization->id) }}"
                                                                title="Edit" class="btn btn-primary btn-sm mx-1"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endif
                                                        @if (view_permission())
                                                            <a href="{{ route('hotel-restaurant.show', $organization->id) }}"
                                                                title="View" class="btn btn-info btn-sm mx-1"><i
                                                                    class="fa fa-eye"></i></a>


                                                            <form class="deleteHouse" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" class="deleteUrl" name="delete_url"
                                                                    value="{{ route('hotel-restaurant.destroy', $organization->id) }}">
                                                                <button type="submit" data-toggle='tooltip' title="Delete"
                                                                    class="btn btn-sm btn-danger"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>

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
        $(document).ready(function() {


            $(".deleteHouse").on('submit', function(e) {
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
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {
                                $.ajax({
                                    type: "POST",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", true);
                                    },
                                    success: function(response) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        toastr.success(response.message);
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                    }
                                });



                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });
            })

            let table = $('#example1').DataTable({
                dom: 'rtip',
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    targets: 6,
                    orderable: false
                }],
                language: {
                    emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                    zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
                }
            });

            $('#search_hotel_name').keyup(function() {
                table.column(2).search(this.value).draw();
            });


            $('#search_category').keyup(function() {
                table.column(3).search(this.value).draw();
            });

            $('#search_subcategory').keyup(function() {
                table.column(4).search(this.value).draw();
            });

            $('#search_global').keyup(function() {
                table.search(this.value).draw();
            });

            $('#tableLength').change(function() {
                table.page.len($(this).val()).draw();
            });

        });
    </script>
@endpush
