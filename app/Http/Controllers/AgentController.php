<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agent;

class AgentController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::get();

        return view('agent.index', compact('agents'));
    }

    public function show(Agent $agent)
    {
        $assignments = $agent->agentAsignments()->with('booking');
        return view('agent.show', compact('agent', 'assignments'));
    }
}
