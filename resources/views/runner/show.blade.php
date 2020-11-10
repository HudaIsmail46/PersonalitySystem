@extends ('layouts.app')

@section('title', 'Page Title')

<title>Runner Schedule Data</title>

@section ('content')

<div id="wrapper">
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Runner Schedule Data
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Runner id</th>
                            <th>Scheduled at</th>
                            <th>Started at</th>
                            <th>Expected at</th>
                            <th>Completed at</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{ $runner_schedule->id}}</td>
                            <td>{{ $runner_schedule->runner->name }}</td>
                            <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->scheduled_at)) }}</td>
                            <td>{{ $runner_schedule->started_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->started_at)) : null}}</td>
                            <td>{{ myLongDateTime(new Carbon\Carbon($runner_schedule->expected_at))}}</td>
                            <td>{{ $runner_schedule->completed_at ? myLongDateTime(new Carbon\Carbon($runner_schedule->completed_at)) : null}}</td>
                            <td>{{ $runner_schedule->status }}</td>
                        </tr>
                        <tfoot>
                            @can('edit Runner Schedule')
                                <td valign="bottom">
                                    <a href="{{ route('runner_schedule.edit',$runner_schedule->id)}}" class="btn btn-primary">Edit</a>
                                </td>
                            @endcan
                            @can('delete Runner Schedule')
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
                <form action="{{ route('runner.start',$runner_schedule->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-success mr-2" type="submit">Start</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection