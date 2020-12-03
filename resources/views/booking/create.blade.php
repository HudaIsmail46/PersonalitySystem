@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Booking</title>
    
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Bookings</h3>
                </div>
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                        <form method="post" action="{{route('booking.store')}}" enctype="multipart/form-data">
                           @csrf
                           @include ('booking.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
