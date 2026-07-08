@extends('backend.master', ['mainMenu' => 'Inquiry', 'subMenu' => 'FormList'])
@push('style')
@endpush
@section('title', 'Form List')
@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="cioas-panel-title"><i class="fas fa-question"></i> Inquiry List</h3>
                    </div>

                    <div class="cioas-panel-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush