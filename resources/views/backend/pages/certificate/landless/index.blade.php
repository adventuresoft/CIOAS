@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Landless'])

@push('style')
<style>
    .citizen-id {
        font-weight: bold;
        color: black;
        font-size: 15px;
    }

    .table td {
        vertical-align: middle !important;
    }

    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    /* hide datatable search */
    .dataTables_filter {
        display: none;
    }
</style>
@endpush

@section('title', 'Landless Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Landless Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('landless.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('landless.index') }}" class="btn btn-primary">List</a>
                                @endif
                            </div>
                        </div>
                    </div>

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

                            <!-- Certificate Number Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_cert" class="form-control form-control-sm"
                                    placeholder="Certificate No">
                            </div>

                            <!-- ID or Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="ID or Name">
                            </div>

                            <!-- Address or Mobile Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_address" class="form-control form-control-sm"
                                    placeholder="Address/Mobile">
                            </div>

                            <!-- Land Type Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_land_type" class="form-control form-control-sm"
                                    placeholder="Land Type">
                            </div>

                            <!-- Land Amount Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_land_amount" class="form-control form-control-sm"
                                    placeholder="Land Amount">
                            </div> -->

                            <!-- Reason Filter -->
                            <!-- <div class="col-md-2 mt-2">
                                <input type="text" id="search_reason" class="form-control form-control-sm"
                                    placeholder="Reason">
                            </div> -->

                            <!-- Quantity Filter -->
                            <!-- <div class="col-md-2 mt-2">
                                <input type="text" id="search_quantity" class="form-control form-control-sm"
                                    placeholder="Quantity">
                            </div> -->

                            <!-- GLOBAL SEARCH -->
                            <div class="col-md-2"> 
                                <input type="text" id="search_global" class="form-control form-control-sm" 
                                    placeholder="Search"> 
                            </div>

                            <!-- Reset Button -->
                            <!-- <div class="col-md-2 mt-2">
                                <button id="resetFilter" class="btn btn-secondary btn-sm w-100">
                                    Reset
                                </button>
                            </div> -->

                        </div>

                        <!-- TABLE -->
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Photo</th>
                                    <th>Certificate No</th>
                                    <th>ID & Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Land Type</th>
                                    <th>Land Amount</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($certificates && count($certificates) > 0)
                                    @foreach ($certificates as $key => $certificate)
                                    <tr>
                                        <td>{{ ++$key }}</td>

                                        <td>
                                            <img src="{{ asset($certificate->user->photo ?? 'default.png') }}"
                                                width="40"
                                                height="40"
                                                class="img-circle">
                                        </td>

                                        <td>{{ $certificate->certificate_number ?? bnValue($certificate->system_id ?? '') }}</td>

                                        <td>
                                            <span class="citizen-id">
                                                {{ bnValue($certificate->system_id ?? '') }}
                                            </span><br>
                                            {{ $certificate->user->name ?? '' }}
                                        </td>

                                        <td>
                                            {{ $certificate->user->address ?? '' }} <br>
                                            <strong>{{ $certificate->user->mobile ?? '' }}</strong>
                                        </td>

                                        <td>{{ $certificate->land_type ?? 'N/A' }}</td>

                                        <td>{{ $certificate->land_amount ?? 'N/A' }}</td>

                                        <td>{{ $certificate->reason ?? 'N/A' }}</td>

                                        <td>{{ $certificate->quantity ?? '' }}</td>

                                        <td>{{ $certificate->created_at->format('d-m-Y') }}</td>

                                        <td>
                                            <a target="_blank"
                                                href="{{ route('landless.show', $certificate->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-pdf"></i> EN
                                            </a>

                                            <a target="_blank"
                                                href="{{ route('landless.bn_certificate', $certificate->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-file-pdf"></i> BN
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            No landless certificates found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')

<script>
    $(function() {

        let table = $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthChange: false,
            order: [[0, 'asc']],
            columnDefs: [
                { targets: 1, orderable: false }, // Disable sorting on photo column
                { targets: 10, orderable: false }  // Disable sorting on action column
            ]
        });

        // Certificate No (Column 2)
        $('#search_cert').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // ID & Name (Column 3)
        $('#search_name').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Address & Mobile (Column 4)
        $('#search_address').keyup(function() {
            table.column(4).search(this.value).draw();
        });

        // Land Type (Column 5)
        $('#search_land_type').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Land Amount (Column 6)
        $('#search_land_amount').keyup(function() {
            table.column(6).search(this.value).draw();
        });

        // Reason (Column 7)
        $('#search_reason').keyup(function() {
            table.column(7).search(this.value).draw();
        });

        // Quantity (Column 8)
        $('#search_quantity').keyup(function() {
            table.column(8).search(this.value).draw();
        });

        // Global Search
        $('#search_global').keyup(function() { 
            table.search(this.value).draw(); 
        });

        // Change show entries
        $('#tableLength').change(function() {
            table.page.len($(this).val()).draw();
        });

        // Reset filter
        $('#resetFilter').click(function() {
            // Clear all input fields
            $('#search_cert').val('');
            $('#search_name').val('');
            $('#search_address').val('');
            $('#search_land_type').val('');
            $('#search_land_amount').val('');
            $('#search_reason').val('');
            $('#search_quantity').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush