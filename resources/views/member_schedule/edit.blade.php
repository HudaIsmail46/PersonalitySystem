@extends ('layouts.app')


@section('content')
    <div class="content-header">
        @if ($error = Session::get('error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $error }}</strong>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Members Schedule</h1>
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
            <div class="col-lg-12 card">
                <div class="card-header">
                    <h3 class="mb-0">Members Schedules ({{ $month_name->format('F') }})</h3>
                </div>
                <div class='card-body'>
                    <h5>{{ $member->name }} {{ employeeStatus($member->employment_status) }}</h5>
                    <form method="POST" action="{{ route('member_schedule.update', $member->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    @foreach ($memberSchedules as $memberSchedule)
                                        <th>{{ $memberSchedule->date->format('j') }}
                                            <input type="hidden" name="date[]" value="{{ $memberSchedule->date }}">
                                        </th>

                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($memberSchedules as $memberSchedule)
                                        <th>{{ $memberSchedule->date->format('D') }}
                                        </th>
                                    @endforeach
                                </tr>
                                @foreach ($memberSchedules as $memberSchedule)
                                    @foreach ($memberSchedule->members as $m)
                                        @if ($m['member_id'] == $member->id)
                                            <td>
                                                <input class="form-control border-0 p-0" style="width:18"
                                                    name="availability[]" type="text"
                                                    value="{{ old('availability[]') ?? ($m['availability'] ?? '') }}">
                                            </td>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                            <button class="btn btn-primary " type="submit">Update Member Schedule</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mx-2 card">
                <div class="card-header">
                    <h3 class="mb-0">Total Working Days</h3>
                </div>
                <div class='card-body'>
                    <h4>
                        {{ $totalWorkingDays }} Day(s) x RM 19.50 = RM {{ number_format($totalWorkingDays * 19.5, 2) }}
                    </h4>
                </div>
            </div>
            <div class="col-lg-5 ml-2 card">
                <div class="card-header">
                    <h3 class="mb-0">Comments</h3>
                </div>
                <div class="card-body p-1 text-capitalize">
                    <div class="item">

                        @foreach ($member->filterComment($member->comments, $month_name->format('n')) as $comment)
                            <img class="direct-chat-img mx-2" src={{ asset('img/cleanherologo100.png') }}
                                alt="User Image">
                            <p class="message">
                                <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>
                                        {{ myShortDateTime(new Carbon\Carbon($comment->created_at)) }}
                                    </small>
                                    {{ $comment->user->name }}
                                    @foreach ($comment->user->roles()->get() as $role)
                                        <small class="text-muted">( {{ $role->name }} )</small>
                                    @endforeach
                                </a>
                                @if ($comment->user_id == Auth()->user()->id)
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn float-right" onclick="return confirm('Delete this message?')"
                                            type="submit"><i class="fa fa-times"></i></button>
                                    </form>
                                @endif
                            </p>
                            <p class="ml-3"> {{ $comment->comment }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="hidden" name="commentable_id" value={{ $member->id }}>
                            <input type="hidden" name="commentable_type" value={{ App\Member::class }}>
                            <input class="form-control" name="comment" placeholder="Type message...">
                            <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
