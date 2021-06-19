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

    @if(!Auth::user()->hasRole('Student'))

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-outline card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Students Analysis by Faculty</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <a href="">View Report</a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: none;">
                            <img src={{ asset('img\Faculty-chart.png') }} class="w-100">
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="card card-outline card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Students Analysis by Department</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <a href="">View Report</a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: none;">
                            <img src={{ asset('img\Department-chart.png') }} class="w-100">
                        </div>
                        <!-- /.card-body -->


                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Students Analysis by Year In Progress</h3>
                                <a href="">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg"></span>
                                    <span></span>
                                </p>
                                <img src={{ asset('img\Year-chart.png') }} class="w-100">

                            </div>
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Students' Answer Graph Q1</h3>
                                <a href="">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p>
                                    <span class="col-6 text-bold text-md">1) Honesty is a significant part of my identity</span>
                                    <span></span>
                                </p>
                               

                            </div> <img src={{ asset('img\Q1-chart.png') }} class="w-100">
                            <!-- /.d-flex -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Your Progression</h3>

                            {{-- <div class="card-tools">
                                <div class="row">
                                    <a href="">View Report</a>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> --}}
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <img src={{ asset('img/student-chart.jpg') }} class="w-50">
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    @endif
@endsection
