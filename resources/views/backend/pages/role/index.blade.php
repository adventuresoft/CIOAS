@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('content')
<div class="" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($role)? 'Edit Role':'Add Role '}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($role))
                        <form role="form" method="POST" action="{{route('role.update',$role->id)}}" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Role</label>
                                    <input type="text" name="name" class="form-control" value="{{$role->name}}" id="name" placeholder="Enter Role" required>
                                </div>             
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Update</button>
                                <button type="reset" class="btn btn-warning ml-2"><i class="fa fa-undo-alt"></i> Reset</button>
                                    <a href="{{route('role.index')}}" class="btn btn-dark ml-2" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                        </form>
                        @else
                        <form role="form" method="POST" action="{{route('role.store')}}" >
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Role</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Role" required>
                                </div>    
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                <button type="reset" class="btn btn-warning ml-2"><i class="fa fa-undo-alt"></i> Reset</button>
                            </div>
                        </form>
                        @endif
                    </div>     
                </div>  
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Role List</h3>                
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($roles->count()==0)
                           <div class="text-center btn-warning font-weight-bold pt-3 pb-3 h2">No Data Found</div>
                            @else
                            <table class="table table-bordered table-striped">
                                <thead class="text-center thead-dark">                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $key => $value)
                                    <tr class="text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            <a href="{{route('role.edit',$value->id)}}" class="badge badge-primary"> <i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">            
                            {{$roles->links()}}                  
                        </div>  
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection