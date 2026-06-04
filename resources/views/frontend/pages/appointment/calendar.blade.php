@extends('frontend.master')
@section('title', 'Appointment Calendar')
@push('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .appointment-header {
        background-color: #92d1ce;
        color: #000;
        padding: 15px;
        text-align: center;
        font-weight: 500;
        font-size: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .slot-container {
        border: 1px solid #bceceb;
        border-radius: 5px;
        height: 100%;
        min-height: 350px;
        background: #fff;
    }
    .slot-row {
        border-bottom: 1px solid #bceceb;
        padding: 20px;
    }
    .slot-row:last-child {
        border-bottom: none;
    }
    .slot-times {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-start;
        align-content: flex-start;
    }
    .time-btn {
        border: 1px solid #888;
        background-color: #fff;
        color: #333;
        padding: 8px 18px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 14px;
        display: inline-block;
    }
    .time-btn:hover {
        background-color: #666;
        color: #fff;
        border-color: #666;
    }
    .time-btn.emergency {
        border-color: #dc3545;
        color: #dc3545;
        font-weight: bold;
    }
    .time-btn.emergency:hover {
        background-color: #dc3545;
        color: #fff;
    }
    
    /* jQuery UI Datepicker custom styles */
    .ui-datepicker {
        width: 100%;
        padding: 0;
        border: none;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        font-family: inherit;
    }
    .ui-widget-header {
        background: #a9a9a9;
        border: none;
        color: #fff;
        font-weight: normal;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        padding: 10px;
    }
    .ui-widget-content {
        border: 1px solid #ddd;
    }
    .ui-state-default, .ui-widget-content .ui-state-default {
        border: none;
        background: transparent;
        text-align: center;
        padding: 10px;
    }
    .ui-state-highlight, .ui-widget-content .ui-state-highlight {
        background: #e81e62;
        color: #fff;
        border-radius: 50%;
    }
    .ui-state-active, .ui-widget-content .ui-state-active {
        background: #666;
        color: #fff;
        border-radius: 50%;
    }
    .ui-datepicker th {
        color: #e81e62;
        font-weight: 500;
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <h2 class="mb-0 pb-3 text-2xl"><i class="fas fa-calendar-alt me-2"></i> Book Appointment with {{ $officer->name }}</h2>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="appointment-header">
                Select a time slot to book an appointment on <span id="displayDate">{{ date('F d, Y') }}</span>
            </div>
            
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="slot-container">
                        
                        <!-- Emergency -->
                        <div class="slot-row bg-light" id="emergencyRow" style="display: none;">
                            <h5 class="text-danger fw-bold mb-3"><i class="fas fa-exclamation-triangle"></i> Emergency Slots</h5>
                            <div class="slot-times" id="emergencySlots">
                                <!-- Slots will be appended here -->
                            </div>
                        </div>

                        <!-- Regular Slots -->
                        <div class="slot-row">
                            <h5 class="fw-bold mb-3"><i class="far fa-clock"></i> Available Slots</h5>
                            <div class="slot-times" id="regularSlots">
                                <div class="text-muted fw-bold mt-2"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div id="datepicker"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        
        function fetchSlots(dateStr) {
            $('#regularSlots, #emergencySlots').html('<div class="text-muted fw-bold mt-2"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
            
            $.ajax({
                url: '{{ route('appointment.public.slots.by_date', $officer->id) }}',
                type: 'GET',
                data: { date: dateStr },
                success: function(res) {
                    
                    // Regular Slots
                    if (res.slots && res.slots.length > 0) {
                        let html = '';
                        res.slots.forEach(s => {
                            html += `<a href="${s.url}" class="time-btn">${s.time}</a>`;
                        });
                        $('#regularSlots').html(html);
                    } else {
                        $('#regularSlots').html('<div class="text-danger fw-bold mt-2">No slot available for this date</div>');
                    }

                    // Emergency Slots
                    if (res.emergency && res.emergency.length > 0) {
                        $('#emergencyRow').show();
                        let emHtml = '';
                        res.emergency.forEach(s => {
                            emHtml += `<a href="${s.url}" class="time-btn emergency">${s.title}</a>`;
                        });
                        $('#emergencySlots').html(emHtml);
                    } else {
                        $('#emergencyRow').hide();
                    }
                },
                error: function(err) {
                    console.log(err);
                    $('#regularSlots, #emergencySlots').html('<div class="text-danger fw-bold mt-2">Error loading slots</div>');
                }
            });
        }

        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0, // Only allow today and future dates
            onSelect: function(dateText, inst) {
                let dateObj = $(this).datepicker('getDate');
                let formattedDisplay = $.datepicker.formatDate("MM dd, yy", dateObj);
                $('#displayDate').text(formattedDisplay);
                fetchSlots(dateText);
            }
        });

        // Initialize today
        let today = $.datepicker.formatDate("yy-mm-dd", new Date());
        fetchSlots(today);
    });
</script>
@endpush
