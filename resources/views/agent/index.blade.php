@extends ('layouts.app')

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">All Agents</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Agent Code</th>
                                        <th>Full Name</th>
                                        <th>Phone No</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                    @foreach($agents as $agent)
                                        <tr>
                                            <td>{{ $agent->afinance_agent_code }}</td>
                                            <td>{{ $agent->fullname }}</td>
                                            <td>
                                                {{ $agent->phone_number}}
                                                <a href="https://api.whatsapp.com/send?phone= {{ $agent->phone_number }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                                <a href="tel:{{$agent->phone_number }}"><i class="fas fa-phone"></i></a>
                                            </td>
                                            <td>{{ $agent->email }}</td>
                                            <td>
                                                <div class="row">
                                                    <a href={{route('agent.show', $agent->id)}}><button class='btn btn-primary mr-2'>View</button></a>
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
