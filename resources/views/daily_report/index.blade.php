@extends ('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daily Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daily Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            @include('daily_report.productivity_table')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Daily Report</h3>
                        </div>
                        <div class='card-body'>
                            <div class="row">
                                <div class="col-6">
                                    <form action="{{ route('daily_report.index') }}" method="get">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Month: <input class="form-control form-control-sm" type="month" name="month"
                                                    placeholder="name" value="{{ request()->month }}">
                                            </div>
                                            <button class="btn btn-primary mb-2 mt-3" type="submit">Filter <i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <a class="ml-auto" href="{{route('daily_report.edit_params')}}">
                                    <button class="btn btn-warning mb-2 mt-3 mr-2">Bulk Parameters Update</button>
                                </a>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="3">Date</th>
                                            <th colspan='2'>Team Count</th>
                                            <th rowspan="3">Y factor</th>
                                            <th rowspan="3">X factor</th>
                                            <th colspan='4'>Estimation</th>
                                            <th colspan='4'>Actual</th>
                                            <th colspan='6'>Productivity</th>
                                        </tr>
                                        <tr>
                                            <th rowspan='2'>CH</th>
                                            <th rowspan='2'>ROBIN</th>
                                            <th colspan="2">CH</th>
                                            <th colspan="2">ROBIN</th>
                                            <th colspan="2">CH</th>
                                            <th colspan="2">ROBIN</th>
                                            <th colspan="3">Estimation</th>
                                            <th colspan="3">Actual</th>
                                        </tr>
                                        <tr>
                                            <th>CKU</th>
                                            <th>MCS</th>
                                            <th>CKU</th>
                                            <th>MCS</th>
                                            <th>CKU</th>
                                            <th>MCS</th>
                                            <th>CKU</th>
                                            <th>MCS</th>
                                            <th>CH</th>
                                            <th>ROBIN</th>
                                            <th>Total</th>
                                            <th>CH</th>
                                            <th>ROBIN</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($daily_reports as $daily_report)
                                            <tr>
                                                <td><a
                                                        href={{ route('daily_report.show', $daily_report->id) }}>{{ myDate($daily_report->date) }}</a>
                                                </td>
                                                <td>{{ $daily_report->ch_count }}</td>
                                                <td>{{ $daily_report->robin_count }}</td>
                                                <td>{{ $daily_report->y_factor }}</td>
                                                <td>{{ $daily_report->x_factor }}</td>
                                                <td>{{ number_format($daily_report->quotation_ch_total_cku) }}</td>
                                                <td>{{ number_format($daily_report->quotation_ch_total_mcs) }}</td>
                                                <td>{{ number_format($daily_report->quotation_robin_total_cku) }}</td>
                                                <td>{{ number_format($daily_report->quotation_robin_total_mcs) }}</td>
                                                <td>{{ number_format($daily_report->invoice_ch_total_cku) }}</td>
                                                <td>{{ number_format($daily_report->invoice_ch_total_mcs) }}</td>
                                                <td>{{ number_format($daily_report->invoice_robin_total_cku) }}</td>
                                                <td>{{ number_format($daily_report->invoice_robin_total_mcs) }}</td>
                                                <td>{{ number_format($daily_report->quotation_ch_prods) }}</td>
                                                <td>{{ number_format($daily_report->quotation_robin_prods) }}</td>
                                                <td>{{ number_format($daily_report->quotation_total_prods()) }}</td>
                                                <td>{{ number_format($daily_report->invoice_ch_prods) }}</td>
                                                <td>{{ number_format($daily_report->invoice_robin_prods) }}</td>
                                                <td>{{ number_format($daily_report->invoice_total_prods()) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
