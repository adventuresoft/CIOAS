@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryDistribution'])

@push('style')
    <style>
        /* Premium Form Styling based on design_tem/form2.png */
        .distribution-container {
            padding: 12px 8px;
        }

        .distribution-container label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 6px;
            display: block;
        }

        .distribution-container .form-control {
            border-radius: 8px !important;
            border: 1.5px solid #cbd5e1 !important;
            height: 42px !important;
            padding: 8px 14px !important;
            font-size: 0.9rem !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            box-shadow: none !important;
            transition: all 0.15s ease-in-out !important;
        }

        .distribution-container .form-control:focus {
            border-color: #0f766e !important;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15) !important;
        }

        .distribution-container .form-control[readonly],
        .distribution-container .form-control[disabled] {
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed;
        }

        .distribution-container select.form-control {
            padding: 8px 12px !important;
        }

        .btn-submit-dist {
            background-color: #0f766e;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 10px 28px;
            border-radius: 8px;
            border: none;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(15, 118, 110, 0.15);
        }

        .btn-submit-dist:hover {
            background-color: #0d5e57;
            color: #ffffff;
            box-shadow: 0 6px 12px rgba(13, 94, 87, 0.2);
        }
        
        .snapshot-card {
            background-color: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px 20px;
        }
    </style>
@endpush

@section('title', 'Distribution')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <!-- Alert Notifications -->
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #10b981;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #ef4444;">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="cioas-panel">
                <div class="cioas-panel-header">
                    <h3 class="cioas-panel-title">
                        <i class="fas fa-dolly"></i> Stock Distribution
                    </h3>
                </div>
                <div class="cioas-panel-body distribution-container">
                    <!-- Requisition Selection -->
                    <form method="GET" action="{{ route('inventory.distribution') }}" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="requisition_id" class="font-weight-bold">Select Requisition</label>
                                <select name="requisition_id" id="requisition_id" class="form-control" onchange="this.form.submit()">
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
                        <div class="snapshot-card mb-4">
                            <h5 class="mb-3 font-weight-bold" style="color: #0f766e;"><i class="fas fa-info-circle mr-1"></i> Requisition Snapshot</h5>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label class="text-secondary text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Requisition No</label>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ $requisition->requisition_no }}</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="text-secondary text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Applicant Name</label>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ $requisition->applicant_name ?? '-' }}</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="text-secondary text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Department</label>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ $requisition->department_name ?? '-' }}</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="text-secondary text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Application Date</label>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ optional($requisition->application_date)->format('d M Y') ?: '-' }}</div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="text-secondary text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Priority Level</label>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">
                                        @if(strtolower($requisition->priority_level ?? '') == 'urgent' || strtolower($requisition->priority_level ?? '') == 'emergency')
                                            <span class="badge badge-danger">{{ $requisition->priority_level }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $requisition->priority_level }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="distributionForm" action="{{ route('inventory.distribution.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="requisition_id" value="{{ $requisition->id }}">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover w-100 mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;" class="text-center">Sl.</th>
                                            <th>Category</th>
                                            <th>Item Name</th>
                                            <th>Unit</th>
                                            <th class="text-center">Required Qty</th>
                                            <th class="text-center">Total Stock Qty</th>
                                            <th class="text-center" style="width: 150px;">Get Qty</th>
                                            <th class="text-center">Stock Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($distributionItems as $key => $item)
                                            @php
                                                $required = (int) ($item->required_quantity ?? 0);
                                                $stockReceive = (int) ($item->total_stock ?? 0);
                                                $getQty = 0;
                                            @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{ $key + 1 }}</td>
                                                <td class="align-middle">{{ $item->category ?: '-' }}
                                                    <input type="hidden" name="items[{{ $item->id }}][category]" value="{{ $item->category }}">
                                                </td>
                                                <td class="align-middle"><strong>{{ $item->item_name }}</strong>
                                                    <input type="hidden" name="items[{{ $item->id }}][item_name]" value="{{ $item->item_name }}">
                                                </td>
                                                <td class="align-middle">{{ $item->unit ?: '-' }}
                                                    <input type="hidden" name="items[{{ $item->id }}][unit]" value="{{ $item->unit }}">
                                                </td>
                                                <td class="align-middle text-center required-qty" data-val="{{ $required }}">
                                                    <span class="badge bg-secondary text-dark px-2 py-1">{{ $required }}</span>
                                                </td>
                                                <td class="align-middle text-center stock-qty" data-val="{{ $stockReceive }}">
                                                    <span class="badge bg-light text-dark px-2 py-1" style="border: 1px solid #cbd5e1;">{{ $stockReceive }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <input type="number" name="items[{{ $item->id }}][get_qty]" class="form-control text-right get-qty-input" value="{{ $getQty }}" min="0" step="1" style="width: 100%; height: 35px !important; border-radius: 6px !important; border: 1px solid #cbd5e1 !important;">
                                                </td>
                                                <td class="align-middle text-center font-weight-bold balance-cell" style="font-size: 15px;">
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

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-submit-dist">
                                    <i class="fas fa-check-circle mr-2"></i> Submit Distribution
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info text-center mt-3 premium-card p-3" style="border-left: 5px solid #0ea5e9;">
                            <i class="fas fa-info-circle mr-2"></i> Please select a Requisition to proceed with distribution.
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
                confirmButtonText: 'Close',
                confirmButtonColor: '#0f766e'
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
                confirmButtonColor: '#0f766e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay',
                cancelButtonText: 'Cancel'
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
