<div class="signle-ownership">
    <input type="hidden" name="id[]" value="{{$ownership->id ?? ''}}">

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Owner ID</label>
        <div class="col-sm-4 user_info">
            <div class="row input-group input-group-sm">
                <input type="text" name="system_id[]" value="{{$ownership->system_id ?? ''}}" required class="form-control system_id">
                <span class="input-group-append">
                  <button type="button" class="btn btn-info btn-flat find_user_info"><i class="fa fa-search"></i></button>
                </span>
            </div>
            <div class="row">
                <table class="mt-1 user_info_table {{ isset($ownership->user_name) ?  ($ownership->user_name ? '' : 'd-none') : 'd-none'}}">
                    <tr>
                        {{-- <td><img class="user_img" height="60" width="60" src="{{$ownership->user_img ?? ''}}"></td> --}}
                        <td>
                            <input type="hidden" name="user_id[]" class="user_id" value="{{$ownership->user_id ?? ''}}">
                            <input readonly class="form-control user_name" name="user_name[]" type="text" value="{{$ownership->user_name ?? ''}}">                        
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="form-group row">
        <label for="quantity" class="col-sm-2 col-form-label">Percentage</label>
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <input type="number" min="1" max="100" name="quantity[]" placeholder="Percentage" class="form-control" value="{{$ownership->quantity ?? '100'}}" >
                <div class="input-group-append">
                  <span class="input-group-text">%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Trade License?</label>
        <div class="col-sm-1">
            <div class="input-group mb-3 trade-license-checkbox">
                <input type='hidden' class="trade-hidden-check" value='{{isset($ownership->is_trade_license)  ? (  $ownership->is_trade_license ? 1 : 0)   : 0}}' name='is_trade_license[]'>
                <input type="radio"  name="is_trade_license[]" {{isset($ownership->is_trade_license)  ? (  $ownership->is_trade_license ? "checked" :"")   : ""}}  class="form-control trade-checkbox" value="1" >
            </div>
        </div>

        <div class="col-sm-1">
            <button type="button" title="Remove User" class="btn btn-sm btn-danger remove-single-ownership" data-id="{{$ownership->id ?? ''}}" > X </button>
        </div>
     
    </div>

    

</div>
