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
                    <div class="card">
                        <div class="card-header">
                           <h3 class="mb-0">Order Details</h3>

                           <form action="{{ route('order.file-export', [$orders->withQueryString()])}}" method="get">
                                @csrf
                                <button class="btn btn-success btn-md ml-2 float-right" type="submit" name ="submit" value ="Download">
                                    Download File  <i class="fa fa-download"></i></button>
                            </form>

                        </div>
                        <div class='card-body'>
                            <form action="{{ route('order.index')}}" method="get">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            Id: <input class="form-control form-control-sm" type="search" name="id" placeholder="id" value="{{request()->id}}">
                                        </div>
                                        <div class="col-sm-1">
                                            Name: <input class="form-control form-control-sm" type="search" name="name" placeholder="name" value="{{request()->name}}">
                                        </div>
                                        <div class="col-sm-2">
                                            Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone number" value="{{request()->phone_no}}">
                                        </div>
                                        <div class="col-sm-2">
                                            From: <input class="form-control form-control-sm" type="date" name="from" value="{{request()->from}}">
                                        </div>
                                        <div class="col-sm-2">
                                            To: <input class="form-control form-control-sm" type="date" name="to" value="{{request()->to}}">
                                        </div>
                                        <div class="col-sm-1">
                                            Status:
                                            <select id="state" class="form-control form-control-sm" name="state">
                                                <option></option>
                                                @foreach(App\Order::getStatesFor('state') as $state)
                                                    <option value="{{$state}}" {{(request()->state == $state) ? 'selected' : '' }} class='text-capitalize'>{{humaniseOrderState($state)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            Notis Ambilan: <input class="form-control form-control-sm" type="search" name="notice_ambilan_ref" placeholder="notis ambilan" value="{{request()->notice_ambilan_ref}}">
                                        </div>
                                        <button class="btn btn-primary mt-auto" type="submit">Search <i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="row ml-0">
                                {{ $orders->withQueryString()->links() }} <div class="ml-4 mt-2"> Records {{ $orders->firstItem() }} - {{ $orders->lastItem() }} of {{ $orders->total() }}</div>
                            </div>
                            <div class="table-responsive">
                            <div id="OrderTable" data-proporders="{{ json_encode($orders) }}" data-canreopenorder="{{ json_encode($canReopenOrder) }}" data-customerservice="{{ json_encode($customerService)}}" data-cancreateorder="{{ json_encode($canCreateOrder)}}"></div>
                                {{ $orders->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
