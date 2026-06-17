@extends('backend.master', ['mainMenu' => 'GunLicense', 'subMenu' => 'GunLicenseCreate'])

@section('title', 'আবেদনের ধরণ নির্বাচন করুন')

@push('style')
<style>
    .license-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
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
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.12);
        border-color: #2563eb;
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
        background-color: #ecfdf5;
        color: #059669;
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
        background-color: #059669;
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
    }

    .btn-personal {
        background-color: #059669;
        color: white;
        border: none;
    }

    .btn-personal:hover {
        background-color: #047857;
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
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-12 text-center">
                <h1 class="font-weight-bold text-dark mb-2" style="font-size: 2.2rem;">আগ্নেয়াস্ত্র লাইসেন্স আবেদন</h1>
                <p class="text-muted" style="font-size: 1.1rem;">অনুগ্রহ করে আপনার আবেদনের লাইসেন্সের ধরণটি নির্বাচন করুন</p>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center" style="gap: 24px; margin-top: 20px;">
            
            <!-- 1. Personal License Card -->
            <div class="col-md-3">
                <div class="card license-card" onclick="location.href='{{ route('gun-license.person.create') }}'">
                    <div class="card-icon-container">
                        <div class="card-icon-circle personal-theme">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <h5 class="card-header-title">ব্যক্তিগত</h5>
                    <p class="card-description">ব্যক্তিগত আত্মরক্ষা বা নিরাপত্তার উদ্দেশ্যে ব্যক্তিগত আগ্নেয়াস্ত্র লাইসেন্সের জন্য আবেদন করুন।</p>
                    <button class="btn btn-personal card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <!-- 2. Bank/Org License Card -->
            <div class="col-md-3">
                <div class="card license-card" onclick="location.href='{{ route('gun-license.org.create') }}'">
                    <div class="card-icon-container">
                        <div class="card-icon-circle org-theme">
                            <i class="fas fa-university"></i>
                        </div>
                    </div>
                    <h5 class="card-header-title">ব্যাংক/আর্থিক প্রতিষ্ঠান</h5>
                    <p class="card-description">ব্যাংক, ফাইন্যান্স কোম্পানি বা অন্যান্য আর্থিক প্রতিষ্ঠানের নিরাপত্তা ও সম্পদ সুরক্ষায় আবেদনের জন্য।</p>
                    <button class="btn btn-org card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

            <!-- 3. Other Org License Card -->
            <div class="col-md-3">
                <div class="card license-card" onclick="location.href='{{ route('gun-license.other-org.create') }}'">
                    <div class="card-icon-container">
                        <div class="card-icon-circle other-theme">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                    <h5 class="card-header-title">প্রতিষ্ঠান</h5>
                    <p class="card-description">অন্যান্য বেসরকারি সংস্থা, কোম্পানি, মিল-কারখানা বা শপিংমলের নিরাপত্তা বাড়াতে লাইসেন্সের জন্য।</p>
                    <button class="btn btn-other card-action-btn">আবেদন করুন <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
