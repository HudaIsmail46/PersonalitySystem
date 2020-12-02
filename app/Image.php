<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','name', 'file', 'imageable_id', 'imageable_type', 'caption'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
