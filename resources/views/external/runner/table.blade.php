<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Runner Schedule Id</th>
            <th>Runner</th>
            <th>Scheduled at</th>
            <th>Runner Jobs</th>
            <th>Status</th>
            <th></th>
        </tr>
        @foreach ($runner_schedules as $runner_schedule)
            <tr>
                <td><a href="{{route('external.runner.show', $runner_schedule->id)}}">{{ $runner_schedule->id }}</td>
                <td>{{ $runner_schedule->runner->name }}</td>
                <td>{{ myDate(new Carbon\Carbon($runner_schedule->scheduled_at)) }}</td>
                <td>
                    @foreach ($runner_schedule->runnerJobs->sortBy('scheduled_at') as $job)
                        <li> 
                            {{ myTime(new Carbon\Carbon($job->scheduled_at)) }} at
                            {{ $job->order->city . ', ' . $job->order->location_state }} 
                            @include('runner_job.status', ['state' => $job->state])
                        </li>
                    @endforeach
                </td>
                <td>{{ $runner_schedule->status }}</td>
                <td>
                    <div class="d-flex">
                        <a href={{ route('external.runner.show', $runner_schedule->id) }}><button
                                class='btn btn-s btn-primary mr-2'>View </button></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
