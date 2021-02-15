
<tr>
    <td>
        <a href={{ route('vehicle.show', $vehicle->id) }}> {{ $vehicle['plat_no'] }}</a>
    </td>
    @foreach ($vehicleSchedules as $key => $vehicleSchedule)

        @foreach ($vehicleSchedule->vehicles as $vehicle_schedules)
            @if ($vehicle_schedules['vehicle_id'] == $vehicle['id'] && $vehicle_schedules['availability'] == 1)
                <td class="bg-success">
                    <a href={{ route('vehicle_schedule.edit', [$vehicle->id, $vehicleSchedule->date->format('m')]) }}>{{ $vehicle_schedules['availability'] }}</a>
                </td>
            @elseif($vehicle_schedules['vehicle_id'] == $vehicle['id'] && $vehicle_schedules['availability'] ==0)
                <td class="bg-danger">
                    <a href={{ route('vehicle_schedule.edit', [$vehicle->id, $vehicleSchedule->date->format('m')]) }}>{{ $vehicle_schedules['availability'] }}</a>
                </td>
            @endif
        @endforeach

    @endforeach
</tr>
