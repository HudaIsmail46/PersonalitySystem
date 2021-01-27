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
                                    <div class="col-md-2">
                                        Status:
                                        <select id="days" class="form-control form-control-sm" name="status">
                                            <option value="">--Status--</option>
                                            @foreach(App\FollowUp::STATUS as $status)
                                                <option value="{{$status}}" {{(request()->status == $status) ? 'selected' : '' }} class='text-capitalize'>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Sales Person: 
                                        <select id="days" class="form-control form-control-sm" name="sales_person">
                                            <option value="">--Sales Person--</option>
                                            @foreach(App\FollowUp::SALES_PERSON as $sales_person)
                                                <option value="{{$sales_person}}" {{(request()->sales_person == $sales_person) ? 'selected' : '' }} class='text-capitalize'>{{$sales_person}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        Days before expiry:
                                        <select id="days" class="form-control form-control-sm" name="days">
                                            <option value="">--Number of days--</option>
                                            @foreach(range(1,7) as $day)
                                                <option value="{{(string)$day}}" {{(request()->days == (string)$day) ? 'selected' : '' }} class='text-capitalize'>{{$day}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                            </form>
                            @include('follow_up.table', ['follow_ups' => $followUps])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
