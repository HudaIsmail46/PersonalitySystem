@extends ('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                                <h3 class="mb-0">Report Detail</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                {{-- <form action="{{ route('report.index')}}" method="get">
                                @csrf --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        report: <input class="form-control form-control-sm" type="search" name="report"
                                            placeholder="report" value="{{ request()->report }}">
                                    </div>
                                    <div class="col-md-2">
                                        Category: <input class="form-control form-control-sm" type="search" name="category"
                                            placeholder="category" value="{{ request()->category }}">
                                    </div>

                                    <button class="btn btn-primary mt-3 mb-1" type="submit">Search <i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                            {{-- </form> --}}
                            <div class="row ml-0">
                                {{-- {{ $reports->withQueryString()->links() }} <div class="ml-4 mt-2"> Records {{ $reports->firstItem() }} - {{ $reports->lastItem() }} of {{ $reports->total() }}</div> --}}
                            </div>
                            <div class="table-responsive">
                                @include('report.table')
                                {{-- {{ $reports->withQueryString()->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
