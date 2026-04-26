<div class="signle-ownership">
    <div class="form-group row">
        <input type="hidden" name="id[]" value="{{$ownership->id ?? ''}}">
        <label for="name" class="col-sm-2 col-form-label">Owner Name  <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-9">
            <input type="text" required name="name[]" placeholder="Owner Name" class="form-control" value="{{$ownership->name ?? ''}}" id="name">
            <small class="text-danger error name_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="nid" class="col-sm-2 col-form-label">NID/Bith ID</label>
        <div class="col-sm-9">
            <input type="text" name="nid[]" placeholder="NID/Birth Certificate ID" class="form-control" value="{{$ownership->nid ?? ''}}" id="nid">
            <small class="text-danger error nid_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-9">
            <input type="text" name="mobile[]" placeholder="Mobile" class="form-control" value="{{$ownership->mobile ?? ''}}" id="mobile">
            <small class="text-danger error mobile_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-9">
            <textarea name="address[]" placeholder="Address" class="form-control" id="address">{{$ownership->address ?? ''}}</textarea>
            <small class="text-danger error address_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-9">
            <input type="text" name="quantity[]" placeholder="Quantity" class="form-control" value="{{$ownership->quantity ?? ''}}" id="quantity">
            <small class="text-danger error quantity_error"></small>

        </div>
        <div class="col-sm-1">
          
            <button type="button" class="btn btn-sm btn-danger remove-single-ownership" data-id="{{$ownership->id ?? ''}}" >X</button>

        </div>
    </div>

</div>