@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Category')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>License Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.license-category.index') }}">License
                                Category</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">License Category List</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('basic-settings.license-category.create') }}"
                                class="btn btn-primary">Create</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Name</th>
                                <th>Bengali Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $category->en_name }}</td>
                                    <td>{{ $category->bn_name }}</td>
                                    <td>{{ date('d M, Y', strtotime($category->updated_at)) }}</td>
                                    <td>
                                        <div class="table-action">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('basic-settings.license-category.edit', $category->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('basic-settings.license-category.show', $category->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-warning" title="Subcategories" data-toggle="tooltip"
                                                href="{{ route('basic-settings.license-subcategory.index', $category->id) }}"><i
                                                    class="fa fa-list"></i> Subcategories</a>
                                            <form class="deleteCategory d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" class="deleteUrl"
                                                    value="{{ route('basic-settings.license-category.destroy', $category->id) }}">
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
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
            $('#example1').DataTable();
            $('.deleteCategory').on('submit', function (e) {
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