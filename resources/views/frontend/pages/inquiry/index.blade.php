@extends('frontend.master')
@section('title', 'জিজ্ঞাসা আবেদন')

@push('style')

@endpush

@section('content')
    <div class="container py-8">
        <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3">
            <!-- Header -->
            <div class="d-flex align-items-center gap-3 border-bottom border-3 border-danger pb-3 mb-3">
                <div
                    class="d-flex h-12 w-12 align-items-center justify-content-center rounded-full bg-white text-gov-green">
                    <i class="fas fa-desktop text-2xl"></i>
                </div>
                <div>
                    <h2 class="fs-5 mb-0">জিজ্ঞাসা আবেদন ফরম</h2>
                </div>
            </div>

            <!-- Form Body -->
            <div class="gov-body">

                <form action="{{ route('inquiry.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <label for="subject">জিজ্ঞাসার বিষয় <span class="text-danger">*</span></label>
                            <input type="text" required name="subject" placeholder="জিজ্ঞাসার বিষয়" class="form-control"
                                id="subject">
                        </div>
                        <div class="col-md-8">
                            <label for="details">জিজ্ঞাসার বিস্তারিত</label>
                            <textarea name="details" placeholder="জিজ্ঞাসার বিস্তারিত" class="form-control" id="details"
                                rows="1"></textarea>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <label for="applicant_name">আবেদনকারীর নাম <span class="text-danger">*</span></label>
                            <input type="text" required name="applicant_name" placeholder="আবেদনকারীর নাম"
                                class="form-control" id="applicant_name">
                        </div>
                        <div class="col-md-4">
                            <label for="father_name">পিতার নাম</label>
                            <input type="text" name="father_name" placeholder="পিতার নাম" class="form-control"
                                id="father_name">
                        </div>
                        <div class="col-md-4">
                            <label for="nid_number">জাতীয় পরিচয়পত্র নম্বর</label>
                            <input type="number" name="nid_number" placeholder="জাতীয় পরিচয়পত্র নম্বর" class="form-control"
                                id="nid_number">
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <label for="mobile_number">মোবাইল নম্বর <span class="text-danger">*</span></label>
                            <input type="number" required name="mobile_number" placeholder="মোবাইল নম্বর"
                                class="form-control" id="mobile_number"
                                value="{{ Auth::check() ? Auth::user()->mobile : '' }}" {{ Auth::check() ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-4">
                            <label for="email">ই-মেইল</label>
                            <input type="email" name="email" placeholder="ই-মেইল" class="form-control" id="email"
                                value="{{ Auth::check() ? Auth::user()->email : '' }}" {{ Auth::check() ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-4">
                            <label for="address">ঠিকানা</label>
                            <input type="text" name="address" placeholder="ঠিকানা" class="form-control" id="address">
                        </div>
                    </div>

                    <h5 class="section-title fs-6"><i class="fas fa-file-upload"></i> প্রমাণ স্বরূপ কোনো ফাইল</h5>
                    <div class="row align-align-items-center mb-3">
                        <div class="col-md-12">
                            <input type="file" name="proof_file" class="form-control" id="proof_file">
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="d-d-flex justify-content-end gap-3 mt-5 border-t pt-4">
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