@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Department'])

@section('title', 'Section Details')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title"><i class="fas fa-eye"></i> Section Details</h3>
                    </div>
                    <div class="cioas-panel-body">
                        @if ($section)
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="30%">Section Name</th>
                                    <td>{{ $section->name }}</td>
                                </tr>
                                <tr>
                                    <th>Bengali Name</th>
                                    <td>{{ $section->bn_name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $section->created_at ? $section->created_at->format('d M, Y h:i A') : '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $section->updated_at ? $section->updated_at->format('d M, Y h:i A') : '—' }}</td>
                                </tr>
                            </table>
                        @else
                            <p class="text-danger">Section information not found.</p>
                        @endif
                    </div>
                    <div class="cioas-actions mt-4">
                        <a href="{{ route('basic-settings.department-section.index', $section->department_id) }}" class="btn btn-light btn-material">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
