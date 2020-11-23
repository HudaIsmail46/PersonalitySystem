<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RunnerSchedule extends Model
{
    protected $fillable = ['runner_id', 'scheduled_at', 'started_at', 'completed_at', 'status'];
    use SoftDeletes;

    const STATUS = ['draft', 'scheduled', 'on route', 'completed'];

    public function path()
    {
        return route('runner_schedule.show', $this);
    }

    protected $dates = ['started_at', 'completed_at'];

    public function runner()
    {
        return $this->belongsTo(User::class, 'runner_id');
    }

    public function runnerJobs()
    {
        return $this->hasMany('App\RunnerJob');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
