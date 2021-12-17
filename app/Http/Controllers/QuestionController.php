<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Question::all();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', 'question.actions')
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateQuestions();
        Question::create($request->all());

        return redirect()->route('question.index')->with('success', 'questions created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validateQuestions();
        $question->update($request->all());

        return redirect()->route('question.index')->with('success', 'questions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('question.index')->with('question succesfully deleted.');
    }

    public function settings()
    {
        return view('question.settings');
    }

    protected function validateQuestions()
    {
        return request()->validate([
            'question_text' => 'required',
            'question_category' => 'required',
            // 'scale_number' => 'required',
        ]);
    }
}
