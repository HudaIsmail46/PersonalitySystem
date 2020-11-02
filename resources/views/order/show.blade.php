@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Order Data</title>

@section ('content')
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
                                <td>{{$order->status}}</td>
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
