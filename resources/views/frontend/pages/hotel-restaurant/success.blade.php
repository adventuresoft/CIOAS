@extends('frontend.master')
@section('title', 'আবেদন সফল - হোটেল ও রেস্তোরাঁ')

@section('content')
    <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="theme-form-card">
                    <!-- Header -->
                    <div class="p-4 text-center"
                        style="background: linear-gradient(135deg, #006a4e, #00523b); border-bottom: 3px solid #f42a41;">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle shadow mb-3"
                            style="width: 70px; height: 70px; font-size: 35px;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-1">আবেদন সম্পন্ন হয়েছে!</h4>
                        <p class="mb-0 text-white-50">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
                    </div>

                    <!-- Success Message -->
                    <div class="p-4 p-md-5 text-center">
                        @if ($application_id)
                            <div class="rounded p-4 mb-4 border border-success" style="background-color: #f0fdf4;">
                                <p class="text-muted fw-bold mb-2">আপনার আবেদন আইডি (Application ID):</p>
                                <h3 class="fw-bolder text-success mb-0 user-select-all" style="letter-spacing: 1px;">
                                    {{ $application_id }}
                                </h3>
                            </div>

                            <h5 class="fw-bold text-dark mb-3">আবেদনটি সফলভাবে জমা দেওয়া হয়েছে</h5>
                            <p class="text-secondary mb-4">
                                ভবিষ্যতের অনুসন্ধান ও অবস্থা যাচাইয়ের জন্য দয়া করে আবেদন আইডিটি সংরক্ষণ করুন। আপনার
                                আবেদনটির পরবর্তী অগ্রগতি যথাসময়ে অবহিত করা হবে।
                            </p>
                        @else
                            <h5 class="fw-bold text-danger mb-3">কোনো রেকর্ড পাওয়া যায়নি</h5>
                            <p class="text-secondary mb-4">দুঃখিত, কোনো সঠিক আবেদন রেকর্ড খুঁজে পাওয়া যায়নি।</p>
                        @endif

                        <!-- Navigation Links -->
                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 py-2 fw-medium">
                                <i class="fas fa-home me-2"></i> হোম পেজে ফিরে যান
                            </a>
                            <a href="{{ route('frontend.hotel-restaurant.create') }}"
                                class="btn btn-success px-4 py-2 fw-medium" style="background-color: #006a4e;">
                                <i class="fas fa-plus me-2"></i> নতুন আবেদন করুন
                            </a>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="bg-light p-3 text-center text-muted border-top">
                        <small>ধন্যবাদ, আমাদের সেবার সাথে থাকার জন্য।</small>
                    </div>
                </div>
            </div>
        </div>
    @endsection
