@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Mouza'])
@push('style')
@endpush
@section('title', 'Mouza')
@section('content')
 <div class="container-fluid pt-4">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Mouza Details</h3>
        </div>
        <div class="card-body">
            @if ($mouza)
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Bengali Name</th>
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
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            @else
                <p class="text-danger">Mouza information not found.</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('basic-settings.mouza.index') }}" class="btn btn-default">Back to List</a>
        </div>
    </div>
 </div>
@endsection
@push('script')
@endpush
