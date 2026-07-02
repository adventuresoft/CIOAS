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
    <main>
        <section class="bg-[#f0f4f8] pt-10 pb-16 md:pt-16">
            <div class="container mx-auto max-w-screen-xl px-4">
                <div class="mx-auto max-w-5xl text-center mb-4">
                    <h2 class="section-title text-success fs-3">
                        মিসকেস তালিকা
                    </h2>
                    <p class="mt-2 fs-content text-dark">
                        আপনার মিসকেস সম্পর্কিত তথ্য ও মামলার অবস্থা জানতে অনুসন্ধান করুন।
                    </p>
                </div>

                <!-- Filter Section -->
                <div class="mb-4 bg-white p-4 rounded shadow-sm" style="border-top: 4px solid #10b981;">
                    <form id="filterForm"
                        class="d-flex flex-column flex-md-row align-items-end justify-content-center gap-3">
                        <div class="form-group mb-0" style="min-width: 250px;">
                            <label for="date" class="form-label fw-bold text-dark mb-2">রুজুর তারিখ</label>
                            <input type="date" id="date" name="date" class="form-control">
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success px-4 d-flex align-items-center gap-2">
                                <i class="fas fa-search"></i>
                                অনুসন্ধান
                            </button>
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" id="resetBtn"
                                class="btn btn-secondary px-4 d-flex align-items-center gap-2">
                                <i class="fas fa-sync-alt"></i>
                                রিসেট
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="table-responsive p-4">
                    <table id="dataTable" class="table table-hover mb-0 w-100">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ক্রমিক নং</th>
                                <th scope="col">কেস নং</th>
                                <th scope="col">রুজুর তারিখ</th>
                                <th scope="col">বাদী</th>
                                <th scope="col">বিবাদী</th>
                                <th scope="col">শুনানীর তারিখ</th>
                                <th scope="col" class="text-center">মামলার অবস্থা</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>
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