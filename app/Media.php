<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    public function items()
    {
        return $this->belongsTo('App\Item');
    }
}
