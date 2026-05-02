@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('content')
<div class="" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Permission</li>
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
                            <h3 class="card-title">{{isset($permission)? 'Edit Permission':'Add Permission '}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($permission))
                        <form role="form" method="POST" action="{{route('permission.update',$permission->id)}}" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Permission</label>
                                    <input type="text" name="name" class="form-control" value="{{$permission->name}}" id="name" placeholder="Enter Role" required>
                                </div>             
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Update</button>
                                <button type="reset" class="btn btn-warning ml-2"><i class="fa fa-undo-alt"></i> Reset</button>
                                    <a href="{{route('permission.index')}}" class="btn btn-dark ml-2" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                        </form>
                        @else
                        <form role="form" method="POST" action="{{route('permission.store')}}" >
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Permission</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Permission" required>
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
                            <h3 class="card-title">Permission List</h3>                
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($permissions->count()==0)
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
                                    @foreach($permissions as $key => $value)
                                    <tr class="text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>
                                            <a href="{{route('permission.edit',$value->id)}}" class="badge badge-primary"> <i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">            
                            {{$permissions->links()}}                  
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