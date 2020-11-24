@extends ('layouts.app')


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
                        <li class="breadcrumb-item active">Runner Schedule</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                           <h3 class="mb-0">Runner Schedule Details</h3>
                        </div>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Runner Id</th>
                                        <th>Runner</th>
                                        <th>Scheduled at</th>
                                        <th>Runner Jobs</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    @foreach($runner_schedules as $runner_schedule)
                                        <tr>
                                            <td><a href="{{$runner_schedule->path()}}">{{ $runner_schedule->id}}</td>
                                            <td>{{ $runner_schedule->runner->name}}</td>
                                            <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->scheduled_at))}}</td>
                                            <td>
                                                @foreach($runner_schedule->runnerJobs as $job)
                                                    <li>{{ myLongDateTime(new Carbon\Carbon($job->scheduled_at))}} at {{$job->order->city . ', ' . $job->order->location_state}}</li>
                                                @endforeach
                                            </td>
                                            <td>{{ $runner_schedule->status}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href={{route('runner_schedule.show', $runner_schedule->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $runner_schedules ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
