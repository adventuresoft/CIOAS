@extends('frontend.master')
@section('title', 'SUKTAIL UNION PARISHAD')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

@endpush
@section('content')
    <!-- Slider Section -->
    @include('frontend.layouts.slider')
    <div id="instituteinfo">
            <span id="inst-bg"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="left">
                            <div class="title">
                                <h4>চেয়ারম্যানের বাণী</h4>
                            </div>
                            <div class="pro-pic">
                                <img style="display: none;" src="{{asset('public/frontend/img/dd7d898287506d05d7b6272e3c21215c.jpg')}}" alt="">
                                <div class="degination">
                                    <h3>চেয়ারম্যান</h3>
                                </div>
                            </div>
                            <div class="txt">
                                <p>Demo text demo text demo text demo text demo text demo text demo text demo text demo text ... <a href="">Read More</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="right">
                            <div class="title">
                                <h4>এক নজরে</h4>
                            </div>
                            <div class="txt">
                                <p>Demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text...<a href="">Read More</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
     <!-- Counter section -->
     <!--@include('frontend.layouts.counter')-->

@endsection
@push('script')
 <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
 <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
 <script type="text/javascript">
      $(document).ready(function () {
     $('.slider').bxSlider({
         mode: 'fade',
         responsive: true,
         infiniteLoop: true,
         auto: true,
         speed: 1000
     });
     $('.counter').counterUp({
         delay: 10,
         time: 1000
     });
 });
 </script>
@endpush
