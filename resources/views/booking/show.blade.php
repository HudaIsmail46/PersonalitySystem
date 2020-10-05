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
            <br>Name : {{ $booking->name }}
            <br>Phone No. : {{ $booking->phone_no }}
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Address</th>
                        <th>Event Begins</th>
                        <th>Event Ends</th>
                        <th>Description</th>
                        <th>Team</th>
                    </tr>
                    <tr>
                        <td>{{ $booking->id}}</td>
                        <td>{{ $booking->gc_address }}</td>
                        <td>{{ $booking->gc_event_begins }}</td>
                        <td>{{ $booking->gc_event_ends }}</td>
                        <td>{{ $booking->gc_description }}</td>
                        <td>{{ $booking->gc_team }}</td>
                    </tr>
                    <tfoot>
                        <td valign="bottom">
                            <a href="{{ route('booking.edit',$booking->id)}}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('booking.destroy', $booking->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
