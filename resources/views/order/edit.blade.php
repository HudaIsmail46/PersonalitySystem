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
                        <li class="breadcrumb-item"><a href="/order/{{ $order->id }}">Order</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 card">
                <div class="card-header">
                    <h3 class="mb-0">Update Order</h3>
                </div>
                    <form method="POST" action="{{ route('order.update', $order->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="mt-3 mb-5">
                            <h3>Customer</h3>
                            Name : {{ $order->customer->name }}
                            <br>
                            @if ($order->customer->phone_no != null)
                                Phone No : {{ $order->customer->phone_no }}
                                <a href="https://api.whatsapp.com/send?phone= {{ $order->customer->phone_no }}"
                                    target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                <a href="tel:{{$order->customer->phone_no}}"><i class="fas fa-phone"></i></a>
                            @endif

                            <div class="field">
                                <input type="checkbox" name="walk_in_customer" id="walk_in_customer" value='1' {{ old('walk_in_customer', $order->walk_in_customer ?? '')? 'checked="checked"':null }}>
                                <label for="walk_in_customer"> Walk in Customer</label>
                            </div>
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

                            <h4>Item</h4>
                            <div class="field">
                                <div class="table-responsive">
                                    <table class="table table-bordered w-100">
                                        <tr class="table-active">
                                            <th>No</th>
                                            <th>Material</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Delete Item (&#x2714) </th>
                                        </tr>
                                        @foreach ($order->orderItems as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="field">
                                                        <div class="form-group row ">
                                                            <div class="col">
                                                                <input type="hidden" name="item_id[]"
                                                                    value="{{ $item->id }}">
                                                                <select id="material" name="material[]"
                                                                    class="custom-select @error('material') is-invalid @enderror">
                                                                    <option value="">--SELECT MATERIAL--</option>
                                                                    @foreach (App\Order::MATERIALS as $material)
                                                                        <option value="{{ $material }}"
                                                                            {{ $item->material == $material ? 'selected' : '' }}>
                                                                            {{ $material }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('material') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="field">
                                                        <div class="form-group row ">
                                                            <div class="col">
                                                                <select id="size" name="size[]"
                                                                    class="custom-select @error('size') is-invalid @enderror">
                                                                    <option value="">--SELECT SIZE--</option>
                                                                    @foreach (App\Order::SIZES as $size)
                                                                        <option value="{{ $size }}"
                                                                            {{ $item->size == $size ? 'selected' : '' }}>
                                                                            {{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback">{{ $errors->first('size') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="field">
                                                        <div class="form-group row ">
                                                            <div class="col">
                                                                <input
                                                                    class="form-control @error('quantity_item') is-invalid @enderror"
                                                                    type="number" name="quantity_item[]" id="quantity_item"
                                                                    value="{{ old('quantity_item') ?? ($item->quantity ?? '') }}"
                                                                    placeholder=" Quantity">
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('quantity_item') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="field">
                                                        <div class="form-group row ">
                                                            <div class="col">
                                                                <input
                                                                    class="form-control @error('price_item') is-invalid @enderror"
                                                                    type="number" name="price_item[]" id="price_item"
                                                                    value="{{ (float) (old('price_item') ?? ($item->price / 100 ?? 0)) }}" />
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('price_item') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox mt-2">
                                                        <input type="checkbox" name='delete[]' value='{{ $item->id }}'>
                                                        <div class="btn btn-danger" name='delete[]'>Delete</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                            <p class="small text-muted float-right">*Checked item will be removed.</p>
                            <div id="AddItem" data-materials="{{ json_encode($materials) }}"
                                data-sizes="{{ json_encode($sizes) }}"></div>

                            <div class="field">
                                <label class="label" for="deposit_amount">Deposit Amount</label>
                                <div class="form-group row ">
                                    <div class="col-md-4">
                                        <input class="form-control @error('deposit_amount') is-invalid @enderror"
                                            type="number" name="deposit_amount" id="deposit_amount" step='.01'
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
                                        <div class="invalid-feedback">{{ $errors->first('deposit_payment_method') }}
                                        </div>
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
                                                    {{ $payment }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('payment_method') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="notice_ambilan_ref">Notis Ambilan </label>
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <input class="form-control @error('notice_ambilan_ref') is-invalid @enderror"
                                            type="text" name="notice_ambilan_ref" id="notice_ambilan_ref"
                                            value="{{ old('notice_ambilan_ref') ?? ($order->notice_ambilan_ref ?? '') }}"
                                            placeholder="Notis Ambilan">
                                        <div class="invalid-feedback">{{ $errors->first('notice_ambilan_ref') }}</div>
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
                <div class="col-md-3 mx-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Calculate Size</h4>
                        </div>
                        <div class="card-body">
                            <div class="field">
                                <label class="label" for="cal_length">Actual length (ft) </label>
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <input class="form-control " type="number" name="cal_length" id="cal_length"
                                            value="{{ old('cal_length') ?? ($order->cal_length ?? '') }}"
                                            placeholder="Length"
                                            onblur="calculate('cal_length', 'cal_width', 'total_length','actual_size')">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label" for="cal_width">Actual width (ft) </label>
                                <div class="form-group row">
                                    <div class="col-auto">
                                        <input class="form-control " type="number" name="cal_width" id="cal_width"
                                            value="{{ old('cal_width') ?? ($order->cal_width ?? '') }}" placeholder=" Width"
                                            onblur="calculate('cal_length', 'cal_width', 'total_length', 'actual_size')">
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="total_length">Total Size(ft)</label>
                                <p id="total_length"></p>
                                <p id="actual_size"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


