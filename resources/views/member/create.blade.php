@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Member</title>

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">Create Member</h3>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="inner">
                        <div class="card-body">
                            <form method="post" action="{{ route('member.store') }}">
                                @csrf
                                <div class="field" id="form">
                                    <div class="field">
                                        <label class="label" for="name">Name <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                    name="name" id="name" value="{{ old('name') ?? '' }}"
                                                    placeholder="Name">
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="phone_no">Phone No <span
                                                class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4"> <input
                                                    class="form-control @error('phone_no') is-invalid @enderror" type="text"
                                                    name="phone_no" id="phone_no"
                                                    value="{{ old('phone_no') ??  '' }}"
                                                    placeholder="Phone Number">
                                                <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="employment_status">Status <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="employment_status" name="employment_status" class="form-control">
                                                    <option value="">--SELECT STATUS--</option>
                                                    @foreach (App\Member::STATUSES as $employment_status)
                                                        <option value="{{ $employment_status }}"
                                                            {{ old('employment_status') == $employment_status ? 'selected' : '' }}>{{ $employment_status }}
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
