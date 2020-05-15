<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
