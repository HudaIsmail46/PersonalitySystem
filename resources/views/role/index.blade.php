@extends ('layouts.app')

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">All Roles</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Role Id</th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                    </tr>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <div class="row">
                                                        <a href={{route('role.edit', $role->id)}}><button class='btn btn-primary mr-2'>Edit</button></a>
                                                        <a href={{route('role.show', $role->id)}}><button class='btn btn-primary mr-2'>View</button></a>
                                                        <form action={{ route('role.destroy', $role->id)}} method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete</button>

                                                        </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $roles ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
