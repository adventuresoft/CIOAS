@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleFuelCreate'])
@section('title', 'Add Vehicle Fuel')
@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .vehicle-details-card {
            background: #f8f9fa;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
        }
    </style>
@endpush
@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Fuel Log Form</h3>
                        </div>
                        <form id="vehicleFuelForm" action="{{ route('vehicle.fuel.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="vehicle_id">Vehicle Registration No. <span class="text-danger">*</span></label>
                                        <select name="vehicle_id" id="vehicle_id" class="form-control select2" required>
                                            <option value="">Select Vehicle</option>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->registration_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="fuel_date">Date of Refueling <span class="text-danger">*</span></label>
                                        <input type="date" name="fuel_date" id="fuel_date" class="form-control" required value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="fuel_type">Fuel Type <span class="text-danger">*</span></label>
                                        <select name="fuel_type" id="fuel_type" class="form-control select2" required>
                                            <option value="">Select Fuel Type</option>
                                            <option value="Octane">Octane</option>
                                            <option value="Petrol">Petrol</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="CNG">CNG</option>
                                            <option value="LPG">LPG</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="quantity">Quantity (L/Kg) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="quantity" id="quantity" class="form-control" required placeholder="0.00">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="total_cost">Total Cost (Tk.) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="total_cost" id="total_cost" class="form-control" required placeholder="0.00">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="pump_name">Fuel Pump Name/Location</label>
                                        <input type="text" name="pump_name" id="pump_name" class="form-control" placeholder="Enter pump name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="odometer_reading">Odometer Reading (Km)</label>
                                        <input type="number" name="odometer_reading" id="odometer_reading" class="form-control" placeholder="Current meter reading">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="remarks">Remarks/Notes</label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="2" placeholder="Any additional notes..."></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <a href="{{ route('vehicle.fuel.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success" id="submitBtn">Save Fuel Log</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <!-- Select2 -->
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });



            // Form Submit via AJAX
            $('#vehicleFuelForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let btn = $('#submitBtn');
                
                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Added',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html('Save Fuel Log');
                        let errorMessage = 'An error occurred';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                            errorMessage = errors;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage,
                        });
                    }
                });
            });
        });
    </script>
@endpush
