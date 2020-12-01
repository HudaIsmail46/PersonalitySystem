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
                    <li class="breadcrumb-item"><a href="/runner/index">All Runner Schedule</a></li>
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
                                {{ $runner_schedule->runner->phone_no }}
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
                <form action="{{ route('runner.start',$runner_schedule->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success mr-2" type="submit">Start</button>
                </form>
            @else
            @endif
        </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0"> Runner Job</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Scheduled At</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        @foreach ($runnerJobs as $runnerJob)
                            <tr>
                                <td><a href={{route('runner_job.show', $runnerJob->id)}}>{{ $runnerJob->id }}</td>
                                <td>{{ myLongDateTime(new Carbon\Carbon($runnerJob->scheduled_at)) }}</td>
                                <td>{{ $runnerJob->job_type }}</td>
                                <td>{!! orderAddress($runnerJob->order) !!}</td>
                                <td> Name : {{ $runnerJob->order->customer->name }}
                                    <br />
                                    Phone No : {{ $runnerJob->order->customer->phone_no }}
                                </td>
                                <td>{{ $runnerJob->state }}</td>
                                <td>
                                    <a href={{route('runner_job.show', $runnerJob->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
                                </td>
                        @endforeach

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
