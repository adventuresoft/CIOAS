@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderList'])

@section('title', 'নোটিশ প্রিন্ট — ' . ($misCase->case_no ?? 'N/A'))

@section('content')
    <x-print-view-case title="নোটিশ" :header_one="$misCase->header_one" :header_two="$misCase->header_two">

        <div style="display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 15px;">
            <div>
                <strong>স্মারক নম্বর:</strong> {{ $caseOrder->memorial_no ?? '—' }}
            </div>
            <div>
                <strong>তারিখ:</strong> {{ date('d/m/Y') }}
            </div>
        </div>

        <div style="margin-bottom: 20px; font-size: 15px;">
            <div style="margin-bottom: 15px;">
                <strong style="text-decoration: underline;">আবেদনকারী/ বাদীগণ:</strong><br>
                @if(!empty($misCase->plaintiffs))
                    @foreach($misCase->plaintiffs as $index => $plaintiff)
                        @php
                            $details = [];
                            if (!empty($plaintiff['father_name']))
                                $details[] = "পিতা: " . $plaintiff['father_name'];
                            if (!empty($plaintiff['address']))
                                $details[] = "সাং- " . $plaintiff['address'];
                            if (!empty($plaintiff['mobile']))
                                $details[] = "মোবাইল নং- " . $plaintiff['mobile'];
                            $detailsStr = !empty($details) ? ", " . implode(", ", $details) : "";
                            $bIndex = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $index + 1);
                        @endphp
                        {{ $bIndex }}. {{ $plaintiff['name'] ?? '—' }}{{ $detailsStr }}<br>
                    @endforeach
                @else
                    —
                @endif
            </div>

            <div style="margin-bottom: 15px;">
                <strong style="text-decoration: underline;">বিবাদী/ বিবাদীরগণ:</strong><br>
                @if(!empty($misCase->defendants))
                    @foreach($misCase->defendants as $index => $defendant)
                        @php
                            $details = [];
                            if (!empty($defendant['father_name']))
                                $details[] = "পিতা: " . $defendant['father_name'];
                            if (!empty($defendant['address']))
                                $details[] = "সাং- " . $defendant['address'];
                            if (!empty($defendant['mobile']))
                                $details[] = "মোবাইল নং- " . $defendant['mobile'];
                            $detailsStr = !empty($details) ? ", " . implode(", ", $details) : "";
                            $bIndex = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $index + 1);
                        @endphp
                        {{ $bIndex }}. {{ $defendant['name'] ?? '—' }}{{ $detailsStr }}<br>
                    @endforeach
                @else
                    —
                @endif
            </div>
        </div>

        <div style="margin-bottom: 20px; font-size: 15px; line-height: 1.6; text-align: justify;">
            <p>এতদ্বারা আপনাদেরকে জানানো যাচ্ছে যে, <strong>{{ $misCase->case_no ?? '—' }}</strong> নং
                <strong>{{ $misCase->case_type_label ?? '—' }}</strong> মামলা বাদীগণ/আবেদনকারী নিম্ন তপশীলভুক্ত সম্পত্তি
                সংশোধন করে নেওয়ার জন্য নিম্নস্বাক্ষরকারীর আদালতে আবেদন দাখিল করেছেন। সেমতে, মিসমোকদ্দমাটি চালু করা হয়েছে এবং
                তার শুনানি
                <strong>{{ $caseOrder->next_hearing_date ? $caseOrder->next_hearing_date->format('d/m/Y') : '—' }}</strong>
                খ্রিঃ তারিখে ধার্য আছে।
            </p>
            <p>ধার্য তারিখে পক্ষদ্বয়কে স্বত্ব দাবীর স্বপক্ষে প্রয়োজনীয় কাগজপত্র/ দলিলাদি ও স্বাক্ষী প্রমাণাদিসহ হাজির হয়ে
                স্ব-স্ব বক্তব্য /ব্যাখ্যা পেশ অথবা কোন আপত্তি থাকলে তা লিখিতিভাবে দাখিল করতে বলা হলো। অন্যথায় আইনগতভাবে এক
                তরফা শুনানীর দ্বারা মামলার নিষ্পত্তি করা হবে।</p>
        </div>


        <div style="margin-bottom: 30px; font-size: 15px;">
            <h6 style="font-weight: bold; margin-bottom: 10px; text-decoration: underline;">আবেদিত জমির তফশিল:</h4>
                @if(!empty($misCase->land_info) && is_array($misCase->land_info))
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ccc;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">রেকর্ড</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">জেলা</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">উপজেলা/থানা</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">মৌজা</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">খতিয়ান নং</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">দাগ নং</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">রেকর্ড গ্রুপ</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">মোট দাগ নং</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">মোট জমির</th>
                                <th style="border: 1px solid #ccc; padding: 5px; text-align:left;">জমির মালিক</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($misCase->land_info as $land)
                                <tr>
                                    <td style="border: 1px solid #ccc; padding: 5px;">
                                        {{ $land['record']}}
                                    </td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">
                                        {{ $locationNames['districts'][$land['district_id'] ?? ''] ?? '—' }}
                                    </td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">
                                        {{ $locationNames['thanas'][$land['thana_id'] ?? ''] ?? '—' }}
                                    </td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">
                                        {{ $locationNames['mouzas'][$land['mouza_id'] ?? ''] ?? '—' }}
                                    </td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['khatian'] ?? '—' }}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['dag_no'] ?? '—' }}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['record_group'] ?? '—' }}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['total_dag_no'] ?? '—' }}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['total_land'] ?? '—' }}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px;">{{ $land['record_owner_name'] ?? '—' }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>—</p>
                @endif
        </div>

        <div style="margin-top: 50px; display: flex; justify-content: flex-end;">
            <div style="text-align: center; line-height: 1.4;">
                @if($caseOrder->creator)
                    <p class="mb-0">{{ $caseOrder->creator->name }}</p>
                    <p class="mb-0">{{ $caseOrder->creator->section->name ?? '' }}</p>
                    <p class="mb-0">{{ $misCase->header_one ?? '' }}</p>
                    <p class="mb-0">{{ $misCase->header_two ?? '' }}</p>
                @endif
            </div>
        </div>
        </x-print-view>
@endsection