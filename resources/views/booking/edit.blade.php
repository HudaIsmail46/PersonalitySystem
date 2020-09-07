@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Edit Booking</title>
    
@section ('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Edit Booking
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
            
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('booking.update', $bookings->id)}}">
                            @csrf
                            @method('PUT')

                            <div class="field">
                                <label class="label" for="event_title">Event Title</label>

                                <div class="control">
                                    <input class="input" type="text" name="event_title" id="event_title" value="{{$bookings->event_title}}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="address">Address</label>
                                <div class="control">
                                    <input class="input" name="address" id="address" value="{{$bookings->address}}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="event_begins">Event Begins</label>
                                <div class="control">
                                    <input class="input" name="event_begins" id="event_begins" value="{{$bookings->event_begins}}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="event_ends">Event Ends</label>
                                <div class="control">
                                    <input class="input" name="event_ends" id="event_ends" value="{{$bookings->event_ends}}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="description">Description</label>
                                <div class="control">
                                    <input class="input" type="text-area" name="description" id="description" value="{{$bookings->description}}">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" for="team">Team</label>
                                <div class="control">
                                    <input class="input" name="team" id="team" value="{{$bookings->team}}">
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Save Changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
