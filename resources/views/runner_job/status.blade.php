@if ($state == 'completed')
    <span class="badge badge-success">Complete</span>
@elseif($state == "canceled")
    <span class="badge badge-danger">Canceled</span>
@else
    <span class="badge badge-warning">Incomplete</span>
@endif
