<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    const STATUSES = ['full time', 'part time', 'CFS'];

    protected $fillable = [
        'name', 'phone_no', 'employment_status'
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMembers::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function filterComment($comments, $month)
    {
        foreach ($comments as $comment) {
            if (($comment->created_at->format('n')) == $month) {
                $id[] = $comment->id;
            } else {
                $id[] = null;
            }
        }
        if ($comments->isEmpty()) {
            return $comments;
        } else {
            return $comments->find($id);
        }
    }
}
