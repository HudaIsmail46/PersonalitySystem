<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    protected $fillable = ['name','file'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
