@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormCreate'])
@section('title', 'Application Form')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('application-form.index') }}">Application Form</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">পত্র লিখন </h3>
                        </div>

                        <form class="form-horizontal" id="applicationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="date" value="{{ date('Y-m-d') }}" name="date"
                                                class="form-control" readonly>
                                            <small class="text-danger error date_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="recipient" placeholder="প্রাপক (Recipient)"
                                                class="form-control">
                                            <small class="text-danger error recipient_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="sender" placeholder="প্রেরক (Sender)"
                                                class="form-control">
                                            <small class="text-danger error sender_error"></small>
                                        </div>


                                    </div>

                                    <div class="col-sm-4">

                                        <div class="form-group">
                                            <input type="text" name="nid_no" placeholder="এনআইডি নম্বর (NID NO)"
                                                class="form-control">
                                            <small class="text-danger error nid_no_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="mobile" maxlength="11" pattern="[0-9]{11}"
                                                inputmode="numeric" placeholder="মোবাইল নম্বর (Mobile Number)"
                                                class="form-control">
                                            <small class="text-danger error mobile_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="address" placeholder="ঠিকানা (Address)"
                                                class="form-control">
                                            <small class="text-danger error address_error"></small>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="father_name" placeholder="বাবার নাম (Father's Name)"
                                                class="form-control">
                                            <small class="text-danger error father_name_error"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="ইমেইল (Email)"
                                                class="form-control">
                                            <small class="text-danger error email_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <select name="form-type" id="" class="form-control select2">
                                                <option value="">ফর্মের ধরণ নির্বাচন করুন</option>
                                                <option value="regular">নিয়মিত ভিত্তিতে (Regular)</option>
                                                <option value="urgent">জরুরি ভিত্তিতে (Urgent)</option>
                                            </select>
                                            <small class="text-danger error form-type_error"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="subject" placeholder="বিষয় (Subject)"
                                                class="form-control">
                                            <small class="text-danger error subject_error"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea rows="8" name="message" placeholder="বার্তা (Message)" class="form-control"></textarea>
                                    <small class="text-danger error message_error"></small>
                                </div>

                                <div class="form-group">
                                    <label for="attachment">সংযুক্তি (Attachment)</label>
                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                    <small class="text-danger error attachment_error"></small>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('application-form.index') }}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info">আবেদনটি নিশ্চিত করুন</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $("#applicationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('application-form.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = "{{ route('application-form.index') }}";
                        }, 2000);
                    },
                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            });
        });
    </script>
@endpush
