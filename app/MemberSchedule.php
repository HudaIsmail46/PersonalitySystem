<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberSchedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date', 'members', 'total_manpower', 'location'
    ];

    protected $dates = [
        'date'
    ];

    protected $casts = ['members' => 'array'];

    public function totalProductivity(){

        $total_team_prod = ($this->total_manpower)/2;
        return round($total_team_prod,0,PHP_ROUND_HALF_DOWN);

    }

    public function getTotalAvailabilities(MemberSchedule $memberSchedule)
    {
        foreach ($memberSchedule->members as $member) {
            $member_availabilities[] = $member['availability'];
        }
        $total_member_availabilities = array_sum($member_availabilities);
        return $total_member_availabilities;
    }
}
