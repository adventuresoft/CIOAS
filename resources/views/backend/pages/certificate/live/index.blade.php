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

    /* small input */
    .row.mb-3 input {
        height: 32px;
        font-size: 13px;
    }

    /* hide datatable search */
    .dataTables_filter {
        display: none;
    }

    .filter-box{
        background:#f8f9fa;
        padding:15px;
        border-radius:6px;
        border:1px solid #e5e5e5;
        margin-bottom:15px;
    }
</style>
@endpush

@section('title', 'Married Certificate')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Married Certificate</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('married.index')}}">Married</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

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
                            <div class="col-md-6 text-left">
                                <h3 class="card-title" style="font-size:24px;">Certificate List</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                    <a href="{{route('married.create')}}" class="btn btn-primary">Create</a>
                                    <a href="{{route('married.index')}}" class="btn btn-primary">List</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        
                        <!-- ================= Advanced Search ================= -->
                        <div class="filter-box">
                            <div class="row align-items-center g-2">

                                <!-- Show Entries Dropdown -->
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
                                <div class="col-md-3">
                                    <input type="text" id="search_husband_name" class="form-control form-control-sm"
                                           placeholder="Husband ID or Name">
                                </div>

                                <!-- Wife ID or Name Filter -->
                                <div class="col-md-3">
                                    <input type="text" id="search_wife_name" class="form-control form-control-sm"
                                           placeholder="Wife ID or Name">
                                </div>

                                <!-- Address or Mobile Filter -->
                                <div class="col-md-2">
                                    <input type="text" id="search_address" class="form-control form-control-sm"
                                           placeholder="Address or Mobile">
                                </div>

                                <!-- Email Filter -->
                                <div class="col-md-2 mt-2">
                                    <input type="text" id="search_email" class="form-control form-control-sm"
                                           placeholder="Email">
                                </div>

                                <!-- Marriage Date Filter -->
                                <div class="col-md-2 mt-2">
                                    <input type="date" id="search_marriage_date" class="form-control form-control-sm"
                                           placeholder="Marriage Date">
                                </div>

                                <!-- Marriage Place Filter -->
                                <div class="col-md-2 mt-2">
                                    <input type="text" id="search_marriage_place" class="form-control form-control-sm"
                                           placeholder="Marriage Place">
                                </div>

                                <!-- Witness Name Filter -->
                                <div class="col-md-2 mt-2">
                                    <input type="text" id="search_witness" class="form-control form-control-sm"
                                           placeholder="Witness Name">
                                </div>

                                <!-- Quantity Filter -->
                                <!-- <div class="col-md-2 mt-2">
                                    <input type="number" id="search_quantity" class="form-control form-control-sm"
                                           placeholder="Quantity">
                                </div> -->

                                <!-- Global Search Filter -->
                                <div class="col-md-2 mt-2">
                                    <input type="text" id="search_global" class="form-control form-control-sm"
                                           placeholder="Global Search">
                                </div>

                                <!-- Reset Button -->
                                <!-- <div class="col-md-2 mt-2">
                                    <button id="resetFilter" class="btn btn-secondary btn-sm btn-block">
                                        Reset Filters
                                    </button>
                                </div> -->

                            </div>
                        </div>
                        <!-- ==================================================== -->
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Photo (Husband)</th>
                                    <th>Photo (Wife)</th>
                                    <th>Certificate No</th>
                                    <th>Husband ID & Name</th>
                                    <th>Wife ID & Name</th>
                                    <th>Email</th>
                                    <th>Address & Mobile</th>
                                    <th>Marriage Date</th>
                                    <th>Marriage Place</th>
                                    <th>Witness</th>
                                    <th>Quantity</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($certificates)
                                    @foreach ($certificates as $key => $certificate)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            
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
                                            
                                            <td>{{ $certificate->user->email ?? '' }}</td>
                                            
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
                                            
                                            <td>{{ $certificate->witness_name ?? 'N/A' }}</td>
                                            
                                            <td>{{ $certificate->quantity }}</td>
                                            
                                            <td>{{ $certificate->created_at->format('d-m-Y') }}</td>
                                            
                                            <td>
                                                <a target="_blank" href="{{route('married.show', $certificate->id)}}" 
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-file-pdf"></i> EN
                                                </a>
                                                <a target="_blank" href="{{route('married.bn_certificate', $certificate->id)}}" 
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-file-pdf"></i> BN
                                                </a>
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
$(function () {

    // Initialize DataTable
    var table = $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthChange": false,
        "order": [[0, 'asc']],
        "columnDefs": [
            { targets: [1, 2], orderable: false }, // Disable sorting on photo columns
            { targets: 13, orderable: false }      // Disable sorting on action column
        ]
    });

    // Certificate Number Filter (Column 3)
    $('#search_cert').on('keyup change', function () {
        table.column(3).search(this.value).draw();
    });

    // Husband ID & Name Filter (Column 4)
    $('#search_husband_name').on('keyup change', function () {
        table.column(4).search(this.value).draw();
    });

    // Wife ID & Name Filter (Column 5)
    $('#search_wife_name').on('keyup change', function () {
        table.column(5).search(this.value).draw();
    });

    // Email Filter (Column 6)
    $('#search_email').on('keyup change', function () {
        table.column(6).search(this.value).draw();
    });

    // Address & Mobile Filter (Column 7)
    $('#search_address').on('keyup change', function () {
        table.column(7).search(this.value).draw();
    });

    // Marriage Date Filter (Column 8)
    $('#search_marriage_date').on('change', function () {
        if (this.value) {
            let date = this.value.split('-').reverse().join('-');
            table.column(8).search(date).draw();
        } else {
            table.column(8).search('').draw();
        }
    });

    // Marriage Place Filter (Column 9)
    $('#search_marriage_place').on('keyup change', function () {
        table.column(9).search(this.value).draw();
    });

    // Witness Name Filter (Column 10)
    $('#search_witness').on('keyup change', function () {
        table.column(10).search(this.value).draw();
    });

    // Quantity Filter (Column 11)
    $('#search_quantity').on('keyup change', function () {
        table.column(11).search(this.value).draw();
    });

    // Global Search Filter
    $('#search_global').on('keyup change', function () {
        table.search(this.value).draw();
    });

    // Change show entries
    $('#tableLength').change(function() {
        table.page.len($(this).val()).draw();
    });

    // Reset all filters
    $('#resetFilter').click(function () {
        // Clear all input fields
        $('#search_cert').val('');
        $('#search_husband_name').val('');
        $('#search_wife_name').val('');
        $('#search_email').val('');
        $('#search_address').val('');
        $('#search_marriage_date').val('');
        $('#search_marriage_place').val('');
        $('#search_witness').val('');
        $('#search_quantity').val('');
        $('#search_global').val('');
        
        // Clear all searches
        table.search('').columns().search('').draw();
    });

});
</script>
@endpush