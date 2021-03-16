@extends ('layouts.app')

@section('title', 'Webhook')

<title>Webhook</title>

@section ('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 card">
                    <div class="card-header">
                        <h3 class="mb-0">Webhook</h3>
                    </div>
                    <div class="card-body">
                        <div class='mt-3 mb-5'>
                            Name: {{$webhook->name}}
                            @if ($webhook->exception)
                                <span class="badge badge-danger">Failed</span>
                            @else
                                <span class="badge badge-success">Success</span>
                            @endif
                            <form action="{{route('admin.webhook.reprocess', $webhook->id)}}" method='post'>
                                @csrf
                                <button type='submit' class='btn btn-warning'>Reprocess</button>
                            </form>
                        </div>
                        <div class='mt-3 mb-5'>
                            Payload: 
                            <hr>
                            <pre>
                                @json($webhook->payload, JSON_PRETTY_PRINT)
                            </pre>
                            
                        </div>
                        <div class='mt-3 mb-5'>
                            Exception:
                            <hr>
                            <pre>
                                @json($webhook->exception, JSON_PRETTY_PRINT)
                            </pre>
                        </div>
                        <div class='mt-3 mb-5'>
                            Created At: {{$webhook->created_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
