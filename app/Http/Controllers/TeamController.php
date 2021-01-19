<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;

        $teams = Team::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->orderBy('id', 'ASC')->paginate(10);

        return view('team.index', compact('teams'));
    }

    public function show(Team $team)
    {
        return view('team.show', compact('team'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store(Request $request)
    {
        $this->validateTeams();
        $team = Team::create($request->all());

        return redirect()->route('team.show', $team->id)->with('success', 'Teams created successfully.');
    }

    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $this->validateTeams();
        $team->update($request->all());

        return redirect()->route('team.show', $team->id)->with('success', 'Teams updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('team.index')->with('Team succesfully deleted.');
    }

    protected function validateTeams()
    {
        return request()->validate([
            'name' => 'required',
        ]);
    }
}
