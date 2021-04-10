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
                            <div class="row">
                            <h3 class="mb-0">Booking Detail</h3>

                                <form class='mb-0 ml-auto' action="{{ route('booking.file-export', [$bookings->withQueryString()])}}" method="get">
                                    @csrf
                                    <button class="btn btn-success btn-md ml-2 float-right" type="submit" name ="submit" value ="Download">
                                    Download File  <i class="fa fa-download"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('booking.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-1">
                                        Id: <input class="form-control form-control-sm" type="search" name="id" placeholder="id" value="{{request()->id}}">
                                    </div>
                                    <div class="col-md-2">
                                        Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name" value="{{request()->name}}">
                                    </div>
                                    <div class="col-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone number" value="{{request()->phone_no}}">
                                    </div>
                                    <div class="col-md-4">
                                        Address:
                                        <input class="form-control form-control-sm" type="search" name="address" placeholder="address" value="{{request()->address}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        From: <input class="form-control form-control-sm" type="date" name="from" value="{{request()->from}}">
                                    </div>
                                    <div class="col-md-2">
                                        To: <input class="form-control form-control-sm" type="date" name="to" value="{{request()->to}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        Agent:
                                        <select id="agent" class="form-control form-control-sm" name="agent">
                                            <option value="">--Select Agent--</option>
                                            @foreach($agents as $agent)
                                                <option value="{{$agent->id}}" {{(request()->agent == $agent->id) ? 'selected' : '' }} class='text-capitalize' >{{$agent->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        Service Type:
                                        <select id="service_type" class="form-control form-control-sm" name="service_type">
                                            <option value="">--Select Service Type--</option>
                                            @foreach(App\Booking::TYPE as $service_type)
                                                <option value="{{$service_type}}" {{(request()->service_type == $service_type) ? 'selected' : '' }}>{{$service_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 form-group form-check mt-4">
                                        <input type="checkbox" name="insured" class="form-check-input" id="insured" {{ request()->insured ? 'checked' : '' }}>
                                        <label class="form-check-label" for="insured">Insured</label>
                                    </div>

                                </div>
                                    <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                            </form>
                            <div class="row ml-0">
                                {{ $bookings->withQueryString()->links() }} <div class="ml-4 mt-2"> Records {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} of {{ $bookings->total() }}</div>
                            </div>
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
