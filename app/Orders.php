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

    public function orderedFrom()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }

    public function orderedBy()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
