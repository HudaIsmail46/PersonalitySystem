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
                                    <div class="table-responsive p-2">
                                        <table class='table table-bordered table-striped w-100'>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Item</th>
                                                <th>Size</th>
                                                <th>Amount</th>
                                            </tr>
                                            @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->quantity }} </td>
                                                <td>{{ $item->material }}</td>
                                                <td>{{ strtoUpper($item->size) }}</td>
                                                <td>{{ money($item->price) }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                    <div class="table-responsive p-2">
                                        <table class='table table-bordered table-striped w-50 float-right'>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>
                                                {{ money($order->price) }}
                                                </td>    
                                            </tr>
                                            <tr>
                                                <th>Deposit Amount</th>
                                                <td>
                                                {{ money($order->deposit_amount) }}
                                                </td>    
                                            </tr>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td>
                                                {{ money($order->balance_to_pay()) }}
                                                </td>     
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

                                    <div class="card-footer p-4 pb-4 " style="text-transform: none">
                                        <div class="row">
                                            <div>
                                                <strong class="ml-3"><u>Terma &amp; Syarat:</u></strong><br><br>
                                                <ol class="mr-3">
                                                    <li>Tempoh cucian karpet mengambil masa 3
                                                        minggu.</li>
                                                    <li>CleanHero akan menolak atau tidak
                                                        meneruskan cucian bagi karpet yang telah
                                                        reput, berlubang atau berpotensi menjadi
                                                        rosak.</li>
                                                    <li>Pelanggan hendaklah memaklumkan kepada
                                                        pekerja CleanHero berkaitan material
                                                        pembuatan karpet sekiranya tiada maklumat
                                                        berkaitan di atas label karpet. Kami tidak akan
                                                        bertanggungjawab sekiranya ketiadaan
                                                        maklumat mengenai material menyebabkan
                                                        karpet anda rosak akibat kaedah cucian.</li>
                                                    <li>Karpet yang tidak dituntut dalam tempoh 60
                                                        hari dari tarikh siap dicuci, akan dilupus, dijual
                                                        atau diderma. Tiada pemulangan wang deposit
                                                        akan dilakukan.</li>
                                                </ol>
                                                <strong class="ml-3"><u>Terms &amp; Conditions:</u></strong><br><br>
                                                <ol class="mr-3">
                                                    <li>Carpet cleaning duration will take 3 weeks.</li>
                                                    <li>CleanHero will not accept or continue the
                                                        cleaning process if the carpet is weakened,
                                                        already torn or has potential to degrade.</li>
                                                    <li>Customer need to inform CleanHero’s
                                                        technician on the material of the carpet fabric if
                                                        there is no information label at the back of the
                                                        carpet. We will not be responsible if lack of
                                                        information caused wrong cleaning method and
                                                        hence damaging the carpet.</li>
                                                    <li>If carpet is not collected in 60 days after
                                                        cleaning, we have the right to dispose, sell or
                                                        donate it. No deposit will be refunded.</li>
                                                    </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-2">
                                        <a class="btn btn-primary" href="{{ route('customer_order.pdf',$orderId)}}">
                                            <i class="fa fa-download">
                                                </i> Generate PDF</a>
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
