<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];

    public function Orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function Items()
    {
        $this->hasMany(MenuItem::class,'restaurant_id','id')->get();
    }

    public function hasItems(){

        return MenuItem::where('restaurant_id',$this->id)->count();
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
