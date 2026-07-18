@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])

@section('title', 'জমির বিবরণী')

@push('style')
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@section('content')
    <x-print-view title="সরকারি স্বার্থ সংশ্লিষ্ট জমির বিবরণ">

        <!-- Navigation Buttons (Hidden on Print) -->
        <div class="no-print" style="display: flex; gap: 10px; margin-bottom: 20px; justify-content: flex-end;">
            @php
                $dbCase = $land->case->sortByDesc('id')->first();
                $allocation = \App\Models\LandAllocation::where('land_no', $land->land_no)->first();
            @endphp
            
            @if($dbCase)
                <a href="{{ route('land-cases.show', $dbCase->id) }}" class="btn btn-sm btn-danger" style="font-weight: 700; border-radius: 6px; padding: 7px 14px;">
                    <i class="fa fa-gavel"></i> মামলার বিবরণী দেখুন
                </a>
            @endif

            @if($allocation)
                <a href="{{ route('land-allocations.show', $allocation->id) }}" class="btn btn-sm btn-success" style="font-weight: 700; border-radius: 6px; padding: 7px 14px; background-color: #0f766e; border-color: #0f766e;">
                    <i class="fa fa-briefcase"></i> বরাদ্দ বিবরণী দেখুন
                </a>
            @endif
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 25px; font-size: 15px; font-weight: 600; color: #1e293b;">
            <div>
                <div style="margin-bottom: 5px;">জমির আইডি: <span style="font-weight: normal;">{{ $land->land_no ?? (str_pad($land->id, 7, '0', STR_PAD_LEFT) . '-' . date('m-Y')) }}</span></div>
                <div>জমির ধরণ: <span style="font-weight: normal;">{{ $land->type->bn_name ?? $land->land_type }}</span></div>
            </div>
            <div></div>
        </div>

        <div style="text-align: center; font-weight: 700; font-size: 15px; color: #0f766e; margin-bottom: 20px; border: 1px dashed #cbd5e1; padding: 10px; border-radius: 6px; background-color: #f8fafc;">
            সর্বশেষ রেকর্ড: {{ $land->record->bn_name ?? $land->record_type ?? '—' }}, 
            জেলা: {{ $land->district->bn_name ?? '—' }}, 
            উপজেলা/সার্কেল: {{ $land->upazila->bn_name ?? '—' }}, 
            মৌজা: {{ $land->mouza->bn_name ?? '—' }}, 
            জেএল নং: {{ $land->mouza->code ?? '—' }}
        </div>


        <div style="font-weight: 700; color: #0f766e; margin-bottom: 12px; font-size: 16px; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px;">দাগ ও খতিয়ান সংক্রান্ত বিবরণী</div>
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
                @if($land->dag_no)
                    <tr>
                        <td style="font-weight: 600;">{{ $land->dag_no }}</td>
                        <td style="font-weight: 600;">{{ $land->khatian_no }}</td>
                        <td>{{ $recordGroups->where('id', $land->recorded_class)->first()->bn_name ?? $land->recorded_class ?? '' }}</td>
                        <td>{{ $recordGroups->where('id', $land->actual_class)->first()->bn_name ?? $land->actual_class ?? '' }}</td>
                        <td>{{ number_format((float)($land->total_land ?? 0), 4) }}</td>
                        <td style="font-weight: 600; color: #0f766e;">{{ number_format((float)($land->land_amount ?? 0), 4) }}</td>
                        <td>{{ $land->possession_status ?? '' }}</td>
                        <td>{{ $land->case_no ?? '' }}</td>
                        <td>{{ $land->gazette_no ?? '' }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="9" style="text-align: center; color: #64748b; padding: 20px;">কোনো জমির বিবরণ পাওয়া যায়নি।</td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if(is_array($land->locations) && count($land->locations) > 0)
        <div style="font-weight: 700; color: #0f766e; margin-top: 25px; margin-bottom: 12px; font-size: 16px; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px;">রেকর্ড অনুযায়ী অবস্থান তথ্য</div>
        <table class="data-table" style="margin-bottom: 30px;">
            <thead>
                <tr>
                    <th>রেকর্ড</th>
                    <th>জেলা</th>
                    <th>উপজেলা</th>
                    <th>মৌজা</th>
                    <th>দাগ নং</th>
                    <th>খতিয়ান</th>
                    <th>রেকর্ড শ্রেণি</th>
                    <th>মোট দাগ নং</th>
                    <th>মোট জমি (একর)</th>
                    <th>রেকর্ডীয় মালিকের নাম</th>
                </tr>
            </thead>
            <tbody>
                @foreach($land->locations as $loc)
                <tr>
                    <td style="font-weight: 600; color: #1e3a8a;">{{ \App\Models\LandRecord::find($loc['record_type'] ?? '')->name ?? '—' }}</td>
                    <td>{{ \App\Models\District::find($loc['district_id'] ?? '')->name ?? '—' }}</td>
                    <td>{{ \App\Models\Upazila::find($loc['upazila_id'] ?? '')->name ?? '—' }}</td>
                    <td>{{ \App\Models\Mouza::find($loc['mouza_id'] ?? '')->name ?? '—' }}</td>
                    <td style="font-weight: 600;">{{ $loc['dag_no'] ?? '—' }}</td>
                    <td style="font-weight: 600;">{{ $loc['khatian_no'] ?? '—' }}</td>
                    <td>{{ \App\Models\LandClass::find($loc['record_group'] ?? '')->bn_name ?? '—' }}</td>
                    <td>{{ $loc['total_dag_no'] ?? '—' }}</td>
                    <td style="font-weight: 600; color: #0f766e;">{{ number_format((float)($loc['total_land'] ?? 0), 4) }}</td>
                    <td>{{ $loc['owner_name'] ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <table class="data-table" style="margin-top: 30px;">
            <tr>
                <td style="width: 33.33%; vertical-align: top; padding: 15px;">
                    <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 12px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">মামলা সংক্রান্ত তথ্য</div>
                    @php
                        $dbCase = $land->case->sortByDesc('id')->first();
                        $hasCase = ($dbCase && $dbCase->has_case == 1) || !empty($land->case_no) ? 'হ্যাঁ' : 'না';
                        $caseNo = $dbCase->case_no ?? $land->case_no ?? '';
                        $courtName = $dbCase->court_name ?? '';
                        $caseStatus = $dbCase->case_status ?? '';
                        $comment = $dbCase->comment ?? $land->remarks ?? '';
                    @endphp
                    <div style="margin-bottom: 8px;"><strong>কোনো মামলা আছে :</strong> <span style="color: {{ $hasCase == 'হ্যাঁ' ? '#ef4444' : '#1e293b' }}">{{ $hasCase }}</span></div>
                    <div style="margin-bottom: 8px;"><strong>মামলা নম্বর :</strong> {{ $caseNo ?: '—' }}</div>
                    <div style="margin-bottom: 8px;"><strong>আদালতের নাম :</strong> {{ $courtName ?: '—' }}</div>
                    <div style="margin-bottom: 8px;"><strong>মামলার সর্বশেষ অবস্থা :</strong> {{ $caseStatus ?: '—' }}</div>
                    <div style="margin-bottom: 8px;"><strong>মন্তব্য :</strong> {{ $comment ?: '—' }}</div>
                </td>
                <td style="width: 33.33%; vertical-align: top; padding: 15px;">
                    <div style="font-weight: 700; color: #0f766e; margin-bottom: 12px; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">দখল সংক্রান্ত তথ্য</div>
                    @php
                        $possession = $land->possession_status ?? '';
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
                                    <a href="{{ str_starts_with($doc['file_path'] ?? '', 'uploads/') ? asset($doc['file_path']) : asset('storage/' . ($doc['file_path'] ?? '')) }}" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 600;">
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

    <!-- Action Buttons (Hidden on Print) -->
    <div class="container no-print mt-4 mb-5" style="display: flex; justify-content: flex-end; gap: 15px;">
        @if($land->status == 0)
        <button type="button" class="btn" style="background-color: #10b981; color: white; padding: 10px 24px; font-weight: 600; border-radius: 6px; border: none; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); transition: all 0.2s;" onclick="approveLand({{ $land->id }})" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fas fa-check-circle mr-2"></i> Approve
        </button>
        @else
        <button type="button" class="btn" style="background-color: #cbd5e1; color: #475569; padding: 10px 24px; font-weight: 600; border-radius: 6px; border: none; cursor: not-allowed;" disabled>
            <i class="fas fa-check-double mr-2"></i> Approved
        </button>
        @endif
        <button type="button" class="btn" style="background-color: #3b82f6; color: white; padding: 10px 24px; font-weight: 600; border-radius: 6px; border: none; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2); transition: all 0.2s;" onclick="printPage('portrait')" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fas fa-print mr-2"></i> Print Portrait
        </button>
        <button type="button" class="btn" style="background-color: #8b5cf6; color: white; padding: 10px 24px; font-weight: 600; border-radius: 6px; border: none; box-shadow: 0 4px 6px -1px rgba(139, 92, 246, 0.2); transition: all 0.2s;" onclick="printPage('landscape')" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fas fa-print mr-2"></i> Print Landscape
        </button>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function printPage(orientation) {
        var css = '@page { size: ' + orientation + '; }';
        var head = document.head || document.getElementsByTagName('head')[0];
        var style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';
        style.id = 'print-orientation';
        
        var oldStyle = document.getElementById('print-orientation');
        if (oldStyle) {
            oldStyle.remove();
        }
        
        style.appendChild(document.createTextNode(css));
        head.appendChild(style);
        
        window.print();
    }

    function approveLand(id) {
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            text: "আপনি কি এই জমির বিবরণী অনুমোদন করতে চান?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'হ্যাঁ, অনুমোদন করুন!',
            cancelButtonText: 'না, বাতিল করুন'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('land.approve') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        if(response.status) {
                            Swal.fire(
                                'অনুমোদিত!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('ত্রুটি', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('ত্রুটি', 'কিছু একটা সমস্যা হয়েছে।', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush