@foreach ($teamMember->where('team_id', $team_id) as $team)
    @if ($team)
        <td>
            @foreach ($team->comments as $comments)
                <b>{{ $comments->comment }}</b><br>
            @endforeach
            <a href="{{ route('team_member.edit', $team->id) }}" class="float-right"><i class="fas fa-edit"></i></a>
            @if ($team->member1)
                {{ $team->member1->name }}
                {{ $team->member1->employment_status == 'part time' ? 'PT' : ($team->member1->employment_status == 'CFS' ? 'CFS' : '') }}
                <br>
            @endif
            @if ($team->member2)
                {{ $team->member2->name }}
                {{ $team->member2->employment_status == 'part time' ? 'PT' : ($team->member2->employment_status == 'CFS' ? 'CFS' : '') }}
                <br>
            @endif
            @if ($team->member3)
                {{ $team->member3->name }}
                {{ $team->member3->employment_status == 'part time' ? 'PT' : ($team->member3->employment_status == 'CFS' ? 'CFS' : '') }}
            @endif
        </td>
    @endif
@endforeach
