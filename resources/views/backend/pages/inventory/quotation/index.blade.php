@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryQuotationList'])

@section('title', 'Quotation List')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quotation List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quotation List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">All Quotations</h3>
                    <div class="card-tools">
                        <a href="{{ route('inventory.quotation.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Add New Quotation
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="quotationsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Quotation No</th>
                                    <th>Date</th>
                                    <th>Items Count</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($quotations as $index => $quotation)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $quotation->quotation_no }}</td>
                                        <td>{{ $quotation->quotation_date ? $quotation->quotation_date->format('d-M-Y') : '' }}</td>
                                        <td>{{ $quotation->items->count() }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($quotation->workflow_status) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('inventory.quotation.show', $quotation->id) }}" class="btn btn-sm btn-info" title="View Quotation">
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No Quotations Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#quotationsTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush
