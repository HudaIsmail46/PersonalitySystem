<tr>
    <td>
        <a href={{ route('member.show', $member->id) }}> {{ $member['name'] }}
            {{ employeeStatus($member['employment_status']) }}</a>
    </td>
    @foreach ($memberSchedules as $key => $memberSchedule)

        @foreach ($memberSchedule->members as $member_schedules)
            @if ($member_schedules['member_id'] == $member['id'] && $member_schedules['availability'] == 1)
                <td class="bg-success">
                    <a
                        href={{ route('member_schedule.edit', [$member->id, $memberSchedule->date->format('m')]) }}>{{ $member_schedules['availability'] }}</a>
                </td>
            @elseif($member_schedules['member_id'] == $member['id'] && $member_schedules['availability'] ==0)
                <td class="bg-danger">
                    <a
                        href={{ route('member_schedule.edit', [$member->id, $memberSchedule->date->format('m')]) }}>{{ $member_schedules['availability'] }}</a>
                </td>
            @elseif($member_schedules['member_id'] == $member['id'] && $member_schedules['availability'] ==0.5)
                <td class="bg-warning">
                    <a
                        href={{ route('member_schedule.edit', [$member->id, $memberSchedule->date->format('m')]) }}>{{ $member_schedules['availability'] }}</a>
                </td>
            @endif
        @endforeach

    @endforeach
</tr>
