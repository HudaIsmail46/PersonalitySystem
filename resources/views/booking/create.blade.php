@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Booking</title>
    
@section('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Create Bookings
                </div>
                
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{route('booking.store')}}">

                            <div class="field">
                            <label class="label" for="event_title">Event Title </label>
                                <div class="form-group">
                                    @csrf
                                    <input class="input @error('event_title') is-danger @enderror" type="text" name="event_title" id="event_title" value="{{old('event_title')}}"
                                    placeholder=" Event Title">
                                    <p class="help is-danger">{{ $errors->first('event_title')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="address">Address </label>
                                <div class="form-group">
                                    <input class="input @error('address') is-danger @enderror" type="text" name="address" id="address" value="{{old('address')}}"
                                    placeholder=" Booking Address">
                                    <p class="help is-danger">{{ $errors->first('address')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="event_begins">Event Begins </label>
                                <div class="form-group">
                                    <input class="input @error('date') is-danger @enderror" type="string" name="event_begins" value="{{old('event_begins')}}"
                                    placeholder=" Month D, Yr HH:MM XM">
                                    <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="event_ends" >Event Begins</label>
                                <div class="form-group">
                                    <input class="input @error('date') is-danger @enderror" type="string" name="event_ends" value="{{old('event_ends')}}"
                                    placeholder=" Month D, Yr HH:MM XM">
                                    <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="description">Description </label>
                                <div class="control">
                                    <input class="input @error('description') is-danger @enderror" type="text" name="description" id="description" value="{{old('description')}}"
                                    placeholder=" Event Description">
                                    <p class="help is-danger">{{ $errors->first('description')}}</p>
                                </div>
                            </div>

                            <div class="field">
                            <label class="label" for="team">Team</label>
                                <div class="control">
                                    <input class="input @error('team') is-danger @enderror" type="text" name="team" id="event_title" value="{{old('team')}}"
                                    placeholder=" Team Name">
                                    <p class="help is-danger">{{ $errors->first('team')}}</p>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
