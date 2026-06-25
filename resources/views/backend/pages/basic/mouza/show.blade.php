@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Mouza'])

@push('style')
@endpush

@section('title', 'Mouza Details')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mouza Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.mouza.index') }}">Mouza</a></li>
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
                <div class="col-md-8 offset-md-2">
                    <div class="cioas-panel">
                        <div class="panel-header">
                            <h3 class="panel-title">Information</h3>
                        </div>
                        <div class="panel-body">
                            @if ($mouza)
                                <table class="table table-bordered table-striped cioas-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%;">Bengali Name</th>
                                            <td>{{ $mouza->bn_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mouza Name</th>
                                            <td>{{ $mouza->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Record</th>
                                            <td>{{ $mouza->record }}</td>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $mouza->district->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Upazila/Circle</th>
                                            <td>{{ $mouza->upazila->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <td>{{ $mouza->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Order</th>
                                            <td>{{ $mouza->order }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($mouza->status == 1)
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
                                    Mouza information not found.
                                </div>
                            @endif

                            <div class="mt-4 text-right">
                                <a href="{{ route('basic-settings.mouza.index') }}" class="btn btn-secondary">
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
