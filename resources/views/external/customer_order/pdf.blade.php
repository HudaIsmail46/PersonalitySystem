<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
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
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
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
                            <td class="title">
                                <img src="img/cleanherologo800.png" style="width:30%; max-width:100px;">
                            </td>
                            <td>
                                <p> Woocommerce
                                <br>Order Ref :
                                {{ $order->woocommerce_order_id}}</p>
                                <p> Order ID :
                                {{ $order->id }}</p>
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
                                <p><b>From :</b>
                                    <br> Clean Hero (M) Sdn Bhd
                                    <br>12A Jalan Perindustrian
                                    <br>Suntrack Hub Perindustrian
                                    <br>Suntrack Off,
                                    <br>Jalan P/1A, Seksyen 13,
                                    <br>43650 Bandar Baru Bangi,
                                    <br>Selangor
                                </p>
                            </td>

                            <td>
                                <p><b>To :</b>
                                    <br>{{ $order->customer->name }}
                                    <br>{!! orderAddress($order) !!}
                                    <br>{{ $order->customer->phone_no }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Quantity</td>
                <td>Material</td>
                <td>Size</td>
                <td>Status</td>
                <td>Price</td>
                <td>Deposit Amount</td>
                <td>Balance Payment</td>
            </tr>

            <tr class="item">
                <td>{{ $order->quantity }} </td>
                <td> {{ $order->material }}</td>
                <td> {{ $order->size }}</td>
                <td> {{humaniseOrderState($order->state) }}</td>
                <td> {{money($order->price) }}</td>
                <td> {{money($order->deposit_amount) }}</td>
                <td>{{\Cknow\Money\Money::MYR($order->price)->subtract(\Cknow\Money\Money::MYR($order->deposit_amount))}}</td>

            </tr>

            <table style="padding-top: 50px">
                <tr>
                    <td><b>Payment Method</b></td>
                </tr>
                <tr>
                    <td>
                        <p><b> Deposit Detail :</b><br>
                            @if($order->deposit_paid_at != null)
                                Paid at  {{ $order->deposit_paid_at ? myLongDateTime(new Carbon\Carbon($order->deposit_paid_at)) : null}}<br>
                                via {{ $order->deposit_payment_method}}
                            @else
                                Not yet paid.
                            @endif
                        </p>
                    </td>
                    <td>
                        <p><b>Payment Detail :</b><br>
                            @if($order->paid_at != null)
                                Paid at  {{ $order->paid_at ? myLongDateTime(new Carbon\Carbon($order->paid_at)) : null}}<br>
                                via {{ $order->payment_method}}
                            @else
                                Not yet paid.
                            @endif
                        </p>
                    </td>
                </tr>
            </table>
        </table>

        <div class="ml-4 mr-5 mt-3">
            <p>
                <strong><u>Terma &amp; Syarat:</u></strong>
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
            <strong><u>Terms &amp; Conditions:</u></strong>
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
