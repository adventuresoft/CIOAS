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

<div class="site-header font-kalpurush">

    {{-- ══ TOP UTILITY BAR ══ --}}
    <div class="bg-gov-top border-bottom border-secondary">
        <div class="container fs-top-header">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="d-none d-md-flex align-items-center gap-3 text-white-50">
                    <span class="d-flex align-items-center gap-1"><i class="far fa-calendar-alt opacity-75 small"></i>
                        <span id="govDate"></span></span>
                    <span class="d-flex align-items-center gap-1"><i class="far fa-clock opacity-75 small"></i> <span
                            id="govTime"></span></span>
                </div>
                <ul class="d-none d-sm-flex align-items-center gap-2 m-0 p-0 list-unstyled">
                    <li><a href="{{ url('/') }}"
                            class="top-nav-link d-inline-flex align-items-center gap-1 text-white-50"><i
                                class="fas fa-home opacity-75 small"></i> Home</a></li>
                    <li>
                        <div class="vr bg-white opacity-25" style="height: 12px;"></div>
                    </li>
                    <li><a href="#" title="Sitemap"
                            class="top-nav-link d-inline-flex align-items-center gap-1 text-white-50"><i
                                class="fas fa-sitemap opacity-75 small"></i> Sitemap</a></li>
                    <li>
                        <div class="vr bg-white opacity-25" style="height: 12px;"></div>
                    </li>
                    @guest
                        <li><a href="{{ route('frontend.user.register') }}"
                                class="top-nav-link d-inline-flex align-items-center gap-1 text-white-50"><i
                                    class="fas fa-user-plus opacity-75 small"></i> Citizen Register</a></li>
                        <li>
                            <div class="vr bg-white opacity-25" style="height: 12px;"></div>
                        </li>
                    @endguest
                    <li>
                        <a href="{{ url('/') }}/login"
                            class="top-nav-link text-white fw-bold border border-secondary bg-white bg-opacity-10 d-inline-flex align-items-center gap-1">
                            <i class="fas fa-sign-in-alt opacity-75 small"></i> System Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ══ STICKY WRAPPER ══ --}}
    <div id="stickyHeaderContainer" class="w-100 z-3 bg-white">
        {{-- ══ MAIN HEADER — Emblem + Title ══ --}}
        <div class="bg-white  py-2 position-relative">
            <div class="container fs-header">
                <div class="d-flex align-items-center justify-content-between">

                    {{-- Brand --}}
                    <div class="d-flex align-items-center gap-4">
                        <a href="{{ url('/') }}" class="d-flex align-items-center gap-4 text-decoration-none">
                            <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}"
                                class="img-fluid flex-shrink-0"
                                style="width: 60px; height: 60px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); transition: transform 0.3s;"
                                onmouseover="this.style.transform='scale(1.04)'"
                                onmouseout="this.style.transform='scale(1)'" alt="Government of Bangladesh Emblem"
                                onerror="this.style.display='none'">

                            <div class="vr bg-gov-green d-none d-md-block opacity-100"
                                style="width: 2px; height: 50px;">
                            </div>

                            <div class="flex-grow-1">
                                <p class="fs-5 fw-bold text-gov-dark mb-0 lh-sm font-kalpurush"
                                    style="letter-spacing: 0.2px;">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
                                <p class="fs-6 fw-semibold text-black mb-0 lh-sm font-kalpurush">Central Integrated
                                    Office
                                    Automation System</p>

                            </div>
                        </a>
                    </div>

                    {{-- Right Side --}}
                    <div class="d-none d-lg-flex flex-column align-items-end gap-1">
                        <a href="tel:16100"
                            class="btn btn-warning text-danger fw-bold d-inline-flex align-items-center gap-2 py-1 px-3 fs-button border border-warning"
                            style="background-color: #fff3e0;">
                            <i class="fas fa-phone-alt"></i>
                            Helpline: <strong>16100</strong>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- ══ NAVIGATION BAR ══ --}}
        <nav class="gov-navbar bg-gov-green  position-relative z-3 transition-all">
            <div
                class="container d-flex align-items-center justify-content-between d-lg-block py-2 py-lg-0 fs-header font-kalpurush">

                {{-- Desktop nav --}}
                <ul class="d-none d-lg-flex align-items-center m-0 p-0 list-unstyled w-100">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" title="হোম" class="main-nav-link">
                            <i class="fas fa-home opacity-75"></i>
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a href="#" class="main-nav-link">
                            <i class="fas fa-calendar-check opacity-75"></i> অ্যাপয়েন্টমেন্ট
                            <i class="fas fa-chevron-down small opacity-75 ms-1"></i>
                        </a>
                        <div class="gov-dropdown">
                            <a href="{{ route('appointment.officers') }}" class="dropdown-item-gov">
                                <i class="fas fa-user-tie text-gov-green small"></i> অফিসার নির্বাচন
                            </a>
                            <a href="{{ url('/login') }}" class="dropdown-item-gov">
                                <i class="fas fa-list-alt text-gov-green small"></i> আমার বুকিং
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('frontend.miscase.index') }}" class="main-nav-link">
                            <i class="fas fa-gavel opacity-75"></i> মিসকেস তালিকা
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a href="#" class="main-nav-link">
                            <i class="fas fa-gavel opacity-75"></i> ই-সেবা
                            <i class="fas fa-chevron-down small opacity-75 ms-1"></i>
                        </a>
                        <div class="gov-dropdown">
                            <a href="{{ route('inquiry.index') }}" class="dropdown-item-gov">
                                <i class="fas fa-desktop text-gov-green small"></i> জিজ্ঞাসা
                            </a>
                            <a href="{{ route('frontend.miscase.index') }}" class="dropdown-item-gov">
                                <i class="fas fa-desktop text-gov-green small"></i> মিসকেস তালিকা
                            </a>
                            <a href="{{ route('frontend.land.search') }}" class="dropdown-item-gov">
                                <i class="fas fa-desktop text-gov-green small"></i> জমি অনুসন্ধান
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="main-nav-link">
                            <i class="fas fa-phone-volume opacity-75"></i> যোগাযোগ
                        </a>
                    </li>

                    <li class="flex-grow-1"></li>

                    @auth
                        <li class="me-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm fs-button my-1">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="logoutUser()" class="btn btn-outline-light btn-sm fs-button my-1">
                                <i class="fas fa-sign-out-alt"></i> লগআউট
                            </a>
                        </li>
                    @else
                        <li class="me-2">
                            <a href="{{ route('frontend.user.register') }}"
                                class="btn btn-outline-light btn-sm fs-button my-1 fw-bold">
                                <i class="fas fa-user-plus"></i> নিবন্ধন
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm fs-button my-1">
                                <i class="fas fa-sign-in-alt"></i> লগইন
                            </a>
                        </li>
                    @endauth
                </ul>

                {{-- Mobile: brand + toggle --}}
                <span class="d-lg-none text-white fw-bold fs-6 font-kalpurush">CIOAS</span>
                <button class="d-lg-none btn btn-link text-white fs-4 p-1 text-decoration-none" id="govDrawerToggle"
                    aria-label="Open menu">
                    <i class="fas fa-bars" id="govHamburger"></i>
                </button>
            </div>
        </nav>

        {{-- ══ MOBILE DRAWER ══ --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="govMobileDrawer"
            aria-labelledby="govMobileDrawerLabel">
            <div class="offcanvas-header bg-gov-green text-white">
                <h5 class="offcanvas-title font-kalpurush fs-header" id="govMobileDrawerLabel">&#x2463; মেনু</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0 font-kalpurush">
                <div class="px-4 py-3 text-uppercase text-muted fw-bold"
                    style="font-size: 10px; letter-spacing: 1.5px;">
                    Navigation</div>
                <div class="list-group list-group-flush fs-content">
                    <a href="{{ url('/') }}"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-home text-gov-green text-center" style="width: 20px;"></i> হোম
                    </a>
                    <a href="{{ route('frontend.miscase.index') }}"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-gavel text-gov-green text-center" style="width: 20px;"></i> মিসকেস তালিকা
                    </a>
                    <a href="{{ url('/') }}"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-info-circle text-gov-green text-center" style="width: 20px;"></i> আমাদের
                        সম্পর্কে
                    </a>
                    <a href="{{ route('appointment.officers') }}"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-calendar-check text-gov-green text-center" style="width: 20px;"></i>
                        অ্যাপয়েন্টমেন্ট বুকিং
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-gavel text-gov-green text-center" style="width: 20px;"></i> আইন ও বিধিমালা
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-bell text-gov-green text-center" style="width: 20px;"></i> নোটিশ বোর্ড
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-photo-video text-gov-green text-center" style="width: 20px;"></i> গ্যালারি
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                        <i class="fas fa-phone-volume text-gov-green text-center" style="width: 20px;"></i> যোগাযোগ
                    </a>
                </div>

                <div class="px-4 py-3 text-uppercase text-muted fw-bold mt-2"
                    style="font-size: 10px; letter-spacing: 1.5px;">Account</div>
                <div class="list-group list-group-flush fs-content mb-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-tachometer-alt text-gov-green text-center" style="width: 20px;"></i> Dashboard
                        </a>
                        <a href="#" onclick="logoutUser()"
                            class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-sign-out-alt text-gov-green text-center" style="width: 20px;"></i> লগআউট
                        </a>
                    @else
                        <a href="{{ route('frontend.user.register') }}"
                            class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-user-plus text-gov-green text-center" style="width: 20px;"></i> নাগরিক নিবন্ধন
                        </a>
                        <a href="{{ url('/login') }}"
                            class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-user text-gov-green text-center" style="width: 20px;"></i> নাগরিক লগইন
                        </a>
                        <a href="{{ url('/login') }}"
                            class="list-group-item list-group-item-action py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-shield-alt text-gov-green text-center" style="width: 20px;"></i> অ্যাডমিন লগইন
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>{{-- #stickyHeaderContainer --}}

</div>{{-- .site-header --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stickyContainer = document.getElementById('stickyHeaderContainer');
        // calculate offset once the images load to be accurate
        let stickyPos = stickyContainer.offsetTop;

        window.addEventListener('resize', () => {
            if (!stickyContainer.classList.contains('sticky-navbar')) {
                stickyPos = stickyContainer.offsetTop;
            }
        });

        window.addEventListener('scroll', function () {
            if (window.scrollY >= stickyPos) {
                stickyContainer.classList.add("sticky-navbar");
                document.body.style.paddingTop = stickyContainer.offsetHeight + 'px'; // prevent layout jump
            } else {
                stickyContainer.classList.remove("sticky-navbar");
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

        // ── Mobile Drawer (Using Bootstrap Offcanvas) ──
        const drawerToggle = document.getElementById('govDrawerToggle');
        if (drawerToggle) {
            drawerToggle.addEventListener('click', function () {
                var myOffcanvas = document.getElementById('govMobileDrawer');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
                bsOffcanvas.toggle();
            });
        }

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