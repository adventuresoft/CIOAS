<style>
    /* ═══════════════════════════════════════════════
       CIOAS — Government-Style Header
       Bangladesh Gov Office aesthetic + Material Design
    ═══════════════════════════════════════════════ */

    @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@400;500;600;700&display=swap');

    /* ── Variables ── */
    :root {
        --gov-green: #006633;
        --gov-green-dark: #004d26;
        --gov-green-mid: #007a3d;
        --gov-red: #cc0000;
        --gov-gold: #f0a500;
        --top-bar-bg: #00521a;
        --nav-bg: #006633;
        --nav-border: #007a3d;
        --text-white: #ffffff;
        --text-light: rgba(255, 255, 255, 0.82);
        --font-bn: 'Hind Siliguri', sans-serif;
        --font-en: 'Inter', sans-serif;
    }

    /* ── Reset for header ── */
    .site-header * {
        box-sizing: border-box;
    }

    .site-header {
        font-family: var(--font-en);
    }

    /* ══ 1. TOP UTILITY BAR ══ */
    .gov-top-bar {
        background: var(--top-bar-bg);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding: 5px 0;
    }

    .gov-top-bar .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .gov-top-bar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    /* Date & Time */
    .gov-datetime {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 11.5px;
        color: var(--text-light);
        font-family: var(--font-en);
    }

    .gov-datetime span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .gov-datetime i {
        opacity: 0.7;
        font-size: 10px;
    }

    /* Top right links */
    .gov-top-links {
        display: flex;
        align-items: center;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .gov-top-links li a {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--text-light);
        font-size: 11.5px;
        text-decoration: none;
        padding: 3px 10px;
        border-radius: 3px;
        transition: background 0.2s, color 0.2s;
        font-family: var(--font-en);
    }

    .gov-top-links li a:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
    }

    .gov-top-links .sep {
        width: 1px;
        height: 12px;
        background: rgba(255, 255, 255, 0.2);
    }

    .gov-top-links .btn-login {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff !important;
        font-weight: 500;
    }

    .gov-top-links .btn-login:hover {
        background: rgba(255, 255, 255, 0.22) !important;
    }

    /* ══ 2. MAIN HEADER (Emblem + Title) ══ */
    .gov-main-header {
        background: #fff;
        border-bottom: 3px solid var(--gov-green);
        padding: 14px 0;
        position: relative;
    }

    .gov-main-header .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .gov-brand {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .gov-emblem {
        width: 72px;
        height: 72px;
        flex-shrink: 0;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.12));
        transition: transform 0.3s ease;
    }

    .gov-emblem:hover {
        transform: scale(1.04);
    }

    .gov-title-block {
        flex: 1;
    }

    .gov-title-bn {
        font-family: var(--font-bn);
        font-size: 22px;
        font-weight: 700;
        color: var(--gov-green-dark);
        line-height: 1.2;
        margin: 0 0 2px;
        letter-spacing: 0.2px;
    }

    .gov-title-en {
        font-family: var(--font-en);
        font-size: 15px;
        font-weight: 600;
        color: #1a237e;
        margin: 0 0 3px;
        line-height: 1.3;
    }

    .gov-subtitle {
        font-family: var(--font-en);
        font-size: 12px;
        color: #757575;
        margin: 0;
        line-height: 1.5;
    }

    /* Divider line between emblem and title */
    .gov-brand-divider {
        width: 2px;
        height: 60px;
        background: linear-gradient(to bottom, transparent, var(--gov-green), transparent);
        flex-shrink: 0;
    }

    /* Right side of main header */
    .gov-header-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
    }

    .gov-helpline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff3e0;
        border: 1px solid #ffe0b2;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 12px;
        color: #e65100;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }

    .gov-helpline:hover {
        background: #ffe0b2;
    }

    .gov-helpline i {
        font-size: 14px;
    }

    .gov-access-btns {
        display: flex;
        gap: 6px;
    }

    .gov-access-btns a {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s;
        font-family: var(--font-bn);
    }

    .gov-btn-citizen {
        background: var(--gov-green);
        color: #fff;
        border: 1px solid var(--gov-green-dark);
    }

    .gov-btn-citizen:hover {
        background: var(--gov-green-dark);
        color: #fff;
    }

    .gov-btn-admin {
        background: #1a237e;
        color: #fff;
        border: 1px solid #0d1057;
    }

    .gov-btn-admin:hover {
        background: #0d1057;
        color: #fff;
    }

    /* ══ 3. NAVIGATION BAR ══ */
    .gov-navbar {
        background: var(--nav-bg);
        border-top: 1px solid var(--nav-border);
        border-bottom: 2px solid var(--gov-gold);
        position: relative;
        z-index: 100;
    }

    .gov-navbar .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .gov-nav-list {
        display: flex;
        align-items: center;
        gap: 0;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .gov-nav-list>li>a {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
        font-weight: 500;
        padding: 11px 16px;
        text-decoration: none;
        position: relative;
        transition: color 0.2s, background 0.2s;
        font-family: var(--font-bn);
        white-space: nowrap;
        letter-spacing: 0.2px;
    }

    .gov-nav-list>li>a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 16px;
        right: 16px;
        height: 2px;
        background: var(--gov-gold);
        transform: scaleX(0);
        transition: transform 0.25s ease;
        border-radius: 2px;
    }

    .gov-nav-list>li>a:hover,
    .gov-nav-list>li.active>a {
        color: #fff;
        background: rgba(255, 255, 255, 0.08);
    }

    .gov-nav-list>li>a:hover::after,
    .gov-nav-list>li.active>a::after {
        transform: scaleX(1);
    }

    .gov-nav-list>li>a i {
        font-size: 12px;
        opacity: 0.85;
    }

    /* Home icon link */
    .gov-nav-home a {
        padding: 11px 14px !important;
        font-size: 16px !important;
    }

    /* Dropdown */
    .gov-nav-list .has-dropdown {
        position: relative;
    }

    .gov-nav-list .has-dropdown>a .caret-icon {
        font-size: 9px;
        margin-left: 2px;
        opacity: 0.7;
        transition: transform 0.2s;
    }

    .gov-nav-list .has-dropdown:hover>a .caret-icon {
        transform: rotate(180deg);
    }

    .gov-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        z-index: 200;
        border-top: 2px solid var(--gov-gold);
        overflow: hidden;
    }

    .gov-nav-list .has-dropdown:hover .gov-dropdown {
        display: block;
    }

    .gov-dropdown a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        font-size: 13px;
        color: #1a1a1a;
        text-decoration: none;
        font-family: var(--font-bn);
        transition: background 0.18s, color 0.18s;
        border-bottom: 1px solid #f5f5f5;
    }

    .gov-dropdown a:last-child {
        border-bottom: none;
    }

    .gov-dropdown a:hover {
        background: #e8f5e9;
        color: var(--gov-green);
        padding-left: 22px;
    }

    .gov-dropdown a i {
        color: var(--gov-green);
        font-size: 11px;
    }

    /* Right push in navbar */
    .gov-nav-spacer {
        flex: 1;
    }

    .gov-nav-list .nav-login-btn a {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 4px;
        padding: 7px 14px !important;
        font-size: 12px !important;
        margin: 4px 0;
    }

    .gov-nav-list .nav-login-btn a:hover {
        background: rgba(255, 255, 255, 0.2) !important;
    }

    .gov-nav-list .nav-login-btn a::after {
        display: none;
    }

    /* ══ 4. MOBILE ══ */
    .gov-mobile-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        color: #fff;
        font-size: 22px;
    }

    .gov-mobile-drawer {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: #fff;
        z-index: 9999;
        transform: translateX(-100%);
        transition: transform 0.32s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
        overflow-y: auto;
    }

    .gov-mobile-drawer.open {
        transform: translateX(0);
    }

    .gov-drawer-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9998;
        backdrop-filter: blur(2px);
    }

    .gov-drawer-overlay.open {
        display: block;
    }

    .gov-drawer-header {
        background: var(--gov-green);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .gov-drawer-header span {
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        font-family: var(--font-bn);
    }

    .gov-drawer-close {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        cursor: pointer;
        color: #fff;
        font-size: 18px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .gov-drawer-close:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .gov-drawer-body {
        padding: 12px 0;
    }

    .gov-drawer-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        font-size: 14px;
        color: #1a1a1a;
        text-decoration: none;
        border-bottom: 1px solid #f5f5f5;
        font-family: var(--font-bn);
        transition: background 0.18s, color 0.18s;
    }

    .gov-drawer-link i {
        width: 18px;
        text-align: center;
        color: var(--gov-green);
    }

    .gov-drawer-link:hover {
        background: #e8f5e9;
        color: var(--gov-green);
    }

    .gov-drawer-section {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #9e9e9e;
        padding: 14px 20px 6px;
    }

    /* ══ Responsive ══ */
    @media (max-width: 991px) {
        .gov-navbar .gov-nav-list {
            display: none;
        }

        .gov-mobile-toggle {
            display: flex;
        }

        .gov-navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 20px;
        }

        .gov-navbar-brand-mobile {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            font-family: var(--font-bn);
        }

        .gov-header-right {
            display: none;
        }

        .gov-title-bn {
            font-size: 16px;
        }

        .gov-title-en {
            font-size: 12px;
        }

        .gov-emblem {
            width: 52px;
            height: 52px;
        }

        .gov-brand-divider {
            height: 44px;
        }

        .gov-datetime {
            display: none;
        }
    }

    @media (max-width: 575px) {
        .gov-top-links {
            display: none;
        }
    }
</style>

<div class="site-header">

    {{-- ══ TOP UTILITY BAR ══ --}}
    <div class="gov-top-bar">
        <div class="container-fluid">
            <div class="gov-top-bar-inner">
                <div class="gov-datetime">
                    <span><i class="far fa-calendar-alt"></i> <span id="govDate"></span></span>
                    <span><i class="far fa-clock"></i> <span id="govTime"></span></span>
                </div>
                <ul class="gov-top-links">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li>
                        <div class="sep"></div>
                    </li>
                    <li><a href="#" title="Sitemap"><i class="fas fa-sitemap"></i> Sitemap</a></li>
                    <li>
                        <div class="sep"></div>
                    </li>
                    <li>
                        <a href="{{ url('/') }}/login" class="btn-login">
                            <i class="fas fa-sign-in-alt"></i> System Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- ══ MAIN HEADER — Emblem + Title ══ --}}
    <div class="gov-main-header">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">

                {{-- Brand --}}
                <div class="gov-brand">
                    <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}" class="gov-emblem"
                        alt="Government of Bangladesh Emblem" onerror="this.style.display='none'">
                    <div class="gov-brand-divider d-none d-md-block"></div>
                    <div class="gov-title-block">
                        <p class="gov-title-bn">কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
                        <p class="gov-title-en">Central Integrated Office Automation System</p>
                        <p class="gov-subtitle">
                            <i class="fas fa-map-marker-alt me-1" style="color:#c62828;font-size:10px;"></i>
                            Local Government Division, Ministry of Local Government, Bangladesh
                        </p>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="gov-header-right">
                    <a href="tel:16100" class="gov-helpline">
                        <i class="fas fa-phone-alt"></i>
                        Helpline: <strong>16100</strong>
                    </a>
                    <div class="gov-access-btns">
                        <a href="{{ url('/login') }}" class="gov-btn-citizen">
                            <i class="fas fa-user"></i> নাগরিক লগইন
                        </a>
                        <a href="{{ url('/login') }}" class="gov-btn-admin">
                            <i class="fas fa-shield-alt"></i> অ্যাডমিন লগইন
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══ NAVIGATION BAR ══ --}}
    <nav class="gov-navbar">
        <div class="container-fluid">
            {{-- Desktop nav --}}
            <ul class="gov-nav-list">
                <li class="gov-nav-home">
                    <a href="{{ url('/') }}" title="হোম">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ url('/') }}">
                        <i class="fas fa-info-circle"></i> আমাদের সম্পর্কে
                    </a>
                </li> -->
                <li class="has-dropdown">
                    <a href="#">
                        <i class="fas fa-calendar-check"></i> অ্যাপয়েন্টমেন্ট
                        <i class="fas fa-chevron-down caret-icon"></i>
                    </a>
                    <div class="gov-dropdown">
                        <a href="{{ route('appointment.officers') }}">
                            <i class="fas fa-user-tie"></i> অফিসার নির্বাচন
                        </a>
                        <a href="{{ url('/login') }}">
                            <i class="fas fa-list-alt"></i> আমার বুকিং
                        </a>
                    </div>
                </li>
                <li class="has-dropdown">
                    <a href="#">
                        <i class="fas fa-gavel"></i> আইন ও বিধিমালা
                        <i class="fas fa-chevron-down caret-icon"></i>
                    </a>
                    <div class="gov-dropdown">
                        <a href="{{ route('inquiry.index') }}">
                            <i class="fas fa-desktop"></i> জিজ্ঞাসা
                        </a>
                    </div>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-bell"></i> নোটিশ বোর্ড
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-photo-video"></i> গ্যালারি
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-phone-volume"></i> যোগাযোগ
                    </a>
                </li>

                <li class="gov-nav-spacer"></li>

                @auth
                    <li class="nav-login-btn">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-login-btn">
                        <a href="#" onclick="logoutUser()">
                            <i class="fas fa-sign-out-alt"></i> লগআউট
                        </a>
                    </li>
                @else
                    <li class="nav-login-btn">
                        <a href="{{ url('/login') }}">
                            <i class="fas fa-sign-in-alt"></i> লগইন
                        </a>
                    </li>
                @endauth
            </ul>

            {{-- Mobile: brand + toggle --}}
            <span class="gov-navbar-brand-mobile d-md-none">CIOAS</span>
            <button class="gov-mobile-toggle" id="govDrawerToggle" aria-label="Open menu">
                <i class="fas fa-bars" id="govHamburger"></i>
            </button>
        </div>
    </nav>

    {{-- ══ MOBILE DRAWER ══ --}}
    <div class="gov-drawer-overlay" id="govDrawerOverlay"></div>
    <div class="gov-mobile-drawer" id="govMobileDrawer">
        <div class="gov-drawer-header">
            <span>&#x2463; মেনু</span>
            <button class="gov-drawer-close" id="govDrawerClose"><i class="fas fa-times"></i></button>
        </div>
        <div class="gov-drawer-body">
            <div class="gov-drawer-section">Navigation</div>
            <a href="{{ url('/') }}" class="gov-drawer-link">
                <i class="fas fa-home"></i> হোম
            </a>
            <a href="{{ url('/') }}" class="gov-drawer-link">
                <i class="fas fa-info-circle"></i> আমাদের সম্পর্কে
            </a>
            <a href="{{ route('appointment.officers') }}" class="gov-drawer-link">
                <i class="fas fa-calendar-check"></i> অ্যাপয়েন্টমেন্ট বুকিং
            </a>
            <a href="#" class="gov-drawer-link">
                <i class="fas fa-gavel"></i> আইন ও বিধিমালা
            </a>
            <a href="#" class="gov-drawer-link">
                <i class="fas fa-bell"></i> নোটিশ বোর্ড
            </a>
            <a href="#" class="gov-drawer-link">
                <i class="fas fa-photo-video"></i> গ্যালারি
            </a>
            <a href="#" class="gov-drawer-link">
                <i class="fas fa-phone-volume"></i> যোগাযোগ
            </a>

            <div class="gov-drawer-section">Account</div>
            @auth
                <a href="{{ route('dashboard') }}" class="gov-drawer-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#" onclick="logoutUser()" class="gov-drawer-link">
                    <i class="fas fa-sign-out-alt"></i> লগআউট
                </a>
            @else
                <a href="{{ url('/login') }}" class="gov-drawer-link">
                    <i class="fas fa-user"></i> নাগরিক লগইন
                </a>
                <a href="{{ url('/login') }}" class="gov-drawer-link">
                    <i class="fas fa-shield-alt"></i> অ্যাডমিন লগইন
                </a>
            @endauth
        </div>
    </div>

</div>{{-- .site-header --}}

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
            document.querySelectorAll('.gov-nav-list > li > a').forEach(link => {
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