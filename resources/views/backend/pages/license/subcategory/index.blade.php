@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Subcategory')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>License Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('basic-settings.license-subcategory.index', $category_id) }}">License
                                Subcategory</a></li>
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
                            <h3 class="card-title">License Subcategory List</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('basic-settings.license-subcategory.create', $category_id) }}"
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
                                <th>Category</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $subcategory->en_name }}</td>
                                    <td>{{ $subcategory->bn_name }}</td>
                                    <td>{{ $subcategory->category->en_name ?? '' }}</td>
                                    <td>{{ date('d M, Y', strtotime($subcategory->updated_at)) }}</td>
                                    <td>
                                        <div class="table-action">
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('basic-settings.license-subcategory.edit', $subcategory->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('basic-settings.license-subcategory.show', $subcategory->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <form class="deleteSubcategory d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" class="deleteUrl"
                                                    value="{{ route('basic-settings.license-subcategory.destroy', $subcategory->id) }}">
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
            $('.deleteSubcategory').on('submit', function (e) {
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