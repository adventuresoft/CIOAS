@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleRepairingCreate'])
@section('title', 'Add Vehicle Repairing')
@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .vehicle-details-card {
            background: #f8f9fa;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            margin-bottom: 20px;
            display: none;
        }
    </style>
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Vehicle Repairing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('vehicle.repairing.index') }}">Vehicle Repairing</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Repairing Details Form</h3>
                        </div>
                        <form id="vehicleRepairingForm" action="{{ route('vehicle.repairing.store') }}" method="POST">
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
                                        <label for="repair_date">Repair Date <span class="text-danger">*</span></label>
                                        <input type="date" name="repair_date" id="repair_date" class="form-control" required value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="repair_type">Vehicle Repair Type <span class="text-danger">*</span></label>
                                        <select name="repair_type" id="repair_type" class="form-control select2" required>
                                            <option value="">Select Repair Type</option>
                                            <option value="Engine Repair">Engine Repair</option>
                                            <option value="Body Repair">Body Repair</option>
                                            <option value="Electrical">Electrical</option>
                                            <option value="Suspension">Suspension</option>
                                            <option value="Brake System">Brake System</option>
                                            <option value="Tire & Wheel">Tire & Wheel</option>
                                            <option value="AC & Heating">AC & Heating</option>
                                            <option value="Regular Maintenance">Regular Maintenance</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="spare_parts">Vehicle Spare Parts</label>
                                        <select name="spare_parts" id="spare_parts" class="form-control select2">
                                            <option value="">Select Spare Parts</option>
                                            <option value="Engine Oil">Engine Oil</option>
                                            <option value="Brake Pad">Brake Pad</option>
                                            <option value="Tire">Tire</option>
                                            <option value="Battery">Battery</option>
                                            <option value="Air Filter">Air Filter</option>
                                            <option value="Oil Filter">Oil Filter</option>
                                            <option value="Spark Plug">Spark Plug</option>
                                            <option value="Headlight Bulb">Headlight Bulb</option>
                                            <option value="Windshield Wiper">Windshield Wiper</option>
                                            <option value="None">None</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="workshop_name">Workshop/Garage Name</label>
                                        <input type="text" name="workshop_name" id="workshop_name" class="form-control" placeholder="Enter workshop name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="cost">Total Cost (Tk.) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="cost" id="cost" class="form-control" required placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Repairing Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="3" required placeholder="Describe what was repaired..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="remarks">Remarks/Notes</label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="2" placeholder="Any additional notes..."></textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer text-right">
                                <a href="{{ route('vehicle.repairing.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Submit Record</button>
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
            $('#vehicleRepairingForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let btn = $('#submitBtn');
                
                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: form.serialize(),
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');
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
                        btn.prop('disabled', false).html('Submit Record');
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
