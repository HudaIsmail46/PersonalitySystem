<div class="field" id="form">
    <div class="mb-5 mt-2">
        <h3>Customer</h3>
        <div class="field">
            <label class="label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('customer_name') is-invalid @enderror" type="text"
                        name="customer_name" id="customer_name" value="{{ old('customer_name') }}"
                        placeholder="Customer Name">
                    <div class="invalid-feedback">{{ $errors->first('customer_name') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="customer_phone_no">Customer Phone No <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('customer_phone_no') is-invalid @enderror" type="text"
                        name="customer_phone_no" id="customer_phone_no" value="{{ old('customer_phone_no') }}"
                        placeholder="Customer Name">
                    <div class="invalid-feedback">{{ $errors->first('customer_phone_no') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 mt-2">
        <h3>Booking</h3>
        <div class="field">
            <label class="label" for="event_begins">Event Begins <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('event_begins') is-invalid @enderror" type="datetime-local"
                        name="event_begins" id="event_begins" value="{{ old('event_begins') }}">
                    <div class="invalid-feedback">{{ $errors->first('event_begins') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="event_ends">Event Ends <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('event_ends') is-invalid @enderror" type="datetime-local"
                        name="event_ends" id="event_ends" value="{{ old('event_ends') }}">
                    <div class="invalid-feedback">{{ $errors->first('event_ends') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="address_1">Address 1 <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('address_1') is-invalid @enderror" type="text" name="address_1"
                        id="address_1" value="{{ old('address_1') }}" placeholder="Address 1">
                    <div class="invalid-feedback">{{ $errors->first('address_1') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="address_2">Address 2</label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('address_2') is-invalid @enderror" type="text" name="address_2"
                        id="address_2" value="{{ old('address_2') }}" placeholder="Address 2">
                    <div class="invalid-feedback">{{ $errors->first('address_2') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="address_3">Address 3</label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('address_3') is-invalid @enderror" type="text" name="address_3"
                        id="address_3" value="{{ old('address_3') }}" placeholder="Address 2">
                    <div class="invalid-feedback">{{ $errors->first('address_3') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="postcode">Postcode <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('postcode') is-invalid @enderror" type="text" name="postcode"
                        id="postcode" value="{{ old('postcode') }}" placeholder="Postcode">
                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="city">City <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" id="city"
                        value="{{ old('city') }}" placeholder="City">
                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="location_state">State <span class="text-danger">*</span></label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('location_state') is-invalid @enderror" type="text"
                        name="location_state" id="location_state" value="{{ old('location_state') }}"
                        placeholder="Location State">
                    <div class="invalid-feedback">{{ $errors->first('location_state') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="discount">Discount</label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('discount') is-invalid @enderror" type="number" name="discount"
                        id="discount" step='.01' value="{{ (float) old('discount') }}" placeholder="Discount">
                    <div class="invalid-feedback">{{ $errors->first('discount') }}</div>
                </div>
            </div>
        </div>


        <div class="field">
            <label class="label" for="deposit">Deposit</label>
            <div class="form-group row mx-0">
                <div class="col-xs-4">
                    <input class="form-control @error('deposit') is-invalid @enderror" type="number" name="deposit"
                        id="deposit" step='.01' value="{{ (float) old('deposit') }}" placeholder="Deposit">
                    <div class="invalid-feedback">{{ $errors->first('deposit') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="team"> Team <span class="text-danger">*</span></label>
            <div class="form-group row">
                <div class="col-sm-4">
                    <select id="team" name="team" class="custom-select @error('team') is-invalid @enderror">
                        <option value="">--SELECT TEAM--</option>
                        @foreach (App\Booking::TEAM as $team)
                            <option value="{{ $team }}" {{ old('team') == $team ? 'selected' : '' }}>{{ $team }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('team') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="booking_type">Booking Type <span class="text-danger">*</span></label>
            <div class="form-group row">
                <div class="col-sm-4">
                    <select id="booking_type" name="booking_type"
                        class="custom-select @error('booking_type') is-invalid @enderror">
                        <option value="">--SELECT BOOKING TYPE--</option>
                        @foreach (App\Booking::TYPE as $booking_type)
                            <option value="{{ $booking_type }}"
                                {{ old('booking_type') == $booking_type ? 'selected' : '' }}>{{ $booking_type }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('booking_type') }}</div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="remarks">Remarks </label>
            <div class="form-group row">
                <div class="col-md-5 ">
                    <textarea class="form-control" type="text" name="remarks" id="remarks" value="{{ old('remarks') }}"
                        placeholder="Enter your remarks"></textarea>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="pic">Handled By <span class="text-danger">*</span></label>
            <div class="form-group row">
                <div class="col-sm-4">
                    <select id="pic" name="pic" class="custom-select @error('pic') is-invalid @enderror">
                        <option value="">--SELECT PIC--</option>
                        @foreach (App\Booking::PIC as $pic)
                            <option value="{{ $pic }}" {{ old('pic') == $pic ? 'selected' : '' }}>{{ $pic }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('pic') }}</div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
