@extends('frontend.master')

@section('title', 'নাগরিক ড্যাশবোর্ড (Citizen Dashboard)')

@push('style')
<style>
    .dashboard-header-bg {
        background: linear-gradient(135deg, #006a4e 0%, #004d38 100%);
        color: white;
    }
    .stat-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #e2e8f0;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 20px;
    }
    .quick-action-link {
        transition: all 0.2s ease;
    }
    .quick-action-link:hover {
        background-color: #f0fdf4;
        border-color: #bbf7d0 !important;
        transform: translateX(5px);
    }
    .quick-action-link:hover i.fa-chevron-right {
        color: #16a34a !important;
    }
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }
    .badge-pending { background-color: #fef3c7; color: #d97706; }
    .badge-approved { background-color: #dcfce7; color: #16a34a; }
    .badge-repaired { background-color: #e0f2fe; color: #0284c7; }
    .badge-rejected { background-color: #fee2e2; color: #dc2626; }
</style>
@endpush

@section('content')
<div class="container py-4 py-md-5">

    <!-- Welcome Header Banner -->
    <div class="dashboard-header-bg rounded-4 p-4 p-md-5 shadow-sm mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div>
            <h2 class="fw-bold mb-1">স্বাগতম, {{ $user->name }}!</h2>
            <p class="text-white-50 mb-0 fs-content">আপনার নাগরিক ড্যাশবোর্ড থেকে সহজেই আবেদন এবং অ্যাপয়েন্টমেন্ট ট্র্যাকিং করুন।</p>
        </div>
        <div class="d-flex align-items-center gap-3 bg-white bg-opacity-10 px-4 py-3 rounded-3" style="backdrop-filter: blur(8px);">
            <i class="fas fa-calendar-check fs-3 text-warning"></i>
            <div>
                <p class="mb-0 text-white-50" style="font-size: 13px;">আজকের তারিখ</p>
                <p class="mb-0 fw-bold fs-content">{{ now()->format('d M, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards Grid -->
    <div class="row g-3 mb-4">
        <!-- Total Apps -->
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 h-100 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 11px;">মোট আবেদন</p>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalApps }}</h3>
                </div>
                <div class="stat-icon bg-light text-secondary">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
        <!-- Approved Apps -->
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 h-100 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 11px;">অনুমোদিত আবেদন</p>
                    <h3 class="fw-bold text-success mb-0">{{ $approvedApps }}</h3>
                </div>
                <div class="stat-icon text-success" style="background-color: #dcfce7;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <!-- Pending Apps -->
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 h-100 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 11px;">পেন্ডিং আবেদন</p>
                    <h3 class="fw-bold text-warning mb-0">{{ $pendingApps }}</h3>
                </div>
                <div class="stat-icon text-warning" style="background-color: #fef3c7;">
                    <i class="fas fa-history"></i>
                </div>
            </div>
        </div>
        <!-- Total Bookings -->
        <div class="col-6 col-md-3">
            <div class="stat-card bg-white p-3 rounded-4 h-100 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-bold text-uppercase mb-1" style="font-size: 11px;">অ্যাপয়েন্টমেন্ট বুকিং</p>
                    <h3 class="fw-bold text-primary mb-0">{{ $totalBookings }}</h3>
                </div>
                <div class="stat-icon text-primary" style="background-color: #e0e7ff;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="row g-4">
        <!-- Left Side: Profile & Services Sidebar -->
        <div class="col-lg-4">
            
            <!-- Profile Card -->
            <div class="bg-white rounded-4 shadow-sm border border-light p-4 mb-4">
                <div class="text-center mb-4">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3 border border-3 border-success" style="width: 80px; height: 80px; background: #f8f9fa;">
                        <i class="fas fa-user-tie fs-1 text-secondary"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ $user->name }}</h5>
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1">নিবন্ধিত নাগরিক</span>
                </div>

                <div class="border-top pt-3 fs-content">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">এনআইডি নম্বর:</span>
                        <span class="fw-bold text-dark">{{ $user->peopleProfile->nid ?? 'N/A' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">পিতার নাম:</span>
                        <span class="fw-bold text-dark">{{ $user->familyInfo->father_name ?? 'N/A' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">মোবাইল নম্বর:</span>
                        <span class="fw-bold text-dark">{{ $user->mobile }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">ইমেইল ঠিকানা:</span>
                        <span class="fw-bold text-dark">{{ $user->email }}</span>
                    </div>
                    <div class="border-top pt-3">
                        <span class="text-muted d-block mb-2">ঠিকানা (Registered Address):</span>
                        <div class="bg-light p-3 rounded-3 border border-light text-dark font-monospace fs-content">
                            {{ $user->addressInfo->present_address ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="bg-white rounded-4 shadow-sm border border-light p-4">
                <h5 class="fw-bold text-dark mb-3 border-bottom pb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-star text-danger"></i> নাগরিক সেবাসমূহ
                </h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('frontend.license.create') }}" class="quick-action-link text-decoration-none d-flex align-items-center justify-content-between p-3 rounded-3 border border-light text-dark fw-bold fs-content">
                        <span class="d-flex align-items-center gap-3">
                            <i class="fas fa-file-signature text-success fs-5"></i> সাধারণ লাইসেন্স আবেদন
                        </span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('frontend.hotel-restaurant.create') }}" class="quick-action-link text-decoration-none d-flex align-items-center justify-content-between p-3 rounded-3 border border-light text-dark fw-bold fs-content">
                        <span class="d-flex align-items-center gap-3">
                            <i class="fas fa-hotel text-success fs-5"></i> হোটেল ও রেস্তোরাঁ লাইসেন্স
                        </span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('frontend.gun-license.select') }}" class="quick-action-link text-decoration-none d-flex align-items-center justify-content-between p-3 rounded-3 border border-light text-dark fw-bold fs-content">
                        <span class="d-flex align-items-center gap-3">
                            <i class="fas fa-shield-alt text-success fs-5"></i> আগ্নেয়াস্ত্র লাইসেন্স আবেদন
                        </span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                    <a href="{{ route('inquiry.index') }}" class="quick-action-link text-decoration-none d-flex align-items-center justify-content-between p-3 rounded-3 border border-light text-dark fw-bold fs-content">
                        <span class="d-flex align-items-center gap-3">
                            <i class="fas fa-comments text-success fs-5"></i> জিজ্ঞাসা ও অভিযোগ সাবমিট
                        </span>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side: Application Tracking List -->
        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm border border-light p-4 h-100">
                <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                    <i class="fas fa-list-ul text-success"></i> আপনার আবেদনের তালিকা ও ট্র্যাকিং
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border mb-0">
                        <thead class="table-light">
                            <tr class="text-secondary fs-content">
                                <th class="py-3 px-3">ক্রমিক নং</th>
                                <th class="py-3 px-3">সেবার নাম</th>
                                <th class="py-3 px-3">আবেদন আইডি</th>
                                <th class="py-3 px-3">তারিখ</th>
                                <th class="py-3 px-3 text-center">অবস্থা</th>
                                <th class="py-3 px-3 text-center">অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0 fs-content">
                            @forelse($applications as $index => $app)
                                <tr>
                                    <td class="px-3 py-3 text-muted">{{ $index + 1 }}</td>
                                    <td class="px-3 py-3 fw-bold text-dark">{{ $app['service_name'] }}</td>
                                    <td class="px-3 py-3 font-monospace text-secondary">{{ $app['tracking_no'] }}</td>
                                    <td class="px-3 py-3 text-muted">{{ $app['date'] }}</td>
                                    <td class="px-3 py-3 text-center">
                                        @if(in_array($app['status'], ['pending', 'Submitted', 'pending_approval', '0']))
                                            <span class="badge badge-pending rounded-pill px-3 py-2 border border-warning border-opacity-25 text-dark">অপেক্ষমাণ</span>
                                        @elseif(in_array($app['status'], ['approved', 'Approved', 'active', '1']))
                                            <span class="badge badge-approved rounded-pill px-3 py-2 border border-success border-opacity-25 text-dark">অনুমোদিত</span>
                                        @elseif($app['status'] == 'repaired')
                                            <span class="badge badge-repaired rounded-pill px-3 py-2 border border-info border-opacity-25 text-dark">মেরামতকৃত</span>
                                        @else
                                            <span class="badge badge-rejected rounded-pill px-3 py-2 border border-danger border-opacity-25 text-dark">বাতিল</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <button type="button"
                                            class="btn btn-sm btn-success px-3 rounded-3 view-details-btn d-inline-flex align-items-center gap-2"
                                            data-service="{{ $app['service_name'] }}"
                                            data-tracking="{{ $app['tracking_no'] }}" data-date="{{ $app['date'] }}"
                                            data-status="{{ $app['status'] }}" data-details='@json($app['details'])'>
                                            <i class="fas fa-eye"></i> বিস্তারিত
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted d-flex flex-column align-items-center">
                                            <i class="fas fa-folder-open fs-1 mb-3 text-black-50"></i>
                                            <p class="mb-0 fs-5">কোন আবেদনের তথ্য পাওয়া যায়নি।</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal Overlay -->
<div class="modal fade" id="applicationDetailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-success text-white border-0 py-3 rounded-top-4">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="detailsModalLabel">
                    <i class="fas fa-file-alt"></i> আবেদনের বিস্তারিত তথ্য
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- General Info -->
                <div class="bg-light p-3 rounded-3 border border-light row g-3 mb-4 fs-content">
                    <div class="col-6">
                        <span class="text-muted d-block" style="font-size: 12px;">সেবা</span>
                        <span id="modalServiceName" class="fw-bold text-dark"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block" style="font-size: 12px;">আবেদন আইডি</span>
                        <span id="modalTrackingNo" class="font-monospace text-dark fw-bold"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block" style="font-size: 12px;">জমা দেওয়ার তারিখ</span>
                        <span id="modalDate" class="fw-bold text-dark"></span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block" style="font-size: 12px;">অবস্থা</span>
                        <span id="modalStatus" class="fw-bold badge rounded-pill px-3 mt-1"></span>
                    </div>
                </div>

                <!-- Specific Fields List -->
                <div>
                    <h6 class="fw-bold text-dark mb-3 border-bottom pb-2">আবেদনে প্রদত্ত তথ্যাবলী:</h6>
                    <div id="modalDetailsFields" class="d-flex flex-column fs-content gap-1">
                        <!-- Populated via jQuery -->
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 py-3 bg-light rounded-bottom-4">
                <button type="button" class="btn btn-secondary px-4 rounded-3" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        // Modal Trigger & Dynamic Population
        $(document).on('click', '.view-details-btn', function () {
            let service = $(this).data('service');
            let tracking = $(this).data('tracking');
            let date = $(this).data('date');
            let status = $(this).data('status');
            let details = $(this).data('details');

            // Set modal basic fields
            $('#modalServiceName').text(service);
            $('#modalTrackingNo').text(tracking);
            $('#modalDate').text(date);

            // Set Status Badge
            let statusBadge = $('#modalStatus');
            statusBadge.removeClass('badge-pending badge-approved badge-repaired badge-rejected border text-dark');
            if (['pending', 'Submitted', 'pending_approval', '0'].includes(status)) {
                statusBadge.text('অপেক্ষমাণ').addClass('badge-pending border border-warning text-dark');
            } else if (['approved', 'Approved', 'active', '1'].includes(status)) {
                statusBadge.text('অনুমোদিত').addClass('badge-approved border border-success text-dark');
            } else if (status === 'repaired') {
                statusBadge.text('মেরামতকৃত').addClass('badge-repaired border border-info text-dark');
            } else {
                statusBadge.text('বাতিল').addClass('badge-rejected border border-danger text-dark');
            }

            // Populate specific fields
            let fieldsContainer = $('#modalDetailsFields');
            fieldsContainer.empty();

            $.each(details, function (label, value) {
                if (value !== null && value !== undefined && value !== '') {
                    let fieldHtml = `
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-light">
                            <span class="text-muted pe-3">${label}:</span>
                            <span class="fw-bold text-dark text-end" style="word-break: break-word;">${value}</span>
                        </div>
                    `;
                    fieldsContainer.append(fieldHtml);
                }
            });

            // Open Modal using Bootstrap 5 API
            var detailsModal = new bootstrap.Modal(document.getElementById('applicationDetailsModal'));
            detailsModal.show();
        });
    });
</script>
@endpush