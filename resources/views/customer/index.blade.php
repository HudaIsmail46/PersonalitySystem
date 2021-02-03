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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Customers Details</h3>

                            <form action="{{ route('customer.file-export', [$customers->withQueryString()])}}" method="get">
                                @csrf
                            <button class="btn btn-success btn-md ml-2 float-right" type="submit" name ="submit" value ="Download">
                              Download File  <i class="fa fa-download"></i></button>
                            </form>

                        </div>
                        <div class='card-body'>
                            <form action="{{route('customer.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name" value="{{request()->name}}">
                                    </div>
                                    <div class="col-md-2">
                                        Address: <input class="form-control form-control-sm" type="search" name="address" placeholder="address" value="{{request()->address}}">
                                    </div>
                                    <div class="col-md-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone number" value="{{request()->phone_no}}">
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
                                        <td> {!! customerAddress($customer) !!}</td>
                                        <td>
                                            @if ($customer->phone_no != null)
                                                {{ $customer->phone_no }}
                                                <a href="https://api.whatsapp.com/send?phone= {{ $customer->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                                <a href="tel:{{$customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                            @endif
                                        </td>
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
                                {{ $customers->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
