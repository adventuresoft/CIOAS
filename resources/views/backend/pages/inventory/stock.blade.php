@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryStock'])

@push('style')
@endpush

@section('title', 'Stock Details')

@section('content')
    <section class="content cioas-page pt-4">
        <div class="container-fluid">
            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-warehouse"></i> Stock Details
                    </h3>
                </div>
                <div class="cioas-panel-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-custom table-hover w-100']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
@endpush
