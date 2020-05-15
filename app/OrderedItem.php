<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $guarded = [];

    public function Order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function Item()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
