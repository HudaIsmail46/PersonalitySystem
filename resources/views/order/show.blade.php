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
                <table >
                <tr >
                    <th> id: {{$order->id}}</th>
                    <th></th>
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
                    <td>{{$order->price}}</td>
                </tr>
                <tr>
                    <td>Prefered Pickup Date Time</td>
                    <td>{{$order->prefered_pickup_datetime}}</td>
                </tr>
                <tr>
                    <td>Actual Size</td>
                    <td>{{$order->actual_size}}</td>
                </tr>
                <tr>
                    <td>Actual Material</td>
                    <td>{{$order->actual_material}}</td>
                </tr>
                <tr>
                    <td>Actual Price</td>
                    <td>{{$order->actual_price}}</td>
                </tr>
                <tr>
                    <td>Images</td>
                    <td>{{$order->images}}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$order->status}}</td>
                </tr>

         </table>
         <table>
         <tfoot>
                <td valign="bottom">
                    <a href="{{ route('order.edit',$order->id)}}" class="btn btn-primary">Edit</a></td>
                <td valign="bottom">
                    <form action="{{ route('order.destroy', $order->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tfoot>
            </table>
            </div>
        </div>
    </div>
@endsection

