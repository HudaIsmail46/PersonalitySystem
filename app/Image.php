<?php

namespace App\Dropzone;

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'file', 'imageable_id', 'imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
