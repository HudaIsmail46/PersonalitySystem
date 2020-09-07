@extends ('layouts.app')

@section('title', 'Page Title')

<title>Import Excel to database</title>

@section ('content')

    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Import Excel to database
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="card-body">
                <form action="{{ url('/import-excel') }}" method="POST" name="importform" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="import_file" class="form-control">
                    <br>
                    <button class="btn btn-success">Import File</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Booking Data 
        </div>
        <div class="panel-body">
            <div class="table-responsive" style="height:800px;overflow-y:scroll">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Event Title</th>
                        <th>Address</th>
                        <th>Event Begins</th>
                        <th>Event Ends</th>
                        <th>Description</th>
                        <th>Team</th>
                    </tr>
                    @foreach($bookings as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{ $row->event_title}}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->event_begins }}</td>
                        <td>{{ $row->event_ends }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->team }}</td>
                    </tr>
                    @endforeach
                </table>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</html>
@endsection
