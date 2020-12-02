@extends('layouts.app')

@section('title', 'Page Title')

    <title>Create Customer</title>

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Customer</h3>
                </div>
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="inner">
                    <div class="card-body">
                    <form method="post" action="{{route('customer.store')}}">
                        @csrf
                        @include ('customer.form')
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
