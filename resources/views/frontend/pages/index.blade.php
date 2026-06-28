@extends('frontend.master')

@section('content')

    <main class="bg-gray-50">
        <!-- Hero Section -->
        <section class="bg-gradient-to-b from-[#e8f5e9] to-[#ffffff] pb-12 border-b border-[#006a4e]/20 pt-10">

            <div class="container mx-auto max-w-6xl px-4">

                <h1 class="text-center text-3xl font-extrabold text-gray-900 mb-12 uppercase" style="letter-spacing: 1px; text-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
                </h1>
                
                <div class="flex flex-wrap justify-center gap-8">
                    
                    <!-- Appointment -->
                    <a href="{{ route('appointment.officers') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">অ্যাপয়েন্টমেন্ট</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">অফিসারদের সঙ্গে সাক্ষাতের জন্য অ্যাপয়েন্টমেন্ট বুক করুন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    আবেদন করুন <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Inquiry -->
                    <a href="{{ route('inquiry.index') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">জিজ্ঞাসা আবেদন</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">আপনার যেকোনো জিজ্ঞাসা বা অভিযোগ জানাতে আবেদন করুন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    আবেদন করুন <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- General License -->
                    <a href="{{ route('frontend.license.create') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">লাইসেন্স</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">নতুন লাইসেন্সের আবেদন করতে এখানে ক্লিক করুন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    আবেদন করুন <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Hotel & Restaurant -->
                    <a href="{{ route('frontend.hotel-restaurant.create') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">হোটেল ও রেস্তোরাঁ</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">হোটেল ও রেস্তোরাঁ লাইসেন্স সংক্রান্ত আবেদন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    আবেদন করুন <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Gun License -->
                    <a href="{{ route('frontend.gun-license.select') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">আগ্নেয়াস্ত্র লাইসেন্স</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">আগ্নেয়াস্ত্র লাইসেন্সের নতুন আবেদন বা নবায়ন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    আবেদন করুন <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Land Search -->
                    <a href="{{ route('frontend.land.search') }}" class="block w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.5rem)] relative p-6 rounded-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl group cursor-pointer text-left" style="background: linear-gradient(145deg, #ffffff 0%, #f1f5f9 100%); box-shadow: 0 10px 25px rgba(0,0,0,0.06), inset 0 2px 4px rgba(255,255,255,1); border: 1px solid #e2e8f0; text-decoration: none;">
                        <div class="flex items-start h-full">
                            <div class="flex-shrink-0 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-[#008a66] to-[#004d38] text-white shadow-lg transition-transform duration-300 group-hover:scale-110" style="box-shadow: 0 4px 10px rgba(0, 106, 78, 0.3), inset 0 2px 4px rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            
                            <div class="flex flex-col flex-grow ml-[15px] h-full">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 leading-tight" style="text-shadow: 0 1px 1px rgba(255,255,255,0.8);">জমি অনুসন্ধান</h3>
                                <p class="text-sm text-gray-600 mb-2 leading-relaxed">অনুমোদিত জমির তালিকা এবং বিস্তারিত তথ্য অনুসন্ধান করুন।</p>
                                <span class="mt-auto inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-semibold text-white transition-all duration-200 w-max" style="background: linear-gradient(135deg, #008a66, #00523b); box-shadow: 0 4px 12px rgba(0, 106, 78, 0.3), inset 0 1px 1px rgba(255,255,255,0.3); border: 1px solid #00402e;">
                                    অনুসন্ধান করুন <i class="fas fa-search ml-2 text-xs"></i>
                                </span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </section>

    </main>

@endsection