@extends('frontend.master')
@section('title', 'Appointment Calendar')

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }


        /* ── Officer chip in hero ── */
        .officer-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 6px 16px 6px 6px;
            margin-top: 16px;
        }

        .officer-chip img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .officer-chip span {
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .officer-chip small {
            color: rgba(255, 255, 255, 0.65);
            font-size: 11px;
        }

        /* ── Main layout ── */
        .cal-section {
            background: #f5f6fa;
            padding: 0 0 64px;
            margin-top: -32px;
        }

        .cal-panel {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            height: 100%;
        }

        .cal-panel-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cal-panel-header .icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .icon-blue {
            background: #e8eaf6;
            color: #3949ab;
        }

        .icon-red {
            background: #fce4ec;
            color: #c62828;
        }

        .cal-panel-header h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .cal-panel-header small {
            color: #9e9e9e;
            font-size: 11px;
        }

        /* ── Date banner ── */
        .date-banner {
            background: linear-gradient(135deg, #3949ab, #5c6bc0);
            color: #fff;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-banner i {
            opacity: 0.8;
        }

        .date-banner #displayDate {
            font-weight: 700;
        }

        /* ── Slot section ── */
        .slot-section {
            padding: 20px 24px;
            border-bottom: 1px solid #f5f5f5;
        }

        .slot-section:last-child {
            border-bottom: none;
        }

        .slot-type-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #9e9e9e;
            margin-bottom: 14px;
        }

        .slot-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ── Time chip ── */
        .time-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1.5px solid #c5cae9;
            background: #fff;
            color: #3949ab;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.22s ease;
            position: relative;
            overflow: hidden;
        }

        .time-chip::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #3949ab, #5c6bc0);
            opacity: 0;
            transition: opacity 0.22s;
        }

        .time-chip span {
            position: relative;
            z-index: 1;
        }

        .time-chip:hover {
            border-color: #3949ab;
            color: #fff;
            box-shadow: 0 4px 14px rgba(57, 73, 171, 0.3);
            transform: translateY(-1px);
        }

        .time-chip:hover::before {
            opacity: 1;
        }

        .time-chip i {
            position: relative;
            z-index: 1;
            font-size: 11px;
        }

        /* ── Emergency chip ── */
        .time-chip.emergency {
            border-color: #ef9a9a;
            color: #c62828;
        }

        .time-chip.emergency::before {
            background: linear-gradient(135deg, #c62828, #e53935);
        }

        .time-chip.emergency:hover {
            border-color: #c62828;
            color: #fff;
            box-shadow: 0 4px 14px rgba(198, 40, 40, 0.3);
        }

        /* ── Loading skeleton ── */
        .slot-skeleton {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .skeleton-chip {
            width: 90px;
            height: 36px;
            border-radius: 8px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.4s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* ── No slot message ── */
        .no-slot {
            text-align: center;
            padding: 28px 16px;
            color: #9e9e9e;
        }

        .no-slot i {
            font-size: 32px;
            color: #e0e0e0;
            margin-bottom: 10px;
        }

        .no-slot p {
            font-size: 13px;
        }

        /* ── jQuery UI Datepicker overrides ── */
        .ui-datepicker {
            width: 100% !important;
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            font-family: 'Inter', sans-serif !important;
            padding: 8px !important;
        }

        .ui-widget-header {
            background: #3949ab !important;
            border: none !important;
            color: #fff !important;
            font-weight: 600 !important;
            border-radius: 0 !important;
            padding: 12px !important;
        }

        .ui-widget-content {
            border: none !important;
        }

        .ui-state-default,
        .ui-widget-content .ui-state-default {
            border: none !important;
            background: transparent !important;
            color: #333 !important;
            text-align: center !important;
            border-radius: 50% !important;
            padding: 8px !important;
            font-weight: 500 !important;
            transition: background 0.2s, color 0.2s !important;
            width: 37px;
            margin: auto;
        }

        .ui-state-hover,
        .ui-widget-content .ui-state-hover {
            background: #2980b9 !important;
            color: #3949ab !important;
            border-radius: 50% !important;
            cursor: pointer;
            border: 0px;
        }

        .ui-state-highlight,
        .ui-widget-content .ui-state-highlight {
            background: #3949ab !important;
            color: #fff !important;
            border-radius: 50% !important;
        }

        .ui-state-active,
        .ui-widget-content .ui-state-active {
            background: #283593 !important;
            color: #fff !important;
            border-radius: 50% !important;
            font-weight: 700 !important;
        }

        .ui-datepicker th {
            color: #3949ab !important;
            font-weight: 600 !important;
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .ui-datepicker-title {
            font-size: 14px !important;
        }

        .ui-icon-circle-triangle-e,
        .ui-icon-circle-triangle-w {
            background-image: none !important;
            text-indent: 0 !important;
            font-family: 'Font Awesome 5 Free' !important;
            font-weight: 900 !important;
            color: rgba(255, 255, 255, 0.85) !important;
            font-size: 13px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ui-icon-circle-triangle-e::before {
            content: '\f054';
        }

        .ui-icon-circle-triangle-w::before {
            content: '\f053';
        }

        /* ── Hint card ── */
        .hint-card {
            background: #e8eaf6;
            border-left: 3px solid #3949ab;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 16px;
            font-size: 12.5px;
            color: #3949ab;
        }

        .hint-card i {
            margin-right: 6px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cal-card-anim {
            animation: fadeUp 0.35s ease both;
        }

        .cal-card-anim:nth-child(2) {
            animation-delay: 0.1s;
        }
    </style>
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
                                                                        <i class="far fa-calendar-times d-block"></i>
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
                        $('#regularSlots').html(`<div class="no-slot w-100"><i class="fas fa-wifi d-block" style="color:#ef9a9a;font-size:32px;margin-bottom:10px;"></i><p>Failed to load slots. Please refresh.</p></div>`);
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