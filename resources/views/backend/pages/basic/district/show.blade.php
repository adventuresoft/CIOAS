@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'District'])
@push('style')
@endpush
@section('title', 'District')
@section('content')
 <div class="container-fluid pt-4">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">District Details</h3>
        </div>
        <div class="card-body">
            @if ($district)
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">District Name</th>
                        <td>{{ $district->name }}</td>
                    </tr>
                    <tr>
                        <th>Bengali Name</th>
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
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                <p class="text-danger">District information not found.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('basic-settings.district.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
 </div>
@endsection
@push('script')
@endpush
