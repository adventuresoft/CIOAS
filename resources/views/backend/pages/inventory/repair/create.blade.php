@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryRepairProduct'])

@push('style')
    <style>
        /* Premium Form Styling based on design_tem/form2.png */
        .repair-form-container {
            padding: 12px 8px;
        }

        .repair-form-container label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 6px;
            display: block;
        }

        .repair-form-container .form-control {
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

        .repair-form-container textarea.form-control {
            height: auto !important;
        }

        .repair-form-container .form-control:focus {
            border-color: #0f766e !important;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15) !important;
        }

        .repair-form-container .form-control[readonly],
        .repair-form-container .form-control[disabled] {
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed;
        }

        .repair-form-container select.form-control {
            padding: 8px 12px !important;
        }

        .btn-submit-repair {
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

        .btn-submit-repair:hover {
            background-color: #0d5e57;
            color: #ffffff;
            box-shadow: 0 6px 12px rgba(13, 94, 87, 0.2);
        }
    </style>
@endpush

@section('title', 'Repairing Product Application')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <!-- Alert Notifications -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #ef4444;">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show premium-card p-3 mb-4" role="alert"
                    style="border-left: 5px solid #10b981;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('inventory.maintenance.repair.store') }}" method="POST">
                @csrf
                <div class="cioas-panel">
                    <div class="cioas-panel-header">
                        <h3 class="cioas-panel-title">
                            <i class="fas fa-tools"></i> Apply for Product Repair
                        </h3>
                    </div>
                    <div class="cioas-panel-body repair-form-container">
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="application_date">Application Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="application_date" id="application_date" value="{{ old('application_date', now()->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="applicant_name">Applicant Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="applicant_name" id="applicant_name" value="{{ old('applicant_name', auth()->user()->name ?? '') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="department_name">Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="department_name" id="department_name" value="{{ old('department_name') }}" placeholder="Enter department name" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="itemSelect">Select Product <span class="text-danger">*</span></label>
                                <select class="form-control" name="item_name" id="itemSelect" required>
                                    <option value="">-- Select Product from Stock --</option>
                                    @foreach($stockItems as $item)
                                        <option value="{{ $item->item_name }}" 
                                                data-category="{{ $item->category }}" 
                                                data-unit="{{ $item->unit }}" 
                                                data-product-type="{{ $item->product_type }}"
                                                data-max="{{ $item->quantity }}">
                                            {{ $item->item_name }} (Available: {{ $item->quantity }} {{ $item->unit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="repairQty">Quantity to Repair <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" id="repairQty" value="{{ old('quantity') }}" min="1" required>
                                <small class="text-muted" id="qtyHelp">Max limit will update based on selection.</small>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="productType">Product Type</label>
                                <input type="text" class="form-control" name="product_type" id="productType" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="itemCategory">Category</label>
                                <input type="text" class="form-control" name="category" id="itemCategory" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="itemUnit">Unit</label>
                                <input type="text" class="form-control" name="unit" id="itemUnit" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="problem_description">Problem Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="problem_description" id="problem_description" rows="4" placeholder="Describe the problem, damages, or reason for repair." required>{{ old('problem_description') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" id="submitRepairBtn" class="btn btn-submit-repair">
                                <i class="fas fa-paper-plane mr-2"></i> Submit Application
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemSelect = document.getElementById('itemSelect');
        const qtyInput = document.getElementById('repairQty');
        const qtyHelp = document.getElementById('qtyHelp');
        const productTypeInput = document.getElementById('productType');
        const categoryInput = document.getElementById('itemCategory');
        const unitInput = document.getElementById('itemUnit');
        const submitBtn = document.getElementById('submitRepairBtn');

        itemSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (selectedOption.value) {
                const pType = selectedOption.dataset.productType || '';
                productTypeInput.value = pType;
                categoryInput.value = selectedOption.dataset.category || '';
                unitInput.value = selectedOption.dataset.unit || '';
                
                const maxQty = selectedOption.dataset.max;
                qtyInput.max = maxQty;
                qtyHelp.textContent = `Max available to repair: ${maxQty} ${selectedOption.dataset.unit}`;
                
                // If current value is higher than max, reset it
                if(parseInt(qtyInput.value) > parseInt(maxQty)) {
                    qtyInput.value = maxQty;
                }

                // Handle Submit Button state based on Product Type
                if (pType === 'One time use') {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                    submitBtn.style.cursor = 'not-allowed';
                    submitBtn.title = 'One time use products cannot be repaired.';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                    submitBtn.title = '';
                }
            } else {
                productTypeInput.value = '';
                categoryInput.value = '';
                unitInput.value = '';
                qtyInput.max = '';
                qtyHelp.textContent = 'Max limit will update based on selection.';
                
                // Enable button by default if nothing selected, or leave disabled until a valid option is selected
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.title = '';
            }
        });
    });
</script>
@endpush
