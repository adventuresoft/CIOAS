@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' => 'TaxReceived'])
@push('style')
    <style>
        .toggle {
            --width: 80px;
            --height: calc(var(--width) / 3);

            position: relative;
            display: inline-block;
            width: var(--width);
            height: var(--height);
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .toggle input {
            display: none;
        }

        .toggle .labels {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-size: 12px;
            font-family: sans-serif;
            transition: all 0.4s ease-in-out;
            overflow: hidden;
        }

        .toggle .labels::after {
            content: attr(data-off);
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            color: #ffffff;
            background-color: #dc3545;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
            transition: all 0.4s ease-in-out;
        }

        .toggle .labels::before {
            content: attr(data-on);
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            top: 0;
            left: calc(var(--width) * -1);
            height: 100%;
            width: 100%;
            color: #ffffff;
            background-color: #28a745;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
            transition: all 0.4s ease-in-out;
        }

        .toggle input:checked~.labels::after {
            transform: translateX(var(--width));
        }

        .toggle input:checked~.labels::before {
            transform: translateX(var(--width));
        }
    </style>
@endpush
@section('title', 'Tax Received')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tax Received</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('taxes.tax.received') }}">Tax Received</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Tax Received</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    {{-- <a href="{{route('tax.create')}}" class="btn btn-primary">Generate</a> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="tax-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Financial Year</th>
                                        <th>Name & ID</th>
                                        <th>House No</th>
                                        <th>Area & Ward No.</th>
                                        <th>Village</th>
                                        <th>Status</th>
                                        <th data-orderable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($taxes))
                                        @foreach ($taxes as $key => $tax)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $tax->taxYear->name ?? '' }}</td>
                                                <td>{{ $tax->user->people->bn_name ?? '' }} -- {{ $tax->user_system_id }}
                                                </td>
                                                <td>{{ $tax->house->house_bn ?? '' }}</td>
                                                <td>{{ $tax->villageArea->bn_name ?? '' }} --
                                                    {{ $tax->unionWard->bn_ward_no }} </td>
                                                <td>{{ $tax->village->bn_name ?? '' }}</td>
                                                <td>
                                                    <label class="toggle">
                                                        <input type="checkbox" class="changeTaxStatus"
                                                            data-id="{{ $tax->id }}"
                                                            {{ $tax->status ? 'checked disabled' : '' }} name="status"
                                                            value="1">
                                                        <span class="labels" data-on="Received" data-off="Generated"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="table-action">
                                                        <a {{$tax->status ? 'disabled' : ''}} href="{{ $tax->status ? '#' : route('taxes.confirmed', $tax->id) }}"
                                                            title="{{$tax->status ? 'Received' : 'Receive'}}" class="btn btn-sm btn-info"><i
                                                                class="fa fa-hand-holding-usd"></i></a>
                                                        <a href="{{ route('taxes.receipt', $tax->id) }}" title="Print"
                                                            class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#tax-table').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tax-table .col-md-6:eq(0)');;
        });

        $(document).on('change', '.changeTaxStatus', function(e) {
            e.preventDefault();
            let _this = $(this);
            let _id = _this.attr('data-id');



            $("#toast-container").show();
            toastr.success(
                "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                'Are you sure, you want to receive the payment?', {
                    closeButton: false,
                    allowHtml: true,
                    onShown: function(toast) {
                        $("#confirmationRevertYes").click(function() {




                            if (_this.checked) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('tax.status') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "status": 1,
                                        "id": _id
                                    },
                                    beforeSend: function() {
                                        _this.prop("disabled", true);
                                    },
                                    success: function(response) {
                                        _this.prop("disabled", true);
                                        toastr.success(response.message);
                                    },
                                    error: function(xhr, status, error) {
                                        _this.prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                    }
                                });
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('tax.status') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "status": 0,
                                        "id": _id
                                    },
                                    beforeSend: function() {
                                        _this.prop("disabled", true);
                                    },
                                    success: function(response) {
                                        _this.prop("disabled", true);
                                        toastr.success(response.message);
                                    },
                                    error: function(xhr, status, error) {
                                        _this.prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                    }
                                });
                            }

                        });

                        $("#confirmationRevertNo").click(function() {
                            $("#toast-container").hide();
                            _this.prop("checked", false);
                        })
                    }
                });
        })
    </script>
@endpush
