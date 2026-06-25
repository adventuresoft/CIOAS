@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' =>'VehicleList'])

@section('title', 'Vehicle Details')

@push('style')
<style>
    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 14px !important;
        line-height: 1.4;
        background: #f4f6f9;
    }

    .people-certificate-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 4px;
    }

    .people-certificate-content {
        padding: 10mm 15mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #006600;
        padding-bottom: 10px;
    }

    .header-logos img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 20px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .union-title-en {
        font-size: 18px;
        font-weight: bold;
        color: #2e3192;
        margin: 2px 0;
    }

    .union-address {
        font-size: 16px;
        margin: 0;
        color: #333;
    }

    .citizen-title {
        text-align: center;
        margin: 10px 0;
    }

    .citizen-title h4 {
        font-size: 20px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .section-header {
        background: #006600;
        color: #fff;
        font-weight: bold;
        padding: 6px 12px;
        margin: 20px 0 12px 0;
        font-size: 16px;
        border-radius: 4px;
        letter-spacing: 1px;
    }

    .info-row {
        display: flex;
        margin-bottom: 8px;
        font-size: 13px;
        border-bottom: 1px dotted #e0e0e0;
        padding-bottom: 5px;
    }

    .info-label {
        width: 220px;
        font-weight: bold;
        color: #2c3e4e;
    }

    .info-value {
        flex: 1;
        color: #1e2a36;
    }

    .two-columns {
        display: flex;
        gap: 30px;
        margin-top: 10px;
    }

    .col {
        flex: 1;
    }

    .photo-badge {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        background: #f8f9fc;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        align-items: flex-start;
    }

    .photo-box {
        text-align: center;
        flex-shrink: 0;
    }

    .photo-box img {
        width: 180px;
        height: 210px;
        object-fit: cover;
        border: 2px solid #006600;
        background: #fff;
        border-radius: 8px;
    }

    .id-info-columns {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 6px;
        padding: 5px 0;
    }

    .id-info-item {
        background: #e9ecef;
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        word-break: break-word;
    }

    .id-info-item span {
        font-weight: normal;
        color: #2c3e4e;
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px dashed #aaa;
    }

    .action-right {
        display: flex;
        gap: 8px;
    }

    @media (max-width: 992px) {
        .photo-badge {
            flex-direction: column;
        }

        .id-info-columns {
            grid-template-columns: 1fr;
        }

        .two-columns {
            flex-direction: column;
            gap: 0;
        }

        .action-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }

    @media print {
        .no-print {
            display: none !important;
        }

        .people-certificate-page {
            box-shadow: none;
        }
    }
</style>
@endpush

@section('content')
<section class="content cioas-page pt-5">
    <div class="container-fluid">
        <div class="cioas-shell">
            <div class="cioas-panel">
                <div class="cioas-panel-body">
                    <div class="people-certificate-page border-0 shadow-none">
    <div class="people-certificate-content">
        @php
            $fallbackHeaderUnion = \App\Models\Institute::with('union.thana.district')
                ->whereNotNull('union_id')
                ->first()?->union;

            $headerUnion = $ownerOrganization?->Union
                ?? $ownerOrganization?->institute?->union
                ?? $ownerUser?->addressInfo?->presentUnion
                ?? $ownerUser?->addressInfo?->permanentUnion
                ?? $ownerUser?->institute?->union
                ?? auth()->user()?->institute?->union
                ?? $fallbackHeaderUnion;

            $headerThana = $ownerOrganization?->Thana
                ?? $headerUnion?->thana
                ?? $ownerOrganization?->officeThana
                ?? $ownerUser?->addressInfo?->presentThana
                ?? $ownerUser?->addressInfo?->permanentThana
                ?? auth()->user()?->institute?->union?->thana
                ?? $fallbackHeaderUnion?->thana;

            $headerDistrict = $ownerOrganization?->District
                ?? $headerThana?->district
                ?? $ownerOrganization?->officeDistrict
                ?? $ownerUser?->addressInfo?->presentDistrict
                ?? $ownerUser?->addressInfo?->permanentDistrict
                ?? auth()->user()?->institute?->union?->thana?->district
                ?? $fallbackHeaderUnion?->thana?->district;

            $presentAddress = collect([
                $ownerUser?->addressInfo?->presentDistrict?->name ?? '',
                $ownerUser?->addressInfo?->presentThana?->name ?? '',
                $ownerUser?->addressInfo?->presentUnion?->name ?? '',
                $ownerUser?->addressInfo?->presentPostoffice?->bn_name ?? $ownerUser?->addressInfo?->presentPostoffice?->name ?? '',
                $ownerUser?->addressInfo?->presentVillage?->bn_name ?? $ownerUser?->addressInfo?->presentVillage?->en_name ?? '',
                $ownerUser?->addressInfo?->presentWard?->en_ward_no ?? '',
                $ownerUser?->addressInfo?->present_area ?? $ownerUser?->addressInfo?->present_area_bn ?? '',
                $ownerUser?->addressInfo?->presentRoad?->name ?? $ownerUser?->addressInfo?->present_road ?? '',
                $ownerUser?->addressInfo?->presentHouse?->house ?? $ownerUser?->addressInfo?->present_house ?? '',
            ])->filter()->implode(', ');

            $permanentAddress = collect([
                $ownerUser?->addressInfo?->permanentDistrict?->name ?? '',
                $ownerUser?->addressInfo?->permanentThana?->name ?? '',
                $ownerUser?->addressInfo?->permanentUnion?->name ?? '',
                $ownerUser?->addressInfo?->permanentPostOffice?->bn_name ?? $ownerUser?->addressInfo?->permanentPostOffice?->name ?? '',
                $ownerUser?->addressInfo?->permanentVillage?->bn_name ?? $ownerUser?->addressInfo?->permanentVillage?->en_name ?? '',
                $ownerUser?->addressInfo?->permanentWard?->en_ward_no ?? '',
                $ownerUser?->addressInfo?->permanent_area ?? $ownerUser?->addressInfo?->permanent_area_bn ?? '',
                $ownerUser?->addressInfo?->permanentRoad?->name ?? $ownerUser?->addressInfo?->permanent_road ?? '',
                $ownerUser?->addressInfo?->permanentHouse?->house ?? $ownerUser?->addressInfo?->permanent_house ?? '',
            ])->filter()->implode(', ');
        @endphp

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $headerDistrict?->bn_name ?? '' }}</div>
                <div class="union-title-en">{{ $headerDistrict?->name ?? '' }}</div>
                <p class="union-address">
                    জেলাঃ {{ $headerDistrict?->bn_name ?? $headerDistrict?->name ?? '' }},
                    বিভাগঃ {{ $headerDistrict?->Division?->bn_name ?? $headerDistrict?->Division?->name ?? '' }},
                    বাংলাদেশ।
                </p>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>

        <div class="citizen-title">
            <h4 class="mb-0">যানবাহনের তথ্য</h4>
            <h4>Vehicle Details</h4>
        </div>

        <div class="section-header">Vehicle Information</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">Vehicle ID :</span><span class="info-value">#{{ $vehicle->id }}</span></div>
                <div class="info-row"><span class="info-label">Registration No :</span><span class="info-value">{{ $vehicle->registration_no ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Vehicle Type :</span><span class="info-value">{{ $vehicle->vehicle_type ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Vehicle Category :</span><span class="info-value">{{ $vehicle->vehicle_category ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Vehicle Model :</span><span class="info-value">{{ $vehicle->vehicle_model ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Engine Number :</span><span class="info-value">{{ $vehicle->engine_number ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Chassis Number :</span><span class="info-value">{{ $vehicle->chassis_number ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Tyre Number :</span><span class="info-value">{{ $vehicle->tyre_number ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">HP/CC :</span><span class="info-value">{{ $vehicle->hp_cc ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Seat Capacity :</span><span class="info-value">{{ $vehicle->seat_capacity ?? '--' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Make Year :</span><span class="info-value">{{ $vehicle->make_year ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Make Company :</span><span class="info-value">{{ $vehicle->make_company ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Price :</span><span class="info-value">{{ isset($vehicle->price) ? number_format((float) $vehicle->price, 2) : '--' }}</span></div>
                <div class="info-row"><span class="info-label">Height :</span><span class="info-value">{{ $vehicle->height ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Width :</span><span class="info-value">{{ $vehicle->width ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Tyre Size :</span><span class="info-value">{{ $vehicle->tyre_size ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Color :</span><span class="info-value">{{ $vehicle->color ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Ownership Type :</span><span class="info-value">{{ $vehicle->ownership_type ? ucfirst($vehicle->ownership_type) : '--' }}</span></div>
            </div>
        </div>

        <div class="section-header">Certificates & Attachments</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">RC Attachment :</span><span class="info-value">{!! $vehicle->rc_attachment ? '<a href="'.asset('storage/'.$vehicle->rc_attachment).'" target="_blank">View RC</a>' : '--' !!}</span></div>
                <div class="info-row"><span class="info-label">RC Issue Date :</span><span class="info-value">{{ $vehicle->rc_issue_date ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">RC Validity Date :</span><span class="info-value">{{ $vehicle->rc_validity_date ?? '--' }}</span></div>
                <br>
                <div class="info-row"><span class="info-label">RP Attachment :</span><span class="info-value">{!! $vehicle->rp_attachment ? '<a href="'.asset('storage/'.$vehicle->rp_attachment).'" target="_blank">View RP</a>' : '--' !!}</span></div>
                <div class="info-row"><span class="info-label">RP Issue Date :</span><span class="info-value">{{ $vehicle->rp_issue_date ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">RP Validity Date :</span><span class="info-value">{{ $vehicle->rp_validity_date ?? '--' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">TT Attachment :</span><span class="info-value">{!! $vehicle->tt_attachment ? '<a href="'.asset('storage/'.$vehicle->tt_attachment).'" target="_blank">View TT</a>' : '--' !!}</span></div>
                <div class="info-row"><span class="info-label">TT Issue Date :</span><span class="info-value">{{ $vehicle->tt_issue_date ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">TT Validity Date :</span><span class="info-value">{{ $vehicle->tt_validity_date ?? '--' }}</span></div>
                <br>
                <div class="info-row"><span class="info-label">IN Attachment :</span><span class="info-value">{!! $vehicle->in_attachment ? '<a href="'.asset('storage/'.$vehicle->in_attachment).'" target="_blank">View IN</a>' : '--' !!}</span></div>
                <div class="info-row"><span class="info-label">IN Issue Date :</span><span class="info-value">{{ $vehicle->in_issue_date ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">IN Validity Date :</span><span class="info-value">{{ $vehicle->in_validity_date ?? '--' }}</span></div>
            </div>
        </div>

        @php
            $assignedDriver = null;
            if ($vehicle->driver_registration_no) {
                $staff = \App\Models\Staff::where('staff_id', $vehicle->driver_registration_no)->with('user')->first();
                if ($staff && $staff->user) {
                    $assignedDriver = $staff->user;
                } else {
                    $assignedDriver = \App\Models\User::where('system_id', $vehicle->driver_registration_no)->first();
                }
            }
        @endphp
        <div class="section-header">Assigned Driver</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">Registration No / System ID :</span><span class="info-value">{{ $vehicle->driver_registration_no ?? '--' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Driver Name :</span><span class="info-value">{{ $assignedDriver ? $assignedDriver->name : '--' }}</span></div>
                <div class="info-row"><span class="info-label">Driver Phone :</span><span class="info-value">{{ $assignedDriver ? $assignedDriver->mobile : '--' }}</span></div>
            </div>
        </div>

        <div class="section-header">Routes Allocated</div>
        <table class="table table-bordered table-sm" style="margin-top: 10px; margin-bottom: 20px;">
            <thead class="bg-light">
                <tr>
                    <th style="width: 50px;">Sl.</th>
                    <th>From Point</th>
                    <th>Middle Point</th>
                    <th>End Point</th>
                </tr>
            </thead>
            <tbody>
                @if($vehicle->routes && $vehicle->routes->count() > 0)
                    @foreach($vehicle->routes as $index => $route)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $route->from_point }}</td>
                        <td>{{ $route->middle_point ?? '--' }}</td>
                        <td>{{ $route->end_point }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No routes allocated</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="section-header mt-4">Repairing History</div>
        <table class="table table-bordered table-sm" style="margin-top: 10px; margin-bottom: 20px;">
            <thead class="bg-light">
                <tr>
                    <th style="width: 50px;">Sl.</th>
                    <th>Date</th>
                    <th>Workshop</th>
                    <th>Repair Type</th>
                    <th>Spare Parts</th>
                    <th>Cost</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @if($vehicle->repairings && $vehicle->repairings->count() > 0)
                    @foreach($vehicle->repairings as $index => $repair)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $repair->repair_date ? \Carbon\Carbon::parse($repair->repair_date)->format('d-m-Y') : '--' }}</td>
                        <td>{{ $repair->workshop_name ?? '--' }}</td>
                        <td>{{ $repair->repair_type ?? '--' }}</td>
                        <td>{{ $repair->spare_parts ?? '--' }}</td>
                        <td>{{ $repair->cost ?? '--' }}</td>
                        <td>{{ $repair->remarks ?? '--' }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No repairing history found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="section-header mt-4">Fuel History</div>
        <table class="table table-bordered table-sm" style="margin-top: 10px; margin-bottom: 20px;">
            <thead class="bg-light">
                <tr>
                    <th style="width: 50px;">Sl.</th>
                    <th>Date</th>
                    <th>Pump Name</th>
                    <th>Fuel Type</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Odometer Reading</th>
                </tr>
            </thead>
            <tbody>
                @if($vehicle->fuels && $vehicle->fuels->count() > 0)
                    @foreach($vehicle->fuels as $index => $fuel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $fuel->fuel_date ? \Carbon\Carbon::parse($fuel->fuel_date)->format('d-m-Y') : '--' }}</td>
                        <td>{{ $fuel->pump_name ?? '--' }}</td>
                        <td>{{ $fuel->fuel_type ?? '--' }}</td>
                        <td>{{ $fuel->quantity ?? '--' }}</td>
                        <td>{{ $fuel->total_cost ?? '--' }}</td>
                        <td>{{ $fuel->odometer_reading ?? '--' }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No fuel history found</td>
                    </tr>
                @endif
            </tbody>
        </table>


        <div class="action-row no-print">
            <div>
                <strong>Created:</strong> {{ $vehicle->created_at ? $vehicle->created_at->format('d-m-Y h:i A') : '--' }}
            </div>
            <div class="action-right">
                <a href="{{ route('vehicle.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-primary">Edit</a>
                <button type="button" class="btn btn-info" onclick="window.print()">Print</button>
                @if((int)($vehicle->status ?? 0) !== 1)
                    <button type="button" class="btn btn-success" id="approveVehicleBtn"><i class="fa fa-check"></i> Approve</button>
                @endif
            </div>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
$('#approveVehicleBtn').click(function () {
    if (confirm("Are you sure you want to approve this vehicle?")) {
        $.ajax({
            url: "{{ route('vehicle.approve') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $vehicle->id }}"
            },
            success: function (response) {
                if (response.status) {
                    alert(response.message || "Approved Successfully");
                    location.reload();
                } else {
                    alert(response.message || "Approval failed");
                }
            },
            error: function (xhr) {
                const message = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : "Something went wrong";
                alert(message);
            }
        });
    }
});
</script>
@endpush
