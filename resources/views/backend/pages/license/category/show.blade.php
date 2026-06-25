@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Category')
@section('content')
    <section class="content">
        <div class="container-fluid pt-3">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">License Category</h3>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $category->en_name }}</p>
                    <p><strong>Name Bangla:</strong> {{ $category->bn_name }}</p>
                    <a href="{{ route('basic-settings.license-category.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection