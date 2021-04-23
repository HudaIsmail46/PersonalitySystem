@extends('layouts.welcome')

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class='my-auto'>
                <img class='img-fluid mx-auto d-block w-25' src={{ asset('img/um-logo.png') }}>
                <a class="text-center nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="text-center nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </div>
    </body>
    
@endsection
