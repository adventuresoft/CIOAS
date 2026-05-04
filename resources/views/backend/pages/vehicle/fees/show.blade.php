@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleAddFeesList'])
@push('style')
<style>
    .summary-table th,
    .summary-table td {
        vertical-align: middle;
    }
</style>
@endpush
@section('title', 'Vehicle Fees Setup Details')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Vehicle Fees Setup Details</h3>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Finance Year:</strong> {{ $fee->finance_year }}</div>
                    <div class="col-md-3"><strong>Vehicle Type:</strong> {{ $fee->vehicle_type }}</div>
                    <div class="col-md-3"><strong>Vehicle Category:</strong> {{ $fee->vehicle_category }}</div>
                    <div class="col-md-3"><strong>New/Renew:</strong> {{ ucfirst($fee->fee_for) }}</div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered summary-table">
                        <thead>
                            <tr>
                                <th style="width: 90px;">SL</th>
                                <th>Fees Head</th>
                                <th style="width: 260px;">Amount / Taka</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Registration</td>
                                <td>{{ number_format((float) $fee->registration_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Road</td>
                                <td>{{ number_format((float) $fee->road_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Fitness</td>
                                <td>{{ number_format((float) $fee->fitness_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>VAT</td>
                                <td>{{ number_format((float) $fee->vat_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Tax</td>
                                <td>{{ number_format((float) $fee->tax_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total</strong></td>
                                <td><strong>{{ number_format((float) $fee->total_fee, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-2">
                    <small class="text-muted">
                        Created: {{ $fee->created_at ? $fee->created_at->format('d-m-Y h:i A') : '--' }} |
                        Updated: {{ $fee->updated_at ? $fee->updated_at->format('d-m-Y h:i A') : '--' }}
                    </small>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('vehicle.fees.edit', $fee->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('vehicle.fees.list') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</section>
@endsection

