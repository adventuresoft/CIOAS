@php
    $organization = $license ?? null;
    $subcategoryOptionsUrl = url('license-subcategory-options');
@endphp

@include('backend.pages.hotel-restaurant.forms.hotel-restaurant', [
    'organization' => $organization,
    'subcategoryOptionsUrl' => $subcategoryOptionsUrl,
])
