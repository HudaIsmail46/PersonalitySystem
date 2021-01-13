@extends ('layouts.app')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Members</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Members</li>
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
                            <h3 class="mb-0">Members Details</h3>
                        </div>
                        <div class='card-body'>

                            <form action="{{ route('member.index') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        Name: <input class="form-control form-control-sm" type="search" name="name"
                                            placeholder="name" value="{{ request()->name }}">
                                    </div>
                                    <div class="col-md-2">
                                        Phone No.: <input class="form-control form-control-sm" type="search" name="phone_no"
                                            placeholder="phone number" value="{{ request()->phone_no }}">
                                    </div>
                                </div>

                                <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i
                                        class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="tabbable">

                            <ul class="nav nav-tabs">
                                <li class="nav-item active"><span class="nav-link" data-target="#tab1" aria-current="page"
                                        data-toggle="tab">Full Time</span></li>
                                <li class="nav-item"><span class="nav-link" data-target="#tab2" aria-current="page"
                                        data-toggle="tab">Part Time</span></li>
                                <li class="nav-item"><span class="nav-link" data-target="#tab3" aria-current="page"
                                        data-toggle="tab">Contract For Service (CFS)</span></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class='card-body'>
                                        @include('member.table', ['members' => $fullTimeMembers])
                                        {{ $fullTimeMembers->withQueryString()->links() }}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <div class='card-body'>
                                        @include('member.table', ['members' => $partTimeMembers])
                                        {{ $partTimeMembers->withQueryString()->links() }}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <div class='card-body'>
                                        @include('member.table', ['members' => $cfsMembers])
                                        {{ $cfsMembers->withQueryString()->links() }}
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
