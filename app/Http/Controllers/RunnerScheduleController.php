<?php

namespace App\Http\Controllers;

use App\User;
use App\RunnerSchedule;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;

class RunnerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __contruct()
    //  {
    //      $this->middleware(['auth','can: list runner_schedules | edit runner_schedules | delete runner_schedules']);
    //  }
    public function index()
    {
        $runner_schedules =RunnerSchedule::orderBy('id','ASC')->paginate(50);
        return view('runner_schedule.index', ['runner_schedules' => $runner_schedules])
        ->with('i',($runner_schedules->get('page',1)-1)*50);
        // $users = User::roles('Runner')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $runners  = User::role('Runner')->get();
        return view('runner_schedule.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateDates();
        RunnerSchedule::create($runners->all());
        return redirect()->route('runner_schedule.index')->with('success');

        // $runner_schedule = new RunnerSchedule();
        // $runner_schedule = runner_id

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerSchedule $runner_schedule)
    {
        return view('runner_schedule.show',compact('runner_schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RunnerSchedule $runner_schedule)
    {

        $runners  = User::role('Runner')->get();
        return view('runner_schedule.edit', compact('runner_schedule','runners'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RunnerSchedule $runner_schedule)
    {
        $runner_schedule->update($request->all());
        return redirect()->route('runner_schedule.index')->with('Runner Schedule is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RunnerSchedule $runner_schedule)
    {
        $runner_schedule->delete();

         return redirect()->route('runner_schedule.index')->with('Runner Schedule sucessfully deleted');
    }

    protected function validateDates()
    {
        return request()->validate([
            'scheduled_at'=>'required',
            'expected_complete'=>'required|after:scheduled_at',
            'status' => 'required',
        ]);
    }
}


