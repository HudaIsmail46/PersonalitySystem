@extends ('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<!-- Styles -->
<style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                font-size: 10px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
<head>
   
    <title>Booking Details</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
</head>

<body>
    
<div class="container">
    <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Booking Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
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
    
       @foreach($booking as  $row)
        <td>{{ $booking ->id}}</td>
        <td>{{ $row->event_title}}</td>
        <td>{{ $row->address }}</td>
        <td>{{ $row->event_begins }}</td>
        <td>{{ $row->event_ends }}</td>
        <td>{{ $row->description }}</td>
        <td>{{ $row->team }}</td>
        @endforeach
      </table>
      {{ $booking ?? ''->links() }}
     </div>
    </div>
</div>

</div>
    
</body>
</html>

@endsection