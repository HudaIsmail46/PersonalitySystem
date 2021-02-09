@extends ('layouts.app')


@section ('content')
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Daily Report</h3>
                        </div>
                        <div class='card-body'>
                            <form action="{{route('customer.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        Month: <input class="form-control form-control-sm" type="month" name="month" placeholder="name" value="{{request()->month}}">
                                    </div>
                                    <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <th>y_factor</th>
                                        <th>x_factor</th>
                                        <th>invoice ch <br>total cku</th>
                                        <th>invoice ch <br>total mcs</th>
                                        <th>invoice robin <br>total cku</th>
                                        <th>invoice robin <br>total mcs</th>
                                        <th>quotation ch <br>total cku</th>
                                        <th>quotation ch <br>total mcs</th>
                                        <th>quotation robin <br>total cku</th>
                                        <th>quotation robin <br>total mcs</th>
                                        <th>ch count</th>
                                        <th>robin count</th>
                                        <th>quotation ch <br>prods</th>
                                        <th>invoice ch <br>prods</th>
                                        <th>quotation robin <br>prods</th>
                                        <th>invoice robin <br>prods</th>
                                    </tr>
                                    @foreach($daily_reports as $daily_report)
                                        <tr>
                                            <td>{{myDate($daily_report->date)}}</td>
                                            <td>{{$daily_report->y_factor}}</td>
                                            <td>{{$daily_report->x_factor}}</td>
                                            <td>{{$daily_report->invoice_ch_total_cku}}</td>
                                            <td>{{$daily_report->invoice_ch_total_mcs}}</td>
                                            <td>{{$daily_report->invoice_robin_total_cku}}</td>
                                            <td>{{$daily_report->invoice_robin_total_mcs}}</td>
                                            <td>{{$daily_report->quotation_ch_total_cku}}</td>
                                            <td>{{$daily_report->quotation_ch_total_mcs}}</td>
                                            <td>{{$daily_report->quotation_robin_total_cku}}</td>
                                            <td>{{$daily_report->quotation_robin_total_mcs}}</td>
                                            <td>{{$daily_report->ch_count}}</td>
                                            <td>{{$daily_report->robin_count}}</td>
                                            <td>{{$daily_report->quotation_ch_prods}}</td>
                                            <td>{{$daily_report->invoice_ch_prods}}</td>
                                            <td>{{$daily_report->quotation_robin_prods}}</td>
                                            <td>{{$daily_report->invoice_robin_prods}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $daily_reports->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
