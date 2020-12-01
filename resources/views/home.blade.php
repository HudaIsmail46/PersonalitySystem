@extends('layouts.app')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Home</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    @if(!Auth::user()->hasRole(['Runner', 'Vendor']))
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Incomplete Bookings</h5>
                                <canvas id="incompleteBooking" config="{{$incompleteBookingChart}}"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-8'>
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title">Monthly Bookings</h5>

                                <canvas id="monthlyBooking" config="{{$monthlyBookingChart}}"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>

            </div><!-- /.container-fluid -->
        </div>
    @endif
@endsection