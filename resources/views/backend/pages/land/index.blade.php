@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])



@section('title', 'জমির রেকর্ডের তালিকা')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <div class="cioas-shell">
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-list"></i> জমির রেকর্ডের তালিকা
                        </h3>
                        <a href="{{ route('land.create') }}" class="btn btn-material btn-material-primary">
                            <i class="fas fa-plus-circle"></i> নতুন জমি এন্ট্রি
                        </a>
                    </div>

                    <div class="cioas-panel-body">
                        <!-- Filters Row -->
                        <div class="row mb-4 p-3"
                            style="background-color: #f8fafc; border-radius: 8px; border: 1px solid var(--mc-line); margin: 0 0 20px 0;">
                            <div class="col-md-3 mb-2">
                                <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">জমির
                                    ধরণ</label>
                                <select id="filter_land_type" class="form-control select2">
                                    <option value="">সব জমির ধরণ</option>
                                    @foreach($landTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">রেকর্ড</label>
                                <select id="filter_record_type" class="form-control select2">
                                    <option value="">সব রেকর্ড</option>
                                    @foreach($records as $rec)
                                        <option value="{{ $rec->id }}">{{ $rec->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">জেলা</label>
                                <select id="filter_district_id" class="form-control select2">
                                    <option value="">সব জেলা</option>
                                    @foreach($districts as $dist)
                                        <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label
                                    style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">মৌজা</label>
                                <select id="filter_mouza_id" class="form-control select2">
                                    <option value="">সব মৌজা</option>
                                    @foreach($mouzas as $mouza)
                                        <option value="{{ $mouza->id }}">{{ $mouza->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table table-custom table-hover']) }}
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
        $(document).ready(function () {
            // Filter change handler
            $('#filter_land_type, #filter_record_type, #filter_district_id, #filter_mouza_id').on('change', function () {
                if (window.LaravelDataTables && window.LaravelDataTables["land-table"]) {
                    window.LaravelDataTables["land-table"].draw();
                }
            });

            // Approve record AJAX handler
            $(document).on('click', '.approve-btn', function (e) {
                e.preventDefault();
                let id = $(this).data('id');

                Swal.fire({
                    title: 'আপনি কি নিশ্চিত?',
                    text: 'আপনি কি সত্যিই এটি অনুমোদন করতে চান?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#475569',
                    confirmButtonText: 'হ্যাঁ, অনুমোদন করুন!',
                    cancelButtonText: 'বাতিল'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('land.approve') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
                            },
                            success: function (response) {
                                if (response.status) {
                                    toastr.success(response.message);
                                    if (window.LaravelDataTables && window.LaravelDataTables["land-table"]) {
                                        window.LaravelDataTables["land-table"].ajax.reload();
                                    }
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function () {
                                toastr.error('অনুমোদন করতে সমস্যা হয়েছে।');
                            }
                        });
                    }
                });
            });

            // Delete record AJAX handler

        });
    </script>
@endpush