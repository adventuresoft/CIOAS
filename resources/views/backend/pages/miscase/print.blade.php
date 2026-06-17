@extends('backend.master', ['mainMenu' => 'MisCase', 'subMenu' => 'MisCaseList'])

@section('title', 'Missed Case History Pad')

@section('content')
<x-print-view title="মিসকেস শুনানির ইতিহাস ও নথি">
    <!-- General Info -->
    <table class="info-table">
        <tr>
            <td class="label">কেস নম্বর:</td>
            <td><strong>{{ $miscase->case_no }}</strong></td>
            <td class="label">রুজুর তারিখ:</td>
            <td>{{ optional($miscase->case_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">মামলার ধরণ:</td>
            <td>{{ $miscase->case_type_label }}</td>
            <td class="label">ফি/ফি পরিমাণ:</td>
            <td>{{ number_format($miscase->case_fee, 2) }} ৳</td>
        </tr>
        <tr>
            <td class="label">বর্তমান অবস্থা:</td>
            <td colspan="3">
                <span class="status-badge {{ $miscase->status }}" style="font-weight:700;">
                    {{ ucfirst($miscase->status) }}
                </span>
                @if ($miscase->status === 'rejected' && $miscase->rejection_reason)
                    <br><small class="text-danger">কারণ: {{ $miscase->rejection_reason }}</small>
                @endif
            </td>
        </tr>
    </table>

    <!-- Parties Information -->
    <h4 class="section-title">বাদী ও বিবাদী বিবরণ</h4>
    <table class="info-table">
        <tr>
            <td class="label">বাদী (Plaintiffs):</td>
            <td>
                @if(!empty($miscase->plaintiffs))
                    @foreach($miscase->plaintiffs as $key => $p)
                        <div class="mb-2">
                            <strong>{{ $key + 1 }}. {{ $p['name'] ?? '—' }}</strong><br>
                            <small class="text-muted">
                                পিতা: {{ $p['father_name'] ?? '—' }} | মোবাইল: {{ $p['mobile'] ?? '—' }}<br>
                                ঠিকানা: {{ $p['address'] ?? '—' }}
                            </small>
                        </div>
                    @endforeach
                @else
                    —
                @endif
            </td>
        </tr>
        <tr>
            <td class="label">বিবাদী (Defendants):</td>
            <td>
                @if(!empty($miscase->defendants))
                    @foreach($miscase->defendants as $key => $d)
                        <div class="mb-2">
                            <strong>{{ $key + 1 }}. {{ $d['name'] ?? '—' }}</strong><br>
                            <small class="text-muted">
                                পিতা: {{ $d['father_name'] ?? '—' }} | মোবাইল: {{ $d['mobile'] ?? '—' }}<br>
                                ঠিকানা: {{ $d['address'] ?? '—' }}
                            </small>
                        </div>
                    @endforeach
                @else
                    —
                @endif
            </td>
        </tr>
    </table>

    <!-- Land Records -->
    <h4 class="section-title">জমির তথ্য (Land Records)</h4>
    <table class="data-table">
        <thead>
            <tr>
                <th>রেকর্ড</th>
                <th>জেলা</th>
                <th>উপজেলা</th>
                <th>মৌজা</th>
                <th>দাগ নং</th>
                <th>খতিয়ান</th>
                <th>রেকর্ড গ্রুপ</th>
                <th>মোট জমি</th>
                <th>রেকর্ড মালিক</th>
            </tr>
        </thead>
        <tbody>
            @forelse(is_array($miscase->land_info) ? $miscase->land_info : [] as $row)
                <tr>
                    <td>{{ $row['record'] ?? '-' }}</td>
                    <td>{{ $locationNames['districts'][$row['district_id'] ?? null] ?? '-' }}</td>
                    <td>{{ $locationNames['thanas'][$row['thana_id'] ?? null] ?? '-' }}</td>
                    <td>{{ $locationNames['mouzas'][$row['mouza_id'] ?? null] ?? '-' }}</td>
                    <td><strong>{{ $row['dag_no'] ?? '-' }}</strong></td>
                    <td>{{ $row['khatian'] ?? '-' }}</td>
                    <td>{{ $row['record_group'] ?? '-' }}</td>
                    <td>{{ $row['total_land'] ?? '-' }}</td>
                    <td>{{ $row['record_owner_name'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center;" class="text-muted">No land records linked.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Case History Timeline (Hearing Order History) -->
    <h4 class="section-title">শুনানির ইতিহাস ও আদেশসমূহ</h4>
    <table class="data-table timeline-table">
        <thead>
            <tr>
                <th style="width: 15%;">শুনানি নং</th>
                <th style="width: 25%;">শুনানির তারিখ ও সময়</th>
                <th style="width: 45%;">আদেশ / সিদ্ধান্তের বিবরণ</th>
                <th style="width: 15%;">পরবর্তী তারিখ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($caseOrders as $order)
                <tr>
                    <td style="text-align:center;">
                        <span class="badge badge-light border" style="font-weight:700;">
                            {{ sprintf('H%05d', $order->id) }}
                        </span>
                    </td>
                    <td>
                        <strong>{{ optional($order->created_at)->format('d/m/Y') }}</strong>
                        @if ($order->next_hearing_time)
                            <br><small class="text-muted"><i class="far fa-clock"></i> {{ $order->next_hearing_time }}</small>
                        @endif
                    </td>
                    <td>
                        <strong>আদেশের ধরণ:</strong> {{ $order->command_type_label ?: '—' }}<br>
                        @if ($order->memorial_no)
                            <strong>স্মারক নম্বর:</strong> {{ $order->memorial_no }}<br>
                        @endif
                        @if ($order->command_start_date || $order->command_till_date || $order->command_end_date)
                            <span class="d-block mt-1">
                                @if ($order->command_start_date)
                                    <strong>শুরু:</strong> {{ $order->command_start_date->format('d/m/Y') }}
                                @endif
                                @if ($order->command_till_date)
                                    | <strong>মেয়াদ:</strong> {{ $order->command_till_date->format('d/m/Y') }}
                                @endif
                                @if ($order->command_end_date)
                                    | <strong>সমাপ্তি:</strong> {{ $order->command_end_date->format('d/m/Y') }}
                                @endif
                            </span>
                        @endif
                        @if ($order->command_text)
                            <span class="d-block mt-1"><strong>আদেশ:</strong> {{ $order->command_text }}</span>
                        @endif
                        @if ($order->command_yes_note)
                            <span class="d-block mt-1"><strong>নোট:</strong> {{ $order->command_yes_note }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $order->next_hearing_date ? $order->next_hearing_date->format('d/m/Y') : '—' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;" class="text-muted">কোনো শুনানির ইতিহাস পাওয়া যায়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Notes -->
    @php
        $notesText = is_array($miscase->notes) ? $miscase->notes['notes'] ?? '' : $miscase->notes;
    @endphp
    @if ($notesText)
        <div style="margin-top: 20px;">
            <strong>বিশেষ নোট:</strong>
            <p style="font-size: 13px; background-color: #f8fafc; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; margin-top: 4px;">
                {{ $notesText }}
            </p>
        </div>
    @endif
</x-print-view>
@endsection
