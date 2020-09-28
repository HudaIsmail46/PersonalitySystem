@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Edit customer</title>
    
@section ('content')
    
    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Edit customer
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
                        <form method="POST" action="{{ route('customer.update', $customers->id)}}">
                            @csrf
                            @method('PUT')
                        @include ('customer.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
