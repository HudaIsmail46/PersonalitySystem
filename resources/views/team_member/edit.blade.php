@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Update Team</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Team Member Pairings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href={{ route('team_member.index') }}>All Team Pairings</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card">
                    <div class="card-header">
                        <h3 class="mb-0">Update Team Members</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="inner">
                        <div class="card-body">

                            <form method="POST" action="{{ route('team_member.update', $teamMember->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="field" id="form">

                                    <div class="field">
                                        <label class="label" for="date">Date <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <input class="form-control @error('date') is-invalid @enderror" type="date"
                                                    name="date" id="date"
                                                    value="{{ $teamMember->date ? Carbon\Carbon::parse($teamMember->date)->format('Y-m-d') : '' }}">
                                                <div class="invalid-feedback">{{ $errors->first('date') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="team_id">Team <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="team_id" name="team_id" class="form-control">
                                                    <option value="">--SELECT TEAM--</option>
                                                    @foreach ($teams as $team)
                                                        <option value="{{ $team->id }}"
                                                            {{ $team->id == $teamMember->team->id ? 'selected' : '' }}>
                                                            {{ $team->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_1">Member 1 </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_1" name="member_1" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>
                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}" @if ($teamMember->member1 != null)
                                                            {{ $teamMember->member1->id == $member->id ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        @else
                                                            >{{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                    @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_2">Member 2</label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_2" name="member_2" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>

                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}" @if ($teamMember->member2 != null)
                                                            {{ $teamMember->member2->id == $member->id ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        @else
                                                            >{{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                    @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="member_3">Member 3 </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="member_3" name="member_3" class="form-control">
                                                    <option value="">--SELECT MEMBER--</option>
                                                    @foreach ($members->sortBy('name') as $member)
                                                        <option value="{{ $member->id }}" @if ($teamMember->member3 != null)
                                                            {{ $teamMember->member3->id == $member->id ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                        @else
                                                            >{{ $member->name }}
                                                            {{ $member->employment_status == 'part time' ? 'PT' : ($member->employment_status == 'CFS' ? 'CFS' : '') }}
                                                    @endif
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                            <form class='mb-0' action="{{ route('team_member.destroy', $teamMember->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                                    type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mx-1 ">
                    @include('comment.index', ['model' => $teamMember, 'appName' => App\TeamMember::class])
                </div>
            </div>
        </div>
    </div>

@endsection
