<table class="table table-bordered table-striped">
    <tr>
        <th>Booking Id</th>
        <th>Event Title</th>
        <th>Address</th>
        <th width='30%'>Event DateTime</th>
        <th>Team</th>
        <th></th>
    </tr>
    @foreach($bookings as $booking)
    <tr>
        <td><a href="{{$booking->path()}}">{{ $booking ->id}}</td>
        <td>
            {{ $booking->gc_event_title}}<br>
            @if($booking->isComplete())
                <span class="badge badge-success">Complete Data</span>
            @else
                <span class="badge badge-warning">Incomplete Data</span>
            @endif
        </td>
        <td>{{ $booking->gc_address }}</td>
        <td>
            Start: {{ myLongDateTime(new Carbon\Carbon($booking->gc_event_begins)) }}<br>
            End: {{ myLongDateTime(new Carbon\Carbon($booking->gc_event_ends)) }}
        </td>
        <td>{{ $booking->gc_team }}</td>
        <td>

            <div class="d-flex">
                <div>
                <a href="{{$booking->path()}}"class='btn btn-primary mr-2'>View</a>
                </div>
            </div>
        </td>
    </tr>
    @endforeach

</table>


