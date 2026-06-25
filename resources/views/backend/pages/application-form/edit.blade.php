@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormList'])
@section('title', 'Edit Application Form')
@section('content')

    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form id="applicationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-edit"></i> আবেদন ফরম সম্পাদন</h3>
                        </div>

                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>তারিখ <span class="text-danger">*</span></label>
                                        <input type="date" name="date" value="{{ $applicationForm->date }}"
                                            class="form-control">
                                        <small class="text-danger error date_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>প্রাপক (Recipient) <span class="text-danger">*</span></label>
                                        <input type="text" name="recipient"
                                            value="{{ $applicationForm->recipient }}"
                                            placeholder="প্রাপক (Recipient)" class="form-control">
                                        <small class="text-danger error recipient_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>বিষয় (Subject) <span class="text-danger">*</span></label>
                                        <input type="text" name="subject" value="{{ $applicationForm->subject }}"
                                            placeholder="বিষয় (Subject)" class="form-control">
                                        <small class="text-danger error subject_error"></small>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>প্রেরক (Sender) <span class="text-danger">*</span></label>
                                        <input type="text" name="sender" value="{{ $applicationForm->sender }}"
                                            placeholder="প্রেরক (Sender)" class="form-control">
                                        <small class="text-danger error sender_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>এনআইডি নম্বর (NID NO) <span class="text-danger">*</span></label>
                                        <input type="text" name="nid_no" value="{{ $applicationForm->nid_no }}"
                                            placeholder="এনআইডি নম্বর (NID NO)" class="form-control">
                                        <small class="text-danger error nid_no_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>মোবাইল নম্বর (Mobile Number) <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" value="{{ $applicationForm->mobile }}"
                                            placeholder="মোবাইল নম্বর (Mobile Number)" class="form-control">
                                        <small class="text-danger error mobile_error"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>বার্তা (Message) <span class="text-danger">*</span></label>
                                <textarea rows="8" name="message" placeholder="বার্তা (Message)" class="form-control">{{ $applicationForm->message }}</textarea>
                                <small class="text-danger error message_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="attachment">সংযুক্তি (Attachment)</label>
                                <input type="file" name="attachment" id="attachment" class="form-control">
                                <small class="text-danger error attachment_error"></small>

                                @if ($applicationForm->attachment)
                                    <a href="{{ asset($applicationForm->attachment) }}" target="_blank"
                                        class="btn btn-sm btn-secondary mt-2">Current Attachment</a>
                                @endif
                            </div>
                        </div>

                        <div class="cioas-actions">
                            <a href="{{ route('application-form.index') }}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </form>
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
                    url: "{{ route('application-form.update', $applicationForm->id) }}",
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
