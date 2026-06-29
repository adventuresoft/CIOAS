@extends('frontend.master')
@section('title', 'Appointment Calendar')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
@endpush

@section('content')
    <div class="content-wrapper" style="background:#f5f6fa; min-height:100vh;">


        {{-- Main --}}
        <div class="cal-section">
            <div class="container" style="margin-top:-16px;">
                <div class="row g-4">

                    {{-- Left: Slots --}}
                    <div class="col-md-8 cal-card-anim">
                        <div class="cal-panel">

                            {{-- Date banner --}}
                            <div class="date-banner">
                                <i class="fas fa-calendar-day"></i>
                                Showing slots for: <span id="displayDate">{{ date('F d, Y') }}</span>
                            </div>

                            {{-- Emergency --}}
                            <div id="emergencyWrapper" style="display:none;">
                                <div class="cal-panel-header">
                                    <div class="icon-wrap icon-red"><i class="fas fa-exclamation-triangle"></i></div>
                                    <div>
                                        <h6>Emergency Slots</h6>
                                        <small>Priority access — limited availability</small>
                                    </div>
                                </div>
                                <div class="slot-section">
                                    <div class="slot-type-label">Emergency</div>
                                    <div class="slot-grid" id="emergencySlots"></div>
                                </div>
                            </div>

                            {{-- Regular --}}
                            <div class="cal-panel-header">
                                <div class="icon-wrap icon-blue"><i class="far fa-clock"></i></div>
                                <div>
                                    <h6>Available Slots</h6>
                                    <small>Click a time to proceed with booking</small>
                                </div>
                            </div>
                            <div class="slot-section">
                                <div class="slot-type-label">Regular Slots</div>
                                <div class="slot-grid" id="regularSlots">
                                    <div class="slot-skeleton">
                                        @for($i = 0; $i < 6; $i++)
                                        <div class="skeleton-chip"></div>@endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Right: Calendar --}}
                    <div class="col-md-4 cal-card-anim">
                        <div class="cal-panel">
                            <div class="cal-panel-header">
                                <div class="icon-wrap icon-blue"><i class="fas fa-calendar"></i></div>
                                <div>
                                    <h6>Select Date</h6>
                                    <small>Today or any future date</small>
                                </div>
                            </div>
                            <div id="datepicker"></div>
                            <div style="padding:0 16px 16px;">
                                <div class="hint-card">
                                    <i class="fas fa-info-circle"></i>
                                    Select a date on the calendar to see available time slots.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {

            function skeleton() {
                let s = '<div class="slot-skeleton">';
                for (let i = 0; i < 6; i++) s += '<div class="skeleton-chip"></div>';
                return s + '</div>';
            }

            function fetchSlots(dateStr) {
                $('#regularSlots').html(skeleton());
                $('#emergencySlots').html(skeleton());

                $.ajax({
                    url: '{{ route('appointment.public.slots.by_date', $officer->id) }}',
                    type: 'GET',
                    data: { date: dateStr },
                    success: function (res) {
                        // Regular
                        if (res.slots && res.slots.length > 0) {
                            let html = '';
                            res.slots.forEach(s => {
                                html += `<a href="${s.url}" class="time-chip"><i class="far fa-clock"></i><span>${s.time}</span></a>`;
                            });
                            $('#regularSlots').html(html);
                        } else {
                            $('#regularSlots').html(`
                                                                    <div class="no-slot w-100">
                                                                        <i class="far fa-calendar-times d-d-block"></i>
                                                                        <p>No slots available for this date.<br><small>Please try another date.</small></p>
                                                                    </div>`);
                        }

                        // Emergency
                        if (res.emergency && res.emergency.length > 0) {
                            $('#emergencyWrapper').show();
                            let emHtml = '';
                            res.emergency.forEach(s => {
                                emHtml += `<a href="${s.url}" class="time-chip emergency"><i class="fas fa-exclamation-circle"></i><span>${s.title}</span></a>`;
                            });
                            $('#emergencySlots').html(emHtml);
                        } else {
                            $('#emergencyWrapper').hide();
                        }
                    },
                    error: function () {
                        $('#regularSlots').html(`<div class="no-slot w-100"><i class="fas fa-wifi d-d-block" style="color:#ef9a9a;font-size:32px;margin-bottom:10px;"></i><p>Failed to load slots. Please refresh.</p></div>`);
                    }
                });
            }

            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                onSelect: function (dateText) {
                    let dateObj = $(this).datepicker('getDate');
                    let formatted = $.datepicker.formatDate("MM dd, yy", dateObj);
                    $('#displayDate').text(formatted);
                    fetchSlots(dateText);
                }
            });

            // Load today's slots on init
            let today = $.datepicker.formatDate("yy-mm-dd", new Date());
            fetchSlots(today);
        });
    </script>
@endpush