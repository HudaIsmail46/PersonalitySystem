<div class="field" id="form">
    <div class="field">
        <label class="label" for="event_title">Event Title </label>
        <div class="form-group">
            @csrf
            <input class="input @error('event_title') is-danger @enderror" type="text" name="event_title" id="event_title" value="{{old('event_title')?? $booking->event_title ?? ''}}"
            placeholder=" Event Title">
            <p class="help is-danger">{{ $errors->first('event_title')}}</p>
        </div>
    </div>

    <div class="field" >
        <label class="label" for="address">Address </label>
        <div class="form-group">
            <input class="input @error('address') is-danger @enderror" type="text" name="address" id="address" value="{{old('address')?? $booking->address ?? ''}}"
            placeholder=" Booking Address">
            <p class="help is-danger">{{ $errors->first('address')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="event_begins">Event Begins </label>
        <div class="form-group">
            <input class="input @error('date') is-danger @enderror" type="dateTime" name="event_begins" value="{{old('event_begins')?? $booking->event_begins ?? ''}}"
            placeholder=" Month D, Yr HH:MM XM">
            <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="event_ends" >Event Ends</label>
        <div class="form-group">
            <input class="input @error('date') is-danger @enderror" type="dateTime" name="event_ends" value="{{old('event_ends')?? $booking->event_ends ?? ''}}"
            placeholder=" Month D, Yr HH:MM XM">
            <p class="help is-danger">{{ $errors->first('event_begins')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="description">Description </label>
        <div class="control">
            <input class="input @error('description') is-danger @enderror" type="text" name="description" id="description" value="{{old('description')?? $booking->description ?? ''}}"
            placeholder=" Event Description">
            <p class="help is-danger">{{ $errors->first('description')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for="team">Team</label>
        <div class="control">
            <input class="input @error('team') is-danger @enderror" type="text" name="team" id="event_title" value="{{old('team')?? $booking->team ?? ''}}"
            placeholder=" Team Name">
            <p class="help is-danger">{{ $errors->first('team')}}</p>
        </div>
    </div>

    <div class="field">
        <label class="label" for ="image">Image</label>

        <div class="form-group">
            <input class="input @error('image') is-danger @enderror" type="file"
             name="image"
             id="image">

            @error('image')
                <p class="help is-danger">{{$errors->first('image')}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
