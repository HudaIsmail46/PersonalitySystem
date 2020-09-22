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
                    <button class="btn-primary btn btn-block col-1 ml-auto">Import</button>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-12">
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
                                        <td>{{ $row->gc_event_title}}</td>
                                        <td>{{ $row->gc_address }}</td>
                                        <td>{{ $row->gc_event_begins }}</td>
                                        <td>{{ $row->gc_event_ends }}</td>
                                        <td>{{ $row->gc_description }}</td>
                                        <td>{{ $row->gc_team }}</td>
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
        </div>
    </div>
@endsection
