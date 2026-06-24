@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryQuotationCreate'])

@section('title', 'Add New Quotation')

@push('css')
    <style>
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .item-row input[type="text"][readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.quotation.index') }}">Quotation</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Quotation Details</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.quotation.store') }}" method="POST" id="quotationForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quotation No <span class="text-danger">*</span></label>
                                    <input type="text" name="quotation_no" id="quotation_no" class="form-control" value="{{ $quotationNo }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Quotation Date <span class="text-danger">*</span></label>
                                    <input type="date" name="quotation_date" id="quotation_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Purpose of Requisition</label>
                                    <select class="form-control" name="purpose" id="purpose">
                                        <option value="">Select Purpose</option>
                                        <option value="Month Requisition">Month Requisition</option>
                                        <option value="Extra Requisition">Extra Requisition</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                            <div>
                                <h5 class="mb-1 text-primary">Item Details</h5>
                                <small class="text-muted">Use the action buttons to add or remove quotation items.</small>
                            </div>
                        </div>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered item-table mb-0" id="itemsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="min-width: 150px;">Product Type</th>
                                        <th style="min-width: 170px;">Category</th>
                                        <th style="min-width: 180px;">Item Name</th>
                                        <th style="min-width: 120px;">Unit</th>
                                        <th style="min-width: 150px;">Price</th>
                                        <th style="width: 95px;" class="no-print text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="quotationItemRows">
                                    <tr class="item-row">
                                        <td>
                                            <select class="form-control form-control-sm item-product-type" name="items[0][product_type]" required>
                                                <option value="">Select</option>
                                                <option value="One time use">One time use</option>
                                                <option value="All time use">All time use</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm item-category" name="items[0][category]" required>
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="items[0][item_name]" class="form-control form-control-sm item-name" required placeholder="Enter Item Name">
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm item-unit" name="items[0][unit]" required>
                                                <option value="">Select</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="items[0][price]" class="form-control form-control-sm text-right item-price" value="0.00" required>
                                        </td>
                                        <td class="text-center align-middle no-print">
                                            <button type="button" class="btn btn-sm btn-outline-primary add-item-row-inline mr-1" title="Add Item Row" aria-label="Add Item Row">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <button type="button" class="btn btn-primary" id="btnSubmit">
                                <i class="fas fa-save mr-1"></i> Save Quotation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categories = @json($categories);
        const units = @json($units);

        const itemRows = document.getElementById('quotationItemRows');

        const updateNames = () => {
            itemRows.querySelectorAll('tr').forEach((row, index) => {
                const productTypeInput = row.querySelector('.item-product-type');
                const categoryInput = row.querySelector('.item-category');
                const nameInput = row.querySelector('.item-name');
                const unitInput = row.querySelector('.item-unit');
                const priceInput = row.querySelector('.item-price');

                if (productTypeInput) productTypeInput.name = `items[${index}][product_type]`;
                if (categoryInput) categoryInput.name = `items[${index}][category]`;
                if (nameInput) nameInput.name = `items[${index}][item_name]`;
                if (unitInput) unitInput.name = `items[${index}][unit]`;
                if (priceInput) priceInput.name = `items[${index}][price]`;
            });
        };

        const buildItemRow = (afterRow = null) => {
            const rowIndex = itemRows.querySelectorAll('tr').length;
            const categoryOptions = ['<option value="">Select</option>']
                .concat(categories.map(category => `<option value="${category}">${category}</option>`))
                .join('');
            const unitOptions = ['<option value="">Select</option>']
                .concat(units.map(unit => `<option value="${unit}">${unit}</option>`))
                .join('');

            const tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = `
                <td>
                    <select class="form-control form-control-sm item-product-type" name="items[${rowIndex}][product_type]" required>
                        <option value="">Select</option>
                        <option value="One time use">One time use</option>
                        <option value="All time use">All time use</option>
                    </select>
                </td>
                <td>
                    <select class="form-control form-control-sm item-category" name="items[${rowIndex}][category]" required>
                        ${categoryOptions}
                    </select>
                </td>
                <td>
                    <input type="text" name="items[${rowIndex}][item_name]" class="form-control form-control-sm item-name" required placeholder="Enter Item Name">
                </td>
                <td>
                    <select class="form-control form-control-sm item-unit" name="items[${rowIndex}][unit]" required>
                        ${unitOptions}
                    </select>
                </td>
                <td>
                    <input type="text" name="items[${rowIndex}][price]" class="form-control form-control-sm text-right item-price" value="0.00" required>
                </td>
                <td class="text-center align-middle no-print">
                    <button type="button" class="btn btn-sm btn-outline-primary add-item-row-inline mr-1" title="Add Item Row" aria-label="Add Item Row">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-item-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

            if (afterRow) {
                afterRow.insertAdjacentElement('afterend', tr);
            } else {
                itemRows.appendChild(tr);
            }
            updateNames();
        };

        itemRows.addEventListener('click', function(event) {
            const addButton = event.target.closest('.add-item-row-inline');
            if (addButton) {
                buildItemRow(addButton.closest('tr'));
                return;
            }

            const removeButton = event.target.closest('.remove-item-row');
            if (!removeButton) {
                return;
            }

            const rows = itemRows.querySelectorAll('tr');
            const currentRow = removeButton.closest('tr');

            if (rows.length > 1) {
                currentRow.remove();
                updateNames();
            } else {
                currentRow.querySelectorAll('input, select').forEach((field) => {
                    field.value = '';
                });
                const priceInput = currentRow.querySelector('.item-price');
                if (priceInput) priceInput.value = '0.00';
            }
        });

        // Submit form
        $('#btnSubmit').click(function() {
            let isValid = true;
            
            // Basic validation
            $('#quotationForm input[required]').each(function() {
                if (!$(this).val().trim()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (isValid) {
                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Saving...');
                $('#quotationForm').submit();
            } else {
                alert('Please fill all required fields.');
            }
        });

        // Remove invalid class on input
        $(document).on('input', 'input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>
@endpush
