@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' =>'role'])

@section('content')
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm pull-right" >
                                    <a href="{{route('user.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New User</a> 
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            
                            <table class="table table-hover table-striped table-bordered text-nowrap">
                                <thead class="text-center thead-dark">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Student ID</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($users as $key => $item)                                                                     
                                    <tr class="">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td> 
                                    <td>{{$item->mobile}}</td> 
                                    <td>{{$item->student_id}}</td> 
                                    <td>{{$item->email}}</td>                                          
                                    <td>{{$item->status==1?"Approved":"Pending"}}</td>
                                     <td>
                                        <a href="{{route('user.edit',$item->id)}}" class="btn btn-success ml-2"> <i class="fas fa-edit"></i> Edit</a>
                                        
                                        <a href="{{route('user.show',$item->id)}}" class="btn btn-primary ml-2"> <i class="fas fa-eye"></i> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="d-flex justify-content-center">            
            {{$users->links()}}                  
        </div>    
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

@endsection
