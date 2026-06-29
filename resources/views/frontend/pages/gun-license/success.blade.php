@extends('frontend.master')
@section('title', $title ?? 'আগ্নেয়াস্ত্র লাইসেন্স আবেদন সফল')

@section('content')
<div class="container py-12">
    <div class="max-w-2xl mx-auto bg-white rounded-4 shadow-lg border-t-4 border-[#006a4e] overflow-d-none">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#006a4e] to-[#00523b] p-3 text-white text-center border-b border-[#f42a41]/20">
            <div class="inline-d-d-flex h-16 w-16 align-align-items-center justify-content-center rounded-full bg-white text-gov-green mb-3 shadow-md">
                <i class="fas fa-check-circle text-3xl"></i>
            </div>
            <h2 class="text-2xl fw-bold">{{ $title ?? 'আবেদন সম্পন্ন হয়েছে!' }}</h2>
            <p class="fs-content text-green-100 mt-1">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
        </div>

        <!-- Success Message -->
        <div class="p-8 text-center">
            @if ($application_id)
                <div class="bg-green-50 rounded-3 p-3 border border-green-100 mb-3">
                    <p class="fs-content text-muted fw-bold mb-2">আপনার ট্র্যাকিং নম্বর (Tracking No):</p>
                    <span class="text-3xl font-extrabold text-gov-green tracking-wider select-all">{{ $application_id }}</span>
                </div>
                
                <h4 class="fs-card-title fw-bold text-gray-800 mb-3">আবেদনটি সফলভাবে জমা দেওয়া হয়েছে</h4>
                <p class="fs-content text-secondary leading-relaxed mb-3">
                    ভবিষ্যতের অনুসন্ধান ও অবস্থা যাচাইয়ের জন্য দয়া করে ট্র্যাকিং নম্বরটি সংরক্ষণ করুন। আপনার আবেদনটির পরবর্তী অগ্রগতি যথাসময়ে অবহিত করা হবে।
                </p>
            @else
                <h4 class="fs-card-title fw-bold text-red-600 mb-3">কোনো রেকর্ড পাওয়া যায়নি</h4>
                <p class="fs-content text-secondary mb-3">দুঃখিত, কোনো সঠিক আবেদন রেকর্ড খুঁজে পাওয়া যায়নি।</p>
            @endif

            <!-- Navigation Links -->
            <div class="d-d-flex flex-columnumn sm:flex-row justify-content-center gap-3">
                <a href="{{ route('home') }}" class="inline-d-d-flex align-align-items-center justify-content-center px-6 py-3 border border-gray-300 rounded-3 fs-content font-medium text-dark bg-white hover:bg-light shadow-sm transition">
                    <i class="fas fa-home mr-2 text-gray-400"></i> হোম পেজে ফিরে যান
                </a>
                <a href="{{ route('frontend.gun-license.select') }}" class="inline-d-d-flex align-align-items-center justify-content-center px-6 py-3 border border-transparent rounded-3 fs-content font-medium text-white bg-gov-green hover:bg-[#00523b] shadow-sm transition">
                    <i class="fas fa-plus mr-2"></i> নতুন আবেদন করুন
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="bg-light px-8 py-4 border-t border-gray-100 text-center fs-content text-muted">
            ধন্যবাদ, আমাদের সেবার সাথে থাকার জন্য।
        </div>

    </div>
</div>
@endsection
