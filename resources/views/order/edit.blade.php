@extends('layouts.app')

@section('title', 'Page Title')

    <title>Update Order</title>

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="/order/{{$order->id}}">Order</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card">
                <div class="card-header">
                    <h3 class="mb-0">Update Order</h3>
                </div>
                <div class="card-body">
                    <div class="mt-3 mb-5">
                        <h3>Customer</h3>
                        Name : {{$order->customer->name}}
                        <br>
                        @if ($order->customer->phone_no !=null)
                            Phone No : {{$order->customer->phone_no}}
                            <a href="https://api.whatsapp.com/send?phone= {{ $order->customer->phone_no }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                        @endif
                    </div>
                    <h3>Order</h3>
                    <form method="POST" action="{{ route('order.update', $order->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label class="label" for="address_1">Address 1</label>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input class="form-control @error('address_1') is-invalid @enderror" type="text"
                                        name="address_1" id="address_1"
                                        value="{{ old('address_1') ?? ($order->address_1 ?? '') }}"
                                        placeholder="Address 1">
                                    <div class="invalid-feedback">{{ $errors->first('address_1') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="address_2">Address 2</label>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input class="form-control @error('address_2') is-invalid @enderror" type="text"
                                        name="address_2" id="address_2"
                                        value="{{ old('address_2') ?? ($order->address_2 ?? '') }}"
                                        placeholder="Address 2">
                                    <div class="invalid-feedback">{{ $errors->first('address_2') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="postcode">Postcode</label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('postcode') is-invalid @enderror" type="text"
                                        name="postcode" id="postcode"
                                        value="{{ old('postcode') ?? ($order->postcode ?? '') }}"
                                        placeholder="Postcode">
                                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="city">City</label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('city') is-invalid @enderror" type="text"
                                        name="city" id="city" value="{{ old('city') ?? ($order->city ?? '') }}"
                                        placeholder="City">
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="location_state">Location State</label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('location_state') is-invalid @enderror"
                                        type="text" name="location_state" id="location_state"
                                        value="{{ old('location_state') ?? ($order->location_state ?? '') }}"
                                        placeholder="Location State">
                                    <div class="invalid-feedback">{{ $errors->first('location_state') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="size">Size</label>
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <select id="size" name="size"
                                        class="custom-select @error('size') is-invalid @enderror">
                                        <option value="">--SELECT SIZE--</option>
                                        @foreach (App\Order::SIZES as $size)
                                            <option value="{{ $size }}" {{ $order->size == $size ? 'selected' : '' }}>
                                                {{ $size }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('size') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="material">Material</label>
                            <div class="form-group">
                                <p>{{ $order->material }}</p>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="price">Price</label>
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <input class="form-control @error('price') is-invalid @enderror" type="number"
                                        name="price" id="price" step='.01'
                                        value="{{ (float) (old('price') ?? ($order->price / 100 ?? 0)) }}"
                                        placeholder="price">
                                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="prefered_pickup_datetime">Prefered Pickup Date and Time </label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('prefered_pickup_datetime') is-invalid @enderror"
                                        type="datetime-local" name="prefered_pickup_datetime"
                                        id="prefered_pickup_datetime"
                                        value="{{ old('prefered_pickup_datetime') ?? (Carbon\Carbon::parse($order->prefered_pickup_datetime)->toDateTimeLocalString() ?? '') }}"
                                        placeholder="prefered_pickup_datetime">
                                    <div class="invalid-feedback">{{ $errors->first('prefered_pickup_datetime') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="actual_length">Actual length (ft) </label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('actual_length') is-invalid @enderror"
                                        type="number" name="actual_length" id="actual_length"
                                        value="{{ old('actual_length') ?? ($order->actual_length ?? '') }}"
                                        placeholder="Actual Length">
                                    <div class="invalid-feedback">{{ $errors->first('actual_length') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="actual_width">Actual width (ft) </label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('actual_width') is-invalid @enderror"
                                        type="number" name="actual_width" id="actual_width"
                                        value="{{ old('actual_width') ?? ($order->actual_width ?? '') }}"
                                        placeholder="Actual Width">
                                    <div class="invalid-feedback">{{ $errors->first('actual_width') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="actual_material">Actual material</label>
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <select id="actual_material" name="actual_material"
                                        class="custom-select @error('actual_material') is-invalid @enderror">
                                        <option value="">--SELECT ACTUAL MATERIAL--</option>
                                        @foreach (App\Order::MATERIALS as $actual_material)
                                            <option value="{{ $actual_material }}"
                                                {{ $order->actual_material == $actual_material ? 'selected' : '' }}>
                                                {{ $actual_material }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('size') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="actual_price">Actual price</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('actual_price') is-invalid @enderror"
                                        name="actual_price" id="actual_price" step='.01'
                                        value="{{ (float) (old('actual_price') ?? ($order->actual_price / 100 ?? 0)) }}">
                                    <div class="invalid-feedback">{{ $errors->first('actual_price') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="deposit_amount">Deposit Amount</label>
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <input class="form-control @error('deposit_amount') is-invalid @enderror" type="number"
                                        name="deposit_amount" id="deposit_amount" step='.01'
                                        value="{{ (float) (old('deposit_amount') ?? ($order->deposit_amount / 100 ?? 0)) }}"
                                        placeholder="Deposit amount">
                                    <div class="invalid-feedback">{{ $errors->first('deposit_amount') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="deposit_paid_at">Deposit Paid At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('deposit_paid_at') is-invalid @enderror"
                                        type="datetime-local" name="deposit_paid_at" id="deposit_paid_at"
                                        value="{{ $order->deposit_paid_at ? Carbon\Carbon::parse($order->deposit_paid_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('deposit_paid_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="deposit_payment_method">Deposit Payment Method</label>
                            <div class="form-group row ">
                                <div class="col-md-5">
                                    <select id="deposit_payment_method" name="deposit_payment_method"
                                        class="custom-select @error('deposit_payment_method') is-invalid @enderror">
                                        <option value="">--SELECT PAYMENT METHOD--</option>
                                        @foreach (App\Order::PAYMENTS as $payment)
                                            <option value="{{ $payment }}"
                                                {{ $order->deposit_payment_method == $payment ? 'selected' : '' }}>
                                                {{ $payment }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('deposit_payment_method') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="paid_at"> Paid At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('paid_at') is-invalid @enderror"
                                        type="datetime-local" name="paid_at" id="paid_at"
                                        value="{{ $order->paid_at ? Carbon\Carbon::parse($order->paid_at)->format('Y-m-d\TH:i') : '' }}">
                                        <div class="invalid-feedback">{{ $errors->first('paid_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="payment_method">Payment Method</label>
                            <div class="form-group row ">
                                <div class="col-md-5">
                                    <select id="payment_method" name="payment_method"
                                        class="custom-select @error('payment_method') is-invalid @enderror">
                                        <option value="">--SELECT PAYMENT METHOD--</option>
                                        @foreach (App\Order::PAYMENTS as $payment)
                                            <option value="{{ $payment }}"
                                                {{ $order->payment_method == $payment ? 'selected' : '' }}>
                                                {{ $payment }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('payment_method') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="quantity">Quantity </label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('quantity') is-invalid @enderror" type="number"
                                        name="quantity" id="quantity"
                                        value="{{ old('quantity') ?? ($order->quantity ?? '') }}"
                                        placeholder="Quantity">
                                    <div class="invalid-feedback">{{ $errors->first('quantity') }}</div>
                                </div>
                            </div>
                        </div>

                        @include('images.create', ['images' => $order->images, 'imageableId' =>
                        $order->id,
                        'imageableType' => App\Order::class ])

                        <div class="field is grouped">
                            <div class="form-group">
                                <button class="btn mt-2 btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
