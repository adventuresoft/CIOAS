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
<div class="people-certificate-page">
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
                <div class="union-title-bn">{{ $headerUnion?->bn_name ?? '' }}</div>
                <div class="union-title-en">{{ $headerUnion?->name ?? '' }}</div>
                <p class="union-address">
                    থানাঃ {{ $headerThana?->bn_name ?? $headerThana?->name ?? '' }},
                    জেলাঃ {{ $headerDistrict?->bn_name ?? $headerDistrict?->name ?? '' }},
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

        <div class="section-header">Owner Info</div>

        @if($vehicle->ownership_type === 'personal')
            @if($ownerUser)
                <div class="photo-badge">
                    <div class="photo-box">
                        <img src="{{ $ownerUser->image ? asset($ownerUser->image) : asset('public/no-image-found.jpeg') }}" alt="Owner Photo" onerror="this.src='{{ asset('public/no-image-found.jpeg') }}'">
                    </div>
                    <div class="id-info-columns">
                        <div class="id-info-item"><span>Name (Bangla) :</span> {{ $ownerUser->people?->bn_name ?? '-' }}</div>
                        <div class="id-info-item"><span>Name (English) :</span> {{ $ownerUser->name ?? '-' }}</div>
                        <div class="id-info-item"><span>NID :</span> {{ $ownerUser->nid ?? '-' }}</div>
                        <div class="id-info-item"><span>ID :</span> {{ $ownerUser->system_id ?? $ownerUser->id ?? '-' }}</div>
                        <div class="id-info-item"><span>Phone :</span> {{ $ownerUser->mobile ?? '-' }}</div>
                        <div class="id-info-item"><span>Email :</span> {{ $ownerUser->email ?? '-' }}</div>

                    </div>
                </div>

                <div class="info-row"><span class="info-label">Owner ID (Input) :</span><span class="info-value">{{ $vehicle->owner_id ?? '--' }}</span></div>
                <div class="info-row"><span class="info-label">Father Name :</span><span class="info-value">{{ $ownerUser->familyInfo?->father_name ?? '-' }}</span></div>
                <div class="info-row"><span class="info-label">Mother Name :</span><span class="info-value">{{ $ownerUser->familyInfo?->mother_name ?? '-' }}</span></div>
                <div class="info-row"><span class="info-label">Present Address :</span><span class="info-value">{{ $presentAddress ?: '-' }}</span></div>
                <div class="info-row"><span class="info-label">Permanent Address :</span><span class="info-value">{{ $permanentAddress ?: '-' }}</span></div>
            @else
                <div class="info-row"><span class="info-label">Owner ID :</span><span class="info-value">{{ $vehicle->owner_id ?? '--' }}</span></div>
                <div class="alert alert-warning mb-0">Owner details were not found for this ID.</div>
            @endif
        @else
            <div class="info-row"><span class="info-label">Owner ID :</span><span class="info-value">{{ $vehicle->owner_id ?? '--' }}</span></div>
            <div class="info-row"><span class="info-label">Institutional Name :</span><span class="info-value">{{ $vehicle->institutional_name ?? '--' }}</span></div>
            <div class="info-row"><span class="info-label">Trade License :</span><span class="info-value">{{ $vehicle->trade_license ?? '--' }}</span></div>
            <div class="info-row"><span class="info-label">Institutional Address :</span><span class="info-value">{{ $vehicle->institutional_address ?? '--' }}</span></div>
        @endif

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
