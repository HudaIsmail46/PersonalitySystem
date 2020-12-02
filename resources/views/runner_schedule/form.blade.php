<div class="field" id="form">
    <div class="field">
        <label class="label" for="runner_id">Runner Id </label>
        <div class="form-group row">
            <div class="col-auto">
                <select id="runner_id" name="runner_id" class="custom-select">
                    <option value="">--SELECT RUNNER--</option>
                    @foreach ($runners as $runner)
                        <option value="{{ $runner->id }}"
                            {{ $runner_schedule->runner->name == $runner->name ? 'selected' : '' }}>{{ $runner->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="field">
        <label class="label" for="scheduled_at">Scheduled for</label>
        <div class="form-group row ">
            <div class="col-auto">
                <input class="form-control @error('scheduled_at') is-invalid @enderror"  type="datetime-local"
                name="scheduled_at"
                id="scheduled_at"
                value="{{ old('runner_schedule')?? date('Y-m-d\TH:i',strtotime($runner_schedule->scheduled_at)) }}"
                placeholder=" scheduled_at">>
                <div class="invalid-feedback">{{ $errors->first('scheduled_at') }}</div>
            </div>
        </div>
    </div>

    <div id="RunnerJobEdit" data-proporders="{{$orders}}" data-runnerschedule="{{$runner_schedule}}" data-runnerjobs="{{$runnerJobs}}"></div>

    <div class="field" >
        <label class="label" for="status">Status </label>
        <div class="form-group row">
            <div class="col-auto">
                <select id="status" name="status" class="custom-select">
                    <option value="">--SELECT STATUS--</option>
                    @foreach (App\RunnerSchedule::STATUS as $status)
                        <option value="{{ $status }}" {{ $runner_schedule->status == $status ? 'selected' : '' }}>
                            {{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
