@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'HotelCategory'])
@push('style')
@endpush
@section('title', 'Hotel Category Details')
@section('content')
    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="cioas-panel">
                        <div class="panel-header">
                            <h3 class="panel-title">Hotel Category Information</h3>
                        </div>
                        <div class="panel-body">
                            @if ($category)
                                <table class="table table-bordered table-striped cioas-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">English Name</th>
                                            <td>{{ $category->en_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bengali Name</th>
                                            <td>{{ $category->bn_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $category->created_at ? $category->created_at->format('d M, Y h:i A') : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger">
                                    Hotel Category information not found.
                                </div>
                            @endif

                            <div class="mt-4 text-right">
                                <a href="{{ route('basic-settings.hotel-category.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('script')
@endpush
