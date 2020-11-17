@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Order Data</title>

@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                        <p>Order Detail</p>
                    </div>
                    <div class="card-body">
                        <table class='w-100' >
                            <tr>
                                <th> Id: {{$order->id}}</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>
                                    Name : {{$order->customer->name}}
                                    <br>
                                    Phone No : {{$order->customer->phone_no}}
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {!!orderAddress($order)!!}
                                </td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>{{$order->size}}</td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td>{{$order->material}}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{money($order->price)}}</td>
                            </tr>
                            <tr>
                                <td>Prefered Pickup Date Time</td>
                                <td>{{myLongDateTime(Carbon\Carbon::parse($order->prefered_pickup_datetime))}}</td>
                            </tr>
                            <tr>
                                <td>Actual Length</td>
                                <td>{{$order->actual_length}}</td>
                            </tr>
                            <tr>
                                <td>Actual width</td>
                                <td>{{$order->actual_width}}</td>
                            </tr>
                            <tr>
                                <td>Actual Material</td>
                                <td>{{$order->actual_material}}</td>
                            </tr>
                            <tr>
                                <td>Actual Price</td>
                                <td>{{money($order->actual_price)}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{humaniseOrderState($order->state)}}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    @foreach ($order->images as $image)
                                        <img src="{{ asset('/storage/' .$image->file ?? '')}}" alt="" class="img-thumbnail" >
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    @if ($image != null)
                                        <form class='mb-0' action="{{ route('order.destroyImage', $image->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete Image <i class="fa fa-trash"></i></button>
                                        </form>
                                    @else
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                        </table>

                        <div class="row mt-5">
                            <a href="{{ route('order.edit',$order->id)}}" class="btn btn-primary mr-2">Edit</a>

                            <form class='mb-0' action="{{ route('order.destroy', $order->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
