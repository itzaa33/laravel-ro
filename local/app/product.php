<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = [
        'title', 'server', 'category',
    ];

    public function posts()
    {
      return $this->hasOne(post::class,'category');
    }
}
