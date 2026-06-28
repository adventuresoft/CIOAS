@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Thana'])

@push('style')
@endpush

@section('title', 'Thana Details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thana Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.thana.index') }}">Thana</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-eye"></i> Thana Details
                        </h3>
                    </div>
                    <div class="cioas-panel-body">
                        @if ($thana)
                            <table class="table table-bordered table-striped cioas-table">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%;">Thana Name</th>
                                        <td>{{ $thana->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bengali Name</th>
                                        <td>{{ $thana->bn_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $thana->district->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($thana->status == 1)
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
                                Thana information not found.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="cioas-panel mt-3">
                    <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                        <a href="{{ route('basic-settings.thana.index') }}" class="btn btn-secondary btn-material">
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
