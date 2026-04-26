@extends('frontend.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-success">সনদ যাচাই করুন : অনুসন্ধান করুন</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('certificate.verify') }}" method="GET">
               

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <label>সনদ নং প্রদান করুন</label>
                        <input type="text" name="system_id" class="form-control"
                               placeholder="Enter Certificate Code"
                               value="{{ old('system_id', $system_id ?? '') }}">
                    </div>

                    <div class="col-md-3 mt-4">
                        <button class="btn btn-success w-100">
                            🔍 অনুসন্ধান করুন
                        </button>
                    </div>
                </div>

            </form>

            @if(isset($data))
                <div class="mt-4 p-3 bg-light border rounded">
                    <strong>সনদ নং:</strong> {{ $data->system_id }}  
                    <span>
                      সনদটি {{$data->created_at}}  তারিখে {{$data->user->name}}, পিতা: {{$data->user->familyInfo->father_name_bn}}, মাতা: : {{$data->user->familyInfo->mother_name_bn}}, জন্ম তারিখ: {{$data->user->people->date_of_birth??''}} কে: {{$data->user->institute->union->bn_name ?? '' }} এর চেয়ারম্যান কর্তৃক প্রদান করা হয়েছে।

                    </span>
                </div>
            @elseif(isset($system_id))
                <div class="alert alert-danger mt-4">
                    কোনো তথ্য পাওয়া যায়নি!
                </div>
            @endif

        </div>
    </div>
</div>

@endsection