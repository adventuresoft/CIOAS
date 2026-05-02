@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'NidCorrection'])

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

    /* Keep some premium elements */
    .badge-nid {
        background: #e9ecef;
        color: #495057;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .badge-date {
        background: #e9ecef;
        color: #495057;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .correction-badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .correction-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .correction-badge.approved {
        background: #d4edda;
        color: #155724;
    }

    .correction-badge.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .nid-old {
        text-decoration: line-through;
        color: #dc3545;
        font-size: 12px;
    }

    .nid-new {
        color: #28a745;
        font-weight: 600;
        font-size: 13px;
    }

    .correction-field {
        background: #f8f9fa;
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 12px;
        display: inline-block;
        margin: 2px 0;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .img-circle {
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endpush

@section('title', 'NID Correction Certificate')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">NID Correction Certificate</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('nid-correction.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('nid-correction.index') }}" class="btn btn-primary">List</a>
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

                            <!-- NID Number Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_nid" class="form-control form-control-sm"
                                    placeholder="NID Number">
                            </div>

                            <!-- Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Address/Mobile Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_address" class="form-control form-control-sm"
                                    placeholder="Address/Mobile">
                            </div> -->

                            <!-- Status Filter -->
                            <div class="col-md-2">
                                <select id="search_status" class="form-control form-control-sm">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <!-- Quantity Filter -->
                            <!-- <div class="col-md-2 mt-2">
                                <input type="text" id="search_quantity" class="form-control form-control-sm"
                                    placeholder="Quantity">
                            </div> -->

                            <!-- Created Date Filter -->
                            <!-- <div class="col-md-2 mt-2">
                                <input type="date" id="search_date" class="form-control form-control-sm"
                                    placeholder="Created Date">
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
                                    <th>NID Number</th>
                                    <th>Name</th>
                                    <th>Address & Mobile</th>
                                    <th>Correction Details</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($certificates && count($certificates) > 0)
                                    @foreach ($certificates as $key => $certificate)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            <img src="{{ asset($certificate->user->photo ?? 'default.png') }}"
                                                width="40"
                                                height="40"
                                                class="img-circle"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <span class="badge-nid">
                                                {{ $certificate->certificate_number ?? bnValue($certificate->system_id ?? 'N/A') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="citizen-id">
                                                {{ bnValue($certificate->nid_number ?? $certificate->user->nid ?? 'N/A') }}
                                            </span>
                                        </td>

                                        <td>
                                            <strong>{{ $certificate->user->name ?? 'N/A' }}</strong>
                                            @if($certificate->old_name)
                                                <br><small class="nid-old">Old: {{ $certificate->old_name }}</small>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $certificate->user->address ?? 'N/A' }} <br>
                                            <strong>{{ $certificate->user->mobile ?? 'N/A' }}</strong>
                                        </td>

                                        <td>
                                            @php
                                                $corrections = json_decode($certificate->correction_fields, true) ?? [];
                                            @endphp
                                            @if(!empty($corrections))
                                                @foreach($corrections as $field => $value)
                                                    <span class="correction-field">
                                                        <strong>{{ ucfirst($field) }}:</strong> 
                                                        <span class="nid-old">{{ $value['old'] ?? '' }}</span> → 
                                                        <span class="nid-new">{{ $value['new'] ?? '' }}</span>
                                                    </span><br>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No corrections</span>
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $status = $certificate->status ?? 'pending';
                                                $statusClass = match($status) {
                                                    'approved' => 'approved',
                                                    'rejected' => 'rejected',
                                                    default => 'pending'
                                                };
                                            @endphp
                                            <span class="correction-badge {{ $statusClass }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>

                                        <td class="text-center">{{ $certificate->quantity ?? '' }}</td>

                                        <td>
                                            <span class="badge-date">
                                                {{ $certificate->created_at ? date('d-m-Y', strtotime($certificate->created_at)) : 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            <a target="_blank" href="{{ route('nid-correction.show', $certificate->id) }}" 
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-pdf"></i> EN
                                            </a>
                                            <a target="_blank" href="{{ route('nid-correction.bn_certificate', $certificate->id) }}" 
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-file-pdf"></i> BN
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h5>No NID correction certificates found</h5>
                                            <p class="text-muted">Get started by creating a new certificate.</p>
                                            @if (create_permission())
                                            <a href="{{ route('nid-correction.create') }}" class="btn btn-primary mt-2">
                                                <i class="fas fa-plus-circle mr-1"></i> Create New
                                            </a>
                                            @endif
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
            ],
            language: {
                emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
            }
        });

        // Certificate No (Column 2)
        $('#search_cert').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // NID Number (Column 3)
        $('#search_nid').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Name (Column 4)
        $('#search_name').keyup(function() {
            table.column(4).search(this.value).draw();
        });

        // Address & Mobile (Column 5)
        $('#search_address').keyup(function() {
            table.column(5).search(this.value).draw();
        });

        // Status (Column 7)
        $('#search_status').change(function() {
            table.column(7).search(this.value).draw();
        });

        // Quantity (Column 8)
        $('#search_quantity').keyup(function() {
            table.column(8).search(this.value).draw();
        });

        // Created Date (Column 9)
        $('#search_date').on('change', function() {
            if (this.value) {
                // Convert YYYY-MM-DD to DD-MM-YYYY for searching
                let dateParts = this.value.split('-');
                let formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                table.column(9).search(formattedDate).draw();
            } else {
                table.column(9).search('').draw();
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
            $('#search_nid').val('');
            $('#search_name').val('');
            $('#search_address').val('');
            $('#search_status').val('');
            $('#search_quantity').val('');
            $('#search_date').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush