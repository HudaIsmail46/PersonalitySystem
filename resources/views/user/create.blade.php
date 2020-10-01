@extends ('layouts.app')

@section ('content')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Edit User
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

@endsection
