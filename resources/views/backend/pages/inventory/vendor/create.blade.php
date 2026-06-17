@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryVendorCreate'])

@section('title', 'Create New Vendor')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create New Vendor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.vendors.index') }}">Vendor List</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Vendor Information</h3>
            </div>
            <form action="{{ route('inventory.vendors.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Please fix the following errors:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h5 class="text-info border-bottom pb-2 mb-4"><i class="fas fa-info-circle mr-2"></i>Basic Information</h5>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Vendor Name" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Name (Bangla) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                </div>
                                <input type="text" name="name_bn" class="form-control" value="{{ old('name_bn') }}" placeholder="ভেন্ডরের নাম (বাংলায়)" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" placeholder="Enter Contact Number" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email Address" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-info border-bottom pb-2 mt-4 mb-4"><i class="fas fa-file-invoice mr-2"></i>License & Tax Information</h5>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Trade License Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" name="trade_license" class="form-control" value="{{ old('trade_license') }}" placeholder="Enter Trade License" required>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>TIN Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="tin" class="form-control" value="{{ old('tin') }}" placeholder="Enter TIN Number">
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>BIN Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="bin" class="form-control" value="{{ old('bin') }}" placeholder="Enter BIN Number">
                            </div>
                        </div>
                    </div>

                    <h5 class="text-info border-bottom pb-2 mt-4 mb-4"><i class="fas fa-university mr-2"></i>Bank Information</h5>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Bank Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                </div>
                                <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name') }}" placeholder="Enter Bank Name" required>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Branch <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                                </div>
                                <input type="text" name="branch" class="form-control" value="{{ old('branch') }}" placeholder="Enter Branch Name" required>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Bank A/C Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                </div>
                                <input type="text" name="bank_ac_number" class="form-control" value="{{ old('bank_ac_number') }}" placeholder="Enter Account Number" required>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-info border-bottom pb-2 mt-4 mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Address Information</h5>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <textarea name="address" class="form-control" rows="3" placeholder="Enter Full Vendor Address" required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-white text-right">
                    <a href="{{ route('inventory.vendors.index') }}" class="btn btn-default mr-2"><i class="fas fa-times mr-1"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Create Vendor</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
