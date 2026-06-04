@extends('frontend.master')
@section('title', 'Book Appointment - Officers')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <h2 class="mb-0 pb-3 text-2xl"><i class="fas fa-users me-2"></i> Select Officer for Appointment</h2>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                @foreach($officers as $officer)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                        <div class="card-body text-center p-4">
                            <img src="{{ $officer->image ? asset($officer->image) : asset('public/no-image-found.jpeg') }}" class="rounded-circle mb-3 border shadow-sm" width="120" height="120" style="object-fit:cover;">
                            <h4 class="mb-1 fw-bold">{{ $officer->name }}</h4>
                            <p class="text-muted mb-3">{{ $officer->designation ?? 'District Official' }}</p>
                            <a href="{{ route('appointment.calendar', $officer->id) }}" class="btn btn-primary w-100 rounded-pill py-2">
                                <i class="fas fa-calendar-check me-2"></i> Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
