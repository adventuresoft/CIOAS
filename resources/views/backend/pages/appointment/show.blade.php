<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th width="30%">Booking ID</th>
            <td>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <th>Applicant Name</th>
            <td>{{ $booking->name }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $booking->phone }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $booking->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>NID Number</th>
            <td>{{ $booking->nid_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $booking->address ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Purpose</th>
            <td>{{ $booking->purpose ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{!! nl2br(e($booking->description)) ?? 'N/A' !!}</td>
        </tr>
        <tr>
            <th>Slot Date</th>
            <td>{{ date('d M, Y', strtotime($booking->slot->slot_date)) }}</td>
        </tr>
        <tr>
            <th>Time / Type</th>
            <td>
                @if($booking->booking_type == 'emergency')
                    <span class="badge badge-danger">Emergency Slot</span>
                @else
                    {{ date('h:i A', strtotime($booking->slot->start_time)) }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Current Status</th>
            <td>
                @php
                    $badges = ['Pending'=>'warning', 'Approved'=>'primary', 'Rejected'=>'danger', 'Completed'=>'success', 'Cancelled'=>'secondary', 'Expired'=>'dark'];
                    $color = $badges[$booking->status] ?? 'info';
                @endphp
                <span class="badge badge-{{ $color }}">{{ $booking->status }}</span>
            </td>
        </tr>
        <tr>
            <th>Booked At</th>
            <td>{{ $booking->created_at->format('d M, Y h:i A') }}</td>
        </tr>
    </tbody>
</table>
