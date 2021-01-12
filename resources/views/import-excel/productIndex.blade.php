@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Import Product to database</title>

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Import Booking Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Booking Products</li>
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
                            <h3 class="mb-0">Booking Product</h3>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{ route('booking_product.import') }}" method="POST" name="importform"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="import_file" class="form-control">
                                <br>
                                <button class="btn btn-success">Import Product File</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Booking Product Data
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Category</th>
                                        <th>Description </th>
                                        <th>Purchase Cost </th>
                                        <th>Sell Price </th>
                                        <th>Job Duration Estimation</th>
                                    </tr>
                                    @foreach ($bookingProducts as $bookingProduct)
                                        <tr>
                                            <td>{{ $bookingProduct->id }}</td>
                                            <td>{{ $bookingProduct->product_id }}</td>
                                            <td>{{ $bookingProduct->product_name }}</td>
                                            <td>{{ $bookingProduct->product_code }}</td>
                                            <td>{{ $bookingProduct->category }}</td>
                                            <td>{{ $bookingProduct->description }}</td>
                                            <td>{{ money($bookingProduct->purchase_cost) }}</td>
                                            <td>{{ money($bookingProduct->sell_price) }}</td>
                                            <td>{{ $bookingProduct->job_duration_estimation }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                    {{ $bookingProducts->links() }}
                                    <div class="text-muted ">Showing {{ $bookingProducts->firstItem() }} -
                                        {{ $bookingProducts->lastItem() }} of {{ $bookingProducts->total() }}
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Booking Product Category
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Weightage </th>
                                    </tr>
                                    @foreach ($bookingProductCategories as $bookingProductCategory)
                                        <tr>
                                            <td>{{ $bookingProductCategory->id }}</td>
                                            <td>{{ $bookingProductCategory->name }}</td>
                                            <td>{{ $bookingProductCategory->weightage }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
