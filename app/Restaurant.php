<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];

    public function Orders()
    {
        return $this->hasMany(Orders::class,'restaurant_id','id');
    }

    public function MenuItem()
    {
        $this->hasMany(MenuItem::class);
    }
}
