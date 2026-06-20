@extends('frontend.master')
@section('title', $title ?? 'আগ্নেয়াস্ত্র লাইসেন্স আবেদন সফল')

@section('content')
<div class="container py-12">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg border-t-4 border-[#006a4e] overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-[#006a4e] to-[#00523b] p-6 text-white text-center border-b border-[#f42a41]/20">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-white text-[#006a4e] mb-3 shadow-md">
                <i class="fas fa-check-circle text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold">{{ $title ?? 'আবেদন সম্পন্ন হয়েছে!' }}</h2>
            <p class="text-xs text-green-100 mt-1">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
        </div>

        <!-- Success Message -->
        <div class="p-8 text-center">
            @if ($application_id)
                <div class="bg-green-50 rounded-lg p-6 border border-green-100 mb-6">
                    <p class="text-sm text-gray-500 font-semibold mb-2">আপনার ট্র্যাকিং নম্বর (Tracking No):</p>
                    <span class="text-3xl font-extrabold text-[#006a4e] tracking-wider select-all">{{ $application_id }}</span>
                </div>
                
                <h4 class="text-lg font-bold text-gray-800 mb-3">আবেদনটি সফলভাবে জমা দেওয়া হয়েছে</h4>
                <p class="text-sm text-gray-600 leading-relaxed mb-6">
                    ভবিষ্যতের অনুসন্ধান ও অবস্থা যাচাইয়ের জন্য দয়া করে ট্র্যাকিং নম্বরটি সংরক্ষণ করুন। আপনার আবেদনটির পরবর্তী অগ্রগতি যথাসময়ে অবহিত করা হবে।
                </p>
            @else
                <h4 class="text-lg font-bold text-red-600 mb-3">কোনো রেকর্ড পাওয়া যায়নি</h4>
                <p class="text-sm text-gray-600 mb-6">দুঃখিত, কোনো সঠিক আবেদন রেকর্ড খুঁজে পাওয়া যায়নি।</p>
            @endif

            <!-- Navigation Links -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 shadow-sm transition">
                    <i class="fas fa-home mr-2 text-gray-400"></i> হোম পেজে ফিরে যান
                </a>
                <a href="{{ route('frontend.gun-license.select') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-[#006a4e] hover:bg-[#00523b] shadow-sm transition">
                    <i class="fas fa-plus mr-2"></i> নতুন আবেদন করুন
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center text-xs text-gray-500">
            ধন্যবাদ, আমাদের সেবার সাথে থাকার জন্য।
        </div>

    </div>
</div>
@endsection
