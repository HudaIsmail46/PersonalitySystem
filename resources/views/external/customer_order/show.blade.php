<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <script src="https://kit.fontawesome.com/be4357277b.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">    

    </head>

    <body class="layout-top-nav bg-gray text-body">
        <div class="wrapper">
            @include('external.customer_order.top_nav')
            <div class="container">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Orders</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row d-flex">
                            <div class="col-12 card text-body">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer ml-0">
            <div class="d-none d-sm-inline">
                Clean Hero (M) Sdn Bhd
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020<a href="https://cleanhero.com.my">Cleanhero (M) Sdn Bhd</a>.</strong> All rights
            reserved.
        </footer>
    </body>
</html>
