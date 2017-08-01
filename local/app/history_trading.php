<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history_trading extends Model
{
    //
    protected $fillable = [
         'id_user', 'behavior','id_product',
    ];
}
