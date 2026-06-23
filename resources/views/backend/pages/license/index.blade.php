@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License List')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="card-title" style="font-size:24px; font-weight: semi-bold;">License Information</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            @if (create_permission())
                                <a href="{{ route('license.create') }}" class="btn btn-primary">Create</a>
                                <a href="{{ route('license.index') }}" class="btn btn-primary">List</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-center g-2">
                        <div class="col-md-1">
                            <select id="tableLength" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-2"><input type="text" id="search_name" class="form-control form-control-sm"
                                placeholder="License Name"></div>
                        <div class="col-md-2"><input type="text" id="search_category" class="form-control form-control-sm"
                                placeholder="Category"></div>
                        <div class="col-md-2"><input type="text" id="search_subcategory"
                                class="form-control form-control-sm" placeholder="Subcategory"></div>
                        <div class="col-md-2"><input type="text" id="search_license_no" class="form-control form-control-sm"
                                placeholder="License No."></div>
                        <div class="col-md-2"><input type="text" id="search_global" class="form-control form-control-sm"
                                placeholder="Search"></div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Application ID</th>
                                <th>License Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>License No.</th>
                                <th>Applied Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($licenses as $key => $license)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $license->application_id }}</td>
                                    <td>{{ $license->name }}</td>
                                    <td>{{ $license->category->en_name ?? '' }}</td>
                                    <td>{{ $license->subcategory->en_name ?? '' }}</td>
                                    <td>{{ $license->license_no ?? '' }}</td>
                                    <td>{{ date('d-m-Y', strtotime($license->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if (view_permission())
                                                <a href="{{ route('license.edit', $license->id) }}" title="Edit"
                                                    class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('license.show', $license->id) }}" title="View"
                                                    class="btn btn-info btn-sm mx-1"><i class="fa fa-eye"></i></a>
                                                <form class="deleteLicense d-inline" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" class="deleteUrl"
                                                        value="{{ route('license.destroy', $license->id) }}">
                                                    <button type="submit" class="btn btn-danger btn-sm mx-1"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            let table = $('#example1').DataTable({
                dom: 'rtip',
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                columnDefs: [{ targets: 7, orderable: false }]
            });

            $('#search_name').keyup(function () { table.column(2).search(this.value).draw(); });
            $('#search_category').keyup(function () { table.column(3).search(this.value).draw(); });
            $('#search_subcategory').keyup(function () { table.column(4).search(this.value).draw(); });
            $('#search_license_no').keyup(function () { table.column(5).search(this.value).draw(); });
            $('#search_global').keyup(function () { table.search(this.value).draw(); });
            $('#tableLength').change(function () { table.page.len($(this).val()).draw(); });

            $('.deleteLicense').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: 'POST',
                    url: thisForm.find('.deleteUrl').val(),
                    data: thisForm.serialize(),
                    success: function (response) {
                        toastr.success(response.message);
                        location.reload();
                    },
                    error: function (xhr) {
                        toastr.error(jQuery.parseJSON(xhr.responseText).message);
                    }
                });
            });
        });
    </script>
@endpush