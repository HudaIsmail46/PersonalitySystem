<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = ['afinance_id','afinance_agent_code', 'fullname',
        'nickname', 'nric', 'email', 'phone_number'];

    public function agentAsignments()
    {
        return $this->hasMany(AgentAssignment::class);
    }
}
