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
                            <div class="card text-center">
                                <div class="card-header">
                                    <h4><b>Universiti Malaya Students’ Future-Readiness Inventory (UMSFRI)</b></h4>
                                </div>
                                <div class="card-body">
                                   <h5> A UM-based inventory aims to achieve the goals of Universiti Malaya in nurturing
                                    aspiring leaders that impacts the world. This Inventory helps to identify the
                                    Employability Readiness Soft Skills and Psychological Capital Attributes of UM students.
                                    Based on the results from this inventory, students can identify their attributes or lack
                                    of it, hence allowing students to bridge the gaps through precision intervention offered
                                    by various PTjs.</h5>

                                    <form method="" action="{{ route('test.answer') }}">
                                        @csrf
                                        <div class="form-group row mt-3">

                                            <div class="col-md-6 ">
                                                <button type="submit" class="btn float-right btn-primary">
                                                    {{ __('Attempt Test') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
