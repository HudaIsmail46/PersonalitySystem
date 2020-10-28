<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RunnerSchedule extends Model
{
    protected $fillable =['runner_id','scheduled_at','started_at','expected_complete','complete_at','status'];
    use SoftDeletes;

    public function path()
    {
        return route('runner_schedule.show', $this);
    }

    protected $dates =['started_at','expected_complete'];


    public function User()
    {
        return $this->belongTo(User::class);
    }
}
