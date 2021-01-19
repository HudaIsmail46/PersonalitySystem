<div class="table-responsive">
<table class="table table-bordered table-striped">
    <tr>
        <th>Due for Expiry</th>
        <th>Voucher Expiry</th>
        <th>Latest Purchase</th>
        <th >Customer</th>
        <th>Description</th>
        <th>Discount %</th>
        <th>Lead Status</th>
        <th>Log</th>
        <th>Sales Person</th>
        <th>Follow Up Status</th>
        <th></th>
    </tr>
    @foreach ($bookings as $booking)
        <tr>
            <td>
                @if(((Carbon\Carbon::parse($booking->event_begins)->addMonths(6))->diffInDays(Carbon\Carbon::now()))>0)
                    {{$different_date=(Carbon\Carbon::parse($booking->event_begins)->addMonths(6))->diffInDays(Carbon\Carbon::now())}}
                    @else
                    <p>INVALID</p>
                @endif
            </td>

            <td>
                {{myLongDateTime(Carbon\Carbon::parse($booking->event_begins)->addMonths(6)) }}
            </td>
            <td>{{myLongDateTime(new Carbon\Carbon($booking->event_begins)) }}</td>
            <td>
                @if ($booking->customer)
                    Name : <a href="{{ route('customer.show', $booking->customer) }}">{{ $booking->customer->name }}</a>
                    <br>
                    @if ($booking->customer->phone_no != null)
                        Phone No. : {{ $booking->customer->phone_no }}
                        <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no }}"
                            target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                        <a href="tel:{{ $booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                    @endif
                @else
                    Name : -
                    <br>
                    Phone No. : -
                @endif
            </td>
            <td>{{$booking->remarks}}</td>
            <td>
                @if(Carbon\Carbon::parse($booking->event_begins) <= Carbon\Carbon::now()->subDays(2) )
                <p>20</p>
                @else
                <p>15</p>
                @endif
            </td>
            <td>
                @foreach($booking->followUp as $followUp)
                    {{$followUp->lead_status}}
            </td>
            <td></td>
            <td>{{$followUp->sales_person}}</td>
            <td>
                {{$followUp->follow_up_status}}
            </td>
            <td>
                <a href={{route('follow_up.edit', $followUp->id)}}><button class='btn btn-primary mr-2'>Edit</button></a>
                @endforeach
            </td>
        </tr>
    @endforeach

</table>
{{ $bookings ?? ('')->links() }}
</div>
