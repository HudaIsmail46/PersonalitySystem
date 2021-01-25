@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Create Role</title>

@section ('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card mt-4">
                <div class="card-header">
                    <h3 class="mb-0">Create Role</h3>
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('role.store')}}">
                            @csrf
                            @method('POST')
                            <div class="field" id="form">
                                <div class="field">
                                    <label class="label" for="name">Name <span class="text-danger">*</span></label>
                                    <div class="form-group row mx-0">
                                        <div class="col-xs-4">
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                type="text" name="name" id="name"
                                                value="{{ old('name') }}" placeholder="Name">
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="col-md-4">
                                        <label for="permission">Permission:</label>
                                        <input type="hidden" name="permission" value="permissionSelected" />
                                        @foreach($permission as $permission)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name='permission[]' value="{{$permission->id}}">
                                                {{ $permission->name }}</label>
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
</div>
@endsection
