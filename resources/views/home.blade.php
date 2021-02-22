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
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Progress Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Current Progress</th>
                                                    <th>{{Carbon\Carbon::now()->format('d/m/Y')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Productivity(Overall)</td>
                                                    <td>{{money(1200)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Productivity(HQ)</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Productivity(ROBIN)</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Sales</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Expected Month Sales</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
    
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Cancelled</td>
                                                    <td>{{money(123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Recuci(hours)</td>
                                                    <td>5.0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-sm12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Calculator</th>
                                                    <th>{{Carbon\Carbon::now()->format('d/m/Y')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Productivity(HQ)</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Productivity(ROBIN)</td>
                                                    <td>{{money(123123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>No Of Teams(HQ)</td>
                                                    <td>8</td>
                                                </tr>
                                                <tr>
                                                    <td>No Of Teams(JB)</td>
                                                    <td>1</td>
                                                </tr>
                                            </tbody>
                                        </table>
    
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Monthly Sales Target</td>
                                                    <td>{{money(123123)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hutang</td>
                                                    <td>{{money(12312)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Today Team Sales</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="todayTeamSales" config="{{$todayTeamSalesChart}}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-lg-12'>
                        <div class="card ">
                            <div class="card-header">
                                <h5 class="card-title">Monthly Bookings</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyBooking" config="{{$monthlyBookingChart}}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
