<!-- top bar -->
<div class="top-bar">
    <div class="container mx-auto md:px-4 px-2 max-w-screen-xl">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="w-full flex justify-end md:hidden">
                <button id="mobile-menu-btn" class="md:hidden p-2 text-black" aria-label="Open mobile menu"
                    title="Open mobile menu">
                    <!-- Hamburger Icon -->
                    <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <!-- Close Icon -->
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col md:flex-row items-center gap-10">
                <img src="{{ asset('assets/images/logo/govt-bd-logo.png') }}" class="govt-logo" alt="" />
                <div class="text-black text-center md:text-left">
                    <h1 class="md:text-[25px] font-semibold">
                        Central Integrate Office Automation System
                    </h1>
                    <p>Local Government Division, Local Government Ministry, Bangladesh</p>
                </div>
            </div>

            <ul class="space-y-2 text-center md:space-y-0 mt-2 md:mt-0 md:gap-6">
                <li>
                    <a href="{{ url('/') }}/login" class="text-white text-lg"> System login </a>
                </li>
                <!--  <li>
            <a
            href="{{ url('/') }}/application"
            class="block text-center bg-gradient-to-r from-green-400 to-green-500 text-red font-bold py-1 rounded shadow hover:from-green-300 hover:to-green-400"
          >
            আবেদন করুন
            </a>
            </li> -->
            </ul>
        </div>
    </div>
</div>
<!-- Navigation -->
<nav class="navbar md:block hidden bg-[#046307] shadow-md">
    <div class="container mx-auto max-w-screen-xl">
        <!-- Navigation Links -->
        <ul class="nav-links flex items-left justify-left gap-5 py-2 pl-12">

            <li class="flex items-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2">

                    <span class="inline-flex h-7 w-7 items-center justify-center text-white" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                            <path
                                d="M12 3.1 3 10.4c-.4.3-.5.9-.2 1.3.2.3.5.4.8.4h1.4V20c0 .6.4 1 1 1h4.8c.6 0 1-.4 1-1v-4.6h2.4V20c0 .6.4 1 1 1H20c.6 0 1-.4 1-1v-7.9h1.4c.6 0 1-.4 1-.9 0-.3-.1-.6-.4-.8L12 3.1Z" />
                        </svg>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}/login" class="inline-flex items-center gap-2 text-white">
                    <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path
                                d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                        </svg>
                    </span>
                    নাগরিক লগইন
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}/login" class="inline-flex items-center gap-2 text-white">
                    <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path
                                d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                        </svg>
                    </span>
                    অ্যাডমিন লগইন
                </a>
            </li>
            <li>
                <a href="{{ url('/') }}/login" class="inline-flex items-center gap-2 text-white">
                    <span class="inline-flex h-7 w-7 items-center justify-center text-red-600" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path
                                d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                        </svg>
                    </span>
                    মনিটরিং লগইন
                </a>
            </li>



            <!--<li><a class="btn btn-outline-success application-link"  href="{{ url('/') }}/application">আবেদন করুন</a></li>-->
        </ul>
    </div>
</nav>

<!-- Mobile Navbar -->
<nav class="navbar md:hidden bg-white shadow-md relative">
    <div id="mobile-menu"
        class="fixed top-0 left-0 h-full w-72 bg-white text-gray-900 transform -translate-x-full transition-transform duration-300 ease-in-out z-50 shadow-lg">
        <div class="p-4 space-y-2">
            <!-- Mobile Nav Links -->
            <a href="{{ url('/') }}" class="block px-1 py-1 hover:bg-gray-100 rounded">
                হোম
            </a>
            <a href="{{ url('/') }}/login" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
                <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                    </svg>
                </span>
                নাগরিক লগইন
            </a>
            <a href="{{ url('/') }}/login" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
                <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                    </svg>
                </span>
                অ্যাডমিন লগইন
            </a>
            <a href="{{ url('/') }}/login" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
                <span class="inline-flex h-5 w-5 items-center justify-center text-red-600" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M12 12a4.2 4.2 0 1 0-4.2-4.2A4.2 4.2 0 0 0 12 12Zm0 1.8c-3.6 0-6.8 2-6.8 5.2 0 .6.4 1 1 1h11.6c.6 0 1-.4 1-1 0-3.2-3.2-5.2-6.8-5.2Z" />
                    </svg>
                </span>
                মনিটরিং লগইন
            </a>


        </div>
    </div>
</nav>

@push('script')
    <script>
        function logoutUser() {
            $("#logoutForm").submit();
        }
    </script>
@endpush