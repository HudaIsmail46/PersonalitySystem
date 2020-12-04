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

                                    <div  class=" row">
                                        <div class=" col sm-4">
                                            <div  class="ml-2 ">
                                                <p><b>From :</b>
                                                    <br> Clean Hero (M) Sdn Bhd
                                                    <br>12A Jalan Perindustrian
                                                    <br>Suntrack Hub Perindustrian
                                                    <br>Suntrack Off,
                                                    <br>Jalan P/1A, Seksyen 13,
                                                    <br>43650 Bandar Baru Bangi,
                                                    <br>Selangor
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col sm-4">
                                            <div  class="ml-2 ">
                                                <p><b>To :</b>
                                                    <br>{{ $order->customer->name }}
                                                    <br>{!! orderAddress($order) !!}
                                                    <br>{{ $order->customer->phone_no }}
                                                </p>
                                            </div>
                                        </div>
                                        <div  class="mr-5">
                                            <div class="row ml-0" >
                                                <p class="font-weight-bold"> Woocommerce Order Ref :</p>
                                                <p>{{ $order->woocommerce_order_id}}</p>
                                            </div>
                                            <div class="row  ml-0" >
                                                <p class="font-weight-bold"> Order ID :</p>
                                                <p>{{ $order->id }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class='table table-bordered table-striped w-100'>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>material</th>
                                                <th>Size</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                            </tr>
                                            <tr>
                                                <td>{{ $order->quantity }} </td>
                                                <td> {{ $order->material }}</td>
                                                <td> {{ $order->size }}</td>
                                                <td> {{humaniseOrderState($order->state) }}</td>
                                                <td> {{money($order->price) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="ml-3">
                                        <h3>Payment</h3>
                                        <div>
                                            <p><b> Deposit Detail :</b><br>
                                                @if($order->deposit_paid_at != null)
                                                    Paid at  {{ $order->deposit_paid_at ? myLongDateTime(new Carbon\Carbon($order->deposit_paid_at)) : null}}<br>
                                                        via {{ $order->deposit_payment_method}}
                                                @else
                                                    Not yet paid.
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p><b>Payment Detail :</b><br>
                                                @if($order->paid_at != null)
                                                    Paid at  {{ $order->paid_at ? myLongDateTime(new Carbon\Carbon($order->paid_at)) : null}}<br>
                                                        via {{ $order->payment_method}}
                                                @else
                                                    Not yet paid.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
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
