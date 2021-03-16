<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentAssignment extends Model
{
    protected $fillable = ['booking_id','agent_id','raw_assignment','status','created_by', 'assignment_id'];
    protected $casts = ['raw_assignment' => 'array'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
