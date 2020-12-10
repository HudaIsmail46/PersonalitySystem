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
                <td colspan="5">
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
                <td colspan="5">
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
            </tr>

            <tr class="item">
                <td>{{ $order->quantity }} </td>
                <td> {{ $order->material }}</td>
                <td> {{ $order->size }}</td>
                <td> {{humaniseOrderState($order->state) }}</td>
                <td> {{money($order->price) }}</td>
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
    </div>
</body>
</html>
