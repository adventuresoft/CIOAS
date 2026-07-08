@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Subcategory Details')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="cioas-panel">
                        <div class="panel-header">
                            <h3 class="panel-title">Information</h3>
                        </div>
                        <div class="panel-body">
                            @if ($subcategory)
                                <table class="table table-bordered table-striped cioas-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">English Name</th>
                                            <td>{{ $subcategory->en_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bengali Name</th>
                                            <td>{{ $subcategory->bn_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $subcategory->category->en_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($subcategory->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $subcategory->created_at ? $subcategory->created_at->format('d M, Y h:i A') : '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger">
                                    License Subcategory information not found.
                                </div>
                            @endif

                            <div class="mt-4 text-right">
                                <a href="{{ route('basic-settings.license-subcategory.index', $subcategory->license_category_id) }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
