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
            <div class="col-md-6 card">
                <div class="card-header">
                    <h3 class="mb-0">Update Booking</h3>
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
                        <form method="POST" action="{{ route('booking.update', $booking->id)}}" enctype="multipart/form-data" >
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
                                <div class="form-group">
                                    <select id="status"  class="form-control form-control-sm" name="status">
                                        <option value="">--SELECT STATUS--</option>
                                        @foreach(App\Booking::STATUS as $status)
                                            <option value="{{$status}}"{{$booking->status == $status ? 'selected': ''}}>{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="help is-danger">{{ $errors->first('status')}}</p>
                            </div>
                            @include('images.create', ['images' => $booking->images, 'imageableId' => $booking->id, 'imageableType' => App\Booking::class ])

                            <button type="submit" class="btn mt-2 btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
