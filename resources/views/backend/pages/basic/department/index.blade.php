@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])
@push('style')
@endpush
@section('title', 'Hotel Category')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deputy commissioner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.department.index') }}">Department</a>
                        </li>
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
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Department List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('basic-settings.department.create') }}"
                                        class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="table-responsive">
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

                                        @if ($departments)
                                            @foreach ($departments as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->bn_name }}</td>
                                                    <td>{{ date('d M, Y', strtotime($item->updated_at)) }}</td>
                                                    <td>
                                                        <div class="table-action">
                                                            <div class="dropdown dropleft d-inline ml-2">
                                                            </div>
                                                            <a class="btn btn-sm btn-dark" title="Show"
                                                                data-toggle="tooltip"
                                                                href="{{ route('basic-settings.department-section.index', $item->id) }}"><i
                                                                    class="fas fa-list"></i></a>
                                                            {{-- <a class="btn btn-sm btn-info" title="Show"
                                                                data-toggle="tooltip"
                                                                href="{{ route('basic-settings.department.show', $item->id) }}"><i
                                                                    class="fa fa-eye"></i></a> --}}

                                                            <form class="deleteData" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" class="id" name="id"
                                                                    value="{{ $item->id }}">
                                                                <input type="hidden" class="deleteUrl" name="deleteUrl"
                                                                    value="{{ route('basic-settings.department.destroy', $item->id) }}">
                                                                <input type="hidden" class="redirect-url"
                                                                    name="redirectUrl"
                                                                    value="{{ route('basic-settings.department.index') }}">
                                                                <button type="submit" title="Delete" data-toggle="tooltip"
                                                                    class="btn btn-sm btn-danger"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </tbody>
                                </table>
                            </div>

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
    <script></script>
@endpush
