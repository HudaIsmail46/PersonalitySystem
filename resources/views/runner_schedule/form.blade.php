<div class="field" id="form">
    <div class="field">
        <label class="label" for="runner_id">Runner Id </label>
        <div class="form-group">
            @csrf

            <select id="runner_id" name="runner_id">
                @foreach($runners as $runner)
                    <option value="{{$runner->id}}">{{$runner->name}}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="field" >
        <label class="label" for="scheduled_at">Scheduled fo</label>
        <div class="form-group">
            <input class="input @error('scheduled_at') is-danger @enderror"
                type="datetime-local"
                name="scheduled_at"
                id="scheduled_at"
                value="{{ old('runner_schedule')?? date('Y-m-d\TH:i',strtotime($runner_schedule->scheduled_at)) }}"
                placeholder=" scheduled_at">
            <p class="help is-danger">{{ $errors->first('scheduled_at')}}</p>
        </div>
    </div>

    <div class="field" >
        <label class="label" for="expected_at">Estimated to be completed at </label>
        <div class="form-group">
            <input class="input @error('expected_at') is-danger @enderror"
                type="datetime-local"
                name="expected_at"
                id="expected_at"
                value="{{old('runner_schedule')?? date('Y-m-d\TH:i',strtotime($runner_schedule->expected_at))}}"
                placeholder=" expected_at">
            <p class="help is-danger">{{ $errors->first('expected_at')}}</p>
        </div>
    </div>

    <div id="RunnerJobEdit" data-orders="{{$orders}}" data-runnerschedule="{{$runner_schedule}}" data-runnerjobs="{{$runnerJobs}}"></div>

    <div class="field" >
        <label class="label" for="status">Status </label>
        <div class="form-group">
        <select id="status" name="status">
            <option value="draft" {{($runner_schedule->status === 'draft') ? 'Selected' : ''}}>draft</option>
            <option value="scheduled" {{($runner_schedule->status === 'schedule') ? 'Selected' : ''}}>scheduled</option>
            <option value="on_route"{{($runner_schedule->status === 'on_route') ? 'Selected' : ''}}>on route</option>
            <option value="completed" {{($runner_schedule->status === 'completed') ? 'Selected' : ''}}>completed</option>
        </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
