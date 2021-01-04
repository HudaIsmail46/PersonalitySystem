<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        .invoice-box {
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 13px;
            line-height: 24px;
            font-family: 'Roboto, Segoe UI, 'Tahoma', sans-serif';
            color: rgb(0, 0, 0);
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>
    <div class="invoice-box">

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <hr>
                            <td class="title">
                                <img src="img/cleanherologo800.png"
                                    style="width:30%; max-width:100px; margin-right:35%">
                            </td>
                            <td style="text-align:left">
                                <p>
                                    <b> Cleanhero (M) Sdn Bhd</b>
                                    <br>No. 12A, Jalan Perindustrian Suntrack,
                                    <br>Hub Perindustrian Suntrack,
                                    <br>Off Jalan P1A, Seksyen 13,
                                    <br>Bandar Baru Bangi, Selangor
                                    <br>43650 MY
                                    <br>03-84081676
                                    <br>hai@cleanhero.com.my
                                    <br>https://cleanhero.com.my
                                    <br>Trade Reg. Nr. 1309263-D
                                </p>
                            </td>
                            <td style=" text-align:right">
                                <p> Woocommerce
                                    <br>Order Ref :
                                    {{ $order->woocommerce_order_id }}
                                </p>
                                <p> Order ID :
                                    {{ $order->id }}
                                </p>
                                @if ($order->paid_at)
                                    <h3 style="color: red;"><strong>PAID</strong></h3>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                <p><b>BILL TO</b>
                                    <br>{{ ucwords($order->customer->name) }}
                                    <br>{!! orderAddress($order) !!}
                                    <br>{{ $order->customer->phone_no }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <table style="padding-top: 20px">
                <tr>
                    <td><b>Payment Method</b></td>
                </tr>
                <tr>
                    <td>
                        <p><b> Deposit Detail :</b><br>
                            @if ($order->deposit_paid_at != null)
                                Paid at
                                {{ $order->deposit_paid_at ? myLongDateTime(new Carbon\Carbon($order->deposit_paid_at)) : null }}<br>
                                via {{ $order->deposit_payment_method }}
                            @else
                                Not yet paid.
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>Payment Detail :</b><br>
                            @if ($order->paid_at != null)
                                Paid at
                                {{ $order->paid_at ? myLongDateTime(new Carbon\Carbon($order->paid_at)) : null }}<br>
                                via {{ $order->payment_method }}
                            @else
                                Not yet paid.
                            @endif
                        </p>
                    </td>
                </tr>
            </table>


            <table style="width:100% ;  padding-top: 20px">
                <tr class="item">
                    <td style="border-bottom: none">
                        Thank you for choosing us as your cleaning and hygiene expert!
                    </td>
                    <td>
                        Subtotal
                    </td>
                    <td style="text-align:right">
                        {{ money($order->price) }}
                    </td>
                </tr>
                <tr class="item">
                    <td style="border-bottom: none">
                        Kindly proceed with the payment before the due date to: </td>
                    <td>
                        Discount {{$order->discount_rate}}%
                    </td>
                    <td style="text-align:right">
                        - {{ money($order->discount()) }}
                    </td>
                </tr>
                <tr class="item">
                    <td style="border-bottom: none">
                        Cleanhero (M) Sdn Bhd </td>
                    <td>
                        Total
                    </td>
                    <td style="text-align:right">
                        {{ money($order->totalPrice()) }}
                    </td>
                </tr>
                <tr class="item">
                    <td style="border-bottom: none">
                        CIMB: 8603 558 004</td>                    
                    <td>
                        Deposit Amount
                    </td>
                    <td style="text-align:right">
                        {{ money($order->deposit_amount) }}
                    </td>
                </tr>
                <tr class="item-last">
                    <td style="border-bottom: none">
                       SST Reg No : W24-1905-32100002
                    </td>
                    <td>
                        <b>TOTAL DUE</b>
                    </td>
                    <td style="text-align:right">
                        {{ money($order->balance_to_pay()) }}
                    </td>
                </tr>
            </table>

            <table>
                <tr class="heading">
                    <td colspan="3">QUANTITY</td>
                    <td style="text-align:left">PRODUCT</td>
                    <td colspan="2">SIZE</td>
                    <td style="text-align:right">AMOUNT</td>

                </tr>
                @foreach ($order->orderItems as $item)
                    <tr class="item">
                        <td colspan="3">{{ $item->quantity }} </td>
                        <td style="text-align:left">{{ ucwords($item->material) }}</td>
                        <td colspan="2">{{ strtoUpper($item->size) }}</td>
                        <td style="text-align:right">{{ money($item->price) }}</td>
                    </tr>
                @endforeach
            </table>
        </table>

        <div class="ml-4 mr-5 mt-3">
            <p>
                <b><u>Terma &amp; Syarat:</u></b>
            <p>
                1. Tempoh cucian karpet mengambil masa 3
                minggu.<br>
                2. CleanHero akan menolak atau tidak
                meneruskan cucian bagi karpet yang telah
                reput, berlubang atau berpotensi menjadi
                rosak.<br>
                3. Pelanggan hendaklah memaklumkan kepada
                pekerja CleanHero berkaitan material
                pembuatan karpet sekiranya tiada maklumat
                berkaitan di atas label karpet. Kami tidak akan
                bertanggungjawab sekiranya ketiadaan
                maklumat mengenai material menyebabkan
                karpet anda rosak akibat kaedah cucian.<br>
                4. Karpet yang tidak dituntut dalam tempoh 60
                hari dari tarikh siap dicuci, akan dilupus, dijual
                atau diderma. Tiada pemulangan wang deposit
                akan dilakukan.<br>
            </p>
            <b><u>Terms &amp; Conditions:</u></b>
            <p>
                1. Carpet cleaning duration will take 3 weeks.<br>
                2. CleanHero will not accept or continue the
                cleaning process if the carpet is weakened,
                already torn or has potential to degrade.<br>
                3. Customer need to inform CleanHero’s
                technician on the material of the carpet fabric if
                there is no information label at the back of the
                carpet. We will not be responsible if lack of
                information caused wrong cleaning method and
                hence damaging the carpet.<br>
                4. If carpet is not collected in 60 days after
                cleaning, we have the right to dispose, sell or
                donate it. No deposit will be refunded.<br>
            </p>
            </p>
        </div>
    </div>
</body>

</html>
