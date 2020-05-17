<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function items()
    {
        return $this->belongsTo(MenuItem::class,'menu_item_id','id');
    }
}
