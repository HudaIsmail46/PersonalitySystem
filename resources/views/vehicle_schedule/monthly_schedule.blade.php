<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Days</th>
            @foreach ($vehicleSchedules as $vehicleSchedule)
                <th>{{ $vehicleSchedule->date->format('j') }}</th>
            @endforeach

        </tr>
        <tr>
            <th>Total Vehicles</th>
            @foreach ($vehicleSchedules as $vehicleSchedule)
                <td>
                    {{ $vehicleSchedule->total_vehicles }}
                </td>
            @endforeach
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Plat No</th>
            @foreach ($vehicleSchedules as $vehicleSchedule)
                <th>{{ $vehicleSchedule->date->format('j') }}</th>
            @endforeach
        </tr>

        @foreach ($vehicles as $vehicle)
            @include('vehicle_schedule.table', ['vehicle' => $vehicle])
        @endforeach

    </table>
</div>
