@extends ('layouts.app')

@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-4">
                        <div class="card-header">
                            {{$user->name}}
                        </div>
                        <div class="card-body">
                            <h4>Roles</h4>
                            @foreach($user->roles()->get() as $role)
                                <li>{{$role->name}}</li>
                                <ul>
                                    @foreach($role->permissions()->get() as $permission)
                                        <li>{{$permission->name}}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                            <div class="row">
                                @can('edit users')
                                    <a href={{route('user.edit', $user->id)}}><button class='btn btn-primary mr-2'>Edit</button></a>
                                @endcan
                                @can('delete users')
                                    <form action={{ route('user.destroy', $user->id)}} method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete</button>

                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


