@extends ('layouts.app')


@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
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
                            Customers Details
                        <form action="{{route('customer.index')}}" method="get">
                            @csrf
                        </div>
                        <div class='card-body'>
                            <div class="row">
                                <div class="col-md-2">
                                    Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name">
                                </div>
                                <div class="col-md-2">
                                    Address: <input class="form-control form-control-sm" type="search" name="address" placeholder="address">
                                </div>
                                <div class="col-md-2">
                                    Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone no">
                                </div>
                            </div>

                            <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                        </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Customer Id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone No</th>
                                        <th>Bookings</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        @foreach($customers as $customer)

                                        <td><a href="{{$customer->path()}}">{{ $customer ->id}}</td>
                                        <td>{{ $customer->name}}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->phone_no }}</td>
                                        <td>
                                            Total Bookings = {{ $customer->bookings()->count()}}
                                            <br>
                                            Total Spend = {{money($customer->bookings()->sum('price'))}}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href={{route('customer.show', $customer->id)}}><button class='btn btn-s btn-primary mr-2'>View </button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                                {{ $customers ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
