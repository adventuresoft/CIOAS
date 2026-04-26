@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'RegistrationFees'])
@push('style')
@endpush
@section('title', 'Organization Registration Fees')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Registration Fees</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('organizationA.registration-fees.index')}}">Organization Registration Fees List</a></li>
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
                                    <h3 class="card-title">Organization Registration Fees List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{route('organizationA.registration-fees.create')}}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Financial Year</th>
                                    <th>Institute Type</th>
                                    <th>Org. Category</th>
                                    <th>Fees Head</th>
                                    <th>Category A</th>
                                    <th>Category B</th>
                                    <th>Category C</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                                @if (count($fees))
                                  @foreach ($fees as $key=>$fee)
                                    <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$fee->taxYear->name}}</td>
                                      <td>{{$fee->instituteType->name}}</td>
                                      <td>{{$fee->organizationCategory->en_name}} -- {{$fee->organizationSubcategory->en_name}}</td>
                                      <td>{{$fee->name}}</td>
                                      <td>{{$fee->category_a_fees}}</td>
                                      <td>{{$fee->category_b_fees}}</td>
                                      <td>{{$fee->category_c_fees}}</td>
                                      <td>
                                        <div class="d-flex">
                                          @if ( basic_settings_permissions() )
                                              <a href="{{ route('organizationA.registration-fees.edit', $fee->id) }}" title="Edit" class="btn btn-primary mx-2"><i class="fa fa-edit"></i></a>
                                              <form class="deleteOrganzationFee" method="post">
                                                @csrf
                                                @method('Delete')
                                                <input type="hidden" class="deleteUrl" name="delete_url" value="{{route('organizationA.registration-fees.destroy', $fee->id)}}">
                                                <button type="submit" class="btn btn-danger mx-2" title="Delete"><i class="fa fa-trash"></i></button>
                                              </form>
                                          @endif
                                      </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                @endif

                              </tbody>

                            </table>
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

