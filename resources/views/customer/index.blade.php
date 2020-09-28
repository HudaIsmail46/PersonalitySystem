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
                            <div class="table-responsive"  style="height:800px;overflow-y:scroll">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone No</th>
                                    </tr>
                                    <tr>
                                        @foreach($customers as $row)
                                        <td><a href="{{$row->path()}}">{{ $row ->id}}</td>
                                        <td>{{ $row->name}}</td>
                                        <td>{{ $row->address }}</td>
                                        <td>{{ $row->phone_no }}</td>
                                        <td>
                                            <form action="{{ route('customer.destroy', $row->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>

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
@endsection
