@extends ('layouts.app')

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
                <a href={{route('booking.import.new')}}>
                    <button class="btn-primary btn btn-block col-15 ml-auto">Import</button>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            Booking Details
                            <form action="{{ route('booking.index')}}" method="get">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name">
                                        </div>
                                        <div class="col-md-2">
                                            Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone no">
                                        </div>
                                        <div class="col-md-2">
                                            From: <input class="form-control form-control-sm" type="date" name="from">
                                        </div>
                                        <div class="col-md-2">
                                            To: <input class="form-control form-control-sm" type="date" name="to">
                                        </div>
                                        <div class="col-md-2">
                                            Team:
                                            <select id="team" class="form-control form-control-sm" name="team">
                                                <option value="">--Select Team--</option>
                                                <option value="CS1">CS1</option>
                                                <option value="CS2">CS2</option>
                                                <option value="CS3">CS3</option>
                                                <option value="CS4">CS4</option>
                                                <option value="CS5">CS5</option>
                                                <option value="CS6">CS6</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            Address: <input class="form-control form-control-sm" type="search" name="address" placeholder="address">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Id</th>
                                                <th>Event Title</th>
                                                <th>Address</th>
                                                <th width='30%'>Event DateTime</th>
                                                <th>Team</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                @foreach($bookings as $booking)
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
                                                    <form action="{{ route('booking.destroy', $booking->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-xs btn-danger d-flex"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="mt-1 ml-2 fa fa-trash"></i></button>

                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </table>
                                        {{ $bookings ?? ''->links() }}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
