<table class="table table-bordered table-striped mt-2">
    <tr>
        <th>Report Id</th>
        <th>Report Name</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>

    <tr>
        <td>
            1
        </td>
        <td>
            Assessment Report by Faculty
        </td>
        <td>
            {{ \Carbon\Carbon::now()->toDateTimeString() }}
        </td>
        <td>
            <div>
                <a href="" class='btn btn-primary mr-2'> <i class=" fas fa-edit"></i></a>
                <a href="" class='btn btn-danger mr-2'> <i class=" fas fa-trash"></i></a>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            2
        </td>
        <td>
            Assessment Report by Department
        </td>
        <td>
            {{ \Carbon\Carbon::now()->subDays('1')->toDateTimeString() }}
        </td>
        <td>
            <div>
                <a href="" class='btn btn-primary mr-2'> <i class=" fas fa-edit"></i></a>
                <a href="" class='btn btn-danger mr-2'> <i class=" fas fa-trash"></i></a>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            3
        </td>
        <td>
            Assessment Report by Programme
        </td>
        <td>
            {{ \Carbon\Carbon::now()->subDays('2')->toDateTimeString() }}
        </td>
        <td>
            <div>
                <a href="" class='btn btn-primary mr-2'> <i class=" fas fa-edit"></i></a>
                <a href="" class='btn btn-danger mr-2'> <i class=" fas fa-trash"></i></a>
            </div>
        </td>
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
