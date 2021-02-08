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

                            <div class="float-right mt-5">
                                Download File<a class="btn btn-success btn-md ml-2 mb-2"
                                    href="{{ route('team_member.file-export') }}"><i class="fa fa-download"></i></a>
                            </div>
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
                                        <li class="nav-item"><span class="nav-link" data-target="#tab1" aria-current="page"
                                                role="tab"
                                                data-toggle="tab">{{ Carbon\Carbon::now()->subMonths(1)->format('F') }}</span>
                                        </li>
                                        <li class="nav-item"><span class="nav-link active" data-target="#tab2"
                                                aria-current="page" role="tab"
                                                data-toggle="tab">{{ Carbon\Carbon::now()->format('F') }}</span>
                                        </li>
                                        <li class="nav-item"><span class="nav-link " data-target="#tab3" aria-current="page"
                                                role="tab"
                                                data-toggle="tab">{{ Carbon\Carbon::now()->addMonths(1)->format('F') }}</span>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $prevTeamMembers])
                                            </div>
                                        </div>
                                        <div class="tab-pane active" id="tab2">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $currTeamMembers])
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <div class='card-body'>
                                                @include('team_member.table', ['teamMembers' => $nextTeamMembers])
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
