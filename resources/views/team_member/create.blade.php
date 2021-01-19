@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Team Member</title>

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">Create Team Member</h3>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="inner">
                        <div class="card-body">
                            <form method="post" action="{{ route('team_member.store') }}">
                                @csrf

                                <div class="field" id="form">
                                    <div class="field">
                                        <div class="row mt-2 mb-2">
                                            <div class="col-md-4">
                                                <label class="label" for="from">From<span class="text-danger">*</span></label>
                                                <input class="form-control @error('from') is-invalid @enderror" type="date"
                                                    name="from" value="{{ old('from') }}">
                                                <div class="invalid-feedback">{{ $errors->first('from') }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="label" for="from">To<span class="text-danger">*</span></label>
                                                <input class="form-control @error('to') is-invalid @enderror" type="date"
                                                    name="to" value="{{ old('to') }}">
                                                <div class="invalid-feedback">{{ $errors->first('to') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="team_id">Team <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="team_id" name="team_id" class="form-control">
                                                    <option value="">--SELECT TEAM--</option>
                                                    @foreach ($teams as $team)
                                                        <option value="{{ $team->id }}"
                                                            {{ old('team->name') == $team->name ? 'selected' : '' }}>
                                                            {{ $team->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_1">Member 1 </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_1" name="member_1" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>
                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}"
                                                            {{ old('member->name') == $member->name ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_2">Member 2 </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_2" name="member_2" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>
                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}"
                                                            {{ old('member->name') == $member->name ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_3">Member 3 </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_3" name="member_3" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>
                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}"
                                                            {{ old('member->name') == $member->name ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
