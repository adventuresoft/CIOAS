@extends('frontend.master')

@section('title', 'আবেদনের ধরণ নির্বাচন করুন')

@push('style')
    <style>
        .license-card {
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            height: 100%;
            cursor: pointer;
            background: #ffffff;
            overflow: hidden;
        }

        .license-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            border-color: #cbd5e1;
        }

        .card-icon-container {
            padding: 30px 20px 15px;
            display: flex;
            justify-content: center;
        }

        .card-icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            transition: all 0.3s ease;
        }

        .license-card:hover .card-icon-circle {
            transform: scale(1.1);
        }

        .personal-theme {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .org-theme {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .other-theme {
            background-color: #fef3c7;
            color: #d97706;
        }

        .card-header-title {
            font-weight: 700;
            color: #1e293b;
            text-align: center;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .card-description {
            color: #64748b;
            text-align: center;
            padding: 0 20px 20px;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 0;
            flex-grow: 1;
        }

        .card-action-btn {
            width: 100%;
            border-radius: 0;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            transition: background-color 0.2s ease;
        }

        .btn-personal {
            background-color: #f0f9ff;
            color: #0369a1;
            border-top: 1px solid #e0f2fe;
        }

        .btn-personal:hover {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .btn-org {
            background-color: #f0fdf4;
            color: #15803d;
            border-top: 1px solid #dcfce7;
        }

        .btn-org:hover {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .btn-other {
            background-color: #fffbeb;
            color: #b45309;
            border-top: 1px solid #fef3c7;
        }

        .btn-other:hover {
            background-color: #fef3c7;
            color: #d97706;
        }

        .header-banner {
            background: linear-gradient(135deg, #006a4e 0%, #004d38 100%);
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="container pb-3">
        <div class="bg-white rounded-4 shadow-sm border border-light overflow-hidden">

            <!-- Header Banner -->
            <div class="header-banner p-3 p-md-3 d-flex flex-column flex-md-row align-items-center gap-4">
                <div class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm"
                    style="width: 40px; height: 40px;">
                    <i class="fas fa-shield-alt fs-6 text-success"></i>
                </div>
                <div class="text-center text-md-start">
                    <h4 class="fw-bold mb-2 fs-6">আগ্নেয়াস্ত্র লাইসেন্স আবেদন</h4>
                    <p class="mb-0 text-white-50 fs-content">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস অটোমেশন
                        সিস্টেম</p>
                </div>
            </div>

            <div class="p-4 p-md-5 bg-light">
                <div class="text-center mb-5">
                    <h4 class="fw-bold text-dark mb-2 fs-6">অনুগ্রহ করে আপনার আবেদনের লাইসেন্সের ধরণটি নির্বাচন করুন</h4>
                    <p class="text-muted fs-content">আপনার প্রয়োজনীয় ক্যাটাগরি অনুযায়ী নিচের কার্ডে ক্লিক করে আবেদন
                        প্রক্রিয়া শুরু করুন।</p>
                </div>

                <div class="row justify-content-center g-4 max-w-screen-lg mx-auto">

                    <!-- 1. Personal License Card -->
                    <div class="col-md-4">
                        <div class="license-card d-flex flex-column"
                            onclick="location.href='{{ route('frontend.gun-license.person.create') }}'">
                            <div class="card-icon-container">
                                <div class="card-icon-circle personal-theme">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h5 class="card-header-title">ব্যক্তিগত</h5>
                            <p class="card-description">ব্যক্তিগত আত্মরক্ষা বা নিরাপত্তার উদ্দেশ্যে ব্যক্তিগত আগ্নেয়াস্ত্র
                                লাইসেন্সের জন্য আবেদন করুন।</p>
                            <a href="{{ route('frontend.gun-license.person.create') }}"
                                class="btn btn-personal card-action-btn">আবেদন করুন <i
                                    class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>

                    <!-- 2. Bank/Org License Card -->
                    <div class="col-md-4">
                        <div class="license-card d-flex flex-column"
                            onclick="location.href='{{ route('frontend.gun-license.org.create') }}'">
                            <div class="card-icon-container">
                                <div class="card-icon-circle org-theme">
                                    <i class="fas fa-university"></i>
                                </div>
                            </div>
                            <h5 class="card-header-title">ব্যাংক/আর্থিক প্রতিষ্ঠান</h5>
                            <p class="card-description">ব্যাংক, ফাইন্যান্স কোম্পানি বা অন্যান্য আর্থিক প্রতিষ্ঠানের
                                নিরাপত্তা ও সম্পদ সুরক্ষায় আবেদনের জন্য।</p>
                            <a href="{{ route('frontend.gun-license.org.create') }}"
                                class="btn btn-org card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>

                    <!-- 3. Other Org License Card -->
                    <div class="col-md-4">
                        <div class="license-card d-flex flex-column"
                            onclick="location.href='{{ route('frontend.gun-license.other-org.create') }}'">
                            <div class="card-icon-container">
                                <div class="card-icon-circle other-theme">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <h5 class="card-header-title">প্রতিষ্ঠান</h5>
                            <p class="card-description">অন্যান্য বেসরকারি সংস্থা, কোম্পানি, মিল-কারখানা বা শপিংমলের
                                নিরাপত্তা বাড়াতে লাইসেন্সের জন্য।</p>
                            <a href="{{ route('frontend.gun-license.other-org.create') }}"
                                class="btn btn-other card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection