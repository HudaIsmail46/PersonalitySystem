@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('register') }}">
                        @csrf --}}

                        <div class="form-group row">
                            <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                            <div class="col-md-6">
                                <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required autocomplete="faculty" autofocus>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="programme" class="col-md-4 col-form-label text-md-right">{{ __('Programme') }}</label>

                            <div class="col-md-6">
                                <input id="programme" type="text" class="form-control @error('programme') is-invalid @enderror" name="programme" value="{{ old('programme') }}" required autocomplete="programme" autofocus>

                                @error('programme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matric_number" class="col-md-4 col-form-label text-md-right">{{ __('Matric No') }}</label>

                            <div class="col-md-6">
                                <input id="matric_number" type="text" class="form-control @error('matric_number') is-invalid @enderror" name="matric_number" value="{{ old('matric_number') }}" required autocomplete="matric_number" autofocus>

                                @error('matric_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="year_in_progress" class="col-md-4 col-form-label text-md-right">{{ __('Year In Progress') }}</label>

                            <input type="radio" name="location" id="year_1" value="year_1">
                            <label for="year_1">Year 1</label>
                            <input type="radio" name="location" id="year_2" value="year_2">
                            <label for="year_2">Year 2</label>
                            <input type="radio" name="location" id="year_3" value="year_3">
                            <label for="year_3">Year 3</label>
                            <input type="radio" name="location" id="year_4" value="year_4">
                            <label for="year_4">Year 4</label>
                            <input type="radio" name="location" id="year_5" value="year_5">
                            <label for="year_5">Year 5</label>
                        </div>
        
                        <form method="" action="/start_test">
                            @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Take test') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
