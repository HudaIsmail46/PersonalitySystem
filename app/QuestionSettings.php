<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionSettings extends Model
{
    protected $fillable = [
        'scale','scale_value'
    ];

    protected $casts = [
        'scale_value' => 'array'
    ];
}
