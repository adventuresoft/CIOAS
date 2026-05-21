@extends('backend.master', ['mainMenu' => 'License', 'subMenu' => 'LicenseShow'])
@section('title', 'License Details')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>License Details</h1></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('license.index') }}">License</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header"><h3 class="card-title">License Information</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6"><strong>Application ID:</strong> {{ $license->application_id }}</div>
                    <div class="col-md-6"><strong>Name:</strong> {{ $license->name }}</div>
                    <div class="col-md-6"><strong>Name Bangla:</strong> {{ $license->bn_name }}</div>
                    <div class="col-md-6"><strong>Category:</strong> {{ $license->category->en_name ?? '' }}</div>
                    <div class="col-md-6"><strong>Subcategory:</strong> {{ $license->subcategory->en_name ?? '' }}</div>
                    <div class="col-md-6"><strong>License No.:</strong> {{ $license->license_no ?? '' }}</div>
                    <div class="col-md-6"><strong>Issue Date:</strong> {{ $license->issue_date ?? '' }}</div>
                    <div class="col-md-6"><strong>Expire Date:</strong> {{ $license->expire_date ?? '' }}</div>
                    <div class="col-md-6"><strong>Application Type:</strong> {{ strtoupper($license->application_type ?? '') }}</div>
                    <div class="col-md-12"><strong>Remarks:</strong> {{ $license->remarks ?? '' }}</div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('license.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('license.edit', $license->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</section>
@endsection
