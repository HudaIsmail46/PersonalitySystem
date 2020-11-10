@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Booking</title>
    
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto card mt-4">
                <div class="card-header">
                    Create Bookings
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
                        <form method="post" action="{{route('booking.store')}}" enctype="multipart/form-data">
                           @include ('booking.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
