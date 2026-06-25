@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormList'])
@section('title', 'Application Form')
@section('content')

    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="cioas-panel-title"><i class="fas fa-list"></i> Application Form List</h3>
                        @if ($canCreateApplication ?? true)
                            <a href="{{ route('application-form.create') }}" class="btn btn-material btn-material-primary btn-sm">Create</a>
                        @endif
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Application No</th>
                                        <th>Date</th>
                                        <th>Form Type</th>
                                        <th>Status</th>
                                        <th>Current Department</th>
                                        <th>Current Section</th>
                                        <th>Received By</th>
                                        <th>Recipient</th>
                                        <th>Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicationForms as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->application_number ?? '-' }}</td>
                                            <td>{{ $item->date ? date('d M, Y', strtotime($item->date)) : '-' }}</td>
                                            <td>
                                                @php
                                                    $typeBadge = match ($item->form_type) {
                                                        'regular' => 'info',
                                                        'urgent' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $typeBadge }}">
                                                    {{ ucfirst($item->form_type ?? '-') }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $statusBadge = match ($item->status) {
                                                        'pending' => 'secondary',
                                                        'assigned' => 'info',
                                                        'received' => 'primary',
                                                        'processing' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge badge-{{ $statusBadge }}">
                                                    {{ ucfirst($item->status ?? 'pending') }}
                                                </span>
                                            </td>
                                            <td>{{ $item->currentDepartment->name ?? '-' }}</td>
                                            <td>{{ $item->currentSection->name ?? '-' }}</td>
                                            <td>{{ $item->receiver->name ?? '-' }}</td>
                                            <td>{{ $item->recipient }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td>
                                                <div class="table-action">
                                                    <a class="btn btn-sm btn-info" title="View" data-toggle="tooltip"
                                                        href="{{ route('application-form.show', $item->id) }}"><i
                                                            class="fa fa-eye"></i></a>

                                                    @if ($canManageAllApplications ?? false)
                                                        <form class="deleteApplicationForm d-inline-block" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="deleteUrl"
                                                                value="{{ route('application-form.destroy', $item->id) }}">
                                                            <button type="submit" title="Delete" data-toggle="tooltip"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".deleteApplicationForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                let formData = $(this).serialize();
                let deleteUrl = $(this).find(".deleteUrl").val();

                $("#toast-container").show();
                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to delete it?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function() {
                            $("#confirmationRevertYes").click(function() {
                                $.ajax({
                                    type: "DELETE",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", true);
                                    },
                                    success: function(response) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        toastr.success(response.message);
                                        setTimeout(function() {
                                            location.href =
                                                "{{ route('application-form.index') }}";
                                        }, 2000);
                                    },
                                    error: function(xhr) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        let responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                    }
                                });
                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            });
                        }
                    });
            });
        });
    </script>
@endpush
