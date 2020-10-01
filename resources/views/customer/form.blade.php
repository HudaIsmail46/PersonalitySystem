<div class="field" id="form">
                            <div class="field">
                            <label class="label" for="event_title">Name</label>
                                <div class="form-group">
                                    @csrf
                                    <input class="input @error('name') is-danger @enderror" type="text" name="name" id="name" value="{{old('name')?? $customer->name ?? ''}}"
                                    placeholder="Name">
                                    <p class="help is-danger">{{ $errors->first('name')}}</p>
                                </div>
                            </div>

                            <div class="field" >
                            <label class="label" for="address">Address </label>
                                <div class="form-group">
                                    <input class="input @error('address') is-danger @enderror" type="text" name="address" id="address" value="{{old('address')?? $customer->address ?? ''}}"
                                    placeholder="Address">
                                    <p class="help is-danger">{{ $errors->first('address')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="phone_no">Phone Number </label>
                                <div class="form-group">
                                    <input class="input @error('date') is-danger @enderror" type="dateTime" name="phone_no" value="{{old('phone_no')?? $customer->phone_no ?? ''}}"
                                    placeholder="Phone Number">
                                    <p class="help is-danger">{{ $errors->first('phone_no')}}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>