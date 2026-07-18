@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormCreate'])
@section('title', 'Application Form')
@section('content')

    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form id="applicationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title"><i class="fas fa-file-alt"></i> পত্র লিখন</h3>
                        </div>

                        <div class="cioas-panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>তারিখ <span class="text-danger">*</span></label>
                                        <input type="date" value="{{ date('Y-m-d') }}" name="date" class="form-control"
                                            readonly>
                                        <small class="text-danger error date_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>প্রাপক (Recipient) <span class="text-danger">*</span></label>
                                        <select name="recipient" class="form-control select2" required>
                                            <option value="">নির্বাচন করুন (Select)</option>
                                            @if(isset($departments))
                                                @foreach($departments as $department)
                                                    @if($department->users->count() > 0)
                                                        <optgroup label="{{ $department->name }}">
                                                            @foreach($department->users as $user)
                                                                <option value="{{ $user->name }}{{ $user->designation ? ' - ' . $user->designation : '' }}">{{ $user->name }} {{ $user->designation ? '(' . $user->designation . ')' : '' }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error recipient_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label>প্রেরক (Sender)</label>
                                        <input type="text" name="sender" placeholder="প্রেরক (Sender)" class="form-control">
                                        <small class="text-danger error sender_error"></small>
                                    </div>


                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label>এনআইডি নম্বর (NID NO)</label>
                                        <input type="text" name="nid_no" placeholder="এনআইডি নম্বর (NID NO)"
                                            class="form-control">
                                        <small class="text-danger error nid_no_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>মোবাইল নম্বর (Mobile Number) <span class="text-danger">*</span></label>
                                        <input type="text" name="mobile" maxlength="11" pattern="[0-9]{11}"
                                            inputmode="numeric" placeholder="মোবাইল নম্বর (Mobile Number)"
                                            class="form-control" required>
                                        <small class="text-danger error mobile_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>ঠিকানা (Address)</label>
                                        <input type="text" name="address" placeholder="ঠিকানা (Address)"
                                            class="form-control">
                                        <small class="text-danger error address_error"></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>বাবার নাম (Father's Name)</label>
                                        <input type="text" name="father_name" placeholder="বাবার নাম (Father's Name)"
                                            class="form-control">
                                        <small class="text-danger error father_name_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label>ইমেইল (Email)</label>
                                        <input type="text" name="email" placeholder="ইমেইল (Email)" class="form-control">
                                        <small class="text-danger error email_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label>ফর্মের ধরণ নির্বাচন করুন</label>
                                        <select name="form_type" class="form-control select2">
                                            <option value="">ফর্মের ধরণ নির্বাচন করুন</option>
                                            <option value="regular">নিয়মিত ভিত্তিতে (Regular)</option>
                                            <option value="urgent">জরুরি ভিত্তিতে (Urgent)</option>
                                        </select>
                                        <small class="text-danger error form_type_error"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>বিষয় (Subject)</label>
                                        <input type="text" name="subject" placeholder="বিষয় (Subject)"
                                            class="form-control">
                                        <small class="text-danger error subject_error"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>বার্তা (Message)</label>
                                <textarea rows="8" name="message" placeholder="বার্তা (Message)"
                                    class="form-control"></textarea>
                                <small class="text-danger error message_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="attachment">সংযুক্তি (Attachment)</label>
                                <input type="file" name="attachment" id="attachment" class="form-control">
                                <small class="text-danger error attachment_error"></small>
                            </div>
                        </div>

                        <div class="cioas-actions">
                            <a href="{{ route('application-form.index') }}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">আবেদনটি নিশ্চিত
                                করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $("#applicationForm").on('submit', function (e) {
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
                    beforeSend: function () {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.href = "{{ route('application-form.index') }}";
                        }, 2000);
                    },
                    error: function (xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        let responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function (key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            });
        });
    </script>
@endpush