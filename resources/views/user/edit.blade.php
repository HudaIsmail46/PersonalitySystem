    @extends ('layouts.app')

    @section('title', 'Page Title')

        <title>Update User</title>

    @section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/user/{{$user->id}}">User</a></li>
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
                        <h3 class="mb-0">Update User</h3>
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
                                    <div class="field">
                                        <div class="col-md-4">
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
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
