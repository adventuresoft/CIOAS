@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'InstituteCategory'])
@push('style')
@endpush
@section('title', 'Institute Category')
@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">

            <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                data-url="{{ route('institute-category.store') }}"
                data-redirect-url="{{ route('institute-category.index') }}">
                @csrf
                
                <div class="card cioas-shell">
                    <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-dark font-weight-bold mb-0">
                            <i class="fas fa-building text-teal mr-2" style="color: #0f766e;"></i> Institute Category Info
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="name" class="col-sm-3 col-form-label premium-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" placeholder="Institute Category Name"
                                    class="form-control premium-form-control" id="name">
                                <small class="text-danger error name_error"></small>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="description" class="col-sm-3 col-form-label premium-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="description" placeholder="Description"
                                    class="form-control premium-form-control" id="description">
                                <small class="text-danger error description_error"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card cioas-shell mt-4">
                    <div class="card-body d-flex justify-content-end p-3" style="gap: 15px;">
                        <a href="{{ route('institute-category.index') }}" class="btn btn-premium-cancel">Cancel</a>
                        <button type="submit" class="btn btn-premium-submit">Submit</button>
                    </div>
                </div>

            </form>

        </div>
    </section>
    <!-- /.content -->

@endsection
