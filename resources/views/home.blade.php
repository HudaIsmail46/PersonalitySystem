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

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-outline card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Students Analysis by Faculty</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
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
                                <button type="button" class="btn btn-tool mt-0" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
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
            </div>
        </div>
    </div>
    </div>
@endsection
