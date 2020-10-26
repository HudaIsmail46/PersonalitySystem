@extends('layouts.app')

@section('title', 'Page Title')

    <title>Update Order</title>

@section('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Update Order
                </div>

                <form method="POST" action="{{ route('order.update', $order->id)}}">
                @csrf
                @method('PUT')

                <div class="container">
                    <div class="field">
                        <label class="label" for ="size">Size</label>

                        <div class="form-group">
                            <select id="size" name="size">
                                <option value="xs">xs</option>
                                <option value="s">s</option>
                                <option value="m">m</option>
                                <option value="l">l</option>
                                <option value="xl">xl</option>
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="material">material</label>

                        <div class="form-group">
                            <input
                            class="input @error('material') is-danger @enderror"
                            type="text"
                            name="material"
                            id="material"
                            value="{{old('material')?? $order->material ?? ''}}"
                            placeholder="material">

                            @error('material')
                                <p class="help is-danger">{{$errors->first('material')}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="price">price</label>

                        <div class="form-group">
                            <input
                                class="input @error('price') is-danger @enderror"
                                type="number"
                                name="price"
                                id="price"
                                value="{{old('price')?? $order->price ?? ''}}"
                                placeholder="price">

                                @error('number')
                                    <p class="help is-danger">{{$errors->first('number')}}</p>
                                @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="prefered date time">Prefered Pickup Date and Time</label>

                        <div class="form-group">
                            <input
                            class="input @error('prefered_pickup_datetime') is-danger @enderror"
                            type="datetime-local"
                            name="prefered_pickup_datetime"
                            id="prefered_pickup_datetime"
                            value="{{old('prefered_pickup_datetime')?? $order->prefered_pickup_datetime ?? ''}}"
                            placeholder="prefered_pickup_datetime">

                            @error('prefered_pickup_datetime')
                                <p class="help is-danger">{{$errors->first('prefered_pickup_datetime')}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="actual_length">Actual length</label>
                        <div class="form-group">
                            <input
                            class="input @error('actual_length') is-danger @enderror"
                            type="number"
                            name="actual_length"
                            id="actual_length"
                            value="{{old('actual_length')?? $order->actual_length ?? ''}}"
                            placeholder="actual_length">

                                @error('actual_length')
                                    <p class="help is-danger">{{$errors->first('actual_length')}}</p>
                                @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="actual_width">Actual width</label>
                        <div class="form-group">
                            <input
                            class="input @error('actual_width') is-danger @enderror"
                            type="number"
                            name="actual_width"
                            id="actual_width"
                            value="{{old('actual_width')?? $order->actual_width ?? ''}}"
                            placeholder="actual_width">

                                @error('actual_width')
                                    <p class="help is-danger">{{$errors->first('actual_width')}}</p>
                                @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="actual_material">actual_material</label>

                        <div class="form-group">
                            <input
                            class="input @error('actual_material') is-danger @enderror"
                            type="input"
                            name="actual_material"
                            id="actual_material"
                            value="{{old('actual_material')?? $order->actual_material ?? ''}}"
                            placeholder="actual_material">

                                @error('actual_material')
                                    <p class="help is-danger">{{$errors->first('actual_material')}}</p>
                                @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="actual_price">actual_price</label>

                        <div class="form-group">
                            <input
                            class="input @error('actual_price') is-danger @enderror"
                            type="number"
                            name="actual_price"
                            id="actual_price"
                            value="{{old('actual_price')?? $order->actual_price ?? ''}}"
                            placeholder="actual_price">

                                @error('actual_price')
                                    <p class="help is-danger">{{$errors->first('actual_price')}}</p>
                                @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for ="status">Status</label>

                        <div class="form-group">
                            <select id="status" name="status">
                                <option value="pending">pending</option>
                                <option value="delivered">delivered</option>
                                <option value="in_warehouse">In Warehouse</option>
                                <option value="process">process</option>

                            </select>
                        </div>
                    </div>

                    <div class="field is grouped">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

