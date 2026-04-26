@extends('frontend.master')
@section('title', 'SUKTAIL UNION PARISHAD')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

@endpush
@section('content')
    <!-- Slider Section -->
    <div id="instituteinfo">
            <span id="inst-bg"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <form action="https://api.mobireach.com.bd/SendTextMessage" method="GET">
                            <input class="form-control" type="hidden" name="Username" value="advsoft"/>
                            <input class="form-control" type="hidden" name="Password" value="Dhaka@0088"/>
                            <input class="form-control" type="hidden" name="From" value="8801847050122"/>
                            <input class="form-control" type="text" name="To" value="" />
                            <input class="form-control" type="text" name="Message" value=""/>
                            <input class="btn btn-success" type="submit" value="Submit" />
                        </form>
                    
                    </div>
                </div>
            </div>
    </div>
     <!-- Counter section -->
     <!--@include('frontend.layouts.counter')-->

@endsection
@push('script')

@endpush
