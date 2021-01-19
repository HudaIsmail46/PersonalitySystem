<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'team_id', 'member1_id', 'member2_id', 'member3_id', 'member4_id', 'date'
    ];

    protected $date = [
        'date'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function member1()
    {
        return $this->hasOne(Member::class, 'id', 'member1_id');
    }

    public function member2()
    {
        return $this->hasOne(Member::class, 'id', 'member2_id');
    }

    public function member3()
    {
        return $this->hasOne(Member::class, 'id', 'member3_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
