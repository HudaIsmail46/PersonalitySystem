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
                                    <label class="label" for="customer_name">Customer Name <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('customer_name') is-invalid @enderror"
                                                type="text" name="customer_name" id="customer_name"
                                                value="{{ old('customer_name') }}" placeholder="Customer Name">
                                            <div class="invalid-feedback">{{ $errors->first('customer_name') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="customer_phone_no">Customer Phone No <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('customer_phone_no') is-invalid @enderror"
                                                type="text" name="customer_phone_no" id="customer_phone_no"
                                                value="{{ old('customer_phone_no') }}" placeholder="Customer Name">
                                            <div class="invalid-feedback">{{ $errors->first('customer_phone_no') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <input type="checkbox" name="walk_in_customer" id="walk_in_customer" value='1' {{ old('walk_in_customer', $order->walk_in_customer ?? '')? 'checked="checked"':null }}>
                                    <label for="walk_in_customer"> Walk in Customer</label>
                                </div>
                            </div>
                            <h3>Order</h3>
                            <div class="field">
                                <label class="label" for="address_1">Address 1 <span class="text-danger">*</span></label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('address_1') is-invalid @enderror" type="text"
                                            name="address_1" id="address_1" value="{{ old('address_1') }}"
                                            placeholder="Address 1">
                                        <div class="invalid-feedback">{{ $errors->first('address_1') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="address_2">Address 2</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('address_2') is-invalid @enderror" type="text"
                                            name="address_2" id="address_2" value="{{ old('address_2') }}"
                                            placeholder="Address 2">
                                        <div class="invalid-feedback">{{ $errors->first('address_2') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="address_3">Address 3</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('address_3') is-invalid @enderror" type="text"
                                            name="address_3" id="address_3" value="{{ old('address_3') }}"
                                            placeholder="Address 3">
                                        <div class="invalid-feedback">{{ $errors->first('address_3') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="postcode">Postcode <span class="text-danger">*</span></label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('postcode') is-invalid @enderror" type="text"
                                            name="postcode" id="postcode" value="{{ old('postcode') }}"
                                            placeholder="Postcode">
                                        <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="city">City <span class="text-danger">*</span></label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('city') is-invalid @enderror" type="text"
                                            name="city" id="city" value="{{ old('city') }}" placeholder="City">
                                        <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="location_state">State <span class="text-danger">*</span></label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('location_state') is-invalid @enderror"
                                            type="text" name="location_state" id="location_state"
                                            value="{{ old('location_state') }}" placeholder="Location State">
                                        <div class="invalid-feedback">{{ $errors->first('location_state') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="deposit_amount">Deposit Amount</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('deposit_amount') is-invalid @enderror" type="number"
                                            name="deposit_amount" id="deposit_amount" step='.01' value="{{ (float) old('deposit_amount') }}"
                                            placeholder="Deposit amount">
                                        <div class="invalid-feedback">{{ $errors->first('deposit_amount') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="paid_at">Deposit Paid At</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs">
                                        <input class="form-control" type="datetime-local" name="deposit_paid_at"
                                            id="deposit_paid_at"  value="{{ old('deposit_paid_at') }}">
                                        <div class="invalid-feedback">{{ $errors->first('paid_at') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="deposit_payment_method">Deposit Payment Method</label>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <select id="deposit_payment_method" name="deposit_payment_method"
                                            class="form-control">
                                            <option value="">--SELECT PAYMENT METHOD--</option>
                                            @foreach (App\Order::PAYMENTS as $payment)
                                                <option value="{{ $payment }}">{{ $payment }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="discount_type">Discount Type</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('discount_type') is-invalid @enderror"
                                            type="text" name="discount_type" id="discount_type"
                                            value="{{ old('discount_type') }}" placeholder="Discount Type">
                                        <div class="invalid-feedback">{{ $errors->first('discount_type') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="discount_rate">Discount Rate (%)</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('discount_rate') is-invalid @enderror" type="number"
                                            name="discount_rate" id="discount_rate" value="{{ old('discount_rate') }}"
                                            placeholder="Discount Rate">
                                        <div class="invalid-feedback">{{ $errors->first('discount_rate') }}</div>
                                    </div>
                                </div>
                            </div>

                            <label class="label" for="items">Items<span class="text-danger">*</span></label>
                            <div id="AddItem" data-materials="{{json_encode($materials)}}" data-sizes="{{json_encode($sizes)}}" data-fields="{{0}}"></div>
                                <div class="@error('quantity_item.*') is-invalid @enderror"></div>
                                <div class="invalid-feedback">{{ $errors->first('quantity_item.*') }}</div>
                                <div class="@error('price_item.*') is-invalid @enderror"></div>
                                <div class="invalid-feedback">{{  $errors->first('price_item.*') }}</div>
                                <div class="@error('material.*') is-invalid @enderror"></div>
                                <div class="invalid-feedback">{{  $errors->first('material.*') }}</div>
                                <div class="@error('size.*') is-invalid @enderror"></div>
                                <div class="invalid-feedback">{{  $errors->first('size.*') }}</div>

                            <div class="field">
                                <label class="label" for="prefered_pickup_datetime">Prefered Pickup Date and Time  <span class="text-danger">*</span></label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input
                                            class="form-control @error('prefered_pickup_datetime') is-invalid @enderror"
                                            type="datetime-local" name="prefered_pickup_datetime"
                                            id="prefered_pickup_datetime" value="{{ old('prefered_pickup_datetime') }}"
                                            placeholder="prefered_pickup_datetime">
                                        <div class="invalid-feedback">{{ $errors->first('prefered_pickup_datetime') }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="field">
                                <label class="label" for="notice_ambilan_ref">Notis Ambilan</label>
                                <div class="form-group row mx-0">
                                    <div class="col-xs-4">
                                        <input class="form-control @error('notice_ambilan_ref') is-invalid @enderror" type="text"
                                            name="notice_ambilan_ref" id="notice_ambilan_ref" value="{{ old('notice_ambilan_ref') }}" placeholder="Notis Ambilan">
                                        <div class="invalid-feedback">{{ $errors->first('notice_ambilan_ref') }}</div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class ="col-md-4 mx-4 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Calculate Size</h4>
                    </div>
                    <div class="card-body">

                        <div class="field">
                            <label class="label" for="material">Material</label>
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <select id="type_material" name="type_material" onblur="calculate('cal_length', 'cal_width', 'total_length','actual_size','type_material','act_price')"
                                        class="form-control">
                                        <option value="">--SELECT MATERIAL--</option>
                                        @foreach (App\Order::MATERIALS as $type_material)
                                            <option value="{{ $type_material }}">{{ $type_material }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="cal_length">Actual length (ft) </label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control "
                                        type="number" name="cal_length" id="cal_length"
                                        value="{{ old('cal_length') ?? ($order ?? ''->cal_length ?? '') }}"
                                        placeholder="Length"
                                        onblur="calculate('cal_length', 'cal_width', 'total_length','actual_size','type_material','act_price')" >
                                </div>
                            </div>
                        </div>


                        <div class="field">
                            <label class="label" for="cal_width">Actual width (ft) </label>
                            <div class="form-group row">
                                <div class="col-auto">
                                    <input class="form-control "
                                        type="number" name="cal_width" id="cal_width"
                                        value="{{ old('cal_width') ?? ($order ?? ''->cal_width ?? '') }}"
                                        placeholder=" Width"
                                        onblur="calculate('cal_length', 'cal_width', 'total_length', 'actual_size','type_material','act_price')" >
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="total_length">Total Size(ft)</label>
                            <p id="total_length"></p>
                            <p id="actual_size"></p>
                            <p id="act_price"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
