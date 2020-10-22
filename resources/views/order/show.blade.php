@extends ('layouts.app')

@section('title', 'Page Title')

<title>Order Data</title>

@section ('content')

    <div id="wrapper">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    <!-- {{$order->id}} -->
                    <p>Order Detail</p>
                </div>
                <div class="card-body">

                    <table style="width:100%" >
                        <tr>
                            <th> id: {{$order->id}}</th>
                            <th align="left"></th>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td align="left">{{$order->size}}</td>
                        </tr>
                        <tr>
                            <td>Material</td>
                            <td align="left">{{$order->material}}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td align="left">{{money($order->price)}}</td>
                        </tr>
                        <tr>
                            <td>Prefered Pickup Date Time</td>
                            <td align="left">{{$order->prefered_pickup_datetime}}</td>
                        </tr>
                        <tr>
                            <td>Actual Length</td>
                            <td align="left">{{$order->actual_length}}</td>
                        </tr>
                        <tr>
                            <td>Actual width</td>
                            <td align="left">{{$order->actual_width}}</td>
                        </tr>
                        <tr>
                            <td>Actual Material</td>
                            <td align="left">{{$order->actual_material}}</td>
                        </tr>
                        <tr>
                            <td>Actual Price</td>
                            <td align="left">{{money($order->actual_price)}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td align="left">{{$order->status}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <div class="container">
            <table align="center">
                <a href="{{ route('order.edit',$order->id)}}" class="btn btn-primary mr-2">Edit</a>

                <form action="{{ route('order.destroy', $order->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                </form>
            </table>
        </div>


@endsection

