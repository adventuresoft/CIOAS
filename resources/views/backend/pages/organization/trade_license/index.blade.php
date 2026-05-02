@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])

@push('style')

<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endpush

@section('title', 'Organization Trade License')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">
        <h1>Organization Trade License List</h1>
      </div>

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{route('organizationA.trade-license.index')}}">Trade License List</a>
          </li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </div>

    </div>
  </div>
</section>


<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card card-info">

          <div class="card-header">

            <div class="row">

              <div class="col-md-6 text-left">
                <h3 class="card-title">Organization List</h3>
              </div>

              <div class="col-md-6 text-right">
                <a href="{{route('organizationA.trade-license.create')}}" class="btn btn-primary">Create</a>
              </div>

            </div>

          </div>


          <div class="card-body">

            <div class="row mb-3">

              <div class="col-md-3">
                <select id="statusFilter" class="form-control">
                  <option value="">All Status</option>
                  <option value="Pending">Pending</option>
                  <option value="Approved">Approved</option>
                </select>
              </div>

            </div>


            <table id="example1" class="table table-bordered table-striped">

              <thead>

                <tr>
                  <th>Sl.</th>
                  <th>Tax Year</th>
                  <th>Organization Name</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>

              </thead>

              <tbody>

                @if (count($trade_licenses))

                @foreach ($trade_licenses as $key=>$license)

                <tr>

                  <td>{{++$key}}</td>

                  <td>{{$license->taxYear->name}}</td>

                  <td>{{$license->organization->name}}</td>

                  <td>{{$license->organization->category->en_name}}</td>

                  <td>{{$license->organization->subcategory->en_name}}</td>

                  <td>{{date('d-m-Y', strtotime($license->updated_at))}}</td>

                  <td>

                    @if ($license->status == 1)

                    <label class="badge badge-info">Pending</label>

                    @elseif($license->status == 2)

                    <label class="badge badge-success">Approved</label>

                    @endif

                  </td>

                  <td>

                    <div class="table-action">

                      <a href="{{route('organizationA.trade-license.confirmed', $license->id )}}"
                        title="Confirmed"
                        class="btn btn-sm btn-info">
                        <i class="fa fa-hand-holding-usd"></i>
                      </a>
                      
                      
                       <a href="{{route('organizationA.trade-license.show', $license->id )}}"
                        title="Show"
                        class="btn btn-sm btn-success">
                        <i class="fa fa-eye"></i>
                      </a>
                      

                      <a target="_blank"
                        href="{{ $license->status == 2 ? route('organizationA.trade-license.preview', $license->id) :'#' }}"
                        title="Print"
                        class="btn btn-sm btn-primary">

                        <i class="fa fa-print"></i>

                      </a>

                    </div>

                  </td>

                </tr>

                @endforeach

                @endif

              </tbody>

            </table>

          </div>


        </div>

      </div>
    </div>

  </div>
</section>

@endsection



@push('script')

<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script>
  $(function() {

    var table = $("#example1").DataTable({

      responsive: true,
      autoWidth: false,
      pageLength: 10,
      ordering: true,
      searching: true

    });


    $('#statusFilter').on('change', function() {

      table.column(6).search(this.value).draw();

    });

  });
</script>

@endpush