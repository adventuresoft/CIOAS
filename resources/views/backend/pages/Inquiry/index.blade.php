@extends('backend.master', ['mainMenu' => 'Inquiry', 'subMenu' => 'InquiryList'])
@push('style')
@endpush
@section('title', 'Inquiry List')

@section('content')
    <section class="content">
        <div class="section-header">
            <h1>Sub Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Sub categories</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function () {

        });
    </script>
@endpush