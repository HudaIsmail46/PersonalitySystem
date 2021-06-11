<table class="table table-bordered mt-2 w-100">
    <thead class="thead-light">
    <tr>
        <th rowspan="2">#</th>
        <th rowspan="2">Name</th>
        <th rowspan="2">Matric No</th>
        <th rowspan="2">Faculty</th>
        <th rowspan="2">Department</th>
        <th rowspan="2">Year In Progress</th>
        <th rowspan="2">Programme</th>
        <th colspan="8">Dimension Scores</th>
    <tr>
        <th>Integrity</th>
        <th>Emotional Intelligence </th>
        <th>Adaptability</th>
        <th>Mindfulness </th>
        <th>Resilience </th>
        <th>Communication </th>
        <th>Teamwork </th>
        <th>Creativity </th>
    </tr>
    </tr>
    </thead>

    <tr>
        <td><a href="/test/result"> 1 </a></td>
        <td class="text-left"> Nurul Huda binti Ismail </td>
        <td> 17146952/1 </td>
        <td> FSKTM </td>
        <td> Information System </td>
        <td> 3rd Year </td>
        <td> BCS </td>
        <td> 5 </td>
        <td> 7 </td>
        <td> 3 </td>
        <td> 2 </td>
        <td> 8 </td>
        <td> 4 </td>
        <td> 5 </td>
        <td> 9 </td>
    </tr>

    <tr>
        <td> 2</td>
        <td class="text-left"> Student 2 </td>
        <td> 17139246/1 </td>
        <td> FSKTM </td>
        <td> Networking </td>
        <td> 3rd Year </td>
        <td> BCS </td>
        <td> 3 </td>
        <td> 6 </td>
        <td> 3 </td>
        <td> 4 </td>
        <td> 4 </td>
        <td> 7 </td>
        <td> 5 </td>
        <td> 8 </td>
    </tr>
    {{-- @foreach ($bookings as $booking) --}}
    {{-- <tr>
            <td><a href="{{ $booking->path() }}">{{ $booking->id }}
                @if ($booking->service_type == 'HQ')
                    <span class="badge badge-primary float-right">HQ</span>
                @elseif($booking->service_type == "CORP" ||$booking->service_type == "COM" )
                    <span class="badge badge-warning float-right">commercial</span>
                @elseif($booking->service_type == "RES")
                    <span class="badge badge-success float-right">residential</span>
                @endif

                @if ($booking->covernote_id)
                    <span class="badge badge-success float-right">Insured</span>
                @endif
            </td>
            <td>
                @if ($booking->customer)
                    <a href="{{ route('customer.show', $booking->customer) }}">{{ $booking->customer->name }}</a>
                    <br>
                    @if ($booking->customer->phone_no != null)
                        {{ $booking->customer->phone_no }}
                        <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no }}"
                            target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                        <a href="tel:{{ $booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                    @endif
                @else
                    Name : -
                    <br>
                    Phone No. : -
                @endif
                @if ($booking->comments)
                    @foreach ($booking->comments as $commentBooking)
                        @if ($loop->last)
                            <i class="far fa-comment-alt icon-green" data-container="body" data-toggle="popover" data-placement="left" data-content="{{$commentBooking->comment}}" ></i>
                        @endif
                    @endforeach
                @endif
            </td>
            <td>{!! bookingAddress($booking) !!}</td>
            <td>
                Start: {{ myLongDateTime(new Carbon\Carbon($booking->event_begins)) }}<br>
                End: {{ myLongDateTime(new Carbon\Carbon($booking->event_ends)) }}
            </td>
            <td>
                @foreach ($booking->agentAsignments as $assignment)
                    <li>
                        {{ $assignment->agent->fullname }}
                        @if ($assignment->status == 'Pending')
                            <span class="badge bg-info text-dark">Pending</span>
                        @elseif ($assignment->status == 'Accepted')
                            <span class="badge bg-success">Accepted</span>
                        @elseif ($assignment->status == 'Declined')
                            <span class="badge bg-danger">Declined</span>
                        @elseif ($assignment->status == 'Cancelled')
                            <span class="badge bg-warning">Cancelled</span>
                        @endif
                    </li>
                @endforeach
            </td>
            <td>
                <div class="d-flex">
                    <div>
                        <a href="{{ $booking->path() }}" class='btn btn-primary mr-2'>View</a>
                    </div>
                </div>
            </td>
        </tr> --}}
    {{-- @endforeach --}}

</table>
