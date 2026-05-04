@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleAddFees'])
@push('style')
<style>
    .fee-option-card {
        border: 1px solid #d8dee7;
        border-radius: 10px;
        background: #fff;
        padding: 18px;
        margin-bottom: 15px;
    }

    .fee-option-title {
        margin: 0 0 6px 0;
        font-size: 18px;
        font-weight: 600;
    }

    .fee-option-description {
        margin-bottom: 12px;
        color: #5b6775;
    }
</style>
@endpush
@section('title', 'Vehicle Add Fees')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Select Fees Module</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($feeOptions as $option)
                        <div class="col-md-12">
                            <div class="fee-option-card">
                                <h4 class="fee-option-title">{{ $option['title'] }}</h4>
                                <div class="fee-option-description">{{ $option['description'] }}</div>
                                @if(($option['url'] ?? '#') !== '#')
                                    <a href="{{ $option['url'] }}" class="btn btn-primary">Open</a>
                                @else
                                    <button type="button" class="btn btn-secondary" disabled>Unavailable</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
