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
                @foreach ($runnerJobs as $runnerJob )
                    <tr>
                        <td><a href={{route('external.runner_job.show', $runnerJob->id)}}>{{ $runnerJob->id }}</td>
                        <td>{{ myLongDateTime(new Carbon\Carbon($runnerJob->scheduled_at)) }}</td>
                        <td>{{ $runnerJob->job_type }}</td>
                        <td>{!! orderAddress($runnerJob->order) !!}</td>
                        <td> Name : {{ $runnerJob->order->customer->name }}
                            <br />
                            @if ($runnerJob->order->customer->phone_no !=null)
                                Phone No : {{ $runnerJob->order->customer->phone_no }}
                                <a href="https://api.whatsapp.com/send?phone= {{$runnerJob->order->customer->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                            @endif
                        </td>
                        <td>{{ $runnerJob->state }}</td>
                        <td>
                            <a href={{route('external.runner_job.show', $runnerJob->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
                        </td>
                @endforeach

                </tr>
            </table>
        </div>
    </div>
</div>
