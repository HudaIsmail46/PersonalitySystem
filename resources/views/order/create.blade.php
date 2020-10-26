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
                        <form method="post" action="{{route('order.store')}}">
                        @csrf

                            <div class="container">
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

                                                    @error('price')
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

