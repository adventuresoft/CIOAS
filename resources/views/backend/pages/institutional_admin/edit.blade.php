@extends('backend.master', ['mainMenu' => 'InstitutionalAdmin', 'subMenu' =>'InstitutionalAdminCreate'])
@push('style')
@endpush
@section('title', 'Institutional Admin Edit')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Institutional Admin Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('institutional-admin.index')}}">Institutional Admin</a></li>
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
                            <h3 class="card-title">
                                <span class="text-light">Institutional Admin Create</span> 
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="institionalForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Admin Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" value="{{$admin->name}}" placeholder="Institinal Super Admin Name" name="name" class="form-control" required>
                                        <small class="error name-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" id="email" value="{{$admin->email}}" placeholder="Institinal Super Admin Email" name="email" class="form-control" required>
                                        <small class="error email-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="mobile" value="{{$admin->mobile}}" placeholder="Institinal Super Admin Mobile" name="mobile" class="form-control">
                                        <small class="error mobile-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="department_id" class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-9">
                                        <select name="department_id" id="department_id" class="form-control">
                                            <option value="">-- Select Department --</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ $admin->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }} ({{ $department->bn_name }})</option>
                                            @endforeach
                                        </select>
                                        <small class="error department_id-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="section_id" class="col-sm-2 col-form-label">Section</label>
                                    <div class="col-sm-9">
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option value="">-- Select Section --</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ $admin->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }} ({{ $section->bn_name }})</option>
                                            @endforeach
                                        </select>
                                        <small class="error section_id-error text-danger"></small>
                                    </div>
                                </div>

                                
                            </div>
                          




                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('institutional-admin.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Update</button>
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
        $('#department_id').on('change', function() {
            var departmentId = $(this).val();
            var sectionSelect = $('#section_id');
            
            sectionSelect.html('<option value="">-- Select Section --</option>');
            
            if (departmentId) {
                $.ajax({
                    url: "{{ route('basic-settings.get-sections-by-department', '') }}/" + departmentId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, section) {
                            sectionSelect.append('<option value="' + section.id + '">' + section.name + ' (' + (section.bn_name ? section.bn_name : '') + ')</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Failed to load sections: " + error);
                    }
                });
            }
        });

        $("#institionalForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('institutional-admin.update', $admin->id)}}",
                data: new FormData(this),
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{route('institutional-admin.index')}}";
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        })
    })
</script>


@endpush
