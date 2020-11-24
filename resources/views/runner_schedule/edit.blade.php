@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Edit Runner Schedule</title>

@section ('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Edit Runner Schedule</h3>
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
                        <form method="POST" action="{{ route('runner_schedule.update', $runner_schedule->id)}}">
                            @csrf
                            @method('PUT')
                            @include ('runner_schedule.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
