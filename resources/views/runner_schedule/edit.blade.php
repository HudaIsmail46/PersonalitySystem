@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Edit Runner Schedule</title>

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Runner Schedule</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="/runner_schedule/{{ $runner_schedule->id }}">Runner
                            Schedule</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Runner Schedule</h3>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('runner_schedule.update', $runner_schedule->id) }}">
                            @csrf
                            @method('PUT')
                            @include ('runner_schedule.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
