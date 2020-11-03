@extends ('layouts.app')

@section('title', 'Page Title')

<title>Customer Data</title>

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
            <div class="col-md-10 mx-auto card mt-4">
                <div class="card-header">
                    <p> Customer Detail </p>
                </div>
                <div class="card-body">
                    <div class='ml-2'>
                        Name: {{$customer->name}}
                        <br>
                        Phone: {{$customer->phone_no}}
                        <br>
                        Address: {{$customer->address ?? '-'}}
                        <br>
                        Life Time Value: {{money($customer->bookings()->sum('price'))}}
                        <br>
                        Bookings:-
                    </div>
                    <div class="table-responsive">
                        @include('booking.table', ['bookings'=>$customer->bookings()->get()])
                    </div>
                    @can('edit customers')
                    <div class="row mt-5">
                        <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary mr-2">Edit</a>
                        @endcan
                        @can('delete customers')
                        <form class='mb-0' action="{{ route('customer.destroy', $customer->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')" type="submit">Delete <i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
