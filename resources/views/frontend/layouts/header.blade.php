<style>
    @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap');

    .sticky-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1030;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        animation: stickyFade 0.3s ease-in-out;
        -webkit-font-smoothing: antialiased;
    }

    @keyframes stickyFade {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<div class="font-['Inter',_sans-serif]">

    {{-- ══ TOP UTILITY BAR ══ --}}
    <div class="bg-[#00521a] border-b border-white/10 py-1.5">
        <div class="container-fluid max-w-7xl mx-auto text-[12px]">
            <div class="flex items-center justify-between gap-3">
                <div class="hidden md:flex items-center gap-4 text-[12px] text-white/80 font-['Inter',_sans-serif]">
                    <span class="flex items-center gap-1.5"><i class="far fa-calendar-alt opacity-70 text-[10px]"></i>
                        <span id="govDate"></span></span>
                    <span class="flex items-center gap-1.5"><i class="far fa-clock opacity-70 text-[10px]"></i> <span
                            id="govTime"></span></span>
                </div>
                <ul class="hidden sm:flex items-center gap-1.5 m-0 p-0 list-none">
                    <li><a href="{{ url('/') }}"
                            class="inline-flex items-center gap-1.5 text-white/80 text-[12px] no-underline py-[3px] px-2.5 rounded-[3px] transition-colors duration-200 font-['Inter',_sans-serif] hover:bg-white/10 hover:text-white"><i
                                class="fas fa-home opacity-70 text-[10px]"></i> Home</a></li>
                    <li>
                        <div class="w-[1px] h-3 bg-white/20"></div>
                    </li>
                    <li><a href="#" title="Sitemap"
                            class="inline-flex items-center gap-1.5 text-white/80 text-[12px] no-underline py-[3px] px-2.5 rounded-[3px] transition-colors duration-200 font-['Inter',_sans-serif] hover:bg-white/10 hover:text-white"><i
                                class="fas fa-sitemap opacity-70 text-[10px]"></i> Sitemap</a></li>
                    <li>
                        <div class="w-[1px] h-3 bg-white/20"></div>
                    </li>
                    @guest
                        <li><a href="{{ route('frontend.user.register') }}"
                                class="inline-flex items-center gap-1.5 text-white/80 text-[12px] no-underline py-[3px] px-2.5 rounded-[3px] transition-colors duration-200 font-['Inter',_sans-serif] hover:bg-white/10 hover:text-white"><i
                                    class="fas fa-user-plus opacity-70 text-[10px]"></i> Citizen
                                Register</a></li>
                        <li>
                            <div class="w-[1px] h-3 bg-white/20"></div>
                        </li>
                    @endguest
                    <li>
                        <a href="{{ url('/') }}/login"
                            class="inline-flex items-center gap-1.5 text-[12px] no-underline py-[3px] px-2.5 rounded-[3px] transition-colors duration-200 font-['Inter',_sans-serif] bg-white/10 border border-white/20 text-white !font-medium hover:!bg-white/20">
                            <i class="fas fa-sign-in-alt opacity-70 text-[10px]"></i> System Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ══ MAIN HEADER — Emblem + Title ══ --}}
    <div class="bg-white border-b-[3px] border-[#006633] py-3.5 relative">
        <div class="container-fluid max-w-7xl mx-auto text-[12px]">
            <div class="d-flex align-items-center justify-content-between">

                {{-- Brand --}}
                <div class="flex items-center gap-5">
                    <a href="{{ url('/') }}" class="flex items-center gap-5 no-underline">
                        <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}"
                            class="w-[52px] h-[52px] lg:w-[72px] lg:h-[72px] shrink-0 drop-shadow-md transition-transform duration-300 hover:scale-[1.04]"
                            alt="Government of Bangladesh Emblem" onerror="this.style.display='none'">
                        <div
                            class="w-[2px] h-[44px] lg:h-[60px] bg-gradient-to-b from-transparent via-[#006633] to-transparent shrink-0 hidden md:block">
                        </div>
                        <div class="flex-1">
                            <p
                                class="font-['Hind_Siliguri',_sans-serif] text-[16px] lg:text-[22px] font-bold text-[#004d26] leading-tight m-0 mb-[2px] tracking-[0.2px]">
                                কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
                            <p
                                class="font-['Inter',_sans-serif] text-[12px] lg:text-[15px] font-semibold text-[#1a237e] m-0 mb-[3px] leading-snug">
                                Central Integrated Office Automation System</p>
                            <p
                                class="font-['Inter',_sans-serif] text-[12px] text-[#757575] m-0 leading-relaxed hidden sm:block">
                                <i class="fas fa-map-marker-alt me-1 text-[#c62828] text-[10px]"></i>
                                Local Government Division, Ministry of Local Government, Bangladesh
                            </p>
                        </div>
                    </a>
                </div>

                {{-- Right Side --}}
                <div class="hidden lg:flex flex-col items-end gap-1.5">
                    <a href="tel:16100"
                        class="inline-flex items-center gap-2 bg-[#fff3e0] border border-[#ffe0b2] rounded-md px-3.5 py-1.5 text-[12px] text-[#e65100] font-semibold no-underline transition-colors hover:bg-[#ffe0b2]">
                        <i class="fas fa-phone-alt text-[14px]"></i>
                        Helpline: <strong>16100</strong>
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- ══ NAVIGATION BAR ══ --}}
    <nav class="gov-navbar bg-[#006633] relative z-[100] transition-all duration-300">
        <div
            class="container-fluid max-w-7xl mx-auto flex items-center justify-between lg:block py-1.5 lg:py-0 text-[12px]">
            {{-- Desktop nav --}}
            <ul class="hidden lg:flex items-center m-0 p-0 list-none">
                <li class="group [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="{{ url('/') }}" title="হোম"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-[14px] no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-home opacity-85 text-[12px]"></i>
                    </a>
                </li>
                <li class="group [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="{{ route('frontend.miscase.index') }}"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-gavel opacity-85 text-[12px]"></i> মিসকেস তালিকা
                    </a>
                </li>
                <li class="group relative [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="#"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-calendar-check opacity-85 text-[12px]"></i> অ্যাপয়েন্টমেন্ট
                        <i
                            class="fas fa-chevron-down text-[9px] ml-[2px] opacity-70 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="hidden group-hover:block absolute top-full left-0 bg-white rounded-b-lg shadow-[0_8px_24px_rgba(0,0,0,0.15)] min-w-[200px] z-[200] border-t-2 border-[#f0a500] overflow-hidden">
                        <a href="{{ route('appointment.officers') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-[15px] text-[#1a1a1a] no-underline font-['Hind_Siliguri',_sans-serif] transition-all duration-150 border-b border-[#f5f5f5] last:border-0 hover:bg-[#e8f5e9] hover:text-[#006633] hover:pl-[22px]">
                            <i class="fas fa-user-tie text-[#006633] text-[11px]"></i> অফিসার নির্বাচন
                        </a>
                        <a href="{{ url('/login') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-[15px] text-[#1a1a1a] no-underline font-['Hind_Siliguri',_sans-serif] transition-all duration-150 border-b border-[#f5f5f5] last:border-0 hover:bg-[#e8f5e9] hover:text-[#006633] hover:pl-[22px]">
                            <i class="fas fa-list-alt text-[#006633] text-[11px]"></i> আমার বুকিং
                        </a>
                    </div>
                </li>
                <li class="group relative [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="#"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-gavel opacity-85 text-[12px]"></i> আইন ও বিধিমালা
                        <i
                            class="fas fa-chevron-down text-[9px] ml-[2px] opacity-70 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="hidden group-hover:block absolute top-full left-0 bg-white rounded-b-lg shadow-[0_8px_24px_rgba(0,0,0,0.15)] min-w-[200px] z-[200] border-t-2 border-[#f0a500] overflow-hidden">
                        <a href="{{ route('inquiry.index') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-[15px] text-[#1a1a1a] no-underline font-['Hind_Siliguri',_sans-serif] transition-all duration-150 border-b border-[#f5f5f5] last:border-0 hover:bg-[#e8f5e9] hover:text-[#006633] hover:pl-[22px]">
                            <i class="fas fa-desktop text-[#006633] text-[11px]"></i> জিজ্ঞাসা
                        </a>
                    </div>
                </li>
                <li class="group [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="#"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-bell opacity-85 text-[12px]"></i> নোটিশ বোর্ড
                    </a>
                </li>
                <li class="group [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="#"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-photo-video opacity-85 text-[12px]"></i> গ্যালারি
                    </a>
                </li>
                <li class="group [&.active>a]:text-white [&.active>a]:bg-white/10">
                    <a href="#"
                        class="flex items-center gap-1.5 text-white/90 text-[16px] font-medium py-[11px] px-4 no-underline relative transition-colors duration-200 font-['Hind_Siliguri',_sans-serif] whitespace-nowrap tracking-[0.2px] hover:text-white hover:bg-white/10 after:absolute after:bottom-0 after:left-4 after:right-4 after:h-[2px] after:bg-[#f0a500] after:scale-x-0 after:transition-transform after:duration-250 after:rounded-sm group-hover:after:scale-x-100 group-[.active]:after:scale-x-100">
                        <i class="fas fa-phone-volume opacity-85 text-[12px]"></i> যোগাযোগ
                    </a>
                </li>

                <li class="flex-1"></li>

                @auth
                    <li class="mr-2">
                        <a href="{{ route('dashboard') }}"
                            class="bg-white/10 border border-white/25 rounded px-3.5 py-1.5 text-[12px] my-1 hover:bg-white/20 text-white/90 no-underline font-['Hind_Siliguri',_sans-serif] inline-block">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="logoutUser()"
                            class="bg-white/10 border border-white/25 rounded px-3.5 py-1.5 text-[12px] my-1 hover:bg-white/20 text-white/90 no-underline font-['Hind_Siliguri',_sans-serif] inline-block">
                            <i class="fas fa-sign-out-alt"></i> লগআউট
                        </a>
                    </li>
                @else
                    <li class="mr-2">
                        <a href="{{ route('frontend.user.register') }}"
                            class="bg-[#cc0000] border border-[#cc0000] text-white rounded px-3.5 py-1.5 text-[12px] my-1 hover:bg-white/20 hover:text-white/90 no-underline font-['Hind_Siliguri',_sans-serif] inline-block">
                            <i class="fas fa-user-plus"></i> নিবন্ধন
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/login') }}"
                            class="bg-white/10 border border-white/25 rounded px-3.5 py-1.5 text-[12px] my-1 hover:bg-white/20 text-white/90 no-underline font-['Hind_Siliguri',_sans-serif] inline-block">
                            <i class="fas fa-sign-in-alt"></i> লগইন
                        </a>
                    </li>
                @endauth
            </ul>

            {{-- Mobile: brand + toggle --}}
            <span class="lg:hidden text-white text-[14px] font-semibold font-['Hind_Siliguri',_sans-serif]">CIOAS</span>
            <button class="lg:hidden bg-transparent border-0 cursor-pointer p-2 text-white text-[22px]"
                id="govDrawerToggle" aria-label="Open menu">
                <i class="fas fa-bars" id="govHamburger"></i>
            </button>
        </div>
    </nav>

    {{-- ══ MOBILE DRAWER ══ --}}
    <div class="hidden fixed inset-0 bg-black/50 z-[9998] backdrop-blur-[2px] [&.open]:block" id="govDrawerOverlay">
    </div>
    <div class="fixed top-0 left-0 w-[280px] h-screen bg-white z-[9999] -translate-x-full transition-transform duration-300 shadow-[4px_0_20px_rgba(0,0,0,0.2)] overflow-y-auto [&.open]:translate-x-0"
        id="govMobileDrawer">
        <div class="bg-[#006633] p-4 flex items-center justify-between">
            <span class="text-white font-semibold text-[14px] font-['Hind_Siliguri',_sans-serif]">&#x2463; মেনু</span>
            <button
                class="bg-white/15 border-0 cursor-pointer text-white text-[18px] w-8 h-8 rounded-full flex items-center justify-center transition-colors hover:bg-white/25"
                id="govDrawerClose"><i class="fas fa-times"></i></button>
        </div>
        <div class="py-3">
            <div class="text-[10px] font-bold tracking-[1.5px] uppercase text-[#9e9e9e] px-5 pt-3.5 pb-1.5">Navigation
            </div>
            <a href="{{ url('/') }}"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-home w-[18px] text-center text-[#006633]"></i> হোম
            </a>
            <a href="{{ route('frontend.miscase.index') }}"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-gavel w-[18px] text-center text-[#006633]"></i> মিসকেস তালিকা
            </a>
            <a href="{{ url('/') }}"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-info-circle w-[18px] text-center text-[#006633]"></i> আমাদের সম্পর্কে
            </a>
            <a href="{{ route('appointment.officers') }}"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-calendar-check w-[18px] text-center text-[#006633]"></i> অ্যাপয়েন্টমেন্ট বুকিং
            </a>
            <a href="#"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-gavel w-[18px] text-center text-[#006633]"></i> আইন ও বিধিমালা
            </a>
            <a href="#"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-bell w-[18px] text-center text-[#006633]"></i> নোটিশ বোর্ড
            </a>
            <a href="#"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-photo-video w-[18px] text-center text-[#006633]"></i> গ্যালারি
            </a>
            <a href="#"
                class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                <i class="fas fa-phone-volume w-[18px] text-center text-[#006633]"></i> যোগাযোগ
            </a>

            <div class="text-[10px] font-bold tracking-[1.5px] uppercase text-[#9e9e9e] px-5 pt-3.5 pb-1.5">Account
            </div>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                    <i class="fas fa-tachometer-alt w-[18px] text-center text-[#006633]"></i> Dashboard
                </a>
                <a href="#" onclick="logoutUser()"
                    class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                    <i class="fas fa-sign-out-alt w-[18px] text-center text-[#006633]"></i> লগআউট
                </a>
            @else
                <a href="{{ route('frontend.user.register') }}"
                    class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                    <i class="fas fa-user-plus w-[18px] text-center text-[#006633]"></i> নাগরিক নিবন্ধন
                </a>
                <a href="{{ url('/login') }}"
                    class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                    <i class="fas fa-user w-[18px] text-center text-[#006633]"></i> নাগরিক লগইন
                </a>
                <a href="{{ url('/login') }}"
                    class="flex items-center gap-2.5 px-5 py-3 text-[14px] text-[#1a1a1a] no-underline border-b border-[#f5f5f5] font-['Hind_Siliguri',_sans-serif] transition-all hover:bg-[#e8f5e9] hover:text-[#006633]">
                    <i class="fas fa-shield-alt w-[18px] text-center text-[#006633]"></i> অ্যাডমিন লগইন
                </a>
            @endauth
        </div>
    </div>

</div>{{-- .site-header --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.querySelector('.gov-navbar');
        // calculate offset once the images load to be accurate
        let stickyPos = navbar.offsetTop;

        window.addEventListener('resize', () => {
            if (!navbar.classList.contains('sticky-navbar')) {
                stickyPos = navbar.offsetTop;
            }
        });

        window.addEventListener('scroll', function () {
            if (window.scrollY >= stickyPos) {
                navbar.classList.add("sticky-navbar");
                document.body.style.paddingTop = navbar.offsetHeight + 'px'; // prevent layout jump
            } else {
                navbar.classList.remove("sticky-navbar");
                document.body.style.paddingTop = '0';
            }
        });
    });
</script>

@push('script')
    <script>
        // ── Live Date & Time ──
        function updateGovClock() {
            const now = new Date();
            const dateOptions = { weekday: 'short', year: 'numeric', month: 'long', day: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
            const dateEl = document.getElementById('govDate');
            const timeEl = document.getElementById('govTime');
            if (dateEl) dateEl.textContent = now.toLocaleDateString('en-BD', dateOptions);
            if (timeEl) timeEl.textContent = now.toLocaleTimeString('en-BD', timeOptions);
        }
        updateGovClock();
        setInterval(updateGovClock, 1000);

        // ── Mobile Drawer ──
        const drawerToggle = document.getElementById('govDrawerToggle');
        const drawerClose = document.getElementById('govDrawerClose');
        const mobileDrawer = document.getElementById('govMobileDrawer');
        const drawerOverlay = document.getElementById('govDrawerOverlay');
        const hamburger = document.getElementById('govHamburger');

        function openDrawer() {
            mobileDrawer.classList.add('open');
            drawerOverlay.classList.add('open');
            hamburger.classList.replace('fa-bars', 'fa-times');
            document.body.style.overflow = 'hidden';
        }
        function closeDrawer() {
            mobileDrawer.classList.remove('open');
            drawerOverlay.classList.remove('open');
            hamburger.classList.replace('fa-times', 'fa-bars');
            document.body.style.overflow = '';
        }

        if (drawerToggle) drawerToggle.addEventListener('click', openDrawer);
        if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
        if (drawerOverlay) drawerOverlay.addEventListener('click', closeDrawer);

        // ── Mark active nav item ──
        (function () {
            const currentPath = window.location.pathname;
            document.querySelectorAll('nav ul > li > a').forEach(link => {
                if (link.getAttribute('href') && link.getAttribute('href') !== '#' &&
                    currentPath === new URL(link.href, window.location.origin).pathname) {
                    link.closest('li').classList.add('active');
                }
            });
        })();

        function logoutUser() {
            const f = document.getElementById('logoutForm');
            if (f) f.submit();
        }
    </script>
@endpush