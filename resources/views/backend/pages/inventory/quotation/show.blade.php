@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryQuotationList'])

@section('title', 'View Quotation')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Quotation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventory.quotation.index') }}">Quotation List</a></li>
                        <li class="breadcrumb-item active">View Quotation</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Quotation Information: {{ $quotation->quotation_no }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('inventory.quotation.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th style="width: 30%">Quotation No:</th>
                                    <td>{{ $quotation->quotation_no }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $quotation->quotation_date ? $quotation->quotation_date->format('d M, Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><span class="badge badge-info">{{ ucfirst($quotation->workflow_status) }}</span></td>
                                </tr>
                            </table>
                        </div>
                        </div>

                    <h5 class="text-primary mt-4 mb-3">Item Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 40px;" class="text-center">SL</th>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotation->items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->category ?? '-' }}</td>
                                        <td>{{ $item->item_name }}</td>
                                        <td>{{ $item->unit ?? '-' }}</td>
                                        <td class="text-right">{{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No items found for this quotation.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($quotation->items->count() > 0)
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total:</th>
                                    <th class="text-right">{{ number_format($quotation->items->sum('price'), 2) }}</th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
