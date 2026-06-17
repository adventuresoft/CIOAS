@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryReceive'])

@section('title', 'Receive')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-7">
                    <h1 class="mb-1">Receive</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.requisition.index') }}">Inventory</a></li>
                        <li class="breadcrumb-item active">Receive</li>
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
                    <h3 class="card-title" style="font-size:24px; font-weight:600;">Receive From Vendor</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        Final approval completed হলে ক্রয় আদেশ অনুযায়ী Vendor থেকে Supply receive করা যাবে।
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Requisition No</th>
                                    <th>Department</th>
                                    <th>Approval Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($requisitions as $requisition)
                                    @php
                                        $departmentHeadStatus = $requisition->department_head_recommendation ?: 'Pending';
                                        $ndcStatus = $requisition->ndc_recommendation ?: 'Pending';
                                        $adcStatus = $requisition->adc_administrative_status ?: 'Pending';
                                        $dcStatus = $requisition->dc_final_decision ?: 'Pending';
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $requisition->requisition_no }}</td>
                                        <td>{{ $requisition->department_name }}</td>
                                        <td style="min-width:180px;">
                                            <div class="small">Department Head: {{ $departmentHeadStatus }}</div>
                                            <div class="small">NDC: {{ $ndcStatus }}</div>
                                            <div class="small">ADC: {{ $adcStatus }}</div>
                                            <div class="small">DC: {{ $dcStatus }}</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm px-3" data-toggle="modal" data-target="#receiveModal-{{ $requisition->id }}">
                                                <i class="fas fa-eye mr-1"></i> Show
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No requisition found for receive.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Modals for Receive Items -->
                    @foreach ($requisitions as $requisition)
                        <div class="modal fade" id="receiveModal-{{ $requisition->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('inventory.receive.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="requisition_id" value="{{ $requisition->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold">Receive Items - {{ $requisition->requisition_no }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Category</th>
                                                        <th>Product Name</th>
                                                        <th class="text-center">Requisition Onujayi koto gulo Product</th>
                                                        <th>Purchase Order Product</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($requisition->items as $key => $item)
                                                        @php
                                                            $approvedQuantity = (int) ($item->approved_quantity ?? $item->required_quantity ?? 0);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item->category ?? '-' }}</td>
                                                            <td>{{ $item->item_name }}</td>
                                                            <td class="text-center font-weight-bold">{{ $approvedQuantity }}</td>
                                                            <td style="width: 250px;">
                                                                <input type="number" name="received_quantities[{{ $item->id }}]" class="form-control form-control-sm text-right" value="{{ $approvedQuantity }}" min="0" step="1">
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">No item found.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-truck-loading mr-1"></i> Receive</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
