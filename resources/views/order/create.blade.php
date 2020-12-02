@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Order</title>

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Order</h3>
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{route('order.store')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-5 mt-2">
                                <h3>Customer</h3>
                                <div class="field">
                                    <label class="label" for ="customer_name">Customer Name</label>
                                    <div class="form-group">
                                        <input class="input @error('customer_name') is-danger @enderror" type="text" name="customer_name" id="customer_name" value="{{old('customer_name')}}" placeholder="Customer Name">

                                        @error('customer_name')
                                            <p class="help is-danger">{{$errors->first('customer_name')}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for ="customer_phone_no">Customer Phone No</label>

                                    <div class="form-group">
                                        <input class="input @error('customer_phone_no') is-danger @enderror" type="text" name="customer_phone_no" id="customer_phone_no" value="{{old('customer_phone_no')}}" placeholder="Customer Phone No">
                                        @error('customer_phone_no')
                                            <p class="help is-danger">{{$errors->first('customer_name')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <h3>Order</h3>
                            <div class="field">
                                <label class="label" for ="address_1">Address 1</label>

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
                                <label class="label" for ="postcode">Postcode</label>

                                <div class="form-group">
                                    <input class="input @error('postcode') is-danger @enderror" type="text" name="postcode" id="postcode" value="{{old('postcode')}}" placeholder="Postcode">
                                    @error('postcode')
                                        <p class="help is-danger">{{$errors->first('postcode')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="city">City</label>

                                <div class="form-group">
                                    <input class="input @error('city') is-danger @enderror" type="text" name="city" id="city" value="{{old('city')}}" placeholder="City">
                                    @error('city')
                                        <p class="help is-danger">{{$errors->first('city')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="location_state">Location State</label>

                                <div class="form-group">
                                    <input class="input @error('location_state') is-danger @enderror" type="text" name="location_state" id="location_state" value="{{old('location_state')}}" placeholder="Location State">
                                    @error('location_state')
                                        <p class="help is-danger">{{$errors->first('location_state')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field" id="form">
                                <div class="field">
                                    <label class="label" for ="size">Size</label>

                                    <div class="form-group">
                                        <select id="size" name="size">
                                                <option value="">--SELECT SIZE--</option>
                                            @foreach(App\Order::SIZES as $size)
                                                <option value="{{$size}}" {{old('size') == $size ? 'selected' : ''}}>{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="material">Material</label>

                                <div class="form-group">
                                    <select id="material" name="material">
                                            <option value="">--SELECT MATERIAL--</option>
                                        @foreach(App\Order::MATERIALS as $material)
                                            <option value="{{$material}}" {{old('material') == $material ? 'selected' : ''}}>{{$material}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="price">Price</label>

                                <div class="form-group">
                                    <input class="input @error('price') is-danger @enderror" type="number" name="price" id="price" step='.01' value="{{(float)old('price')}}" placeholder="price">
                                    @error('price')
                                        <p class="help is-danger">{{$errors->first('number')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="prefered_pickup_datetime">Prefered Pickup Date and Time</label>
                                <div class="form-group">
                                    <input class="input @error('prefered_pickup_datetime') is-danger @enderror" type="datetime-local" name="prefered_pickup_datetime" id="prefered_pickup_datetime" value="{{old('prefered_pickup_datetime')}}" placeholder="prefered_pickup_datetime">

                                    @error('prefered_pickup_datetime')
                                        <p class="help is-danger">{{$errors->first('prefered_pickup_datetime')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
