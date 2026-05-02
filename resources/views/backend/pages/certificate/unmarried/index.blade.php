@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Unmarried'])

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

@section('title', 'Unmarried Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">Unmarried Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('unmarried.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('unmarried.index') }}" class="btn btn-primary">List</a>
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

                            <div class="col-md-2">
                                <input type="text" id="search_cert" class="form-control form-control-sm"
                                    placeholder="Certificate No">
                            </div>

                            <div class="col-md-3">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="ID or Name">
                            </div>

                            <div class="col-md-3">
                                <input type="text" id="search_address" class="form-control form-control-sm"
                                    placeholder="Address or Mobile">
                            </div>

                           <!-- GLOBAL SEARCH --> <div class="col-md-3"> <input type="text" id="search_global" class="form-control form-control-sm" placeholder="Search"> </div>

                            <!-- <div class="col-md-2">
                                <input type="text" id="search_quantity" class="form-control form-control-sm"
                                    placeholder="Quantity">
                            </div> -->

                            <!-- <div class="col-md-1">
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
                                    <!-- <th>Quantity</th> -->
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($certificates as $key => $certificate)

                                <tr>

                                    <td>{{ ++$key }}</td>

                                    <td>
                                        <img src="{{ asset($certificate->user->image ?? 'default.png') }}"
                                            width="55"
                                            height="65"
                                            class="img">
                                    </td>

                                    <td>{{ bnValue($certificate->system_id) }}</td>

                                    <td>
                                        <span class="citizen-id">
                                            {{ bnValue($certificate->system_id ?? '') }}
                                        </span><br>
                                        {{ $certificate->user->name }}
                                    </td>

                                    <td>
                                        <strong>{{ $certificate->user->mobile }}</strong> <br>
                                   {{ $certificate->user->addressInfo->permanentVillage->bn_name ?? '' }},
                            ওয়ার্ড নং-{{ $certificate->user->addressInfo->permanentWard->bn_ward_no ?? '' }},
                                   {{ optional($certificate->user->addressInfo->permanentPostOffice)->bn_name ?? '' }} -
                                     @if(optional($certificate->user->addressInfo->permanentPostOffice)->postal_code)
                                   {{ bnValue($certificate->user->addressInfo->permanentPostOffice->postal_code) }},
                                  @endif <br>
                                   {{ $certificate->user->institute->union->thana->bn_name ?? '' }},
                                   {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}।
                                    </td>

                                    <!-- <td>{{ $certificate->quantity }}</td> -->

                                    <td>{{ $certificate->created_at->format('d-m-Y') }}</td>

                                    <td>

                                        <a target="_blank"
                                            href="{{ route('unmarried.show', $certificate->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-file-pdf"></i> EN
                                        </a>

                                        <a target="_blank"
                                            href="{{ route('unmarried.bn_certificate', $certificate->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fa fa-file-pdf"></i> BN
                                        </a>

                                    </td>

                                </tr>

                                @endforeach

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
                { targets: 7, orderable: false }  // Disable sorting on action column
            ]
        });

        // Certificate No (Column 2)
        $('#search_cert').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // Name (Column 3)
        $('#search_name').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Email (Column 4)
        $('#search_email').keyup(function() {
            table.column(4).search(this.value).draw();
        });

        // Quantity (Column 5)
        $('#search_quantity').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Created Date (Column 6)
        $('#search_date').on('change', function() {
            if (this.value) {
                // Convert YYYY-MM-DD to DD-MM-YYYY for searching
                let dateParts = this.value.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                table.column(6).search(formattedDate).draw();
            } else {
                table.column(6).search('').draw();
            }
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
            $('#search_email').val('');
            $('#search_quantity').val('');
            $('#search_date').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush