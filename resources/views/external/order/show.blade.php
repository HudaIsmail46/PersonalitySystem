@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Order Data</title>

@section('content')
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
            <div class="row d-flex">
                <div class="col-md-6 card">
                    <div class="card-header">
                        <h3 class="mb-0">Order Detail</h3>
                    </div>
                    <div class="card-body p-1 text-capitalize">
                        <table class='table table-bordered table-striped w-100'>
                            <tr>
                                <td> Order Id</td>
                                <td> {{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>{{ $order->size }}</td>
                            </tr>
                            <tr>
                                <td>Material</td>
                                <td>{{ $order->material }}</td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>{{ $order->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ humaniseOrderState($order->state) }}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>
                                    @include('images.table', ['images' => $order->images, 'can_delete_image' => auth()->user()->can('create orders')])
                                    @include('images.create', ['images' => $order->images, 'imageableId' => $order->id, 'imageableType' => App\Order::class ])
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 mx-1 ">  
                    @include('comment.index', ['model' => $order, 'appName' => App\Order::class])
                </div>
            </div>
        </div>
    </div>
@endsection
