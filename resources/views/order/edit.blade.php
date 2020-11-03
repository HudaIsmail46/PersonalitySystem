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
            <div class="col-md-6 mx-auto card mt-4">
                <div class="card-header">
                    Update Order
                </div>

                <form method="POST" action="{{ route('order.update', $order->id)}}">
                    @csrf
                    @method('PUT')

                    <div class="inner">
                        <div class="card-body">
                            Name : {{$order->customer->name}}
                            <br>
                            Phone No : {{$order->customer->phone_no}}
                            <div class="field">
                                <label class="label" for ="size">Size</label>

                                <div class="form-group">
                                    <select id="size" name="size">
                                        @foreach(App\Order::SIZES as $size)
                                            <option value="{{$size}}" {{$order->size == $size ? 'selected': ''}}>{{$size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="material">Material</label>

                                <div class="form-group">
                                    <select id="material" name="material">
                                        @foreach(App\Order::MATERIALS as $material)
                                            <option value="{{$material}}" {{$order->material == $material ? 'selected' : ''}}>{{$material}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="price">Price</label>

                                <div class="form-group">
                                    <input class="input @error('price') is-danger @enderror" type="number" name="price" id="price" step='0.01' value="{{(float)(old('price')?? $order->price/100 ?? 0)}}" placeholder="price">

                                    @error('price')
                                    <p class="help is-danger">{{$errors->first('price')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="prefered date time">Prefered Pickup Date and Time</label>

                                <div class="form-group">
                                    <input class="input @error('prefered_pickup_datetime') is-danger @enderror" type="datetime-local" name="prefered_pickup_datetime" id="prefered_pickup_datetime" value="{{old('prefered_pickup_datetime')?? Carbon\Carbon::parse($order->prefered_pickup_datetime)->toDateTimeLocalString() ?? ''}}" placeholder="prefered_pickup_datetime">

                                    @error('prefered_pickup_datetime')
                                        <p class="help is-danger">{{$errors->first('prefered_pickup_datetime')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="actual_length">Actual length</label>
                                <div class="form-group">
                                    <input class="input @error('actual_length') is-danger @enderror" type="number" name="actual_length" id="actual_length" value="{{old('actual_length')?? $order->actual_length ?? ''}}" placeholder="actual_length">

                                    @error('actual_length')
                                        <p class="help is-danger">{{$errors->first('actual_length')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="actual_width">Actual width</label>
                                <div class="form-group">
                                    <input class="input @error('actual_width') is-danger @enderror" type="number" name="actual_width" id="actual_width" value="{{old('actual_width')?? $order->actual_width ?? ''}}" placeholder="actual_width">

                                    @error('actual_width')
                                        <p class="help is-danger">{{$errors->first('actual_width')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="actual_material">actual_material</label>

                                <div class="form-group">
                                    <input class="input @error('actual_material') is-danger @enderror" type="input" name="actual_material" id="actual_material" value="{{old('actual_material')?? $order->actual_material ?? ''}}" placeholder="actual_material">

                                    @error('actual_material')
                                        <p class="help is-danger">{{$errors->first('actual_material')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="actual_price">actual_price</label>

                                <div class="form-group">
                                    <input class="input @error('actual_price') is-danger @enderror" type="number" name="actual_price" id="actual_price" step='0.01' value="{{(float)(old('actual_price')?? $order->actual_price/100 ?? 0)}}" placeholder="actual_price">

                                    @error('actual_price')
                                        <p class="help is-danger">{{$errors->first('actual_price')}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for ="status">Status</label>

                                <div class="form-group">
                                    <select id="status" name="status">
                                        @foreach(App\Order::STATUSES as $status)
                                            <option value="{{$status}}" {{$order->status == $status ? 'selected': ''}}>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field is grouped">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
