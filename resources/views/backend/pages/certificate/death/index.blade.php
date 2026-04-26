@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Death'])

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

    /* small input */
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

@section('title', 'Death Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Death Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('death.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('death.index') }}" class="btn btn-primary">List</a>
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

                            <!-- Name & System ID Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="ID or Name">
                            </div>

                            <!-- Death Date Filter -->
                            <div class="col-md-2">
                                <input type="date" id="search_death_date" class="form-control form-control-sm">
                            </div>

                            <!-- Cause of Death Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_cause" class="form-control form-control-sm"
                                    placeholder="Cause of Death">
                            </div>

                            <!-- Quantity Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_quantity" class="form-control form-control-sm"
                                    placeholder="Quantity">
                            </div> -->

                            <!-- GLOBAL SEARCH -->
                            <!-- <div class="col-md-2 mt-2">  -->
                            <div class="col-md-2"> 
                                <input type="text" id="search_global" class="form-control form-control-sm" 
                                    placeholder="Global Search"> 
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
                                    <th>Death Date</th>
                                    <th>Cause of Death</th>
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
                                            {{ $certificate->death_date 
                                                ? \Carbon\Carbon::parse($certificate->death_date)->format('d-m-Y') 
                                                : 'N/A' }}
                                        </td>

                                        <td>{{ $certificate->cause_of_death ?? 'N/A' }}</td>

                                        <td>{{ $certificate->quantity ?? '' }}</td>

                                        <td>{{ $certificate->created_at->format('d-m-Y') }}</td>

                                        <td>
                                            <a target="_blank"
                                                href="{{ route('death.show', $certificate->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-pdf"></i> EN
                                            </a>

                                            <a target="_blank"
                                                href="{{ route('death.bn_certificate', $certificate->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-file-pdf"></i> BN
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            No death certificates found.
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
                { targets: 8, orderable: false }  // Disable sorting on action column
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

        // Death Date (Column 4)
        $('#search_death_date').on('change', function() {
            if (this.value) {
                // Convert YYYY-MM-DD to DD-MM-YYYY for searching
                let dateParts = this.value.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                table.column(4).search(formattedDate).draw();
            } else {
                table.column(4).search('').draw();
            }
        });

        // Cause of Death (Column 5)
        $('#search_cause').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Quantity (Column 6)
        $('#search_quantity').keyup(function() {
            table.column(6).search(this.value).draw();
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
            $('#search_death_date').val('');
            $('#search_cause').val('');
            $('#search_quantity').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush