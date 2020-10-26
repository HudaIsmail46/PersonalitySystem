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
                        <form method="POST" action="{{ route('user.update', $user->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="field" id="form">
                                <div class="field">
                                    <div class="col-md-4">
                                        <label class="label" for="event_title">Name </label>
                                        <div class="form-group">
                                            <input class="input @error('name') is-danger @enderror" type="text" name="name" id="name" value="{{old('name')?? $user->name ?? ''}}" placeholder=" User Name">
                                            <p class="help is-danger">{{ $errors->first('name')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="field">
                                        <label for="roles">Roles:</label>
                                        <input type="hidden" name="roles" value="rolesSelected" />
                                        @foreach($all_roles as $role)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name='roles[]' value="{{ $role }}" {{$user->hasRole($role) ? 'checked' : ''}}>
                                                {{ $role }}</label>
                                        </div>
                                        @endforeach
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