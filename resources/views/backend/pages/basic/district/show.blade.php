@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'District'])

@push('style')
@endpush

@section('title', 'View District')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>District</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.district.index') }}">District</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="cioas-panel">
                        <div class="panel-header">
                            <h3 class="panel-title">District Details</h3>
                        </div>
                        <div class="panel-body">
                            @if ($district)
                                <table class="table table-bordered table-striped cioas-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">District Name (English)</th>
                                            <td>{{ $district->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>District Name (Bengali)</th>
                                            <td>{{ $district->bn_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Division</th>
                                            <td>{{ $district->division->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($district->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger">
                                    District information not found.
                                </div>
                            @endif

                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('basic-settings.district.index') }}" class="btn btn-secondary">
                                        <i class="ti ti-arrow-left"></i> Back to List
                                    </a>
                                </div>
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
