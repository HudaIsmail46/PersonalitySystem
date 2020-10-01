@extends ('layouts.app')

@section('title', 'Page Title')

<title>customer Data</title>

@section ('content')

    <div id="wrapper">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    customer Data
                </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone No</th>   
                                </tr>
                            <tr>
                                <td>{{ $customer->id}}</td>
                                <td>{{ $customer->name}}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone_no}}</td>

                            </tr>
                            <tfoot>
                                    <td valign="bottom">
                                    <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                            </tfoot>
                        </table>
                    </div>      
                </div>               
            </div>
        </div>
    </div>

        @endsection
