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
                        </div>
                        <div class='card-body'>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Id</th>
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
                                            <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-xs btn-danger d-flex"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="mt-1 ml-2 fa fa-trash"></i></button>

                                            </form>
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
