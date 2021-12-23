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
                                    <h5 class="card-title">Instruction: Indicate how much the following statements
                                        describe
                                        you as a person by circling your response by using this scale
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('test.submit') }}">
                                        @csrf
                                        @foreach ($categories as $category)
                                            @include('test.questionnaire', ['category' => $category, 'questions' =>
                                            $questions])
                                        @endforeach

                                        <div class="form-group row mt-3">
                                            {{-- <div class="col-md-6">
                                                <button class="btn btn-primary">
                                                    {{ __('Reset') }}
                                                </button>
                                            </div> --}}
                                            <div class="col-md-6 ">
                                                <button type="submit" class="btn float-right btn-primary">
                                                    {{ __('Submit') }}
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
