@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (!Auth::user()->hasRole('Student'))

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <section class="col-lg-9 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Student Performances by Faculties
                            </h3>
                            <div class="card-tools">
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <canvas id="studentPerformance" config="{{$studentPerformanceChart}}"></canvas>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
            
                    <!-- /.card -->
                </section>
        
               <div class="float-right">
                    <div class="col-lg">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>65<sup style="font-size: 20px">%</sup></h3>
                                <p>Highest Scored Dimensions Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg">

                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>1800</h3>

                                <p>Total Respondents</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-male"></i>                        
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
               
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-9 connectedSortable">

                    <!-- solid sales graph -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                Average Scores by Dimensions
                            </h3>

                            <div class="card-tools">
                                <a href="javascript:void(0);">View Report</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="dimensionScores" config="{{$dimensionScoresChart}}"  ></canvas>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-transparent">
                          
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
              
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- </div> --}}
    @else

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Your Progression</h3>

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
