<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Days</th>
            @foreach ($memberSchedules as $memberSchedule)
                <th> {{ $memberSchedule->date->format('j') }}</th>
            @endforeach

        </tr>
        <tr>
            <th>Total Manpower</th>
            @foreach ($memberSchedules as $memberSchedule)
                <td>{{ $memberSchedule->total_manpower }}</td>
            @endforeach
        </tr>
        <tr>
            <th>For Prod.</th>
            @foreach ($memberSchedules as $memberSchedule)
                <td>{{ $memberSchedule->totalProductivity() }}</td>
            @endforeach
        </tr>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Member Name</th>
            @foreach ($memberSchedules as $memberSchedule)
                <th>{{ $memberSchedule->date->format('j') }}</th>
            @endforeach
        </tr>

        @foreach ($fulltimeMembers as $ftmember)
            @include('member_schedule.table', ['member' => $ftmember])
        @endforeach

    </table>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Member Name</th>
            @foreach ($memberSchedules as $memberSchedule)
                <th>{{ $memberSchedule->date->format('j') }}</th>
            @endforeach
        </tr>

        @foreach ($parttimeMembers as $ptmember)
            @include('member_schedule.table', ['member' => $ptmember])
        @endforeach

    </table>
</div>
