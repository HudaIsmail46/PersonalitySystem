<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Date</th>
            @foreach ($teams as $team)
                <th>{{ $team->name }}</th>
            @endforeach
        </tr>

        @foreach ($teamMembers as $key => $teamMember)
            <tr>
                <td>{{ $key }}</td>
                <td>
                    @include('team_member.member', ['team_id' => 1])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 2])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 3])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 4])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 5])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 6])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 7])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 8])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 9])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 10])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 11])
                </td>
                <td>
                    @include('team_member.member', ['team_id' => 12])
                </td>
            </tr>
        @endforeach
    </table>
</div>
