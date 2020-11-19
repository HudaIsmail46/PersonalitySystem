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
                <div class="card-body">
                    <div class="mt-3 mb-5">
                        <h3>Customer</h3>
                        Name : {{$order->customer->name}}
                        <br>
                        Phone No : {{$order->customer->phone_no}}
                    </div>
                    <h3>Order</h3>
                    <form method="POST" action="{{ route('order.update', $order->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label class="label" for ="address_1">Address 1</label>
                            <div class="form-group">
                                <input class="input @error('address_1') is-danger @enderror" type="text" name="address_1" id="address_1" value="{{old('address_1')?? $order->address_1 ?? ""}}" placeholder="Address 1">

                                @error('address_1')
                                    <p class="help is-danger">{{$errors->first('address_1')}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for ="address_2">Address 2</label>
                            <div class="form-group">
                                <input class="input @error('address_2') is-danger @enderror" type="text" name="address_2" id="address_2" value="{{old('address_2')?? $order->address_2 ?? ""}}" placeholder="Address 2">

                                @error('address_2')
                                    <p class="help is-danger">{{$errors->first('address_2')}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for ="postcode">Postcode</label>
                            <div class="form-group">
                                <input class="input @error('postcode') is-danger @enderror" type="text" name="postcode" id="postcode" value="{{old('postcode')?? $order->postcode ?? ""}}" placeholder="Postcode">

                                @error('postcode')
                                    <p class="help is-danger">{{$errors->first('postcode')}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for ="city">City</label>
                            <div class="form-group">
                                <input class="input @error('city') is-danger @enderror" type="text" name="city" id="city" value="{{old('city')?? $order->city ?? ""}}" placeholder="City">

                                @error('city')
                                    <p class="help is-danger">{{$errors->first('city')}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for ="location_state">Location State</label>
                            <div class="form-group">
                                <input class="input @error('location_state') is-danger @enderror" type="text" name="location_state" id="location_state" value="{{old('location_state')?? $order->location_state ?? ""}}" placeholder="Location State">

                                @error('location_state')
                                    <p class="help is-danger">{{$errors->first('location_state')}}</p>
                                @enderror
                            </div>
                        </div>

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
                                    @foreach($availableStates as $status)
                                        <option value="{{$status}}" {{$order->state == $status ? 'selected': ''}}>{{humaniseOrderState($status)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="field">
                            <label class="label" for ="image">Image</label>

                            <div class="form-group">
                                <input class="input @error('image') is-danger @enderror" type="file"
                                name="image"
                                id="image"
                                value="{{old('image')?? $order->image->file ?? ''}}">
                                @error('image')
                                    <p class="help is-danger">{{$errors->first('image')}}</p>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
                                class="dropzone border border-info rounded" id="dropzone">
                                @csrf
                        </form> --}}

                        <div class="dropzone border border-info rounded" id="dropzone"></div><br>

                        {{-- <form action="{{route('users.fileupload')}}" class='dropzone' >
                        </form>  --}}

                        <script type="text/javascript">
                        Dropzone.autoDiscover = false;
                                    Dropzone.options.dropzone =
                                     {
                                        maxFilesize: 12,
                                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                                        addRemoveLinks: true,
                                        timeout: 5000,
                                        removedfile: function(file)
                                        {
                                            var name = file.upload.file;
                                            $.ajax({
                                                headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                        },
                                                type: 'POST',
                                                url: '{{ url("image/delete") }}',
                                                data: {filename: name},
                                                success: function (data){
                                                    console.log("File has been successfully removed!!");
                                                },
                                                error: function(e) {
                                                    console.log(e);
                                                }});
                                                var fileRef;
                                                return (fileRef = file.previewElement) != null ?
                                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                                        },

                                        success: function(file, response)
                                        {
                                            console.log(response);
                                        },
                                        error: function(file, response)
                                        {
                                           return false;
                                        }
                            };
                                // var csrf_token =document.getElementById("_token");
                                var CSRF_TOKEN = document.querySelector('meta[name="_token"]').getAttribute("content");
                                var order = document.getElementById("order.id");
                                var myDropzone = new window.Dropzone("div#dropzone", { url: "/api/image"});
                                myDropzone.on("sending", function(file, xhr, formData) {
                                // Will send the filesize along with the file as POST data.
                                formData.append("imageable_id",order);
                                formData.append("imageable_type", "App\\Order");
                                formData.append("_token", CSRF_TOKEN);
                                });

                            </script>



                        <div class="field is grouped">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
