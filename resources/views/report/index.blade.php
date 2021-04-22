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

                                {{-- <form class='mb-0 ml-auto' action="{{ route('report.file-export', [$reports->withQueryString()])}}" method="get"> --}}
                                {{-- @csrf --}}
                                {{-- <button class="btn btn-success btn-md ml-2 float-right" type="submit" name ="submit" value ="Download">
                                    Download File  <i class="fa fa-download"></i></button> --}}
                                {{-- </form> --}}
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
                                    {{-- <div class="col-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no" placeholder="phone number" value="{{request()->phone_no}}">
                                    </div>
                                    <div class="col-md-4">
                                        Address:
                                        <input class="form-control form-control-sm" type="search" name="address" placeholder="address" value="{{request()->address}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        From: <input class="form-control form-control-sm" type="date" name="from" value="{{request()->from}}">
                                    </div>
                                    <div class="col-md-2">
                                        To: <input class="form-control form-control-sm" type="date" name="to" value="{{request()->to}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        Agent:
                                        <select id="agent" class="form-control form-control-sm" name="agent">
                                            <option value="">--Select Agent--</option>
                                            @foreach ($agents as $agent)
                                                <option value="{{$agent->id}}" {{(request()->agent == $agent->id) ? 'selected' : '' }} class='text-capitalize' >{{$agent->fullname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        Service Type:
                                        <select id="service_type" class="form-control form-control-sm" name="service_type">
                                            <option value="">--Select Service Type--</option>
                                            @foreach (App\report::TYPE as $service_type)
                                                <option value="{{$service_type}}" {{(request()->service_type == $service_type) ? 'selected' : '' }}>{{$service_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 form-group form-check mt-4">
                                        <input type="checkbox" name="insured" class="form-check-input" id="insured" {{ request()->insured ? 'checked' : '' }}>
                                        <label class="form-check-label" for="insured">Insured</label>
                                    </div> --}}

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
