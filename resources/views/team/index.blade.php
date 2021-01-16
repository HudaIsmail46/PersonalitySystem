@extends ('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Teams</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Teams</li>
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
                            <h3 class="mb-0">Teams Details</h3>
                        </div>
                        <div class='card-body'>
                            <form action="{{ route('team.index') }}" method="get">
                                @csrf

                                <div class="form-group row float-left">
                                    <label for="name" class="col-md-3 col-form-label">Name :</label>
                                    <div class="col-md-8">
                                        <input class="form-control form-control-md" type="search" name="name"
                                            placeholder="team name" value="{{ request()->name }}">
                                    </div>
                                </div>

                                <button class="btn btn-primary mb-2" type="submit">Search <i
                                        class="fa fa-search"></i></button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Team Id</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        @foreach ($teams as $team)
                                            <td><a href={{ route('team.show', $team->id) }}>{{ $team->id }}</td>
                                            <td>{{ $team->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        <a href={{ route('team.show', $team->id) }}><button
                                                                class='btn btn-s btn-primary mr-2'>View
                                                            </button></a>
                                                    </div>
                                                    <a href={{ route('team.edit', $team->id) }}><button
                                                            class='btn btn-primary mr-2'>Edit</button></a>

                                                    <form action={{ route('team.destroy', $team->id) }} method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('Are you sure?')"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                    </tr>
                                    @endforeach

                                </table>
                                {{ $teams->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
