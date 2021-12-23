<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\QuestionSettings;
use App\Student;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function start()
    {
        return view('test.start');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $questionsSettings = QuestionSettings::latest()->first();
        $scale = $questionsSettings->scale;
        $scale_value = explode(",",$questionsSettings->scale_value[0]['Description']);
        $categories = Category::all()->sortBy('name', SORT_NATURAL);

        return view('test.test', compact('questions', 'scale', 'scale_value', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $question_results = $request->input('questions');
        // $result = auth()->user()->userResults()->create([
        //     'total_points' => array_sum($question_results),
        // ]);

        // $values = $question_results;
        // // dd($values);
        // $questions = $values->mapWithKeys(function ($value) {
        //     return [$value->question_id => [
        //                 'points' => $value
        //             ]
        //         ];
        //     })->toArray();

        // dd($questions);

        // $result->questions()->sync($questions);

        // return redirect()->route('client.results.show', $result->id);

        return redirect()->route('test.result')->with('success', 'Tests created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Test $test)
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        return view('test.result', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('test.edit', compact('Test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $this->validateTests();
        $test->update($request->all());

        return redirect()->route('test.show', $test->id)->with('success', 'Tests updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('test.index')->with('Test succesfully deleted.');
    }

    public function settings()
    {
        return view('test.settings');
    }

    protected function validateTests()
    {
        return request()->validate([
            // 'name' => 'required',
        ]);
    }
}
