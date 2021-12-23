<?php

namespace App\Http\Controllers;

use App\QuestionSettings;
use Illuminate\Http\Request;
use DataTables;

class QuestionSettingController extends Controller
{
    public function settings()
    {
        $questionSettings = QuestionSettings::latest()->first();
        return view('question.settings', compact('questionSettings'));
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

        $scale_value[] = (['Description' => $request->scale_value]);
        QuestionSettings::create([
            'scale' => $request->scale,
            'scale_value' => $scale_value
        ]);

        return redirect()->route('question.index')->with('success', 'questions settings has been saved successfully.');
    }

    protected function validateQuestions()
    {
        return request()->validate([
            'scale' => 'required',
            'scale_value' => 'required',
        ]);
    }
}
