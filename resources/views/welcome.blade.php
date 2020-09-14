@extends('layouts.welcome')

@section('content')
    <div class='my-auto'>
        <img class='img-fluid mx-auto d-block w-25' src={{ asset('img/cleanherologo800.png') }}>
        <a class="text-center nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </div>
@endsection