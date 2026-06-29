@extends('frontend.master')
@section('title', 'Complete Your Booking')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
@endpush

@section('content')
    <div class="content-wrapper" style="background:#f5f6fa; min-height:100vh;">


        {{-- Content --}}
        <div class="book-section">
            <div class="container" style="margin-top:-16px;">
                <div class="row g-4">

                    {{-- Sidebar: Summary --}}
                    <div class="col-md-4 anim anim-d1">

                        <div class="book-panel mb-3">
                            <div class="book-panel-header">
                                <h5><i class="fas fa-clipboard-list me-2"></i> Appointment Summary</h5>
                                <p>Review your appointment details</p>
                            </div>
                            <div class="book-panel-body">
                                <div class="summary-item">
                                    <span class="lbl"><i class="fas fa-user-tie"></i> Officer</span>
                                    <span class="val">{{ $slot->officer->name }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="lbl"><i class="fas fa-calendar"></i> Date</span>
                                    <span class="val">{{ date('d M, Y', strtotime($slot->slot_date)) }}</span>
                                </div>
                                <div class="summary-item">
                                    <span class="lbl"><i class="fas fa-tag"></i> Type</span>
                                    <span class="val">
                                        <span
                                            class="badge-type {{ $slot->slot_type == 'emergency' ? 'badge-emergency' : 'badge-regular' }}">
                                            {{ ucfirst($slot->slot_type) }}
                                        </span>
                                    </span>
                                </div>
                                @if($slot->slot_type == 'regular')
                                    <div class="summary-item">
                                        <span class="lbl"><i class="far fa-clock"></i> Time</span>
                                        <span class="val">{{ date('h:i A', strtotime($slot->start_time)) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Help note --}}
                        <div
                            style="background:#e8eaf6; border-left:3px solid #3949ab; border-radius:8px; padding:14px 16px; font-size:12.5px; color:#3949ab; line-height:1.6;">
                            <strong><i class="fas fa-info-circle me-1"></i> Important</strong><br>
                            Please bring a valid ID (NID/Birth Certificate) when visiting. Arrive 10 minutes before your
                            scheduled time.
                        </div>

                    </div>

                    {{-- Main: Form --}}
                    <div class="col-md-8 anim anim-d2">
                        <div class="form-panel">
                            <div class="form-panel-header">
                                <h5><i class="fas fa-id-card me-2 text-primary"></i> Your Information</h5>
                                <p>All fields marked with <span style="color:#e53935;">*</span> are required.</p>
                            </div>
                            <div class="form-panel-body">
                                <form id="bookingForm">
                                    @csrf
                                    <input type="d-none" name="slot_id" value="{{ $slot->id }}">

                                    <div class="divider-label"><span>Personal Details</span></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>Full Name <span class="req">*</span></label>
                                                <input type="text" name="name" class="mat-input"
                                                    value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                                    placeholder="Enter your full name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>Phone Number <span class="req">*</span></label>
                                                <input type="text" name="phone" class="mat-input"
                                                    value="{{ auth()->check() ? auth()->user()->mobile : '' }}"
                                                    placeholder="01XXXXXXXXX" required {{ auth()->check() ? 'readonly' : '' }}>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="mat-input"
                                                    value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                                    placeholder="email@example.com">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>NID Number <span class="req">*</span></label>
                                                <input type="text" name="nid_number" class="mat-input"
                                                    placeholder="National ID number" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>Date of Birth <span class="req">*</span></label>
                                                <input type="date" name="date_of_birth" class="mat-input" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mat-group">
                                                <label>Purpose of Visit <span class="req">*</span></label>
                                                <select name="purpose" class="mat-input" required>
                                                    <option value="">— Select Purpose —</option>
                                                    <option>Public Complaint</option>
                                                    <option>Land Related Issue</option>
                                                    <option>Trade License</option>
                                                    <option>Citizen Service</option>
                                                    <option>Legal Matter</option>
                                                    <option>Emergency Administrative Issue</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="divider-label"><span>Additional Info</span></div>

                                    <div class="mat-group">
                                        <label>Address <span class="req">*</span></label>
                                        <textarea name="address" class="mat-input" rows="2"
                                            placeholder="Your current address" required></textarea>
                                    </div>

                                    <div class="mat-group">
                                        <label>Description / Remarks <span class="req">*</span></label>
                                        <textarea name="description" class="mat-input" rows="3"
                                            placeholder="Briefly describe the reason for your visit..." required></textarea>
                                    </div>

                                    <button type="submit" class="btn-submit" id="submitBtn">
                                        <i class="fas fa-paper-plane"></i>
                                        Submit Booking Request
                                    </button>
                                    <p class="secure-note mt-2">
                                        <i class="fas fa-lock"></i> Your information is safe and encrypted.
                                    </p>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#bookingForm').on('submit', function (e) {
            e.preventDefault();
            let btn = $('#submitBtn');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');

            $.ajax({
                url: '{{ route('appointment.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function (res) {
                    if (res.status) {
                        toastr.success(res.message);
                        setTimeout(() => { window.location.href = res.redirect_url; }, 1500);
                    }
                },
                error: function (err) {
                    btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i> Submit Booking Request');
                    let response = err.responseJSON;
                    toastr.error(response?.message || 'Something went wrong. Please try again.');
                }
            });
        });

        // Focus effect for inputs
        document.querySelectorAll('.mat-input').forEach(el => {
            el.addEventListener('focus', () => el.style.borderColor = '#3949ab');
            el.addEventListener('blur', () => {
                if (!el.value) el.style.borderColor = '#e0e0e0';
            });
        });
    </script>
@endpush