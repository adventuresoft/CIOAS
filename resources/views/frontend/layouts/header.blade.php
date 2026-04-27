

<div id="header">
    <a class="small-device-menu" href="#mmmenu"><span></span><span></span><span></span></a>
    <div id="header-top" style="background: #20da1e;">
        <div class="small-device-logo">
            <a href="{{ URL::to('/') }}"><img src="{{ asset('frontend/img/school-logo.png') }}" alt=""></a>
        </div>
        <div class="container">
            <div class="large-device-logo">
                <a href="{{ URL::to('/') }}"><img src="{{ asset('frontend/img/school-logo.png') }}" alt=""></a>
            </div>
            <div class="institute-name">
                <h1>Citizen Service Management and Central Reporting System</h1>
                <p>Local Government Division, Local Government Ministry, Bangladesh</p>
            </div>
            <div class="auth-menu">
                <ul>
                    @if (Auth::check())
                    <li><a href="{{ URL::to('/profile') }}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
                    <li><a role="button" class="btn btn-link" onclick="logoutUser()" style="color: #f00;">Log out</a></li>
                    @else
                    <li><a href="{{ URL::to('/login') }}">System Login</a></li>
                    <li></li>
                    <!--<li><a href="{{ url('/register') }}" style="color: #f00;">রেজিষ্ট্রশন</a></li>-->
                    @endif

                </ul>
            </div>
        </div>
    </div>
    <div id="header-bottom">
        <div class="container mb-2">
            <nav class="main-menu" id="my-menu">
                <ul>
                    <li><a href="{{ url('/') }}">হোম </a></li>
                    <li><a href="#">আমাদের সম্পর্কে</a></li>
                    <li><a href="#">ইউনিয়ন আইন</a></li>
                    <li><a href="{{ url('/allproject') }}">প্রকল্প</a></li>
                    <li><a href="#">নোটিশ</a></li>

                    <li class="has-sub"><a href="#">অন্যান্য</a>
                        <ul>
                            <li><a href="#">আবেদনের নিয়ম</a></li>
                            <li><a href="#">সনদ প্রাপ্তির নিয়ম</a></li>
                        </ul>
                    </li>
                    <li><a href="#">ছবির গ্যালারী</a></li>
                    <!--<li><a href="#">স্বাধীনতার সুবর্ণজয়ন্তী কর্নার</a></li>-->
                    {{-- <li><a class="btn btn-outline-success application-link"  href="{{route('application.create')}}">আবেদন করুন</a></li> --}}


                </ul>
            </nav>
        </div>
    </div>
</div>

@push('script')
    <script>
       function logoutUser(){
        $("#logoutForm").submit();
       }
    </script>
@endpush
