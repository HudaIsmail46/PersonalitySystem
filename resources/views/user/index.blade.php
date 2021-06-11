@extends ('layouts.app')

@section('content')
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
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <h3 class="mb-0">All Users</h3>

                                <form class='mb-0 ml-auto' action="{{ route('user.create') }}" method="get">
                                    @csrf
                                    <button class="btn btn-success btn-md ml-2 float-right" type="submit" name="submit" value="create">
                                        Register New User <i class="fas fa-plus"> </i></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Phone No</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone_no}}</td>
                                        <td>{{$user->email}}</td>
                                        <td></td>
                                        <td>
                                            <div class="row d-flex justify-content-center">
                                                <a href={{route('user.show', $user->id)}}><button class='btn btn-success mr-2'><i class="fas fa-eye"></i></button></a>
                                                <a href={{route('user.edit', $user->id)}}><button class='btn btn-primary mr-2'><i class="fas fa-edit"></i></button></a>
                                            
                                                    <form action={{ route('user.destroy', $user->id)}} method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit"><i class="fas fa-trash"></i></button>

                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                {{-- {{ $users ?? ''->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
