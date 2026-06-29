@extends('frontend.master')

@section('content')

    <main style="background-color: #f4faeb;" class="font-kalpurush">
        <!-- Hero Section -->
        <section class="pt-4" style="min-height: calc(100vh - 200px);">

            <div class="container font-kalpurush">

                <h1 class="text-center fw-bolder text-dark mb-3 text-text-uppercase"
                    style="letter-spacing: 1px; text-shadow: 0 1px 2px rgba(0,0,0,0.05); font-size: 28px;">
                    কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
                </h1>

                <div class="row g-4 justify-content-center">

                    <!-- Appointment -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('appointment.officers') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-comment-dots fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">অ্যাপয়েন্টমেন্ট</h3>
                                    <p class="fs-content text-muted mb-3">অফিসারদের সঙ্গে সাক্ষাতের জন্য অ্যাপয়েন্টমেন্ট
                                        বুক করুন।</p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2 small"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Inquiry -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('inquiry.index') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-comment-dots fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">জিজ্ঞাসা আবেদন</h3>
                                    <p class="fs-content text-muted mb-3">আপনার যেকোনো জিজ্ঞাসা বা অভিযোগ জানাতে আবেদন করুন।
                                    </p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2 small"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- General License -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.license.create') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-file-alt fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">লাইসেন্স</h3>
                                    <p class="fs-content text-muted mb-3">নতুন লাইসেন্সের আবেদন করতে এখানে ক্লিক করুন।</p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2 small"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Hotel & Restaurant -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.hotel-restaurant.create') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-building fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">হোটেল ও রেস্তোরাঁ</h3>
                                    <p class="fs-content text-muted mb-3">হোটেল ও রেস্তোরাঁ লাইসেন্স সংক্রান্ত আবেদন।</p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2 small"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Gun License -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.gun-license.select') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-fingerprint fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">আগ্নেয়াস্ত্র লাইসেন্স</h3>
                                    <p class="fs-content text-muted mb-3">আগ্নেয়াস্ত্র লাইসেন্সের নতুন আবেদন বা নবায়ন।</p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        আবেদন করুন <i class="fas fa-arrow-right ms-2 small"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Land Search -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('frontend.land.search') }}"
                            class="gov-card p-3 d-d-block text-decoration-none h-100 group">
                            <div class="d-d-flex align-align-items-start h-100">
                                <div class="icon-circle flex-shrink-0 me-3">
                                    <i class="fas fa-globe fs-3"></i>
                                </div>

                                <div class="d-d-flex flex-columnumn h-100 w-100">
                                    <h3 class="fs-card-title fw-bold text-dark mb-2"
                                        style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">জমি অনুসন্ধান</h3>
                                    <p class="fs-content text-muted mb-3">অনুমোদিত জমির তালিকা এবং বিস্তারিত তথ্য অনুসন্ধান
                                        করুন।</p>
                                    <span
                                        class="btn-gov mt-auto d-d-inline-d-flex align-align-items-center justify-content-center align-self-start">
                                        অনুসন্ধান করুন <i class="fas fa-search ms-2 small"></i>
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