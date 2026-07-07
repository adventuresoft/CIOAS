@extends('frontend.master')

@push('style')
    <style>
        .font-kalpurush {
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
        }

        .gov-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }

        .gov-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #cbd5e1;
        }

        .gov-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gov-card:hover::before {
            opacity: 1;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            transition: all 0.3s ease;
        }

        .gov-card:hover .icon-circle {
            background-color: #eff6ff;
            color: #2563eb;
        }

        .fs-card-title {
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #333 !important;
            margin-bottom: 8px;
        }

        .fs-content {
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            color: #333 !important;
            line-height: 1.5;
        }

        .btn-gov {
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            font-size: 14px !important;
            color: #059669;
            font-weight: 600;
            transition: all 0.2s ease;
            padding: 6px 12px;
            background: #ecfdf5;
            border-radius: 6px;
        }

        .gov-card:hover .btn-gov {
            background: #d1fae5;
            color: #047857;
        }
    </style>
@endpush

@section('content')

    <main style="background-color: #f4faeb;" class="font-kalpurush">
        <!-- Hero Section -->
        <section class="pt-4" style="min-height: calc(100vh - 200px);">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="container font-kalpurush">

                <h1 class="text-center fw-bolder text-dark mb-3 text-text-uppercase"
                    style="letter-spacing: 1px; text-shadow: 0 1px 2px rgba(0,0,0,0.05); font-size: 28px;">
                    কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
                </h1>

                <div class="row g-4 justify-content-left">

                    <!-- Appointment -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('appointment.officers') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-calendar-check fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">অ্যাপয়েন্টমেন্ট</h3>
                                    <p class="fs-content text-muted mb-3">অফিসারদের সঙ্গে সাক্ষাতের জন্য অ্যাপয়েন্টমেন্ট
                                        বুক করুন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Inquiry -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('inquiry.index') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-question-circle fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">জিজ্ঞাসা আবেদন</h3>
                                    <p class="fs-content text-muted mb-3">আপনার যেকোনো জিজ্ঞাসা বা অভিযোগ জানাতে আবেদন করুন।
                                    </p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- General License -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.license.create') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-id-card fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">লাইসেন্স</h3>
                                    <p class="fs-content text-muted mb-3">নতুন লাইসেন্সের আবেদন করতে এখানে ক্লিক করুন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Hotel & Restaurant -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.hotel-restaurant.create') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-hotel fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">হোটেল ও রেস্তোরাঁ</h3>
                                    <p class="fs-content text-muted mb-3">হোটেল ও রেস্তোরাঁ লাইসেন্স সংক্রান্ত আবেদন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Gun License -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.gun-license.select') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-crosshairs fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">আগ্নেয়াস্ত্র লাইসেন্স</h3>
                                    <p class="fs-content text-muted mb-3">আগ্নেয়াস্ত্র লাইসেন্সের নতুন আবেদন বা নবায়ন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Land Search -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.land.search') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-map-marked-alt fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">জমি অনুসন্ধান</h3>
                                    <p class="fs-content text-muted mb-3">অনুমোদিত জমির তালিকা এবং বিস্তারিত তথ্য অনুসন্ধান
                                        করুন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        অনুসন্ধান করুন <i class="fas fa-search ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Miscase List -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.miscase.index') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-flex align-items-start h-100">
                                <div class="icon-circle flex-shrink-0" style="margin-right: 10px;">
                                    <i class="fas fa-balance-scale fs-4"></i>
                                </div>

                                <div class="d-flex flex-column h-100 w-100">
                                    <h3 class="fs-card-title">মিসকেস তালিকা</h3>
                                    <p class="fs-content text-muted mb-3">আপনার মিসকেস সম্পর্কিত তথ্য ও মামলার অবস্থা জানতে
                                        অনুসন্ধান করুন।</p>
                                    <span class="btn-gov mt-auto d-inline-flex align-items-center align-self-start">
                                        অনুসন্ধান করুন <i class="fas fa-search ms-2" style="font-size: 12px;"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </main>

@endsection