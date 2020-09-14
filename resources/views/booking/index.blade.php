@extends ('layouts.app')

@section('title', 'Page Title')

<title>Booking Details</title>

@section ('content')

    <div id="wrapper">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Booking Details 
                </div>
                    <div class="table-responsive"  style="height:800px;overflow-y:scroll">
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
                                @foreach($booking as $row)
                                <td><a href="{{$row->path()}}">{{ $row ->id}}</td>
                                <td>{{ $row->event_title}}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->event_begins }}</td>
                                <td>{{ $row->event_ends }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->team }}</td>
                                <td>
                                    <form action="{{ route('booking.destroy', $row->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        {{ $booking ?? ''->links() }}
                    </div>
            </div>
        </div>
    </div>

@endsection
