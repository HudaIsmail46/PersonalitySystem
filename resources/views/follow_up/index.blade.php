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
                        <li class="breadcrumb-item active">Follow Up</li>
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
                        <div class='card-body'>
                            <form action="{{route('follow_up.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        Lead Status:
                                        <select id="days" class="form-control form-control-sm" name="lead_status">
                                            <option value="">--Lead Status--</option>
                                            @foreach(App\FollowUp::LEAD_STATUS as $lead_status)
                                                <option value="{{$lead_status}}" {{(request()->lead_status == $lead_status) ? 'selected' : '' }} class='text-capitalize'>{{$lead_status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Follow Up Status:
                                        <select id="days" class="form-control form-control-sm" name="follow_up_status">
                                            <option value="">--Follow Up Status--</option>
                                            @foreach(App\FollowUp::STATUS as $follow_up_status)
                                                <option value="{{$follow_up_status}}" {{(request()->follow_up_status == $follow_up_status) ? 'selected' : '' }} class='text-capitalize'>{{$follow_up_status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        Sales Person: 
                                        <select id="days" class="form-control form-control-sm" name="sales_person">
                                            <option value="">--Sales Person--</option>
                                            @foreach(App\FollowUp::SALES_PERSON as $sales_person)
                                                <option value="{{$sales_person}}" {{(request()->sales_person == $sales_person) ? 'selected' : '' }} class='text-capitalize'>{{$sales_person}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9 mt-2">
                                    Expire At:
                                    <div class="row">
                                        <div class="form-group row col-6">
                                            <label for="from" class="col-sm-2 col-form-label">From</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="from" name="from" value="{{request()->from ?? Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row col-6">
                                            <label for="to" class="col-sm-2 col-form-label">To</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="to" name="to" value="{{request()->to ?? Carbon\Carbon::now()->addDays(7)->format('Y-m-d')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-primary mb-2 mt-2" type="submit"><i class="fa fa-search mr-1"></i>Filter</button>
                            </form>
                            @include('follow_up.table', ['follow_ups' => $followUps])
                            {{ $followUps->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
