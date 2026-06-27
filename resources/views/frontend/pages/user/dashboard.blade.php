@extends('frontend.master')

@section('title', 'নাগরিক ড্যাশবোর্ড (Citizen Dashboard)')

@push('style')
    <style>
        /* Premium Government Portal Aesthetics */
        .dashboard-header-bg {
            background: linear-gradient(135deg, #00521a 0%, #006633 100%);
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-approved {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-rejected {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .badge-repaired {
            background-color: #e0f2fe;
            color: #0369a1;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto max-w-screen-xl px-4 py-8">

        <!-- Welcome Header Banner -->
        <div
            class="dashboard-header-bg text-white rounded-2xl p-6 md:p-8 shadow-lg mb-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight">স্বাগতম, {{ $user->name }}!</h1>
                <p class="text-white/80 mt-2 text-sm md:text-base">আপনার নাগরিক ড্যাশবোর্ড থেকে সহজেই আবেদন এবং
                    অ্যাপয়েন্টমেন্ট ট্র্যাকিং করুন।</p>
            </div>
            <div class="flex items-center gap-4 bg-white/10 px-5 py-3 rounded-xl backdrop-blur-sm">
                <i class="fas fa-calendar-check text-2xl text-red-400"></i>
                <div>
                    <p class="text-xs text-white/70">আজকের তারিখ</p>
                    <p class="font-semibold text-sm">{{ now()->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">মোট আবেদন</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalApps }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <i class="fas fa-folder-open text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">অনুমোদিত আবেদন</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $approvedApps }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">পেন্ডিং আবেদন</p>
                    <p class="text-2xl font-bold text-amber-500 mt-1">{{ $pendingApps }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500">
                    <i class="fas fa-history text-xl"></i>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase">অ্যাপয়েন্টমেন্ট বুকিং</p>
                    <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $totalBookings }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Main Content Layout (Sidebar & Main table) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left Side: Profile & Services Sidebar -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Citizen Profile Summary Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="text-center mb-6">
                        <div
                            class="h-20 w-20 bg-gray-100 rounded-full mx-auto flex items-center justify-center text-gray-400 mb-3 border-2 border-[#006a4e]">
                            <i class="fas fa-user-tie text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $user->name }}</h3>
                        <span
                            class="inline-block bg-red-50 text-red-600 font-bold text-[10px] uppercase px-2 py-0.5 rounded-full mt-1 border border-red-200">নিবন্ধিত
                            নাগরিক</span>
                    </div>

                    <div class="space-y-4 border-t border-gray-50 pt-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">এনআইডি নম্বর (NID):</span>
                            <span class="font-semibold text-gray-700">{{ $user->peopleProfile->nid ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">পিতার নাম (Father's):</span>
                            <span class="font-semibold text-gray-700">{{ $user->familyInfo->father_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">মোবাইল নম্বর:</span>
                            <span class="font-semibold text-gray-700">{{ $user->mobile }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">ইমেইল ঠিকানা:</span>
                            <span class="font-semibold text-gray-700 text-xs">{{ $user->email }}</span>
                        </div>
                        <div class="border-t border-gray-50 pt-3">
                            <span class="text-gray-500 block mb-1">ঠিকানা (Registered Address):</span>
                            <span
                                class="font-medium text-gray-700 text-xs block leading-relaxed bg-gray-50 p-2.5 rounded-lg border border-gray-100">{{ $user->addressInfo->present_address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Citizen Quick Action Buttons -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2 flex items-center gap-2">
                        <i class="fas fa-star text-red-500"></i> নাগরিক সেবাসমূহ
                    </h4>
                    <div class="space-y-3">
                        <a href="{{ route('frontend.license.create') }}"
                            class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-green-50 hover:border-green-200 transition text-sm text-gray-700 font-semibold group">
                            <span class="flex items-center gap-3">
                                <i class="fas fa-file-signature text-green-600"></i> সাধারণ লাইসেন্স আবেদন
                            </span>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-green-600 transition"></i>
                        </a>
                        <a href="{{ route('frontend.hotel-restaurant.create') }}"
                            class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-green-50 hover:border-green-200 transition text-sm text-gray-700 font-semibold group">
                            <span class="flex items-center gap-3">
                                <i class="fas fa-hotel text-green-600"></i> হোটেল ও রেস্তোরাঁ লাইসেন্স
                            </span>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-green-600 transition"></i>
                        </a>
                        <a href="{{ route('frontend.gun-license.select') }}"
                            class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-green-50 hover:border-green-200 transition text-sm text-gray-700 font-semibold group">
                            <span class="flex items-center gap-3">
                                <i class="fas fa-shield-alt text-green-600"></i> আগ্নেয়াস্ত্র লাইসেন্স আবেদন
                            </span>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-green-600 transition"></i>
                        </a>
                        <a href="{{ route('inquiry.index') }}"
                            class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-green-50 hover:border-green-200 transition text-sm text-gray-700 font-semibold group">
                            <span class="flex items-center gap-3">
                                <i class="fas fa-comments text-green-600"></i> জিজ্ঞাসা ও অভিযোগ সাবমিট
                            </span>
                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-green-600 transition"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Side: Application Tracking List Table -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-list-ul text-[#006a4e]"></i> আপনার আবেদনের তালিকা ও ট্র্যাকিং
                    </h4>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-gray-600 font-semibold">
                                <tr>
                                    <th class="px-4 py-3 text-left">ক্রমিক নং</th>
                                    <th class="px-4 py-3 text-left">সেবার নাম</th>
                                    <th class="px-4 py-3 text-left">আবেদন ট্র্যাকিং আইডি</th>
                                    <th class="px-4 py-3 text-left">আবেদনের তারিখ</th>
                                    <th class="px-4 py-3 text-left text-center">অবস্থা (Status)</th>
                                    <th class="px-4 py-3 text-center">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                @forelse($applications as $index => $app)
                                    <tr>
                                        <td class="px-4 py-4">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 font-semibold text-gray-800">{{ $app['service_name'] }}</td>
                                        <td class="px-4 py-4 font-mono text-xs">{{ $app['tracking_no'] }}</td>
                                        <td class="px-4 py-4">{{ $app['date'] }}</td>
                                        <td class="px-4 py-4 text-center">
                                            @if(in_array($app['status'], ['pending', 'Submitted', 'pending_approval', '0']))
                                                <span
                                                    class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full badge-pending border border-amber-200">অপেক্ষমাণ</span>
                                            @elseif(in_array($app['status'], ['approved', 'Approved', 'active', '1']))
                                                <span
                                                    class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full badge-approved border border-green-200">অনুমোদিত</span>
                                            @elseif($app['status'] == 'repaired')
                                                <span
                                                    class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full badge-repaired border border-sky-200">মেরামতকৃত</span>
                                            @else
                                                <span
                                                    class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full badge-rejected border border-red-200">বাতিল</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-center">
                                            <button type="button"
                                                class="view-details-btn inline-flex items-center gap-1.5 bg-[#006a4e] text-white text-xs px-3 py-1.5 rounded-lg hover:bg-[#00523b] transition"
                                                data-service="{{ $app['service_name'] }}"
                                                data-tracking="{{ $app['tracking_no'] }}" data-date="{{ $app['date'] }}"
                                                data-status="{{ $app['status'] }}" data-details='@json($app['details'])'>
                                                <i class="fas fa-eye"></i> বিস্তারিত
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                                            <i class="fas fa-folder-open text-4xl mb-3 block"></i>
                                            কোন আবেদনের তথ্য পাওয়া যায়নি।
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
    <div class="modal fade" id="applicationDetailsModal" tabindex="-1" aria-labelledby="detailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-xl border-none shadow-xl overflow-hidden">
                <div class="modal-header bg-[#006a4e] text-white border-none py-4">
                    <h5 class="modal-title font-bold flex items-center gap-2" id="detailsModalLabel">
                        <i class="fas fa-file-alt"></i> আবেদনের বিস্তারিত তথ্য
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-6 space-y-4">

                    <!-- General Info -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-gray-400 block text-xs">সেবা</span>
                            <span id="modalServiceName" class="font-bold text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">আবেদন আইডি</span>
                            <span id="modalTrackingNo" class="font-mono text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">জমা দেওয়ার তারিখ</span>
                            <span id="modalDate" class="font-semibold text-gray-800"></span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-xs">অবস্থা</span>
                            <span id="modalStatus" class="font-bold"></span>
                        </div>
                    </div>

                    <!-- Specific Fields List -->
                    <div>
                        <h6 class="font-bold text-gray-800 mb-3 border-b border-gray-100 pb-2 text-sm">আবেদনে প্রদত্ত
                            তথ্যাবলী:</h6>
                        <div id="modalDetailsFields" class="divide-y divide-gray-100 text-sm">
                            <!-- Populated via jQuery -->
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-t border-gray-100 py-3">
                    <button type="button"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-4 py-2 rounded-lg text-sm transition"
                        data-bs-dismiss="modal">বন্ধ করুন</button>
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
                statusBadge.removeClass('text-amber-600 text-green-600 text-red-600 text-sky-600');
                if (['pending', 'Submitted', 'pending_approval', '0'].includes(status)) {
                    statusBadge.text('অপেক্ষমাণ').addClass('text-amber-600');
                } else if (['approved', 'Approved', 'active', '1'].includes(status)) {
                    statusBadge.text('অনুমোদিত').addClass('text-green-600');
                } else if (status === 'repaired') {
                    statusBadge.text('মেরামতকৃত').addClass('text-sky-600');
                } else {
                    statusBadge.text('বাতিল').addClass('text-red-600');
                }

                // Populate specific fields
                let fieldsContainer = $('#modalDetailsFields');
                fieldsContainer.empty();

                $.each(details, function (label, value) {
                    if (value !== null && value !== undefined && value !== '') {
                        let fieldHtml = `
                            <div class="flex justify-between py-2.5">
                                <span class="text-gray-500">${label}:</span>
                                <span class="font-semibold text-gray-800 text-right max-w-[60%]">${value}</span>
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