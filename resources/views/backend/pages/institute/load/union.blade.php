<div>
    <div class="row form-group">
        <label for="thana"  class="col-sm-2 col-form-label">Thana</label>
        <div class="col-sm-9">
            <select name="thana" required id="thana" class="form-control">
                <option value="">Select Thana</option>
                @if (count($thanas))
                    @foreach ($thanas as $thana)
                        <option value="{{$thana->id}}">{{$thana->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row form-group">
        <label for="union" class="col-sm-2 col-form-label">Union</label>
        <div class="col-sm-9">
            <select required disabled name="union" id="union" class="form-control">
                <option value="">Select Union</option>
            </select>
            <small class="error union-error text-danger"></small><br>

        </div>
    </div>
</div>
