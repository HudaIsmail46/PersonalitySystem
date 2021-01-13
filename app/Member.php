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

}
