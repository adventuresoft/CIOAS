@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' => 'StaffList'])

@push('style')
    <style>
        .citizen-id {
            font-weight: bold;
            color: black;
            font-size: 13px;
        }
    </style>
@endpush

@section('title', 'Staff List')

@section('content')

    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-users"></i> Staff Information
                        </h3>
                        <div>
                            @if (create_permission())
                                <a href="{{ route('staff.create') }}" class="btn btn-material btn-material-primary">
                                    <i class="fas fa-plus-circle"></i> Create
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="cioas-panel-body">
                        <!-- FILTER BAR -->
                        <div class="row mb-4 p-3" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid var(--mc-line); margin: 0 0 20px 0;">
                            <!-- Show Entries -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Show Entries</label>
                                <select id="tableLength" class="form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>

                            <!-- Name Filter -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Name</label>
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Mobile Filter -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Mobile</label>
                                <input type="text" id="search_mobile" class="form-control form-control-sm"
                                    placeholder="Mobile">
                            </div>

                            <!-- Email Filter -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Email</label>
                                <input type="text" id="search_email" class="form-control form-control-sm"
                                    placeholder="Email">
                            </div>

                            <!-- Gender Filter -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Gender</label>
                                <select id="search_gender" class="form-control form-control-sm">
                                    <option value="">All Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- GLOBAL SEARCH -->
                            <div class="col-md-2 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">Search</label>
                                <input type="text" id="search_global" class="form-control form-control-sm"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example1" class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Photo</th>
                                        <th>ID & Name</th>
                                        <th>Mobile & Email</th>
                                        <th>Gender & DOB</th>
                                        <th>Department</th>
                                        <th>Section</th>
                                        <th>User Type</th>
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

            let table = $('#example1').DataTable({
                serverSide: true,
                ajax: {
                    url: '{{ route('staff.records') }}',
                    type: 'post',
                    data: function (d) {
                        d._token = '{{ csrf_token() }}';
                        d.csrf_token = $('meta[name="csrf-token"]').attr('content');
                        d.search_name = $('#search_name').val();
                        d.search_mobile = $('#search_mobile').val();
                        d.search_email = $('#search_email').val();
                        d.search_gender = $('#search_gender').val();
                        d.search_global = $('#search_global').val();
                    }
                },
                dom: 'rtip',
                pageLength: 10,
                lengthChange: false,
                processing: true,
                order: [
                    [0, 'asc']
                ],
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id_name',
                        name: 'name'
                    },
                    {
                        data: 'mobile_email',
                        name: 'mobile'
                    },
                    {
                        data: 'gender_dob',
                        name: 'staff.date_of_birth'
                    },
                    {
                        data: 'department_name',
                        name: 'department.name'
                    },
                    {
                        data: 'section_name',
                        name: 'section.name'
                    },
                    {
                        data: 'user_type',
                        name: 'user_type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            table.ajax.reload();

            // Server-side search handlers with debounce
            let searchTimeout;

            function debounceSearch() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    table.ajax.reload();
                }, 300);
            }

            $('#search_name').on('keyup', debounceSearch);
            $('#search_mobile').on('keyup', debounceSearch);
            $('#search_email').on('keyup', debounceSearch);
            $('#search_gender').on('change', debounceSearch);
            $('#search_global').on('keyup', debounceSearch);

            $('#tableLength').change(function () {
                table.page.len($(this).val()).draw();
            });

        });
    </script>
@endpush