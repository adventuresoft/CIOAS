@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Village'])

@push('style')
@endpush

@section('title', 'View Village')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Village</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.village.index') }}">Village</a></li>
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
                            <h3 class="panel-title">Village Details</h3>
                        </div>
                        <div class="panel-body">
                            @if ($village)
                                <table class="table table-bordered table-striped cioas-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">Village Name (English)</th>
                                            <td>{{ $village->en_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Village Name (Bengali)</th>
                                            <td>{{ $village->bn_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Division</th>
                                            <td>{{ $village->division->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $village->district->name ?? '' }}</td>
                                        </tr>
                                        
                                        @if($village->location_type == 'union_type')
                                            <tr>
                                                <th>Location Type</th>
                                                <td><span class="badge bg-info">Union</span></td>
                                            </tr>
                                            <tr>
                                                <th>Thana</th>
                                                <td>{{ $village->thana->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Union</th>
                                                <td>{{ $village->union->name ?? '' }}</td>
                                            </tr>
                                        @elseif($village->location_type == 'pos_type')
                                            <tr>
                                                <th>Location Type</th>
                                                <td><span class="badge bg-primary">Pourashava</span></td>
                                            </tr>
                                            <tr>
                                                <th>Pourashava</th>
                                                <td>{{ $village->pourashava->name ?? '' }}</td>
                                            </tr>
                                        @elseif($village->location_type == 'city_type')
                                            <tr>
                                                <th>Location Type</th>
                                                <td><span class="badge bg-warning">City Corporation</span></td>
                                            </tr>
                                            <tr>
                                                <th>City Corporation</th>
                                                <td>{{ $village->cityCorporation->name ?? '' }}</td>
                                            </tr>
                                        @endif
                                        
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($village->status == 1)
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
                                    Village information not found.
                                </div>
                            @endif

                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('basic-settings.village.index') }}" class="btn btn-secondary">
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
