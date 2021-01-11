@extends ('layouts.app')

@section ('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Follow Up</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
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
                            <h3 class="mb-0">Follow Up Detail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('follow_up.index')}}" method="get">
                                @csrf
                            </form>
                            <div class="">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Due for Expiry</th>
                                        <th>Voucher Expiry</th>
                                        <th>Latest Purchase</th>
                                        <th>Customer</th>
                                        <th>Description</th>
                                        <th>%</th>
                                        <th>Lead Status </th>
                                    </tr>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td><a href="{{ $booking->path() }}">{{ $booking->id }}</td>
                                            <td>
                                                @if ($booking->customer)
                                                    Name : <a href="{{ route('customer.show', $booking->customer) }}">{{ $booking->customer->name }}</a>
                                                    <br>
                                                    @if ($booking->customer->phone_no != null)
                                                        Phone No. : {{ $booking->customer->phone_no }}
                                                        <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no }}"
                                                            target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                                        <a href="tel:{{ $booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                                    @endif
                                                @else
                                                    Name : -
                                                    <br>
                                                    Phone No. : -
                                                @endif
                                            </td>
                                            <td> {{ myLongDateTime(new Carbon\Carbon($booking->gc_event_begins)) }}</td>
                                            <td>
                                                {{-- Start: {{ myLongDateTime(new Carbon\Carbon($booking->gc_event_begins)) }}<br>
                                                End: {{ myLongDateTime(new Carbon\Carbon($booking->gc_event_ends)) }} --}}
                                                @if ($booking->customer)
                                                    Name : <a href="{{ route('customer.show', $booking->customer) }}">{{ $booking->customer->name }}</a>
                                                    <br>
                                                    @if ($booking->customer->phone_no != null)
                                                        Phone No. : {{ $booking->customer->phone_no }}
                                                        <a href="https://api.whatsapp.com/send?phone={{ $booking->customer->phone_no }}"
                                                            target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                                        <a href="tel:{{ $booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                                    @endif
                                                @else
                                                    Name : -
                                                    <br>
                                                    Phone No. : -
                                                @endif
                                            </td>
                                            <td>{{ $booking->gc_team }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="{{ $booking->path() }}" class='btn btn-primary mr-2'>View</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
