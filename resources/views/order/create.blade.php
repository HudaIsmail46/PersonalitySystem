@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Order</title>

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto card mt-4">
                <div class="card-header">
                    Create Order
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{route('order.store')}}">
                        @csrf
                            <div class="field" id="form">
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

                                <div class="field" id="form">
                                    <div class="field">
                                        <label class="label" for ="size">Size</label>

                                        <div class="form-group">
                                            <select id="size" name="size">
                                                @foreach(App\Order::SIZES as $size)
                                                    <option value="{{$size}}">{{$size}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for ="material">Material</label>

                                    <div class="form-group">
                                        <select id="material" name="material">
                                            @foreach(App\Order::MATERIALS as $material)
                                                <option value="{{$material}}">{{$material}}</option>
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
                                    <label class="label" for ="prefered date time">Prefered Pickup Date and Time</label>

                                    <div class="form-group">
                                        <input class="input @error('prefered_pickup_datetime') is-danger @enderror" type="datetime-local" name="prefered_pickup_datetime" id="prefered_pickup_datetime" value="{{old('prefered_pickup_datetime')}}" placeholder="prefered_pickup_datetime">

                                        @error('prefered_pickup_datetime')
                                            <p class="help is-danger">{{$errors->first('prefered_pickup_datetime')}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for ="status">Status</label>

                                    <div class="form-group">
                                        <select id="status" name="status">
                                            @foreach(App\Order::STATUSES as $status)
                                                <option value="{{$status}}">{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
