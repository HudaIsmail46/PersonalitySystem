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

                    <form method="POST" action="{{  route('student.store_details', $id) }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ old('matric_no') }}" required autocomplete="matric_no" autofocus placeholder="Matric Number">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                            @error('matric_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <select id="faculty" name="faculty"
                            class="custom-select @error('faculty') is-invalid @enderror">
                            <option value="">--SELECT FACULTY--</option>
                            @foreach (App\Student::FACULTIES as $faculty)
                                <option value="{{ $faculty }}"
                                    {{ old('faculty') == $faculty ? 'selected' : '' }}>{{ $faculty }}
                                </option>
                            @endforeach
                        </select>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                            @error('faculty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus placeholder="Department">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                            @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control"  class="form-control @error('programme') is-invalid @enderror" name="programme" value="{{ old('programme') }}" required autocomplete="programme" autofocus placeholder="Programme">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                            @error('programme')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col form-group form-check-inline mt-2">
                            <input type="radio" class="form-check-input" name="year_in_progress" id="year_1" value="1">
                            <label for="year_1">Year 1</label>
                            <input type="radio" class="form-check-input ml-4" name="year_in_progress" id="year_2" value="2">
                            <label for="year_2">Year 2</label>
                            <input type="radio" class="form-check-input ml-4" name="year_in_progress" id="year_3" value="3">
                            <label for="year_3">Year 3</label>
                            <input type="radio" class="form-check-input ml-4" name="year_in_progress" id="year_4" value="4">
                            <label for="year_4">Year 4</label>
                        </div> 
                            <div class="row justify-content-center">

                             <input type="radio" class="form-check-input mr-5" name="year_in_progress" id="year_5" value="5">
                                <label for="year_5">Year 5</label>
                            </div>

                        <!-- /.col -->
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary">Register</button>
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
