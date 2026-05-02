@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'HouseType'])
@push('style')
@endpush
@section('title', 'House Type')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>House Type</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            {{-- {{route('death.index')}} --}}
            <li class="breadcrumb-item"><a href="">House Type</a></li>
            <li class="breadcrumb-item active">View</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">House Type List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    {{-- {{route('death.create')}} --}}
                                    <a href="{{route('basic-settings.house-type.create')}}" class="btn btn-primary">Create</a>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Bengali Name</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
  
                                @if ($types)
                                  @foreach ($types as $key=>$item)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$item->en_name}}</td>
                                      <td>{{$item->bn_name}}</td>
                                      <td>{{date('d M, Y', strtotime($item->updated_at))}}</td>
                                      <td>
                                        <div class="table-action">
                                            <a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" href="{{route('basic-settings.house-type.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-info" title="Show" data-toggle="tooltip" href="{{route('basic-settings.house-type.edit', $item->id)}}"><i class="fa fa-eye"></i></a>

                                            <form class="deleteType" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <input type="hidden" class="id" name="id" value="{{$item->id}}">
                                              <input type="hidden" class="deleteUrl" name="deleteUrl" value="{{route('basic-settings.house-type.destroy', $item->id)}}">
                                              <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                @endif
                                
  
                              </tbody>
  
                            </table>
                          </div>
                        </div>
                         <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@push('script')
@endpush

