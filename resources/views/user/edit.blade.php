@extends('layouts.app')

@section('title', 'Page Title')

    <title>Update User</title>
    
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Update User</h3>
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="field" id="form">
                                <div class="field">
                                    <label class="label" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                type="text" name="name" id="name"
                                                value="{{ $user->name ?? old('name') }}" placeholder="Name">
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="email">Email <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="text" name="email" id="email"
                                                value="{{ $user->email ?? old('email') }}" placeholder="Email">
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="field">
                                    <label class="label" for="phone_no">Phone No <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('phone_no') is-invalid @enderror"
                                                type="text" name="phone_no" id="phone_no"
                                                value="{{ old('phone_no') }}" placeholder="Phone Number">
                                            <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
                                        </div>
                                    </div>
                                </div> --}}
                               
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