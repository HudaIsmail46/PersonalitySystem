@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Vehicle Data</title>

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
                <div class="col-md-6 card">
                    <div class="card-header">
                        <h3 class="mb-0">Vehicle Detail</h3>
                    </div>
                    <div class="card-body">
                        <div class='mt-3 mb-5'>
                            Plat No: {{ ucwords($vehicle->plat_no) }}<br>
                            <br>
                        </div>

                        <div class="row mt-5">
                            <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="btn btn-primary mr-2">Edit</a>

                            <form class='mb-0' action="{{ route('vehicle.destroy', $vehicle->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                                    type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
