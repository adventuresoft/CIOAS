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
                    <h1>Student Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Student Edit</li>
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
                            <form role="form" method="POST" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="name">Name : </label>
                                        <input type="text" value="{{$user->name}}" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="email">Email : </label>
                                        <input type="email" value="{{$user->email}}" id="email" name="email" class="form-control">
                                    </div>

                                    
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label for="student_id">Student ID : </label>
                                        <input type="text" value="{{$user->student_id}}" id="student_id" name="student_id" class="form-control">
                                    </div>
                                
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label>Status</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="status" {{$user->status==1?'checked':''}} value="1" id="approved">
                                                <label for="approved"> Approved
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="status" {{$user->status==0?'checked':''}} value="0" id="pending">
                                                <label for="pending">
                                                    Pending
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                        <button type="reset" class="btn btn-warning ml-2"><i class="fas fa-undo-alt"></i> Reset</button>
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