@extends ('layouts.app')

@section('title', 'Page Title')

<title>Booking Data</title>

@section ('content')
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
        <div class="row">
            <div class="col-md-10 mx-auto card mt-4">
                <div class="card-header">
                    <p> Booking Detail </p>
                </div>
                <div class="card-body">

                    <div class='ml-2'>
                        @if($booking->customer)
                        Name : <a href="{{route('customer.show', $booking->customer)}}">{{ $booking->customer->name }}</a>
                        <br>
                        Phone No. : {{ $booking->customer->phone_no }}
                        @else
                        Name : -
                        <br>
                        Phone No. : -
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Address</th>
                                <th>Event Begins</th>
                                <th>Event Ends</th>
                                <th>Description</th>
                                <th>Team</th>
                                <th>Status</th>
                            </tr>
                            <tr>
                                <td>{{ $booking->id}}</td>
                                <td>{{ $booking->gc_address }}</td>
                                <td>{{ $booking->gc_event_begins }}</td>
                                <td>{{ $booking->gc_event_ends }}</td>
                                <td>{{ $booking->gc_description }}</td>
                                <td>{{ $booking->gc_team }}</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                        </table>
                    </div>
                    @can('edit bookings')
                    <div class="row mt-5">
                        <a href="{{ route('booking.edit',$booking->id)}}" class="btn btn-primary mr-2">Edit</a>
                        @endcan
                        @can('delete bookings')
                        <form class='mb-0' action="{{ route('booking.destroy', $booking->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    @endcan
                    <!-- @can('edit bookings')
                        <td valign="bottom">
                            <a href="{{ route('booking.edit',$booking->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        @endcan
                        @can('delete bookings')
                        <td>
                            <form action="{{ route('booking.destroy', $booking->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        @endcan -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
