@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Create User</title>

@section ('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create User</h3>
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

                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store')}}">
                            @csrf
                            @method('POST')
                            <div class="field" id="form">
                                <div class="field">
                                    <label class="label" for="event_title">Name </label>
                                    <div class="form-group">
                                        <input class="input @error('name') is-danger @enderror" type="text" name="name" id="name" value="{{old('name')??''}}"
                                        placeholder="Name">
                                        <p class="help is-danger">{{ $errors->first('name')}}</p>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="event_title">Email </label>
                                    <div class="form-group">
                                        <input class="input @error('email') is-danger @enderror" type="text" name="email" id="email" value="{{old('email')??''}}"
                                        placeholder=" User Email">
                                        <p class="help is-danger">{{ $errors->first('email')}}</p>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="phone_no">Phone No </label>
                                    <div class="form-group">
                                        <input class="input @error('phone_no') is-danger @enderror" type="text" name="phone_no" id="phone_no" value="{{old('phone_no')??''}}"
                                        placeholder=" User Phone No">
                                        <p class="help is-danger">{{ $errors->first('phone_no')}}</p>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="event_title">Password </label>
                                    <div class="form-group">
                                        <input class="input @error('password') is-danger @enderror" type="password" name="password" id="password"
                                        placeholder="Password">
                                        <p class="help is-danger">{{ $errors->first('password')}}</p>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label" for="event_title">Password Confirmation</label>
                                    <div class="form-group">
                                        <input class="input @error('password_confirmation') is-danger @enderror" type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Password">
                                        <p class="help is-danger">{{ $errors->first('password_confirmation')}}</p>
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
