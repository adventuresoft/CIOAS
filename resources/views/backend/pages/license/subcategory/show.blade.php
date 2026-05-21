@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseSubcategory'])
@section('title', 'License Subcategory')
@section('content')
<section class="content">
    <div class="container-fluid pt-3">
        <div class="card card-info">
            <div class="card-header"><h3 class="card-title">License Subcategory</h3></div>
            <div class="card-body">
                <p><strong>Category:</strong> {{ $subcategory->category->en_name ?? '' }}</p>
                <p><strong>Name:</strong> {{ $subcategory->en_name }}</p>
                <p><strong>Name Bangla:</strong> {{ $subcategory->bn_name }}</p>
                <a href="{{ route('basic-settings.license-subcategory.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</section>
@endsection
