@extends('frontend.master')

@section('content')

    <main class="bg-gray-50">
        <!-- Hero Section -->
        <section class="bg-gradient-to-b from-[#e8f5e9] to-[#ffffff] pt-12 pb-10 border-b border-[#006a4e]/20">
            <div class="container mx-auto max-w-screen-xl px-4 text-center">
                <h2 class="text-2xl font-bold tracking-tight text-[#006a4e] sm:text-3xl lg:text-4xl">
                    কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-700">
                    গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - এই প্ল্যাটফর্মে আপনি আপনার প্রয়োজনীয় সেবাগুলো পেতে পারেন।
                </p>
                <div class="mx-auto mt-6 w-24 h-1 bg-[#f42a41] rounded-full"></div>
            </div>

            <div class="container mx-auto mt-12 max-w-5xl px-4">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    
                    <!-- General License -->
                    <article class="flex flex-col items-center p-8 bg-white rounded-xl shadow-lg border-t-4 border-[#006a4e] transition-transform hover:-translate-y-2 hover:shadow-xl">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#e8f5e9] text-[#006a4e] mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">লাইসেন্স</h3>
                        <p class="text-center text-sm text-gray-600 mb-6 flex-grow">
                            নতুন লাইসেন্সের আবেদন করতে এখানে ক্লিক করুন।
                        </p>
                        <a href="{{ route('frontend.license.create') }}" class="w-full text-center rounded-md bg-[#006a4e] px-4 py-2.5 text-sm font-semibold text-white shadow hover:bg-[#00523b] transition">
                            আবেদন করুন
                        </a>
                    </article>

                    <!-- Hotel & Restaurant -->
                    <article class="flex flex-col items-center p-8 bg-white rounded-xl shadow-lg border-t-4 border-[#006a4e] transition-transform hover:-translate-y-2 hover:shadow-xl">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#e8f5e9] text-[#006a4e] mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">হোটেল ও রেস্তোরাঁ</h3>
                        <p class="text-center text-sm text-gray-600 mb-6 flex-grow">
                            হোটেল ও রেস্তোরাঁ লাইসেন্স সংক্রান্ত আবেদন।
                        </p>
                        <a href="{{ route('frontend.hotel-restaurant.create') }}" class="w-full text-center rounded-md bg-[#006a4e] px-4 py-2.5 text-sm font-semibold text-white shadow hover:bg-[#00523b] transition">
                            আবেদন করুন
                        </a>
                    </article>

                    <!-- Gun License -->
                    <article class="flex flex-col items-center p-8 bg-white rounded-xl shadow-lg border-t-4 border-[#006a4e] transition-transform hover:-translate-y-2 hover:shadow-xl">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#e8f5e9] text-[#006a4e] mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">আগ্নেয়াস্ত্র লাইসেন্স</h3>
                        <p class="text-center text-sm text-gray-600 mb-6 flex-grow">
                            আগ্নেয়াস্ত্র লাইসেন্সের নতুন আবেদন বা নবায়ন।
                        </p>
                        <a href="{{ route('frontend.gun-license.select') }}" class="w-full text-center rounded-md bg-[#006a4e] px-4 py-2.5 text-sm font-semibold text-white shadow hover:bg-[#00523b] transition">
                            আবেদন করুন
                        </a>
                    </article>

                </div>
            </div>
        </section>


        <!-- Reports Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto max-w-6xl px-4">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">পরিসংখ্যান রিপোর্ট</h2>
                    <div class="mx-auto mt-3 w-16 h-1 bg-[#006a4e] rounded"></div>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="flex flex-col items-center justify-center p-6 bg-gray-50 border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন" class="h-16 w-16 object-contain mb-4 rounded-full border border-gray-200 p-1 bg-white" />
                        <h3 class="text-lg font-semibold text-gray-700">মোট ইউনিয়ন</h3>
                        <p class="mt-2 text-3xl font-bold text-[#006a4e]">{{ $total_unions ?? 0 }}</p>
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 bg-gray-50 border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা" class="h-16 w-16 object-contain mb-4 rounded-full border border-gray-200 p-1 bg-white" />
                        <h3 class="text-lg font-semibold text-gray-700">মোট পৌরসভা</h3>
                        <p class="mt-2 text-3xl font-bold text-[#006a4e]">{{ $total_pourashavas ?? 0 }}</p>
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 bg-gray-50 border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition">
                        <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন" class="h-16 w-16 object-contain mb-4 rounded-full border border-gray-200 p-1 bg-white" />
                        <h3 class="text-lg font-semibold text-gray-700">মোট সিটি কর্পোরেশন</h3>
                        <p class="mt-2 text-3xl font-bold text-[#006a4e]">{{ $total_city_corporations ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Information Section -->
        <section class="py-16 bg-[#eef2f6]">
            <div class="container mx-auto max-w-6xl px-4">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">প্রয়োজনীয় তথ্য</h2>
                    <div class="mx-auto mt-3 w-16 h-1 bg-[#f42a41] rounded"></div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-gray-800 mb-2">মোট ইউনিয়ন</h3>
                        <p class="text-2xl font-bold text-[#006a4e]">{{ $total_unions ?? 0 }}</p>
                    </div>
                    <div class="flex flex-col p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-gray-800 mb-2">মোট পৌরসভা</h3>
                        <p class="text-2xl font-bold text-[#006a4e]">{{ $total_pourashavas ?? 0 }}</p>
                    </div>
                    <div class="flex flex-col p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-gray-800 mb-2">মোট সিটি কর্পোরেশন</h3>
                        <p class="text-2xl font-bold text-[#006a4e]">{{ $total_city_corporations ?? 0 }}</p>
                    </div>
                    <div class="flex flex-col p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-gray-800 mb-2">অন্যান্য তথ্য</h3>
                        <a href="{{ route('inquiry.index') }}" class="mt-auto inline-flex items-center text-sm font-medium text-[#f42a41] hover:underline">
                            বিস্তারিত জানুন
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection