<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="city_corporation">Select City Corporation</label>
                <select required name="city_corporation" id="city_corporation" class="form-control">
                    <option value="">Select City Corporation</option>
                    @if (count($city_corporations))
                        @foreach($city_corporations as $city_corporation)
                            <option value="{{$city_corporation->id}}">{{$city_corporation->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>
