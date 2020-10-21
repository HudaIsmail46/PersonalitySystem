@extends ('layouts.app')

@section('title', 'Page Title')

<title>customer Data</title>

@section ('content')

    <div id="wrapper">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    {{$customer->name}}
                </div>
                <div class="card-body">
                    Name: {{$customer->name}}
                    <br>
                    Phone: {{$customer->phone_no}}
                    <br>
                    Address: {{$customer->address ?? '-'}}
                    <br>
                    Life Time Value: {{money($customer->bookings()->sum('price'))}}
                    <br>
                    Bookings:-
                    <div class="table-responsive">
                        @include('booking.table', ['bookings'=>$customer->bookings()->get()])
                    </div>
                    @can('edit customers')
                        <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Edit</a>
                    @endcan
                    @can('delete customers')
                        <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
