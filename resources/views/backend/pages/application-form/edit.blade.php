@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormList'])
@section('title', 'Edit Application Form')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Application Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('application-form.index') }}">Application Form</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">আবেদন ফরম</h3>
                        </div>

                        <form class="form-horizontal" id="applicationForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="date" name="date" value="{{ $applicationForm->date }}"
                                                class="form-control">
                                            <small class="text-danger error date_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="recipient"
                                                value="{{ $applicationForm->recipient }}"
                                                placeholder="প্রাপক (Recipient)" class="form-control">
                                            <small class="text-danger error recipient_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="subject" value="{{ $applicationForm->subject }}"
                                                placeholder="বিষয় (Subject)" class="form-control">
                                            <small class="text-danger error subject_error"></small>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" name="sender" value="{{ $applicationForm->sender }}"
                                                placeholder="প্রেরক (Sender)" class="form-control">
                                            <small class="text-danger error sender_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="nid_no" value="{{ $applicationForm->nid_no }}"
                                                placeholder="এনআইডি নম্বর (NID NO)" class="form-control">
                                            <small class="text-danger error nid_no_error"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="mobile" value="{{ $applicationForm->mobile }}"
                                                placeholder="মোবাইল নম্বর (Mobile Number)" class="form-control">
                                            <small class="text-danger error mobile_error"></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
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

                            <div class="card-footer">
                                <a href="{{ route('application-form.index') }}" class="btn btn-default">Cancel</a>
                                <button type="submit" class="btn btn-info">Update</button>
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
