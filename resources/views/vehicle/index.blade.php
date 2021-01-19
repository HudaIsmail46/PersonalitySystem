@extends ('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Vehicles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vehicles</li>
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
                            <h3 class="mb-0">Vehicles Details</h3>
                        </div>
                        <div class='card-body'>
                            <form action="{{ route('vehicle.index') }}" method="get">
                                @csrf

                                <div class="form-group row float-left">
                                    <label for="plat_no" class="col-md-5 col-form-label">Plat Number :</label>
                                    <div class="col-md-6">
                                        <input class="form-control form-control-md" type="search" name="plat_no"
                                            placeholder="Plat Number" value="{{ request()->plat_no }}">
                                    </div>
                                </div>

                                <button class="btn btn-primary mb-2" type="submit">Search <i
                                        class="fa fa-search"></i></button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Vehicle Id</th>
                                        <th>Plat Number</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        @foreach ($vehicles as $vehicle)
                                            <td><a href={{ route('vehicle.show', $vehicle->id) }}>{{ $vehicle->id }}</td>
                                            <td>{{ $vehicle->plat_no }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="d-flex">
                                                        <a href={{ route('vehicle.show', $vehicle->id) }}><button
                                                                class='btn btn-s btn-primary mr-2'>View
                                                            </button></a>
                                                    </div>
                                                    <a href={{ route('vehicle.edit', $vehicle->id) }}><button
                                                            class='btn btn-primary mr-2'>Edit</button></a>

                                                    <form action={{ route('vehicle.destroy', $vehicle->id) }} method="post">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection