@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Married'])

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

@section('title', 'Married Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Married Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('married.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('married.index') }}" class="btn btn-primary">List</a>
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

                            <!-- Husband ID or Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_husband" class="form-control form-control-sm"
                                    placeholder="Husband ID/Name">
                            </div>

                            <!-- Wife ID or Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_wife" class="form-control form-control-sm"
                                    placeholder="Wife ID/Name">
                            </div>

                            <!-- Address or Mobile Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_address" class="form-control form-control-sm"
                                    placeholder="Address/Mobile">
                            </div> -->

                            <!-- Marriage Date Filter -->
                            <div class="col-md-2">
                                <input type="date" id="search_marriage_date" class="form-control form-control-sm"
                                    placeholder="Marriage Date">
                            </div>

                            <!-- Marriage Place Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_place" class="form-control form-control-sm"
                                    placeholder="Marriage Place">
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
                                    <th>Photo (Husband)</th>
                                    <th>Photo (Wife)</th>
                                    <th>Certificate No</th>
                                    <th>Husband ID & Name</th>
                                    <th>Wife ID & Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Marriage Date</th>
                                    <th>Marriage Place</th>
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
                                            <img src="{{ asset($certificate->husband->photo ?? 'default.png') }}"
                                                width="40" height="40" class="img-circle">
                                        </td>
                                        
                                        <td>
                                            <img src="{{ asset($certificate->wife->photo ?? 'default.png') }}"
                                                width="40" height="40" class="img-circle">
                                        </td>
                                        
                                        <td>{{ $certificate->certificate_number ?? bnValue($certificate->system_id ?? '') }}</td>
                                        
                                        <td>
                                            <span class="citizen-id">
                                                {{ bnValue($certificate->husband_system_id ?? '') }}
                                            </span><br>
                                            {{ $certificate->husband->name ?? '' }}
                                        </td>
                                        
                                        <td>
                                            <span class="citizen-id">
                                                {{ bnValue($certificate->wife_system_id ?? '') }}
                                            </span><br>
                                            {{ $certificate->wife->name ?? '' }}
                                        </td>
                                        
                                        <td>
                                            {{ $certificate->user->address ?? '' }} <br>
                                            <strong>{{ $certificate->user->mobile ?? '' }}</strong>
                                        </td>
                                        
                                        <td>
                                            {{ $certificate->marriage_date 
                                                ? \Carbon\Carbon::parse($certificate->marriage_date)->format('d-m-Y') 
                                                : 'N/A' }}
                                        </td>
                                        
                                        <td>{{ $certificate->marriage_place ?? 'N/A' }}</td>
                                        
                                        <td>{{ $certificate->quantity ?? '' }}</td>
                                        
                                        <td>{{ $certificate->created_at->format('d-m-Y') }}</td>
                                        
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('married.show', $certificate->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-pdf"></i> EN
                                            </a>

                                            <a target="_blank"
                                                href="{{ route('married.bn_certificate', $certificate->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-file-pdf"></i> BN
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center text-muted">
                                            No married certificates found.
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
                { targets: [1, 2], orderable: false }, // Disable sorting on photo columns
                { targets: 11, orderable: false }      // Disable sorting on action column
            ]
        });

        // Certificate No (Column 3)
        $('#search_cert').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Husband ID & Name (Column 4)
        $('#search_husband').keyup(function() {
            table.column(4).search(this.value).draw();
        });

        // Wife ID & Name (Column 5)
        $('#search_wife').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Address & Mobile (Column 6)
        $('#search_address').keyup(function() {
            table.column(6).search(this.value).draw();
        });

        // Marriage Date (Column 7)
        $('#search_marriage_date').on('change', function() {
            if (this.value) {
                // Convert YYYY-MM-DD to DD-MM-YYYY for searching
                let dateParts = this.value.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                table.column(7).search(formattedDate).draw();
            } else {
                table.column(7).search('').draw();
            }
        });

        // Marriage Place (Column 8)
        $('#search_place').keyup(function() {
            table.column(8).search(this.value).draw();
        });

        // Quantity (Column 9)
        $('#search_quantity').keyup(function() {
            table.column(9).search(this.value).draw();
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
            $('#search_husband').val('');
            $('#search_wife').val('');
            $('#search_address').val('');
            $('#search_marriage_date').val('');
            $('#search_place').val('');
            $('#search_quantity').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush