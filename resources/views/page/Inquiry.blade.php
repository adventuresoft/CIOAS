@extends('frontend.master')

@section('title', 'জিজ্ঞাসা আবেদন')

@push('style')
<style>
    .inquiry-form-card {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .file-upload-box {
        border: 2px dashed #ddd;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    .file-upload-box:hover {
        border-color: #0d6efd;
        background: #f8f9fa;
    }
    .file-upload-icon {
        font-size: 40px;
        color: #ffc107;
        margin-bottom: 10px;
    }
    .btn-submit-inquiry {
        background-color: #007bff;
        border-color: #007bff;
        font-size: 18px;
        font-weight: 500;
        border-radius: 5px;
    }
    .btn-submit-inquiry:hover {
        background-color: #0056b3;
    }
</style>
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-desktop me-2"></i> জিজ্ঞাসা আবেদন
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Inquiry</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="card inquiry-form-card shadow-sm border-0">
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('inquiry.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">জিজ্ঞাসার বিষয়: <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" placeholder="জিজ্ঞাসার বিষয়" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">জিজ্ঞাসার বিস্তারিত:</label>
                        <textarea name="details" class="form-control" rows="1" placeholder="জিজ্ঞাসার বিস্তারিত:"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">আবেদনকারীর নাম: <span class="text-danger">*</span></label>
                        <input type="text" name="applicant_name" class="form-control" placeholder="আবেদনকারীর নাম" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">পিতার নাম:</label>
                        <input type="text" name="father_name" class="form-control" placeholder="পিতার নাম">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">জাতীয় পরিচয়পত্র নম্বর:</label>
                        <input type="text" name="nid_number" class="form-control" placeholder="জাতীয় পরিচয়পত্র">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">মোবাইল নম্বর: <span class="text-danger">*</span></label>
                        <input type="text" name="mobile_number" class="form-control" placeholder="মোবাইল" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ই-মেইল:</label>
                        <input type="email" name="email" class="form-control" placeholder="ই-মেইল">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ঠিকানা:</label>
                        <input type="text" name="address" class="form-control" placeholder="ঠিকানা">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <label class="form-label d-block text-center">প্রমাণ স্বরূপ কোনো ফাইল</label>
                        <div class="file-upload-box" onclick="document.getElementById('proof_file').click()">
                            <i class="fas fa-user-circle file-upload-icon text-warning"></i>
                            <div class="mt-2 text-muted fw-bold">ফাইল নির্বাচন করুন</div>
                            <input type="file" name="proof_file" id="proof_file" class="d-none">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 btn-submit-inquiry">
                    <i class="fas fa-paper-plane me-2"></i> আবেদনটি নিশ্চিত করুন
                </button>
            </form>
        </div>
    </div>
        </div>
    </section>
</div>
@endsection
