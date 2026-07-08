@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])

@section('title', 'License Subcategory')

@section('content')
    <!-- Main content -->
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> License Subcategory List
                        </h3>
                        <div>
                            <a href="{{ route('basic-settings.license-category.index') }}" class="btn btn-dark btn-material mr-2">
                                <i class="fas fa-arrow-left"></i> Back to Categories
                            </a>
                            <a href="{{ route('basic-settings.license-subcategory.create', $category_id) }}" class="btn btn-material btn-material-primary">
                                <i class="fas fa-plus-circle"></i> Create Subcategory
                            </a>
                        </div>
                    </div>

                    <div class="cioas-panel-body">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-custom table-hover w-100']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function() {
            // Setup CSRF token for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle Delete
            $(document).on('submit', '.deleteData', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this subcategory!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: form.serialize(),
                            success: function(response) {
                                if (response.status) {
                                    toastr.success(response.message);
                                    window.LaravelDataTables["licensesubcategory-table"].ajax.reload();
                                } else {
                                    toastr.error(response.message || 'Something went wrong!');
                                }
                            },
                            error: function(xhr) {
                                toastr.error('An error occurred while deleting.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush