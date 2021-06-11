@extends('layouts.welcome')

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class='my-5'>
                <img class='img-fluid mx-auto d-block w-25' src={{ asset('img/img-logo-UM.png') }}>
                <a class="text-center nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="text-center nav-link" href="{{ route('register') }}">{{ __('Register as New Staff') }}</a>
                <a class="text-center nav-link" href="/students_register">{{ __('Register as New Student') }}</a>
            </div>
        </div>
    </body>
    
@endsection
