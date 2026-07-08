@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'HotelCategory'])
@push('style')
@endpush
@section('title', 'Hotel Subcategory Details')
@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-eye"></i> Hotel Subcategory Details
                        </h3>
                    </div>
                    <div class="cioas-panel-body">
                        @if ($subcategory)
                            <table class="table table-bordered table-striped cioas-table">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%;">English Name</th>
                                        <td>{{ $subcategory->en_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bengali Name</th>
                                        <td>{{ $subcategory->bn_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hotel Category</th>
                                        <td>{{ $subcategory->category->en_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $subcategory->created_at ? $subcategory->created_at->format('d M, Y h:i A') : '—' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger">
                                Hotel Subcategory information not found.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="cioas-panel mt-3">
                    <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                        <a href="{{ route('basic-settings.hotel-subcategory.index', $subcategory->hotel_category_id) }}" class="btn btn-secondary btn-material">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush
