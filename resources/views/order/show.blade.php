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
                                <td>Woocommerce Order Ref</td>
                                <td>{{ $order->woocommerce_order_id}}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td>
                                    Name : {{ $order->customer->name }}
                                    <br>
                                    Phone No : {{ $order->customer->phone_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {!! orderAddress($order) !!}
                                </td>
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
                                <td>Price</td>
                                <td>{{ money($order->price) }}</td>
                            </tr>
                            <tr>
                                <td>Prefered Pickup Date Time</td>
                                <td>{{ myLongDateTime(Carbon\Carbon::parse($order->prefered_pickup_datetime)) }}</td>
                            </tr>
                            <tr>
                                <td>Actual Length</td>
                                <td>{{ $order->actual_length }}</td>
                            </tr>
                            <tr>
                                <td>Actual width</td>
                                <td>{{ $order->actual_width }}</td>
                            </tr>
                            <tr>
                                <td>Actual Material</td>
                                <td>{{ $order->actual_material }}</td>
                            </tr>
                            <tr>
                                <td>Actual Price</td>
                                <td>{{ money($order->actual_price) }}</td>
                            </tr>
                            <tr>
                                <td>Deposit Detail</td>
                                <td>
                                    @if($order->deposit_paid_at != null)
                                        Paid at  {{ $order->deposit_paid_at ? myLongDateTime(new Carbon\Carbon($order->deposit_paid_at)) : null}}
                                            via {{ $order->deposit_payment_method}}
                                    @else
                                        Not yet paid.
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Payment Detail</td>
                                <td>
                                    @if($order->paid_at != null)
                                        Paid at  {{ $order->paid_at ? myLongDateTime(new Carbon\Carbon($order->paid_at)) : null}}
                                            via {{ $order->payment_method}}
                                    @else
                                        Not yet paid.
                                    @endif
                                </td>
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
                                    @include('images.table', ['images' => $runnerJobImages, 'can_delete_image' => auth()->user()->can('create runnerSchedules')])
                                    @include('images.table', ['images' => $order->images, 'can_delete_image' => auth()->user()->can('create orders')])
                                </td>
                            </tr>
                            @can('create orders')
                            <tr>
                                <td>Action</td>
                                <td><div id='OrderStateQuickChange' data-order="{{json_encode($order)}}"></div></td>
                            </tr>
                            @endcan
                        </table>
                        @can('create orders')
                            <div class="row mt-3 ml-0">
                                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary mr-2">Edit</a>
                                @if($order->state == "App\State\Order\Draft")
                                    <form class='mb-0' action="{{ route('order.destroy', $order->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                                            type="submit">Delete <i class="fa fa-trash"></i></button>
                                    </form>
                                @endif
                                <a href="{{ route('customer_order.show', $encId) }}" target="_blank" class="btn btn-primary mr-2 ml-auto">Public Order Page</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="col-md-5 mx-1 ">
                        @include('order.runner_job')
                        @include('comment.index', ['model' => $order, 'appName' => App\Order::class])
                </div>
            </div>
        </div>
    </div>
@endsection
