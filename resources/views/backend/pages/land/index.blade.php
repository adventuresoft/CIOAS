@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandList'])

@push('style')
<style>
    .miscase-page {
        --mc-primary: #0f766e;
        --mc-primary-dark: #115e59;
        --mc-accent: #f59e0b;
        --mc-ink: #17202a;
        --mc-muted: #64748b;
        --mc-line: #dbe5ea;
        --mc-surface: #ffffff;
        background:
            linear-gradient(135deg, rgba(15, 118, 110, .12), rgba(245, 158, 11, .09)),
            #f5f7fa;
        min-height: calc(100vh - 120px);
        padding-bottom: 32px;
    }

    .miscase-shell {
        max-width: 1400px;
        margin: 0 auto;
    }

    .miscase-panel {
        background: var(--mc-surface);
        border: 1px solid rgba(219, 229, 234, .85);
        border-radius: 8px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        margin-bottom: 18px;
        overflow: hidden;
    }

    .miscase-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 20px;
        border-bottom: 1px solid var(--mc-line);
        background: linear-gradient(180deg, #fff, #f8fbfb);
    }

    .miscase-panel-title {
        display: flex;
        gap: 10px;
        align-items: center;
        color: var(--mc-ink);
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .miscase-panel-title i {
        color: var(--mc-primary);
    }

    .miscase-panel-body {
        padding: 20px;
    }

    .btn-material {
        border-radius: 8px;
        font-weight: 700;
        padding: 10px 18px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-material-primary {
        background: var(--mc-primary);
        border-color: var(--mc-primary);
        color: #fff;
    }

    .btn-material-primary:hover {
        background: var(--mc-primary-dark);
        border-color: var(--mc-primary-dark);
        color: #fff;
    }

    /* DataTable Customization */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--mc-line);
        border-radius: 6px;
        padding: 6px 12px;
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--mc-primary);
        box-shadow: 0 0 0 3px rgba(15, 118, 110, .12);
    }

    .table-custom {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid var(--mc-line);
        border-radius: 8px;
        overflow: hidden;
        width: 100% !important;
    }

    .table-custom thead th {
        background: rgba(15, 118, 110, .05);
        color: var(--mc-ink);
        font-weight: 700;
        border-bottom: 2px solid var(--mc-line) !important;
        border-top: none;
        padding: 15px;
        font-size: 14px;
        vertical-align: middle;
    }

    .table-custom tbody td {
        vertical-align: middle;
        color: #475569;
        border-color: var(--mc-line);
        padding: 12px 15px;
    }

    .table-custom tbody tr:hover {
        background-color: #f8fafc;
    }
    
    table.dataTable.table-custom > thead > tr > th:not(.sorting_disabled),
    table.dataTable.table-custom > thead > tr > td:not(.sorting_disabled) {
        padding-right: 30px;
    }
</style>
@endpush

@section('title', 'জমির রেকর্ডের তালিকা')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>জমির রেকর্ডের তালিকা</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('land.index') }}">জমির রেকর্ড</a></li>
                    <li class="breadcrumb-item active">তালিকা</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content miscase-page pt-3">
    <div class="container-fluid">
        <div class="miscase-shell">
            <div class="miscase-panel">
                <div class="miscase-panel-header">
                    <h3 class="miscase-panel-title">
                        <i class="fas fa-list"></i> জমির রেকর্ডের তালিকা
                    </h3>
                    <a href="{{ route('land.create') }}" class="btn btn-material btn-material-primary">
                        <i class="fas fa-plus-circle"></i> নতুন জমি এন্ট্রি
                    </a>
                </div>

                <div class="miscase-panel-body">
                    <!-- Filters Row -->
                    <div class="row mb-4 p-3" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid var(--mc-line); margin: 0 0 20px 0;">
                        <div class="col-md-3 mb-2">
                            <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">জমির ধরণ</label>
                            <select id="filter_land_type" class="form-control select2">
                                <option value="">সব জমির ধরণ</option>
                                @foreach($landTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->bn_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">রেকর্ড</label>
                            <select id="filter_record_type" class="form-control select2">
                                <option value="">সব রেকর্ড</option>
                                @foreach($records as $rec)
                                    <option value="{{ $rec->id }}">{{ $rec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">জেলা</label>
                            <select id="filter_district_id" class="form-control select2">
                                <option value="">সব জেলা</option>
                                @foreach($districts as $dist)
                                    <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label style="font-weight:700; font-size:12.5px; color:#475569; margin-bottom:6px;">মৌজা</label>
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
    $(document).ready(function() {
        // Filter change handler
        $('#filter_land_type, #filter_record_type, #filter_district_id, #filter_mouza_id').on('change', function () {
            if (window.LaravelDataTables && window.LaravelDataTables["land-table"]) {
                window.LaravelDataTables["land-table"].draw();
            }
        });

        // Approve record AJAX handler
        $(document).on('click', '.approve-btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            
            if (confirm('আপনি কি এই জমির রেকর্ডটি অনুমোদন করতে চান?')) {
                $.ajax({
                    url: "{{ route('land.approve') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            if (window.LaravelDataTables && window.LaravelDataTables["land-table"]) {
                                window.LaravelDataTables["land-table"].ajax.reload();
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('অনুমোদন করতে ব্যর্থ হয়েছে।');
                    }
                });
            }
        });

        // Delete record AJAX handler
        $(document).on('submit', '.deleteData', function(e) {
            e.preventDefault();
            let form = $(this);
            let url = form.find('.deleteUrl').val();
            let redirect = form.find('.redirect-url').val();
            
            if (confirm('আপনি কি এই জমির রেকর্ডটি মুছে ফেলতে চান?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            if (window.LaravelDataTables && window.LaravelDataTables["land-table"]) {
                                window.LaravelDataTables["land-table"].ajax.reload();
                            } else {
                                window.location.href = redirect;
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('মুছে ফেলতে ব্যর্থ হয়েছে।');
                    }
                });
            }
        });
    });
</script>
@endpush
