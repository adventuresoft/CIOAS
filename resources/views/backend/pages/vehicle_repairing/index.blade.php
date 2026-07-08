@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleRepairingList'])

@push('style')
@endpush

@section('title', 'Vehicle Repairing')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <!-- Alert Notifications -->
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #10b981;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #ef4444;">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-tools"></i> Vehicle Repairing List
                    </h3>
                    <a href="{{ route('vehicle.repairing.create') }}" class="btn btn-material btn-material-primary" style="background-color: #0f766e; border-color: #0f766e; color: white;">
                        <i class="fas fa-plus-circle"></i> Add New Repairing
                    </a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', '.delete-form-confirm', function (e) {
                e.preventDefault();
                var form = this;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this repairing record permanently?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
