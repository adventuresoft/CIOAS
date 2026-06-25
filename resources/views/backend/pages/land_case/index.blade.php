@extends('backend.master', ['mainMenu' => 'Land', 'subMenu' => 'LandCaseList'])

@section('title', 'জমির মামলার তালিকা')

@push('style')
<style>
    .cioas-panel {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    .cioas-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
    }
    .cioas-panel-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .cioas-panel-title i {
        color: #3b82f6;
        margin-right: 8px;
    }
    .cioas-panel-body {
        padding: 25px;
    }
</style>
@endpush

@section('content')
<section class="content-header pt-4 pb-0">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-gray-800" style="font-weight: 700; font-size: 24px;">জমির মামলার তালিকা</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background: transparent; padding: 0; margin-bottom: 0;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #3b82f6;">হোম</a></li>
                    <li class="breadcrumb-item active" style="color: #64748b;">জমির মামলার তালিকা</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content pt-3">
    <div class="container-fluid">
        <div class="cioas-shell">
            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-list"></i> জমির মামলার তালিকা
                    </h3>
                    <a href="{{ route('land-cases.create') }}" class="btn btn-primary" style="font-weight: 600;">
                        <i class="fas fa-plus-circle"></i> নতুন মামলা তৈরী করুন
                    </a>
                </div>

                <div class="cioas-panel-body">
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover']) }}
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
        $(document).on('submit', '.deleteData', function(e) {
            e.preventDefault();
            let form = $(this);
            let url = form.find('.deleteUrl').val();
            let redirect = form.find('.redirect-url').val();
            
            if (confirm('আপনি কি এই মামলাটি মুছে ফেলতে চান?')) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message);
                            if (window.LaravelDataTables && window.LaravelDataTables["land-cases-table"]) {
                                window.LaravelDataTables["land-cases-table"].ajax.reload();
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
