<?php

namespace App\Http\Controllers;

use App\Exports\TeamMemberExport;
use Illuminate\Http\Request;
use App\Team;
use App\TeamMember;
use App\Member;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;

class TeamMemberController extends Controller
{
    public function fileExport()
    {
        return Excel::download(new TeamMemberExport, 'team-pairings-2021.xlsx');
    }

    public function index(Request $request)
    {
        $start   = $request->from;
        $end     = $request->to;

        $previousMonth = Carbon::now()->subMonths(1)->month;
        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonths(1)->month;

        $prevTeamMembers = TeamMember::whereMonth('date', $previousMonth)
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

        $currTeamMembers = TeamMember::whereMonth('date', $currentMonth)
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

        $nextTeamMembers = TeamMember::whereMonth('date', $nextMonth)
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

        foreach ($teams as $team) {
            if (($team->teamMembers)->isEmpty())
                $team->name = null;
        }

        return view('team_member.index', compact('prevTeamMembers', 'currTeamMembers', 'nextTeamMembers', 'teams'));
    }

    public function create()
    {
        $teams = Team::all();
        $members = Member::all();
        return view('team_member.create', compact('teams', 'members'));
    }

    public function store(Request $request)
    {
        $this->validateCreateTeamMembers();
        $period = CarbonPeriod::create($request->from, $request->to);

        foreach ($period as $date) {

            $teamMember = new TeamMember;
            $teamMember->fill([
                'team_id' => $request->team_id,
                'member1_id' => $request->member_1,
                'member2_id' => $request->member_2,
                'member3_id' => $request->member_3,
                'date' => $date->format('Y-m-d')
            ]);
            $teamMember->save();
        }

        return redirect()->route('team_member.index')->with('success', 'TeamMembers updated successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        $teams = Team::all();
        $members = Member::all();
        return view('team_member.edit', compact('teamMember', 'teams', 'members'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $this->validateUpdateTeamMembers();

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

    protected function validateCreateTeamMembers()
    {
        return request()->validate([
            'team_id' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);
    }

    protected function validateUpdateTeamMembers()
    {
        return request()->validate([
            'team_id' => 'required',
            'date' => 'required'
        ]);
    }
}
