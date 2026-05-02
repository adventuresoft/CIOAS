<div class="row form-group">
    <label for="city_corporation"  class="col-sm-2 col-form-label">City Corporation</label>
    <div class="col-sm-9">
        <select required name="city_corporation" id="city_corporation" class="form-control">
            <option value="">Select City Corporation</option>
            @if (count($city_corporations))
                @foreach($city_corporations as $city_corporation)
                    <option value="{{$city_corporation->id}}">{{$city_corporation->name}}</option>
                @endforeach
            @endif
        </select>
        <small class="error city_corporation-error text-danger"></small><br>

    </div>
</div>
