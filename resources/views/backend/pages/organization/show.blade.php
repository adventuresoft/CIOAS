@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'OrganizationShow'])

@section('title', 'Organization View')

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
        width: 200px;
        font-weight: bold;
        color: #2c3e4e;
    }

    .info-value {
        flex: 1;
        color: #1e2a36;
    }

    .nested-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px 20px;
        margin-top: 5px;
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
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 2px solid #006600;
        background: #fff;
        border-radius: 8px;
    }

    .id-info-columns {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 4px 6px;
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

    .two-columns {
        display: flex;
        gap: 30px;
        margin-top: 10px;
    }

    .col {
        flex: 1;
    }

.owner-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

.owner-card {
        background: #f8f9fc;
        padding: 14px;
        border-radius: 10px;
        border: 1px solid #d9e1e8;
    }

    .owner-serial-title {
        background: #006600;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        border-radius: 6px;
        padding: 6px 12px;
        margin-bottom: 12px;
        letter-spacing: .4px;
    }

    .owner-top {

        display: flex;
        gap: 16px;
        align-items: stretch;
        margin-bottom: 10px;
    }

     .owner-photo {
        width: 210px;
        min-width: 210px;
    }
    .owner-photo img {
        width: 100%;
        height: 250px;
        object-fit: cover;
       border: 3px solid #0a7a2c;
        border-radius: 12px;
        background: #fff;
    }

   .owner-pill-list {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
    }
     .owner-pill {
        background: #d8dde3;
        border-radius: 28px;
        padding: 10px 16px;
        color: #243447;
        font-size: 16px;
        line-height: 1.3;
        word-break: break-word;
    }

    .owner-pill span {
        font-weight: 500;
    }

       .owner-pill strong {
        font-weight: 700;
        color: #1d252d;
    }

    @media (max-width: 992px) {
        .owner-top {
            flex-direction: column;
        }

        .owner-photo {
            width: 100%;
            min-width: 100%;
        }
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px dashed #aaa;
    }
</style>
@endpush

@section('content')
<div class="people-certificate-page">
    <div class="people-certificate-content">
        @php
            $headerUnion = $organization->Union ?? $organization->institute?->union;
            $headerThana = $organization->Thana ?? $headerUnion?->thana ?? $organization->officeThana;
            $headerDistrict = $organization->District ?? $headerThana?->district ?? $organization->officeDistrict;
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
            <h4 class="mb-0">প্রতিষ্ঠানের তথ্য</h4>
            <h4>Organization Details</h4>
        </div>

        <div class="photo-badge">
            <div class="photo-box">
                <img src="{{ $organization->logo ? asset($organization->logo) : asset('public/no-image-found.jpeg') }}" alt="Organization Logo">
            </div>
            <div class="id-info-columns">
                <div class="id-info-item"><span>Name :</span> {{ $organization->name }}</div>
                <div class="id-info-item"><span>Name (Bangla) :</span> {{ $organization->bn_name }}</div>
                <div class="id-info-item"><span>Category :</span> {{ $organization->category->en_name ?? '' }}</div>
                <div class="id-info-item"><span>Sub Category :</span> {{ $organization->subcategory->en_name ?? '' }}</div>
                <div class="id-info-item"><span>Type :</span> {{ $organization->type->en_name ?? '' }}</div>
                <div class="id-info-item"><span>Capital :</span> {{ $organization->capital }}</div>
                <div class="id-info-item"><span>Est. Year :</span> {{ $organization->establishment_year }}</div>
                <div class="id-info-item"><span>work area :</span> {{ $organization->work_area }}</div>
                <div class="id-info-item"><span>Application type :</span> {{ $organization->application_type }}</div>
                <div class="id-info-item"><span>RJSC Registration No :</span> {{ $organization->rjsc_registration_no }}</div>
            </div>
        </div>



        <div class="section-header">Registered Address</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">Division :</span><span class="info-value">{{ $organization->Division->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">District :</span><span class="info-value">{{ $organization->District->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Thana :</span><span class="info-value">{{ $organization->Thana->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Post Office :</span><span class="info-value">{{ $organization->postOffice?->bn_name ?? $organization->postOffice?->name ?? '' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Union :</span><span class="info-value">{{ $organization->Union->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Village :</span><span class="info-value">{{ $organization->Village->bn_name ?? $organization->Village->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Ward :</span><span class="info-value">{{ $organization->ward?->en_ward_no ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Road :</span><span class="info-value">{{ $organization->road ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">House :</span><span class="info-value">{{ $organization->house ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">House (Bangla) :</span><span class="info-value">{{ $organization->house_bn ?? '' }}</span></div>
            </div>
        </div>

        <div class="section-header">Corporate/Office Address</div>
        <div class="two-columns">
            <div class="col">
                <div class="info-row"><span class="info-label">Division :</span><span class="info-value">{{ $organization->officeDivision?->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">District :</span><span class="info-value">{{ $organization->officeDistrict?->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Thana :</span><span class="info-value">{{ $organization->officeThana?->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Post Office :</span><span class="info-value">{{ $organization->officePostOffice?->bn_name ?? $organization->officePostOffice?->name ?? '' }}</span></div>
            </div>
            <div class="col">
                <div class="info-row"><span class="info-label">Village :</span><span class="info-value">{{ $organization->officeVillage?->bn_name ?? $organization->officeVillage?->name ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Ward :</span><span class="info-value">{{ $organization->officeWard?->en_ward_no ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">Road :</span><span class="info-value">{{ $organization->office_road ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">House :</span><span class="info-value">{{ $organization->office_house ?? '' }}</span></div>
                <div class="info-row"><span class="info-label">House (Bangla) :</span><span class="info-value">{{ $organization->office_house_bn ?? '' }}</span></div>
            </div>
        </div>

        <div class="section-header">Premises Ownership</div>
        <div class="info-row"><span class="info-label">Ownership :</span><span class="info-value">{{ $organization->premises_ownership ? ucfirst($organization->premises_ownership) : '' }}</span></div>

        <div class="section-header">Organization Owners</div>
          <div class="owner-list"></div>
            @forelse($organization->ownership ?? [] as $owner)

                            @php
                    $presentAddress = collect([
                        $owner->user?->addressInfo?->presentPostoffice?->name ?? '',
                        $owner->user?->addressInfo?->presentVillage?->en_name ?? '',
                        $owner->user?->addressInfo?->present_area ?? ($owner->user?->addressInfo?->present_area_bn ?? ''),
                        $owner->user?->addressInfo?->present_road ?? '',
                        $owner->user?->addressInfo?->present_house ?? ''
                    ])->filter()->implode(', ');

                    $permanentAddress = collect([
                        $owner->user?->addressInfo?->permanentDistrict?->name ?? '',
                        $owner->user?->addressInfo?->permanentThana?->name ?? '',
                        $owner->user?->addressInfo?->permanentPostOffice?->name ?? '',
                        $owner->user?->addressInfo?->permanentVillage?->en_name ?? '',
                        $owner->user?->addressInfo?->permanent_area ?? ($owner->user?->addressInfo?->permanent_area_bn ?? ''),
                        $owner->user?->addressInfo?->permanent_road ?? '',
                        $owner->user?->addressInfo?->permanent_house ?? ''
                    ])->filter()->implode(', ');

                    $maritalStatus = family_constant_option('marital_status')[$owner->user?->familyInfo?->marital_status ?? ''] ?? '-';
                @endphp
                <div class="owner-card">
                    <div class="owner-serial-title">Owner {{ $loop->iteration }} information</div>

                    <div class="owner-top">
                        <div class="owner-photo">
                            <img src="{{ $owner->user?->image ? asset($owner->user->image) : asset('public/no-image-found.jpeg') }}" alt="Owner Photo" onerror="this.src='{{ asset('public/no-image-found.jpeg') }}'">

                        </div>
                         <div class="owner-pill-list">
                            <div class="owner-pill"><span>Name :</span> <strong>{{ $owner->user?->name ?? $owner->user_name ?? '-' }}</strong></div>
                            <div class="owner-pill"><span>Name (Bangla) :</span> <strong>{{ $owner->user?->people?->bn_name ?? '-' }}</strong></div>
                            <div class="owner-pill"><span>Reg. People ID :</span> <strong>{{ $owner->user?->system_id ?? '-' }}</strong></div>
                            <div class="owner-pill"><span>NID :</span> <strong>{{ $owner->user?->nid ?? '-' }}</strong></div>
                            <div class="owner-pill"><span>Mobile :</span> <strong>{{ $owner->user?->mobile ?? '-' }}</strong></div>


                        </div>
                    </div>
                       <div class="info-row"><span class="info-label">Owner Role :</span><span class="info-value">{{ $owner->designation ?? 'Owner' }}</span></div>
                    <div class="info-row"><span class="info-label">Father Name :</span><span class="info-value">{{ $owner->user?->familyInfo?->father_name ?? '-' }}</span></div>
                    <div class="info-row"><span class="info-label">Mother Name :</span><span class="info-value">{{ $owner->user?->familyInfo?->mother_name ?? '-' }}</span></div>
                    <div class="info-row"><span class="info-label">Phone :</span><span class="info-value">{{ $owner->user?->mobile ?? '-' }}</span></div>
                    <div class="info-row"><span class="info-label">Email :</span><span class="info-value">{{ $owner->user?->email ?? '-' }}</span></div>
                      <div class="info-row"><span class="info-label">Present Address :</span><span class="info-value">{{ $presentAddress ?: '-' }}</span></div>
                    <div class="info-row"><span class="info-label">Permanent Address :</span><span class="info-value">{{ $permanentAddress ?: '-' }}</span></div>

                </div>
            @empty
                <div class="text-center text-muted">No owners found</div>
            @endforelse
        </div>

        <div class="action-row">
            <div>
                <strong>Status:</strong>
                @if($organization->status == 1)
                    <span class="badge badge-success">Approved</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </div>
            <div>
                <a href="{{route('organization.index')}}" class="btn btn-secondary">Back</a>
                @if($organization->status == 0)
                    <a href="{{ route('organization.edit', $organization->id) }}" class="btn btn-primary">Edit</a>
                @endif
                <button type="button" class="btn btn-info" onclick="window.print()">Print</button>
                @if($organization->status != 1)
                    <button class="btn btn-success" id="approveBtn">✔ Approve</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
$('#approveBtn').click(function(){

    if(confirm("Are you sure you want to approve this organization?")){

        $.ajax({
            url: "{{ route('organization.approve') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $organization->id }}"
            },
            success: function(response){
                alert("Approved Successfully");
                location.reload();
            },
            error: function(){
                alert("Something went wrong");
            }
        });

    }

});
</script>

@endpush
