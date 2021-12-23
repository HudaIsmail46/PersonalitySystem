<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    protected $fillable = ['user_id', 'faculty', 'department'];

    const FACULTIES = ['FACULTY OF BUILT ENVIRONMENT',
    'FACULTY OF LANGUAGES AND LINGUISTICS',
    'FACULTY OF ECONOMICS & ADMINISTRATION',
    'FACULTY OF PHARMACY',
    'FACULTY OF ENGINEERING',
    'FACULTY OF EDUCATION',
    'FACULTY OF DENTISTRY',
    'FACULTY OF BUSINESS AND ACCOUNTANCY',
    'FACULTY OF MEDICINE',
    'FACULTY OF SCIENCE',
    'FACULTY OF PHARMACY',
    'FACULTY OF SCIENCE COMPUTER & INFORMATION TECHNOLOGY',
    'FACULTY OF ARTS & SOCIAL SCIENCE',
    'FACULTY OF CREATIVE ARTS',
    'FACULTY OF LAW'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
