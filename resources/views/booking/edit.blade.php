@extends ('layouts.app')

@section('title', 'Page Title')

<title>Update Booking</title>

@section ('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Booking</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="/booking/{{$booking->id}}">Booking</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto card mt-4">
                <div class="card-header">
                    Update Booking
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="inner">
                    <div class="card-body">
                        @if($booking->customer)
                        Name : <a href="{{route('customer.show', $booking->customer)}}">{{ $booking->customer->name }}</a>
                        <br>
                        Phone No. : {{ $booking->customer->phone_no }}
                        @else
                        Name : -
                        <br>
                        Phone No. : -
                        @endif
                        <form method="POST" action="{{ route('booking.update', $booking->id)}}">
                            @csrf
                            @method('PUT')
                            <table class="table table-bordered table-striped" style="width:100%">

                                <tr>
                                    <td>Event Title</td>
                                    <td align="left">{{$booking->gc_event_title}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td align="left">{{$booking->gc_address}}</td>
                                </tr>
                                <tr>
                                    <td>Event Begins</td>
                                    <td align="left">{{ myLongDateTime(new Carbon\Carbon($booking->gc_event_begins))}}</td>
                                </tr>
                                <tr>
                                    <td>Event Ends</td>
                                    <td align="left">{{ myLongDateTime(new Carbon\Carbon($booking->gc_event_ends)) }}</td>
                                </tr>
                                <tr>
                                    <td>Team</td>
                                    <td align="left">{{$booking->gc_team}}</td>
                                </tr>
                                <tr>
                                    <td>Estimated Price</td>
                                    <td align="left">{{money($booking->gc_price)}}</td>
                                </tr>
                                <tr>
                                    <td>Service Type</td>
                                    <td align="left">{{$booking->service_type}}</td>
                                </tr>
                            </table>

                            <div class="col-md-6">
                                <label class="label" for="price">Price</label>
                                <div class="control">
                                    <input class="input @error('price') is-danger @enderror" type="number" name="price" id="price" value="{{old('price')?? $booking->price ?? ''}}" placeholder=" Actual Price (RM)">
                                    <p class="help is-danger">{{ $errors->first('price')}}</p>
                                </div>

                                <label class="label" for="receipt_number">Receipt Number </label>
                                <div class="control">
                                    <input class="input @error('receipt_number') is-danger @enderror" type="string" name="receipt_number" id="receipt_number" value="{{old('receipt_number')?? $booking->receipt_number ?? ''}}" placeholder=" Receipt Number">
                                    <p class="help is-danger">{{ $errors->first('receipt_number')}}</p>
                                </div>

                                <label class="label" for="invoice_number">Invoice Number </label>
                                <div class="control">
                                    <input class="input @error('invoice_number') is-danger @enderror" type="string" name="invoice_number" id="invoice_number" value="{{old('invoice_number')?? $booking->invoice_number ?? ''}}" placeholder=" Invoice Number">
                                    <p class="help is-danger">{{ $errors->first('invoice_number')}}</p>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="label" for="status">Status</label>
                                <select id="status" class="form-control form-control-sm" name="status">
                                    <option value="" {{ old('status', $booking->status) == '' ? 'selected' : '' }}>--Select Status--</option>
                                    <option value="APPROVED" {{ old('status', $booking->status) == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                                    <option value="NOT APPROVED" {{ old('status', $booking->status) == 'NOT APPROVED' ? 'selected' : '' }}>NOT APPROVED</option>
                                    <option value="IN PROGRESS" {{ old('status', $booking->status) == 'IN PROGRESS' ? 'selected' : '' }}>IN PROGRESS</option>
                                    <option value="POSTPONED" {{ old('status', $booking->status) == 'POSTPONED' ? 'selected' : '' }}>POSTPONED</option>
                                    <option value="HUTANG" {{ old('status', $booking->status) == 'HUTANG' ? 'selected' : '' }}>HUTANG</option>
                                    <option value="RECUCI" {{ old('status', $booking->status) == 'RECUCI' ? 'selected' : '' }}>RECUCI</option>
                                    <option value="PENDING" {{ old('status', $booking->status) == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                    <option value="NOT VALID" {{ old('status', $booking->status) == 'NOT VALID' ? 'selected' : '' }}>NOT VALID</option>
                                </select>
                                <p class="help is-danger">{{ $errors->first('status')}}</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
