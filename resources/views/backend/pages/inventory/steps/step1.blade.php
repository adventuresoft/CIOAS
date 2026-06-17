<form id="inventoryRequisitionForm" method="POST" action="{{ route('inventory.store') }}" class="mb-4">
    @csrf
    <input type="hidden" name="items_payload" id="items_payload">
    <div class="card workflow-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-start">
        <div>
            <div class="d-flex align-items-center mb-1">
                <span class="badge badge-step mr-2">Section 1</span>
                <h4 class="card-title mb-0">Applicant Requisition Form</h4>
            </div>
            <div class="text-muted">Create a requisition, add items, then continue to the next section.</div>
        </div>
    </div>
    <div class="card-body">
        <div id="section1Alert" class="alert alert-danger d-none"></div>
        @php
            $requisitionInfo = $requisition ?? null;
            $savedItems = $requisitionItems->isNotEmpty() ? $requisitionItems : collect();
            $hiddenDepartmentName = old('department_name', $requisitionInfo->department_name ?? ($profileDefaults['department_name'] ?? ''));
            $hiddenApplicantName = old('applicant_name', $requisitionInfo->applicant_name ?? ($profileDefaults['applicant_name'] ?? ''));
            $hiddenDesignation = old('designation', $requisitionInfo->designation ?? ($profileDefaults['designation'] ?? ''));
            $hiddenMobileNumber = old('mobile_number', $requisitionInfo->mobile_number ?? ($profileDefaults['mobile_number'] ?? ''));
            $hiddenEmailAddress = old('email_address', $requisitionInfo->email_address ?? ($profileDefaults['email_address'] ?? ''));
        @endphp
        <input type="hidden" id="department_name" name="department_name" value="{{ $hiddenDepartmentName }}">
        <input type="hidden" id="applicant_name" name="applicant_name" value="{{ $hiddenApplicantName }}">
        <input type="hidden" id="designation" name="designation" value="{{ $hiddenDesignation }}">
        <input type="hidden" id="mobile_number" name="mobile_number" value="{{ $hiddenMobileNumber }}">
        <input type="hidden" id="email_address" name="email_address" value="{{ $hiddenEmailAddress }}">

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="font-weight-bold">Requisition No</label>
                <input type="text" class="form-control" value="{{ $requisitionInfo->requisition_no ?? 'Auto Generated' }}" readonly>
            </div>
            <div class="col-md-3 mb-3">
                <label class="font-weight-bold">Requisition Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="application_date" name="application_date" value="{{ old('application_date', optional($requisitionInfo?->application_date)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="font-weight-bold">Priority Level <span class="text-danger">*</span></label>
                <select class="form-control" id="priority_level" name="priority_level" required>
                    <option value="">Select Priority</option>
                    @php
                        $selectedPriority = old('priority_level', $requisitionInfo->priority_level ?? 'Normal');
                    @endphp
                    <option value="Normal" {{ $selectedPriority === 'Normal' ? 'selected' : '' }}>Normal</option>
                    <option value="Urgent" {{ $selectedPriority === 'Urgent' ? 'selected' : '' }}>Urgent</option>
                    <option value="Emergency" {{ $selectedPriority === 'Emergency' ? 'selected' : '' }}>Emergency</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="font-weight-bold">Purpose of Requisition</label>
                <select class="form-control" id="purpose" name="purpose">
                    <option value="">Select Purpose</option>
                    @php
                        $selectedPurpose = old('purpose', $requisitionInfo->purpose ?? '');
                    @endphp
                    <option value="Month Requisition" {{ $selectedPurpose === 'Month Requisition' ? 'selected' : '' }}>Month Requisition</option>
                    <option value="Extra Requisition" {{ $selectedPurpose === 'Extra Requisition' ? 'selected' : '' }}>Extra Requisition</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="mb-1 text-primary">Item Details</h5>
                <small class="text-muted">Use the action buttons to add or remove requisition items.</small>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered item-table mb-0">
                <thead>
                    <tr>
                        <th style="min-width: 170px;">Category</th>
                        <th style="min-width: 180px;">Item Name</th>
                        <th style="min-width: 120px;">Unit</th>
                        <th style="min-width: 130px;">Required Qty</th>
                        <th style="width: 95px;" class="no-print">Action</th>
                    </tr>
                </thead>
                <tbody id="requisitionItemRows">
                    @if ($savedItems->isNotEmpty())
                        @foreach ($savedItems as $item)
                            <tr data-item-row>
                                <td>
                                    <select class="form-control form-control-sm item-category" required>
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}" {{ ($item->category ?? '') === $category ? 'selected' : '' }}>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm item-name" value="{{ $item->item_name ?? '' }}" placeholder="Type item name" required>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm item-unit" required>
                                        <option value="">Select</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit }}" {{ ($item->unit ?? '') === $unit ? 'selected' : '' }}>{{ $unit }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="0" step="1" class="form-control form-control-sm text-right item-qty" value="{{ isset($item->required_quantity) ? (int)$item->required_quantity : '' }}" placeholder="0" required>
                                </td>
                                <td class="text-center no-print">
                                    <div class="item-action-group">
                                        <button type="button" class="btn btn-primary item-action-btn add-item-row-inline" title="Add Item Row" aria-label="Add Item Row">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger item-action-btn remove-item-row" title="Delete Item Row" aria-label="Delete Item Row">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr data-item-row>
                            <td>
                                <select class="form-control form-control-sm item-category" required>
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm item-name" value="" placeholder="Type item name" required>
                            </td>
                            <td>
                                <select class="form-control form-control-sm item-unit" required>
                                    <option value="">Select</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" min="0" step="1" class="form-control form-control-sm text-right item-qty" value="" placeholder="0" required>
                            </td>
                            <td class="text-center no-print">
                                <div class="item-action-group">
                                    <button type="button" class="btn btn-primary item-action-btn add-item-row-inline" title="Add Item Row" aria-label="Add Item Row">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger item-action-btn remove-item-row" title="Delete Item Row" aria-label="Delete Item Row">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3 d-none">
                <div class="summary-card p-3">
                    <div class="text-muted small">Total Quantity</div>
                    <h4 class="mb-0" id="totalQuantity">0</h4>
                </div>
            </div>
            <div class="col-lg-12 mb-3 text-lg-right align-self-end no-print">
                <button type="submit" class="btn btn-primary btn-lg px-4" id="saveNextSection1">
                    Submit <i class="fas fa-check ml-2"></i>
                </button>
            </div>
        </div>
    </div>
    </div>
</form>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categories = @json($categories);
            const units = @json($units);
            const itemRows = document.getElementById('requisitionItemRows');
            const totalQuantityEl = document.getElementById('totalQuantity');
            const section1Alert = document.getElementById('section1Alert');
            const requisitionForm = document.getElementById('inventoryRequisitionForm');
            const itemsPayload = document.getElementById('items_payload');
            const numberValue = (value) => {
                const parsed = parseFloat(value);
                return Number.isFinite(parsed) ? parsed : 0;
            };

            const setInvalid = (element, state) => {
                if (element) {
                    element.classList.toggle('is-invalid', state);
                }
            };

            const showAlert = (messages) => {
                section1Alert.innerHTML = '<strong>Please complete the following:</strong><ul class="mb-0 pl-3 mt-2">' +
                    messages.map(message => `<li>${message}</li>`).join('') + '</ul>';
                section1Alert.classList.remove('d-none');
            };

            const hideAlert = () => {
                section1Alert.classList.add('d-none');
                section1Alert.innerHTML = '';
            };

            const calculateSummary = () => {
                let totalQuantity = 0;

                document.querySelectorAll('#requisitionItemRows tr').forEach((row) => {
                    const quantity = numberValue(row.querySelector('.item-qty')?.value);
                    totalQuantity += quantity;
                });

                totalQuantityEl.textContent = totalQuantity;
            };

            const serializeItems = () => {
                return Array.from(document.querySelectorAll('#requisitionItemRows tr')).map((row) => ({
                    category: row.querySelector('.item-category')?.value || '',
                    item_name: row.querySelector('.item-name')?.value || '',
                    unit: row.querySelector('.item-unit')?.value || '',
                    required_quantity: numberValue(row.querySelector('.item-qty')?.value),
                }));
            };

            const addRow = (afterRow = null) => {
                const categoryOptions = ['<option value="">Select</option>'].concat(categories.map(category => `<option value="${category}">${category}</option>`)).join('');
                const unitOptions = ['<option value="">Select</option>'].concat(units.map(unit => `<option value="${unit}">${unit}</option>`)).join('');
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><select class="form-control form-control-sm item-category" required>${categoryOptions}</select></td>
                    <td><input type="text" class="form-control form-control-sm item-name" required></td>
                    <td><select class="form-control form-control-sm item-unit" required>${unitOptions}</select></td>
                    <td><input type="number" min="0" step="1" class="form-control form-control-sm text-right item-qty" value="" placeholder="0" required></td>
                    <td class="text-center no-print">
                        <div class="item-action-group">
                            <button type="button" class="btn btn-primary item-action-btn add-item-row-inline" title="Add Item Row" aria-label="Add Item Row">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-danger item-action-btn remove-item-row" title="Delete Item Row" aria-label="Delete Item Row">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>`;
                if (afterRow) {
                    afterRow.insertAdjacentElement('afterend', row);
                } else {
                    itemRows.appendChild(row);
                }
                calculateSummary();
            };

            const validate = () => {
                hideAlert();
                const errors = [];

                [
                    { element: document.getElementById('application_date'), label: 'Requisition Date' },
                    { element: document.getElementById('priority_level'), label: 'Priority Level' },
                ].forEach(({ element, label }) => {
                    const hasValue = element && String(element.value || '').trim().length > 0;
                    setInvalid(element, !hasValue);
                    if (!hasValue) errors.push(`${label} is required`);
                });

                document.querySelectorAll('#requisitionItemRows tr').forEach((row, index) => {
                    [
                        { element: row.querySelector('.item-category'), label: `Item ${index + 1}: Category` },
                        { element: row.querySelector('.item-name'), label: `Item ${index + 1}: Item Name` },
                        { element: row.querySelector('.item-unit'), label: `Item ${index + 1}: Unit` },
                        { element: row.querySelector('.item-qty'), label: `Item ${index + 1}: Required Quantity` },
                    ].forEach(({ element, label }) => {
                        const hasValue = element && String(element.value || '').trim().length > 0;
                        setInvalid(element, !hasValue);
                        if (!hasValue) errors.push(`${label} is required`);
                    });
                });

                if (errors.length) {
                    showAlert(errors);
                    return false;
                }

                return true;
            };

            itemRows.addEventListener('click', function(event) {
                const addButton = event.target.closest('.add-item-row-inline');
                if (addButton) {
                    addRow(addButton.closest('tr'));
                    return;
                }

                const button = event.target.closest('.remove-item-row');
                if (!button) return;
                const rows = itemRows.querySelectorAll('tr');
                if (rows.length > 1) {
                    button.closest('tr').remove();
                } else {
                    button.closest('tr').querySelectorAll('input, select').forEach((field) => {
                        if (!field.readOnly) field.value = '';
                    });
                }
                calculateSummary();
            });
            itemRows.addEventListener('input', calculateSummary);
            requisitionForm.addEventListener('submit', function(event) {
                if (!validate()) {
                    event.preventDefault();
                    return;
                }

                itemsPayload.value = JSON.stringify(serializeItems());
            });

            calculateSummary();
        });
    </script>
@endpush
