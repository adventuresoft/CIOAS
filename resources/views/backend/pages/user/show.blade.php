@extends('admin.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('admin.includes.messages')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Student View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Student Elements</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form>
                                
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="name">Name : </label>
                                       {{$user->name}}
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="department_id">Department : </label>
                                        {{isset($user->Department->name)?$user->Department->name:''}}
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="student_id">Student ID : </label>
                                        {{$user->student_id}}
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="email">Email : </label>
                                        {{$user->email}}
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="mobile">Mobile : </label>
                                        {{$user->mobile}}
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="identification">Identification : 
                                            @if($user->identity!=null) 
                                            <a href="{{asset('upload/users/images/'.$user->identity)}}" target="_blank"> Click to Details Views</a> 
                                            @endif
                                        </label>     

                                        <br>                                   
                                        <img src="{{asset('upload/users/images/'.$user->identity)}}" class="img-circle" width="80">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="student_id">Status : </label>
                                        {{$user->status==1?'Approved':'Pending'}}
                                    </div>
                                </div>                            
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="">                                        
                                        <a class="btn btn-dark ml-2" href="{{route('user.index')}}"><i class="fas fa-step-backward"></i> Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection