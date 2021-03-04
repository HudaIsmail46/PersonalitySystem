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
                        <li class="breadcrumb-item"><a href="/daily_report/{{ $daily_report->id }}">Daily Report</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-6 card ">
                <div class="card-header">
                    <h3 class="mb-0">{{ myDate($daily_report->date) }}</h3>
                </div>
                <form method="POST" action="{{ route('daily_report.update', $daily_report->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <th></th>
                                <th>Clean Hero</th>
                                <th>Robin(estimates)</th>
                                <tr>
                                    <td>Team Count</td>
                                    <td> <input class="form-control text-center" name="ch_count" type="integer"
                                            value="{{ old('ch_count') ?? ($daily_report->ch_count ?? '') }}"></td>
                                    <td> <input class="form-control text-center" name="y_factor" type="integer"
                                            value="{{ old('y_factor') ?? ($daily_report->y_factor ?? '') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estimated Total CKU</td>
                                    <td>RM {{ number_format($daily_report->quotation_ch_total_cku) }}</td>
                                    <td>RM {{ number_format($daily_report->quotation_robin_total_cku) }}</td>
                                </tr>
                                <tr>
                                    <td>Estimated Total MCS</td>
                                    <td>RM {{ number_format($daily_report->quotation_ch_total_mcs) }}</td>
                                    <td>RM {{ number_format($daily_report->quotation_robin_total_mcs) }}</td>
                                </tr>
                                <tr>
                                    <td>Actual Total CKU</td>
                                    <td>RM {{ number_format($daily_report->invoice_ch_total_cku) }}</td>
                                    <td>RM {{ number_format($daily_report->invoice_robin_total_cku) }}</td>
                                </tr>
                                <tr>
                                    <td>Actual Total MCS</td>
                                    <td>RM {{ number_format($daily_report->invoice_ch_total_mcs) }}</td>
                                    <td>RM {{ number_format($daily_report->invoice_robin_total_mcs) }}</td>
                                </tr>
                                <tr>
                                    <td>Estimated Prods</td>
                                    <td>RM {{ number_format($daily_report->quotation_ch_prods) }}</td>
                                    <td>RM {{ number_format($daily_report->quotation_robin_prods) }}</td>
                                </tr>
                                <tr>
                                    <td>Actual Prods</td>
                                    <td>RM {{ number_format($daily_report->invoice_ch_prods) }}</td>
                                    <td>RM {{ number_format($daily_report->invoice_robin_prods) }}</td>
                                </tr>

                            </table>

                            <button class="btn mt-2 btn-primary" type="submit">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
            @if ($daily_report->jobs)
                @include('daily_report.daily_job_table')
            @endif
        </div>
    </div>
@endsection
