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
                        <div class="card-header">
                           <h3 class="mb-0">6 Month</h3>
                        </div>
                        <div class='card-body'>
                            @include('follow_up.table', ['bookings' => $sixMonth])
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                           <h3 class="mb-0">12 Month</h3>
                        </div>
                        <div class='card-body'>
                            @include('follow_up.table', ['bookings' => $twelveMonth])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
