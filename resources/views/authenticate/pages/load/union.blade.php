<div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="thana">Select Thana</label>
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="union">Select Union</label>
                <select required disabled name="union" id="union" class="form-control">
                    <option value="">Select Union</option>
                </select>
            </div>
        </div>
    </div>
</div>
