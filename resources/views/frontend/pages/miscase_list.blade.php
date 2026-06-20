@extends('frontend.master')

@section('content')
<main>
    <section class="bg-[#f0f4f8] pt-10 pb-16 md:pt-16">
        <div class="container mx-auto max-w-screen-xl px-4">
            <div class="mx-auto max-w-5xl text-center mb-10">
                <h2 class="text-2xl font-bold tracking-tight text-[#006a4e] md:text-3xl border-b-4 border-[#f42a41] inline-block pb-2">
                    মিসকেস তালিকা
                </h2>
                <p class="mt-4 text-base text-gray-700 md:text-lg">
                    আপনার মিসকেস সম্পর্কিত তথ্য ও মামলার অবস্থা জানতে অনুসন্ধান করুন।
                </p>
            </div>

            <!-- Filter Section -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md border-t-4 border-[#006a4e]">
                <form action="{{ route('frontend.miscase.index') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4 justify-center">
                    <div class="w-full md:w-1/3">
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-1">রুজুর তারিখ</label>
                        <input type="date" id="date" name="date" value="{{ request('date') }}" class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 focus:border-[#006a4e] focus:ring-[#006a4e]">
                    </div>
                    <div class="w-full md:w-auto mt-auto">
                        <button type="submit" class="w-full md:w-auto rounded-md bg-[#006a4e] px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#00523b] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#006a4e] flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            অনুসন্ধান
                        </button>
                    </div>
                    @if(request('date'))
                    <div class="w-full md:w-auto mt-auto">
                        <a href="{{ route('frontend.miscase.index') }}" class="w-full md:w-auto rounded-md bg-gray-500 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-600 flex items-center justify-center gap-2">
                            রিসেট
                        </a>
                    </div>
                    @endif
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-[#006a4e]">
                        <tr>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">ক্রমিক নং</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">কেস নং</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">রুজুর তারিখ</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">বাদী</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">বিবাদী</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">শুনানীর তারিখ</th>
                            <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white">মামলার অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($miscases as $key => $miscase)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-4 py-4 text-gray-900">{{ $miscases->firstItem() + $key }}</td>
                            <td class="whitespace-nowrap px-4 py-4 text-[#006a4e] font-semibold">{{ $miscase->case_no }}</td>
                            <td class="whitespace-nowrap px-4 py-4 text-gray-700">
                                {{ $miscase->case_date ? \Carbon\Carbon::parse($miscase->case_date)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="px-4 py-4 text-gray-700">
                                @if(is_array($miscase->plaintiffs))
                                    @foreach($miscase->plaintiffs as $plaintiff)
                                        <div class="mb-1">{{ $plaintiff['name'] ?? '' }}</div>
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-4 py-4 text-gray-700">
                                @if(is_array($miscase->defendants))
                                    @foreach($miscase->defendants as $defendant)
                                        <div class="mb-1">{{ $defendant['name'] ?? '' }}</div>
                                    @endforeach
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-4 text-gray-700">
                                {{ $miscase->next_hearing_date ? \Carbon\Carbon::parse($miscase->next_hearing_date)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-4">
                                @if($miscase->status == 'running')
                                    <span class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">চলমান</span>
                                @elseif($miscase->status == 'resolved')
                                    <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">নিষ্পন্ন</span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-2 text-xs font-semibold leading-5 text-gray-800">{{ ucfirst($miscase->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                কোন মিসকেস তথ্য পাওয়া যায়নি।
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $miscases->links() }}
            </div>
            
        </div>
    </section>
</main>
@endsection
