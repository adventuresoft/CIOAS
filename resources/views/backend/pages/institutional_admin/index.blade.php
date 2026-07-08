@extends('backend.master', ['mainMenu' => 'Admin', 'subMenu' => 'AdminList'])
@push('style')
@endpush
@section('title', 'Institutional Admin List')
@section('content')

  <section class="content cioas-page pt-3">
    <div class="container-fluid">
      <div class="cioas-panel">
        <div class="cioas-panel-header">
          <h3 class="cioas-panel-title">
            <i class="fas fa-users"></i> Institutional Admin List
          </h3>
          <a href="{{route('institutional-admin.create')}}" class="btn btn-material btn-material-primary"
            style="background-color: #0f766e; border-color: #0f766e; color: white;">
            <i class="fas fa-plus-circle"></i> Create Admin
          </a>
        </div>

        <div class="cioas-panel-body">
          <div class="table-responsive">
            {{ $dataTable->table(['class' => 'table table-custom table-hover w-100']) }}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@push('script')
  {{ $dataTable->scripts() }}
@endpush