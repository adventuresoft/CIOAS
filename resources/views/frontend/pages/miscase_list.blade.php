@extends('frontend.master')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        /* Custom spacing for Datatables */
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="theme-form-card mb-4">
        <!-- Header -->
        <div class="theme-form-card-header">
            <i class="fas fa-search text-2xl"></i>
            <h2>মিসকেস তালিকা অনুসন্ধান</h2>
        </div>
        
        <div class="gov-body">
            <p class="fs-content text-dark mb-4">
                আপনার মিসকেস সম্পর্কিত তথ্য ও মামলার অবস্থা জানতে অনুসন্ধান করুন।
            </p>
            <form id="filterForm" class="d-flex flex-column flex-md-row align-items-end gap-3">
                <div class="form-group mb-0" style="min-width: 250px;">
                    <label for="date" class="form-label fw-bold text-dark mb-2">রুজুর তারিখ</label>
                    <input type="date" id="date" name="date" class="form-control">
                </div>
                <div class="form-group mb-0 d-flex gap-2">
                    <button type="submit" class="btn btn-gov-submit px-4 d-flex align-items-center gap-2">
                        <i class="fas fa-search"></i>
                        অনুসন্ধান
                    </button>
                    <button type="button" id="resetBtn" class="btn btn-gov-cancel px-4 d-flex align-items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        রিসেট
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-3 shadow-sm border-top border-5 border-success p-3">
        <div class="theme-form-card-header mb-4 border-bottom pb-3">
            <i class="fas fa-list text-2xl"></i>
            <h2>মিসকেস তালিকা</h2>
        </div>
        <div class="table-responsive">
            <table id="dataTable" class="theme-table table-hover w-100">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" width="5%">ক্রমিক নং</th>
                        <th scope="col" width="15%">কেস নং</th>
                        <th scope="col" width="12%">রুজুর তারিখ</th>
                        <th scope="col" width="20%">বাদী</th>
                        <th scope="col" width="20%">বিবাদী</th>
                        <th scope="col" width="13%">শুনানীর তারিখ</th>
                        <th scope="col" class="text-center" width="15%">মামলার অবস্থা</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('frontend.miscase.index') }}",
                    data: function (d) {
                        d.date = $('#date').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center align-middle' },
                    { data: 'case_no', name: 'case_no', className: 'align-middle fw-bold text-success' },
                    { data: 'case_date', name: 'case_date', className: 'align-middle' },
                    { data: 'plaintiffs', name: 'plaintiffs', className: 'align-middle' },
                    { data: 'defendants', name: 'defendants', className: 'align-middle' },
                    { data: 'next_hearing_date', name: 'next_hearing_date', className: 'align-middle' },
                    { data: 'status', name: 'status', className: 'text-center align-middle' }
                ],
                language: {
                    "search": "খুঁজুন:",
                    "lengthMenu": "প্রতি পৃষ্ঠায় _MENU_ টি রেকর্ড দেখান",
                    "zeroRecords": "কোনো তথ্য পাওয়া যায়নি",
                    "info": "মোট _PAGES_ পৃষ্ঠার মধ্যে _PAGE_ নম্বর পৃষ্ঠা দেখাচ্ছে",
                    "infoEmpty": "কোনো রেকর্ড উপলব্ধ নেই",
                    "infoFiltered": "(মোট _MAX_ টি রেকর্ড থেকে ফিল্টার করা হয়েছে)",
                    "paginate": {
                        "first": "প্রথম",
                        "last": "শেষ",
                        "next": "পরবর্তী",
                        "previous": "পূর্ববর্তী"
                    },
                    "processing": "লোড হচ্ছে..."
                }
            });

            $('#filterForm').on('submit', function (e) {
                e.preventDefault();
                table.draw();
            });

            $('#resetBtn').on('click', function (e) {
                e.preventDefault();
                $('#date').val('');
                table.draw();
            });
        });
    </script>
@endpush