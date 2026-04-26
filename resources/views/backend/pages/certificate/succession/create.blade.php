@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' => 'Succession'])
@push('style')
@endpush
@section('title', 'Succession Certificate')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Succession Certificate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('succession.index') }}">Succession Certificate</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Find Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <form id="successionCertificateForm" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="applicant_id">Applicant ID</label>
                                                    <!--<input type="text" required class="form-control" name="applicant_id" id="applicant_id">-->
                                                     <select required class="form-control select2" name="applicant_id" id="">
                                            <option value="">Select People</option>
                                            @if (count($users))
                                                @foreach ($users as $user)
                                                    @if (isset($user->people->approved_id))
                                                        <option value="{{$user->id}}">{{$user->people->approved_id}} - {{$user->name}} - {{$user->email}} - {{$user->mobile}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="">No People Found</option>
                                            @endif

                                        </select>
                                                    <small class="error applicant_id-error text-danger"></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="death_certificate_id">Death Certificate ID</label>
                                                    <input type="text" required class="form-control" name="death_certificate_id" id="death_certificate_id">
                                                    <small class="error death_certificate_id-error text-danger"></small>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    @php
                                        $php_unique_id = uniqid();
                                    @endphp
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td colspan="6"> Add Succession Members Info. নোট- সনদটি বাংলায় নিতে চাইলে সব তথ্য বাংলায় দিন আর সনদটি ইংরেজীতে নিতে চাইলে ইংরেজীতে দিন।</td>
                                            </tr>
                                            <tr>
                                                <td>#SL</td>
                                                <td>Name</td>
                                                <td>Age</td>
                                                <td>NID</td>
                                                <td>Relation</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success addNewItem">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="membersTbody">
                                            <tr>
                                                <td class="sl">1</td>
                                                <td><input type="text" class="form-control" name="members[{{$php_unique_id}}][name]" placeholder="Name"></td>
                                                <td><input type="text" class="form-control" name="members[{{$php_unique_id}}][age]" placeholder="Age"></td>
                                                <td><input type="text" class="form-control" name="members[{{$php_unique_id}}][nid]" placeholder="NID"></td>
                                                <td><input type="text" class="form-control" name="members[{{$php_unique_id}}][relation]" placeholder="Relation"></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger removeMember">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('succession.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
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
            $(".select2").select2();
            $("#successionCertificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('succession.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })

        $(document).on('click', '.verify-btn', function(e){
            e.preventDefault();
            $('.show-details').removeClass('d-none');
        })

        $(document).on('click', '.addNewItem', function(e) {
            e.preventDefault();
            let rowCount = uniqid(); // count existing rows

            let initial_html = `
                <tr>
                    <td class="sl">1</td>
                    <td><input type="text" class="form-control" name="members[${rowCount}][name]" placeholder="Name"></td>
                    <td><input type="text" class="form-control" name="members[${rowCount}][age]" placeholder="Age"></td>
                    <td><input type="text" class="form-control" name="members[${rowCount}][nid]" placeholder="NID"></td>
                    <td><input type="text" class="form-control" name="members[${rowCount}][relation]" placeholder="Relation"></td>
                    <td><button type="button" class="btn btn-sm btn-danger removeMember"><i class="fa fa-minus-circle"></i></button></td>
                </tr>
            `
            $("#membersTbody").append(initial_html);
            sortSerial();
        })

        $(document).on('click', '.removeMember', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        })

        function sortSerial() {
            let sl = $('.sl');
            sl.each((index, element) => {
                $(element).text(index + 1); // ✅ convert DOM element to jQuery object
            });
        }

        function uniqid(prefix = "", moreEntropy = false) {
            let ts = Date.now().toString(16); // timestamp in hex
            let rnd = Math.floor(Math.random() * 0x75bcd15).toString(16); // random hex

            let id = prefix + ts + rnd;

            if (moreEntropy) {
                id += (Math.random() * 10).toFixed(8).toString();
            }

            return id;
        }

    </script>
@endpush
