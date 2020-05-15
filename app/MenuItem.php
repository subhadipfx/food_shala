<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }
}
