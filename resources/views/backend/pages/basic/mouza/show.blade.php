@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Mouza'])

@push('style')
@endpush

@section('title', 'Mouza Details')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-eye"></i> Mouza Details
                        </h3>
                    </div>
                    <div class="cioas-panel-body">
                        @if ($mouza)
                            <table class="table table-bordered table-striped cioas-table">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%;">English Name</th>
                                        <td>{{ $mouza->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bengali Name</th>
                                        <td>{{ $mouza->bn_name }}</td>
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
                    </div>
                </div>

                <div class="cioas-panel mt-3">
                    <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                        <a href="{{ route('basic-settings.mouza.index') }}" class="btn btn-secondary btn-material">
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
