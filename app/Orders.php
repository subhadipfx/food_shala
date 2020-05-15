<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = [];

    public function OrderedItem()
    {
        $this->hasMany(OrderedItem::class);
    }
}
