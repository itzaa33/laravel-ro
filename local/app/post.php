<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
    protected $fillable = [
        'upgrade', 'image', 'currency','status_post','price','description','id_user','id_product'
    ];

    public function users()
    {
      return $this->belongsTo(User::class,'id_user');
    }

    public function products()
    {
      return $this->belongsTo(product::class,'id_product');
    }
}
