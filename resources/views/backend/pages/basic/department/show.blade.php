@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Department Details')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title"><i class="fas fa-eye"></i> Department Details</h3>
                    </div>
                    <div class="cioas-panel-body">
                        @if ($department)
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="30%">Department Name</th>
                                    <td>{{ $department->name }}</td>
                                </tr>
                                <tr>
                                    <th>Bengali Name</th>
                                    <td>{{ $department->bn_name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $department->created_at ? $department->created_at->format('d M, Y h:i A') : '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $department->updated_at ? $department->updated_at->format('d M, Y h:i A') : '—' }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-danger">Department information not found.</p>
                        @endif
                    </div>
                    <div class="cioas-actions mt-4">
                        <a href="{{ route('basic-settings.department.index') }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
