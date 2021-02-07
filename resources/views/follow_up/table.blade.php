<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Due for Expiry</th>
            <th>Voucher Expiry</th>
            <th>Latest Purchase</th>
            <th >Customer</th>
            <th>Discount %</th>
            <th>Lead Status</th>
            <th>Sales Person</th>
            <th>Follow Up Status</th>
            <th></th>
        </tr>
        @foreach ($follow_ups as $follow_up)
            <tr>
                <td>
                    {{$follow_up->expire_at->diffInDays(Carbon\Carbon::now())}} days
                </td>
                <td>
                    {{myDate($follow_up->expire_at) }}
                </td>
                <td>
                    {{$follow_up->customer->bookings()->orderBy('created_at', 'asc')->first() ? myDate($follow_up->customer->bookings()->orderBy('created_at', 'asc')->first()->event_begins) :: ''}}
                </td>
                <td>
                    @if ($follow_up->customer)
                        Name : <a href="{{ route('customer.show', $follow_up->customer) }}">{{ $follow_up->customer->name }}</a>
                        <br>
                        @if ($follow_up->customer->phone_no != null)
                            Phone No. : {{ $follow_up->customer->phone_no }}
                            <a href="https://api.whatsapp.com/send?phone={{ $follow_up->customer->phone_no }}"
                                target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                            <a href="tel:{{ $follow_up->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                        @endif
                    @else
                        Name : -
                        <br>
                        Phone No. : -
                    @endif
                </td>
                <td>
                    {{$follow_up->voucher_percent}}
                </td>
                <td>
                    {{$follow_up->lead_status}}
                </td>
                <td>{{$follow_up->sales_person}}</td>
                <td>
                    {{$follow_up->follow_up_status}}
                </td>
                <td>
                    <a href={{route('follow_up.edit', $follow_up->id)}}><button class='btn btn-primary mr-2'>Edit</button></a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
