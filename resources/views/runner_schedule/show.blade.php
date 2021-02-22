@extends ('layouts.app')

@section('title', 'Page Title')

<title>Runner Schedule Data</title>

@section ('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-6 mt-4 card">
                    <div class="card-header">
                        <h3 class="mb-0">Runner Schedule Data</h3>
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
                                            <a href="https://api.whatsapp.com/send?phone= {{$runner_schedule->runner->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green" ></i></a>
                                            <a href="tel:{{$runner_schedule->runner->phone_no}}"><i class="fas fa-phone"></i></a>
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
                                <tfoot>
                                    @can('create runnerSchedules')
                                        <td valign="bottom">
                                            <a href="{{ route('runner_schedule.edit',$runner_schedule->id)}}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('runner_schedule.destroy', $runner_schedule->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    @endcan
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mx-1 mt-4">
                    @include('comment.index', ['model' => $runner_schedule, 'appName' => App\RunnerSchedule::class])
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Runner Job</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Runner Job Id</th>
                                    <th>Scheduled At</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Notis Ambilan</th>
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
                                            @if ($runnerJob->order->customer->phone_no !=null)
                                                Phone No : {{ $runnerJob->order->customer->phone_no }}
                                                <a href="https://api.whatsapp.com/send?phone= {{$runnerJob->order->customer->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green"  ></i></a>
                                                <a href="tel:{{$runnerJob->order->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                            @endif
                                            @if($runnerJob->comments)
                                                @foreach($runnerJob->comments as $commentCustomer )
                                                    @if($loop->last)
                                                        <i class="far fa-comment-alt icon-green" data-container="body" data-toggle="popover" data-placement="left" data-content="{{$commentCustomer->comment}}" ></i>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $runnerJob->state }}</td>
                                        <td>{{ $runnerJob->order->notice_ambilan_ref }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href={{route('runner_job.show', $runnerJob->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
