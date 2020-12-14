<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Runner Jobs</h3>
    </div>
    <div class="card-body p-1 text-capitalize">
        <table class="table table-striped table-responsive">
            <tr>
                <th>Runner Job Id</th>
                <th>Scheduled At</th>
                <th>Job Type</th>
                <th>Runner</th>
                <th></th>
            </tr>
            @foreach ($order->runnerJobs as $runnerJob)
                <tr>
                    <td>{{$runnerJob->id}}</td>
                    <td>{{myLongDateTime(new Carbon\Carbon($runnerJob->scheduled_at))}}</td>
                    <td>{{$runnerJob->job_type}}</td>
                    <td>
                        {{$runnerJob->runnerSchedule->runner->name}}
                        <br>
                        {{$runnerJob->runnerSchedule->runner->phone_no}}
                        <a href="https://api.whatsapp.com/send?phone=  {{$runnerJob->runnerSchedule->runner->phone_no}}"><i class="fab fa-whatsapp"  style="color:rgb(79, 206, 93)"></i></a>
                    </td>
                    <td><a href="{{route('runner_job.show', $runnerJob->id)}}">View</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
