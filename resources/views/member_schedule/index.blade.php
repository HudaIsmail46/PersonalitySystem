@extends ('layouts.app')

@section('content')
    <div class="content-header">
        @if ($error = Session::get('warning'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Jadual Operasi HQ</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Members Schedule</li>
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
                            <h3 class="mb-2">Members Schedules</h3>
                            <div class="row">

                                <div class="col-sm-2 card card-sm bg-primary bg-gradient-3 text-center">
                                    <div class="card-body">
                                        <h4 class="mt-7">
                                            <b>Total Manpower</b>
                                            <br>
                                            <small>Today</small>
                                            <br>
                                            {{ $todaySchedule->total_manpower ?? 0 }}
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-sm-2 card card-sm bg-primary bg-gradient-3 text-center ml-5">
                                    <div class="card-body">
                                        <h4 class="mt-7 ">
                                            <b>For Productivity</b>
                                            <br>
                                            <small>Today</small>
                                            <br>
                                            {{ $todaySchedule ? $todaySchedule->totalProductivity() : 0 }}
                                        </h4>
                                    </div>
                                </div>

                                <div class="ml-auto mr-3">
                                    <form method="post" action="{{ route('member_schedule.store') }}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="hidden" name="location" value="HQ">
                                            <select id="month" name="month"
                                                class="custom-select @error('month') is-invalid @enderror">
                                                <option value={{ Carbon\Carbon::now()->subMonths(1)->month }}>
                                                    {{ Carbon\Carbon::now()->subMonths(1)->format('F') }} </option>
                                                <option value={{ Carbon\Carbon::now()->month }}>
                                                    {{ Carbon\Carbon::now()->format('F') }}</option>
                                                <option value={{ Carbon\Carbon::now()->addMonths(1)->month }}>
                                                    {{ Carbon\Carbon::now()->addMonths(1)->format('F') }}
                                                </option>
                                            </select>
                                            <button class="btn btn-flat btn-primary" type="submit">Create New Member
                                                Schedule
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="tabbable">

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><span class="nav-link" data-target="#tab1" aria-current="page"
                                        role="tab"
                                        data-toggle="tab">{{ Carbon\Carbon::now()->subMonths(1)->format('F') }}</span>
                                </li>
                                <li class="nav-item"><span class="nav-link active" data-target="#tab2" aria-current="page"
                                        role="tab" data-toggle="tab">{{ Carbon\Carbon::now()->format('F') }}</span>
                                </li>
                                <li class="nav-item"><span class="nav-link " data-target="#tab3" aria-current="page"
                                        role="tab"
                                        data-toggle="tab">{{ Carbon\Carbon::now()->addMonths(1)->format('F') }}</span>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane" id="tab1">
                                    <div class='card-body'>
                                        @include('member_schedule.monthly_schedule', ['memberSchedules' =>
                                        $prevMemberSchedules])
                                    </div>
                                </div>
                                <div class="tab-pane active" id="tab2">
                                    <div class='card-body'>
                                        @include('member_schedule.monthly_schedule', ['memberSchedules' =>
                                        $currMemberSchedules])
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class='card-body'>
                                        @include('member_schedule.monthly_schedule', ['memberSchedules' =>
                                        $nextMemberSchedules])
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection