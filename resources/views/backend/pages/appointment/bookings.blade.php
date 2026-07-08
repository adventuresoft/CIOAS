@extends('backend.master', ['mainMenu' => 'Appointment', 'subMenu' => 'Bookings'])
@section('title', 'Appointment Bookings')
@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="cioas-panel-title"><i class="fas fa-calendar-check"></i> Appointment Bookings List</h3>
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover w-100']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for viewing details -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title"><i class="fas fa-info-circle text-primary"></i> Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success modal_btn update-status modal_app_btn"
                        data-status="Approved" data-url="">Accepted</button>
                    <button type="button" class="btn btn-danger modal_btn update-status" data-status="Rejected"
                        data-url="">Rejected</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).on('click', '.view-booking', function () {
            let id = $(this).data('id');
            let url = $(this).data('url');
            let status = $(this).data('status');

            $('.modal_btn').attr('data-url', url);
            $('.modal_app_btn').attr('data-status', status);
            if (status == 'Approved') {
                $('.modal_app_btn').text('Accepted');
            } else if (status == 'Completed') {
                $('.modal_app_btn').text('Completed');
            } else {
                $('.modal_btn').hide();
            }






            $('#viewModal').modal('show');
            $('#modalContent').html('<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i></div>');
            $.get('{{ url('dashboard/appointment-bookings') }}/' + id, function (data) {
                $('#modalContent').html(data);
            });
        });

        $(document).on('click', '.update-status', function () {
            let url = $(this).data('url');
            let status = $(this).data('status');

            if (confirm("Are you sure you want to change status to " + status + "?")) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function (res) {
                        toastr.success(res.message);
                        $('#viewModal').modal('hide');
                        window.LaravelDataTables['appointmentbooking-table'].ajax.reload();
                    },
                    error: function (err) {
                        toastr.error('Error updating status');
                    }
                });
            }
        });
    </script>
@endpush