<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Progress Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="dailyReport" config="{{$daily_report_chart}}"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Current Progress</th>
                                    <th colspan="2">{{myShortDate($from)}} - {{myShortDate($to)}}</th>
                                </tr>
                                <tr>
                                    <th>Estimates</th>
                                    <th>Actual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Productivity(Overall)</td>
                                    <td>RM {{number_format($estimates_total_prod)}}</td>
                                    <td>RM {{number_format($actual_total_prod)}}</td>
                                </tr>
                                <tr>
                                    <td>Productivity(HQ)</td>
                                    <td>RM {{number_format($estimates_ch_prod)}}</td>
                                    <td>RM {{number_format($actual_ch_prod)}}</td>
                                </tr>
                                <tr>
                                    <td>Productivity(ROBIN)</td>
                                    <td>RM {{number_format($estimates_robin_prod)}}</td>
                                    <td>RM {{number_format($actual_robin_prod)}}</td>
                                </tr>
                                <tr>
                                    <td>Total Sales</td>
                                    <td>RM {{number_format($estimates_total_sales)}}</td>
                                    <td>RM {{number_format($actual_total_sales)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 col-sm12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan='2'>{{$month->format('M, Y')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Monthly Sales Total</td>
                                    <td>RM {{number_format($actual_total_sales)}}</td>
                                </tr>
                                <tr>
                                    <td>Monthly Expected Sales</td>
                                    <td>RM {{number_format($expected_total_sales)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
