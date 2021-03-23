@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Agent Data</title>

@section ('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Agents</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Agents</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card ">
                <div class="card-header">
                    <h3 class="mb-0">{{$agent->fullname}}</h3>
                    <p class="mb-1">
                        {{$agent->phone_number}}
                        <a href="https://api.whatsapp.com/send?phone= {{$agent->phone_number  }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                        <a href="tel:{{$agent->phone_number }}"><i class="fas fa-phone"></i></a>
                    </p>

                    <p class="mb-1">Email: {{$agent->email}}</p>
                    <p class='mb-1'>AFinance Id: {{$agent->afinance_id}}</p>
                    <p class='mb-1'>AFinance Agent Code: {{$agent->afinance_agent_code}}</p>
                    <p class='mb-1'>Nickname: {{$agent->nickname}}</p>
                    <p class='mb-1'>NRIC: {{$agent->nric}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
