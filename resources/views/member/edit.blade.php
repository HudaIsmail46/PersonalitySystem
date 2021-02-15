@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Update Member</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/member/{{ $member->id }}">Member</a></li>
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
                        <h3 class="mb-0">Update Member</h3>
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
                            <form method="POST" action="{{ route('member.update', $member->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="field" id="form">
                                    <div class="field">
                                        <label class="label" for="name">Name <span class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                    name="name" id="name"
                                                    value="{{ old('name') ?? ($member->name ?? '') }}" placeholder="Name">
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <input type="radio" name="location[]" value="0"
                                            {{ old('location', $member->location == 'HQ') ? 'checked="checked"' : null }}>
                                        <label for="hq">HQ</label>
                                        <input type="radio" name="location[]" value="1"
                                            {{ old('location', $member->location == 'JB') ? 'checked="checked"' : null }}>
                                        <label for="jb">JB</label>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="phone_no">Phone No <span
                                                class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4"> <input
                                                    class="form-control @error('phone_no') is-invalid @enderror" type="text"
                                                    name="phone_no" id="phone_no"
                                                    value="{{ old('phone_no') ?? ($member->phone_no ?? '') }}"
                                                    placeholder="Phone Number">
                                                <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="employment_status">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <select id="employment_status" name="employment_status"
                                                    class="form-control">
                                                    <option value="">--SELECT STATUS--</option>
                                                    @foreach (App\Member::STATUSES as $employment_status)
                                                        <option value="{{ $employment_status }}"
                                                            {{ $member->employment_status == $employment_status ? 'selected' : '' }}>
                                                            {{ $employment_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
