@extends('backend.master', ['mainMenu' => 'HotelRestaurant', 'subMenu' => 'HotelRestaurantShow'])

@section('title', 'Hotel Restaurant View')

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
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
            background: #e9ecef;
            color: #343434;
            font-weight: 600;
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
            padding: 5px;
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
                $headerThana = $organization->Thana ?? ($headerUnion?->thana ?? $organization->officeThana);
                $headerDistrict = $organization->District ?? ($headerThana?->district ?? $organization->officeDistrict);
            @endphp
            <div class="header-logos">
                <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
                <div class="union-header">
                    <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                    <div class="union-title-bn">{{ $headerDistrict?->bn_name ?? '' }} জেলা পরিষদ</div>
                    <div class="union-title-en">{{ $headerDistrict?->bn_name ?? '' }}</div>
                    <p class="union-address">
                        থানাঃ {{ $headerThana?->bn_name ?? ($headerThana?->name ?? '') }},
                        জেলাঃ {{ $headerDistrict?->bn_name ?? ($headerDistrict?->name ?? '') }},
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
                    <img src="{{ $organization->hotel_logo ? asset($organization->hotel_logo) : asset('uploads/no-image-found.png') }}"
                        alt="Organization Logo">
                </div>
                <div class="id-info-columns">
                    <div class="id-info-item"><span>Name :</span> {{ $organization->name }}</div>
                    <div class="id-info-item"><span>Name (Bangla) :</span> {{ $organization->bn_name }}</div>
                    <div class="id-info-item"><span>Category :</span> {{ $organization->category->en_name ?? '' }}</div>
                    <div class="id-info-item"><span>Sub Category :</span> {{ $organization->subcategory->en_name ?? '' }}
                    </div>
                    <div class="id-info-item"><span>Type :</span> {{ $organization->ownershipType->en_name ?? '' }}</div>
                    <div class="id-info-item"><span>Capital :</span> ৳ {{ $organization->capital }}</div>
                    <div class="id-info-item"><span>Est. Year :</span> {{ $organization->establish_year }}</div>
                    @if ($organization->no_of_owner)
                        <div class="id-info-item"><span>Number of Owner :</span> {{ $organization->no_of_owner }}</div>
                    @endif
                    @if ($organization->no_of_dir)
                        <div class="id-info-item"><span>Number of Directors :</span> {{ $organization->no_of_dir }}</div>
                    @endif
                    <div class="id-info-item"><span>Application type :</span> {{ $organization->application_type }}</div>
                    <div class="id-info-item"><span>RJSC Registration No :</span> {{ $organization->rjsc_reg_no }}
                    </div>
                </div>
            </div>



            <div class="section-header">Registered Address</div>
            <div class="two-columns">
                <div class="col">
                    <div class="info-row"><span class="info-label">Division :</span><span
                            class="info-value">{{ $organization->Division->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">District :</span><span
                            class="info-value">{{ $organization->District->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Thana :</span><span
                            class="info-value">{{ $organization->Thana->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Post Office :</span><span
                            class="info-value">{{ $organization->postOffice?->bn_name ?? ($organization->postOffice?->name ?? '') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="info-row"><span class="info-label">Union :</span><span
                            class="info-value">{{ $organization->Union->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Village :</span><span
                            class="info-value">{{ $organization->Village->bn_name ?? ($organization->Village->name ?? '') }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Ward :</span><span
                            class="info-value">{{ $organization->ward?->en_ward_no ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Road :</span><span
                            class="info-value">{{ $organization->road ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">House :</span><span
                            class="info-value">{{ $organization->house ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">House (Bangla) :</span><span
                            class="info-value">{{ $organization->house_bn ?? '' }}</span></div>
                </div>
            </div>

            <div class="section-header">Corporate/Office Address</div>
            <div class="two-columns">
                <div class="col">
                    <div class="info-row"><span class="info-label">Division :</span><span
                            class="info-value">{{ $organization->officeDivision?->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">District :</span><span
                            class="info-value">{{ $organization->officeDistrict?->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Thana :</span><span
                            class="info-value">{{ $organization->officeThana?->name ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Post Office :</span><span
                            class="info-value">{{ $organization->officePostOffice?->bn_name ?? ($organization->officePostOffice?->name ?? '') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="info-row"><span class="info-label">Village :</span><span
                            class="info-value">{{ $organization->officeVillage?->bn_name ?? ($organization->officeVillage?->name ?? '') }}</span>
                    </div>
                    <div class="info-row"><span class="info-label">Ward :</span><span
                            class="info-value">{{ $organization->officeWard?->en_ward_no ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">Road :</span><span
                            class="info-value">{{ $organization->office_road ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">House :</span><span
                            class="info-value">{{ $organization->office_house ?? '' }}</span></div>
                    <div class="info-row"><span class="info-label">House (Bangla) :</span><span
                            class="info-value">{{ $organization->office_house_bn ?? '' }}</span></div>
                </div>
            </div>

            <div class="section-header">Hotel & Restaurant Owners/Directors</div>

            <div class="row">
                @foreach ($organization->ownership as $ownership)
                    <div class="col-md-6">
                        <div class="card border shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $ownership->image ? asset($ownership->image) : asset('no-image-found.jpeg') }}"
                                        class="rounded mr-3" width="60" height="60">
                                </div>

                                <div class="row mb-1">
                                    <div class="col-5 font-weight-bold">Father Name:</div>
                                    <div class="col-7">{{ $ownership->father_name ?? '-' }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-5 font-weight-bold">Mother Name:</div>
                                    <div class="col-7">{{ $ownership->mother_name ?? '-' }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-5 font-weight-bold">Phone:</div>
                                    <div class="col-7">{{ $ownership->mobile ?? '-' }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-5 font-weight-bold">Email:</div>
                                    <div class="col-7">{{ $ownership->email ?? '-' }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-5 font-weight-bold">NID:</div>
                                    <div class="col-7">{{ $ownership->nid ?? '-' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-5 font-weight-bold">Present Address:</div>
                                    <div class="col-7">
                                        {{ $ownership->present_house ?? '-' }}
                                        {{ $ownership->present_road ?? '-' }}
                                        {{ $ownership->presentVillage?->name ?? '-' }}
                                        {{ $ownership->presentWard?->en_ward_no ?? '-' }}
                                        {{ $ownership->presentPostOffice?->name ?? '-' }}
                                        {{ $ownership->presentThana?->name ?? '-' }}
                                        {{ $ownership->presentDistrict?->name ?? '-' }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5 font-weight-bold">Permanent Address:</div>
                                    <div class="col-7">
                                        {{ $ownership->permanent_house ?? '-' }}
                                        {{ $ownership->permanent_road ?? '-' }}
                                        {{ $ownership->permanentVillage?->name ?? '-' }}
                                        {{ $ownership->permanentWard?->en_ward_no ?? '-' }}
                                        {{ $ownership->permanentPostOffice?->name ?? '-' }}
                                        {{ $ownership->permanentThana?->name ?? '-' }}
                                        {{ $ownership->permanentDistrict?->name ?? '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>



            <div class="section-header">Self-Owned Premises Documents
                {{ $organization->premises_ownership == 'owned' ? '(Documents Attached)' : null }}</div>
            <div class="info-row docs_files_row">
                @if ($organization->premises_ownership == 'owned')

                    <h5>Attached Documents</h5>

                    @php
                        $files = json_decode($organization->document_files);

                    @endphp
                    @foreach ($files as $file)
                        @php
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        @endphp

                        <div class="mb-3">
                            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <!-- Image -->
                                <img src="{{ asset($file) }}" width="200" alt="Image">
                                <br>
                                <a href="{{ asset($file) }}" target="_blank">View Image</a>
                            @elseif($ext == 'pdf')
                                <!-- PDF -->
                                <iframe src="{{ asset($file) }}" width="100%" height="400px"></iframe>

                                <!-- Optional PDF link -->
                                <br>
                                <a href="{{ asset($file) }}" target="_blank">View PDF</a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="section-header">Rented Premises Documents
                {{ $organization->premises_ownership == 'rented' ? '(Documents Attached)' : null }}</div>
            <div class="info-row docs_files_row">
                @if ($organization->premises_ownership == 'rented')

                    @php
                        $files = json_decode($organization->document_files);

                    @endphp
                    @foreach ($files as $file)
                        @php
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        @endphp

                        <div class="mb-3 pl-2">
                            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <!-- Image -->
                                <a href="{{ asset($file) }}" target="_blank">
                                    <img src="{{ asset($file) }}" width="200" alt="Image">
                                </a>
                            @elseif($ext == 'pdf')
                                <!-- PDF -->
                                <a href="{{ asset($file) }}" target="_blank">
                                    <iframe src="{{ asset($file) }}" width="100%" height="400px"></iframe>
                                </a>
                                <!-- Optional PDF link -->
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="action-row">
            <div>
                <strong>Status:</strong>
                @if ($organization->status == 1)
                    <span class="badge badge-success">Approved</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </div>
            <div>
                <a href="{{ route('hotel-restaurant.index') }}" class="btn btn-secondary">Back</a>
                @if ($organization->status == 0)
                    <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="btn btn-primary">Edit</a>
                @endif
                <button type="button" class="btn btn-info" id="print_out">Print</button>
                @if ($organization->status != 1)
                    <button class="btn btn-success" id="approveBtn">✔ Approve</button>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script>
        $("#print_out").click(function(e) {
            e.preventDefault();

            $('.docs_files_row').hide();
            $('.action-row').hide();

            window.print();

            setTimeout(() => {
                $('.docs_files_row').show();
                $('.action-row').show();
            }, 1000);

        });

        $('#approveBtn').click(function() {

            if (confirm("Are you sure you want to approve this organization?")) {

                $.ajax({
                    url: "{{ route('hotel-restaurant.approve') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: "{{ $organization->id }}"
                    },
                    success: function(response) {
                        alert("Approved Successfully");
                        location.reload();
                    },
                    error: function() {
                        alert("Something went wrong");
                    }
                });

            }

        });
    </script>
@endpush
