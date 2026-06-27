@extends('backend.master', ['mainMenu' => 'license', 'subMenu' => 'LicenseList'])

@section('title', 'License List')

@section('content')


    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> License List
                        </h3>
                        @if (auth()->user()->can('license.create') || create_permission('license'))
                            <a href="{{ route('license.create') }}" class="btn btn-material btn-material-primary">
                                <i class="fas fa-plus-circle"></i> Create License
                            </a>
                        @endif
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-custom table-hover']) }}
                        </div>
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
            // Delete record AJAX handler
            $(document).on('submit', '.deleteData', function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.find('.deleteUrl').val();
                let redirect = form.find('.redirect-url').val();

                if (confirm('Are you sure you want to delete this license?')) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: form.serialize(),
                        success: function (response) {
                            if (response.status) {
                                toastr.success(response.message);
                                if (window.LaravelDataTables && window.LaravelDataTables["license-table"]) {
                                    window.LaravelDataTables["license-table"].ajax.reload();
                                } else {
                                    window.location.href = redirect;
                                }
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function () {
                            toastr.error('Failed to delete license.');
                        }
                    });
                }
            });
        });
    </script>
@endpush