<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plat_no'
    ];

    public function vehicleSchedule()
    {
        return $this->hasMany(VehicleSchedule::class);
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