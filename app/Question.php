<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'question_text', 'question_category', 'score', 'scale_number',
    ];

    const CATEGORIES = ['Integrity', 'Emotional Intelligence', 'Adaptability ', 'Mindfulness', 'Resilience', 'Communication', 'Teamwork', 'Creativity']; 
    
}
