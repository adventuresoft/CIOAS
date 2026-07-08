@extends('backend.master', ['mainMenu' => 'Appointment', 'subMenu' => 'Slots'])
@section('title', 'Manage Slots')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<style>
    .fc-event { cursor: pointer; }
</style>
@endpush
@section('content')
<section class="content cioas-page pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">Create Slot</h3>
                        </div>
                        <div class="cioas-panel-body">
                            <form id="createSlotForm">
                                @csrf
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" name="slot_date" id="slot_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Slot Type <span class="text-danger">*</span></label>
                                    <select name="slot_type" id="slot_type" class="form-control" required>
                                        <option value="regular">Regular Slot</option>
                                        <option value="emergency">Emergency Slot</option>
                                    </select>
                                </div>
                                <div class="form-group" id="timeFields">
                                    <label>Start Time <span class="text-danger">*</span></label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>
                                <div class="form-group" id="capacityField" style="display: none;">
                                    <label>Capacity</label>
                                    <input type="number" name="capacity" id="capacity" class="form-control" value="3" readonly>
                                    <small class="text-muted">Emergency slots have a fixed capacity of 3.</small>
                                </div>
                                <div class="cioas-actions mt-3">
                                    <button type="submit" class="btn btn-material btn-material-primary w-100"><i class="fas fa-plus-circle"></i> Create Slot</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-body p-0">
                            <div id="calendar" class="p-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    $('#slot_type').on('change', function() {
        if($(this).val() == 'emergency') {
            $('#timeFields').hide();
            $('#start_time').removeAttr('required');
            $('#capacityField').show();
        } else {
            $('#timeFields').show();
            $('#start_time').attr('required', 'required');
            $('#capacityField').hide();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '{{ route('appointment.slots.api') }}',
            eventClick: function(info) {
                if(confirm("Do you want to delete this slot?")) {
                    $.ajax({
                        url: '{{ url('appointment-slots') }}/' + info.event.id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            toastr.success(res.message);
                            calendar.refetchEvents();
                        },
                        error: function(err) {
                            toastr.error(err.responseJSON.message || 'Error deleting slot');
                        }
                    });
                }
            }
        });
        calendar.render();

        $('#createSlotForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('appointment.slots.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    toastr.success(res.message);
                    calendar.refetchEvents();
                    $('#createSlotForm')[0].reset();
                    $('#slot_type').trigger('change');
                },
                error: function(err) {
                    toastr.error('Error creating slot');
                }
            });
        });
    });
</script>
@endpush
