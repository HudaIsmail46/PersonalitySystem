@extends('layouts.welcome')

@section('content')

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
                            <h5 class="card-title">Result</h5>
                        </div>
                        <div class="card-body">
                            <p><b>Matric Number: 17135692/1</b></p>
                            <p><b>Faculty: FSKTM</b></p>

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
                                            <div class="progress-bar bg-success cc_cursor" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="70" style="width: 10%">1
                                            </div>
                                          </div>
                                    </td>
                                    <td class="text-left">Your score is in the bottom 10 percent of the students<br>
                                        population; 90% of the students have higher scores. It<br>
                                        seems that you should make improving integrity a priority.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Creativity</td>
                                    <td>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-success cc_cursor" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="70" style="width: 40%">4
                                            </div>
                                          </div>
                                    </td>
                                    <td class="text-left">Your score, while not too high, is in the upper half of the<br>
                                        student population. You may work on creativity after paying <br>
                                        attention to lower rated readiness dimesion where applicable.<br> 
                                       
       
                                    </td>
                                </tr>
                                

                            </table>

                            {{-- <form method=""  action="/test/page/2">
                                @csrf
                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <button class="btn btn-primary">
                                        {{ __('Reset') }}
                                    </button>
                                </div>
                                <div class="col-md-6 ">
                                    <button type="submit" class="btn float-right btn-primary">
                                        {{ __('Continue') }}
                                    </button>
                                </div>
                            </div>
                        </form> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
