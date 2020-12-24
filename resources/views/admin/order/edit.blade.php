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
                    <form method="POST" action="{{ route('admin.order.update', $order->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-3 mb-5">
                            <h3>Customer</h3>
                            <div id="SelectCustomer" data-customer_options="{{json_encode($customer_options)}}" data-selected_customer="{{json_encode($selected_customer)}}"></div>
                        </div>
                        <h3>Order</h3>

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
                            <label class="label" for="address_3">Address 3</label>
                            <div class="form-group row">
                                <div class="col-8">
                                    <input class="form-control @error('address_3') is-invalid @enderror" type="text"
                                        name="address_3" id="address_3"
                                        value="{{ old('address_3') ?? ($order->address_3 ?? '') }}"
                                        placeholder="Address 3">
                                    <div class="invalid-feedback">{{ $errors->first('address_3') }}</div>
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
                            <label class="label" for="material">Material  <span class="text-danger">*</span></label>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <select id="material" name="material"
                                        class="custom-select @error('size') is-invalid @enderror">
                                        <option value="">--SELECT MATERIAL--</option>
                                        @foreach (App\Order::MATERIALS as $material)
                                            <option value="{{ $material }}"
                                                {{ $order->material == $material ? 'selected' : '' }}>{{ $material }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('material') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="price">Price(in cents)</label>
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <input class="form-control @error('price') is-invalid @enderror" type="number"
                                        name="price" id="price" step='.01'
                                        value="{{(old('price') ?? $order->price  ?? 0) }}"
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

                        <div class="field">
                            <label class="label" for="notice_ambilan_ref">Notis Ambilan </label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control @error('notice_ambilan_ref') is-invalid @enderror" type="text"
                                        name="notice_ambilan_ref" id="notice_ambilan_ref" value="{{ old('notice_ambilan_ref') ?? ($order->notice_ambilan_ref ?? '') }}"
                                        placeholder="Notis Ambilan">
                                    <div class="invalid-feedback">{{ $errors->first('notice_ambilan_ref') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="state">State</label>
                            <div class="form-group row ">
                                <div class="col-md-5">
                                    <select id="state" name="state"
                                        class="custom-select @error('state') is-invalid @enderror">
                                        @foreach(App\Order::getStatesFor('state') as $state)
                                            <option value="{{$state}}" {{($order->state == $state) ? 'selected' : '' }} class='text-capitalize'>{{humaniseOrderState($state)}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->first('state') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="collected_at">Collected At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('collected_at') is-invalid @enderror"
                                        type="datetime-local" name="collected_at"
                                        id="collected_at"
                                        value="{{ $order->collected_at ? Carbon\Carbon::parse($order->collected_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('collected_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="arrived_warehouse_at">Arrived Warehouse At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('arrived_warehouse_at') is-invalid @enderror"
                                        type="datetime-local" name="arrived_warehouse_at"
                                        id="arrived_warehouse_at"
                                        value="{{ $order->arrived_warehouse_at ? Carbon\Carbon::parse($order->arrived_warehouse_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('arrived_warehouse_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="vendor_collected_at">Vendor Collected At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('vendor_collected_at') is-invalid @enderror"
                                        type="datetime-local" name="vendor_collected_at"
                                        id="vendor_collected_at"
                                        value="{{ $order->vendor_collected_at ? Carbon\Carbon::parse($order->vendor_collected_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('vendor_collected_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="vendor_returned_at">Vendor Returned At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('vendor_returned_at') is-invalid @enderror"
                                        type="datetime-local" name="vendor_returned_at"
                                        id="vendor_returned_at"
                                        value="{{ $order->vendor_returned_at ? Carbon\Carbon::parse($order->vendor_returned_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('vendor_returned_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="leave_warehouse_at">Leave Warehouse At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('leave_warehouse_at') is-invalid @enderror"
                                        type="datetime-local" name="leave_warehouse_at"
                                        id="leave_warehouse_at"
                                        value="{{ $order->leave_warehouse_at ? Carbon\Carbon::parse($order->leave_warehouse_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('leave_warehouse_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="returned_at">Returned At</label>
                            <div class="form-group row mx-0">
                                <div class="col-xs-4">
                                    <input class="form-control @error('returned_at') is-invalid @enderror"
                                        type="datetime-local" name="returned_at"
                                        id="returned_at"
                                        value="{{ $order->returned_at ? Carbon\Carbon::parse($order->returned_at)->format('Y-m-d\TH:i') : '' }}">
                                    <div class="invalid-feedback">{{ $errors->first('returned_at') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field is grouped">
                            <div class="form-group">
                                <button class="btn mt-2 btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <form class='mb-0' action="{{ route('order.destroy', $order->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                            type="submit">Delete <i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
