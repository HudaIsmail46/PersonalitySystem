@extends ('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Results</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Results</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="mb-0">Result Detail</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <h5>Search by :</h5>
                                {{-- <form action="{{ route('report.index')}}" method="get">
                                @csrf --}}
                                <div class="row">
                                    <div class="col-md-2">
                                        Faculty:
                                        <select class="form-control form-control-sm">
                                            <option>FSTKM</option>
                                            <option>FSSS</option>
                                            <option>FAPI</option>
                                            <option>FS</option>
                                            <option>FP</option>
                                        </select>
                                        {{-- <input class="form-control form-control-sm" type="search" name="faculty"
                                            placeholder="Faculty" value="{{ request()->faculty }}"> --}}
                                    </div>
                                    <div class="col-md-2">
                                        Department: <input class="form-control form-control-sm" type="search"
                                            name="department" placeholder="Department"
                                            value="{{ request()->department }}">
                                    </div>
                                    <div class="col-md-2">
                                        Year In Progress: <input class="form-control form-control-sm" type="search"
                                            name="year_in_progress" placeholder="Year In Progress"
                                            value="{{ request()->year_in_progress }}">
                                    </div>

                                    <div class="col-md-2">
                                        Dimensions:
                                        <div class="input-group">
                                            <select class="form-control form-control-sm">
                                                <option>Integrity </option>
                                                <option>Emotional Intelligence</option>
                                                <option>Adaptability</option>
                                                <option>Mindfulness</option>
                                                <option>Resilience</option>
                                                <option>Communication</option>
                                                <option>Teamwork</option>
                                                <option>Creativity</option>
                                            </select>
                                            {{-- <input class="form-control form-control-sm" type="search" name="dimension"
                                                placeholder="Dimensions" value="{{ request()->dimension }}"> --}}
                                            <div class="input-group-append">
                                                <span class="input-group-select">
                                                    <select class=" form-control form-control-sm">
                                                        <option>High</option>
                                                        <option>Low</option>
                                                    </select>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <button class="btn btn-primary mt-3 mb-1" type="submit">Search <i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                            {{-- </form> --}}
                            <div class="row ml-0">
                                {{-- {{ $Results->withQueryString()->links() }} <div class="ml-4 mt-2"> Records {{ $Results->firstItem() }} - {{ $Results->lastItem() }} of {{ $Results->total() }}</div> --}}
                            </div>
                            <div class="table-responsive">
                                @include('result.table')
                                {{-- {{ $Results->withQueryString()->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
