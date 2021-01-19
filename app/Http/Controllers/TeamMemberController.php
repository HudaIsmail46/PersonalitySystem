<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamMember;
use App\Member;
use Carbon\Carbon;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $start   = $request->from;
        $end     = $request->to;

        $janTeamMembers = TeamMember::whereMonth('date', '=', '01')
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('date', [$start, $end]);
            })
            ->orderBy('date', 'ASC')
            ->orderBy('team_id', 'ASC')
            ->with('team', 'member1', 'member2', 'member3')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date)->format('d/m/Y , l');
            });

        $febTeamMembers = TeamMember::whereMonth('date', '=', '02')
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('date', [$start, $end]);
            })
            ->orderBy('date', 'ASC')
            ->orderBy('team_id', 'ASC')
            ->with('team', 'member1', 'member2', 'member3')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date)->format('d/m/Y , l');
            });

        $marchTeamMembers = TeamMember::whereMonth('date', '=', '03')
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('date', [$start, $end]);
            })
            ->orderBy('date', 'ASC')
            ->orderBy('team_id', 'ASC')
            ->with('team', 'member1', 'member2', 'member3')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date)->format('d/m/Y , l');
            });

        $teams = Team::orderBy('id', 'ASC')->get();


        return view('team_member.index', compact('janTeamMembers', 'febTeamMembers', 'marchTeamMembers', 'teams'));
    }

    public function create()
    {
        $teams = Team::all();
        $members = Member::all();
        return view('team_member.create', compact('teams', 'members'));
    }

    public function store(Request $request)
    {
        $this->validateteamMembers();

        $teamMember = new TeamMember;
        $teamMember->fill([
            'team_id' => $request->team_id,
            'member1_id' => $request->member_1,
            'member2_id' => $request->member_2,
            'member3_id' => $request->member_3,
            'date' => $request->date
        ]);

        $teamMember->save();

        return redirect()->route('team_member.create')->with('success', 'TeamMembers created successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        $teams = Team::all();
        $members = Member::all();
        return view('team_member.edit', compact('teamMember', 'teams', 'members'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $this->validateteamMembers();

        $teamMember->fill([
            'team_id' => $request->team_id,
            'member1_id' => $request->member_1,
            'member2_id' => $request->member_2,
            'member3_id' => $request->member_3,
            'date' => $request->date
        ]);

        $teamMember->save();
        return redirect()->route('team_member.index')->with('success', 'TeamMembers updated successfully.');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();
        return redirect()->route('team_member.index')->with('TeamMember succesfully deleted.');
    }

    protected function validateteamMembers()
    {
        return request()->validate([
            'team_id' => 'required',
            'date' => 'required'
        ]);
    }
}
