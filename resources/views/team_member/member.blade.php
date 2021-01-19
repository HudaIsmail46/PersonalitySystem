@foreach ($teamMember->where('team_id', $team_id) as $team)
    @foreach ($team->comments as $comments)
        <b>{{ $comments->comment }}</b><br>
    @endforeach
    <a href="{{ route('team_member.edit', $team->id) }}" class="float-right"><i class="fas fa-edit"></i></a>
    @if ($team->member1)
        {{ $team->member1->name }}<br>
    @endif
    @if ($team->member2)
        {{ $team->member2->name }}<br>
    @endif
    @if ($team->member3)
        {{ $team->member3->name }}
    @endif
@endforeach
