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
        <label class="label" for="address">Address <span class="text-danger">*</span> </label>
        <div class="form-group row mx-0">
            <div class="col-xs-4"> <input class="form-control @error('address') is-invalid @enderror" type="text"
                    name="address" id="address" value="{{ old('address') ?? ($customer->address ?? '') }}"
                    placeholder="Address">
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="phone_no">Phone No <span class="text-danger">*</span></label>
        <div class="form-group row mx-0">
            <div class="col-xs-4"> <input class="form-control @error('phone_no') is-invalid @enderror" type="text"
                    name="phone_no" id="phone_no" value="{{ old('phone_no') ?? ($customer->phone_no ?? '') }}"
                    placeholder="Phone text">
                <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
