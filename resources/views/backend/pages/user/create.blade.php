@extends('backend.master', ['mainMenu' => 'AccessManagment', 'subMenu' => 'role'])

@section('title', 'Register New Authorized Operator')

@push('style')
<style>
    /* Premium Page Styling */
    .premium-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        background: #fff;
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .premium-card .card-header {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 18px 24px;
    }
    
    .premium-card .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control-premium {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 12px 16px;
        font-size: 0.95rem;
        color: #334155;
        transition: all 0.2s ease;
        height: auto;
    }

    .form-control-premium:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        color: #0f172a;
    }

    .form-label-premium {
        font-weight: 700;
        color: #1e293b;
        font-size: 0.92rem;
        margin-bottom: 8px;
    }

    /* Custom Radio styling */
    .status-radio-label {
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4" style="min-height: 1000px;">
    
    <!-- Top Tabs Navigation -->
    @include('backend.pages.access-nav-tabs')

    <!-- Alert Notifications -->
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert" style="border-left: 5px solid #ef4444;">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card premium-card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-plus text-primary"></i> 
                Register New Authorized Operator
            </h3>
        </div>

        <form role="form" method="POST" action="{{ route('user.store') }}">
            @csrf
            
            <div class="card-body">
                <div class="row">
                    <!-- Left Side: Basic Profile Information (Image 3) -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="name">Full Name</label>
                                <input type="text" name="name" id="name" 
                                       class="form-control form-control-premium @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       placeholder="Enter Full Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="email">Email Address</label>
                                <input type="email" name="email" id="email" 
                                       class="form-control form-control-premium @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="email@example.com" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="mobile">Contact Number</label>
                                <input type="text" name="mobile" id="mobile" 
                                       class="form-control form-control-premium @error('mobile') is-invalid @enderror" 
                                       value="{{ old('mobile') }}" 
                                       placeholder="e.g. 01700000000" required>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="institute_id">Assigned Area</label>
                                <select name="institute_id" id="institute_id" 
                                        class="form-control form-control-premium @error('institute_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>-- Select Area --</option>
                                    @foreach($institutes as $institute)
                                        @php
                                            $name = 'Area ID: ' . $institute->id;
                                            if ($institute->union) {
                                                $name = 'Union: ' . $institute->union->name;
                                            } elseif ($institute->pourashava) {
                                                $name = 'Pourashava: ' . $institute->pourashava->name;
                                            } elseif ($institute->cityCorporation) {
                                                $name = 'City Corporation: ' . $institute->cityCorporation->name;
                                            }
                                        @endphp
                                        <option value="{{ $institute->id }}" {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('institute_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="password">Access Password</label>
                                <input type="password" name="password" id="password" 
                                       class="form-control form-control-premium @error('password') is-invalid @enderror" 
                                       placeholder="Minimum 6 characters" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label class="form-label-premium" for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control form-control-premium" 
                                       placeholder="Repeat password" required>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Security Identity & Account Status (Image 3) -->
                    <div class="col-md-4 border-left pl-md-4">
                        <!-- Security Identity -->
                        <div class="mb-4">
                            <h5 class="font-weight-bold text-dark mb-3">
                                <i class="fas fa-shield-alt text-secondary mr-1"></i> Security Identity
                            </h5>
                            
                            <div class="form-group mb-3">
                                <label class="form-label-premium" for="role_id">Primary Security Role</label>
                                <select name="role_id" id="role_id" 
                                        class="form-control form-control-premium @error('role_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select a Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted mt-2 d-block">
                                    Users inherit all capabilities assigned to their chosen role. Direct overrides are disabled for simplicity.
                                </small>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Account Status -->
                        <div class="mb-4">
                            <label class="form-label-premium">Account Status</label>
                            
                            <div class="form-check pl-0">
                                <label class="status-radio-label text-success">
                                    <input type="radio" name="status" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                                    Verified / Active
                                </label>
                            </div>
                            
                            <div class="form-check pl-0">
                                <label class="status-radio-label text-warning">
                                    <input type="radio" name="status" value="0" style="width: 18px; height: 18px; cursor: pointer;">
                                    Pending Review
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="card-footer bg-white border-top-0 d-flex justify-content-start pb-4 px-4">
                <button type="submit" class="btn btn-primary btn-premium px-5 py-2 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-check-circle mr-1"></i> Register Operator</button>
                <a href="{{ route('user.index') }}" class="btn btn-light btn-premium ml-3 px-4 py-2 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-times-circle mr-1"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection