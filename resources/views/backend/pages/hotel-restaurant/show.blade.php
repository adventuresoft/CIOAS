@extends('backend.master', ['mainMenu' => 'HotelRestaurant', 'subMenu' => 'HotelRestaurantShow'])

@section('title', 'Hotel & Restaurant Details')

@push('style')
    <style>
        /* Section Title Styling */
        .section-title {
            font-size: 15px;
            font-weight: 800;
            color: #0f766e;
            background: linear-gradient(90deg, #eef7f5 0%, #ffffff 100%);
            padding: 8px 16px;
            border-left: 4px solid #0f766e;
            border-radius: 0 6px 6px 0;
            margin-top: 30px;
            margin-bottom: 18px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        /* Top Basic Info Panel */
        .photo-badge {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .photo-box {
            text-align: center;
            flex-shrink: 0;
        }

        .photo-box img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 3px solid #0f766e;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(15, 118, 110, 0.15);
        }

        .id-info-columns {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 18px;
        }

        .id-info-item {
            background: #f8fafc;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .id-info-item:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .id-info-item span {
            font-weight: normal;
            color: #333;
            font-size: 16px;
        }

        .id-info-item i {
            color: #0f766e;
            font-size: 15px;
            width: 20px;
            text-align: center;
        }

        /* Grid Layout */
        .two-columns {
            display: flex;
            gap: 30px;
            margin-top: 10px;
        }

        .col {
            flex: 1;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 13.5px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .info-label {
            width: 160px;
            font-weight: 700;
            font-size: 16px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-label i {
            color: #94a3b8;
            width: 16px;
        }

        .info-value {
            flex: 1;
            color: #0f172a;
            font-weight: 600;
        }

        /* Owner Card Design */
        .owner-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .owner-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        }

        .owner-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }

        .owner-header img {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border: 2px solid #0f766e;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(15, 118, 110, 0.15);
        }

        .owner-name {
            font-size: 16px;
            font-weight: 800;
            color: #0f766e;
        }

        /* Document Wrapper */
        .document-wrapper {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-top: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        @media print {

            /* Hide all icons when printing */
            i,
            .fas,
            .fa {
                display: none !important;
            }

            /* Hide all buttons and no-print elements when printing */
            button,
            .btn,
            .no-print {
                display: none !important;
            }

            /* Make background normal and flat */
            .photo-badge {
                background: transparent !important;
                border: none !important;
                padding: 0 !important;
                margin-bottom: 20px !important;
                box-shadow: none !important;
            }

            .id-info-item {
                background: transparent !important;
                border: none !important;
                padding: 4px 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
            }

            .id-info-item span {
                font-weight: bold !important;
                color: #000 !important;
            }

            .col {
                border: none !important;
                padding: 0 !important;
                box-shadow: none !important;
                background: transparent !important;
            }

            .info-row {
                border-bottom: 1px solid #e2e8f0 !important;
                padding-bottom: 4px !important;
                margin-bottom: 6px !important;
            }

            .owner-card {
                border: 1px solid #cbd5e1 !important;
                box-shadow: none !important;
                padding: 12px !important;
                background: transparent !important;
            }

            .owner-header img {
                border: 1px solid #cbd5e1 !important;
                box-shadow: none !important;
            }

            .document-wrapper {
                border: none !important;
                padding: 0 !important;
                box-shadow: none !important;
                background: transparent !important;
            }
        }
    </style>
@endpush

@section('content')
    <x-print-view title="হোটেল ও রেস্তোরাঁ তথ্য বিবরণী (Hotel/Restaurant Details)">



        {{-- Basic Organization Information --}}
        <div class="photo-badge">
            <div class="photo-box">
                <img src="{{ $organization->hotel_logo ? asset($organization->hotel_logo) : asset('uploads/no-image-found.png') }}"
                    alt="Organization Logo">
            </div>
            <div class="id-info-columns">
                <div class="id-info-item"><span>Name:</span> {{ $organization->name }}</div>
                <div class="id-info-item"><span>Name (Bangla):</span> {{ $organization->bn_name }}</div>
                <div class="id-info-item"><span>Category:</span> {{ $organization->category->en_name ?? 'N/A' }}</div>
                <div class="id-info-item"><span>Sub Category:</span> {{ $organization->subcategory->en_name ?? 'N/A' }}
                </div>
                <div class="id-info-item"><span>Type:</span> {{ $organization->ownershipType->en_name ?? 'N/A' }}</div>
                <div class="id-info-item"><span>Capital:</span> ৳ {{ number_format($organization->capital, 2) }}</div>
                <div class="id-info-item"><span>Est. Year:</span> {{ $organization->establish_year }}</div>
                @if ($organization->no_of_owner)
                    <div class="id-info-item"><span>Owners Count:</span> {{ $organization->no_of_owner }}</div>
                @endif
                @if ($organization->no_of_dir)
                    <div class="id-info-item"><span>Directors Count:</span> {{ $organization->no_of_dir }}</div>
                @endif
                <div class="id-info-item"><span>App Type:</span> {{ $organization->application_type }}</div>
                <div class="id-info-item" style="grid-column: span 2;"><span>RJSC Reg No:</span>
                    {{ $organization->rjsc_reg_no ?: 'N/A' }}</div>
            </div>
        </div>

        {{-- Addresses --}}
        <div class="address-section mb-4">
            <h4 class="section-title">Registered Address</h4>
            <div class="col">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row"><span class="info-label">Division:</span><span
                                class="info-value">{{ $organization->Division->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">District:</span><span
                                class="info-value">{{ $organization->District->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Thana:</span><span
                                class="info-value">{{ $organization->Thana->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Union:</span><span
                                class="info-value">{{ $organization->Union->name ?? 'N/A' }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row"><span class="info-label">Post Office:</span><span
                                class="info-value">{{ $organization->postOffice?->bn_name ?? ($organization->postOffice?->name ?? 'N/A') }}</span>
                        </div>
                        <div class="info-row"><span class="info-label">Village:</span><span
                                class="info-value">{{ $organization->Village->bn_name ?? ($organization->Village->name ?? 'N/A') }}</span>
                        </div>
                        <div class="info-row"><span class="info-label">Ward No:</span><span
                                class="info-value">{{ $organization->ward?->en_ward_no ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Road/House:</span><span
                                class="info-value">{{ $organization->road ?? 'N/A' }} @if($organization->house) (House:
                                {{ $organization->house }}) @endif</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="address-section mb-4">
            <h4 class="section-title">Corporate/Office Address</h4>
            <div class="col">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row"><span class="info-label">Division:</span><span
                                class="info-value">{{ $organization->officeDivision?->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">District:</span><span
                                class="info-value">{{ $organization->officeDistrict?->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Thana:</span><span
                                class="info-value">{{ $organization->officeThana?->name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Post Office:</span><span
                                class="info-value">{{ $organization->officePostOffice?->bn_name ?? ($organization->officePostOffice?->name ?? 'N/A') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row"><span class="info-label">Village:</span><span
                                class="info-value">{{ $organization->officeVillage?->bn_name ?? ($organization->officeVillage?->name ?? 'N/A') }}</span>
                        </div>
                        <div class="info-row"><span class="info-label">Ward No:</span><span
                                class="info-value">{{ $organization->officeWard?->en_ward_no ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label">Road/House:</span><span
                                class="info-value">{{ $organization->office_road ?? 'N/A' }}
                                @if($organization->office_house) (House: {{ $organization->office_house }}) @endif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Owners / Directors --}}
        <h4 class="section-title">Owners & Directors</h4>
        <div class="row">
            @foreach ($organization->ownership as $ownership)
                <div class="col-md-6">
                    <div class="owner-card">
                        <div class="owner-header">
                            <img src="{{ $ownership->image ? asset($ownership->image) : asset('no-image-found.jpeg') }}"
                                alt="Owner Image">
                            <div>
                                <div class="owner-name">{{ $ownership->name ?? 'Owner/Director' }}</div>
                                <div style="font-size: 13px; color: #333; font-weight: 600;">NID: {{ $ownership->nid ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        <div class="info-row"><span class="info-label" style="width: 140px;">Father's Name:</span><span
                                class="info-value">{{ $ownership->father_name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label" style="width: 140px;">Mother's Name:</span><span
                                class="info-value">{{ $ownership->mother_name ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label" style="width: 140px;">Mobile:</span><span
                                class="info-value">{{ $ownership->mobile ?? 'N/A' }}</span></div>
                        <div class="info-row"><span class="info-label" style="width: 140px;">Email:</span><span
                                class="info-value">{{ $ownership->email ?? 'N/A' }}</span></div>
                        <div class="info-row">
                            <span class="info-label" style="width: 140px;">Present:</span>
                            <span class="info-value" style="font-size: 12.5px; font-weight: normal; color: #475569;">
                                {{ $ownership->present_house ?? '' }} {{ $ownership->present_road ?? '' }}
                                {{ $ownership->presentVillage?->name ?? '' }}
                                {{ $ownership->presentWard?->en_ward_no ? 'Ward-' . $ownership->presentWard->en_ward_no : '' }}
                                {{ $ownership->presentPostOffice?->name ?? '' }} {{ $ownership->presentThana?->name ?? '' }}
                                {{ $ownership->presentDistrict?->name ?? '' }}
                            </span>
                        </div>
                        <div class="info-row" style="border: none; padding-bottom: 0; margin-bottom: 0;">
                            <span class="info-label" style="width: 140px;">Permanent:</span>
                            <span class="info-value" style="font-size: 12.5px; font-weight: normal; color: #475569;">
                                {{ $ownership->permanent_house ?? '' }} {{ $ownership->permanent_road ?? '' }}
                                {{ $ownership->permanentVillage?->name ?? '' }}
                                {{ $ownership->permanentWard?->en_ward_no ? 'Ward-' . $ownership->permanentWard->en_ward_no : '' }}
                                {{ $ownership->permanentPostOffice?->name ?? '' }} {{ $ownership->permanentThana?->name ?? '' }}
                                {{ $ownership->permanentDistrict?->name ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Premises Documents --}}
        @if ($organization->premises_ownership == 'owned')
            <h4 class="section-title">Self-Owned Premises Documents</h4>
            <div class="document-wrapper">
                @php
                    $files = json_decode($organization->document_files) ?: [];
                @endphp
                @foreach ($files as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    @endphp
                    <div class="mb-3">
                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <a href="{{ asset($file) }}" target="_blank" class="d-inline-block mb-1">
                                <img src="{{ asset($file) }}"
                                    style="max-width: 250px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px rgba(0,0,0,0.05);"
                                    alt="Premises Doc">
                            </a>
                            <div><a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1"><i
                                        class="fa fa-external-link-alt"></i> View Full Image</a></div>
                        @elseif($ext == 'pdf')
                            <iframe src="{{ asset($file) }}" width="100%" height="450px"
                                style="border: 1px solid #e2e8f0; border-radius: 8px;"></iframe>
                            <div class="mt-2"><a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i
                                        class="fa fa-file-pdf"></i> Open PDF in new tab</a></div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        @if ($organization->premises_ownership == 'rented')
            <h4 class="section-title">Rented Premises Documents</h4>
            <div class="document-wrapper">
                @php
                    $files = json_decode($organization->document_files) ?: [];
                @endphp
                @foreach ($files as $file)
                    @php
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    @endphp
                    <div class="mb-3">
                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <a href="{{ asset($file) }}" target="_blank" class="d-inline-block mb-1">
                                <img src="{{ asset($file) }}"
                                    style="max-width: 250px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px rgba(0,0,0,0.05);"
                                    alt="Premises Doc">
                            </a>
                            <div><a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1"><i
                                        class="fa fa-external-link-alt"></i> View Full Image</a></div>
                        @elseif($ext == 'pdf')
                            <iframe src="{{ asset($file) }}" width="100%" height="450px"
                                style="border: 1px solid #e2e8f0; border-radius: 8px;"></iframe>
                            <div class="mt-2"><a href="{{ asset($file) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i
                                        class="fa fa-file-pdf"></i> Open PDF in new tab</a></div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </x-print-view>

    <!-- Professional Floating/Bottom Action Bar -->
    <div class="no-print mt-4 mb-5">
        <div class="d-flex justify-content-between align-items-center" style="background: #ffffff; padding: 16px 24px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);">
            <!-- Status Badge -->
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary" style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Status</span>
                @if ($organization->status == 1)
                    <span class="badge" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 20px; font-weight: 700; font-size: 13px; padding: 8px 16px;">
                        <i class="fas fa-check-circle mr-1"></i> Approved
                    </span>
                @else
                    <span class="badge" style="background: #fffbeb; color: #d97706; border: 1px solid #fde68a; border-radius: 20px; font-weight: 700; font-size: 13px; padding: 8px 16px;">
                        <i class="fas fa-clock mr-1"></i> Pending Review
                    </span>
                @endif
            </div>
            
            <!-- Actions -->
            <div class="d-flex gap-2">
                <a href="{{ route('hotel-restaurant.index') }}" class="btn btn-light" style="font-weight: 600; border-radius: 8px; padding: 10px 20px; color: #475569; border: 1px solid #cbd5e1; transition: all 0.2s;">
                    <i class="fa fa-arrow-left mr-1"></i> Back to List
                </a>
                
                <button type="button" onclick="window.print()" class="btn" style="font-weight: 600; border-radius: 8px; padding: 10px 20px; background: #f8fafc; color: #0ea5e9; border: 1px solid #bae6fd; transition: all 0.2s;">
                    <i class="fas fa-print mr-1"></i> Printout
                </button>
                
                @if ($organization->status == 0)
                    <a href="{{ route('hotel-restaurant.edit', $organization->id) }}" class="btn" style="font-weight: 600; border-radius: 8px; padding: 10px 20px; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; transition: all 0.2s;">
                        <i class="fa fa-edit mr-1"></i> Edit
                    </a>
                @endif
                
                @if ($organization->status != 1)
                    <button class="btn btn-success" id="approveBtn" style="font-weight: 600; border-radius: 8px; padding: 10px 24px; background: #0f766e; border: none; box-shadow: 0 4px 6px rgba(15, 118, 110, 0.2); transition: all 0.2s;">
                        <i class="fa fa-check mr-1"></i> Approve
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#approveBtn').click(function () {
                Swal.fire({
                    title: 'Approve Organization?',
                    text: "Are you sure you want to approve this organization?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0f766e',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'Yes, Approve!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('hotel-restaurant.approve') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $organization->id }}"
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Approved Successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#0f766e'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function () {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    icon: 'error',
                                    confirmButtonColor: '#0f766e'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
