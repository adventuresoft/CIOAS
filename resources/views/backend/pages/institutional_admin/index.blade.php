@extends('backend.master', ['mainMenu' => 'Admin', 'subMenu' => 'AdminList'])
@push('style')
@endpush
@section('title', 'Institutional Admin List')
@section('content')

  <section class="content mt-4">
    <div class="container-fluid">
      <div class="card cioas-shell">
        <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
          <h3 class="card-title text-dark font-weight-bold mb-0">
            <i class="fas fa-users text-teal mr-2" style="color: #0f766e;"></i> Institutional Admin List
          </h3>
          <a href="{{route('institutional-admin.create')}}" class="btn btn-sm"
            style="background-color: #0f766e; color: white; border-radius: 6px; font-weight: 600; padding: 0.4rem 1rem;">
            <i class="fas fa-plus-circle mr-1"></i> Create Admin
          </a>
        </div>

        <div class="card-body p-4">
          <div class="table-responsive">
            {{ $dataTable->table(['class' => 'table table-hover w-100']) }}
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@push('script')
  {{ $dataTable->scripts() }}
@endpush