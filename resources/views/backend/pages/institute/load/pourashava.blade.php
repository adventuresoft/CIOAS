<div class="row form-group">
    <label for="pourashava" class="col-sm-2 col-form-label">Pourashava</label>
    <div class="col-sm-9">
        <select required  name="pourashava" id="pourashava" class="form-control">
            <option value="">Select Pourashava</option>
            @if (count($pourashavas))
                @foreach($pourashavas as $pourashava)
                    <option value="{{$pourashava->id}}">{{$pourashava->name}}</option>
                @endforeach
            @endif
        </select>
        <small class="error pourashava-error text-danger"></small><br>

    </div>
</div>
