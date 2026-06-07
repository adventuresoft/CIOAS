@extends('backend.master', ['mainMenu' => 'Inquiry', 'subMenu' => 'FormList'])
@push('style')
@endpush
@section('title', 'Form List')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inquiry List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- {{route('death.index')}} --}}
                        <li class="breadcrumb-item"><a href="">Inquiry List</a></li>
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
                                    <h3 class="card-title">Inquiry List</h3>
                                </div>


                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            {{ $dataTable->table() }}

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
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush