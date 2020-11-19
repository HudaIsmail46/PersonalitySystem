@extends ('layouts.app')


@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                           Order Details
                        </div>
                        <div class='card-body'>
                            <form action="{{ route('order.index')}}" method="get">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name" value="{{request()->name}}">
                                        </div>
                                        <div class="col-md-2">
                                            Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone no" value="{{request()->phone_no}}">
                                        </div>
                                        <div class="col-md-2">
                                            Prefered Date Time: <input class="form-control form-control-sm" type="date" name="date" value="{{request()->date}}">
                                        </div>
                                        <div class="col-md-2">
                                            Status:
                                            <select id="state" class="form-control form-control-sm" name="state">
                                                <option></option>
                                                @foreach(App\Order::getStatesFor('state') as $state)
                                                    <option value="{{$state}}" {{(request()->state == $state) ? 'selected' : '' }} class='text-capitalize'>{{humaniseOrderState($state)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-primary mt-auto" type="submit">Search <i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <div id="OrderTable" data-proporders="{{ json_encode($orders) }}"></div>
                                {{ $orders ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
