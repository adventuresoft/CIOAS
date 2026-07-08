@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'District'])

@push('style')
@endpush

@section('title', 'District Details')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-eye"></i> District Details
                        </h3>
                    </div>
                    <div class="cioas-panel-body">
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
                    </div>
                </div>

                <div class="cioas-panel mt-3">
                    <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                        <a href="{{ route('basic-settings.district.index') }}" class="btn btn-secondary btn-material">
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
