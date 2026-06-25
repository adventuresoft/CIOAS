@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Pourashava'])
@section('title', 'Pourashava List')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pourashava List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('basic-settings.pourashava.index') }}">Basic Settings</a></li>
                    <li class="breadcrumb-item active">Pourashava</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content cioas-page pt-3">
    <div class="container-fluid">
        <div class="cioas-shell">
            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-list"></i> Pourashava List
                    </h3>
                    <a href="{{ route('basic-settings.pourashava.create') }}" class="btn btn-material btn-material-primary">
                        <i class="fas fa-plus-circle"></i> Create Pourashava
                    </a>
                </div>

                <div class="cioas-panel-body">
                    <div class="table-responsive">
                        {!! $dataTable->table(['class' => 'table table-bordered table-striped table-custom table-hover']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
{!! $dataTable->scripts() !!}
<script>
    $(document).ready(function() {
        // Delete record AJAX handler
        $(document).on('submit', '.deleteData', function(e) {
            e.preventDefault();
            let form = $(this);
            let url = form.find('.deleteUrl').val();
            let redirect = form.find('.redirect-url').val();
            
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            if (window.LaravelDataTables && window.LaravelDataTables["pourashava-table"]) {
                                window.LaravelDataTables["pourashava-table"].ajax.reload();
                            } else {
                                window.location.href = redirect;
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Failed to delete.');
                    }
                });
            }
        });
    });
</script>
@endpush