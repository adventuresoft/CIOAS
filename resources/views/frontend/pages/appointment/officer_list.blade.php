@extends('frontend.master')
@section('title', 'Book Appointment - Officers')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* ── Hero Banner ── */
        .appt-hero {
            background: linear-gradient(135deg, #064e3b 0%, #047857 40%, #10b981 100%);
            padding: 56px 0 72px;
            position: relative;
            overflow: hidden;
        }

        .appt-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .appt-hero::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .appt-hero h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .appt-hero p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1rem;
        }

        .appt-hero .breadcrumb-item,
        .appt-hero .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.65);
            font-size: 13px;
            text-decoration: none;
        }

        .appt-hero .breadcrumb-item.active {
            color: #fff;
        }

        .appt-hero .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.4);
        }

        /* ── Section ── */
        .officers-section {
            background: #f5f6fa;
            padding: 48px 0 64px;
            margin-top: -32px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #10b981;
            margin-bottom: 6px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a2e;
        }

        .officer-count {
            background: #ecfdf5;
            color: #10b981;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ── Officer Card ── */
        .officer-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            cursor: pointer;
            position: relative;
        }

        .officer-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(57, 73, 171, 0.18);
        }

        .officer-card-accent {
            height: 6px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
        }

        .officer-card-body {
            padding: 28px 24px 24px;
            text-align: center;
        }

        .officer-avatar-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 16px;
        }

        .officer-avatar {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid #ecfdf5;
            box-shadow: 0 4px 12px rgba(57, 73, 171, 0.15);
        }

        .officer-status-dot {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #43a047;
            border: 2px solid #fff;
        }

        .officer-name {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .officer-designation {
            font-size: 12.5px;
            color: #34d399;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .officer-dept {
            font-size: 11.5px;
            color: #9e9e9e;
            margin-bottom: 20px;
        }

        .officer-dept i {
            color: #bdbdbd;
            margin-right: 4px;
        }

        /* ── Book Button ── */
        .btn-book {
            display: block;
            width: 100%;
            padding: 10px 0;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-decoration: none;
            text-align: center;
            transition: background 0.25s, box-shadow 0.25s;
            position: relative;
            overflow: hidden;
        }

        .btn-book:hover {
            background: linear-gradient(135deg, #047857, #10b981);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
            color: #fff;
        }

        .btn-book i {
            margin-right: 6px;
        }

        /* ── Empty State ── */
        .empty-officers {
            text-align: center;
            padding: 64px 20px;
            color: #9e9e9e;
        }

        .empty-officers i {
            font-size: 48px;
            color: #e0e0e0;
            margin-bottom: 16px;
        }

        .empty-officers h5 {
            color: #757575;
            font-weight: 600;
        }

        /* ── Ripple ── */
        .btn-book .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-anim 0.5s linear;
            pointer-events: none;
        }

        @keyframes ripple-anim {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* ── Fade-in card animation ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .officer-col {
            animation: fadeUp 0.4s ease both;
        }

        .officer-col:nth-child(1) {
            animation-delay: 0.05s;
        }

        .officer-col:nth-child(2) {
            animation-delay: 0.12s;
        }

        .officer-col:nth-child(3) {
            animation-delay: 0.19s;
        }

        .officer-col:nth-child(4) {
            animation-delay: 0.26s;
        }

        .officer-col:nth-child(5) {
            animation-delay: 0.33s;
        }

        .officer-col:nth-child(6) {
            animation-delay: 0.40s;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper" style="background:#f5f6fa; min-height:100vh;">

        {{-- Hero --}}


        {{-- Officers Grid --}}
        <div class="officers-section">
            <div class="container">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <p class="section-label mb-1">Available Officers</p>
                        <h2 class="section-title mb-0 mt-3">Book Your Appointment</h2>
                    </div>
                    <span class="officer-count">
                        <i class="fas fa-user-tie me-1"></i>{{ count($officers) }}
                        Officer{{ count($officers) != 1 ? 's' : '' }}
                    </span>
                </div>

                @if($officers && count($officers) > 0)
                    <div class="row">
                        @foreach($officers as $officer)
                            <div class="col-md-3 col-sm-4 mb-3 officer-col">
                                <div class="officer-card">
                                    <div class="officer-card-accent"></div>
                                    <div class="officer-card-body">
                                        <div class="officer-avatar-wrap">
                                            <img src="{{ $officer->image ? asset($officer->image) : 'https://ui-avatars.com/api/?name=' . urlencode($officer->name) . '&background=3949ab&color=fff&size=90' }}"
                                                class="officer-avatar" alt="{{ $officer->name }}"
                                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($officer->name) }}&background=3949ab&color=fff&size=90'">
                                            <span class="officer-status-dot"></span>
                                        </div>
                                        <div class="officer-name">{{ $officer->name }}</div>
                                        <div class="officer-designation">{{ $officer->designation ?? 'Department Head' }}
                                        </div>
                                        <div class="officer-dept">
                                            <i class="fas fa-building"></i>
                                            {{ $officer->department->name ?? 'DC' }}
                                        </div>
                                        <a href="{{ route('appointment.calendar', $officer->id) }}" class="btn-book">
                                            <i class="fas fa-calendar-check"></i> Book Appointment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-officers">
                        <i class="fas fa-user-slash d-block"></i>
                        <h5 class="mt-2">No Officers Available</h5>
                        <p>There are currently no officers available for booking. Please check back later.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Ripple effect on book buttons
        document.querySelectorAll('.btn-book').forEach(btn => {
            btn.addEventListener('click', function (e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                this.appendChild(ripple);
                ripple.addEventListener('animationend', () => ripple.remove());
            });
        });
    </script>
@endpush