@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryRepairProduct'])

@section('title', 'Repairing Product Application')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Repairing Product Application</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Inventory</li>
                    <li class="breadcrumb-item active">Repairing Product</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Apply for Product Repair</h3>
            </div>
            <form action="{{ route('inventory.maintenance.repair.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Application Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="application_date" value="{{ old('application_date', now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Applicant Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="applicant_name" value="{{ old('applicant_name', auth()->user()->name ?? '') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Department Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="department_name" value="{{ old('department_name') }}" placeholder="Enter your department" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Select Product <span class="text-danger">*</span></label>
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
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Quantity to Repair <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" id="repairQty" value="{{ old('quantity') }}" min="1" required>
                            <small class="text-muted" id="qtyHelp">Max limit will update based on selection.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Product Type</label>
                            <input type="text" class="form-control" name="product_type" id="productType" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Category</label>
                            <input type="text" class="form-control" name="category" id="itemCategory" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Unit</label>
                            <input type="text" class="form-control" name="unit" id="itemUnit" readonly>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Problem Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="problem_description" rows="4" placeholder="Describe the problem, damages, or reason for repair." required>{{ old('problem_description') }}</textarea>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <button type="submit" id="submitRepairBtn" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Submit Application
                    </button>
                </div>
            </form>
        </div>
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
