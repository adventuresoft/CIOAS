@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'OrganizationShow'])

@section('title', 'Organization View')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Organization Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('organization.index')}}">Organization</a>
                    </li>
                    <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            Organization Information
        </h3>
    </div>

    <div class="card-body">

        {{-- Name --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Name:</div>
            <div class="col-sm-9">{{ $organization->name }}</div>
        </div>

        {{-- Bangla Name --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Name (Bangla):</div>
            <div class="col-sm-9">{{ $organization->bn_name }}</div>
        </div>

        {{-- Category --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Category:</div>
            <div class="col-sm-9">{{ $organization->category->en_name ?? '' }}</div>
        </div>

        {{-- Subcategory --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Sub Category:</div>
            <div class="col-sm-9">{{ $organization->subcategory->en_name ?? '' }}</div>
        </div>

        {{-- Type --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Type:</div>
            <div class="col-sm-9">{{ $organization->type->en_name ?? '' }}</div>
        </div>

        {{-- RJSC --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">RJSC:</div>
            <div class="col-sm-9">{{ $organization->rjsc_reg_no }}</div>
        </div>

        {{-- Division --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Division:</div>
            <div class="col-sm-9">{{ $organization->Division->name ?? '' }}</div>
        </div>

        {{-- District --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">District:</div>
            <div class="col-sm-9">{{ $organization->District->name ?? '' }}</div>
        </div>

        {{-- Thana --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Thana:</div>
            <div class="col-sm-9">{{ $organization->Thana->name ?? '' }}</div>
        </div>

        {{-- Union --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Union:</div>
            <div class="col-sm-9">{{ $organization->Union->name ?? '' }}</div>
        </div>

        {{-- Village --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Village:</div>
            <div class="col-sm-9">{{ $organization->Village->bn_name ?? '' }}</div>
        </div>

        {{-- Road --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Road:</div>
            <div class="col-sm-9">{{ $organization->road }}</div>
        </div>

        {{-- House --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">House:</div>
            <div class="col-sm-9">{{ $organization->house }}</div>
        </div>

        {{-- Capital --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Capital:</div>
            <div class="col-sm-9">{{ $organization->capital }}</div>
        </div>

        {{-- Status --}}
        <div class="row mb-2">
            <div class="col-sm-3 font-weight-bold">Status:</div>
            <div class="col-sm-9">
                @if($organization->status == 1)
                    <span class="badge badge-success">Approved</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                @endif
            </div>
        </div>

    </div>

    <div class="card-footer">

        <a href="{{route('organization.index')}}" class="btn btn-secondary">
            Back
        </a>

        @if($organization->status != 1)
        <button class="btn btn-success float-right" id="approveBtn">
            ✔ Approve
        </button>
        @endif

    </div>

</div>


<!-- ================= ORGANIZATION OWNERS ================= -->
<div class="card card-primary mt-3">
    <div class="card-header">
        <h3 class="card-title">Organization Owners</h3>
    </div>

    <div class="card-body">
        <div class="row">

            @forelse($organization->ownership ?? [] as $owner)

            <div class="col-md-6">
                <div class="card border shadow-sm">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $owner->user->image ?? 'https://via.placeholder.com/60' }}"
                                 class="rounded-circle mr-3"
                                 width="60" height="60">

                            <div>
                                <h5 class="mb-0">{{ $owner->user?->name }}</h5>
                                <small class="text-muted">{{ $owner->designation ?? 'Owner' }}</small>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-5 font-weight-bold">Father Name:</div>
                            <div class="col-7">{{ $owner->user->familyInfo->father_name ?? '-' }}</div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-5 font-weight-bold">Mother Name:</div>
                            <div class="col-7">{{ $owner->user->familyInfo->mother_name ?? '-' }}</div>
                        </div>
                        
                        <div class="row mb-1">
                            <div class="col-5 font-weight-bold">Phone:</div> 
                            <div class="col-7">{{ $owner->user?->mobile ?? '-' }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-5 font-weight-bold">Email:</div>
                            <div class="col-7">{{ $owner->user?->email ?? '-' }}</div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-5 font-weight-bold">NID:</div>
                            <div class="col-7">{{ $owner->user->nid ?? '-' }}</div>
                        </div>

                        <div class="row">
                            <div class="col-5 font-weight-bold">Present Address:</div>
                            <div class="col-7">
                                
                                 {{ collect([
    $owner->user->addressInfo->presentPostoffice->name ?? '',
    $owner->user->addressInfo->presentVillage->en_name ?? '',
    $owner->user->addressInfo->present_area ?? '',
    $owner->user->addressInfo->presentRoad->name ?? '',
    $owner->user->addressInfo->presentHouse->house ?? ''
])->filter()->implode(', ') }} 

                            
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-5 font-weight-bold">Permanent Address:</div>
                            <div class="col-7">
                               {{ collect([
    $owner->user->addressInfo->permanentDistrict->name ?? '',
    $owner->user->addressInfo->permanentThana->name ?? '',
    $owner->user->addressInfo->permanentPostoffice->name ?? '',
    $owner->user->addressInfo->permanentVillage->en_name ?? '',
    $owner->user->addressInfo->permanent_area ?? '',
    $owner->user->addressInfo->permanentRoad->name ?? '',
    $owner->user->addressInfo->permanentHouse->house ?? ''
])->filter()->implode(', ') }}

                                </div>
                        </div>

                    </div>
                </div>
            </div>

            @empty
                <div class="col-12 text-center text-muted">
                    No owners found
                </div>
            @endforelse

        </div>
    </div>
</div>

</div>
</section>

@endsection

@push('script')

<script>
$('#approveBtn').click(function(){

    if(confirm("Are you sure you want to approve this organization?")){

        $.ajax({
            url: "{{ route('organization.approve') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $organization->id }}"
            },
            success: function(response){
                alert("Approved Successfully");
                location.reload();
            },
            error: function(){
                alert("Something went wrong");
            }
        });

    }

});
</script>

@endpush