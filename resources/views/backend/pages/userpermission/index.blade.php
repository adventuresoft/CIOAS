@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('content')
<div class="" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Permisisons</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Permisisons</li>
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
                            <h3 class="card-title">{{isset($userPermission)? 'Edit Role Permisisons':'Add Role Permisisons'}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($userPermission))
                        <form role="form" method="POST" action="{{route('userper.update',$userPermission->model_id)}}" >

                            <input type="hidden" name="old_model_id" value="{{$userPermission->model_id}}">
                            <input type="hidden" name="old_permission_id" value="{{$userPermission->permission_id}}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach( $admins as $admin)
                                        <option {{$userPermission->model_id==$admin->id?'selected':''}} value="{{$admin->id}}">{{$admin->name}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="form-group">
                                    <label for="permission_id">Permission</label>
                                    <select class="form-control" name="permission_id" id="permission_id">
                                        @foreach( $permissions as $permission)
                                        <option {{$userPermission->permission_id==$permission->id?'selected':''}} value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
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
                        <form role="form" method="POST" action="{{route('userper.store')}}" >
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach( $admins as $admin)
                                        <option value="{{$admin->id}}">{{$admin->name}}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="form-group">
                                    <label for="permission_id">Permission</label>
                                    <select class="form-control" name="permission_id" id="permission_id">
                                        @foreach( $permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
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
                            <h3 class="card-title">User Permission List</h3>                
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($userPermissions->count()==0)
                           <div class="text-center bg-purple font-weight-bold pt-3 pb-3 h2">No Data Found</div>
                            @else
                            <table class="table table-bordered table-striped">
                                <thead class="text-center thead-dark">                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>User</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userPermissions as $key => $value)
                                    <tr class="text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->User->name}}</td>
                                        <td>{{$value->Permission->name}}</td>
                                        <td>       

                                        <a href="{{route('userper.edit',['model_id'=>$value->model_id,'permission_id'=>$value->permission_id])}}" class="badge badge-primary"> <i class="fa fa-edit"></i> Edit</a>

                                            <a href="#" class="badge badge-danger" 
                                            onclick="if (confirm('You are sure to Delete This Permission?')){event.preventDefault();document.getElementById('delete-form{{$key}}').submit();}else{event.stopPropagation(); event.preventDefault();};">
                                            <i class="fa fa-trash"></i> Delete </a>

                                            <form id="delete-form{{$key}}" action="{{ route('userper.destroy', $value->permission_id) }}" method="POST" style="display: none;">
                                                <input type="hidden" name="model_id" value="{{$value->model_id}}">
                                                <input type="hidden" name="permission_id" value="{{$value->permission_id}}">
                                                {{ method_field('POST') }}                                                
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">     
                        {{$userPermissions->links()}}                                      
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