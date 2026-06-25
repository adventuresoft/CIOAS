@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'LicenseCategory'])
@section('title', 'License Subcategory')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>License Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('basic-settings.license-subcategory.index', $category_id) }}">License
                                Subcategory</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="cioas-panel">
                <div class="panel-header">
                    <div class="header-content d-flex justify-content-between align-items-center">
                        <h3 class="panel-title">License Subcategory List</h3>
                        <div class="header-actions">
                            <a href="{{ route('basic-settings.license-category.index') }}" class="btn btn-secondary mr-2">
                                <i class="ti ti-arrow-left"></i> Back to Categories
                            </a>
                            <a href="{{ route('basic-settings.license-subcategory.create', $category_id) }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i> Create Subcategory
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped cioas-table w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th>English Name</th>
                                    <th>Bengali Name</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $key => $subcategory)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>{{ $subcategory->en_name }}</td>
                                        <td>{{ $subcategory->bn_name }}</td>
                                        <td>{{ $subcategory->category->en_name ?? '' }}</td>
                                        <td>{{ date('d M, Y', strtotime($subcategory->created_at)) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <a href="{{ route('basic-settings.license-subcategory.show', $subcategory->id) }}" class="btn btn-sm btn-info text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="View">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="{{ route('basic-settings.license-subcategory.edit', $subcategory->id) }}" class="btn btn-sm btn-warning text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('basic-settings.license-subcategory.destroy', $subcategory->id) }}" method="POST" class="deleteSubcategory">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Delete">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#example1').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'],
                initComplete: function() {
                    $('.dataTables_filter input').attr('placeholder', 'অনুসন্ধান করুন...');
                },
                language: {
                    search: '',
                    searchPlaceholder: 'অনুসন্ধান করুন...',
                    lengthMenu: '_MENU_ রেকর্ড প্রতি পৃষ্ঠায়',
                    zeroRecords: 'কোনো রেকর্ড পাওয়া যায়নি',
                    info: '_TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ পর্যন্ত দেখানো হচ্ছে',
                    infoEmpty: 'কোনো রেকর্ড উপলব্ধ নেই',
                    infoFiltered: '(মোট _MAX_ রেকর্ড থেকে ফিল্টার করা হয়েছে)',
                    paginate: {
                        first: 'প্রথম',
                        last: 'শেষ',
                        next: 'পরবর্তী',
                        previous: 'পূর্ববর্তী'
                    }
                }
            });

            $('.deleteSubcategory').on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                let url = thisForm.attr('action');
                
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
                            type: 'POST', // Using POST with _method=DELETE from the form
                            url: url,
                            data: thisForm.serialize(),
                            success: function (response) {
                                if(response.status) {
                                    toastr.success(response.message);
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    toastr.error(response.message || 'Something went wrong!');
                                }
                            },
                            error: function (xhr) {
                                toastr.error(jQuery.parseJSON(xhr.responseText).message || 'An error occurred while deleting.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush