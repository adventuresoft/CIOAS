@extends('frontend.master')
@section('title', 'Book Appointment - Officers')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
@endpush

@section('content')
    <div class="content-wrapper" style="background:#f5f6fa; min-height:100vh;">

        {{-- Hero --}}


        {{-- Officers Grid --}}
        <div class="officers-section">
            <div class="container">

                <div class="d-d-flex align-align-items-center justify-content-between mb-3">
                    <div>
                        <p class="section-label mb-1">Available Officers</p>
                        <h2 class="section-title mb-0">Book Your Appointment</h2>
                    </div>
                    <span class="officer-count">
                        <i class="fas fa-user-tie me-1"></i>{{ count($officers) }}
                        Officer{{ count($officers) != 1 ? 's' : '' }}
                    </span>
                </div>

                @if($officers && count($officers) > 0)
                    <div class="row">
                        @foreach($officers as $officer)
                            <div class="col-md-4 col-sm-6 mb-3 officer-col">
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
                                        <div class="officer-designation">{{ $officer->section->name ?? 'District Official' }}
                                        </div>
                                        <div class="officer-dept">
                                            <i class="fas fa-building"></i>
                                            {{ $officer->department->name ?? 'Government Office' }}
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
                        <i class="fas fa-user-slash d-d-block"></i>
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