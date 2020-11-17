@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Runner Job</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Runner Job</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/runner/{{ $runnerJob->runnerSchedule->id }}">Runner
                                Schedule</a></li>
                        <li class="breadcrumb-item active">Runner Job</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto card mt-4">
                    <div class="card-header">
                        Runner Job
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="w-100 table table-bordered table-striped">
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $runnerJob->id }}</td>
                                </tr>
                                <tr>
                                    <td>Scheduled At</td>
                                    <td>{{ myLongDateTime(new Carbon\Carbon($runnerJob->scheduled_at)) }}</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{{ $runnerJob->job_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{ $runnerJob->location ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td> Name : {{ $runnerJob->order->customer->name }}
                                        <br />
                                        Phone No : {{ $runnerJob->order->customer->phone_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Completed At</td>
                                    <td>{{ $runnerJob->completed_at ? myLongDateTime(new Carbon\Carbon($runnerJob->completed_at)) : null }}
                                    </td>
                                </tr>
                                @include('runner_job.form')
                                <tr>
                                    <tfoot>
                                        @can('create runnerSchedules')
                                            <td valign="bottom">
                                                <a href="{{ route('runnerJob.edit', $runnerJob->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('runnerJob.destroy', $image->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                        type="submit">Delete <i class="fa fa-trash"></i></button>
                                                </form>
                                             </td>
                                        @endcan
                                    </tfoot>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
