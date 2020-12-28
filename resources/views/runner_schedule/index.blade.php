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
                           <h3 class="mb-0">Today's Runner Schedule</h3>
                        </div>
                        <div class='card-body'>
                            @include('runner_schedule.table', ['runner_schedules' => $runner_schedules])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                           <h3 class="mb-0">Previous Runner Schedule</h3>
                        </div>
                        <div class='card-body'>
                            @include('runner_schedule.table', ['runner_schedules' => $previous_runner_schedules])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                           <h3 class="mb-0">Future's Runner Schedule</h3>
                        </div>
                        <div class='card-body'>
                            @include('runner_schedule.table', ['runner_schedules' => $future_runner_schedules])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
