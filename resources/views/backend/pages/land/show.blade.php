@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])

@section('title', 'জমির বিবরণী')

@section('content')
    <x-print-view title="সরকারি স্বার্থ সংশ্লিষ্ট জমির বিবরণ">

        <div style="display: flex; justify-content: space-between; margin-bottom: 25px; font-size: 15px; font-weight: 600; color: #1e293b;">
            <div>
                <div style="margin-bottom: 5px;">জমির আইডি: <span style="font-weight: normal;">{{ $land->land_no ?? (str_pad($land->id, 7, '0', STR_PAD_LEFT) . '-' . date('m-Y')) }}</span></div>
                <div>জমির ধরণ: <span style="font-weight: normal;">{{ $land->type->bn_name ?? $land->land_type }}</span></div>
            </div>
            <div></div>
        </div>

        <div style="text-align: center; font-weight: 700; font-size: 15px; color: #0f766e; margin-bottom: 20px; border: 1px dashed #cbd5e1; padding: 10px; border-radius: 6px; background-color: #f8fafc;">
            সর্বশেষ রেকর্ড: {{ $land->record->name ?? $land->record_type ?? '—' }}, 
            জেলা: {{ $land->district->name ?? '—' }}, 
            উপজেলা/সার্কেল: {{ $land->upazila->name ?? '—' }}, 
            মৌজা: {{ $land->mouza->name ?? '—' }}, 
            জেএল নং: {{ $land->mouza->code ?? '—' }}
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>দাগ নং</th>
                    <th>খতিয়ান নং</th>
                    <th>রেকর্ডীয় শ্রেণি</th>
                    <th>বাস্তব শ্রেণি</th>
                    <th>দাগে মোট জমি (একর)</th>
                    <th>জমির পরিমাণ (একর)</th>
                    <th>দখল সংক্রান্ত অবস্থা</th>
                    <th>মামলা নং</th>
                    <th>গেজেট / প্রমাণক নাম্বার</th>
                </tr>
            </thead>
            <tbody>
                @forelse(is_array($land->details) ? $land->details : [] as $row)
                    <tr>
                        <td style="font-weight: 600;">{{ $row['dag_no'] ?? '' }}</td>
                        <td style="font-weight: 600;">{{ $row['khatian_no'] ?? '' }}</td>
                        <td>{{ $recordGroups->where('id', $row['recorded_class'])->first()->bn_name ?? $row['recorded_class'] ?? '' }}</td>
                        <td>{{ $recordGroups->where('id', $row['actual_class'])->first()->bn_name ?? $row['actual_class'] ?? '' }}</td>
                        <td>{{ number_format((float) ($row['total_land'] ?? 0), 4) }}</td>
                        <td style="font-weight: 600; color: #0f766e;">{{ number_format((float) ($row['land_amount'] ?? 0), 4) }}</td>
                        <td>{{ $row['possession_status'] ?? '' }}</td>
                        <td>{{ $row['case_no'] ?? '' }}</td>
                        <td>{{ $row['gazette_no'] ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; color: #64748b; padding: 20px;">কোনো জমির বিবরণ পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <table class="data-table" style="margin-top: 30px;">
            <tr>
                <td style="width: 33.33%; vertical-align: top; padding: 15px;">
                    <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 12px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">মামলা সংক্রান্ত তথ্য</div>
                    @php
                        $detailsColl = collect(is_array($land->details) ? $land->details : []);
                        $hasCase = $detailsColl->whereNotNull('case_no')->where('case_no', '!=', '')->count() > 0 ? 'হ্যাঁ' : 'না';
                        $firstCase = $detailsColl->whereNotNull('case_no')->where('case_no', '!=', '')->first();
                    @endphp
                    <div style="margin-bottom: 8px;"><strong>কোনো মামলা আছে :</strong> <span style="color: {{ $hasCase == 'হ্যাঁ' ? '#ef4444' : '#1e293b' }}">{{ $hasCase }}</span></div>
                    <div style="margin-bottom: 8px;"><strong>মামলা নম্বর :</strong> {{ $firstCase['case_no'] ?? '' }}</div>
                    <div style="margin-bottom: 8px;"><strong>আদালতের নাম :</strong> </div>
                    <div style="margin-bottom: 8px;"><strong>মামলার সর্বশেষ অবস্থা :</strong> </div>
                    <div style="margin-bottom: 8px;"><strong>মন্তব্য :</strong> {{ $firstCase['remarks'] ?? '' }}</div>
                </td>
                <td style="width: 33.33%; vertical-align: top; padding: 15px;">
                    <div style="font-weight: 700; color: #0f766e; margin-bottom: 12px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">দখল সংক্রান্ত তথ্য</div>
                    @php
                        $firstDetail = $detailsColl->first();
                        $possession = $firstDetail ? ($firstDetail['possession_status'] ?? '') : '';
                    @endphp
                    <div style="margin-bottom: 8px;"><strong>সরকার দখলে আছে :</strong> <span style="color: {{ str_contains($possession, 'সরকার') ? '#10b981' : '#1e293b' }}">{{ $possession }}</span></div>
                    <div style="margin-bottom: 8px;"><strong>উচ্ছেদ প্রস্তাব করা হয়েছিল :</strong> </div>
                </td>
                <td style="width: 33.33%; vertical-align: top; padding: 15px;">
                    <div style="font-weight: 700; color: #b45309; margin-bottom: 12px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">বরাদ্দ সংক্রান্ত তথ্য</div>
                    <div style="margin-bottom: 8px;"><strong>বরাদ্দ/লীজ/বন্দোবস্ত দেওয়া হয়েছে :</strong> না</div>
                    <div style="margin-bottom: 8px;"><strong>কয়জনকে দেওয়া হয়েছে :</strong> </div>
                    <div style="margin-bottom: 8px;"><strong>কাদের দেওয়া হয়েছে :</strong> </div>
                    <div style="margin-bottom: 8px;"><strong>কতটুকু দেওয়া হয়েছে :</strong> </div>
                    <div style="margin-bottom: 8px;"><strong>কত টাকায় দেওয়া হয়েছে :</strong> </div>
                </td>
            </tr>
        </table>

        <div style="margin-top: 35px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 15px; background: #f8fafc;">
            <div style="display: flex; justify-content: space-between;">
                <div style="width: 50%; border-right: 1px solid #e2e8f0; padding-right: 15px;">
                    <div style="font-weight: 700; color: #475569; margin-bottom: 10px;">ফাইলের নাম / প্রমাণকের নাম :</div>
                    @if(is_array($land->documents) && count($land->documents))
                        <ul style="margin: 0; padding-left: 20px; color: #1e293b;">
                            @foreach($land->documents as $doc)
                                <li style="margin-bottom: 5px;">{{ $doc['document_name'] ?? 'Document' }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div style="color: #94a3b8; font-style: italic;">কোনো ফাইল নেই</div>
                    @endif
                </div>
                <div style="width: 50%; padding-left: 15px;">
                    <div style="font-weight: 700; color: #475569; margin-bottom: 10px;">গেজেট/প্রমাণক / ছবি সংযোজন করুন :</div>
                    @if(is_array($land->documents) && count($land->documents))
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($land->documents as $doc)
                                <li style="margin-bottom: 5px;">
                                    <a href="{{ asset('storage/' . ($doc['file_path'] ?? '')) }}" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 600;">
                                        <i class="fas fa-external-link-alt" style="font-size: 12px;"></i> Click to View
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div style="color: #94a3b8; font-style: italic;">কোনো ফাইল নেই</div>
                    @endif
                </div>
            </div>
        </div>



    </x-print-view>
@endsection