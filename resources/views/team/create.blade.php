@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Team</title>

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">Create Team</h3>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="inner">
                        <div class="card-body">
                            <form method="post" action="{{ route('team.store') }}">
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
