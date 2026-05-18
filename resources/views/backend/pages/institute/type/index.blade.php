@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteType'])
@push('style')
@endpush
@section('title', 'Institute Type List')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Institute List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('institute-type.index') }}">Institute Type List</a></li>
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
                                    <h3 class="card-title">Institute Type List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('institute-type.create') }}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Institute Name</th>
                                        <th>Institute Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($institute as $key => $item)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <div class="table-action">
                                                    <div class="dropdown dropleft d-inline ml-2">
                                                    </div>
                                                    <a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip"
                                                        href="{{ route('institute-type.edit', $item->id) }}"><i
                                                            class="fa fa-edit"></i></a>

                                                    <form class="deleteData" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" class="id" name="id"
                                                            value="{{ $item->id }}">
                                                        <input type="hidden" class="deleteUrl" name="deleteUrl"
                                                            value="{{ route('institute-type.destroy', $item->id) }}">
                                                        <input type="hidden" class="redirect-url" name="redirectUrl"
                                                            value="{{ route('institute-type.index') }}">
                                                        <button type="submit" title="Delete" data-toggle="tooltip"
                                                            class="btn btn-sm btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
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
@endpush
