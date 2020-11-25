<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RunnerJob extends Model
{
    use SoftDeletes;
    const STATUS = ['draft', 'scheduled', 'completed', 'canceled'];
    protected $fillable = ['runner_schedule_id', 'order_id', 'state',
        'job_type', 'completed_at', 'scheduled_at', 'deleted_at'];

    public function runnerSchedule()
    {
        return $this->belongsTo(RunnerSchedule::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
