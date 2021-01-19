@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Vehicle</title>

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card mt-4">
                    <div class="card-header">
                        <h3 class="mb-0">Create Vehicle</h3>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="inner">
                        <div class="card-body">
                            <form method="post" action="{{ route('vehicle.store') }}">
                                @csrf
                                <div class="field" id="form">
                                    <div class="field">
                                        <label class="label" for="plat_no">Plat Number <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <input class="form-control @error('plat_no') is-invalid @enderror" type="text"
                                                    name="plat_no" id="plat_no" value="{{ old('plat_no') ?? '' }}"
                                                    placeholder="Plat Number">
                                                <div class="invalid-feedback">{{ $errors->first('plat_no') }}</div>
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