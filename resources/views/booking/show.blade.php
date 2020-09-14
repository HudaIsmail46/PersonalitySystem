@extends ('layouts.app')

@section('title', 'Page Title')

<title>Booking Data</title>

@section ('content')

    <div id="wrapper">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Booking Data
                </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Event Title</th>
                                <th>Address</th>
                                <th>Event Begins</th>
                                <th>Event Ends</th>
                                <th>Description</th>
                                <th>Team</th>
                                </tr>
                            <tr>
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->event_title}}</td>
                                <td>{{ $booking->address }}</td>
                                <td>{{ $booking->event_begins }}</td>
                                <td>{{ $booking->event_ends }}</td>
                                <td>{{ $booking->description }}</td>
                                <td>{{ $booking->team }}</td>
                            </tr>
                            <tfoot>
                                    <td valign="bottom">
                                    <a href="{{ route('booking.edit',$booking->id)}}" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        <form action="{{ route('booking.destroy', $booking->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                            </tfoot>
                        </table>
                    </div>      
                </div>               
            </div>
        </div>
    </div>

        @endsection
