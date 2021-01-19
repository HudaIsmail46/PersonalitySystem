<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Date</th>
            @foreach ($teams as $team)
                @if ($team->name != null)
                    <th>{{ $team->name }}</th>
                @endif
            @endforeach
        </tr>

        @foreach ($teamMembers as $key => $teamMember)
            <tr>
                <td>{{ $key }}</td>

                @include('team_member.member', ['team_id' => 1])
                @include('team_member.member', ['team_id' => 2])
                @include('team_member.member', ['team_id' => 3])
                @include('team_member.member', ['team_id' => 4])
                @include('team_member.member', ['team_id' => 5])
                @include('team_member.member', ['team_id' => 6])
                @include('team_member.member', ['team_id' => 7])
                @include('team_member.member', ['team_id' => 8])
                @include('team_member.member', ['team_id' => 9])
                @include('team_member.member', ['team_id' => 10])
                @include('team_member.member', ['team_id' => 11])
                @include('team_member.member', ['team_id' => 12])

            </tr>
        @endforeach
    </table>
</div>
