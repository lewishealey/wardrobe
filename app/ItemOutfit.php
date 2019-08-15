<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOutfit extends Model
{
    protected $table = 'item_outfit';

    protected $fillable = array('item_id', 'outfit_id');

    protected $visible = ['order','priority'];
}
