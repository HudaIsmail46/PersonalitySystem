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

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Booking Detail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('booking.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name" value="{{request()->name}}">
                                    </div>
                                    <div class="col-md-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone number" value="{{request()->phone_no}}">
                                    </div>
                                    <div class="col-md-2">
                                        From: <input class="form-control form-control-sm" type="date" name="from" value="{{request()->from}}">
                                    </div>
                                    <div class="col-md-2">
                                        To: <input class="form-control form-control-sm" type="date" name="to" value="{{request()->to}}">
                                    </div>
                                    <div class="col-md-2">
                                        Team:
                                        <select id="team" class="form-control form-control-sm" name="team">
                                            <option value="">--Select Team--</option>
                                            @foreach($teams as $team)
                                                <option value="{{$team}}" class='text-capitalize'>{{$team}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Address: <input class="form-control form-control-sm" type="search" name="address" placeholder="address">
                                    </div>
                                </div>
                                    <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                            </form>
                            <div class="table-responsive">
                                @include('booking.table')
                                {{ $bookings->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
