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
                                    <label class="label" for="runner_id"> Runner <span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <select id="runner_id" name="runner_id"
                                                class="custom-select @error('runner_id') is-invalid @enderror">
                                                <option value="">--SELECT RUNNER--</option>
                                                @foreach ($runners as $runner)
                                                    <option value="{{ $runner->id }}"
                                                        {{ old('runner_id') == $runner->id ? 'selected' : '' }}>{{ $runner->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('runner_id') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="scheduled_at">Schedule at <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('scheduled_at') is-invalid @enderror"
                                                type="datetime-local" name="scheduled_at" id="scheduled_at"
                                                value="{{$runner_schedule->scheduled_at ? Carbon\Carbon::parse($runner_schedule->scheduled_at)-> format('Y-m-d\TH:i'): ''}}">
                                            <div class="invalid-feedback">{{ $errors->first('scheduled_at') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="status"> Status <span class="text-danger">*</span></label>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <select id="status" name="status"
                                                class="custom-select @error('status') is-invalid @enderror">
                                                <option value="">--SELECT STATUS--</option>
                                                @foreach (App\RunnerSchedule::STATUS as $status)
                                                    <option value="{{ $status }}"
                                                        {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                        </div>
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
