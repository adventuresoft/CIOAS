@extends('frontend.master')
@section('title', 'Book Appointment Form')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <h2 class="mb-0 pb-3 text-2xl"><i class="fas fa-file-signature me-2"></i> Complete Your Booking</h2>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-info-circle text-primary me-2"></i> Appointment Summary</h5>
                            <hr>
                            <p class="mb-2"><strong>Officer:</strong> <span class="float-end">{{ $slot->officer->name }}</span></p>
                            <p class="mb-2"><strong>Date:</strong> <span class="float-end">{{ date('d M, Y', strtotime($slot->slot_date)) }}</span></p>
                            <p class="mb-2"><strong>Type:</strong> <span class="float-end badge bg-{{ $slot->slot_type == 'emergency' ? 'danger' : 'success' }}">{{ ucfirst($slot->slot_type) }}</span></p>
                            @if($slot->slot_type == 'regular')
                            <p class="mb-0"><strong>Time:</strong> <span class="float-end">{{ date('h:i A', strtotime($slot->start_time)) }}</span></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm border-0" style="border-radius: 12px;">
                        <div class="card-body p-4">
                            <form id="bookingForm">
                                @csrf
                                <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" class="form-control" value="{{ auth()->check() ? auth()->user()->mobile : '' }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NID Number <span class="text-danger">*</span></label>
                                        <input type="text" name="nid_number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Purpose <span class="text-danger">*</span></label>
                                        <select name="purpose" class="form-control" required>
                                            <option value="">Select Purpose</option>
                                            <option value="Public Complaint">Public Complaint</option>
                                            <option value="Land Related Issue">Land Related Issue</option>
                                            <option value="Trade License">Trade License</option>
                                            <option value="Citizen Service">Citizen Service</option>
                                            <option value="Legal Matter">Legal Matter</option>
                                            <option value="Emergency Administrative Issue">Emergency Administrative Issue</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fs-5"><i class="fas fa-paper-plane me-2"></i> Submit Booking Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
<script>
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $(this).find('button[type="submit"]');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');
        
        $.ajax({
            url: '{{ route('appointment.store') }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if(res.status) {
                    toastr.success(res.message);
                    setTimeout(() => { window.location.href = res.redirect_url; }, 1500);
                }
            },
            error: function(err) {
                btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i> Submit Booking Request');
                let response = err.responseJSON;
                toastr.error(response.message || 'Something went wrong');
            }
        });
    });
</script>
@endpush
