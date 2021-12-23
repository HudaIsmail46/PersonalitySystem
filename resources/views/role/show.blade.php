@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Role Data</title>

@section ('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card ">
                <div class="card-header">
                    <h3 class="mb-0">{{$role->name}}</h3>
                    <p class="mb-1">
                </div>
                <div class="card-body">
                    <h4>Permission</h4>
                    @foreach($role->permissions as $permission)
                        <li>{{$permission->name}}</li>
                    @endforeach
                    <br>
                    <div class="row">
                        <a href={{route('role.edit', $role->id)}}><button class='btn btn-primary mr-2'>Edit</button></a>
                        <form action={{ route('role.destroy', $role->id)}} method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
