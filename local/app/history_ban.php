<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class history_ban extends Model
{
    //
    protected $fillable = [
         'id_user', 'description','command','name_admin','rank_admin',
    ];

    public function user()
    {
      return $this->belongsTo(User::class,'id_user');
    }
}
