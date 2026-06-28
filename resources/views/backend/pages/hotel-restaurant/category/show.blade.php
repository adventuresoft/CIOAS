@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'HotelCategory'])
@push('style')
@endpush
@section('title', 'Hotel Category Details')
@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-eye"></i> Hotel Category Details
                        </h3>
                    </div>
                    <div class="cioas-panel-body">
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
                                        <td>{{ $category->created_at ? $category->created_at->format('d M, Y h:i A') : '—' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger">
                                Hotel Category information not found.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="cioas-panel mt-3">
                    <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                        <a href="{{ route('basic-settings.hotel-category.index') }}" class="btn btn-secondary btn-material">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
