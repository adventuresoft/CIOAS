@extends('backend.master', ['mainMenu' => 'Dashboard', 'subMenu' =>'dashboard'])
@section('title', 'Dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome to Dashboard...</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header ---->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$organizations}}</h3>

                            <p>Total Organization</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a  class="link-light small-box-footer" href="{{route('organization.index')}}">View All Organizations</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$staffs}}</h3>
                            <p>Total Staff</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('staff.index')}}">View All Staff</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$appointments}}</h3>
                            <p>Total Appointment</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('appointment.booking.index')}}">View All Appointments</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$hotel_restaurants}}</h3>
                            <p>Total Hotel & Restaurant</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('hotel-restaurant.index')}}">View Hotel & Restaurant</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$inquiries}}</h3>
                            <p>Total Inquiries</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('inquiry.formlist')}}">View All Inquiries</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$letters}}</h3>
                            <p>Total Letter</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('application-form.index')}}">View All Letters</a>
                    </div>
                </div>
                <!-- ./col -->


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$vehicles}}</h3>
                            <p>Total Vehicle</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('vehicle.index')}}">View All Vehicles</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$mis_cases}}</h3>
                            <p>Total Mis case</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('miscase.index')}}">View All Mis Cases</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$case_orders}}</h3>
                            <p>Total Case Order</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('caseorder.index')}}">View All Case Orders</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$gun_licenses}}</h3>
                            <p>Total Gun License</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        <a class="link-light small-box-footer" href="{{route('gun-license.index')}}">View All Gun Licenses</a>
                    </div>
                </div>
                <!-- ./col -->

            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
