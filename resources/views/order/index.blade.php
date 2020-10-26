@extends ('layouts.app')


@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order</h1>
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
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="card-header">
                           Order Details
                        </div>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>size</th>
                                        <th>Material</th>
                                        <th>Price</th>
                                        <th>Prefered Date Time</th>
                                        <th>Actual Length</th>
                                        <th>Actual Width</th>
                                        <th>Actual Material</th>
                                        <th>Actual Price</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        @foreach($orders as $order)

                                        <td><a href="{{$order->path()}}">{{ $order ->id}}</td>
                                        <td>{{ $order->size}}</td>
                                        <td>{{ $order->material }}</td>
                                        <td>{{ $order->price}}</td>
                                        <td>{{ $order->prefered_pickup_datetime}}</td>
                                        <td>{{ $order->actual_length}}</td>
                                        <td>{{ $order->actual_width}}</td>
                                        <td>{{ $order->actual_material}}</td>
                                        <td>{{ $order->actual_price}}</td>
                                        <td>{{ $order->status}}</td>

                                    </tr>
                                    @endforeach

                                </table>
                                {{ $orders ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
