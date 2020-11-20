<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateComments();
        $id = Auth()->user()->id;
        $comments = new Comment;
        $comments->fill([
            'user_id' => $id,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'comment' => $request->comment,
        ]);
        
        $comments->save();

        return redirect()->back();    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();   
    }

    protected function validateComments()
    {
        return request()->validate([
            'commentable_id' => 'required',
            'commentable_type' => 'required',
            'comment' => 'required'
        ]);
    }
}
