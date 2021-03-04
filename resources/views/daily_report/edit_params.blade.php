@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Update Daily Report</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Update Daily Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="/daily_report/index">Daily Reports</a></li>
                        <li class="breadcrumb-item active">Edit Parameters</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-6 card ">
                <div class="card-header">
                    <h3 class="mb-0">Daily Report Parameters Update</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('daily_report.update_params') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="from">From</label>
                              <input type="date" class="form-control" name='from_date' required id="from" value="{{ old('from_date') ?? '' }}">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="to">To</label>
                              <input type="date" class="form-control" name='to_date' required id="to" value="{{ old('to_date') ?? '' }}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="ch_count">CH Team Count</label>
                            <input class="form-control" name="ch_count" type="integer"
                                required value="{{ old('ch_count') ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="y_factor">Robin Team Count(estimates)</label>
                            <input class="form-control" name="y_factor" type="integer"
                                required value="{{ old('y_factor') ?? '' }}">
                        </div>


                        <button class="btn mt-2 btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
