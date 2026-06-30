@extends('frontend.master')
@section('title', 'Complete Your Booking')

@push('style')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    * { font-family: 'Inter', sans-serif; }

    /* ── Hero ── */
    .book-hero {
        background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #3949ab 100%);
        padding: 44px 0 68px;
        position: relative;
        overflow: hidden;
    }
    .book-hero::before {
        content: ''; position: absolute;
        top:-60px; right:-60px;
        width:280px; height:280px;
        border-radius:50%; background:rgba(255,255,255,0.05);
    }
    .book-hero h1 { color:#fff; font-size:1.75rem; font-weight:700; margin-bottom:6px; }
    .book-hero p  { color:rgba(255,255,255,0.72); font-size:14px; }
    .book-hero .breadcrumb-item, .book-hero .breadcrumb-item a { color:rgba(255,255,255,0.6); font-size:12px; text-decoration:none; }
    .book-hero .breadcrumb-item.active { color:#fff; }
    .book-hero .breadcrumb-item + .breadcrumb-item::before { color:rgba(255,255,255,0.35); }

    /* ── Layout ── */
    .book-section {
        background: #f5f6fa;
        padding: 0 0 64px;
        margin-top: -32px;
    }

    /* ── Panel ── */
    .book-panel {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .book-panel-header {
        background: linear-gradient(135deg, #3949ab, #5c6bc0);
        padding: 20px 24px;
    }
    .book-panel-header h5 { color:#fff; font-size:15px; font-weight:700; margin:0; }
    .book-panel-header p  { color:rgba(255,255,255,0.75); font-size:12px; margin:4px 0 0; }
    .book-panel-body { padding: 24px; }

    /* ── Summary items ── */
    .summary-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 0;
        border-bottom: 1px solid #f5f5f5;
        font-size: 13.5px;
    }
    .summary-item:last-child { border-bottom: none; }
    .summary-item .lbl { color: #757575; font-weight: 500; display:flex; align-items:center; gap:8px; }
    .summary-item .lbl i { width:18px; text-align:center; color:#9e9e9e; }
    .summary-item .val { font-weight: 600; color: #1a1a2e; text-align:right; }
    .badge-type {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-emergency { background:#fce4ec; color:#c62828; }
    .badge-regular   { background:#e8f5e9; color:#2e7d32; }

    /* ── Divider with label ── */
    .divider-label {
        display: flex; align-items: center; gap: 12px;
        margin: 6px 0 20px;
    }
    .divider-label::before, .divider-label::after {
        content: ''; flex: 1; height: 1px; background: #eeeeee;
    }
    .divider-label span {
        font-size: 10.5px; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase;
        color: #9e9e9e;
        white-space: nowrap;
    }

    /* ── Form ── */
    .form-panel {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        overflow: hidden;
    }
    .form-panel-header {
        padding: 20px 28px;
        border-bottom: 1px solid #f0f0f0;
    }
    .form-panel-header h5 { font-size:15px; font-weight:700; color:#1a1a2e; margin:0; }
    .form-panel-header p  { font-size:12px; color:#9e9e9e; margin:4px 0 0; }
    .form-panel-body { padding: 24px 28px; }

    /* ── Material input ── */
    .mat-group { position: relative; margin-bottom: 22px; }
    .mat-group label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #616161;
        margin-bottom: 6px;
        letter-spacing: 0.2px;
    }
    .mat-group label .req { color: #e53935; margin-left: 2px; }
    .mat-input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 13.5px;
        color: #1a1a2e;
        background: #fafafa;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        outline: none;
    }
    .mat-input:focus {
        border-color: #3949ab;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(57,73,171,0.1);
    }
    .mat-input::placeholder { color: #bdbdbd; }

    /* ── Submit button ── */
    .btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #3949ab, #5c6bc0);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0.3px;
        cursor: pointer;
        transition: all 0.25s;
        position: relative;
        overflow: hidden;
    }
    .btn-submit:hover {
        background: linear-gradient(135deg, #283593, #3949ab);
        box-shadow: 0 8px 24px rgba(57,73,171,0.35);
        transform: translateY(-1px);
    }
    .btn-submit:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }

    /* ── Security note ── */
    .secure-note {
        text-align: center;
        font-size: 11.5px;
        color: #9e9e9e;
        margin-top: 14px;
    }
    .secure-note i { color: #43a047; margin-right: 4px; }

    /* ── Animations ── */
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(18px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .anim { animation: fadeUp 0.35s ease both; }
    .anim-d1 { animation-delay: 0.05s; }
    .anim-d2 { animation-delay: 0.13s; }
</style>
@endpush

@section('content')
<div class="content-wrapper" style="background:#f5f6fa; min-height:100vh;">

    {{-- Hero --}}
    <div class="book-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('appointment.officers') }}">Officers</a></li>
                    <li class="breadcrumb-item active">Book</li>
                </ol>
            </nav>
            <h1><i class="fas fa-file-signature me-2"></i> Complete Your Booking</h1>
            <p>Fill in your information below to confirm the appointment.</p>
        </div>
    </div>

    {{-- Content --}}
    <div class="book-section">
        <div class="container" style="margin-top:-16px;">
            <div class="row g-4">

                {{-- Sidebar: Summary --}}
                <div class="col-md-4 anim anim-d1">

                    <div class="book-panel mb-4">
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
                                    <span class="badge-type {{ $slot->slot_type == 'emergency' ? 'badge-emergency' : 'badge-regular' }}">
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
                    <div style="background:#e8eaf6; border-left:3px solid #3949ab; border-radius:8px; padding:14px 16px; font-size:12.5px; color:#3949ab; line-height:1.6;">
                        <strong><i class="fas fa-info-circle me-1"></i> Important</strong><br>
                        Please bring a valid ID (NID/Birth Certificate) when visiting. Arrive 10 minutes before your scheduled time.
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
                                <input type="hidden" name="slot_id" value="{{ $slot->id }}">

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
                                                   placeholder="01XXXXXXXXX" required>
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
