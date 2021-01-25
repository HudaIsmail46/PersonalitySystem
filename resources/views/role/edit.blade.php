@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Update Role</title>

@section ('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Role</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="/role/{{$role->id}}">role</a></li>
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
                    <h3 class="mb-0">Update Role</h3>
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('role.update', $role->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="field" id="form">
                                <div class="field">
                                    <div class="field">
                                        <label class="label" for="name">Name </label>
                                        <div class="form-group row mx-0">
                                            <div class="col-xs-4">
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    type="text" name="name" id="name"
                                                    value="{{old('name')?? $role->name ?? ''}}" placeholder="Name">
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="col-md-4">
                                            <label for="permission">Permission:</label>
                                            <input type="hidden" name="permission" value="permissionSelected" />
                                            @foreach($permissions as $permission)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name='permission[]' value="{{$permission->id}}"{{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                    {{ $permission->name }}</label>
                                            </div>
                                            @endforeach
                                        </div>
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
