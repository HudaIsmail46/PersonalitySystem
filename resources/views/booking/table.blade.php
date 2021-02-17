<table class="table table-bordered table-striped">
    <tr>
        <th>Booking Id</th>
        <th>Customer</th>
        <th>Address</th>
        <th width='30%'>Event DateTime</th>
        <th>Team</th>
        <th></th>
    </tr>
    @foreach ($bookings as $booking)
        <tr>
            <td><a href="{{ $booking->path() }}">{{ $booking->id }}
                @if($booking->service_type == "HQ")
                    <span class="badge badge-primary float-right">HQ</span>    
                @elseif($booking->service_type == "CORP" ||$booking->service_type == "COM" )
                    <span class="badge badge-warning float-right">commercial</span>       
                @elseif($booking->service_type == "RES")
                    <span class="badge badge-success float-right">residential</span>   
                @endif
            </td>
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
            <td>{!! bookingAddress($booking) !!}</td>
            <td>
                Start: {{ myLongDateTime(new Carbon\Carbon($booking->event_begins)) }}<br>
                End: {{ myLongDateTime(new Carbon\Carbon($booking->event_ends)) }}
            </td>
            <td>{{ $booking->team }}</td>
            <td>
                <div class="d-flex">
                    <div>
                        <a href="{{ $booking->path() }}" class='btn btn-primary mr-2'>View</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

</table>
