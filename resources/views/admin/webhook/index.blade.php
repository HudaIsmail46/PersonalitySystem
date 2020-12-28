@extends ('layouts.app')

@section ('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Booking Detail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.webhook.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        Status:
                                        <select id="status" class="form-control form-control-sm" name="status">
                                            <option value="">--Select Status--</option>
                                            <option value="true" class='text-capitalize' {{request()->status == 'true' ? 'selected' : ''}}>Success</option>
                                            <option value="false" class='text-capitalize' {{request()->status == 'false' ? 'selected' : ''}} >Failed</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary mb-2 mt-2" type="submit">Search <i class="fa fa-search"></i></button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Webhook Id</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                    @foreach($webhooks as $webhook)
                                    <tr>
                                        <td><a href="{{route('admin.webhook.show', $webhook->id)}}">{{ $webhook ->id}}</td>
                                        <td>
                                            {{ $webhook->name}}<br>
                                        </td>
                                        <td>
                                            @if ($webhook->exception)
                                                <span class="badge badge-danger">Failed</span>
                                            @else
                                                <span class="badge badge-success">Success</span>
                                            @endif
                                        <td>
                                            {{ myLongDateTime(new Carbon\Carbon($webhook->created_at)) }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <a href="{{route('admin.webhook.show', $webhook->id)}}"class='btn btn-primary mr-2'>View</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </table>                                
                                {{ $webhooks ?? ''->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
