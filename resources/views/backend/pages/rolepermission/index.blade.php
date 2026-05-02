@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])
@section('content')
<div class="" style="min-height: 1203.6px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Permisisons</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role Permisisons</li>
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
                            <h3 class="card-title">{{isset($role_permission)? 'Edit Role Permisisons':'Add Role Permisisons'}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($role_permission))
                        <form role="form" method="POST" action="{{route('rolepermission.update',$role_permission->role_id)}}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="old_role_id" value="{{$role_permission->role_id}}">
                            <input type="hidden" name="old_permission_id" value="{{$role_permission->permission_id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        @foreach( $roles as $role)
                                        <option {{$role->id==$role_permission->role_id?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permission_id">Permission</label>
                                    <select class="form-control" name="permission_id" id="permission_id">
                                        @foreach( $permissions as $permission)
                                        <option {{$permission->id==$role_permission->permission_id?'selected':''}} value="{{$permission->id}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                <button type="reset" class="btn btn-warning ml-2"><i class="fa fa-undo-alt"></i> Reset</button>
                                <a href="{{route('rolepermission.index')}}" class="btn btn-dark ml-2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                        </form>
                        @else
                        <form role="form" method="POST" action="{{route('rolepermission.store')}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        @foreach( $roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
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
                            <h3 class="card-title">Role List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($role_permissions->count()==0)
                            <div class="text-center bg-purple font-weight-bold pt-3 pb-3 h2">No Data Found</div>
                            @else
                            <table class="table table-bordered table-striped">
                                <thead class="text-center thead-dark">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Role</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role_permissions as $key => $value)
                                    <tr class="text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->Role->name}}</td>
                                        <td>{{$value->Permission->name}}</td>
                                        <td>
                                        <a href="{{route('rolepermission.edit',['role_id'=>$value->role_id,'permission_id'=>$value->permission_id])}}" class="badge badge-primary"> <i class="fa fa-edit"></i> Edit</a>

                                            <a href="#" class="badge badge-danger" 
                                            onclick="if (confirm('You are sure to Delete This Permission?')){event.preventDefault();document.getElementById('delete-form{{$key}}').submit();}else{event.stopPropagation(); event.preventDefault();};">
                                            <i class="fa fa-trash"></i> Delete </a>
                                            <form id="delete-form{{$key}}" action="{{ route('rolepermission.destroy') }}" method="POST" style="display: none;">
                                                <input type="hidden" name="role_id" value="{{$value->role_id}}">
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
                            {{$role_permissions->links()}}
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