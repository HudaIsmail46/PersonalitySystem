@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Booking Data</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Bookings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row mx-1">
                <div class="col-md-6  card">
                    <div class="card-header">
                        <h3 class="mb-0">Booking Detail</h3>
                    </div>
                    <div class="card-body">

                        <div class='mt-3 mb-5'>
                            @if ($booking->customer)
                                <h2>Customer</h2>
                                Name : <a
                                    href="{{ route('customer.show', $booking->customer) }}">{{ $booking->customer->name }}</a>
                                <br>
                                @if ($booking->customer->phone_no != null)
                                    Phone No. : {{ $booking->customer->phone_no }}
                                    <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no }}"
                                        target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                    <a href="tel:{{ $booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                @endif
                                @if ($booking->customer->phone_no_2 != null)
                                    <br>Phone No. 2 : {{ $booking->customer->phone_no_2 }}
                                    <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no_2 }}"
                                        target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                    <a href="tel:{{ $booking->customer->phone_no_2 }}"><i class="fas fa-phone"></i></a>
                                @endif
                            @else
                                Name : -
                                <br>
                                Phone No. : -
                            @endif
                        </div>
                         <h2>Booking</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{!! bookingAddress($booking) !!}</td>
                                </tr>
                                <tr>
                                    <td>Event Begins</td>
                                    <td>{{ myLongDateTime(Carbon\Carbon::parse($booking->event_begins)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Event Ends</td>
                                    <td>{{ myLongDateTime(Carbon\Carbon::parse($booking->event_ends)) }}
                                    </td>
                                </tr>
                                @if ($booking->gc_description != null)
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $booking->gc_description }}</td>
                                    </tr>
                                @endif
                                @if ($booking->remarks != null)
                                    <tr>
                                        <td>Remark</td>
                                        <td>{!! nl2br(e($booking->remarks)) !!}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Team</td>
                                    <td>{{ $booking->team }}</td>
                                </tr>
                                <tr>
                                    <td>Handled By</td>
                                    <td>{{ $booking->pic }}</td>
                                </tr>
                                <tr>
                                    <td>Estimated Price</td>
                                    <td>{{ money($booking->estimated_price) }}</td>
                                </tr>
                                @if ($booking->receipt_number != null)
                                    <tr>
                                        <td>Receipt Number</td>
                                        <td>{{ $booking->receipt_number }}</td>
                                    </tr>
                                @endif
                                @if ($booking->invoice_number != null)
                                    <tr>
                                        <td>Invoice Number</td>
                                        <td>{!! nl2br(e($booking->invoice_number)) !!}</td>
                                    </tr>
                                @endif
                                @if ($booking->price != null)
                                    <tr>
                                        <td>Actual Price</td>
                                        <td>{{ money($booking->price) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $booking->status }}</td>
                                </tr>
                                <tr>
                                    <td>Covernote Id</td>
                                    <td>{{ $booking->covernote_id }}</td>
                                </tr>
                                <tr>
                                    <td>Log</td>
                                    <td>{{ $booking->insured_at }}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        @include('images.table', ['images' => $booking->images, 'can_delete_image' =>
                                        auth()->user()->can('edit bookings')])
                                    </td>
                                </tr>
                            </table>
                        </div>

                        @if (!$booking->bookingItems->isEmpty())
                            <h3 class="mb-0">Booking Items</h3>
                            <div class='mt-3 mb-5'>
                                @foreach ($booking->bookingItems as $bookingItem)
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td>Product Name</td>
                                                <td> {{ $bookingItem->aafinance_webhook['Product']['ProductName'] ?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Product Code</td>
                                                <td>{{ $bookingItem->aafinance_webhook['Product']['ProductCode'] ?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Category </td>
                                                <td>{{ $bookingItem->aafinance_webhook['Product']['Category'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td> Remark </td>
                                                <td>{{ $bookingItem->remark ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td> Quantity</td>
                                                <td>{{ $bookingItem->quantity }}</td>

                                            </tr>
                                            <tr>
                                                <td> Price </td>
                                                <td>{{ money($bookingItem->price) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @can('edit bookings')
                            <div class="row mt-5 ml-0">
                                <a href="{{ route('booking.edit', $booking->id) }}" class="btn btn-primary mr-2">Edit</a>
                            @endcan
                            @can('delete bookings')
                                <form class='mb-0' action="{{ route('booking.destroy', $booking->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                                        type="submit">Delete <i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="col-md-5 mx-3">
                    @include('comment.index', ['model' => $booking, 'appName' => App\Booking::class])
                    @if($booking->invoice)
                        <div class=" card">
                            <div class="card-header">
                                <h3 class="mb-0"> Invoice Detail</h3>
                            </div>
                            <div class="card-body">
                                <div class='mt-3 mb-5'>
                                        Name : {{$booking->invoice->payer_name }}</a>
                                        <br>
                                            Phone No : {{ $booking->invoice->payer_phone_no }}
                                            <a href="https://api.whatsapp.com/send?phone={{ $booking->invoice->payer_phone_no }}"
                                                target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                            <a href="tel:{{ $booking->invoice->payer_phone_no }}"><i class="fas fa-phone"></i></a>
                                            @if ($booking->invoice->payer_email != null)
                                            <br>
                                                Email: {{ $booking->invoice->payer_email }}
                                            @endif
                                </div>
                                <h2>Invoice</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Id</td>
                                            <td>{{ $booking->invoice->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice Date</td>
                                            <td>{{myLongDateTime(Carbon\Carbon::parse($booking->invoice->invoice_date))}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td>{{ money($booking->invoice->total_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{ $booking->invoice->status }}</td>
                                        </tr>
                                        <tr>
                                            <td>Additions</td>
                                            <td>
                                            @foreach($booking->invoice['additions'] as $booking_invoice)

                                                @if ($booking_invoice['SalesInvoiceAddtionalCostId'] !=null)
                                                    ID:  {{ $booking_invoice['SalesInvoiceAddtionalCostId']}}
                                                @endif
                                                <br>
                                                @if ($booking_invoice['Description'] !=null)
                                                    Description: {{ $booking_invoice['Description']}}
                                                @endif
                                                <br>
                                                @if ($booking_invoice['Amount'] !=null)
                                                    Amount: {{ $booking_invoice['Amount']}}
                                                @endif
                                                <br><br>

                                            @endforeach
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                                <h2>Invoice Items</h2>
                                <div class='mt-3 mb-5'>
                                    @foreach ($booking->invoice->invoiceItems as $invoiceItem)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                    <td>Invoice ID</td>
                                                    <td> {{ $invoiceItem->id}}
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td> Product Code</td>
                                                    <td>{{ $invoiceItem->bookingProduct->product_code}}</td>
                                                </tr>
                                                <tr>
                                                    <td> Category </td>
                                                    <td>{{ $invoiceItem->bookingProduct->category}}</td>
                                                </tr>
                                                <tr>
                                                    <td> Quantity</td>
                                                    <td>{{ $invoiceItem->quantity }}</td>

                                                </tr>
                                                <tr>
                                                    <td> Price </td>
                                                    <td>{{ money($invoiceItem->price) }}</td>
                                                </tr>
                                                <tr>
                                                    <td> Description </td>
                                                    <td>{{ $invoiceItem->description }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            @if (!$invoice_payments->isEmpty())
                <div class="col-md-6 card">
                    <div class="card-header">
                        <h3 class="mb-0">Payment</h3>
                    </div>
                    <div class="card-body">
                        <div class='mt-3 mb-5'>
                            @foreach ($invoice_payments as $invoice_payment)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Invoice Id</td>
                                            <td> {{ $invoice_payment->invoice_id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Receipt Number</td>
                                            <td>{{ $invoice_payment->receipt_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount</td>
                                            <td>{{ money($invoice_payment->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Details</td>
                                            <td>
                                                @if ($invoice_payment->paid_at != null)
                                                    Paid at
                                                    {{ $invoice_payment->paid_at ? myLongDateTime(new Carbon\Carbon($invoice_payment->paid_at)) : null }}
                                                    via {{ $invoice_payment->payment_method }}
                                                @else
                                                    Not yet paid.
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created by</td>
                                            <td>{{ $invoice_payment->created_by }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
