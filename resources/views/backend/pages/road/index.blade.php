@extends('backend.master', ['mainMenu' => 'Road', 'subMenu' => 'RoadList'])
@push('style')
@endpush
@section('title', 'Road List')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Road List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('road.index') }}">Road List</a></li>
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
                                    <h3 class="card-title">Road List</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('road.create') }}" class="btn btn-primary">Create</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Road Name</th>
                                        <th>Road Type</th>
                                        <th>Category</th>
                                        <th>Owner</th>
                                        <th>Condition</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($roads))
                                        @foreach ($roads as $key => $road)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $road->name }}</td>
                                                <td>{{ $road->roadType->en_name ?? '--' }}</td>
                                                <td>{{ $road->roadCategory->en_name ?? '--' }}</td>
                                                <td>{{ $road->roadOwner->en_name ?? '--' }}</td>
                                                <td>{{ $road->current_condition ?? '--' }}</td>
                                                <td style="width: 10%">
                                                    <div class="table-action">
                                                        <a class="btn btn-sm btn-primary" title="Edit"
                                                            data-toggle="tooltip"
                                                            href="{{ route('road.edit', $road->id) }}"><i
                                                                class="fa fa-edit"></i></a>

                                                        <form class="deleteRoad" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" class="id" name="id"
                                                                value="{{ $road->id }}">
                                                            <input type="hidden" class="deleteUrl" name="deleteUrl"
                                                                value="{{ route('road.destroy', $road->id) }}">
                                                            <button type="submit" title="Delete" data-toggle="tooltip"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
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
            $(".deleteRoad").on('submit', function(e) {
                e.preventDefault();
                var thisForm = $(this);
                var formData = $(this).serialize();
                var deleteUrl = $(this).find(".deleteUrl").val();
                $("#toast-container").show();
                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to delete it?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {

                              
                                $.ajax({
                                    type: "POST",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", true);
                                    },
                                    success: function(response) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        toastr.success(response.message);
                                        setTimeout(function() {
                                            location.href =
                                                "{{ route('road.index') }}";
                                        }, 2000)
                                    },
                                    error: function(xhr, status, error) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                        $.each(responseText.errors, function(
                                            key, val) {
                                            thisForm.find("." + key +
                                                "-error").text(val[
                                                0]);
                                        });
                                    }
                                });



                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });
            })
        });
    </script>
@endpush
