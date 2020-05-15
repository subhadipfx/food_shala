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

    public function OrderedFrom()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function OrderedBy()
    {
        return $this->belongsTo(Customer::class);
    }
}
