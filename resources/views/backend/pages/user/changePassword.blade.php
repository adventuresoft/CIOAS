@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Password Elements</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="POST" action="{{route('user.updatePass',$user->id)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                                <div class="row">
                                
                                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label for="password">New Password : </label>
                                        <input type="password"  id="passowrd" name="password" class="form-control" required placeholder="Password">
                                    </div>
                                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label for="password_confirmation">Password Confirm: </label>
                                        <input type="password"  id="password_confirmation" name="password_confirmation" required class="form-control" placeholder="Password Confirm">
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

@endsection