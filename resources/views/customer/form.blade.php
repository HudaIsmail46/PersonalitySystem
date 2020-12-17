<div class="field" id="form">
    <div class="field">
        <label class="label" for="name">Name <span class="text-danger">*</span></label>
        <div class="form-group row mx-0">
            <div class="col-xs-4">
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                    value="{{ old('name') ?? ($customer->name ?? '') }}" placeholder="Name">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="address_1">Address 1 <span class="text-danger">*</span></label>
        <div class="form-group row">
            <div class="col-8">
                <input class="form-control @error('address_1') is-invalid @enderror" type="text" name="address_1"
                    id="address_1" value="{{ old('address_1') ?? ($customer->address_1 ?? '') }}" placeholder="Address 1">
                <div class="invalid-feedback">{{ $errors->first('address_1') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="address_2">Address 2</label>
        <div class="form-group row">
            <div class="col-8">
                <input class="form-control @error('address_2') is-invalid @enderror" type="text" name="address_2"
                    id="address_2" value="{{ old('address_2') ?? ($customer->address_2 ?? '') }}" placeholder="Address 2">
                <div class="invalid-feedback">{{ $errors->first('address_2') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="address_3">Address 3</label>
        <div class="form-group row">
            <div class="col-8">
                <input class="form-control @error('address_3') is-invalid @enderror" type="text" name="address_3"
                    id="address_3" value="{{ old('address_3') ?? ($customer->address_3 ?? '') }}" placeholder="Address 3">
                <div class="invalid-feedback">{{ $errors->first('address_3') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="postcode">Postcode <span class="text-danger">*</span></label>
        <div class="form-group row">
            <div class="col-auto">
                <input class="form-control @error('postcode') is-invalid @enderror" type="text" name="postcode"
                    id="postcode" value="{{ old('postcode') ?? ($customer->postcode ?? '') }}" placeholder="Postcode">
                <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="city">City <span class="text-danger">*</span></label>
        <div class="form-group row">
            <div class="col-auto">
                <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" id="city"
                    value="{{ old('city') ?? ($customer->city ?? '') }}" placeholder="City">
                <div class="invalid-feedback">{{ $errors->first('city') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="location_state">Location State <span class="text-danger">*</span></label>
        <div class="form-group row">
            <div class="col-auto">
                <input class="form-control @error('location_state') is-invalid @enderror" type="text"
                    name="location_state" id="location_state"
                    value="{{ old('location_state') ?? ($customer->location_state ?? '') }}" placeholder="Location State">
                <div class="invalid-feedback">{{ $errors->first('location_state') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="phone_no">Phone No <span class="text-danger">*</span></label>
        <div class="form-group row mx-0">
            <div class="col-xs-4"> <input class="form-control @error('phone_no') is-invalid @enderror" type="text"
                    name="phone_no" id="phone_no" value="{{ old('phone_no') ?? ($customer->phone_no ?? '') }}" placeholder="Phone Number">
                <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
