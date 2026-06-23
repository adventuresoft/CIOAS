@extends('frontend.master')

@section('title', 'আবেদনের ধরণ নির্বাচন করুন')

@push('style')
<style>
    .gov-form-container {
        max-width: 1000px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-top: 5px solid #006a4e;
        overflow: hidden;
    }

    .gov-header {
        background: linear-gradient(135deg, #006a4e 0%, #00523b 100%);
        color: #ffffff;
        padding: 24px 30px;
        border-bottom: 3px solid #f42a41;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .gov-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .license-card {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        background: #ffffff;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .license-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 106, 78, 0.12);
        border-color: #006a4e;
    }

    .card-icon-container {
        padding: 32px 0 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .personal-theme {
        background-color: #e6f4ea;
        color: #006a4e;
    }

    .org-theme {
        background-color: #eff6ff;
        color: #2563eb;
    }

    .other-theme {
        background-color: #fdf2f8;
        color: #db2777;
    }

    .license-card:hover .card-icon-circle.personal-theme {
        background-color: #006a4e;
        color: #ffffff;
    }

    .license-card:hover .card-icon-circle.org-theme {
        background-color: #2563eb;
        color: #ffffff;
    }

    .license-card:hover .card-icon-circle.other-theme {
        background-color: #db2777;
        color: #ffffff;
    }

    .card-header-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        text-align: center;
        margin-bottom: 8px;
    }

    .card-description {
        font-size: 0.9rem;
        color: #64748b;
        text-align: center;
        padding: 0 24px 24px;
        flex-grow: 1;
        line-height: 1.6;
    }

    .card-action-btn {
        margin: 0 24px 28px;
        border-radius: 10px !important;
        font-weight: 600 !important;
        padding: 10px 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        text-align: center;
        display: block;
    }

    .btn-personal {
        background-color: #006a4e;
        color: white;
        border: none;
    }

    .btn-personal:hover {
        background-color: #00523b;
        color: white;
    }

    .btn-org {
        background-color: #2563eb;
        color: white;
        border: none;
    }

    .btn-org:hover {
        background-color: #1d4ed8;
        color: white;
    }

    .btn-other {
        background-color: #db2777;
        color: white;
        border: none;
    }

    .btn-other:hover {
        background-color: #be185d;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container py-8">
    <div class="gov-form-container">
        <!-- Header -->
        <div class="gov-header">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-[#006a4e]">
                <i class="fas fa-shield-alt text-2xl"></i>
            </div>
            <div>
                <h2>আগ্নেয়াস্ত্র লাইসেন্স আবেদন</h2>
                <p class="text-xs text-green-100 mt-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
            </div>
        </div>

        <div class="p-8">
            <div class="text-center mb-8">
                <h4 class="font-bold text-gray-800 text-lg mb-2">অনুগ্রহ করে আপনার আবেদনের লাইসেন্সের ধরণটি নির্বাচন করুন</h4>
                <p class="text-sm text-gray-500">আপনার প্রয়োজনীয় ক্যাটাগরি অনুযায়ী নিচের কার্ডে ক্লিক করে আবেদন প্রক্রিয়া শুরু করুন।</p>
            </div>

            <div class="row justify-content-center g-4">
                
                <!-- 1. Personal License Card -->
                <div class="col-md-4">
                    <div class="card license-card" onclick="location.href='{{ route('frontend.gun-license.person.create') }}'">
                        <div class="card-icon-container">
                            <div class="card-icon-circle personal-theme">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <h5 class="card-header-title">ব্যক্তিগত</h5>
                        <p class="card-description">ব্যক্তিগত আত্মরক্ষা বা নিরাপত্তার উদ্দেশ্যে ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্সের জন্য আবেদন করুন।</p>
                        <a href="{{ route('frontend.gun-license.person.create') }}" class="btn btn-personal card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>

                <!-- 2. Bank/Org License Card -->
                <div class="col-md-4">
                    <div class="card license-card" onclick="location.href='{{ route('frontend.gun-license.org.create') }}'">
                        <div class="card-icon-container">
                            <div class="card-icon-circle org-theme">
                                <i class="fas fa-university"></i>
                            </div>
                        </div>
                        <h5 class="card-header-title">ব্যাংক/আর্থিক প্রতিষ্ঠান</h5>
                        <p class="card-description">ব্যাংক, ফাইন্যান্স কোম্পানি বা অন্যান্য আর্থিক প্রতিষ্ঠানের নিরাপত্তা ও সম্পদ সুরক্ষায় আবেদনের জন্য।</p>
                        <a href="{{ route('frontend.gun-license.org.create') }}" class="btn btn-org card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>

                <!-- 3. Other Org License Card -->
                <div class="col-md-4">
                    <div class="card license-card" onclick="location.href='{{ route('frontend.gun-license.other-org.create') }}'">
                        <div class="card-icon-container">
                            <div class="card-icon-circle other-theme">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <h5 class="card-header-title">প্রতিষ্ঠান</h5>
                        <p class="card-description">অন্যান্য বেসরকারি সংস্থা, কোম্পানি, মিল-কারখানা বা শপিংমলের নিরাপত্তা বাড়াতে লাইসেন্সের জন্য।</p>
                        <a href="{{ route('frontend.gun-license.other-org.create') }}" class="btn btn-other card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
