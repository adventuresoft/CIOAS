@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'InstituteCategory'])
@push('style')
@endpush
@section('title', 'Institute Category Edit')
@section('content')

    <!-- Main content -->
    <section class="content mt-4">
        <div class="container-fluid">

            <form class="form-horizontal" id="FormSubmit" method="POST" enctype="multipart/form-data"
                data-url="{{ route('institute-category.update', $category->id) }}"
                data-redirect-url="{{ route('institute-category.index') }}">
                @csrf
                @method('PUT')
                
                <div class="card cioas-shell">
                    <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-dark font-weight-bold mb-0">
                            <i class="fas fa-edit text-teal mr-2" style="color: #0f766e;"></i> Edit Institute Category
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="name" class="col-sm-3 col-form-label premium-form-label">Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" value="{{ $category->name }}" placeholder="Institute Category Name"
                                    class="form-control premium-form-control" id="name">
                                <small class="text-danger error name_error"></small>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="description" class="col-sm-3 col-form-label premium-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="description" value="{{ $category->description }}" placeholder="Description"
                                    class="form-control premium-form-control" id="description">
                                <small class="text-danger error description_error"></small>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="status" class="col-sm-3 col-form-label premium-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control premium-form-control">
                                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <small class="text-danger error status_error"></small>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card cioas-shell mt-4">
                    <div class="card-body d-flex justify-content-end p-3" style="gap: 15px;">
                        <a href="{{ route('institute-category.index') }}" class="btn btn-premium-cancel">Cancel</a>
                        <button type="submit" class="btn btn-premium-submit">Update</button>
                    </div>
                </div>

            </form>

        </div>
    </section>

@endsection
