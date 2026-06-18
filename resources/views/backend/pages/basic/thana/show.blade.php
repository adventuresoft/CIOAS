@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Thana'])
@push('style')
@endpush
@section('title', 'Thana')
@section('content')
 <div class="container-fluid pt-4">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Thana Details</h3>
        </div>
        <div class="card-body">
            @if ($thana)
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Thana Name</th>
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
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                <p class="text-danger">Thana information not found.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('basic-settings.thana.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
 </div>
@endsection
@push('script')
@endpush
