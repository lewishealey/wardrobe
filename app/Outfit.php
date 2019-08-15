<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    protected $table = 'outfit';

    public function items()
    {
        return $this->belongsToMany('App\Item')
        ->withPivot('order')
        ->withPivot('priority')
        ->withTimestamps();
    }
}
