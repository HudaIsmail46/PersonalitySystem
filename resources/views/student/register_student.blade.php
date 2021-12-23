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

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full name">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                      
                    <div class="input-group mb-3">
                        <input type="email" class="form-control"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Siswamail">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                        <div class="col-8">
                            <!-- <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                            </div> -->
                        </div>

                        <input name="role" type="hidden" value="student">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                  <a href="{{ route('login') }}" class="text-center">I already have an account</a>
                </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

</body>

@endsection
