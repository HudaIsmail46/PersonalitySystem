@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Update sales Person</title>

@section ('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">sales Person</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="/follow_up/{{$followUp->id}}">Follow Up</a></li>
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
                    <h3 class="mb-0">Update User</h3>
                </div>
                <div class="inner">
                    <div class="card-body">
                        <form method="POST" action="{{ route('follow_up.update', $followUp->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="field" id="form">
                                <div class="field">
                                    <div class="field">
                                        <label class="label" for="name">Customer </label>
                                        <div class="form-group row">
                                            <div class="ml-2">
                                               Name:{{$followUp->booking->customer->name}}
                                               <br>
                                                Phone No:{{$followUp->booking->customer->phone_no}}
                                                <a href="https://api.whatsapp.com/send?phone={{$followUp->booking->customer->phone_no }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                                <a href="tel:{{$followUp->booking->customer->phone_no }}"><i class="fas fa-phone"></i></a>
                                                <br><br>
                                                <b>Lead Status:</b>{{$followUp->lead_status}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label" for="name">Sales Person </label>
                                        <div class="form-group row">
                                            <div class="">
                                                <select id="pic" name="sales_person" class="custom-select @error('sales_person') is-invalid @enderror">
                                                    <option value="">--SELECT SALES PERSON--</option>
                                                    @foreach (App\followUp::SALES_PERSON as $sales_person)
                                                        <option value="{{ $sales_person }}" {{ $followUp->sales_person == $sales_person ? 'selected' : '' }}>
                                                            {{ $sales_person }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">{{ $errors->first('sales_person') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label" for="name">Follow Up Status </label>
                                        <div class="form-group row">
                                            <div class="">
                                                <select id="pic" name="follow_up_status" class="custom-select @error('follow_up_status') is-invalid @enderror">
                                                    <option value="">--SELECT STATUS--</option>
                                                    @foreach (App\followUp::STATUS as $follow_up_status)
                                                        <option value="{{ $follow_up_status }}" {{ $followUp->follow_up_status == $follow_up_status ? 'selected' : '' }}>
                                                            {{ $follow_up_status }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">{{ $errors->first('follow_up_status') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mx-1 ">
                @include('comment.index', ['model' => $followUp, 'appName' => App\FollowUp::class])
            </div>
        </div>
    </div>
</div>

@endsection
