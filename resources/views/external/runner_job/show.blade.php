@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Runner Job</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Runner Job</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href ="{{ route('external.runner.show', $runnerJob->runnerSchedule->id ) }}">Runner
                            Schedule</a></li>
                        <li class="breadcrumb-item active">Runner Job</li>
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
                        <h3 class="mb-0"> Runner Job</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="w-100 table table-bordered table-striped">
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $runnerJob->id }}</td>
                                </tr>
                                <tr>
                                    <td>Order Id</td>
                                    <td>{{ $runnerJob->order->id }}</td>
                                </tr>
                                <tr>
                                    <td>Notis Ambilan</td>
                                    <td>{{ $runnerJob->order->notice_ambilan_ref }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <h5>
                                            @include('runner_job.status', ['state' => $runnerJob->state])
                                        </h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td> Name : {{ $runnerJob->order->customer->name }}
                                        <br />
                                        @if ($runnerJob->order->customer->phone_no !=null)
                                            Phone No : {{ $runnerJob->order->customer->phone_no }}
                                            <a href="https://api.whatsapp.com/send?phone= {{$runnerJob->order->customer->phone_no  }}" target="blank"><i class="fab fa-whatsapp icon-green"></i></a>
                                            <a href="tel:{{$runnerJob->order->customer->phone_no}}"><i class="fas fa-phone"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Scheduled At</td>
                                    <td>{{ myLongDateTime(new Carbon\Carbon($runnerJob->scheduled_at)) }}</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{{ $runnerJob->job_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quantity</td>
                                    <td>{{ $runnerJob->order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{  money($runnerJob->order->price) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Deposit</td>
                                    <td>{{ money($runnerJob->order->deposit_amount) }}</td>
                                </tr>
                                <tr>
                                    <td>Balance To be paid</td>
                                    <td>{{ money($runnerJob->order->balance_to_pay())}}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{!! orderAddress($runnerJob->order)!!}</td>
                                </tr>
                                <tr>
                                    <td>Completed At</td>
                                    <td>{{ $runnerJob->completed_at ? myLongDateTime(new Carbon\Carbon($runnerJob->completed_at)) : null }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Images</td>
                                    <td>
                                        @include('images.table', ['images' =>  $runnerJob->images, 'can_delete_image' => auth()->user()->can('create runnerSchedules')])
                                        @include('images.create', ['images' => $runnerJob->images, 'imageableId' => $runnerJob->id, 'imageableType' => App\RunnerJob::class ])
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @include('external.runner_job.form')
                        <a href="{{ route('customer_order.show', $encId) }}" target="_blank" class="btn btn-primary mr-2 ml-auto">Public Order Page</a>
                    </div>
                </div>
                <div class="col-md-5 ml-2 ">
                @include('comment.index', ['model' => $runnerJob, 'appName' => App\RunnerJob::class])
                </div>
            </div>
        </div>
    </div>

@endsection
