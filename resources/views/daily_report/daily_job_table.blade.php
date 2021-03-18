<div class="col-md-12 card ml-2">
    <div class="card-header">
        <h3 class="mb-0">Job Detail</h3>
    </div>
    <div class="card-body">
        <div class='mt-3 mb-5'>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-center">
                    <thead>
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Team</th>
                            <th rowspan="2">Team Type</th>
                            <th rowspan="2">Booking Id</th>
                            <th rowspan="2">Customer Name</th>
                            <th colspan="2" width='20%'>Estimates</th>
                            <th colspan="2" width='20%'>Actual</th>
                        </tr>
                        <tr>
                            <th>CKU</th>
                            <th>MCS</th>
                            <th>CKU</th>
                            <th>MCS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daily_report->jobs as $key=>$job)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $job['team'] }}</td>
                                <td>{{ $job['team_type'] }}</td>
                                <td>
                                    <a href={{ route('booking.show', $job['booking_id']) }}>
                                        {{ $job['booking_id'] }}</a>
                                </td>
                                <td>{{ $job['customer_name'] }}</td>
                                <td>RM {{ $job['team_type'] == 'ch' ? number_format($job['quotation_ch_total_cku']) : number_format($job['quotation_robin_total_cku']) }}</td>
                                <td>RM {{ $job['team_type'] == 'ch' ? number_format($job['quotation_ch_total_mcs']) : number_format($job['quotation_robin_total_mcs']) }}</td>
                                <td>RM {{ $job['team_type'] == 'ch' ? number_format($job['invoice_ch_total_cku']) : number_format($job['invoice_robin_total_cku']) }}</td>
                                <td>RM {{ $job['team_type'] == 'ch' ? number_format($job['invoice_ch_total_mcs']) : number_format($job['quotation_robin_total_mcs']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
