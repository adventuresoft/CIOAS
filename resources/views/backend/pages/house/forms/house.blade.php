<div class="card-body">

    <div class="form-group row">
        <label for="house" class="col-sm-2 col-form-label">House <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-9">
            <input type="text" required name="house" value="{{$house->house ?? ''}}"  placeholder="House" class="form-control" id="house">
            <small class="text-danger error house_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="house_bn" class="col-sm-2 col-form-label">House (Bangla) <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
        <div class="col-sm-9">
            <input type="text" required name="house_bn" value="{{$house->house_bn ?? ''}}" placeholder="House Bangla" class="form-control" id="house_bn">
            <small class="text-danger error house_bn_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <label for="village_id" class="col-sm-2 col-form-label">Village</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="village_id" id="village_id">
                <option value="">Village</option>
                @if (count($villages))
                    @foreach ($villages as $village)
                        <option value="{{$village->id}}" {{isset($house->village_id) ? ($village->id == $house->village_id ? 'selected' : '' ) : ''}} >{{$village->en_name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error village_id_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="village_area_id" class="col-sm-2 col-form-label">Village Area</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="village_area_id" id="village_area_id">
                <option value="">Select Village Area</option>
                @if ($villageAreas)
                    @foreach ($villageAreas as $villageArea)
                        <option value="{{$villageArea->id}}" {{isset($house->village_area_id) ? ($villageArea->id == $house->village_area_id ? 'selected' : '' ) : ''}}>{{$villageArea->en_name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error union_ward_id_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="union_ward_id" class="col-sm-2 col-form-label">Ward No</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="union_ward_id" id="union_ward_id">
                <option value="">Select Ward</option>
                @if (count($union_wards))
                    @foreach ($union_wards as $ward)
                        <option value="{{$ward->id}}" {{isset($house->union_ward_id) ? ($ward->id == $house->union_ward_id ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error union_ward_id_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="house_type_id" class="col-sm-2 col-form-label">Type</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="house_type_id" id="house_type_id">
                <option value="">Type</option>
                @if (count($house_types))
                    @foreach ($house_types as $type)
                        <option value="{{$type->id}}" {{isset($house->house_type_id) ? ($type->id == $house->house_type_id ? 'selected' : '' ) : ''}} >{{$type->en_name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error house_type_id_error"></small>
        </div>
    </div>

     <div class="form-group row">
        <label for="house_category_id" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="house_category_id" id="house_category_id">
                <option value="">Category</option>
                @if (count($house_categories))
                    @foreach ($house_categories as $category)
                        <option value="{{$category->id}}" {{isset($house->house_category_id) ? ($category->id == $house->house_category_id ? 'selected' : '' ) : ''}}>{{$category->en_name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error house_category_id_error"></small>
        </div>
    </div>
 
    <div class="form-group row">
        <label for="house_owner_type_id" class="col-sm-2 col-form-label">Ownership Type</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="house_owner_type_id" id="house_owner_type_id">
                <option value="">Ownership Type</option>
                @if (count($house_owner_types))
                    @foreach ($house_owner_types as $type)
                        <option value="{{$type->id}}" {{isset($house->house_owner_type_id) ? ($type->id == $house->house_owner_type_id ? 'selected' : '' ) : ''}} >{{$type->en_name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error house_owner_type_id_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="mouza_id" class="col-sm-2 col-form-label">Mouza</label>
        <div class="col-sm-9">
            <select class="form-control select2" name="mouza_id" id="mouza_id">
                <option value="">Mouza</option>
                @if (count($mouzas))
                    @foreach ($mouzas as $mouza)
                        <option value="{{$mouza->id}}"  {{isset($house->mouza_id) ? ($mouza->id == $house->mouza_id ? 'selected' : '' ) : ''}} >{{$mouza->name}}</option>
                    @endforeach
                @endif
            </select>
            <small class="text-danger error mouza_id_error"></small>
        </div>
    </div>

    <div class="form-group row">
        <label for="brs_khatian" class="col-sm-2 col-form-label">BRS Khatian</label>
        <div class="col-sm-9">
            <input type="text" name="brs_khatian" value="{{$house->brs_khatian ?? ''}}" placeholder="BRS Khatian" class="form-control" id="brs_khatian">
            <small class="text-danger error brs_khatian_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <label for="brs_dag" class="col-sm-2 col-form-label">BRS Dag</label>
        <div class="col-sm-9">
            <input type="text" name="brs_dag" placeholder="BRS Dag" value="{{$house->brs_dag ?? ''}}" class="form-control" id="brs_dag">
            <small class="text-danger error brs_dag_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <label for="land_quantity" class="col-sm-2 col-form-label">Land Qty</label>
        <div class="col-sm-9">
            <input type="text" name="land_quantity" placeholder="Land Qty" value="{{$house->land_quantity ?? ''}}" class="form-control" id="land_quantity">
            <small class="text-danger error land_quantity_error"></small>
        </div>
    </div>


    <div class="form-group row">
        <label for="house_price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-9">
            <input type="text" name="house_price" placeholder="Price" value="{{$house->house_price ?? ''}}" class="form-control" id="house_price">
            <small class="text-danger error house_price_error"></small>
        </div>
    </div>

</div>