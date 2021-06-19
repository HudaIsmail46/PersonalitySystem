<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'scale_count',
    ];

    const CATEGORIES = ['Integrity', 'Emotional Intelligence', 'Adaptability ', 'Mindfulness', 'Resilience', 'Communication', 'Teamwork', 'Creativity']; 
    
}
