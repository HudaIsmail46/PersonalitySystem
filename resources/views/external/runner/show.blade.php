@extends ('layouts.app')

@section('title', 'Page Title')

<title>Runner Schedule Data</title>

@section ('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Runner Schedule</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href={{ route('external.runner.index') }}>All Runner Schedule</a></li>
                    <li class="breadcrumb-item active">Runner Schedule</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Runner Schedule</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Runner Schedule Id</td>
                            <td>{{ $runner_schedule->id }}</td>
                        </tr>
                        <tr>
                            <td>Runner</td>
                            <td>
                                {{ $runner_schedule->runner->name }}
                                <br>
                                @if ($runner_schedule->runner->phone_no !=null)
                                    {{ $runner_schedule->runner->phone_no }}
                                    <a href="https://api.whatsapp.com/send?phone= {{$runner_schedule->runner->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <td>Scheduled At</td>
                            <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->scheduled_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Started At</td>
                            <td>{{ $runner_schedule->started_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->started_at)) : null }}
                            </td>
                        </tr>
                        <tr>
                            <td>Completed At</td>
                            <td>{{ $runner_schedule->completed_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->completed_at)) : null }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $runner_schedule->status }}</td>
                        </tr>
                    </table>
                </div>
            @if ($runner_schedule->status == 'draft')
                <form action="{{ route('external.runner.start',$runner_schedule->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success mr-2" type="submit">Start</button>
                </form>
            @else
            @endif
        </div>
        </div>
        @include('external.runner_job.index')
    </div>
</div>

@endsection
