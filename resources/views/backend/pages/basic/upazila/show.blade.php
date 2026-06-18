@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Upazila'])
@push('style')
@endpush
@section('title', 'Upazila/Circle')
@section('content')
 <div class="container-fluid pt-4">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Upazila/Circle Details</h3>
        </div>
        <div class="card-body">
            @if ($upazila)
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Upazila/Circle Name</th>
                        <td>{{ $upazila->name }}</td>
                    </tr>
                    <tr>
                        <th>Bengali Name</th>
                        <td>{{ $upazila->bn_name }}</td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td>{{ $upazila->district->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Record</th>
                        <td>{{ $upazila->record }}</td>
                    </tr>
                    <tr>
                        <th>Code</th>
                        <td>{{ $upazila->code }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($upazila->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                <p class="text-danger">Upazila/Circle information not found.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('basic-settings.upazila.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
 </div>
@endsection
@push('script')
@endpush
