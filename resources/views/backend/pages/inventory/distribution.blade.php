@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryDistribution'])

@section('title', 'Distribution')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-7">
                    <h1 class="mb-1">Distribution</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.requisition.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Distribution</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title" style="font-size:24px; font-weight:600;">Distribution</h3>
                </div>
                <div class="card-body">
                    <!-- Requisition Selection -->
                    <form method="GET" action="{{ route('inventory.distribution') }}" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="font-weight-bold">Select Requisition</label>
                                <select name="requisition_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Select Requisition --</option>
                                    @foreach($requisitions as $req)
                                        <option value="{{ $req->id }}" {{ (request('requisition_id') == $req->id) ? 'selected' : '' }}>
                                            {{ $req->requisition_no }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    @if($requisition)
                        <hr>
                        <h4 class="mb-3 text-info">Requisition Snapshot</h4>
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Requisition No</label>
                                <div style="font-size: 16px; font-weight: 600;">{{ $requisition->requisition_no }}</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Name (Applicant)</label>
                                <div style="font-size: 16px; font-weight: 600;">{{ $requisition->applicant_name ?? '-' }}</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Department</label>
                                <div style="font-size: 16px; font-weight: 600;">{{ $requisition->department_name ?? '-' }}</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Date</label>
                                <div style="font-size: 16px; font-weight: 600;">{{ optional($requisition->application_date)->format('d M Y') ?: '-' }}</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Priority</label>
                                <div style="font-size: 16px; font-weight: 600;">{{ $requisition->priority_level ?? '-' }}</div>
                            </div>
                        </div>

                        <form id="distributionForm" action="{{ route('inventory.distribution.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="requisition_id" value="{{ $requisition->id }}">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Category</th>
                                            <th>Item Name</th>
                                            <th>Unit</th>
                                            <th>Required Qty</th>
                                            <th>Total Stock Quantity</th>
                                            <th>Get Qty</th>
                                            <th>Stock Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($distributionItems as $key => $item)
                                            @php
                                                $required = (int) ($item->required_quantity ?? 0);
                                                $stockReceive = (int) ($item->total_stock ?? 0);
                                                $getQty = 0; // Default or saved value could go here
                                            @endphp
                                            <tr>
                                                <td class="align-middle">{{ $key + 1 }}</td>
                                                <td class="align-middle">{{ $item->category ?: '-' }}
                                                    <input type="hidden" name="items[{{ $item->id }}][category]" value="{{ $item->category }}">
                                                </td>
                                                <td class="align-middle">{{ $item->item_name }}
                                                    <input type="hidden" name="items[{{ $item->id }}][item_name]" value="{{ $item->item_name }}">
                                                </td>
                                                <td class="align-middle">{{ $item->unit ?: '-' }}
                                                    <input type="hidden" name="items[{{ $item->id }}][unit]" value="{{ $item->unit }}">
                                                </td>
                                                <td class="align-middle required-qty" data-val="{{ $required }}">{{ $required }}</td>
                                                <td class="align-middle stock-qty" data-val="{{ $stockReceive }}">{{ $stockReceive }}</td>
                                                <td class="align-middle">
                                                    <input type="number" name="items[{{ $item->id }}][get_qty]" class="form-control form-control-sm text-right get-qty-input" value="{{ $getQty }}" min="0" step="1" style="width: 100px;">
                                                </td>
                                                <td class="align-middle font-weight-bold balance-cell">
                                                    0
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No item found for distribution.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info text-center mt-3">
                            <i class="fas fa-info-circle mr-1"></i> Please select a Requisition to proceed with distribution.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        @if(session('distribution_success'))
            Swal.fire({
                title: 'Success!',
                text: 'Successfully Distributed from Stock',
                icon: 'success',
                confirmButtonText: 'Close'
            }).then((result) => {
                window.location.href = "{{ route('inventory.stock') }}";
            });
        @endif

        @if($requisition)
        $('#distributionForm').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure to Submit to Requisition No : {{ $requisition->requisition_no }}",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        @endif

        function calculateBalance() {
            $('.get-qty-input').each(function() {
                let $row = $(this).closest('tr');
                let stockQty = parseFloat($row.find('.stock-qty').data('val')) || 0;
                let getQty = parseFloat($(this).val()) || 0;
                
                let balance = stockQty - getQty;
                let $balanceCell = $row.find('.balance-cell');
                
                $balanceCell.text(balance);
                
                // Color formatting
                if (balance >= 0) {
                    $balanceCell.removeClass('text-danger').addClass('text-success'); // Enough stock remaining
                } else {
                    $balanceCell.removeClass('text-success').addClass('text-danger'); // Distributing more than we have
                }
            });
        }

        // Calculate initially and on change
        calculateBalance();
        $('.get-qty-input').on('input', calculateBalance);
    });
</script>
@endpush
