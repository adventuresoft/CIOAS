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
                    <div class="small-box bg-warning">
                        @php

                            $male = 0;
                            $female = 0;
                            $others = 0;
                            foreach ($users as $user) {
                                if ($user->gender == 1) {
                                    $male = $user->count;
                                } else if($user->gender ==2){
                                    $female = $user->count;
                                } else{
                                    $others = $user->count;
                                }
                            }
                            $total = $male + $female + $others;

                        @endphp
                        <div class="inner">
                            <h3>{{$total}}</h3>

                            <p>Total People</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <p class="small-box-footer">Male: {{$male}} Female: {{$female}} Others: {{$others}}</p>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    @php
                    $total = $age_certificates + $character_certificates + $childless_certificates + $citizen_certificates + $disability_certificates + $financial_instability_certificates + $guardian_certificates + $landless_certificates + $married_certificates + $name_certificates + $nid_correction_certificates + $orphan_certificates + $permanent_citizen_certificates + $remarried_certificates + $residential_certificates + $unmarried_certificates + $voter_area_certificates + $voter_list_certificates + $yearly_income_certificates;
                    @endphp
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{$total}}</h3>
                            <p>Total Certificates</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-certificate"></i>
                        </div>
                        <p class="small-box-footer">Age: {{$age_certificates}} Others: {{$total - $age_certificates}}</p>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$taxes}}</h3>

                            <p>Total Tax</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-id-card"></i>
                        </div>
                      <a class="link-light small-box-footer" href="{{route('tax.index')}}" class="btn btn-link">View All Taxes</a>
                    </div>
                </div>
                <!-- ./col -->

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
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$houses}}</h3>

                            <p>Total House</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-home"></i>
                        </div>
                        <a href="{{route('house.index')}}" class="small-box-footer link-light">View All Houses</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$roads}}</h3>

                            <p>Total Road KM</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <a class="small-box-footer link-light" href="{{route('road.index')}}">View All Roads</a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>400</h3>

                            <p>Total Land</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bacon"></i>
                        </div>
                        <p class="small-box-footer">Land: 300 Others: 100</p>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>560</h3>

                            <p>Total Vehicle</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <p class="small-box-footer">Auto: 200 Others: 360</p>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>30</h3>

                            <p>Total Bridge</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-archway"></i>
                        </div>
                        <p class="small-box-footer">Concrit: 18 Others: 12</p>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>12</h3>

                            <p>Total River KM</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-water"></i>
                        </div>
                        <p class="small-box-footer">River: 6 Others: 6</p>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
