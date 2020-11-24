<div class="field" id="form">
    <div class="mb-5 mt-2">
        <h4>Customer</h4>
        <div class="field">
            <label class="label" for ="customer_name">Customer Name <span class="text-danger">*</span> </label>
            <div class="form-group">
                <input class="input @error('customer_name') is-danger @enderror" type="text" name="customer_name" id="customer_name" value="{{old('customer_name')}}" placeholder="Customer Name">

                @error('customer_name')
                    <p class="help is-danger">{{$errors->first('customer_name')}}</p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label class="label" for ="customer_phone_no">Customer Phone No <span class="text-danger">*</span></label>

            <div class="form-group">
                <input class="input @error('customer_phone_no') is-danger @enderror" type="text" name="customer_phone_no" id="customer_phone_no" value="{{old('customer_phone_no')}}" placeholder="(+60)Customer Phone No ">
                @error('customer_phone_no')
                    <p class="help is-danger">{{$errors->first('customer_name')}}</p>
                @enderror
            </div>
        </div>
    </div>

    <h4>Booking</h4>
    <div class="field">
        <label class="label" for ="event_begins">Event Begins <span class="text-danger">*</span></label>
        <div class="form-group">
            <input class="input @error('event_begins') is-danger @enderror" type="datetime-local" name="event_begins" id="event_begins" value="{{old('event_begins')}}" placeholder="event_begins">

            @error('event_begins')
                <p class="help is-danger">{{$errors->first('event_begins')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="event_ends">Event Ends  <span class="text-danger">*</span></label>
        <div class="form-group">
            <input class="input @error('event_ends') is-danger @enderror" type="datetime-local" name="event_ends" id="event_ends" value="{{old('event_ends')}}" placeholder="event_ends">

            @error('event_ends')
                <p class="help is-danger">{{$errors->first('event_ends')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="address_1">Address 1 <span class="text-danger">*</span></label>

        <div class="form-group">
            <input class="input @error('address_1') is-danger @enderror" type="text" name="address_1" id="address_1" value="{{old('address_1')}}" placeholder="Address 1">
            @error('address_1')
                <p class="help is-danger">{{$errors->first('address_1')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="address_2">Address 2</label>

        <div class="form-group">
            <input class="input @error('address_2') is-danger @enderror" type="text" name="address_2" id="address_2" value="{{old('address_2')}}" placeholder="Address 2">
            @error('address_2')
                <p class="help is-danger">{{$errors->first('address_2')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="postcode">Postcode <span class="text-danger">*</span></label>

        <div class="form-group">
            <input class="input @error('postcode') is-danger @enderror" type="text" name="postcode" id="postcode" value="{{old('postcode')}}" placeholder="Postcode">
            @error('postcode')
                <p class="help is-danger">{{$errors->first('postcode')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="city">City <span class="text-danger">*</span></label>

        <div class="form-group">
            <input class="input @error('city') is-danger @enderror" type="text" name="city" id="city" value="{{old('city')}}" placeholder="City">
            @error('city')
                <p class="help is-danger">{{$errors->first('city')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="location_state">Location State <span class="text-danger">*</span></label>

        <div class="form-group">
            <input class="input @error('location_state') is-danger @enderror" type="text" name="location_state" id="location_state" value="{{old('location_state')}}" placeholder="Location State">
            @error('location_state')
                <p class="help is-danger">{{$errors->first('location_state')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="discount">Discount</label>

        <div class="form-group">
            <input class="input @error('discount') is-danger @enderror" type="number" name="discount" id="discount" step='.01' value="{{(float)old('discount')}}" placeholder="discount">
            @error('discount')
                <p class="help is-danger">{{$errors->first('number')}}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label class="label" for ="deposit">Deposit</label>

        <div class="form-group">
            <input class="input @error('deposit') is-danger @enderror" type="number" name="deposit" id="deposit" step='.01' value="{{(float)old('deposit')}}" placeholder="deposit">
            @error('deposit')
                <p class="help is-danger">{{$errors->first('number')}}</p>
            @enderror
        </div>
    </div>

    <div class="field" id="form">
        <label class="label" for="team">Team <span class="text-danger">*</span></label>
        <div class="form-group">
            <select id="team" name="team">
                <option value="">--SELECT TEAM--</option>
                @foreach (App\Booking::TEAM as $team)
                    <option value="{{ $team }}">{{ $team }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field" id="form">
        <label class="label" for="booking_type">Booking Type <span class="text-danger">*</span></label>
        <div class="form-group">
            <select id="booking_type" name="booking_type">
                <option value="">--SELECT TYPE--</option>
                @foreach (App\Booking::TYPE as $booking_type)
                    <option value="{{ $booking_type }}">{{ $booking_type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label" for ="remarks">Remarks </label>

        <div class="control">
            <textarea class="input @error('remarks') is-danger @enderror" type="text" name="remarks" id="remarks" value="{{old('remarks')}}" placeholder="Enter your remarks"></textarea>
            @error('remarks')
                <p class="help is-danger">{{$errors->first('remarks')}}</p>
            @enderror
        </div>
    </div>

    <div class="field" id="form">
        <label class="label" for="pic">Handled By <span class="text-danger">*</span></label>
        <div class="form-group">
            <select id="pic" name="pic">
                <option value="">--SELECT PIC--</option>
                @foreach (App\Booking::PIC as $pic)
                    <option value="{{ $pic }}">{{ $pic }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
