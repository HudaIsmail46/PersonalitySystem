@extends ('layouts.app')


@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Bookings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <a href={{route('booking.import.new')}}>
                <button class="btn-primary btn btn-block col-15 ml-auto">Import</button>
            </a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header">
                        Booking Details
                        <form action="{{ route('booking.index')}}" method="get">
                            @csrf

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-md-2">
                                        Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name">
                                    </div>
                                    <div class="col-md-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone no">
                                    </div>
                                    <div class="col-md-2">
                                        From: <input class="form-control form-control-sm" type="date" name="from">
                                    </div>
                                    <div class="col-md-2">
                                        To: <input class="form-control form-control-sm" type="date" name="to">
                                    </div>
                                    <div class="col-md-2">
                                        Team:
                                        <select id="team" class="form-control form-control-sm" name="team">
                                            <option value="">--Select Team--</option>
                                            <option value="CS1">CS1</option>
                                            <option value="CS2">CS2</option>
                                            <option value="CS3">CS3</option>
                                            <option value="CS4">CS4</option>
                                            <option value="CS5">CS5</option>
                                            <option value="CS6">CS6</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Address: <input class="form-control form-control-sm" type="search" name="address" placeholder="address">
                                    </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Search <i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
