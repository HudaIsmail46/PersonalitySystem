@extends('layouts.welcome')

@section('content')

    <body class="register-page cc_cursor">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="" class="h1"><b>UMSFRI</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Register as a new student</p>

                    <form action="{{ route('test.start') }}" method="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Matric Number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Faculty">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Department">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Programme">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                            <div class="col form-group form-check-inline mt-2">
                                <input type="radio" class="form-check-input" name="year" id="year_1" value="year_1">
                                <label for="year_1">Year 1</label>
                                <input type="radio" class="form-check-input ml-4" name="year" id="year_2" value="year_2">
                                <label for="year_2">Year 2</label>
                                <input type="radio" class="form-check-input ml-4" name="year" id="year_3" value="year_3">
                                <label for="year_3">Year 3</label>
                                <input type="radio" class="form-check-input ml-4" name="year" id="year_4" value="year_4">
                                <label for="year_4">Year 4</label>
                            </div> 
                            {{-- <div class="row justify-content"> --}}

                             <input type="radio" class="form-check row form-check-input" name="year" id="year_5" value="year_5">
                                <label for="year_5">Year 5</label>
                            {{-- </div> --}}

                        <!-- /.col -->
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary">Take test</button>
                        </div>
                        <!-- /.col -->
                    </form>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->

    </body>

@endsection
