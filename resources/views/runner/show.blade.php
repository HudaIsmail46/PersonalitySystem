@extends ('layouts.app')

@section('title', 'Page Title')

<title>Runner Schedule Data</title>

@section ('content')

<div class="content">
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header">
                Runner Schedule
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class='w-100'>
                        <tr>
                            <td>Id</td>
                            <td>{{ $runner_schedule->id }}</td>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Runner Id</td>
                            <td>{{ $runner_schedule->runner->name }}</td>
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
                            <td>Expected At</td>
                            <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->expected_at)) }}</td>
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
                Runner Job
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
                        @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
