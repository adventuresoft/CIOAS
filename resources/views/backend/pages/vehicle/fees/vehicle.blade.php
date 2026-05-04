@extends('backend.master', ['mainMenu' => 'Vehicle', 'subMenu' => 'VehicleAddFeesNewSetup'])
@push('style')
<style>
    .fees-table td,
    .fees-table th {
        vertical-align: middle;
    }

    .fees-table .amount-input {
        min-width: 180px;
        text-align: right;
    }

    .fees-table .total-row td {
        font-weight: 700;
        background: #f3f7fb;
    }

    .fee-for-wrap {
        display: none;
    }
</style>
@endpush
@section('title', 'Vehicle Fees Setup')
@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Vehicle Fees Configuration</h3>
            </div>

            @if(empty($feesTableReady))
                <div class="card-body pb-0">
                    <div class="alert alert-warning">
                        <strong>Setup required:</strong> `vehicle_fees` table not found. Run <code>php artisan migrate</code> and refresh this page.
                    </div>
                </div>
            @endif

            <form id="vehicleFeesForm" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="finance_year">Finance Year</label>
                            <select class="form-control" name="finance_year" id="finance_year" required>
                                <option value="">Select Finance Year</option>
                                @foreach($financeYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <small class="error finance_year-error text-danger"></small>
                        </div>

                        <div class="col-md-4">
                            <label for="vehicle_type">Vehicle Type</label>
                            <select class="form-control" name="vehicle_type" id="vehicle_type" required>
                                <option value="">Select Vehicle Type</option>
                                @foreach(array_keys($vehicleData) as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            <small class="error vehicle_type-error text-danger"></small>
                        </div>

                        <div class="col-md-5 fee-for-wrap" id="fee_for_wrap">
                            <label for="fee_for">New / Renew</label>
                            <select class="form-control" name="fee_for" id="fee_for">
                                <option value="">Select Option</option>
                                <option value="new">New</option>
                                <option value="renew">Renew</option>
                            </select>
                            <small class="error fee_for-error text-danger"></small>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="vehicle_category">Vehicle Category</label>
                            <select class="form-control" name="vehicle_category" id="vehicle_category" required>
                                <option value="">Select Vehicle Category</option>
                            </select>
                            <small class="error vehicle_category-error text-danger"></small>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered fees-table">
                            <thead>
                                <tr>
                                    <th style="width: 90px;">SL</th>
                                    <th>Fees Head</th>
                                    <th style="width: 260px;">Amount / Taka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Registration</td>
                                    <td>
                                        <input type="number" min="0" step="0.01" name="registration_fee" class="form-control amount-input fee-input" value="1000.00" required>
                                        <small class="error registration_fee-error text-danger"></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Road</td>
                                    <td>
                                        <input type="number" min="0" step="0.01" name="road_fee" class="form-control amount-input fee-input" value="200.00" required>
                                        <small class="error road_fee-error text-danger"></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Fitness</td>
                                    <td>
                                        <input type="number" min="0" step="0.01" name="fitness_fee" class="form-control amount-input fee-input" value="300.00" required>
                                        <small class="error fitness_fee-error text-danger"></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>VAT</td>
                                    <td>
                                        <input type="number" min="0" step="0.01" name="vat_fee" class="form-control amount-input fee-input" value="50.00" required>
                                        <small class="error vat_fee-error text-danger"></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Tax</td>
                                    <td>
                                        <input type="number" min="0" step="0.01" name="tax_fee" class="form-control amount-input fee-input" value="5.00" required>
                                        <small class="error tax_fee-error text-danger"></small>
                                    </td>
                                </tr>
                                <tr class="total-row">
                                    <td colspan="2">Total</td>
                                    <td>
                                        <input type="text" id="total_fee" class="form-control amount-input" value="1555.00" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <!--  <a href="{{ route('vehicle.fees.list') }}" class="btn btn-secondary">Vehicle Fees Setup List</a> -->
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
$(document).ready(function () {
    const vehicleData = @json($vehicleData);
    const $vehicleType = $("#vehicle_type");
    const $vehicleCategory = $("#vehicle_category");
    const $feeForWrap = $("#fee_for_wrap");
    const $feeFor = $("#fee_for");
    const $form = $("#vehicleFeesForm");

    function numberValue(value) {
        const parsed = parseFloat(value);
        return Number.isNaN(parsed) ? 0 : parsed;
    }

    function updateTotal() {
        let total = 0;
        $(".fee-input").each(function () {
            total += numberValue($(this).val());
        });
        $("#total_fee").val(total.toFixed(2));
    }

    function populateVehicleCategory(type) {
        $vehicleCategory.empty().append(new Option("Select Vehicle Category", ""));
        if (!type || !vehicleData[type]) {
            return;
        }

        vehicleData[type].forEach(function (category) {
            $vehicleCategory.append(new Option(category, category));
        });
    }

    $vehicleType.on("change", function () {
        const type = $(this).val();
        populateVehicleCategory(type);

        if (type) {
            $feeForWrap.show();
            $feeFor.prop("required", true);
        } else {
            $feeForWrap.hide();
            $feeFor.prop("required", false).val("");
        }
    });

    $(document).on("input", ".fee-input", updateTotal);
    updateTotal();

    $form.on("submit", function (e) {
        e.preventDefault();
        const submitBtn = $form.find('button[type="submit"]');
        $(".error").text("");

        $.ajax({
            type: "POST",
            url: "{{ route('vehicle.fees.vehicle.store') }}",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                submitBtn.prop("disabled", true);
            },
            success: function (response) {
                submitBtn.prop("disabled", false);
                toastr.success(response.message || "Vehicle fees saved successfully.");
                setTimeout(function () {
                    window.location.href = response.redirect_url || "{{ route('vehicle.fees.vehicle') }}";
                }, 900);
            },
            error: function (xhr) {
                submitBtn.prop("disabled", false);
                const response = xhr.responseJSON || {};
                toastr.error(response.message || "Something went wrong!");
                if (response.errors) {
                    $.each(response.errors, function (key, val) {
                        $("." + key + "-error").text(val[0]);
                    });
                }
            }
        });
    });
});
</script>
@endpush
