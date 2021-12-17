@extends('layouts.app')

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Psychometric Test</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Psychometric Test</a></li>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <h3 class="mb-0">Result Detail</h3>

                                        <form class='mb-0 ml-auto' action="#" method="get">
                                            @csrf
                                            <button class="btn btn-md ml-2 float-right" type="submit" name="submit"
                                                value="setting"> <i class="fas fa-download"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p><b>Matric Number: {{$student->matric_no ?? ''}}</b></p>
                                    <p><b>Faculty: {{$student->faculty}}</b></p>
                                    <p><b>Department: {{$student->department}}</b></p>

                                    <table class="table table-bordered table-striped mt-2">
                                        <tr>
                                            <th>Dimensions</th>
                                            <th>Your Score</th>
                                            <th>Feedback</th>
                                        </tr>
                                        <tr>
                                            <td>Integrity</td>
                                            <td>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-success cc_cursor" role="progressbar"
                                                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="70"
                                                        style="width: 10%">1
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">Your score is in the bottom 10 percent of the students
                                                population; 90% of the students have higher scores. It seems that you
                                                should
                                                make improving integrity a priority.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Creativity</td>
                                            <td>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-success cc_cursor" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="70"
                                                        style="width: 40%">4
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">Your score, while not too high, is in the upper half
                                                of
                                                the student population. You may work on creativity after paying
                                                attention to
                                                lower rated readiness dimesion where applicable.
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
