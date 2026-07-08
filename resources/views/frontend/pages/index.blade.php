@extends('frontend.master')

@section('content')


    <!-- Hero Section -->
    <section style="min-height: calc(100vh - 200px);" class="pt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container font-kalpurush">

            <h1 class="text-center fw-bolder text-dark mb-4 text-uppercase fs-5"
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
                    <a href="{{ route('inquiry.index') }}" class="gov-card p-3 d-d-block text-decoration-none h-100 group">
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

            </div>
        </div>
    </section>


@endsection