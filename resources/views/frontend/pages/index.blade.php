@extends('frontend.master')

@section('content')

    <main>
        <section class="bg-[#d3d9e4] pt-10 pb-8 md:pt-16 md:pb-10">
            <div class="container mx-auto max-w-screen-xl px-4">
                <div class="mx-auto max-w-5xl text-center">
                    <h2 class="-mt-8 text-xl font-bold tracking-tight text-black sm:-mt-10 sm:text-2xl lg:text-3xl">
                        কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম
                    </h2>
                    <p class="mx-auto mt-7 max-w-4xl text-base leading-relaxed text-black sm:mt-2 sm:text-lg md:text-xl">
                        এই প্ল্যাটফর্মে আপনি আপনার প্রয়োজনীয় সেবাগুলো পেতে পারেন।
                    </p>
                </div>




                <div class="mx-auto mt-8 max-w-5xl md:mt-10">
                    <div class="grid grid-cols-1 gap-10 lg:grid-cols-4 lg:gap-10">
                        <article class="mx-auto w-full max-w-[290px] text-center text-black">
                            <div
                                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#0ea5d9] md:h-28 md:w-28">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="h-14 w-14 md:h-16 md:w-16" aria-hidden="true">
                                    <path d="M7 3.5h8l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"
                                        fill="#f4f4f5" />
                                    <path d="M15 3.5v3h3" fill="#d4d4d8" />
                                    <path d="M9 8h6M9 11h6M9 14h4" stroke="#b3b3b8" stroke-width="1.4"
                                        stroke-linecap="round" />
                                    <path d="m12.5 16.2 2.3 2.2 4.5-4.8" stroke="#10b981" stroke-width="1.9"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold leading-tight md:text-xl">আবেদন ফরম</h3>
                            <div class="mx-auto mt-3 h-px w-full max-w-[520px] bg-black/30"></div>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-black md:text-base">
                                আবেদন করতে ক্লিক করুন ।
                            </p>
                            <a href="{{ route('application.create') }}"
                                class="mt-5 inline-flex items-center justify-center gap-1.5 rounded-md bg-[#2d88c7] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f75b3] md:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-6 w-6" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                                </svg>
                                আবেদন
                            </a>
                        </article>

                        <article class="mx-auto w-full max-w-[290px] text-center text-black">
                            <div
                                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#45caa2] md:h-28 md:w-28">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="h-14 w-14 md:h-16 md:w-16" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="13" rx="1.5" fill="#f4f4f5" />
                                    <path d="M6.5 8h10M6.5 11h10" stroke="#b3b3b8" stroke-width="1.4"
                                        stroke-linecap="round" />
                                    <path d="M6.5 14h5" stroke="#3b82f6" stroke-width="1.4" stroke-linecap="round" />
                                    <circle cx="16.5" cy="14.5" r="3.5" fill="#fbbf24" />
                                    <circle cx="16.5" cy="14.5" r="1.8" fill="#f59e0b" />
                                    <path d="m15.2 17.4-.2 2.8 1.5-1 1.5 1-.2-2.8" fill="#ef4444" />
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold leading-tight md:text-xl">সনদপত্র যাচাই</h3>
                            <div class="mx-auto mt-3 h-px w-full max-w-[520px] bg-black/30"></div>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-black md:text-base">
                                সনদপত্র যাচাই করতে ক্লিক করুন ।
                            </p>
                            <a href="{{ route('certificate.verify') }}"
                                class="mt-5 inline-flex items-center justify-center gap-1.5 rounded-md bg-[#2d88c7] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f75b3] md:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.3" class="h-6 w-6" aria-hidden="true">
                                    <circle cx="11" cy="11" r="6.5" />
                                    <path d="m16 16 4.2 4.2" stroke-linecap="round" />
                                </svg>
                                যাচাই
                            </a>
                        </article>

                        <article class="mx-auto w-full max-w-[290px] text-center text-black">
                            <div
                                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#0ea5d9] md:h-28 md:w-28">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="h-14 w-14 md:h-16 md:w-16" aria-hidden="true">
                                    <path d="M7 3.5h8l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"
                                        fill="#f4f4f5" />
                                    <path d="M15 3.5v3h3" fill="#d4d4d8" />
                                    <path d="M9 8h6M9 11h6M9 14h4" stroke="#b3b3b8" stroke-width="1.4"
                                        stroke-linecap="round" />
                                    <path d="m12.5 16.2 2.3 2.2 4.5-4.8" stroke="#10b981" stroke-width="1.9"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold leading-tight md:text-xl">লাইসেন্সের আবেদন</h3>
                            <div class="mx-auto mt-3 h-px w-full max-w-[520px] bg-black/30"></div>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-black md:text-base">
                                ট্রেড লাইসেন্সের আবেদন করুন।
                            </p>
                            <a href="{{ route('application.create') }}"
                                class="mt-5 inline-flex items-center justify-center gap-1.5 rounded-md bg-[#2d88c7] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f75b3] md:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-6 w-6" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                                </svg>
                                আবেদন
                            </a>
                        </article>



                        <article class="mx-auto w-full max-w-[290px] text-center text-black">
                            <div
                                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#45caa2] md:h-28 md:w-28">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="h-14 w-14 md:h-16 md:w-16" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="13" rx="1.5" fill="#f4f4f5" />
                                    <path d="M6.5 8h10M6.5 11h10" stroke="#b3b3b8" stroke-width="1.4"
                                        stroke-linecap="round" />
                                    <path d="M6.5 14h5" stroke="#3b82f6" stroke-width="1.4" stroke-linecap="round" />
                                    <circle cx="16.5" cy="14.5" r="3.5" fill="#fbbf24" />
                                    <circle cx="16.5" cy="14.5" r="1.8" fill="#f59e0b" />
                                    <path d="m15.2 17.4-.2 2.8 1.5-1 1.5 1-.2-2.8" fill="#ef4444" />
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold leading-tight md:text-xl">ট্রেড লাইসেন্স যাচাই</h3>
                            <div class="mx-auto mt-3 h-px w-full max-w-[520px] bg-black/30"></div>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-black md:text-base">
                                লাইসেন্স যাচাই করতে ক্লিক করুন।
                            </p>
                            <a href="{{ route('certificate.verify') }}"
                                class="mt-5 inline-flex items-center justify-center gap-1.5 rounded-md bg-[#2d88c7] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f75b3] md:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-6 w-6" aria-hidden="true">
                                    <circle cx="11" cy="11" r="6.5" />
                                    <path d="m16 16 4.2 4.2" stroke-linecap="round" />
                                </svg>
                                যাচাই
                            </a>
                        </article>

                        <article class="mx-auto w-full max-w-[290px] text-center text-black">
                            <div
                                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#27ae60] md:h-28 md:w-28">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    class="h-14 w-14 md:h-16 md:w-16" aria-hidden="true">
                                    <path d="M7 3.5h8l3 3V20a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4.5a1 1 0 0 1 1-1Z"
                                        fill="#f4f4f5" />
                                    <path d="M15 3.5v3h3" fill="#d4d4d8" />
                                    <path d="M9 8h6M9 11h6M9 14h4" stroke="#b3b3b8" stroke-width="1.4"
                                        stroke-linecap="round" />
                                    <path d="m12.5 16.2 2.3 2.2 4.5-4.8" stroke="#e74c3c" stroke-width="1.9"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="mt-5 text-lg font-semibold leading-tight md:text-xl">জিজ্ঞাসা আবেদন</h3>
                            <div class="mx-auto mt-3 h-px w-full max-w-[520px] bg-black/30"></div>
                            <p class="mx-auto mt-1 max-w-sm text-sm leading-6 text-black md:text-base">
                                আবেদন করতে ক্লিক করুন।
                            </p>
                            <a href="{{ route('inquiry.index') }}"
                                class="mt-5 inline-flex items-center justify-center gap-1.5 rounded-md bg-[#2d88c7] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#1f75b3] md:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-6 w-6" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L8 18l-4 1 1-4 11.5-11.5Z" />
                                </svg>
                                আবেদন
                            </a>
                        </article>

                    </div>
                </div>
            </div>
        </section>


        <section class="bg-[#efefef] py-12 md:py-16">
            <h2
                class="relative left-1/2 right-1/2 -mt-6 mb-8 -ml-[50vw] -mr-[50vw] w-screen bg-[#B0E0E6] py-3 text-center text-2xl font-bold tracking-tight text-black md:-mt-16 md:mb-10 md:text-3xl">
                Reports
            </h2>
            <div class="container mx-auto max-w-6xl px-4">
                <div class="grid grid-cols-1 justify-items-center gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি
                            কর্পোরেশন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
                    </div>
                </div>
            </div>
        </section>




        <section class="bg-[#ADD8E6] py-12 md:py-16">
            <div class="container mx-auto max-w-6xl px-4">
                <h2
                    class="-mt-2 mb-8 text-center text-2xl font-bold tracking-tight text-[#1f3f73] md:-mt-12 md:mb-10 md:text-3xl">
                    প্রয়োজনীয় তথ্য
                </h2>



                <div class="grid grid-cols-1 justify-items-center gap-8 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি
                            কর্পোরেশন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
                    </div>


                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/union1.jpeg') }}" alt="মোট ইউনিয়ন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট ইউনিয়ন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">4578</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/citykor1.jpeg') }}" alt="মোট সিটি কর্পোরেশন"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট সিটি
                            কর্পোরেশন</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">13</p>
                    </div>

                    <div
                        class="h-full w-full max-w-[280px] rounded-xl border border-[#d8dce8] bg-[#e8ebf0] px-6 py-8 text-center shadow-sm">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center text-[#4459c2]">
                            <img src="{{ asset('images/poroshova1.jpeg') }}" alt="মোট পৌরসভা"
                                class="h-12 w-12 object-contain" />
                        </div>
                        <h3 class="mt-6 text-lg font-semibold tracking-tight text-[#4459c2] md:text-xl">মোট পৌরসভা</h3>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-[#7fbc4e] md:text-3xl">330</p>
                    </div>


                </div>
            </div>
        </section>








    </main>
@endsection


@push('script')
    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{ asset('assets/js/navbar.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Splide("#image-carousel", {
                type: "loop",
                perPage: 1,
                gap: "1rem",
                autoplay: false,
                pagination: false,
            }).mount();
        });
    </script>
@endpush