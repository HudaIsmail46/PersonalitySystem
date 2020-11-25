@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Runner Schedule</title>

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Runner Schedule</h3>
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{ route('runner_schedule.store') }}">
                            @csrf
                            <div class="field" id="form">
                                <div class="field">
                                    <label class="label" for="runner_id"> Runner </label>
                                    <div class="form-group">
                                        <select id="runner_id" name="runner_id">
                                            <option value="">--SELECT RUNNER--</option>
                                            @foreach($runners as $runner)
                                                <option value="{{$runner->id}}" {{old('runner_id') == $runner->id ? 'selected' : ''}}>{{$runner->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="field" >
                                    <label class="label" for="scheduled_at">Schedule at</label>
                                    <div class="form-group">
                                        <input
                                            class="input @error('scheduled_at') is-danger @enderror"
                                            type="datetime-local"
                                            name="scheduled_at"
                                            id="scheduled_at"
                                            value="{{ old('runner_schedule') ? date('Y-m-d\TH:i',strtotime($runner_schedule->scheduled_at)) : Carbon\Carbon::now()->toDateTimeLocalString() }}"
                                            placeholder=" scheduled_at">
                                        <p class="help is-danger">{{ $errors->first('scheduled_at')}}</p>
                                    </div>
                                </div>

                                <div class="field" >
                                    <label class="label" for="status">Status </label>
                                    <div class="form-group">
                                        <select id="status" name="status">
                                            <option value="">--SELECT STATUS--</option>
                                            @foreach(App\RunnerSchedule::STATUS as $status)
                                                <option value="{{$status}}" {{old('status') == $status ? 'selected' : ''}}>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="field is grouped">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
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
