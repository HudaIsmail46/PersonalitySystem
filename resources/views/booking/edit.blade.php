@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Edit Booking</title>
    
@section ('content')
    
    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Edit Booking
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
            
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('booking.update', $bookings->id)}}">
                            @csrf
                            @method('PUT')
                        @include ('booking.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
