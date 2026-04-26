@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'approvedList'])

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

    .row.mb-3 select {
        height: 32px;
        font-size: 13px;
    }

    /* hide datatable search */
    .dataTables_filter {
        display: none;
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

    .table-action {
        display: flex;
        gap: 5px;
    }

    .btn-action {
        padding: 4px 8px;
        font-size: 12px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
</style>
@endpush

@section('title', 'People View')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card card-info">

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">People Information</h3>
                            </div>

                            <div class="col-md-6 text-right">
                                @if (create_permission())
                                <a href="{{ route('people.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('people.index') }}" class="btn btn-primary">List</a>
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

                            <!-- Name Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_name" class="form-control form-control-sm"
                                    placeholder="Name">
                            </div>

                            <!-- Mobile Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_mobile" class="form-control form-control-sm"
                                    placeholder="Mobile">
                            </div>

                            <!-- Email Filter -->
                            <div class="col-md-2">
                                <input type="text" id="search_email" class="form-control form-control-sm"
                                    placeholder="Email">
                            </div>

                            <!-- Gender Filter -->
                            <div class="col-md-2">
                                <select id="search_gender" class="form-control form-control-sm">
                                    <option value="">All Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Institute Filter -->
                            <!-- <div class="col-md-2">
                                <input type="text" id="search_institute" class="form-control form-control-sm"
                                    placeholder="Institute">
                            </div> -->

                            <!-- GLOBAL SEARCH -->
                            <!-- <div class="col-md-2 mt-2">  -->
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
                                    <th>Reg. ID & Name</th>
                                    <th>Mobile & Email</th>
                                    <th>Gender & DOB</th>
                                    <th>Profession</th>
                                    <th>Present Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users && count($users) > 0)
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                         <!--<td>
                                            {{ $user->system_id ?? '' }}
                                        </td>-->

                                        <td>
                                            <img src="{{ asset($user->image ?? 'default.png') }}"
                                                width="45"
                                                height="55"
                                                class="img"
                                                onerror="this.src='{{ asset('default.png') }}'">
                                        </td>

                                        <td>
                                            <span class="citizen-id">
                                                {{$user->people->approved_id}}
                                            </span><br>
                                            <strong>{{ $user->name ?? '' }}</strong>
                                        </td>

                                        <td>
                                            @if($user->mobile)
                                                <a href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a>
                                            @endif
                                            @if($user->email)
                                                <br><a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                            @endif
                                        </td>

                                        <td>
                                            @php
                                                $genderOptions = people_constant_option('gender');
                                                $gender = isset($user->people->gender) ? ($genderOptions[$user->people->gender] ?? '') : '';
                                                $dob = $user->people->date_of_birth ?? '';
                                            @endphp
                                            {{ $gender }}<br>
                                            <small>{{ $dob ? date('d-m-Y', strtotime($dob)) : 'N/A' }}</small>
                                        </td>

                                        <td>
                                           {{ optional($user->professionalInfos)->pluck('designation')->implode(', ') }}
                                        </td>

                                        <td>
                                            <!--
                                            @php
                                                $instituteFind = user_institute_information($user->institute_id);
                                            @endphp
                                            {{ $instituteFind['institute']->name ?? '' }} {{ $instituteFind['institute_type'] ?? '' }} -->
                                          <strong>Present Address:</strong>  {{ collect([
    $user->addressInfo->presentDistrict->name ?? '',
    $user->addressInfo->presentThana->name ?? '',
    $user->addressInfo->presentUnion->name ?? '',
    $user->addressInfo->presentPostoffice->name ?? '',
    $user->addressInfo->presentVillage->en_name ?? '',
    $user->addressInfo->presentWard->en_ward_no ?? '',
    $user->addressInfo->present_area ?? '',
    $user->addressInfo->presentRoad->name ?? '',
    $user->addressInfo->presentHouse->house ?? ''
])->filter()->implode(', ') }} <!--

<br/>
<strong>
Permanent Address:</strong>
{{ collect([
    $user->addressInfo->permanentDistrict->name ?? '',
    $user->addressInfo->permanentThana->name ?? '',
    $user->addressInfo->permanentUnion->name ?? '',
    $user->addressInfo->permanentPostoffice->name ?? '',
    $user->addressInfo->permanentVillage->en_name ?? '',
    $user->addressInfo->permanentWard->en_ward_no ?? '',
    $user->addressInfo->permanent_area ?? '',
    $user->addressInfo->permanentRoad->name ?? '',
    $user->addressInfo->permanentHouse->house ?? ''
])->filter()->implode(', ') }}-->
                                        </td>

                                        <td>
                                            <div class="table-action">
                                                @if (Auth::user()->institute_id && create_permission())
                                                <a href="{{ route('people.edit', $user->id) }}" 
                                                    class="btn btn-primary btn-sm btn-action" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('people.show', $user->id) }}" 
                                                    class="btn btn-info btn-sm btn-action" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h5>No people found</h5>
                                            <p class="text-muted">Get started by creating a new person.</p>
                                            @if (create_permission())
                                            <a href="{{ route('people.create') }}" class="btn btn-primary mt-2">
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
                { targets: 6, orderable: false }  // Disable sorting on action column
            ],
            language: {
                emptyTable: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No data available</h5></div>',
                zeroRecords: '<div class="empty-state"><i class="fas fa-folder-open"></i><h5>No matching records found</h5></div>'
            }
        });

        // Name (Column 2)
        $('#search_name').keyup(function() {
            table.column(2).search(this.value).draw();
        });

        // Mobile & Email (Column 3)
        $('#search_mobile').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Email (also Column 3 - combined with mobile)
        $('#search_email').keyup(function() {
            table.column(3).search(this.value).draw();
        });

        // Gender & DOB (Column 4)
        $('#search_gender').change(function() {
            table.column(4).search(this.value).draw();
        });

        // Institute (Column 5)
        $('#search_institute').keyup(function() {
            table.column(5).search(this.value).draw();
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
            $('#search_name').val('');
            $('#search_mobile').val('');
            $('#search_email').val('');
            $('#search_gender').val('');
            $('#search_institute').val('');
            $('#search_global').val('');
            
            // Clear all searches
            table.search('').columns().search('').draw();
        });

    });
</script>

@endpush