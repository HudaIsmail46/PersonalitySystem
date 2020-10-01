<div class="field" id="form">
    <div class="field">
        <label class="label" for="event_title">Event Title </label>
        <div class="form-group">
            @csrf
            <input class="input @error('event_title') is-danger @enderror" type="text" name="event_title" id="event_title" value="{{old('event_title')?? $bookings->event_title ?? ''}}"
            placeholder=" Event Title">
            <p class="help is-danger">{{ $errors->first('event_title')}}</p>
        </div>
    </div>

    <div class="field" >
        <label class="label" for="address">Address </label>
        <div class="form-group">
            <input class="input @error('address') is-danger @enderror" type="text" name="address" id="address" value="{{old('address')?? $bookings->address ?? ''}}"
            placeholder=" Booking Address">
            <p class="help is-danger">{{ $errors->first('address')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="event_begins">Event Begins </label>
        <div class="form-group">
            <input class="input @error('date') is-danger @enderror" type="dateTime" name="event_begins" value="{{old('event_begins')?? $bookings->event_begins ?? ''}}"
            placeholder=" Month D, Yr HH:MM XM">
            <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="event_ends" >Event Ends</label>
        <div class="form-group">
            <input class="input @error('date') is-danger @enderror" type="dateTime" name="event_ends" value="{{old('event_ends')?? $bookings->event_ends ?? ''}}"
            placeholder=" Month D, Yr HH:MM XM">
            <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="description">Description </label>
        <div class="control">
            <input class="input @error('description') is-danger @enderror" type="text" name="description" id="description" value="{{old('description')?? $bookings->description ?? ''}}"
            placeholder=" Event Description">
            <p class="help is-danger">{{ $errors->first('description')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="team">Team</label>
        <div class="control">
            <input class="input @error('team') is-danger @enderror" type="text" name="team" id="event_title" value="{{old('team')?? $bookings->team ?? ''}}"
            placeholder=" Team Name">
            <p class="help is-danger">{{ $errors->first('team')}}</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>