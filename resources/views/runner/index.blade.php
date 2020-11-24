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
                        <h3 class="mb-0">Runner Schedule</h3>
                    </div>
                    <div class='card-body'>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Runner Schedule Id</th>
                                    <th>Schedule at</th>
                                    <th>Started at</th>
                                    <th>Completed at</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    @foreach($runner_schedules as $runner_schedule)

                                    <td><a href="{{route('runner.show', $runner_schedule->id)}}">{{ $runner_schedule->id}}</td>
                                    <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->scheduled_at))}}</td>
                                    <td>{{ $runner_schedule->started_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->started_at)) : null}}</td>
                                    <td>{{ $runner_schedule->completed_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->completed_at)) : null}}</td>
                                    <td>{{ $runner_schedule->status}}</td>
                                    <td>
                                    <div class="d-flex">
                                        <a href={{route('runner.show', $runner_schedule->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
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
</div>
@endsection
