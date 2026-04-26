<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="pourashava">Select Pourashava</label>
                <select required  name="pourashava" id="pourashava" class="form-control">
                    <option value="">Select Pourashava</option>
                    @if (count($pourashavas))
                        @foreach($pourashavas as $pourashava)
                            <option value="{{$pourashava->id}}">{{$pourashava->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>
