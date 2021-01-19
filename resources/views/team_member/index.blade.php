@extends ('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Team Pairings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Team Pairings</li>
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
                            <h3 class="mb-0">Team Pairings Details</h3>
                            <form action="{{ route('team_member.index') }}" method="get">
                                @csrf
                                <div class="row ml-0 mt-2">
                                    <div class="col-md-2">
                                        From: <input class="form-control form-control-sm" type="date" name="from"
                                            value="{{ request()->from }}">
                                    </div>
                                    <div class="col-md-2">
                                        To: <input class="form-control form-control-sm" type="date" name="to"
                                            value="{{ request()->to }}">
                                    </div>
                                    <button class="btn btn-primary btn-sm mt-4" type="submit">Search <i
                                            class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class='card-body'>
                            <div class="card">
                                <div class="tabbable">

                                    <ul class="nav nav-tabs">
                                        <li class="nav-item active"><span class="nav-link" data-target="#tab1"
                                                aria-current="page" data-toggle="tab">January</span></li>
                                        <li class="nav-item"><span class="nav-link" data-target="#tab2" aria-current="page"
                                                data-toggle="tab">February</span></li>
                                        <li class="nav-item"><span class="nav-link" data-target="#tab3" aria-current="page"
                                                data-toggle="tab">March</span></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $janTeamMembers])
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $febTeamMembers])
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $marchTeamMembers])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
