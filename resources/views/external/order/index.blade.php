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
                            <div class="table-responsive">
                            <div id="OrderTable" data-proporders="{{ json_encode($orders)}}" data-internal="{{ json_encode('vendor')}}"></div>
                                {{ $orders ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
