@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Order</title>

@section('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Create Order
                </div>


        <div class ="inner">
            <div class="card-body>">
                <form method="POST" action="{{route('order.store')}}">
                @csrf


                <div class="field" id="form">
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
                                value="{{old ('material')}}"
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
                                value="{{old('price')}}"
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
                                value="{{old('prefered_pickup_datetime')}}"
                                placeholder="prefered_pickup_datetime">

                                @error('prefered_pickup_datetime')
                                    <p class="help is-danger">{{$errors->first('prefered_pickup_datetime')}}</p>
                                @enderror
                        </div>

                </div>

                <div class="field">
                    <label class="label" for ="actual_size">Actual Size</label>

                        <div class="form-group">
                            <select id="actual_size" name="actual_size">
                                <option value="xs">xs</option>
                                <option value="s">s</option>
                                <option value="m">m</option>
                                <option value="l">l</option>
                                <option value="xl">xl</option>
                            </select>
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
                                value="{{old('actual_material')}}"
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
                                value="{{old('actual_price')}}"
                                placeholder="actual_price">

                                @error('actual_price')
                                    <p class="help is-danger">{{$errors->first('actual_price')}}</p>
                                @enderror
                        </div>
                </div>

                <div class="field">
                    <label class="label" for ="images">Images</label>

                        <div class="form-group">
                            <input
                                class="input @error('images') is-danger @enderror"
                                type="input"
                                name="images"
                                id="images"
                                value="{{old('images')}}"
                                placeholder="images">

                                @error('images')
                                    <p class="help is-danger">{{$errors->first('images')}}</p>
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
        </div>
    </div>

    @endsection

