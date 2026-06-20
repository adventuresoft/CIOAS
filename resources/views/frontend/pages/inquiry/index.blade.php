@extends('frontend.master')
@section('title', 'জিজ্ঞাসা আবেদন')

@push('style')
<style>
    /* Premium Smart Form Design System matching Bangladesh Gov Palette */
    .gov-form-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border-top: 5px solid #006a4e;
        overflow: hidden;
    }

    .gov-header {
        background: linear-gradient(135deg, #006a4e 0%, #00523b 100%);
        color: #ffffff;
        padding: 24px 30px;
        border-bottom: 3px solid #f42a41;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .gov-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .gov-body {
        padding: 35px;
    }

    .gov-body label:not(.form-check-label) {
        font-size: 0.85rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
        display: block;
    }

    .gov-body .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        min-height: 44px !important;
        font-size: 0.95rem !important;
        color: #1e293b !important;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }

    .gov-body .form-control:focus {
        border-color: #006a4e !important;
        box-shadow: 0 0 0 3px rgba(0, 106, 78, 0.15) !important;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 750;
        color: #006a4e;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 8px;
        margin-top: 35px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #f42a41;
    }

    .btn-gov-submit {
        background-color: #006a4e;
        color: #ffffff;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .btn-gov-submit:hover {
        background-color: #00523b;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 82, 59, 0.2);
    }

    .btn-gov-cancel {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease-in-out;
    }

    .btn-gov-cancel:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }
</style>
@endpush

@section('content')
<div class="container py-8">
    <div class="gov-form-container">
        <!-- Header -->
        <div class="gov-header">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-[#006a4e]">
                <i class="fas fa-desktop text-2xl"></i>
            </div>
            <div>
                <h2>জিজ্ঞাসা আবেদন ফরম</h2>
                <p class="text-xs text-green-100 mt-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার - কেন্দ্রীয় সমন্বিত অফিস অটোমেশন সিস্টেম</p>
            </div>
        </div>

        <!-- Form Body -->
        <div class="gov-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('inquiry.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label for="subject">জিজ্ঞাসার বিষয় <span class="text-danger">*</span></label>
                        <input type="text" required name="subject" placeholder="জিজ্ঞাসার বিষয়" class="form-control" id="subject">
                    </div>
                    <div class="col-md-8">
                        <label for="details">জিজ্ঞাসার বিস্তারিত</label>
                        <textarea name="details" placeholder="জিজ্ঞাসার বিস্তারিত" class="form-control" id="details" rows="1"></textarea>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label for="applicant_name">আবেদনকারীর নাম <span class="text-danger">*</span></label>
                        <input type="text" required name="applicant_name" placeholder="আবেদনকারীর নাম" class="form-control" id="applicant_name">
                    </div>
                    <div class="col-md-4">
                        <label for="father_name">পিতার নাম</label>
                        <input type="text" name="father_name" placeholder="পিতার নাম" class="form-control" id="father_name">
                    </div>
                    <div class="col-md-4">
                        <label for="nid_number">জাতীয় পরিচয়পত্র নম্বর</label>
                        <input type="text" name="nid_number" placeholder="জাতীয় পরিচয়পত্র নম্বর" class="form-control" id="nid_number">
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label for="mobile_number">মোবাইল নম্বর <span class="text-danger">*</span></label>
                        <input type="text" required name="mobile_number" placeholder="মোবাইল নম্বর" class="form-control" id="mobile_number">
                    </div>
                    <div class="col-md-4">
                        <label for="email">ই-মেইল</label>
                        <input type="email" name="email" placeholder="ই-মেইল" class="form-control" id="email">
                    </div>
                    <div class="col-md-4">
                        <label for="address">ঠিকানা</label>
                        <input type="text" name="address" placeholder="ঠিকানা" class="form-control" id="address">
                    </div>
                </div>

                <h5 class="section-title"><i class="fas fa-file-upload"></i> প্রমাণ স্বরূপ কোনো ফাইল</h5>
                <div class="row align-items-center mb-4">
                    <div class="col-md-12">
                        <div class="custom-file">
                            <input type="file" name="proof_file" class="custom-file-input" id="proof_file">
                            <label class="custom-file-label" for="proof_file">Choose file...</label>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-5 border-t pt-4">
                    <a href="{{ route('home') }}" class="btn btn-gov-cancel">বাতিল করুন</a>
                    <button type="submit" class="btn btn-gov-submit">আবেদন সম্পন্ন করুন</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    
</script>
@endpush
