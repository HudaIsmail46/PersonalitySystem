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

                    <div class='mt-3 mb-5'>
                        @if($booking->customer)
                        <h2>Customer</h2>
                        Name : <a href="{{route('customer.show', $booking->customer)}}">{{ $booking->customer->name }}</a>
                        <br>
                        Phone No. : {{ $booking->customer->phone_no }}
                        @else
                        Name : -
                        <br>
                        Phone No. : -
                        @endif
                    </div>
                    <h2>Booking</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Id</td>
                                <td>{{ $booking->id}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $booking->gc_address }}</td>
                            </tr>
                            <tr>
                                <td>Event Begins</td>
                                <td>{{ $booking->gc_event_begins }}</td>
                            </tr>
                            <tr>
                                <td>Event Ends</td>
                                <td>{{ $booking->gc_event_ends }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $booking->gc_description }}</td>
                            </tr>
                            <tr>
                                <td>Team</td>
                                <td>{{ $booking->gc_team }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $booking->status }}</td>
                            </tr>
                        </table>
                        @foreach ($booking->images as $image)
                            <img src="{{ asset('/storage/' .$image->file ?? '')}}" alt="" class="img-thumbnail" >

                            @if ($image != null)
                                <form class='mb-0' action="{{ route('booking.destroyImage', $image->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete Image <i class="fa fa-trash"></i></button>
                                </form>
                            @else
                            @endif
                        @endforeach
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
